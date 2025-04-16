<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\DeliveryAttempt;
use App\Models\V1\IncomingRequest;
use App\Models\V1\Project;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * @tags Statistiques du Dashboard
 */
final class DashboardController extends Controller
{
    /**
     * Récupère les statistiques globales du dashboard pour l'utilisateur connecté
     *
     * @response 200 {
     *   "data": {
     *     "active_projects": {
     *       "count": 8,
     *       "change": 2,
     *       "change_period": "last_month"
     *     },
     *     "callbacks_received": {
     *       "count": 1284,
     *       "change_percentage": 12.5,
     *       "change_type": "increase"
     *     },
     *     "webhooks_processed": {
     *       "count": 24592,
     *       "period": "last_30_days"
     *     },
     *     "error_rate": {
     *       "percentage": 1.2,
     *       "errors_today": 14
     *     }
     *   }
     * }
     */
    public function getGlobalStats(): JsonResponse
    {
        $user = Auth::user();
        $now = Carbon::now();
        $thirtyDaysAgo = $now->copy()->subDays(30);
        $lastMonth = $now->copy()->subMonth();

        // Projets actifs de l'utilisateur
        $activeProjects = Project::where('status', 'active')
            ->where('user_id', $user->id)
            ->count();
        $lastMonthProjects = Project::where('status', 'active')
            ->where('user_id', $user->id)
            ->where('created_at', '<=', $lastMonth)
            ->count();
        $projectChange = $activeProjects - $lastMonthProjects;

        // Callbacks reçus pour les projets de l'utilisateur
        $userProjectIds = Project::where('user_id', $user->id)->pluck('id');

        $totalCallbacks = IncomingRequest::whereIn('project_id', $userProjectIds)
            ->whereBetween('created_at', [$thirtyDaysAgo, $now])
            ->count();
        $previousPeriodCallbacks = IncomingRequest::whereIn('project_id', $userProjectIds)
            ->whereBetween(
                'created_at',
                [$thirtyDaysAgo->copy()->subDays(30), $thirtyDaysAgo],
            )->count();
        $callbacksChangePercentage = $previousPeriodCallbacks > 0
            ? (($totalCallbacks - $previousPeriodCallbacks) / $previousPeriodCallbacks) * 100
            : 0;

        // Webhooks traités pour les projets de l'utilisateur
        $webhooksProcessed = DeliveryAttempt::whereHas('incomingRequest', function ($query) use ($userProjectIds): void {
            $query->whereIn('project_id', $userProjectIds);
        })
            ->whereBetween('created_at', [$thirtyDaysAgo, $now])
            ->count();

        // Taux d'erreur pour les projets de l'utilisateur
        $todayErrors = DeliveryAttempt::whereHas('incomingRequest', function ($query) use ($userProjectIds): void {
            $query->whereIn('project_id', $userProjectIds);
        })
            ->whereDate('created_at', $now)
            ->where('status', 'error')
            ->count();
        $todayTotal = DeliveryAttempt::whereHas('incomingRequest', function ($query) use ($userProjectIds): void {
            $query->whereIn('project_id', $userProjectIds);
        })
            ->whereDate('created_at', $now)
            ->count();
        $errorRate = $todayTotal > 0 ? ($todayErrors / $todayTotal) * 100 : 0;

        return $this->responseSuccess(null, [
            'active_projects' => [
                'count' => $activeProjects,
                'change' => $projectChange,
                'change_period' => 'last_month',
            ],
            'callbacks_received' => [
                'count' => $totalCallbacks,
                'change_percentage' => round($callbacksChangePercentage, 1),
                'change_type' => $callbacksChangePercentage >= 0 ? 'increase' : 'decrease',
            ],
            'webhooks_processed' => [
                'count' => $webhooksProcessed,
                'period' => 'last_30_days',
            ],
            'error_rate' => [
                'percentage' => round($errorRate, 1),
                'errors_today' => $todayErrors,
            ],
        ]);
    }

    /**
     * Récupère les données d'activité des webhooks pour le graphique
     *
     * @queryParam period string required Période d'analyse (7_days ou 30_days) Example: 7_days
     *
     * @response 200 {
     *   "data": {
     *     "webhook_activity": [
     *       {
     *         "date": "2024-03-01",
     *         "count": 1250
     *       },
     *       {
     *         "date": "2024-03-02",
     *         "count": 1890
     *       }
     *     ]
     *   }
     * }
     */
    public function getWebhookActivity(): JsonResponse
    {
        $user = Auth::user();
        $period = request('period', '7_days');
        $days = '30_days' === $period ? 30 : 7;

        $userProjectIds = Project::where('user_id', $user->id)->pluck('id');

        $activity = DeliveryAttempt::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereHas('incomingRequest', function ($query) use ($userProjectIds): void {
                $query->whereIn('project_id', $userProjectIds);
            })
            ->where('created_at', '>=', Carbon::now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return $this->responseSuccess(null, [
            'webhook_activity' => $activity,
        ]);
    }

    /**
     * Récupère les temps de réponse pour le graphique
     *
     * @queryParam hours int Nombre d'heures d'historique (default: 24) Example: 24
     *
     * @response 200 {
     *   "data": {
     *     "response_times": [
     *       {
     *         "hour": "2024-03-01 13:00:00",
     *         "average_time": 120
     *       },
     *       {
     *         "hour": "2024-03-01 14:00:00",
     *         "average_time": 85
     *       }
     *     ]
     *   }
     * }
     */
    public function getResponseTimes(): JsonResponse
    {
        $user = Auth::user();
        $hours = request('hours', 24);
        $startDate = Carbon::now()->subHours($hours);

        $userProjectIds = Project::where('user_id', $user->id)->pluck('id');

        $responseTimes = IncomingRequest::selectRaw(
            config('database.default') === 'sqlite'
                ? 'strftime("%Y-%m-%d %H:00:00", received_at) as hour,
                   AVG((julianday(updated_at) - julianday(received_at)) * 86400.0) as average_time'
                : 'DATE_FORMAT(received_at, "%Y-%m-%d %H:00:00") as hour,
                   AVG(TIMESTAMPDIFF(SECOND, received_at, updated_at)) as average_time'
        )
            ->whereIn('project_id', $userProjectIds)
            ->where('status', 'processed')
            ->where('received_at', '>=', $startDate)
            ->whereNotNull('received_at')
            ->whereNotNull('updated_at')
            ->groupBy('hour')
            ->orderBy('hour', 'desc')
            ->get();

        // Log pour le débogage
        \Log::info('Response Times Query', [
            'user_id' => $user->id,
            'project_ids' => $userProjectIds,
            'start_date' => $startDate,
            'count' => $responseTimes->count(),
            'results' => $responseTimes->toArray()
        ]);

        return $this->responseSuccess(null, [
            'response_times' => $responseTimes,
        ]);
    }
}
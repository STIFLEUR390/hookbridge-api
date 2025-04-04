<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\V1\Project> $projects
 * @property-read int|null $projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	final class User extends \Eloquent {}
}

namespace App\Models\V1{
/**
 * 
 *
 * @property int $id
 * @property int $incoming_request_id
 * @property int $project_target_id
 * @property int $attempt_count
 * @property string $status
 * @property int|null $response_code
 * @property string|null $response_body
 * @property \Illuminate\Support\Carbon|null $next_attempt_at
 * @property \Illuminate\Support\Carbon|null $last_attempt_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\V1\IncomingRequest $incomingRequest
 * @property-read \App\Models\V1\ProjectTarget $projectTarget
 * @method static \Database\Factories\V1\DeliveryAttemptFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt useFilters(?string $filterClass = null, ?\Essa\APIToolKit\Filters\DTO\FiltersDTO $filteredDTO = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt whereAttemptCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt whereIncomingRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt whereLastAttemptAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt whereNextAttemptAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt whereProjectTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt whereResponseBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt whereResponseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAttempt whereUpdatedAt($value)
 */
	final class DeliveryAttempt extends \Eloquent {}
}

namespace App\Models\V1{
/**
 * 
 *
 * @property int $id
 * @property int $project_id
 * @property string $type
 * @property string $http_method
 * @property array<array-key, mixed>|null $headers
 * @property array<array-key, mixed>|null $payload
 * @property string $status
 * @property \Illuminate\Support\Carbon $received_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\V1\DeliveryAttempt> $deliveryAttempts
 * @property-read int|null $delivery_attempts_count
 * @property-read \App\Models\V1\Project $project
 * @method static \Database\Factories\V1\IncomingRequestFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest useFilters(?string $filterClass = null, ?\Essa\APIToolKit\Filters\DTO\FiltersDTO $filteredDTO = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereHttpMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereReceivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereUpdatedAt($value)
 */
	final class IncomingRequest extends \Eloquent {}
}

namespace App\Models\V1{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $allowed_domain
 * @property string|null $allowed_subdomain
 * @property string|null $header
 * @property array<array-key, mixed>|null $provider_config
 * @property string|null $uuid
 * @property bool $active
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Enums\ProjectType $type
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\V1\IncomingRequest> $incomingRequests
 * @property-read int|null $incoming_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\V1\ProjectTarget> $projectTargets
 * @property-read int|null $project_targets_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\V1\ProjectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project useFilters(?string $filterClass = null, ?\Essa\APIToolKit\Filters\DTO\FiltersDTO $filteredDTO = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereAllowedDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereAllowedSubdomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProviderConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUuid($value)
 */
	final class Project extends \Eloquent {}
}

namespace App\Models\V1{
/**
 * 
 *
 * @property int $id
 * @property int $project_id
 * @property string $url
 * @property bool $requires_authentication
 * @property string|null $secret
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\V1\DeliveryAttempt> $deliveryAttempts
 * @property-read int|null $delivery_attempts_count
 * @property-read \App\Models\V1\Project $project
 * @method static \Database\Factories\V1\ProjectTargetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectTarget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectTarget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectTarget query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectTarget useFilters(?string $filterClass = null, ?\Essa\APIToolKit\Filters\DTO\FiltersDTO $filteredDTO = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectTarget whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectTarget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectTarget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectTarget whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectTarget whereRequiresAuthentication($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectTarget whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectTarget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectTarget whereUrl($value)
 */
	final class ProjectTarget extends \Eloquent {}
}


<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | API Messages
    |--------------------------------------------------------------------------
    |
    | The following messages are used for API responses.
    |
    */

    // Success messages
    'success' => 'Operation successful',
    'created' => 'Resource created successfully',
    'updated' => 'Resource updated successfully',
    'deleted' => 'Resource deleted successfully',
    'status_changed' => 'Status changed successfully',

    // Error messages
    'not_found' => 'Resource not found',
    'bad_request' => 'Invalid request',
    'unauthorized' => 'Unauthorized',
    'forbidden' => 'Forbidden',
    'validation_error' => 'Validation error',
    'server_error' => 'Server error',

    // Validation messages
    'required' => 'The :attribute field is required',
    'email' => 'The :attribute must be a valid email address',
    'min' => 'The :attribute must be at least :min characters',
    'max' => 'The :attribute may not be greater than :max characters',
    'unique' => 'The :attribute has already been taken',

    // Pagination messages
    'pagination' => [
        'first' => 'First page',
        'last' => 'Last page',
        'next' => 'Next page',
        'previous' => 'Previous page',
    ],
];

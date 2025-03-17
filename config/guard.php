<?php

use App\Guards\AuthGuard;

/**
 *
 * Route Guard Recorder, for your guard to be incorporated into the
 * application, registration is required here
 *
 */
return [
    'auth' => AuthGuard::class,
];

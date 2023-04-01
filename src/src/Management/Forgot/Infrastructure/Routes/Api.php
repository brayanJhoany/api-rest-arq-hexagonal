<?php

namespace Src\Management\Forgot\Infrastructure\Routes;

use Illuminate\Support\Facades\Route;
use Src\Management\Forgot\Infrastructure\Controllers\UserForgotPasswordController;

Route::post('/', UserForgotPasswordController::class);
<?php

use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/sections/{section}', [LandingPageController::class, 'getSection']);

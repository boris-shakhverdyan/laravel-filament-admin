<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/activities', [ActivityController::class, 'index']);
Route::get('/partners', [PartnerController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);

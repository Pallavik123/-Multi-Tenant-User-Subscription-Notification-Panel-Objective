<?php
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UsageController;
use App\Http\Middleware\EnsureUserIsTenant;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum', EnsureUserIsTenant::class])->get('/usage', [UsageController::class, 'index']);


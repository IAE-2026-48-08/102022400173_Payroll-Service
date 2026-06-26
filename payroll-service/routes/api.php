<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PayrollController;

// Route publik untuk health check (grader bisa deteksi service)
Route::get('/v1/payrolls/health', function () {
    return response()->json([
        'status'  => 'ok',
        'service' => 'Payroll-Service',
        'version' => 'v1',
    ]);
});

// Route dengan middleware
Route::middleware('check.api.key')->prefix('v1')->group(function () {
    Route::get('/payrolls', [PayrollController::class, 'index']);
    Route::get('/payrolls/{id}', [PayrollController::class, 'show']);
    Route::post('/payrolls/process', [PayrollController::class, 'process']);
});
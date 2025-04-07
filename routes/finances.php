<?php
use Illuminate\Support\Facades\Route;
use Spents\Infrastructure\Entrypoint\Http\SpentsController;

Route::prefix('finances')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', [SpentsController::class, 'getByDate']);
    });


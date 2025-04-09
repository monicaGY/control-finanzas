<?php

use Category\Infrastructure\Entrypoint\Http\CategoryController;
use Illuminate\Support\Facades\Route;
use Spent\Infrastructure\Entrypoint\Http\SpentController;
use Spents\Infrastructure\Entrypoint\Http\SpentsController;

Route::prefix('finances')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::prefix('spents')
            ->group(function () {
                Route::get('/{year?}/{month?}', [SpentsController::class, 'getByDate'])->name('spents.log.date');
                Route::get('/diagram-month', [SpentsController::class, 'getDiagramSpentsByMonth'])->name('spents.diagram.month');
            });

        Route::prefix('diagram')
            ->group(function () {
                Route::get('/type-spents/{year?}/{month?}', [SpentsController::class, 'getSpentsByType'])->name('diagram.type.spents');
                Route::get('/type-category/{year?}/{month?}', [SpentsController::class, 'getSpentsByCategory'])->name('diagram.type.category');
            });

        Route::prefix('spent')
            ->group(function () {
                Route::post('/', [SpentController::class, 'add'])->name('spent.add');
                Route::put('/{id}', [SpentController::class, 'uploadSpent'])->name('spent.upload');
                Route::delete('/{id}', [SpentController::class, 'deleteSpent'])->name('spent.delete');
            });

        Route::prefix('category')
            ->group(function () {
                Route::get('/all', [CategoryController::class, 'getAllCategories'])->name('category.types');
            });
        });




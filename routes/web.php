<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Category\Infrastructure\Entrypoint\Http\CategoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spents\Infrastructure\Entrypoint\Http\SpentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
*/
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'logSpentsProps' => (new SpentsController())->getByDate(),
        'diagramTypeSpentsProps' => (new SpentsController())->getSpentsByType(),
        'categories' => (new CategoryController())->getAllCategories(),
        'diagramCategorySpentsProps' => (new SpentsController())->getSpentsByCategory()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

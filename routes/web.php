<?php

use App\Http\Controllers\InfoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/start', function () {
    return Inertia::render('Home');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    /*Route::get('/infos', [InfoController::class, 'index'])->name('infos.index');
    Route::get('/infos/create', [InfoController::class, 'create'])->name('infos.create');
    Route::post('/infos/store', [InfoController::class, 'store'])->name('infos.store');
    Route::get('infos/{id}', [InfoController::class, 'show'])->name('infos.show');
*/

    Route::resource('infos', InfoController::class);

});

<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OverlayController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('matches', MatchController::class);

    Route::get('/matches/{match}/control', [MatchController::class, 'control'])
        ->name('matches.control');
 Route::post('/matches/{match}/control-update', [MatchController::class, 'controlUpdate'])
    ->name('matches.control-update');
    Route::resource('teams', TeamController::class);
  Route::get('/overlay-config', [OverlayController::class, 'index'])
    ->name('overlay.index');

Route::get('/overlay-config/{match}', [OverlayController::class, 'edit'])
    ->name('overlay.edit');

Route::put('/overlay-config/{match}', [OverlayController::class, 'update'])
    ->name('overlay.update');

Route::post('/overlay-config/{match}/toggle-live', [OverlayController::class, 'toggleLive'])
    ->name('overlay.toggle-live');
    Route::get('/overlay-config/{match}/select-sport', [OverlayController::class, 'selectSport'])
    ->name('overlay.select-sport');

Route::post('/overlay-config/{match}/select-sport', [OverlayController::class, 'updateSport'])
    ->name('overlay.update-sport');

Route::get('/overlay-config/{match}/select-template', [OverlayController::class, 'selectTemplate'])
    ->name('overlay.select-template');

Route::post('/overlay-config/{match}/apply-template/{template}', [OverlayController::class, 'applyTemplate'])
    ->name('overlay.apply-template');
    Route::get('/overlay-config/{match}/preview', [OverlayController::class, 'preview'])
    ->name('overlay.preview');
});
Route::get('/overlay/{match}/render', [OverlayController::class, 'render'])
    ->name('overlay.render');

Route::middleware('auth')->prefix('profile')->group(function () {

    Route::get('/', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::patch('/theme', [ProfileController::class, 'updateTheme'])
        ->name('profile.theme');

    Route::put('/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');

    Route::post('/logout-other-devices', [ProfileController::class, 'logoutOtherDevices'])
        ->name('profile.logout-devices');

    Route::delete('/', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
Route::resource('players', PlayerController::class)
    ->middleware('auth');
require __DIR__.'/auth.php';
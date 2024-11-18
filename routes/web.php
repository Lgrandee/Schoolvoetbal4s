<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\TournamentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/stand', [MatchController::class, 'showTeams'])->name('stand');

Route::get('/bracket', [MatchController::class, 'showBracket'])->name('bracket');

Route::get('/admin', [MatchController::class, 'index'])->name('admin');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/assign-referee/{game}', [MatchController::class, 'assignReferee'])->name('assign.referee');
    Route::post('/games/{gameId}/update-scores', [MatchController::class, 'updateGameScores'])->name('games.updateScores');
});

Route::get('/coach', [MatchController::class, 'showCoachForm'])->name('coach')->middleware('admin_or_coach');
Route::post('/coach', [MatchController::class, 'storeTeam'])->name('coach.store')->middleware('admin_or_coach');

Route::get('/tournament/create', [TournamentController::class, 'create'])->name('tournament.create')->middleware('admin');
Route::post('/tournament', [TournamentController::class, 'store'])->name('tournament.store')->middleware('admin');

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\TeamController;
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

Route::get('/coach', [MatchController::class, 'showCoachForm'])->name('coach');
Route::post('/coach', [MatchController::class, 'storeTeam'])->name('coach.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/tournament/create', [TournamentController::class, 'create'])->name('tournament.create')->middleware('admin');
    Route::post('/tournament', [TournamentController::class, 'store'])->name('tournament.store')->middleware('admin');
    Route::get('/tournament/{tournament}/edit', [TournamentController::class, 'edit'])->name('tournament.edit')->middleware('admin');
    Route::put('/tournament/{tournament}', [TournamentController::class, 'update'])->name('tournament.update')->middleware('admin');
    Route::delete('/tournament/{tournament}', [TournamentController::class, 'destroy'])->name('tournament.destroy')->middleware('admin');
    Route::get('/tournament/{tournament}', [TournamentController::class, 'show'])->name('tournament.show');
    Route::get('/tournament/{tournament}/bracket', [TournamentController::class, 'showBracket'])->name('tournament.bracket');
    Route::post('/tournament/{tournament}/signup', [TournamentController::class, 'signupTeam'])->name('tournament.signup');
    Route::post('/tournament/{tournament}/start', [TournamentController::class, 'startTournament'])->name('tournament.start')->middleware('admin');
    Route::post('/tournament/{tournament}/add-team', [TournamentController::class, 'addTeam'])->name('tournament.addTeam')->middleware('admin');
    Route::post('/tournament/{tournament}/add-referee', [TournamentController::class, 'addReferee'])->name('tournament.addReferee')->middleware('admin');
    Route::post('/tournament/{tournament}/advance/{team}', [TournamentController::class, 'advance'])->name('tournament.advance');
});

Route::get('brackets', [MatchController::class, 'showBrackets'])->name('brackets');

Route::get('/', [TeamController::class, 'showHome'])->name('home');

Route::get('/coach/edit', [MatchController::class, 'showEditTeamForm'])->name('coach.edit')->middleware('auth');

Route::get('/match/{match}/details', [MatchController::class, 'showDetails'])->name('match.details');

Route::middleware(['auth', 'referee'])->group(function () {
    Route::put('/match/{game}/scores', [MatchController::class, 'updateMatchScores'])->name('match.update-scores');
    Route::post('/match/{game}/goals', [MatchController::class, 'storeGoal'])->name('match.record-goal');
});

Route::get('/leaderboard', [TeamController::class, 'leaderboard'])->name('leaderboard');

require __DIR__.'/auth.php';

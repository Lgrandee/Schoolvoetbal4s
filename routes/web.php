<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MatchController;
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

Route::get('/stand', function () {
    return view('stand');
})->name('stand');

Route::get('/bracket', function () {
    return view('bracket');
})->name('bracket');


Route::get('/admin', [MatchController::class, 'index'])->name('admin');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');
    Route::get('/admin', [MatchController::class, 'index'])->name('admin');
    Route::post('/assign-referee/{game}', [MatchController::class, 'assignReferee'])->name('assign.referee');
});

Route::get('/referee', [MatchController::class, 'showRefereeForm'])->name('referee')->middleware('admin_or_referee');
Route::post('/referee', [MatchController::class, 'storeTeam'])->name('referee.store')->middleware('admin_or_referee');

require __DIR__.'/auth.php';

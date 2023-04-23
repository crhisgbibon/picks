<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WC2022\ControllerWC2022;

use App\Http\Controllers\NFL_Playoffs_2022\ControllerNFL_Playoffs_2022;

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
});

Route::get('/wc2022', function(){
  return redirect('/wc2022/input');
});

Route::controller(ControllerWC2022::class)->group(function () {
  Route::get('/wc2022/input', 'index')->middleware(['auth', 'verified'])->name('wc2022Input');
  Route::post('/wc2022/SaveScores', 'SaveScores')->middleware(['auth', 'verified'])->name('wc2022SaveScores');
  Route::get('/wc2022/table', 'GetTable')->middleware(['auth', 'verified'])->name('wc2022Table');

  Route::post('/wc2022/CSV', 'GetCSV')->middleware(['auth', 'verified'])->name('wc2022GetCSV');
});

Route::get('/playoffs22', function(){
  return redirect('/playoffs22/input');
});

Route::controller(ControllerNFL_Playoffs_2022::class)->group(function () {
  Route::get('/playoffs22/input', 'index')->middleware(['auth', 'verified'])->name('nflplayoffs2022index');
  Route::post('/playoffs22/SaveScores', 'SaveScores')->middleware(['auth', 'verified'])->name('nflplayoffs2022SaveScores');

  Route::get('/playoffs22/table', 'GetTable')->middleware(['auth', 'verified'])->name('nflplayoffs2022GetTable');

  Route::get('/playoffs22/rules', 'rules')->middleware(['auth', 'verified'])->name('nflplayoffs2022rules');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

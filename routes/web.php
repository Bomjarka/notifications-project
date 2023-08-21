<?php

use App\Http\Controllers\WEB\GoalController;
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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(static function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/{user}/goals', [GoalController::class, 'index'])->name('web.user.goals.index');
    Route::get('/{user}/goals/{goal}', [GoalController::class, 'show'])->name('web.user.goal.show');
});




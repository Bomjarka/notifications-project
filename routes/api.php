<?php

use App\Http\Controllers\API\GoalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/goals', [GoalController::class, 'index'])->name('api.goals.index');
Route::post('/goals', [GoalController::class, 'store'])->name('api.goals.store');
Route::get('/goals/{goal}', [GoalController::class, 'show'])->name('api.goal.show');
Route::delete('/goals/{goal}', [GoalController::class, 'delete'])->name('api.goal.delete');
Route::put('/goals/{goal}', [GoalController::class, 'update'])->name('api.goal.update');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\AchievementController;
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
Route::post('/goal', [GoalController::class, 'createGoal']);
Route::get('/goalList', [GoalController::class, 'getGoalList']);
// API接続テスト用
Route::get('/goal/test', [GoalController::class, 'test']);

Route::post('/achievement', [AchievementController::class, 'recordAchievement']);
Route::get('/achievement/{id}', [AchievementController::class, 'getAchievement']);
Route::get('/achievementList', [AchievementController::class, 'getAchievementList']);

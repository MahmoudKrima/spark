<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\Investment\InvetmentController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/my-profile', [ProfileController::class, 'profile']);
    Route::post('/update-profile', [ProfileController::class, 'updateProfile']);
    Route::post('/investment', [InvetmentController::class, 'invetmentInfo']);
    Route::post('/user-expense', [InvetmentController::class, 'dailyExspense']);
    Route::get('/user-all-expenses', [InvetmentController::class, 'getUserExpenses']);
    Route::get('/user-static-expenses', [InvetmentController::class, 'expensesStatics']);
    Route::get('/all-categories', [InvetmentController::class, 'allCategores']);

});

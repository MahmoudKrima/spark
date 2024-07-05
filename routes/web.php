<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\UserExpenses\UserExpensesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|*/

Route::get('/', [AuthController::class, 'index'])
    ->name('auth.index')
    ->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])
    ->name('auth.login');

Route::group([
    'middleware' => ['auth', 'admin']
], function () {
    Route::get('/home', [HomeController::class, 'home'])
        ->name('admin.home');
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('auth.logout');
    Route::controller(ProfileController::class)
        ->group(function () {
            Route::get('/update-profile', 'index')
                ->name('admin.profile');
            Route::post('/update-profile', 'update')
                ->name('admin.update_profile');
        });

        Route::controller(CategoryController::class)
        ->group(function () {
            Route::get('/categories', 'index')
                ->name('categories.index');
            Route::get('/categories/create', 'create')
                ->name('categories.create');
            Route::post('/categories/store', 'store')
                ->name('categories.store');
            Route::get('/categories/{category}/edit', 'edit')
                ->name('categories.edit');
            Route::post('/categories/{category}/update', 'update')
                ->name('categories.update');
            Route::delete('/categories-delete/{category}', 'destroy')
                ->name('categories.destroy');
        });

        Route::controller(UserController::class)
        ->group(function () {
            Route::get('/users', 'index')
                ->name('users.index');
            Route::get('/users/create', 'create')
                ->name('users.create');
            Route::post('/users/store', 'store')
                ->name('users.store');
            Route::get('/users/{id}/edit', 'edit')
                ->name('users.edit');
            Route::post('/users/{id}/update', 'update')
                ->name('users.update');
            Route::delete('/users-delete/{id}', 'destroy')
                ->name('users.destroy');
        });

        Route::controller(UserExpensesController::class)
        ->group(function () {
            Route::get('/users/expenses', 'index')
                ->name('users.expenses.index');
        });
});


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('project/{projectId}', [ProjectController::class, 'show'])->name('project.show');
Route::post('project', [ProjectController::class, 'create'])->name('project.create');
Route::put('project', [ProjectController::class, 'update'])->name('project.update');
Route::delete('project', [ProjectController::class, 'delete'])->name('project.delete');
Route::get('TechSet', [TechsetController::class, 'list'])->name('TechSet.list');
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('user', [UserController::class, 'show'])->name('user.show');
Route::post('user', [UserController::class, 'create'])->name('user.create');
Route::put('user', [UserController::class, 'update'])->name('user.update');
Route::delete('user', [UserController::class, 'delete'])->name('user.delete');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');
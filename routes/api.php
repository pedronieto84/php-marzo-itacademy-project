<?php

use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TechsetController;

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
Route::get('project/{project}', [ProjectController::class, 'show'])->name('project.show');
Route::post('project', [ProjectController::class, 'create'])->name('project.create');
Route::put('project/{project}', [ProjectController::class, 'update'])->name('project.update');
Route::delete('project/{project}', [ProjectController::class, 'delete'])->name('project.delete');
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('user/{userId}', [UserController::class, 'show'])->name('user.show');
Route::post('user', [UserController::class, 'create'])->name('user.create');
Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('user/{user}', [UserController::class, 'delete'])->name('user.delete');
Route::get('techSet', [TechsetController::class, 'index'])->name('techSet.index');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('file/{file}', [FileController::class, 'get'])->name('file.get');
Route::get('file/{file}/download', [FileController::class, 'get'])->name('file.download');
// Route::get('downloadDocument', [FileController::class, 'download'])->name('downloadDocument.download');
// Route::post('uploadDocument', [FileController::class, 'upload'])->name('uploadDocument.upload');
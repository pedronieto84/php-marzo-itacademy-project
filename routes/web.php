<?php


use App\Http\Controllers\TechsetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
// Route::get('project/{project}', [ProjectController::class, 'show'])->name('project.show');
// Route::post('project', [ProjectController::class, 'create'])->name('project.create');
// Route::put('project', [ProjectController::class, 'update'])->name('project.update');


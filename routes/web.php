<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
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

Route::view('/','welcome');

// Tasks Route
Route::resource('tasks', TaskController::class);
Route::get('/archiveTasks', [TaskController::class, 'archiveTask'])->name('archiveTask');
Route::get('/restoreTasks/{id}', [TaskController::class, 'restoreTask'])->name('restoreTask');
Route::delete('/forceDeleteTask/{id}', [TaskController::class, 'deleteTask'])->name('deleteTask');

// Authentication routes
Auth::routes(['register'=>false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::get('/', [TaskController::class, 'index']);
Route::get('/edit', [TaskController::class, 'edit']);
Route::post('/create', [TaskController::class, 'create']);
Route::post('/update', [TaskController::class, 'update']);
Route::post('/delete', [TaskController::class, 'delete']);
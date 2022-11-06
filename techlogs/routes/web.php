<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\LogsController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard', [App\Http\Controllers\LogsController::class, 'dashboard'])->middleware(['auth']);


Route::get('/addLog', [App\Http\Controllers\LogsController::class, 'index'])->middleware(['auth']);
Route::get('/addData', [App\Http\Controllers\DataController::class, 'index'])->middleware(['auth']);
Route::get('/data', [App\Http\Controllers\DataController::class, 'getData'])->middleware(['auth']);
Route::get('/data/{id}', [App\Http\Controllers\DataController::class, 'getById'])->middleware(['auth']);
Route::post('/data/{id}', [App\Http\Controllers\DataController::class, 'update'])->middleware(['auth']);
Route::post('/delete/data/{id}', [App\Http\Controllers\DataController::class, 'delete'])->middleware(['auth']);

Route::get('/addUser', [App\Http\Controllers\UserController::class, 'index'])->middleware(['auth']);
Route::get('/users', [App\Http\Controllers\UserController::class, 'viewUsers'])->name('viewUsers')->middleware(['auth']);
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'singleUser'])->middleware(['auth']);
Route::post('/user/{id}', [App\Http\Controllers\UserController::class, 'deleteUser'])->middleware(['auth']);

Route::get('/logs', [App\Http\Controllers\LogsController::class, 'view'])->middleware(['auth']);
Route::get('/logs/id/{id}', [App\Http\Controllers\LogsController::class, 'show'])->middleware(['auth']);
Route::post('/logs/id', [App\Http\Controllers\LogsController::class, 'update'])->middleware(['auth']);

Route::post('/addLog', [App\Http\Controllers\LogsController::class, 'store'])->middleware(['auth']);
Route::post('/addData', [App\Http\Controllers\DataController::class, 'store'])->middleware(['auth']);

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile')->middleware(['auth']);
Route::get('/profile/{id}', [App\Http\Controllers\UserController::class, 'profileId'])->name('profileId')->middleware(['auth']);
Route::post('/profile/{id}', [App\Http\Controllers\UserController::class, 'changePass'])->middleware(['auth']);

Route::post('/addUser', [App\Http\Controllers\UserController::class, 'store'])->middleware(['auth']);

Route::get('/notifications', [App\Http\Controllers\NoteController::class, 'index'])->name('notif')->middleware(['auth']);
Route::get('/notifications/{id}', [App\Http\Controllers\NoteController::class, 'viewNotes'])->middleware(['auth']);
Route::get('/note/{id}', [App\Http\Controllers\NoteController::class, 'singleNote'])->middleware(['auth']);


Route::get('/chart/data', [App\Http\Controllers\LogsController::class, 'chartData'])->middleware(['auth']);

require __DIR__.'/auth.php';

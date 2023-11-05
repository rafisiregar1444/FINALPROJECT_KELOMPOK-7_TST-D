<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\PenyelenggaraController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);

});

// Route::get('/home', function () {
//     return redirect('/dashboard');
// });

// Route::middleware(['auth'])->group(function (){
//     Route::get('/dashboard', [DashboardController::class, 'index']);
//     Route::get('/dashboard', [DashboardController::class, 'admin'])->middleware('userAkses:admin');
//     Route::get('/dashboard', [DashboardController::class, 'user'])->middleware('userAkses:user');
//     Route::get('/logout', [SesiController::class, 'logout']);
//     Route::get('/test', [DashboardController::class, 'test']);
// });

// Route::resource('penyelenggara', PenyelenggaraController::class);

// Route::get('/test', [DashboardController::class, 'test']);
Route::get('/listbp', [PenyelenggaraController::class, 'list']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/logout', [SesiController::class, 'logout']);

Route::get('crud-yys', [PenyelenggaraController::class, 'index']);
Route::post('store-yys', [PenyelenggaraController::class, 'store']);
Route::post('edit-yys', [PenyelenggaraController::class, 'edit']);
Route::post('delete-yys', [PenyelenggaraController::class, 'destroy']);
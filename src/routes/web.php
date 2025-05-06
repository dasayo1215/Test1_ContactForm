<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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

Route::get('/', [ContactController::class, 'index'])->name('index');
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/fix',[ContactController::class, 'fix']);
Route::post('/', [ContactController::class, 'store']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/admin', [AuthController::class, 'admin'])->middleware('auth')->name('admin');
Route::get('/admin/search', [AuthController::class, 'search'])->name('search');
Route::get('/admin/export', [AuthController::class, 'export'])->name('export');
Route::delete('/admin/delete/{id}', [AuthController::class, 'delete'])->name('delete');

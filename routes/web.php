<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
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


Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login',[AuthController::class, 'showLogin'])->name('show.login');
Route::post('/login',[AuthController::class, 'login'])->name('login');


Route::get('/', function () {
    return view('auth.login');
});


Route::get('/sample', function () {
    return view('sample');
})->name('sample');

<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InventoryController;
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


Route::get('/bookings', [ReservationController::class, 'index'])->name('bookings.index');
Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
Route::get('/billings', [PaymentController::class, 'index'])->name('billings.index');
Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');
Route::get('/',[AuthController::class, 'showLogin'])->name('show.login');
Route::post('/login',[AuthController::class, 'login'])->name('login');

Route::get('dashboard', function(){
    return view('dashboard');
})->name('dashboard');

Route::get('/', function () {
    return view('auth.login');
});

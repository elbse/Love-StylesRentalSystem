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

Route::middleware('auth')->group(function () {
    Route::get('/bookings', [ReservationController::class, 'index'])->name('bookings.index');
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
    Route::get('/billings', [PaymentController::class, 'index'])->name('billings.index');
    Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{customer_id}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{customer_id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{customer_id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer_id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::post('/customers/deactivate', [CustomerController::class, 'destroy'])->name('customers.deactivate');
    
});



Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register')->middleware('guest');
Route::get('/login',[AuthController::class, 'showLogin'])->name('show.login')->middleware('guest');
Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/', function () {
    return view('auth.login');
});

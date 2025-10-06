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
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Bookings
    Route::get('/bookings', [ReservationController::class, 'index'])->name('bookings.index');
    
    // Rentals
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
    
    // Release (new route)
    Route::get('/release', function () {
        return view('releases.index');
    })->name('release.index');
    
    // Return (new route)
    Route::get('/return', function () {
        return view('returns.index');
    })->name('return.index');
    
    // Billing
    Route::get('/billing', [PaymentController::class, 'index'])->name('billing.index');
    
    // Inventory
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    
    // Customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{customer_id}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{customer_id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{customer_id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer_id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::post('/customers/deactivate', [CustomerController::class, 'deactivate'])->name('customers.deactivate');
    Route::post('/customers/reactivate', [CustomerController::class, 'reactivate'])->name('customers.reactivate');
});



Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register')->middleware('guest');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('auth.login');
});

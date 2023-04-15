<?php

use App\Http\Controllers\BasketBallCourtsController;
use App\Http\Controllers\BasketBallCourtsOrderController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\JoinReqController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\loginController;
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
// Mengelompokkan agar hanya user dengan role admin yang dapat mengakses halaman role admin
Route::middleware(['auth', 'role:admin'])->group(function () 
{

    // Route Untuk Menampilkan Halaman HomePage Admin
    Route::get('/basketball-courts', [BasketBallCourtsController::class, 'index'])->name('basketball-courts.index');

    // Route Untuk Menampilkan Halaman Tambah Lapangan pada Admin
    Route::get('/basketball-courts/create', [BasketBallCourtsController::class, 'create'])->name('basketball-courts-create.create');
    
    // Route untuk melakukan post daftar lapangan oleh admin
    Route::post('/basketball-courts', [BasketBallCourtsController::class, 'store'])->name('basketball-courts.store');
    
    // Route untuk melakukan menuju ke page update data lapangan
    Route::get('/basketball-courts/{court}/edit', [BasketBallCourtsController::class, 'edit'])->name('basketball-courts.edit');
    
    // Route untuk melakukan update kepada data lapangan
    Route::put('/basketball-courts/{court}', [BasketBallCourtsController::class, 'update'])->name('basketball-courts.update');
    
    // Route untuk menghapus lapangan yang ada di daftar lapangan
    Route::delete('/basketball-courts/{court}', [BasketBallCourtsController::class, 'destroy'])->name('basketball-courts.destroy');
    
});


Route::middleware(['auth', 'role:admin'])->group(function () 
{

    // Route Untuk Menampilkan Halaman Daftar lapangan yang sedang Dipesan
    Route::get('/basketball-courts-order', [BasketBallCourtsOrderController::class, 'index'])->name('basketball-courts-create.index');

});

Route::middleware(['auth', 'role:admin'])->group(function () 
{

    // Route Untuk Melakukan Log Out Admin
    Route::post('/logoutAdmin', [LoginController::class, 'logout'])->name('logoutAdmin');

});


// Mengelompokkan agar hanya user dengan role player yang dapat mengakses halaman role admin
Route::middleware(['auth', 'role:player'])->group(function () 
{
    // Route Untuk Menampilkan Halaman Hompage Player
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');

    //  Route untuk menyelesaikan permainan
    Route::put('/booking', [BookingController::class, 'done'])->name('booking.done');
    
    //  Route untuk mengarahkan user ke halaman pemesanan
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    
    // Route untuk melakukan post pemesanan user
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

});

// Mengelompokkan agar hanya user dengan role player yang dapat mengakses halaman role admin
Route::middleware(['auth', 'role:player'])->group(function () 
{
    
     // Route untuk mengarahkan user ke page join player
     Route::get('/join', [JoinController::class, 'index'])->name('join.index');
    
     // Route untuk mengarahkan user ke halaman untuk mengisi form join
     Route::get('/join/order_id={order}/create', [JoinController::class, 'create'])->name('join.create');
     
     // Route untuk melakukan join kepada lapangan yang telah dipesan
     Route::post('/join', [JoinController::class, 'store'])->name('join.store');

});

// Mengelompokkan agar hanya user dengan role player yang dapat mengakses halaman role admin
Route::middleware(['auth', 'role:player'])->group(function () 
{
    
    // Route untuk mengarahkan user ke halaman join request
    Route::get('/join-req', [JoinReqController::class, 'index'])->name('join-req.index');

    // Route untuk menerima agar player bisa join
    Route::put('/join-req/{id}/accept', [JoinReqController::class, 'accept'])->name('join-req.accept');
    
    // Route untuk menerima agar player menolak bisa join
    Route::put('/join-req/{id}/reject', [JoinReqController::class, 'reject'])->name('join-req.reject');

});


// Mengelompokkan agar hanya user dengan role player yang dapat mengakses halaman role admin
Route::middleware(['auth', 'role:player'])->group(function () 
{
    
    // Route Untuk Melakukan Log Out Player
    Route::post('/logoutPlayer', [LoginController::class, 'logout'])->name('logoutPlayer');

});

// Route Untuk Menampilkan Halaman Login
Route::get('/', [LoginController::class, 'login'])->name('login');

// Route Untuk Melakukan autentikasi saat user melakukan login
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
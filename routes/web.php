<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

// ------------------------------------
// ROUTE AUTH ADMIN
// ------------------------------------
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.store');
Route::get('/admin/register', [AuthController::class, 'showAdminRegister'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'adminRegister'])->name('admin.register.store');
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth')->name('admin.logout');
Route::get('/login', [AuthController::class, 'showUserLogin'])->name('user.login');
Route::post('/login', [AuthController::class, 'userLogin'])->name('user.login.store');
Route::get('/register', [AuthController::class, 'showUserLogin'])->name('user.register');
Route::post('/register', [AuthController::class, 'userRegister'])->name('user.register.store');
Route::post('/logout', [AuthController::class, 'userLogout'])->middleware('auth')->name('user.logout');

// ------------------------------------
// ROUTE PELANGGAN / GUEST (Katalog & PO)
// ------------------------------------
Route::get('/', [OrderController::class, 'landing'])->name('landing');
Route::get('/menu', [OrderController::class, 'menu'])->name('menu.index');
Route::middleware('auth')->group(function () {
    Route::get('/siswa', [OrderController::class, 'siswa'])->name('siswa.dashboard');
    Route::get('/siswa/pesanan', [OrderController::class, 'pesananSaya'])->name('siswa.pesanan');
    Route::get('/siswa/lacak', [OrderController::class, 'lacak'])->name('siswa.lacak');
});
Route::get('/katalog', [OrderController::class, 'catalog'])->name('pelanggan.katalog');
Route::post('/po/checkout', [OrderController::class, 'storePo'])->name('order.storePo');
Route::post('/po/lacak', [OrderController::class, 'track'])->name('order.track');
Route::get('/po/status/{kode}', [OrderController::class, 'showStatus'])->name('order.status');

// ------------------------------------
// ROUTE KASIR (POS Live & Shift)
// ------------------------------------
Route::prefix('kasir')->group(function () {
    Route::get('/pos', [PosController::class, 'index'])->name('kasir.pos');
    Route::post('/pos/checkout', [PosController::class, 'store'])->name('kasir.pos.store');

    Route::get('/shift', [ShiftController::class, 'index'])->name('kasir.shift');
    Route::post('/shift/open', [ShiftController::class, 'openShift'])->name('kasir.shift.open');
    Route::post('/shift/close/{id}', [ShiftController::class, 'closeShift'])->name('kasir.shift.close');
});

// ------------------------------------
// ROUTE ADMIN (Kelola Menu & Monitoring PO)
// ------------------------------------
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu.index');
    Route::post('/menu/store', [MenuController::class, 'store'])->name('admin.menu.store');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
    Route::patch('/menu/toggle/{id}', [MenuController::class, 'toggleActive'])->name('admin.menu.toggle');
    Route::patch('/menu/quota/{id}', [MenuController::class, 'updateQuota'])->name('admin.menu.quota');

    Route::get('/po', [OrderController::class, 'adminIndex'])->name('admin.po.index');
    Route::patch('/po/status/{id}', [OrderController::class, 'updateStatus'])->name('admin.po.updateStatus');
});

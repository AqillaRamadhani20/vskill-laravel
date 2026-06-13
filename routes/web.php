<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\VSkillController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VSkillController::class, 'home'])->name('home');
Route::get('/tentang', [VSkillController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [VSkillController::class, 'kontak'])->name('kontak');
Route::get('/dashboard', [VSkillController::class, 'dashboard'])->name('dashboard');
Route::get('/detail-jasa/{service}', [VSkillController::class, 'detail'])->name('detail');

Route::get('/login', [VSkillController::class, 'loginForm'])->name('login');
Route::post('/login', [VSkillController::class, 'login'])->name('login.process');
Route::get('/register', [VSkillController::class, 'registerForm'])->name('register');
Route::post('/register', [VSkillController::class, 'register'])->name('register.process');
Route::post('/logout', [VSkillController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [VSkillController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/edit', [VSkillController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile/{user}', [VSkillController::class, 'profile'])->name('profile.view');

    Route::get('/jadi-penyedia', [VSkillController::class, 'jadiPenyediaForm'])->name('jadi-penyedia');
    Route::post('/jadi-penyedia', [VSkillController::class, 'jadiPenyedia'])->name('jadi-penyedia.process');

    Route::get('/service/create', [VSkillController::class, 'createService'])->name('service.create');
    Route::post('/service', [VSkillController::class, 'storeService'])->name('service.store');
    Route::get('/service/{service}/edit', [VSkillController::class, 'editService'])->name('service.edit');
    Route::post('/service/{service}', [VSkillController::class, 'updateService'])->name('service.update');
    Route::delete('/service/{service}', [VSkillController::class, 'deleteService'])->name('service.delete');

    Route::get('/portfolio/create', [VSkillController::class, 'portfolioCreate'])->name('portfolio.create');
    Route::post('/portfolio', [VSkillController::class, 'portfolioStore'])->name('portfolio.store');
    Route::get('/portfolio/{portfolio}/edit', [VSkillController::class, 'portfolioEdit'])->name('portfolio.edit');
    Route::post('/portfolio/{portfolio}', [VSkillController::class, 'portfolioUpdate'])->name('portfolio.update');
    Route::delete('/portfolio/{portfolio}', [VSkillController::class, 'portfolioDelete'])->name('portfolio.delete');

    Route::get('/order/{service}', [VSkillController::class, 'orderForm'])->name('order.create');
    Route::post('/order/{service}', [VSkillController::class, 'orderStore'])->name('order.store');
    Route::get('/pesanan-saya', [VSkillController::class, 'pesananSaya'])->name('pesanan');
    Route::get('/order-masuk', [VSkillController::class, 'orderMasuk'])->name('order.masuk');
    Route::get('/order-detail/{order}', [VSkillController::class, 'orderDetail'])->name('order.detail');
    Route::post('/order-status/{order}', [VSkillController::class, 'orderStatus'])->name('order.status');
    Route::get('/order-struk/{order}', [VSkillController::class, 'downloadStruk'])->name('order.struk');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/{user}/toggle-role', [AdminController::class, 'toggleUserRole'])->name('users.toggle-role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

    Route::get('/services', [AdminController::class, 'services'])->name('services');
    Route::post('/services/{service}/toggle-status', [AdminController::class, 'toggleServiceStatus'])->name('services.toggle-status');
    Route::delete('/services/{service}', [AdminController::class, 'deleteService'])->name('services.delete');

    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');

    Route::get('/export/pdf/ringkasan', [AdminController::class, 'exportPdfRingkasan'])->name('export.pdf.ringkasan');
    Route::get('/export/pdf/order', [AdminController::class, 'exportPdfOrder'])->name('export.pdf.order');
    Route::get('/export/excel/order', [AdminController::class, 'exportExcelOrder'])->name('export.excel.order');
    Route::get('/export/excel/user', [AdminController::class, 'exportExcelUser'])->name('export.excel.user');
});

Route::redirect('/index.php', '/');
Route::redirect('/dashboard.php', '/dashboard');
Route::redirect('/login.php', '/login');
Route::redirect('/register.php', '/register');
Route::redirect('/tentang.php', '/tentang');
Route::redirect('/kontak.php', '/kontak');

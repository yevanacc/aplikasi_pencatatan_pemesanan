<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranAdminController;
use App\Http\Controllers\pemesananAdminController;
use App\Http\Controllers\JenisCetakanController;
use App\Http\Controllers\PemesananProduksiController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PemesananPemilikController;
use App\Http\Controllers\PembayaranPemilikController;
use App\Http\Controllers\JenisCetakanPemilikController;
use App\Http\Controllers\viewPDFPemilikController;
use App\Http\Controllers\LaporanPemilikController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pemilik.dashboard.index');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('/dashboardAdmin', AdminController::class);
Route::resource('/dashboardProduksi', ProduksiController::class);
Route::resource('/pemesanan', PemesananAdminController::class);
Route::get('/pemesanan/download-nota/{id}', [PDFController::class, 'generateNotaPemesananPDF'])->name('pemesanan.downloadNota');
Route::resource('/pembayaran', PembayaranAdminController::class);
Route::resource('/laporan', LaporanController::class);
Route::resource('/laporanPemilik', LaporanPemilikController::class);
Route::resource('/pemesananPemilik', PemesananPemilikController::class);
Route::resource('/pembayaranPemilik', PembayaranPemilikController::class);
Route::resource('/jenisCetakanPemilik', JenisCetakanPemilikController::class);
Route::get('/laporanPemilik/generatePemesanan/{year}/{month}', [viewPDFPemilikController::class, 'generatePemesananPDF'])->name('laporanPemilik.generatePemesananPDF');
Route::get('/laporanPemilik/generatePembayaran/{year}/{month}', [viewPDFPemilikController::class, 'generatePembayaranPDF'])->name('laporanPemilik.generatePembayaranPDF');
Route::get('/laporan/pemesanan/{year}/{month}', [LaporanController::class, 'showPemesanan'])->name('laporan.showPemesanan');
Route::get('/laporan/pembayaran/{year}/{month}', [LaporanController::class, 'showPembayaran'])->name('laporan.showPembayaran');
Route::get('/laporanPemilik/pemesanan/{year}/{month}', [LaporanPemilikController::class, 'showPemesanan'])->name('laporanPemilik.showPemesanan');
Route::get('/laporanPemilik/pembayaran/{year}/{month}', [LaporanPemilikController::class, 'showPembayaran'])->name('laporanPemilik.showPembayaran');
// Route::get('/laporan/pemesanan/export/{year}/{month}', [LaporanController::class, 'exportPemesanan']);
// Route::get('/laporan/pembayaran/export/{year}/{month}', [LaporanController::class, 'exportPembayaran']);
// Route::get('/generate-pdf/{year}/{month}', [PDFController::class, 'generatePDF'])->name('generate.pdf');
Route::get('/laporan/generatePemesanan/{year}/{month}', [PDFController::class, 'generatePemesananPDF'])->name('laporan.generatePemesananPDF');
Route::get('/laporan/generatePembayaran/{year}/{month}', [PDFController::class, 'generatePembayaranPDF'])->name('laporan.generatePembayaranPDF');
Route::post('/markAsRead', [NotificationController::class, 'markAsRead'])->name('markAsRead');



Route::resource('/jenisCetakan', JenisCetakanController::class);

// routes/web.php

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/dashboardAdmin', AdminController::class);
    Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::get('/admin/notifications/create/{id}', [NotificationController::class, 'create'])->name('admin.notifications.create');
    Route::get('/admin/notifications/{id}', [NotificationController::class, 'show'])->name('admin.notifications.show');
    Route::get('/admin/notifications/{id}/edit', [NotificationController::class, 'edit'])->name('admin.notifications.edit');
    Route::post('/admin/notifications', [NotificationController::class, 'store'])->name('admin.notifications.store');
    Route::patch('/admin/notifications/{id}', [NotificationController::class, 'update'])->name('admin.notifications.update');
    Route::delete('/admin/notifications/{id}', [NotificationController::class, 'destroy'])->name('admin.notifications.destroy');
    Route::patch('/admin/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.read');
});

require __DIR__ . '/auth.php';

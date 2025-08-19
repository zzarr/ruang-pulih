<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisKasusController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonitoringController;

// Halaman login
Route::get('/masuk', [AuthController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

// Proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/daftar', [AkunController::class, 'register'])->name('register');
Route::post('/daftar', [AkunController::class, 'storeRegister'])->name('register.store');

// Proses logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/jenis-kasus/data', [JenisKasusController::class, 'data'])->name('jenis-kasus.data');
// web.php
Route::post('/konsultasi/store', [KonsultasiController::class, 'store'])->name('konsultasi.store');

Route::get('/konsultasi/{id}', [KonsultasiController::class, 'showChat'])->name('konsultasi.show');
Route::post('/konsultasi/{id}/send', [KonsultasiController::class, 'send'])->name('konsultasi.send');

Route::group(
    [
        'middleware' => ['auth', 'role:admin'],
        'prefix' => 'admin',
        'as' => 'admin.',
    ],
    function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        // routes/web.php
        Route::prefix('admin/monitoring')
            ->name('monitoring.')
            ->group(function () {
                Route::get('/tindak', [MonitoringController::class, 'tindak'])->name('tindak');
                Route::put('/tindak/{id}', [MonitoringController::class, 'update_tindak'])->name('update_tindak');
                Route::get('/konsultasi', [MonitoringController::class, 'konsultasi'])->name('konsultasi');
            });

        Route::group(['prefix' => 'laporan', 'as' => 'laporan.'], function () {
            Route::get('/', [ReportController::class, 'index'])->name('index');
            Route::put('/validasi/{id}', [ReportController::class, 'validasi'])->name('validasi');
            Route::get('/penugasan', [ReportController::class, 'penugasan'])->name('penugasan');
            Route::post('/penugasan/store', [ReportController::class, 'storePenugasan'])->name('penugasan.store');
        });

        Route::group(['prefix' => 'akun', 'as' => 'akun.'], function () {
            Route::get('/', [AkunController::class, 'index'])->name('index');
            Route::post('/store', [AkunController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [AkunController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AkunController::class, 'update'])->name('update');
            Route::delete('/{id}', [AkunController::class, 'destroy'])->name('destroy');
        });
    },
);

Route::group(
    [
        'middleware' => ['auth', 'role:konselor'],
        'prefix' => 'konselor',
        'as' => 'konselor.',
    ],
    function () {
        Route::get('/dashboard', [DashboardController::class, 'konselor'])->name('dashboard');
        Route::group(['prefix' => 'konsultasi', 'as' => 'konsultasi.'], function () {
            Route::get('/', [KonsultasiController::class, 'daftarKonsultasiKonselor'])->name('index');
            Route::post('/terima', [KonsultasiController::class, 'terimaKonsul'])->name('terima');
            Route::get('/chat', [KonsultasiController::class, 'indexKonselor'])->name('chat');
            Route::post('/{id}/send', [KonsultasiController::class, 'sendKonselor'])->name('send');
            Route::get('/{id}/chat-ajax', [KonsultasiController::class, 'chatAjax'])->name('chat-ajax');
            Route::post('/tutup-sesi', [KonsultasiController::class, 'tutupSesi'])->name('tutup-sesi');
        });
    },
);

Route::group(
    [
        'middleware' => ['auth', 'role:kader'],
        'prefix' => 'kader',
        'as' => 'kader.',
    ],
    function () {
        Route::get('/dashboard', [DashboardController::class, 'kader'])->name('dashboard');

        Route::group(['prefix' => 'laporan', 'as' => 'laporan.'], function () {
            Route::get('/create', [ReportController::class, 'create'])->name('create');
            Route::post('/store', [ReportController::class, 'store'])->name('store');
            Route::get('/{laporan}/bukti', [ReportController::class, 'downloadBukti'])->name('bukti');
            Route::get('/{id}/detail', [ReportController::class, 'show'])->name('detail');
        });

        Route::get('/tugas-penanganan', [ReportController::class, 'penugasanKader'])->name('tugas.penanganan');
        Route::post('/tugas-penanganan/store', [ReportController::class, 'progresStore'])->name('tugas.store.progres');
        Route::get('/konsultasi-korban', [KonsultasiController::class, 'konsultasiKorban'])->name('konsultasi.korban');
        // routes/web.php

        Route::group(['prefix' => 'konsultasi', 'as' => 'konsultasi.'], function () {
            Route::get('/{id}', [KonsultasiController::class, 'show'])->name('chat');
            Route::post('/{id}/send', [KonsultasiController::class, 'send'])->name('send');
        });
    },
);

Route::get('/pelaporan/admin', function () {
    return view('pelaporan.admin.index');
});

Route::post('/pelaporan/store', [ReportController::class, 'store'])->name('laporan.store');

Route::prefix('/pelaporan/petugas')
    ->name('petugas.')
    ->group(function () {
        Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');
        Route::get('/verifikasi/{id}/edit', [VerifikasiController::class, 'edit'])->name('verifikasi.edit');
        Route::post('/verifikasi/{id}/update', [VerifikasiController::class, 'update'])->name('verifikasi.update');
        Route::get('/laporan/terverifikasi', [VerifikasiController::class, 'terverifikasi'])->name('laporan.terverifikasi');
        Route::get('/laporan/{id}/tindaklanjut', [VerifikasiController::class, 'tindakLanjutForm'])->name('laporan.tindak.form');
        Route::post('/laporan/{id}/tindaklanjut', [VerifikasiController::class, 'tindakLanjutSimpan'])->name('laporan.tindak.simpan');
    });

<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\NilaiMataPelajaranController;
use App\Http\Controllers\NilaiEkstrakurikulerController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PengumumanController;

// Redirect
Route::fallback([AuthController::class, 'redirect'])->name('redirect');

// Middleware guest group
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
});

// Middleware auth group
Route::middleware('auth')->group(function () {
    // Route Beranda
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

    // Route Master
    Route::resource('/pegawai', PegawaiController::class)->middleware('role:staf-tata-usaha,guru');
    Route::get('/guru', [PegawaiController::class, 'index'])->name('guru.index')->middleware('role:siswa');
    Route::get('/guru/{pegawai}', [PegawaiController::class, 'show'])->name('guru.show')->middleware('role:siswa');
    Route::resource('/siswa', SiswaController::class);
    Route::resource('/kelas', KelasController::class)->parameters(['kelas' => 'kelas'])->middleware('role:staf-tata-usaha,guru');
    Route::resource('/semester', SemesterController::class)->middleware('role:staf-tata-usaha,guru');
    Route::resource('/mata-pelajaran', MataPelajaranController::class)->middleware('role:staf-tata-usaha,guru');
    Route::resource('/ekstrakurikuler', EkstrakurikulerController::class);

    // Route Profile
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/pegawai/update', [PegawaiController::class, 'update'])->name('profil-pegawai.update');
    Route::put('/profil/siswa/update', [SiswaController::class, 'update'])->name('profil-siswa.update');

    // Route Akademik
    Route::resource('/jadwal-pelajaran', JadwalPelajaranController::class);
    Route::resource('/prestasi', PrestasiController::class);
    Route::resource('/pengumuman', PengumumanController::class);
    
    // Route Nilai Mata Pelajaran (Route Akademik)
    Route::resource('/nilai-mata-pelajaran', NilaiMataPelajaranController::class)->except(['destroy']);
    Route::patch('/nilai-mata-pelajaran/update', [NilaiMataPelajaranController::class, 'update'])->name('nilai-mata-pelajaran.mass-update')->middleware('role:staf-tata-usaha,guru');
    
    // Route Nilai Ekstrakurikuler (Route Akademik)
    Route::resource('/nilai-ekstrakurikuler', NilaiEkstrakurikulerController::class)->except(['edit', 'destroy']);
    Route::patch('/nilai-ekstrakurikuler/update', [NilaiEkstrakurikulerController::class, 'update'])->name('nilai-ekstrakurikuler.mass-update')->middleware('role:staf-tata-usaha,guru');
    
    // Route Kehadiran (Route Akademik)
    Route::resource('/kehadiran', KehadiranController::class)->except(['edit', 'destroy']);
    Route::patch('/kehadiran/update', [KehadiranController::class, 'update'])->name('kehadiran.mass-update')->middleware('role:staf-tata-usaha,guru');


    // Route Log Out
    Route::post('/log-out', [AuthController::class, 'logOut'])->name('log-out');
});

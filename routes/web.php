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
use App\Http\Requests\UpdatePegawaiRequest;
use App\Http\Requests\UpdateSiswaRequest;

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

    //Route Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/pegawai/update', [ProfileController::class, 'pegawaiUpdate'])->name('profile.pegawai.update')->middleware('role:staf-tata-usaha,guru');
    Route::put('/profile/siswa/update', [ProfileController::class, 'siswaUpdate'])->name('profile.siswa.update')->middleware('role:siswa');

    // Route Akademik
    Route::resource('/jadwal-pelajaran', JadwalPelajaranController::class);
    Route::resource('/prestasi', PrestasiController::class);
    Route::resource('/pengumuman', PengumumanController::class);
    
    // Route Nilai Mata Pelajaran (Route Akademik)
    Route::put('/nilai-mata-pelajaran/mass-update', [NilaiMataPelajaranController::class, 'massUpdate'])->name('nilai-mata-pelajaran.mass-update')->middleware('role:staf-tata-usaha,guru');
    Route::get('/nilai-mata-pelajaran/delete', [NilaiMataPelajaranController::class, 'delete'])->name('nilai-mata-pelajaran.delete')->middleware('role:staf-tata-usaha,guru');
    Route::post('/nilai-mata-pelajaran/destroy', [NilaiMataPelajaranController::class, 'destroy'])->name('nilai-mata-pelajaran.destroy')->middleware('role:staf-tata-usaha,guru');
    Route::resource('/nilai-mata-pelajaran', NilaiMataPelajaranController::class)->except('destroy');
    
    // Route Nilai Ekstrakurikuler (Route Akademik)
    Route::put('/nilai-ekstrakurikuler/mass-update', [NilaiEkstrakurikulerController::class, 'massUpdate'])->name('nilai-ekstrakurikuler.mass-update')->middleware('role:staf-tata-usaha');
    Route::get('/nilai-ekstrakurikuler/delete', [NilaiEkstrakurikulerController::class, 'delete'])->name('nilai-ekstrakurikuler.delete')->middleware('role:staf-tata-usaha');
    Route::post('/nilai-ekstrakurikuler/destroy', [NilaiEkstrakurikulerController::class, 'destroy'])->name('nilai-ekstrakurikuler.destroy')->middleware('role:staf-tata-usaha');
    Route::resource('/nilai-ekstrakurikuler', NilaiEkstrakurikulerController::class)->except(['edit', 'update', 'destroy']);
    
    // Route Kehadiran (Route Akademik)
    Route::put('/kehadiran/mass-update', [KehadiranController::class, 'massUpdate'])->name('kehadiran.mass-update')->middleware('role:staf-tata-usaha,guru');
    Route::get('/kehadiran/delete', [KehadiranController::class, 'delete'])->name('kehadiran.delete')->middleware('role:staf-tata-usaha,guru');
    Route::post('/kehadiran/destroy', [KehadiranController::class, 'destroy'])->name('kehadiran.destroy')->middleware('role:staf-tata-usaha,guru');
    Route::resource('/kehadiran', KehadiranController::class)->except(['edit', 'update', 'destroy']);

    // Route Log Out
    Route::post('/log-out', [AuthController::class, 'logOut'])->name('log-out');
});

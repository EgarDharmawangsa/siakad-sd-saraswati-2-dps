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
use App\Http\Controllers\PesertaEkstrakurikulerController;
// use App\Http\Controllers\ProfilController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\NilaiMataPelajaranController;
use App\Http\Controllers\NilaiEkstrakurikulerController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PengumumanController;

use Illuminate\Support\Facades\Auth;

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');

Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');  

// Route Master
Route::resource('/pegawai', PegawaiController::class);
Route::resource('/siswa', SiswaController::class);
Route::resource('/kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
Route::resource('/semester', SemesterController::class);
Route::resource('/mata-pelajaran', MataPelajaranController::class);
Route::resource('/ekstrakurikuler', EkstrakurikulerController::class);
Route::resource('/peserta-ekstrakurikuler', PesertaEkstrakurikulerController::class);
// Route::resource('/profil', ProfilController::class);

// Route Akademik
Route::resource('/jadwal-pelajaran', JadwalPelajaranController::class);
Route::resource('/nilai-mata-pelajaran', NilaiMataPelajaranController::class);
Route::resource('/nilai-ekstrakurikuler', NilaiEkstrakurikulerController::class);
Route::resource('/kehadiran', KehadiranController::class);
Route::resource('/prestasi', PrestasiController::class);
Route::resource('/pengumuman', PengumumanController::class);
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BerandaController;

Route::get('/pegawai-distribution', [BerandaController::class, 'getPegawaiDistributionChartData'])->name('pegawai-distribution');
Route::get('/prestasi-improvement', [BerandaController::class, 'getPrestasiImprovementChartData'])->name('prestasi-improvement');

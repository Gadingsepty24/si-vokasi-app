<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\UjkController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\MitraController;
use Illuminate\Support\Facades\Route;

// ─── Dashboard ──────────────────────────────────────────────
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/balai/switch', [DashboardController::class, 'switchBalai'])->name('balai.switch');

// ─── Program Pelatihan ──────────────────────────────────────
Route::post('/programs',                   [ProgramController::class, 'store'])->name('programs.store');
Route::patch('/programs/{program}',        [ProgramController::class, 'update'])->name('programs.update');
Route::patch('/programs/{program}/jp',     [ProgramController::class, 'addJp'])->name('programs.addJp');
Route::delete('/programs/{program}',       [ProgramController::class, 'destroy'])->name('programs.destroy');

// ─── Alumni / Tracer ────────────────────────────────────────
Route::post('/alumni',                     [AlumniController::class, 'store'])->name('alumni.store');
Route::patch('/alumni/{alumni}',           [AlumniController::class, 'update'])->name('alumni.update');
Route::delete('/alumni/{alumni}',          [AlumniController::class, 'destroy'])->name('alumni.destroy');
Route::patch('/alumni/{alumni}/status',    [AlumniController::class, 'cycleStatus'])->name('alumni.cycleStatus');

// ─── UJK / Sertifikasi ──────────────────────────────────────
Route::post('/ujk',                        [UjkController::class, 'store'])->name('ujk.store');
Route::patch('/ujk/{ujk}',                 [UjkController::class, 'update'])->name('ujk.update');
Route::delete('/ujk/{ujk}',               [UjkController::class, 'destroy'])->name('ujk.destroy');
Route::patch('/ujk/{ujk}/complete',        [UjkController::class, 'complete'])->name('ujk.complete');

// ─── Mitra Industri DUDI ───────────────────────────────────
Route::post('/mitra',                      [MitraController::class, 'store'])->name('mitra.store');
Route::patch('/mitra/{mitra}',             [MitraController::class, 'update'])->name('mitra.update');
Route::delete('/mitra/{mitra}',            [MitraController::class, 'destroy'])->name('mitra.destroy');

// ─── Workshop / Sarpras ─────────────────────────────────────
Route::post('/workshops',                  [WorkshopController::class, 'store'])->name('workshops.store');
Route::patch('/workshops/{workshop}',      [WorkshopController::class, 'update'])->name('workshops.update');
Route::delete('/workshops/{workshop}',     [WorkshopController::class, 'destroy'])->name('workshops.destroy');
Route::patch('/workshops/{workshop}/status',[WorkshopController::class, 'toggleStatus'])->name('workshops.toggleStatus');

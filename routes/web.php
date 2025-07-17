<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\TemplateController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [GearVentureController::class, 'masuk'])->name('login');

Route::resource('template', TemplateController::class);
Route::resource('jenjang', JenjangController::class);
Route::resource('artikel', ArtikelController::class);
Route::resource('kurikulum', KurikulumController::class);
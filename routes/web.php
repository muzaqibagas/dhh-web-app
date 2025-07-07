<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\KurikulumController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('jenjang', JenjangController::class);
Route::resource('kurikulum', KurikulumController::class);
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('pruebas',function(){
    return view('prueba');
})->name('prueba');

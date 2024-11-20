<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Auth::routes(['verify' => true]);
require __DIR__ . '/auth.php';

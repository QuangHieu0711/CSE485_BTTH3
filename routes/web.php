<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::resource('tasks', TaskController::class);
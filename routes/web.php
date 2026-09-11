<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::resources([
    'managers' => ManagerController::class,
    'tasks' => TaskController::class,
]);
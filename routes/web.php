<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, "login"])->name("login");
Route::post("/login", [ServerController::class, "login"])->name("loginLogic");
Route::get('/signup', [PageController::class, "signup"])->name("signup");
Route::post("/signup", [ServerController::class, "signup"])->name("signupLogic");
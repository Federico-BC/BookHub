<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, "login"])->name("login");
Route::post("/login", [ServerController::class, "login"])->name("loginLogic");
Route::get('/signup', [PageController::class, "signup"])->name("signup");
Route::post("/signup", [ServerController::class, "signup"])->name("signupLogic");
Route::get("/home", [PageController::class, "home"])->name("home");
Route::get("/logout", [ServerController::class, "logout"])->name("logout");
Route::get("/search", [PageController::class, "search"])->name("search");
Route::post("/book/addFav", [ServerController::class, "addFavoriteBook"])->name("addFav");
Route::post("book/removeFav", [ServerController::class, "removeFavoriteBook"])->name("removeFav");
Route::get("/book/{olid}", [PageController::class, "book"])->name("book");
Route::get('/profile/{username}', [PageController::class, 'profile'])->name('profile');
Route::get("/editProfile", [PageController::class, "editProfile"])->name("accountSettings");
Route::post("/editProfile/save", [ServerController::class, "saveProfileChanges"])->name("saveProfileChanges");
Route::get('/search-user', [PageController::class, 'searchUser'])->name('search.user');
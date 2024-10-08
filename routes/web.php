<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VCardController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});
Route::post("/register",[RegisterController::class,"index"])->name("register");
Route::get("/register",[RegisterController::class,"show"])->name("showRegister");
Route::post("/login",[LoginController::class,"index"])->name("login");
Route::get("/login",[LoginController::class,"login"])->name("login");

Route::post("/picture/{user}",[StorageController::class,"index"])->middleware("auth")->name("uppload");
Route::post("/background/{user}",[StorageController::class,"background"])->middleware("auth")->name("background");
//compte utilisateur normal
Route::prefix("/profil/{user}")->controller(ProfilController::class)->name("profil.")->group(function(){
    Route::get("","show")->name("compte");
    route::get("/update","update")->middleware("auth")->name("update");
    route::get("/qr","qr")->middleware("auth")->name("qr");
    route::post("/update","modif")->middleware("auth")->name("modif");
    Route::post("/mail","mail")->middleware("auth")->name("mail");
    Route::post("/destroy","supprimeDestrroy")->name("supprimeDestrroy");
});

Route::post('/vcard/{user}', VCardController::class)->name('vcard');

//compte administrateur
Route::middleware("auth")->group(function(){
    Route::resource("users", UserController::class);
    Route::resource("entities", EntityController::class);
    Route::get('/entities/services/create', [EntityController::class, 'createService'])->name('entities.services.create');
    Route::post('/entities/services', [EntityController::class, 'storeService'])->name('entities.services.store');

    Route::get("dashboard", [DashboardController::class,"index"])->name("dashboard");

    Route::post("/logout",function(){
        Auth::logout();
        return redirect("/");
    })->name("logout");
});

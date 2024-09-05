<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\profilController;
use App\Http\Controllers\storageController;

Route::get('/', function () {
    return view('home');
});
Route::post("/register",[RegisterController::class,"index"])->name("register");
Route::get("/register",[RegisterController::class,"show"])->name("showRegister");
Route::post("/login",[loginController::class,"index"])->name("login");
Route::get("/login",[loginController::class,"login"])->name("newLog");

Route::post("/picture-{user}",[storageController::class,"index"])->middleware("auth")->name("uppload");
Route::post("/background-{user}",[storageController::class,"background"])->middleware("auth")->name("background");
//compte utilisateur normal
Route::prefix("/compte-{name}")->controller(profilController::class)->name("profil.")->group(function(){
    Route::get("","show")->name("compte");
    route::get("/update","update")->middleware("auth")->name("update");
    route::get("/qr","qr")->middleware("auth")->name("qr");
    route::post("/update","modif")->middleware("auth")->name("modif");
    Route::post("/mail","mail")->middleware("auth")->name("mail");
    Route::post("/destroy","supprimeDestrroy")->name("supprimeDestrroy");
});
//compte administrateur
Route::prefix("/dashboard-{name}")->controller(profilController::class)->name("profil.")->group(function(){
    route::get("/admin","admin")->name("admin");
    Route::post("/create","create")->name("create");
    Route::post("/destroy","destroy")->name("destroy");
});

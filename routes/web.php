<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteUserFileController;
use App\Http\Controllers\EntityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VCardController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});
// Route::post("/register",[RegisterController::class,"index"])->name("register");
// Route::get("/register",[RegisterController::class,"show"])->name("showRegister");
Route::middleware('guest')->group(function(){
    Route::post("/login",[LoginController::class,"index"])->name("login");
    Route::get("/login",[LoginController::class,"login"])->name("login");
});

Route::post("/picture/{user}",[StorageController::class,"index"])->middleware("auth")->name("uppload");
Route::post("/background/{user}",[StorageController::class,"background"])->middleware("auth")->name("background");
//compte utilisateur normal
Route::prefix("/profil/{user}")->controller(ProfilController::class)->name("profil.")->group(function(){
    Route::get("","show")->name("compte");
    route::get("/update","update")->middleware("auth")->name("update");
    route::get("/qr","qr")->middleware("auth")->name("qr");
    route::post("/update","modif")->middleware("auth")->name("modif");
    Route::post("/mail","mail")->name("mail");
    Route::post("/destroy","supprimeDestrroy")->name("supprimeDestrroy");
});

Route::post('/vcard/{user}', VCardController::class)->name('vcard');

//compte administrateur
Route::middleware("auth")->group(function(){
    Route::resource("users", UserController::class);
    Route::resource("entities", EntityController::class);

    Route::resource('services', ServiceController::class)->except(['index', 'show']);

    Route::controller(PasswordController::class)->name('password.')->prefix('password')->group(function(){
        Route::get('/', 'edit')->name('edit');
        Route::put('/', 'update')->name('update');
    });

    Route::resource('contacts', ContactController::class)->only(['index']);

    Route::get("dashboard", [DashboardController::class,"index"])->name("dashboard");

    Route::delete('files/{file}', DeleteUserFileController::class)->name('files.destroy');

    Route::post("/logout",function(){
        Auth::logout();
        return redirect("/");
    })->name("logout");
});

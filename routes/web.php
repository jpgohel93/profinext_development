<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClientController;

// login
Route::get("/login",function(){
    return view("login");
})->name("login");
Route::post("/login",[LoginController::class,"login"])->name("login");

// Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    // dashboard
    Route::get("/",function(){
        return view("dashboard");
    })->name("dashboard");
    // clients
    Route::get("/clients",[ClientController::class,"all"])->name("clients");
    // clients
    Route::get("/users",[UserController::class,"all"])->name("users");
    // create client
    Route::post("/clients/add",[ClientController::class,"create"])->name("clientCreate");
    // read client
    Route::get("/client/view/{client_id}",[ClientController::class,"get"])->name("clientView");
    // roles
    Route::get("/roles",[RolesController::class, "view"])->name("roles");
    // roles
    Route::get("/roles/add",[RolesController::class, "addRolesForm"])->name("addRoles");
    Route::post("/role/add",[RolesController::class, "createRole"]);
});
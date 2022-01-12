<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
// login
Route::post("/login",[LoginController::class,"login"])->name("login");
// clients
Route::get("/clients",[UserController::class,"clients"])->name("clients");
// roles
Route::get("/roles",[RolesController::class, "roles"])->name("clients");
Route::post("/roles/create",[RolesController::class, "roles"])->name("clients");

Route::fallback(function(){
    return view("dashboard");
});
// Route::middleware(['validateUser'])->group(function () {
//     // Route::get('/', function () {
//     //     // Uses first & second middleware...
//     // });

//     // Route::get('/user/profile', function () {
//     //     // Uses first & second middleware...
//     // });
// });
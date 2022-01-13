<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClientController;
// login
Route::post("/login",[LoginController::class,"login"])->name("login");
// clients
Route::get("/clients",[ClientController::class,"all"])->name("clients");
// create client
Route::post("/clients/add",[ClientController::class,"create"])->name("clientCreate");
// read client
Route::get("/client/view/{client_id}",[ClientController::class,"get"])->name("clientView");
// roles
Route::get("/roles",[RolesController::class, "roles"])->name("roles");
// roles
Route::get("/roles/add",[RolesController::class, "addRolesForm"])->name("addRoles");
Route::post("/role/add",[RolesController::class, "createRole"]);


// Route::fallback(function(){
//     return view("dashboard");
// });
// Route::middleware(['validateUser'])->group(function () {
//     // Route::get('/', function () {
//     //     // Uses first & second middleware...
//     // });

//     // Route::get('/user/profile', function () {
//     //     // Uses first & second middleware...
//     // });
// });
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClientController;

// login
Route::get("/login",function(){
    return view("auth.login");
})->name("login");
Route::post("/login",[LoginController::class,"login"])->name("loginUser");
// register
Route::get("/register",function(){
    return view("auth.register");
})->name("register");
Route::post("/register",[RegisterController::class,"register"])->name("registerUser");
// resetPassword
Route::get("/reset",function(){
    return view("auth.reset-password");
})->name("resetPassword");

// Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    // dashboard
    Route::get("/",function(){
        return view("dashboard");
    })->name("dashboard");

    // clients
    Route::get("/clients",[ClientController::class,"all"])->name("clients");
    // read client
    Route::get("/client/view/{client_id}",[ClientController::class,"get"])->name("clientView");
    // create client
    Route::get("/client/add",[ClientController::class,"createClientForm"])->name("createClientForm");
    Route::post("/clients/add",[ClientController::class,"create"])->name("clientCreate");
    // edit client
    Route::get("/client/edit/{id}",[ClientController::class,"updateForm"])->name("updateClientForm");
    Route::POST("/client/update/{id}",[ClientController::class,"update"])->name("updateClient");
    // remove client
    Route::get("/client/remove/{id}",[ClientController::class,"remove"])->name("removeClient");

    // users
    Route::get("/users",[UserController::class,"all"])->name("users");
    // view users
    Route::get("/user/view/{id}",[UserController::class,"view"])->name("viewUser");
    // create user
    Route::get("/user/create/",[UserController::class,"createForm"])->name("createUserForm");
    Route::POST("/user/create/",[UserController::class,"create"])->name("createUser");
    // edit user
    Route::get("/user/edit/{id}",[UserController::class,"updateForm"])->name("updateUserForm");
    Route::POST("/user/update/{id}",[UserController::class,"update"])->name("updateUser");
    // remove user
    Route::get("/user/delete/{id}",[UserController::class,"delete"])->name("deleteUser");

    // list roles
    Route::get("/roles",[RolesController::class, "view"])->name("roles");
    // create role
    Route::get("/roles/add",[RolesController::class, "addRolesForm"])->name("addRoles");
    Route::post("/role/add",[RolesController::class, "createRole"])->name("createRole");
    // edit role
    Route::get("/role/edit/{id}",[RolesController::class, "editRoleForm"])->name("editRoleForm");
    Route::post("/role/edit/{id}",[RolesController::class, "editRole"])->name("editRole");
    // remove role
    Route::get("/role/remove/{id}",[RolesController::class, "removeRole"])->name("removeRole");

    // logout
    Route::get("/logout",[LoginController::class,"logout"])->name("logout");
    // display file
    Route::get('/common/displayFile/{id}/{type}/{name}', [App\Http\Controllers\CommonController::class,'displayFile'])->name('displayFile');
});
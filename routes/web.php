<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AnalystController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\AccountTypesController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\BankDetailsController;
use App\Http\Controllers\TraderController;
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
    // remove client
    Route::get("'/client/edit/{client_id}/remove/screenshot/{screenshot_id}",[ClientController::class,"removePaymentScreenshot"])->name("removePaymentScreenshot");


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
    
    // list analyst
    Route::get("/analyst", [AnalystController::class, "view"])->name("analysts");
    // create analyst
    Route::get("/analyst/create/",[AnalystController::class,"createForm"])->name("createAnalystForm");
    Route::POST("/analyst/create/",[AnalystController::class,"create"])->name("createAnalyst");
    // get analyst
    Route::get("/analyst/{id}", [AnalystController::class, "getAnalyst"])->name("getAnalysts");
    // edit analyst
    Route::POST("/analyst/edit",[AnalystController::class, "editAnalyst"])->name("editAnalyst");
    
    // list calls
    Route::get("/calls",[CallController::class, "view"])->name('calls');
    // create call
    Route::POST("/call/create/",[CallController::class,"create"])->name("createCall");
    // remove call
    Route::POST("/call/remove/",[CallController::class,"remove"])->name("deleteCall");
    // get calls
    Route::POST("/call/view/",[CallController::class, "get"])->name('getCall');
    // edit call
    Route::POST("/call/edit/",[CallController::class,"edit"])->name("editCall");


    // users settings
    Route::get("/settings/users/",[AccountTypesController::class,"view"])->name("viewUsersAccountType");
    // create AccountType
    Route::POST("/settings/users/createAccountType",[AccountTypesController::class, "create"])->name("createAccountType");
    // removeAccountType
    Route::get("/settings/users/removeAccountType/{id}",[AccountTypesController::class,"remove"])->name("removeAccountType");
    // get AccountType
    Route::POST("/settings/users/getAccountType",[AccountTypesController::class,"get"])->name("getAccountType");
    // edit AccountType
    Route::POST("/settings/users/editAccountType",[AccountTypesController::class,"edit"])->name("editAccountType");
    
    
    // clients settings
    Route::get("/settings/clients",[ProfessionController::class,"view"])->name("viewClientsProfession");
    // create Profession
    Route::POST("/settings/clients/createProfession",[ProfessionController::class, "create"])->name("createProfession");
    // getProfession
    Route::POST("/settings/clients/getProfession",[ProfessionController::class,"get"])->name("getProfession");
    // edit AccountType
    Route::POST("/settings/clients/editProfession",[ProfessionController::class,"edit"])->name("editProfession");
    // removeProfession
    Route::get("/settings/clients/removeProfession/{id}",[ProfessionController::class,"remove"])->name("removeProfession");
    
    // viewClientsBroker
    Route::get("/settings/clients/broker",[BrokerController::class,"view"])->name("viewClientsBroker");
    // createBroker
    Route::POST("/settings/clients/createBroker", [BrokerController::class, "create"])->name("createBroker");
    // getBroker
    Route::POST("/settings/clients/getBroker", [BrokerController::class, "get"])->name("getBroker");
    // editBroker
    Route::POST("/settings/clients/editBroker", [BrokerController::class, "edit"])->name("editBroker");
    // removeBroker
    Route::get("/settings/clients/removeBroker/{id}", [BrokerController::class, "remove"])->name("removeBroker");

    // viewClientsBanks
    Route::get("/settings/clients/viewClientsBanks",[BankDetailsController::class,"view"])->name("viewClientsBanks");
    // createBank
    Route::POST("/settings/clients/createBank", [BankDetailsController::class, "create"])->name("createBank");
    // getBank
    Route::POST("/settings/clients/getBank", [BankDetailsController::class, "get"])->name("getBank");
    // editBank
    Route::POST("/settings/clients/editBank", [BankDetailsController::class, "edit"])->name("editBank");
    // removeBank
    Route::get("/settings/clients/removeBank/{id}", [BankDetailsController::class, "remove"])->name("removeBank");
    
    // trader
    Route::get("/trader",[TraderController::class, "view"])->name("viewTrader");
    Route::POST("/trader/client/assign",[TraderController::class,'create'])->name('assignClientToTrader');
    // logout
    Route::get("/logout",[LoginController::class,"logout"])->name("logout");
    // display file
    Route::get('/common/displayFile/{id}/{type}/{name}', [App\Http\Controllers\CommonController::class,'displayFile'])->name('displayFile');
});
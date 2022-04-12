<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RenewalAccountImagesController;
use App\Http\Controllers\AnalystController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\AccountTypesController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\BankDetailsController;
use App\Http\Controllers\TraderController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\ChannelPartnerController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\servicesTypeController;
use App\Http\Controllers\financeManagementControllers\BankControllers;
use App\Http\Controllers\financeManagementControllers\AccountingController;
use App\Http\Controllers\financeManagementControllers\FinancialStatusController;

// financeManagementControllers
use App\Http\Controllers\financeManagementControllers\renewalStatusController;

use Illuminate\Support\Facades\Artisan;
Route::get('/clearCache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cleared!";
});

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
Route::post("/checkUser",[RegisterController::class,"checkUser"])->name("checkUser");
Route::post("/reset",[RegisterController::class,"resetPassword"])->name("resetPassword");
// logout
Route::get("/logout", [LoginController::class, "logout"])->name("logout");


Route::group(['middleware' => ['auth']], function() {
    // dashboard
    Route::get("/",function(){
        return view("dashboard");
    })->name("dashboard");

    // clients
    Route::get("/clients",[ClientController::class,"all"])->name("clients");
    Route::get("/clients/Demat/{filter_type?}/{filter_id?}",[ClientController::class,"clientDematAccount"])->name("clientDematAccount");
    Route::get("/clients/DematAccount/status",[ClientController::class, "clientDematAccountStatus"])->name("clientDematAccountStatus");
    Route::POST("/clients/DematAccount/status/get",[ClientController::class, "viewDematProblem"])->name("viewDematProblem");
    Route::POST("/clients/DematAccount/issue/get",[ClientController::class, "issueWithDematAccount"])->name("issueWithDematAccount");
    Route::POST("/clients/DematAccount/account/restore",[ClientController::class, "dematAccountRestore"])->name("dematAccountRestore");
    Route::POST("/clients/DematAccount/renewal_account/image_upload",[RenewalAccountImagesController::class, "create"])->name("renewalAccountImageUpload");
    Route::POST("/clients/DematAccount/renewal_account/images/get",[RenewalAccountImagesController::class, "get"])->name("viewRenewalAccountImages");
    Route::POST("/clients/DematAccount/remove", [ClientController::class, "removeDemat"])->name("removeDematAccount");
    // read client
    Route::get("/client/view/{client_id}",[ClientController::class,"get"])->name("clientView");
    Route::POST("/clients/mutual_fund/get",[ClientController::class, "getMutualFundClient"])->name("getMutualFundClient");
    Route::POST("/clients/unlisted_shares/get",[ClientController::class, "getUnlistedSharesClient"])->name("getUnlistedSharesClient");
    Route::POST("/clients/insurance/get",[ClientController::class, "getInsuranceClients"])->name("getInsuranceClients");
    // create client
    Route::get("/client/add",[ClientController::class,"createClientForm"])->name("createClientForm");
    Route::post("/clients/add",[ClientController::class,"create"])->name("clientCreate");
    // edit client
    Route::get("/client/edit/{id}",[ClientController::class,"updateForm"])->name("updateClientForm");
    Route::POST("/client/update/{id}",[ClientController::class,"update"])->name("updateClient");
    // remove client
    Route::get("/client/remove/{id}",[ClientController::class,"remove"])->name("removeClient");
    // remove client
    Route::get("/client/edit/{client_id}/remove/screenshot/{screenshot_id}",[ClientController::class,"removePaymentScreenshot"])->name("removePaymentScreenshot");
    Route::POST("/client/edit/remove/pancard",[ClientController::class,"removeDematePancard"])->name("removeDematePancard");
    Route::POST("/freelancer/client/assign",[ClientController::class,'assignClientToFreelancer'])->name('assignClientToFreelancer');
    Route::POST("/clients/edit/Demat",[ClientController::class,"editClientDematAccount"])->name("editClientDematAccount");
    Route::get("/loginInfo/{id}", [ClientController::class, "getLoginInfo"])->name("getLoginInfo");
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
    Route::POST("/user/assignTraderRole",[UserController::class,"assignTraderRoles"])->name("assignTraderRoles");
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
    // get permissions for role
    Route::get("/permissionByRole/{role}",[RolesController::class, "getPermissions"])->name("permissionByRole");
    // clearPermissionCache
    Route::get("/clearPermissionCache/{fallback?}",[RolesController::class, "clearPermissionCache"]);

    // list analyst
    Route::get("/analyst", [AnalystController::class, "view"])->name("analysts");
    // create analyst
    Route::get("/analyst/create/",[AnalystController::class,"createForm"])->name("createAnalystForm");
    Route::POST("/analyst/create/",[AnalystController::class,"create"])->name("createAnalyst");
    // get analyst
    Route::get("/analyst/{id}", [AnalystController::class, "getAnalyst"])->name("getAnalysts");
    // edit analyst
    Route::POST("/analyst/edit",[AnalystController::class, "editAnalyst"])->name("editAnalyst");
    Route::POST("/analyst/editAnalystAssignTo",[AnalystController::class, "editAnalystAssignTo"])->name("editAnalystAssignTo");
    Route::POST("/getAnalyst", [AnalystController::class, "getAnalystData"])->name("getAnalystData");
    Route::POST("/getActiveCall", [AnalystController::class, "getActiveCallData"])->name("getActiveCallData");
    Route::POST("/getCloseCall", [AnalystController::class, "getCloseCallData"])->name("getCloseCallData");
    // list monitor
    Route::get("/monitor", [AnalystController::class, "viewMonitor"])->name("viewMonitor");
    Route::get("/monitor_analysts", [AnalystController::class, "viewMonitorAnalysts"])->name("viewMonitorAnalysts");
    Route::get("/monitor_analysts/{id}", [AnalystController::class, "viewMonitorAnalystsById"])->name("viewMonitorAnalystsById");
    Route::get("/monitor_data", [AnalystController::class, "viewMonitorData"])->name("viewMonitorData");
    Route::POST("/getAnalyst", [AnalystController::class, "getAnalystData"])->name("getAnalystData");
    Route::POST("/getActiveCall", [AnalystController::class, "getActiveCallData"])->name("getActiveCallData");
    Route::POST("/getCloseCall", [AnalystController::class, "getCloseCallData"])->name("getCloseCallData");
    Route::get("/monitor_call/{id}", [AnalystController::class, "createMonitorDataForm"])->name("createMonitorDataForm");
    Route::POST("/monitor_call", [AnalystController::class, "createMonitorData"])->name("createMonitorData");
    Route::POST("/monitor_call_edit_data", [AnalystController::class, "editMonitorDataForm"])->name("editMonitorDataForm");
    Route::POST("/monitor_call_edit", [AnalystController::class, "editMonitorData"])->name("editMonitorData");
    Route::get("/report", [AnalystController::class, "report"])->name("report");
    Route::POST("/monitor_call_delete", [AnalystController::class, "deleteMonitorData"])->name("deleteMonitorData");
    Route::POST("/monitor_call_close", [AnalystController::class, "closeMonitorData"])->name("closeMonitorData");


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
    Route::get("/call/setup",[ClientController::class,"setup"])->name("setup");
    Route::POST("/getScriptCall",[CallController::class,"getScriptCall"])->name("getScriptCall");

    Route::POST("/getPreferredAccount",[ClientController::class,'getPreferredAccountData'])->name('getPreferredAccountData');
    Route::POST("/getNormalAccount",[ClientController::class,'getNormalAccountData'])->name('getNormalAccountData');
    Route::POST("/getHolding",[ClientController::class,'getHoldingData'])->name('getHoldingData');
    Route::POST("/getAllAcount",[ClientController::class,'getAllAcountData'])->name('getAllAcountData');
    Route::POST("/getTraderAcount",[ClientController::class,'getTraderAcountData'])->name('getTraderAcountData');
    Route::POST("/getFreelancerAccount",[ClientController::class,'getFreelancerAccountData'])->name('getFreelancerAccountData');
    Route::POST("/getUnalloted",[ClientController::class,'getUnallotedData'])->name('getUnallotedData');
    Route::POST("/client/demate/activate",[ClientController::class, 'clientDematActivated'])->name('clientDematActivated');
    Route::POST("/client/terminate",[ClientController::class, 'terminateClient'])->name('terminateClient');
    Route::get("/client/ledger/{id?}",[ClientController::class, 'viewLedger'])->name('viewLedger');
    Route::get("/client/ledger/pdf/{id}",[ClientController::class, 'generatePdf'])->name('generatePdf');
    Route::get("/client/ledger/doc/{id}",[ClientController::class, 'generateDoc'])->name('generateDoc');

    Route::POST("/call/assignDematTrader",[ClientController::class,'assignTraderToDemat'])->name('assignTraderToDemat');
    Route::POST("/makeAsPreferred",[ClientController::class,"makeAsPreferred"])->name("makeAsPreferred");
    Route::POST("/updateDematStatus",[ClientController::class,"updateDematStatus"])->name("updateDematStatus");
    Route::POST("/addDematHolding",[CallController::class,"create"])->name("addDematHolding");

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
    // viewClientsServicesType
    Route::get("/settings/clients/viewClientsServicesType",[servicesTypeController::class,"view"])->name("viewClientsServicesType");
    // edit Service Type
    Route::POST("/settings/clients/viewClientsServicesType",[servicesTypeController::class, "editServiceType"])->name("editServiceType");
    // get Service Type
    Route::POST("/settings/clients/getServiceType",[servicesTypeController::class,"get"])->name("getServiceType");
    // delete Service Type
    Route::get("/settings/clients/removeServiceType/{id}",[servicesTypeController::class,"remove"])->name("removeServiceType");
    Route::post("/settings/clients/addServiceType",[servicesTypeController::class,"add"])->name("addServiceType");

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
    Route::get("/traders",[TraderController::class, "getTraderList"])->name("viewTraderList");
    Route::get("/traders/clients/{id}",[TraderController::class, "viewTraderClientList"])->name("viewTraderClientList");
    Route::get("/trader/accounts",[TraderController::class, "viewTraderAccounts"])->name("viewTraderAccounts");
    Route::POST("/trader/client/assign",[TraderController::class,'create'])->name('assignClientToTrader');
    Route::POST("/traders/clients",[TraderController::class, "viewTraderClient"])->name("viewTraderClient");
    Route::get("/traders/accounts/holding",[TraderController::class, "viewTraderHoldingAccounts"])->name("viewTraderHoldingAccounts");

    // display file
    Route::get('/common/displayFile/{id}/{type}/{name}', [App\Http\Controllers\CommonController::class,'displayFile'])->name('displayFile');

    // freelancer
    Route::get("/freelancer",[FreelancerController::class, "freelancerData"])->name("freelancerData");
    Route::get("/user/freelancer",[FreelancerController::class, "freelancerUserData"])->name("freelancerUserData");
    Route::get("/freelancer/clients/{id}",[FreelancerController::class, "freelancerClientData"])->name("freelancerClientData");

    // Channel Partner
    Route::get("/channelPartner",[ChannelPartnerController::class, "channelPartnerData"])->name("channelPartnerData");
    Route::get("/channelPartner/clients/{id}",[ChannelPartnerController::class, "channelPartnerClientData"])->name("channelPartnerClientData");
    Route::get("/user/channelPartner",[ChannelPartnerController::class, "channelPartnerUserData"])->name("channelPartnerUserData");
    Route::get("/channelPartner/client/add",[ClientController::class,"channelPartnerClientForm"])->name("channelPartnerClientForm");

    // keyword
    Route::get("/keyword",[KeywordController::class, "keywordData"])->name("keywordData");
    Route::POST("/addKeyword",[KeywordController::class, "addKeyword"])->name("addKeyword");
    Route::POST("/editKeyword",[KeywordController::class, "editKeyword"])->name("editKeyword");
    Route::get("/deleteKeyword/{id}",[KeywordController::class, "deleteKeyword"])->name("deleteKeyword");

    // Blogs Admin
    Route::get("/blogAdmin",[BlogController::class, "blogAdmin"])->name("blogAdmin");
    Route::get("/blogUser",[BlogController::class, "getBlogByUser"])->name("blogUser");
    Route::POST("/addBlog",[BlogController::class, "addBlogFrm"])->name("addBlogFrm");
    Route::get("/editBlogForm/{id}",[BlogController::class, "editBlogForm"])->name("editBlogForm");
    Route::get("/editBlog/{id}",[BlogController::class, "editBlog"])->name("editBlog");
    Route::get("/approveBlog/{id}",[BlogController::class, "approveBlog"])->name("approveBlog");
    Route::POST("/updateBlogFrm",[BlogController::class, "updateBlogFrm"])->name("updateBlogFrm");
    Route::get("/removeBlog",[BlogController::class, "removeBlog"])->name("removeBlog");
    Route::POST("/getNotes",[BlogController::class, "getNotes"])->name("getNotes");
    Route::POST("/addTab",[BlogController::class, "addTab"])->name("addTab");
    Route::POST("/setTargetFrm",[BlogController::class, "setTargetFrm"])->name("setTargetFrm");
    Route::POST("/addNoteFrm",[BlogController::class, "addNoteFrm"])->name("addNoteFrm");

    // Finance Management
    Route::get("/financeManagement/renewal_status",[renewalStatusController::class,"view"])->name("renewal_status");
    Route::get("/financeManagement/clientDematView/{id?}",[renewalStatusController::class, "clientDematView"])->name("clientDematView");
    Route::get("/financeManagement/clientDematDataView/{id}/{type}",[renewalStatusController::class, "clientDematView"])->name("clientDematDataView");
    Route::get("/financeManagement/clientDematTerminate/{id}",[renewalStatusController::class, "clientDematTerminate"])->name("clientDematTerminate");
    Route::POST("/financeManagement/clientDemat/updatePL",[renewalStatusController::class, "updatePL"])->name("clientDematupdatePL");
    Route::POST("/financeManagement/clientDemat/calculateAmount",[renewalStatusController::class, "calculateAmount"])->name("calculateAmount");
    Route::POST("/financeManagement/clientDemat/markAsProblem",[renewalStatusController::class, "mark_as_problem"])->name("mark_as_problem");
    Route::POST("/financeManagement/clientDemat/ProblemSolved",[renewalStatusController::class, "ProblemSolved"])->name("update_mark_as_problem");
    Route::POST("/feesPayment",[renewalStatusController::class, "feesPayment"])->name("feesPayment");
    Route::POST("/profitSharingPayment",[renewalStatusController::class, "profitSharingPayment"])->name("profitSharingPayment");
    Route::POST("/partPayment",[renewalStatusController::class, "partPayment"])->name("partPayment");
    Route::POST("/fullPayment",[renewalStatusController::class, "fullPayment"])->name("fullPayment");
    Route::POST("/partPaymentReminder",[renewalStatusController::class, "partPaymentReminder"])->name("partPaymentReminder");
    Route::get("/viewFeesInvoice/{id}/{invoice_type}",[renewalStatusController::class,"viewFeesInvoice"])->name("viewFeesInvoice");
    Route::POST("/getRenewData",[renewalStatusController::class,"getRenewData"])->name("getRenewData");
    Route::POST("/viewPartPayment",[renewalStatusController::class,"viewPartPayment"])->name("viewPartPayment");

    // finance Management Bank
    Route::get("/financeManagement/bank",[BankControllers::class, "financeManagementBank"])->name("financeManagementBank");
    Route::POST("/financeManagement/bank/add",[BankControllers::class, "addFinanceManagementBank"])->name("addFinanceManagementBank");
    Route::POST("/financeManagement/bank/get",[BankControllers::class, "financeManagementGetBank"])->name("financeManagementGetBank");
    Route::get("/financeManagement/bank/edit/{id?}",[BankControllers::class, "financeManagementEditBank"])->name("financeManagementEditBank");
    Route::post("/financeManagement/bank/edit",[BankControllers::class, "editFinanceManagementBank"])->name("editFinanceManagementBank");
    Route::post("/financeManagement/bank/setTarget",[BankControllers::class, "setTargetFinanceManagementBank"])->name("setTargetFinanceManagementBank");
    Route::post("/financeManagement/bank/setPrimary",[BankControllers::class, "setPrimaryFinanceManagementBank"])->name("setPrimaryFinanceManagementBank");
    Route::post("/financeManagement/bank/activateDeactivateAccount",[BankControllers::class, "activateDeactivateAccountFinanceManagementBank"])->name("activateDeactivateAccountFinanceManagementBank");

    // finance Management Accounting
    Route::get("/financeManagement/accounting", [AccountingController::class, "financeManagementAccounting"])->name("financeManagementAccounting");
    // finance Management heading
    Route::get("/financeManagement/headings", [AccountingController::class, "financeManagementHeadings"])->name("financeManagementHeadings");
    Route::post("/financeManagement/heading/add", [AccountingController::class, "financeManagementAddHeadings"])->name("financeManagementAddHeadings");
    Route::post("/financeManagement/heading/get", [AccountingController::class, "getHeadingById"])->name("financeManagementGetHeadings");
    Route::post("/financeManagement/heading/edit", [AccountingController::class, "financeManagementEditHeadings"])->name("financeManagementEditHeadings");
    Route::post("/financeManagement/heading/activateDeactivateHeading",[AccountingController::class, "activateDeactivateHeadingFinanceManagementAccounting"])->name("activateDeactivateHeadingFinanceManagementAccounting");
    // finance Management income
    Route::post("/financeManagement/income/add", [AccountingController::class, "financeManagementAddIncome"])->name("accounting.income");
    // finance Management expense
    Route::post("/financeManagement/expense/add", [AccountingController::class, "financeManagementAddExpense"])->name("accounting.expense");
    // finance Management transfer
    Route::post("/financeManagement/transfer/add", [AccountingController::class, "financeManagementAddTransfer"])->name("accounting.transfer");
    Route::post("/financeManagement/transfer/userBanks/get", [AccountingController::class, "financeManagementTransferGetUsersBank"])->name("accounting.TransferGetUsersBank");
    // finance Management loan
    Route::post("/financeManagement/loan/add", [AccountingController::class, "financeManagementAddLoan"])->name("accounting.loan");
    // finance Management - Financial Status
    Route::get("/financeManagement/FinancialStatus", [FinancialStatusController::class, "financialStatus"])->name("financeManagementFinancialStatus");
    Route::get("/financeManagement/view/st", [FinancialStatusController::class, "viewMoreSt"])->name("viewMoreSt");
    Route::get("/financeManagement/view/sg", [FinancialStatusController::class, "viewMoreSg"])->name("viewMoreSg");
    Route::post("/financeManagement/view/st/demat", [FinancialStatusController::class, "dematDetailsFinancialStatus"])->name("dematDetailsFinancialStatus");
    // Business Management
    Route::get("/businessManagement",[renewalStatusController::class,"view"])->name("business_management");
});

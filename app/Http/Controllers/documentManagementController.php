<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class documentManagementController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:role-create', ['only' => ['createRole', 'addRolesForm']]);
        // $this->middleware('permission:role-write', ['only' => ['editRoleForm', 'editRole']]);
        // $this->middleware('permission:role-read', ['only' => ['view', 'getPermissions']]);
        // $this->middleware('permission:role-delete', ['only' => ['removeRole']]);
    }
    public function data(){
        return view("documentManagement.data");
    }
    public function panCards(){
        return view("documentManagement.pan-card");
    }
    public function screenshots(){
        return view("documentManagement.screenshot");
    }
    public function images(){
        return view("documentManagement.images");
    }
}

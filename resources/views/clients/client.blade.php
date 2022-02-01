@extends('layout')
@section("page-title","Clients")
@section("clients","active")
@section("content")
	<!--begin::Body-->	
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            @include("sidebar")
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include("header")
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @if($errors->any())
                        <div class="container">
                            <h5 class="alert alert-danger">{{$errors->first()}}</h5>
                        </div>
                    @elseif(session("info"))
                        <div class="container">
                            <h5 class="alert alert-info">{{session("info")}}</h5>
                        </div>
                    @endif
                    <!--begin::Toolbar-->
                    <div class="toolbar" id="kt_toolbar">
                        <!--begin::Container-->
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Clients</h1>
                                <!--end::Title-->
                                <!--begin::Separator-->
                                <span class="h-20px border-gray-200 border-start mx-4"></span>
                                <!--end::Separator-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        <a href="/dist/index.html" class="text-muted text-hover-primary">Home</a>
                                    </li>
                                    <!--end::Item-->  
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-dark">Client List</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                            <!--begin::Actions-->
                            @can("client-create")
                                <div class="d-flex align-items-center py-1"> 
                                    <!--begin::Button-->
                                    <a href="{{route('createClientForm')}}" class="btn btn-sm btn-primary" >
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>Add Client
                                    </a> 
                                </div>
                            @endcan
                            <!--end::Actions--> 
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <ul class="nav nav-tabs fw-bold justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#activeTab">Active</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#renewalTab">Renewal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#problemTab">Problem</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#terminatedTab">Terminated</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#allTab">All</a>
                                </li>
                            </ul> 
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="activeTab" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--begin::Card title-->
                                            <!--begin::Card toolbar-->
                                        
                                            <div class="card-toolbar">
                                                <!--begin::Toolbar-->
                                                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base"> 
                                                    <!--begin::Export--> 
                                                    <a href="#" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
                                                                <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
                                                                <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->Export
                                                        <span class="svg-icon svg-icon-5 m-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                            </svg>
                                                        </span> 
                                                    </a> 
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold w-175px py-4" data-kt-menu="true"> 
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-icon">
                                                                    <i class="la la-file-pdf-o"></i>
                                                                </span>PDF
                                                            </a> 
                                                        </div> 
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-icon">
                                                                    <i class="la la-file-excel-o"></i>
                                                                </span>Excel
                                                            </a>  
                                                        </div> 
                                                    </div> 
                                                    <!--end::Export--> 
                                                </div>
                                                <!--end::Toolbar-->
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="">Sr. No.</th>
                                                            <th class="min-w-125px">Client Name</th>
                                                            <th class="min-w-125px">Contact Number</th>
                                                            <th class="min-w-75px">No. of Demat</th>
                                                            <th class="text-end min-w-100px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        @can("client-read")
                                                        @php
                                                            $i=0;
                                                        @endphp
                                                        @forelse ($clients as $client)
                                                            <tr> 
                                                                <td>{{$i+=1}}</td>
                                                                <td class="d-flex align-items-center"> 
                                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                        <a href="#">
                                                                            <div class="symbol-label">
                                                                                <img src="{{asset("assets/media/avatars/150-1.jpg")}}" alt="Emma Smith" class="w-100" />
                                                                            </div>
                                                                        </a>
                                                                    </div> 
                                                                    <div class="d-flex flex-column">
                                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$client->name}}</a>
                                                                        <span>{{$client->email}}</span>
                                                                    </div> 
                                                                </td> 
                                                                <td>{{$client->number}}</td>  
                                                                <td>{{ $client->clientDemat->count()}}</td> 
                                                                <td class="text-end">
                                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span> 
                                                                    </a> 
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true"> 
                                                                        @can("client-read")
                                                                        <div class="menu-item px-3">  
                                                                            <a href="{{route('clientView',$client->id)}}" data-id='{{$client->id}}' class="menu-link px-3">View</a>
                                                                        </div> 
                                                                        @endcan
                                                                        @can("client-write")
                                                                        <div class="menu-item px-3">  
                                                                            <a href="{{route('updateClientForm',$client->id)}}" data-id='{{$client->id}}' class="menu-link px-3">Edit</a>
                                                                        </div> 
                                                                        @endcan
                                                                        <div class="menu-item px-3">
                                                                            <a href="/dist/ledger.html" data-id='{{$client->id}}' target="_blank" class="menu-link px-3">Ledger</a>
                                                                        </div> 
                                                                        @can("client-delete")
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{route('removeClient',$client->id)}}" data-id='{{$client->id}}' class="menu-link px-3">Remove</a>
                                                                        </div> 
                                                                        @endcan
                                                                    </div> 
                                                                </td> 
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6">No Clients Found</td>
                                                            </tr>    
                                                        @endforelse
                                                        @endcan
                                                        <!--end::Table row-->
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table> 													
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <div class="tab-pane fade" id="renewalTab" aria-labelledby="renewal-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--begin::Card title-->
                                            <!--begin::Card toolbar-->
                                        
                                            <div class="card-toolbar">
                                                <!--begin::Toolbar-->
                                                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base"> 
                                                    <!--begin::Export--> 
                                                    <a href="#" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
                                                                <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
                                                                <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->Export
                                                        <span class="svg-icon svg-icon-5 m-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                            </svg>
                                                        </span> 
                                                    </a> 
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold w-175px py-4" data-kt-menu="true"> 
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-icon">
                                                                    <i class="la la-file-pdf-o"></i>
                                                                </span>PDF
                                                            </a> 
                                                        </div> 
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-icon">
                                                                    <i class="la la-file-excel-o"></i>
                                                                </span>Excel
                                                            </a>  
                                                        </div> 
                                                    </div> 
                                                    <!--end::Export--> 
                                                </div>
                                                <!--end::Toolbar-->  
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="">Sr. No.</th>
                                                            <th class="min-w-125px">Client Name</th>
                                                            <th class="min-w-125px">Contact Number</th>
                                                            <th class="min-w-75px">Demat Name</th>
                                                            <th class="text-end min-w-100px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        <tr> 
                                                            <td>1</td>
                                                            <td class="d-flex align-items-center"> 
                                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                    <a href="#">
                                                                        <div class="symbol-label">
                                                                            <img src="{{asset("assets/media/avatars/150-1.jpg")}}" alt="Emma Smith" class="w-100" />
                                                                        </div>
                                                                    </a>
                                                                </div> 
                                                                <div class="d-flex flex-column">
                                                                    <a href="#" class="text-gray-800 text-hover-primary mb-1">Ethan Black</a>
                                                                    <span>ethan-black@example.com</span>
                                                                </div> 
                                                            </td> 
                                                            <td>(937) 874 6878</td>  
                                                            <td>Test</td> 
                                                            <td class="text-end">
                                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                    <span class="svg-icon svg-icon-5 m-0">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                        </svg>
                                                                    </span> 
                                                                </a> 
                                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true"> 
                                                                    <div class="menu-item px-3"> 
                                                                        <a href="javascript;:" class="menu-link px-3">Renew</a>
                                                                    </div> 
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript;:" class="menu-link px-3">Terminate</a>
                                                                    </div> 
                                                                </div> 
                                                            </td> 
                                                        </tr>  
                                                        <!--end::Table row-->
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>  
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card--> 
                                </div>
                                <div class="tab-pane fade" id="problemTab" aria-labelledby="problem-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--begin::Card title-->
                                            <!--begin::Card toolbar-->
                                        
                                            <div class="card-toolbar">
                                                <!--begin::Toolbar-->
                                                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base"> 
                                                    <!--begin::Export--> 
                                                    <a href="#" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
                                                                <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
                                                                <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->Export
                                                        <span class="svg-icon svg-icon-5 m-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                            </svg>
                                                        </span> 
                                                    </a> 
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold w-175px py-4" data-kt-menu="true"> 
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-icon">
                                                                    <i class="la la-file-pdf-o"></i>
                                                                </span>PDF
                                                            </a> 
                                                        </div> 
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-icon">
                                                                    <i class="la la-file-excel-o"></i>
                                                                </span>Excel
                                                            </a>  
                                                        </div> 
                                                    </div> 
                                                    <!--end::Export--> 
                                                </div>
                                                <!--end::Toolbar-->  
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="">Sr. No.</th>
                                                            <th class="min-w-125px">Client Name</th>
                                                            <th class="min-w-125px">Contact Number</th>
                                                            <th class="min-w-75px">Demat Name</th>
                                                            <th class="min-w-75px">Problem</th>
                                                            <th class="text-end min-w-100px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        <tr> 
                                                            <td>1</td>
                                                            <td class="d-flex align-items-center"> 
                                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                    <a href="#">
                                                                        <div class="symbol-label">
                                                                            <img src="{{asset("assets/media/avatars/150-1.jpg")}}" alt="Emma Smith" class="w-100" />
                                                                        </div>
                                                                    </a>
                                                                </div> 
                                                                <div class="d-flex flex-column">
                                                                    <a href="#" class="text-gray-800 text-hover-primary mb-1">Ethan Black</a>
                                                                    <span>ethan-black@example.com</span>
                                                                </div> 
                                                            </td> 
                                                            <td>(937) 874 6878</td>  
                                                            <td>Test</td> 
                                                            <td>No fund</td>
                                                            <td class="text-end">
                                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                    <span class="svg-icon svg-icon-5 m-0">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                        </svg>
                                                                    </span> 
                                                                </a> 
                                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true"> 
                                                                    <div class="menu-item px-3"> 
                                                                        <a href="javascript;:" class="menu-link px-3">Issue Resolved</a>
                                                                    </div> 
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript;:" class="menu-link px-3">Terminate</a>
                                                                    </div> 
                                                                </div> 
                                                            </td> 
                                                        </tr>  
                                                        <!--end::Table row-->
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>  
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card--> 
                                </div>
                                <div class="tab-pane fade" id="terminatedTab" aria-labelledby="terminated-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--begin::Card title-->
                                            <!--begin::Card toolbar-->
                                        
                                            <div class="card-toolbar">
                                                <!--begin::Toolbar-->
                                                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base"> 
                                                    <!--begin::Export--> 
                                                    <a href="#" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
                                                                <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
                                                                <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->Export
                                                        <span class="svg-icon svg-icon-5 m-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                            </svg>
                                                        </span> 
                                                    </a> 
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold w-175px py-4" data-kt-menu="true"> 
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-icon">
                                                                    <i class="la la-file-pdf-o"></i>
                                                                </span>PDF
                                                            </a> 
                                                        </div> 
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-icon">
                                                                    <i class="la la-file-excel-o"></i>
                                                                </span>Excel
                                                            </a>  
                                                        </div> 
                                                    </div> 
                                                    <!--end::Export--> 
                                                </div>
                                                <!--end::Toolbar-->  
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="">Sr. No.</th>
                                                            <th class="min-w-125px">Client Name</th>
                                                            <th class="min-w-125px">Contact Number</th>
                                                            <th class="min-w-75px">Demat Name</th> 
                                                            <th class="text-end min-w-100px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        <tr> 
                                                            <td>1</td>
                                                            <td class="d-flex align-items-center"> 
                                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                    <a href="#">
                                                                        <div class="symbol-label">
                                                                            <img src="{{asset("assets/media/avatars/150-1.jpg")}}" alt="Emma Smith" class="w-100" />
                                                                        </div>
                                                                    </a>
                                                                </div> 
                                                                <div class="d-flex flex-column">
                                                                    <a href="#" class="text-gray-800 text-hover-primary mb-1">Ethan Black</a>
                                                                    <span>ethan-black@example.com</span>
                                                                </div> 
                                                            </td> 
                                                            <td>(937) 874 6878</td>  
                                                            <td>Test</td> 
                                                            <td class="text-end">
                                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                    <span class="svg-icon svg-icon-5 m-0">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                        </svg>
                                                                    </span> 
                                                                </a> 
                                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true"> 
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript;:" class="menu-link px-3">Renew</a>
                                                                    </div> 
                                                                </div> 
                                                            </td> 
                                                        </tr>  
                                                        <!--end::Table row-->
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>  
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card--> 
                                </div>
                                <div class="tab-pane fade" id="allTab" aria-labelledby="all-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--begin::Card title-->
                                            <!--begin::Card toolbar-->
                                        
                                            <div class="card-toolbar">
                                                <!--begin::Toolbar-->
                                                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base"> 
                                                    <!--begin::Export--> 
                                                    <a href="#" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
                                                                <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
                                                                <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->Export
                                                        <span class="svg-icon svg-icon-5 m-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                            </svg>
                                                        </span> 
                                                    </a> 
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold w-175px py-4" data-kt-menu="true"> 
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-icon">
                                                                    <i class="la la-file-pdf-o"></i>
                                                                </span>PDF
                                                            </a> 
                                                        </div> 
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-icon">
                                                                    <i class="la la-file-excel-o"></i>
                                                                </span>Excel
                                                            </a>  
                                                        </div> 
                                                    </div> 
                                                    <!--end::Export--> 
                                                </div>
                                                <!--end::Toolbar-->  
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="">Sr. No.</th>
                                                            <th class="min-w-125px">Client Name</th>
                                                            <th class="min-w-125px">Contact Number</th>
                                                            <th class="min-w-75px">Demat Name</th> 
                                                            <th class="text-end min-w-100px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        <tr> 
                                                            <td>1</td>
                                                            <td class="d-flex align-items-center"> 
                                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                    <a href="#">
                                                                        <div class="symbol-label">
                                                                            <img src="{{asset("assets/media/avatars/150-1.jpg")}}" alt="Emma Smith" class="w-100" />
                                                                        </div>
                                                                    </a>
                                                                </div> 
                                                                <div class="d-flex flex-column">
                                                                    <a href="#" class="text-gray-800 text-hover-primary mb-1">Ethan Black</a>
                                                                    <span>ethan-black@example.com</span>
                                                                </div> 
                                                            </td> 
                                                            <td>(937) 874 6878</td>  
                                                            <td>Test</td> 
                                                            <td class="text-end">
                                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                    <span class="svg-icon svg-icon-5 m-0">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                        </svg>
                                                                    </span> 
                                                                </a> 
                                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true"> 
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#actClientView">View</a>
                                                                    </div>
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript;:" class="menu-link px-3">Renew</a>
                                                                    </div> 
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript;:" class="menu-link px-3">Terminate</a>
                                                                    </div> 
                                                                </div> 
                                                            </td> 
                                                        </tr>  
                                                        <!--end::Table row-->
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>  
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card--> 
                                </div> 
                            </div> 
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                @include("footer")
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--begin::Modals-->   
		<!--begin::Modal - Add client-->
		<div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered mw-900px">
				<!--begin::Modal content-->
				<div class="modal-content">
					<!--begin::Modal header-->
					<div class="modal-header">
						<!--begin::Modal title-->
						<h2>Create App</h2>
						<!--end::Modal title-->
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Close-->
					</div>
					<!--end::Modal header-->
					<!--begin::Modal body-->
					<div class="modal-body py-lg-10 px-lg-10">
                        @can("client-create")
						<div data-scroll="true" data-height="300">
							<!--begin::Stepper-->
							<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_app_stepper">
								<!--begin::Aside-->
								<div class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px">
									<!--begin::Nav-->
									<div class="stepper-nav ps-lg-10">
										<!--begin::Step 1-->
										<div class="stepper-item current" data-kt-stepper-element="nav">
											<!--begin::Line-->
											<div class="stepper-line w-40px"></div>
											<!--end::Line-->
											<!--begin::Icon-->
											<div class="stepper-icon w-40px h-40px">
												<i class="stepper-check fas fa-check"></i>
												<span class="stepper-number">1</span>
											</div>
											<!--end::Icon-->
											<!--begin::Label-->
											<div class="stepper-label">
												<h3 class="stepper-title">Personal Details</h3>
											</div>
											<!--end::Label-->
										</div>
										<!--end::Step 1-->
										<!--begin::Step 2-->
										<div class="stepper-item" data-kt-stepper-element="nav">
											<!--begin::Line-->
											<div class="stepper-line w-40px"></div>
											<!--end::Line-->
											<!--begin::Icon-->
											<div class="stepper-icon w-40px h-40px">
												<i class="stepper-check fas fa-check"></i>
												<span class="stepper-number">2</span>
											</div>
											<!--begin::Icon-->
											<!--begin::Label-->
											<div class="stepper-label">
												<h3 class="stepper-title">Demat Details</h3>
											</div>
											<!--begin::Label-->
										</div>
										<!--end::Step 2-->
										<!--begin::Step 3-->
										<div class="stepper-item" data-kt-stepper-element="nav">
											<!--begin::Line-->
											<div class="stepper-line w-40px"></div>
											<!--end::Line-->
											<!--begin::Icon-->
											<div class="stepper-icon w-40px h-40px">
												<i class="stepper-check fas fa-check"></i>
												<span class="stepper-number">3</span>
											</div>
											<!--end::Icon-->
											<!--begin::Label-->
											<div class="stepper-label">
												<h3 class="stepper-title">Payment Details</h3>
											</div>
											<!--end::Label-->
										</div>
										<!--end::Step 3-->
										<!--begin::Step 4-->
										<div class="stepper-item" data-kt-stepper-element="nav">
											<!--begin::Line-->
											<div class="stepper-line w-40px"></div>
											<!--end::Line-->
											<!--begin::Icon-->
											<div class="stepper-icon w-40px h-40px">
												<i class="stepper-check fas fa-check"></i>
												<span class="stepper-number">4</span>
											</div>
											<!--end::Icon-->
											<!--begin::Label-->
											<div class="stepper-label">
												<h3 class="stepper-title">Completed</h3>
												<div class="stepper-desc">Review and Submit</div>
											</div>
											<!--end::Label-->
										</div>
										<!--end::Step 4-->
									</div>
									<!--end::Nav-->
								</div>
								<!--begin::Aside-->
								<!--begin::Content-->
								<div class="flex-row-fluid px-lg-15">
									<!--begin::Form-->
									<form class="form" novalidate="novalidate" id="kt_modal_create_app_form" action="/clients/add" method="POST">
                                        @csrf
										<!--begin::Step 1-->
										<div class="current" data-kt-stepper-element="content">
											<div class="w-100">
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Client Name</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid" name="client[name]" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Mobile No.</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="tel" class="form-control form-control-lg form-control-solid" name="client[number]" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Communication with</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid" name="client[communication_with]" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">WhatsApp No.</span>
														<div class="form-check form-check-custom form-check-solid small" style="margin-left: auto;">
														    <input class="form-check-input" type="checkbox" name="client[wp_number_same]" id="flexCheckDefault"/>
														    <label class="form-check-label" for="flexCheckDefault">
														        (Select if WhatsApp No. is same as Mobile No.)
														    </label>
														</div>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="tel" class="form-control form-control-lg form-control-solid" name="client[wp_number]" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Profession</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<select name="client[profession]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Profession">
														<option></option>
														<option value="Business Man">Business Man</option>
														<option value="Professional">Professional</option>
														<option value="Govt Job">Govt Job</option>
														<option value="Private Job">Private Job</option>
														<option value="Student">Student</option>
														<option value="House wife">House wife</option> 
													</select>
													<!--end::Input-->
												</div>
												<!--end::Input group-->
											</div>
										</div>
										<!--end::Step 1-->
										<!--begin::Step 2-->
										<div class="pending" data-kt-stepper-element="content">
											<div class="w-100">
												<!--begin::Input group-->
												<div class="row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-3">
														<span class="required">Smart ID</span>
													</label>
													<!--end::Label-->
													<!--begin::Col-->
													<div class="col-md-5 fv-row">
														<!--begin::Label-->
														<label class="required fs-6 fw-bold form-label mb-2">ST/SG</label>
														<!--end::Label-->
														<!--begin::Input wrapper-->
														<div class="position-relative">
															<!--begin::Input-->
															<select name="demat[st_sg]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="ST/SG">
																<option></option>
																<option value="ST">ST</option>
																<option value="SG">SG</option> 
															</select>
														</div>
														<!--end::Input wrapper-->
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col-md-7 fv-row">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
															<span class="required">Serial Number</span>
														</label>
														<!--end::Label-->
														<!--begin::Input wrapper-->
														<div class="position-relative">
															<!--begin::Input-->
															<input type="text" name="demat[serial_number]" class="form-control form-control-solid" minlength="8" maxlength="10" placeholder="Serial No" />
															<!--end::Input--> 
														</div>
														<!--end::Input wrapper-->
													</div>
													<!--end::Col-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-3">
														<span class="required">Service Type</span>
													</label>
													<!--end::Label-->
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<!--begin:Option-->
														<label class="d-flex flex-stack cursor-pointer mb-5">
															<!--begin::Label-->
															<span class="d-flex align-items-center me-2"> 
																<!--begin::Info-->
																<span class="d-flex flex-column">
																	<span class="fw-bolder fs-6">Prime</span>
																</span>
																<!--end::Info-->
															</span>
															<!--end::Label-->
															<!--begin::Input-->
															<span class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="radio" name="demat[service_type]" checked="checked" value="1" />
															</span>
															<!--end::Input-->
														</label>
														<!--end::Option-->
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<!--begin:Option-->
														<label class="d-flex flex-stack cursor-pointer mb-5">
															<!--begin::Label-->
															<span class="d-flex align-items-center me-2"> 
																<!--begin::Info-->
																<span class="d-flex flex-column">
																	<span class="fw-bolder fs-6">AMS</span>
																</span>
																<!--end::Info-->
															</span>
															<!--end::Label-->
															<!--begin::Input-->
															<span class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="radio" name="demat[service_type]" value="2" />
															</span>
															<!--end::Input-->
														</label>
														<!--end::Option--> 
													</div>
													<!--end::Col-->
												</div>
												<!--end::Input group--> 
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">PAN Number</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid" name="demat[pan_number]" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Demat Holder's Name</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid" name="demat[holder_name]" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Broker</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<select name="demat[broker]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Profession">
														<option></option>
														<option value="Business Man">Business Man</option>
														<option value="Professional">Professional</option>
														<option value="Govt Job">Govt Job</option>
														<option value="Private Job">Private Job</option>
														<option value="Student">Student</option>
														<option value="House wife">House wife</option> 
													</select>	
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="row mb-8"> 
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span class="required">User ID</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="text" class="form-control form-control-lg form-control-solid" name="demat[user_id]" placeholder="" value="" />	
														<!--end::Input-->
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span class="required">Password</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="password" class="form-control form-control-lg form-control-solid" name="demat[password]" placeholder="" value="" />	
														<!--end::Input-->
													</div>
													<!--end::Col-->
												</div>
												<!--end::Input group--> 
												<!--begin::Input group-->
												<div class="row mb-8"> 
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span class="required">Mpin</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="password" class="form-control form-control-lg form-control-solid" name="demat[mpin]" placeholder="" value="" />	
														<!--end::Input-->
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span class="required">Capital</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="text" class="form-control form-control-lg form-control-solid" name="demat[capital]" placeholder="" value="" />	
														<!--end::Input-->
													</div>
													<!--end::Col-->
												</div>
												<!--end::Input group--> 
											</div>
										</div>
										<!--end::Step 2-->
										<!--begin::Step 3-->
										<div class="pending" data-kt-stepper-element="content">
											<div class="w-100">
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="required fs-5 fw-bold mb-2">Joining Date</label>
													<!--end::Label-->
													<!--begin::Input--> 
													<input type="date" name="payment[joining_date]" class="form-control form-control-lg form-control-solid" placeholder="Select date"/>
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="required fs-5 fw-bold mb-2">Fees</label>
													<!--end::Label-->
													<!--begin::Input--> 
													<input type="text" class="form-control form-control-lg form-control-solid" readonly placeholder="Select Fee" value="25,000" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="required fs-5 fw-bold mb-2">Mode</label>
													<!--end::Label-->
													<!--begin::Input group-->
													<div class="pb-4 border-bottom">
														<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
															<span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Projects</span>
															<input class="form-check-input" name="payment[mode]" type="checkbox" value="1" checked="checked" />
														</label>
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="py-4 border-bottom">
														<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
															<span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Targets</span>
															<input class="form-check-input" name="payment[mode]" type="checkbox" value="1" checked="checked" />
														</label>
													</div>
													<!--end::Input group-->
												</div>
												<!--end::Input group-->
											</div>
										</div>
										<!--end::Step 3-->
										<!--begin::Step 4--> 
										<div class="pending" data-kt-stepper-element="content">
											<div class="w-100 text-center">
												<!--begin::Heading-->
												<h1 class="fw-bolder text-dark mb-3">Release!</h1>
												<!--end::Heading-->
												<!--begin::Description-->
												<div class="text-muted fw-bold fs-3">Submit your app to kickstart your project.</div>
												<!--end::Description-->
												<!--begin::Illustration-->
												<div class="text-center px-4 py-15">
													<img src="{{asset("assets/media/illustrations/sketchy-1/9.png")}}" alt="" class="w-100 mh-300px" />
												</div>
												<!--end::Illustration-->
											</div>
										</div>
										<!--end::Step 4-->
										<!--begin::Actions-->
										<div class="d-flex flex-stack pt-10">
											<!--begin::Wrapper-->
											<div class="me-2">
												<button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
												<span class="svg-icon svg-icon-3 me-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
														<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->Back</button>
											</div>
											<!--end::Wrapper-->
											<!--begin::Wrapper-->
											<div>
												<button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
													<span class="indicator-label">Submit
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
													<span class="svg-icon svg-icon-3 ms-2 me-0">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
															<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon--></span>
													<span class="indicator-progress">Please wait...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
												</button>
												<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
												<span class="svg-icon svg-icon-3 ms-1 me-0">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
														<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon--></button>
											</div>
											<!--end::Wrapper-->
										</div>
										<!--end::Actions-->
									</form>
									<!--end::Form-->
								</div>
								<!--end::Content-->
							</div>
							<!--end::Stepper-->
						</div>
                        @else
                            <h1>Unauthorised</h1>
                        @endcan
					</div>
					<!--end::Modal body-->
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>
		<!--end::Modal - Add client--> 
		<!--begin::Modal - View Client Details--> 
		<div class="modal fade" id="viewClient" tabindex="-1" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered mw-650px" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
						<h2 class="fw-bolder">View Client Details</h2>
						<button type="button" class="btn btn-icon btn-sm btn-active-icon-primary close" data-bs-dismiss="modal" aria-label="Close">
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
								</svg>
							</span>
						</button>
					</div>

					<!--begin::Modal body-->
					<div class="modal-body mx-md-10">
						<!--begin::Form-->
						<form id="" class="form" action="#">
							<!--begin::Scroll-->
							<!-- <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px"> -->
								
								<div class="form-group row">
									<label class="col-3 col-form-label">Client</label>
									<div class="col-9">
										<input class="form-control" type="text" value="" id="client_name" readonly />
                                    </div>
								</div>
								<div class="form-group row">
									<label for="example-email-input" class="col-3 col-form-label">Number</label>
									<div class="col-9">
										<input class="form-control" type="text" value="" id="client_number" readonly /> </div>
								</div> 
								<div class="form-group row">
									<label for="example-tel-input" class="col-3 col-form-label">Profession</label>
									<div class="col-9">
										<input class="form-control" type="text" value="" id="client_profession"  readonly/>
                                    </div>
								</div> 
								<div class="form-group row mb-0">
									<label for="no-of-demat" class="col-3 col-form-label">Status</label>
									<div class="col-9">
										<input class="form-control" type="text" value="" id="client_status"  readonly/>
                                    </div>
								</div> 
							<!-- </div> -->
							<!--end::Scroll--> 
						</form>
						<!--end::Form-->
					</div>
					<!--end::Modal body-->
					<div class="modal-footer text-center">
						<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
						<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
							<span class="indicator-label">Submit</span>
							<span class="indicator-progress">Please wait...
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button> 
					</div>
		        </div>
		    </div>
		</div>
		<!--end::Modal - View Client Details-->
		<!--end::Modals-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            const name = $("#client_name");
            const number = $("#client_number");
            const profession = $("#client_profession");
            const status = $("#client_status");

            $(document).on("click",".viewClient",function(){
                $.ajax("/client/view/"+$(this).attr("data-id"),{
                    type:"GET",
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    }
                })
                .done(data=>{
                    $(name).val(data.name);
                    $(number).val(data.number);
                    $(profession).val(data.profession);
                    $(status).val(((data.status)?"Active":"Inactive"));
                    $("#viewClient").modal("show");
                })
            })
            $("#viewClient").modal("hide");
        })
    </script>
    @section('jscript')
        
    @endsection
@endsection
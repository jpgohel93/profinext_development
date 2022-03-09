@extends('layout')
@section("page-title","Trader")
@section("trader","active")
@section("trading","hover show")
@section("content")
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
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Trader</h1>
                                <!--end::Title-->
                                <!--begin::Separator-->
                                <span class="h-20px border-gray-200 border-start mx-4"></span>
                                <!--end::Separator-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        <a href="/profinext/dist/index.html" class="text-muted text-hover-primary">Home</a>
                                    </li>
                                    <!--end::Item-->  
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-dark">Trader</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                            <!--begin::Actions-->
                            @can('trader-create')
                                <div class="d-flex align-items-center py-1"> 
                                    <a href="#" class="btn btn-lg btn-primary">
                                    Add Trader
                                    </a>
                                </div>
                            @endcan
                            <!--end::Actions--> 
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Post-->
                    @can("trader-read")
                        <div class="post d-flex flex-column-fluid" id="kt_post">
                            <!--begin::Container-->
                            <div id="kt_content_container" class="container-xxl">
                                <!--begin:::Tabs-->
                                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1 active"  data-bs-toggle="tab" href="#trading">Trading</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1"  data-bs-toggle="tab" href="#holding">Holding</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1"  data-bs-toggle="tab" href="#renewal">Renewal</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1"  data-bs-toggle="tab" href="#all">All</a>
                                    </li>
                                    <!--end:::Tab item-->
                                </ul>
                                <!--end:::Tabs-->
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="trading" aria-labelledby="trading-tab" role="tabpanel">
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
                                                            <div class="d-flex justify-content-between">
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
                                                            </div>
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
                                                    @if ($traders->isNotEmpty())
                                                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                                            <!--begin::Table head-->
                                                            <thead>
                                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                    <th class="min-w-10px">Smart ID</th>
                                                                    <th class="min-w-100px">Demat Name</th>
                                                                    <th class="min-w-75px">User ID</th>
                                                                    <th class="min-w-75px">Password</th>
                                                                    <th class="min-w-75px">PIN</th>
                                                                    <th class="min-w-75px">Qty</th>
                                                                    <th class="text-end min-w-60px">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-gray-600 fw-bold">
                                                                @foreach ($traders as $trader)
                                                                    <tr> 
                                                                        <td>{{$trader->withClient->id}}</td>
                                                                        <td class="d-flex align-items-center"> 
                                                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                                <a href="#">
                                                                                    <div class="symbol-label">
                                                                                        <img src="{{asset('assets/media/avatars/150-1.jpg')}}" alt="Emma Smith" class="w-100" />
                                                                                    </div>
                                                                                </a>
                                                                            </div> 
                                                                            <div class="d-flex flex-column">
                                                                                <a href="{{route('clientView',$trader->withClient->id)}}" class="text-gray-800 text-hover-primary mb-1">{{$trader->withClient->name}}</a>
                                                                            </div> 
                                                                        </td> 
                                                                        <td>{{$trader->withClient->id}}</td> 
                                                                        <td>R Power</td> 
                                                                        <td>2314</td>
                                                                        <td>2450</td>
                                                                        <td class="text-end">
                                                                            <div class="d-flex justify-content-end align-items-center">
                                                                                <div class="menu-item">  
                                                                                    <a href="#" class="menu-link btn btn-active-light-primary px-2" data-bs-toggle="modal" data-bs-target="#trading_modal"><i class="fa fa-eye"></i></a>
                                                                                </div> 
                                                                                @can('trader-delete')
                                                                                    <div class="menu-item px-2">  
                                                                                        <a href="javascript:void(0);"  class="menu-link px-2" data-bs-toggle="modal" data-bs-target="#confirmDelete"><i class="fa fa-times not_active text-dark"></i></a>
                                                                                    </div> 
                                                                                @endcan
                                                                                <div>	
                                                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fa fa-ellipsis-v"></i>
                                                                                    </a> 
                                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true"> 
                                                                                        <div class="menu-item px-3">
                                                                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#add_holding">Add Holding</a>
                                                                                        </div>
                                                                                        <div class="menu-item px-3">
                                                                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#add_quantity_modal">Add Qty</a>
                                                                                        </div> 
                                                                                        <div class="menu-item px-3">
                                                                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#square-off-modal">Square Off</a>
                                                                                        </div> 
                                                                                    </div> 
                                                                                </div>
                                                                            </div>
                                                                        </td> 
                                                                    </tr> 
                                                                @endforeach
                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table> 													
                                                    @else
                                                        <h1>No Active Traders</h1>
                                                    @endif
                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <div class="tab-pane fade" id="holding" aria-labelledby="holding-tab" role="tabpanel">
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
                                                            <div class="d-flex justify-content-between">
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
                                                            </div>
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
                                                                <th class="min-w-10px">Smart ID</th>
                                                                <th class="min-w-125px">Demat Name</th>
                                                                <th class="min-w-75px">User ID</th>
                                                                <th class="min-w-75px">Password</th>
                                                                <th class="min-w-75px">PIN</th>
                                                                <th class="min-w-75px">Positions</th>
                                                                <th class="text-end min-w-60px">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                            <tr> 
                                                                <td>1</td>
                                                                <td class="d-flex align-items-center"> 
                                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                        <a href="#">
                                                                            <div class="symbol-label">
                                                                                <img src="/profinext/dist/assets/media/avatars/150-1.jpg" alt="Emma Smith" class="w-100" />
                                                                            </div>
                                                                        </a>
                                                                    </div> 
                                                                    <div class="d-flex flex-column">
                                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">Ethan Black</a>
                                                                        <span>ethan-black@example.com</span>
                                                                    </div> 
                                                                </td> 
                                                                <td>Call</td> 
                                                                <td>R Power</td> 
                                                                <td>2314</td>
                                                                <td>2450</td>
                                                                <td class="text-end">
                                                                    <div class="d-flex justify-content-end align-items-center">
                                                                        <div class="menu-item">  
                                                                            <a href="#" class="menu-link btn btn-active-light-primary px-2" data-bs-toggle="modal" data-bs-target="#holding_modal"><i class="fas fa-eye"></i></a>
                                                                        </div> 
                                                                        <div class="menu-item px-2">  
                                                                            <a href="javascript:void(0);"  class="menu-link px-2"  data-bs-toggle="modal" data-bs-target="#confirmDelete"><i class="fas fa-times not_active text-danger"></i></a>
                                                                        </div> 
                                                                        <div>	
                                                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fas fa-ellipsis-v"></i>
                                                                            </a> 
                                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true"> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#add_holding">Add Holding</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#add_quantity_modal">Add Qty</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#square-off-modal">Square Off</a>
                                                                                </div> 
                                                                            </div> 
                                                                        </div>
                                                                    </div>
                                                                </td> 
                                                            </tr> 
                                                            <tr> 
                                                                <td>2</td>
                                                                <td class="d-flex align-items-center"> 
                                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                        <a href="#">
                                                                            <div class="symbol-label">
                                                                                <img src="/profinext/dist/assets/media/avatars/150-1.jpg" alt="Emma Smith" class="w-100" />
                                                                            </div>
                                                                        </a>
                                                                    </div> 
                                                                    <div class="d-flex flex-column">
                                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">Ethan Black</a>
                                                                        <span>ethan-black@example.com</span>
                                                                    </div> 
                                                                </td> 
                                                                <td>Call</td> 
                                                                <td>Sail</td> 
                                                                <td>78</td>
                                                                <td>85</td>
                                                                <td class="text-end">
                                                                    <div class="d-flex justify-content-end align-items-center">
                                                                        <div class="menu-item">  
                                                                            <a href="#" class="menu-link btn btn-active-light-primary px-2" data-bs-toggle="modal" data-bs-target="#holding_modal"><i class="fas fa-eye"></i></a>
                                                                        </div> 
                                                                        <div class="menu-item px-2">  
                                                                            <a href="javascript:void(0);"  class="menu-link px-2"  data-bs-toggle="modal" data-bs-target="#confirmDelete"><i class="fas fa-times not_active text-danger"></i></a>
                                                                        </div> 
                                                                        <div>	
                                                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fas fa-ellipsis-v"></i>
                                                                            </a> 
                                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true"> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#add_holding">Add Holding</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#add_quantity_modal">Add Qty</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#square-off-modal">Square Off</a>
                                                                                </div> 
                                                                            </div> 
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
                                    <div class="tab-pane fade" id="renewal" aria-labelledby="renewal-tab" role="tabpanel">
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
                                                            <div class="d-flex justify-content-between">
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
                                                            </div>
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
                                                                <th class="min-w-10px">Smart ID</th>
                                                                <th class="min-w-125px">Demat Name</th>
                                                                <th class="min-w-75px">User ID</th>
                                                                <th class="min-w-75px">Password</th>
                                                                <th class="min-w-75px">PIN</th>
                                                                <th class="min-w-75px">Positions</th>
                                                                <th class="min-w-75px">Profit</th>
                                                                <th class="text-end min-w-60px">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                            <tr> 
                                                                <td>1</td>
                                                                <td class="d-flex align-items-center"> 
                                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                        <a href="#">
                                                                            <div class="symbol-label">
                                                                                <img src="/profinext/dist/assets/media/avatars/150-1.jpg" alt="Emma Smith" class="w-100" />
                                                                            </div>
                                                                        </a>
                                                                    </div> 
                                                                    <div class="d-flex flex-column">
                                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">Ethan Black</a>
                                                                        <span>ethan-black@example.com</span>
                                                                    </div> 
                                                                </td> 
                                                                <td>Call</td> 
                                                                <td>R Power</td> 
                                                                <td>2314</td>
                                                                <td>2450</td>
                                                                <td>500</td>
                                                                <td class="text-end">
                                                                    <div class="d-flex justify-content-end align-items-center">
                                                                        <div class="menu-item">  
                                                                            <a href="#" class="menu-link btn btn-active-light-primary px-2" data-bs-toggle="modal" data-bs-target="#renew_modal2"><i class="fas fa-eye"></i></a>
                                                                        </div> 
                                                                        <div class="menu-item px-2">  
                                                                            <a href="javascript:void(0);"  class="menu-link px-2" data-bs-toggle="modal" data-bs-target="#confirmDelete"><i class="fas fa-times not_active text-dark"></i></a>
                                                                        </div> 
                                                                        <div>	
                                                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fas fa-ellipsis-v"></i>
                                                                            </a> 
                                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true"> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#add_holding">Add Holding</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#add_quantity_modal">Add Qty</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#renew_modal2">Renew</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#terminate_modal">Terminate</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#square-off-modal">Square Off</a>
                                                                                </div>
                                                                            </div> 
                                                                        </div>
                                                                    </div>
                                                                </td> 
                                                            </tr> 
                                                            <tr> 
                                                                <td>2</td>
                                                                <td class="d-flex align-items-center"> 
                                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                        <a href="#">
                                                                            <div class="symbol-label">
                                                                                <img src="/profinext/dist/assets/media/avatars/150-1.jpg" alt="Emma Smith" class="w-100" />
                                                                            </div>
                                                                        </a>
                                                                    </div> 
                                                                    <div class="d-flex flex-column">
                                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">Ethan Black</a>
                                                                        <span>ethan-black@example.com</span>
                                                                    </div> 
                                                                </td> 
                                                                <td>Call</td> 
                                                                <td>Sail</td> 
                                                                <td>78</td>
                                                                <td>85</td>
                                                                <td>35</td>
                                                                <td class="text-end">
                                                                    <div class="d-flex justify-content-end align-items-center">
                                                                        <div class="menu-item">  
                                                                            <a href="#" class="menu-link btn btn-active-light-primary px-2" data-bs-toggle="modal" data-bs-target="#renew_modal2"><i class="fas fa-eye"></i></a>
                                                                        </div> 
                                                                        <div class="menu-item px-2">  
                                                                            <a href="javascript:void(0);"  class="menu-link px-2"  data-bs-toggle="modal" data-bs-target="#confirmDelete"><i class="fas fa-times not_active text-danger"></i></a>
                                                                        </div> 
                                                                        <div>	
                                                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fas fa-ellipsis-v"></i>
                                                                            </a> 
                                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true"> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#add_holding">Add Holding</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#add_quantity_modal">Add Qty</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#renew_modal2">Renew</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#terminate_modal">Terminate</a>
                                                                                </div>  
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#square-off-modal">Square Off</a>
                                                                                </div> 
                                                                            </div>
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
                                    <div class="tab-pane fade" id="all" aria-labelledby="all-tab" role="tabpanel">
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
                                                            <div class="d-flex justify-content-between">
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
                                                            </div>
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
                                                                <th class="min-w-10px">Smart ID</th>
                                                                <th class="min-w-125px">Demat Name</th>
                                                                <th class="min-w-75px">Client Name</th>
                                                                <th class="min-w-75px">Renewal Date</th>
                                                                <th class="min-w-75px">Access Profit</th>
                                                                <th class="min-w-75px">Service Type</th>
                                                                <th class="text-end min-w-60px">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                            <tr> 
                                                                <td>1</td>
                                                                <td class="d-flex align-items-center"> 
                                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                        <a href="#">
                                                                            <div class="symbol-label">
                                                                                <img src="/profinext/dist/assets/media/avatars/150-1.jpg" alt="Emma Smith" class="w-100" />
                                                                            </div>
                                                                        </a>
                                                                    </div> 
                                                                    <div class="d-flex flex-column">
                                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">Ethan Black</a>
                                                                        <span>ethan-black@example.com</span>
                                                                    </div> 
                                                                </td> 
                                                                <td>Call</td> 
                                                                <td>R Power</td> 
                                                                <td>2314</td>
                                                                <td>2450</td>
                                                                <td class="text-end">
                                                                    <div class="d-flex justify-content-end align-items-center">
                                                                        <div class="menu-item">  
                                                                            <a href="#" class="menu-link btn btn-active-light-primary px-2" data-bs-toggle="modal" data-bs-target="#allTab"><i class="fas fa-eye"></i></a>
                                                                        </div> 
                                                                        <div class="menu-item px-2">  
                                                                            <a href="javascript:void(0);"  class="menu-link px-2"  data-bs-toggle="modal" data-bs-target="#confirmDelete"><i class="fas fa-times not_active text-danger"></i></a>
                                                                        </div> 
                                                                        <div>	
                                                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fas fa-ellipsis-v"></i>
                                                                            </a> 
                                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true"> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#renew_modal2">Renew</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#terminate_modal">Terminate</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#square-off-modal">Square Off</a>
                                                                                </div>
                                                                            </div> 
                                                                        </div>
                                                                    </div>
                                                                </td> 
                                                            </tr> 
                                                            <tr> 
                                                                <td>2</td>
                                                                <td class="d-flex align-items-center"> 
                                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                        <a href="#">
                                                                            <div class="symbol-label">
                                                                                <img src="/profinext/dist/assets/media/avatars/150-1.jpg" alt="Emma Smith" class="w-100" />
                                                                            </div>
                                                                        </a>
                                                                    </div> 
                                                                    <div class="d-flex flex-column">
                                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">Ethan Black</a>
                                                                        <span>ethan-black@example.com</span>
                                                                    </div> 
                                                                </td> 
                                                                <td>Call</td> 
                                                                <td>Sail</td> 
                                                                <td>78</td>
                                                                <td>85</td>
                                                                <td class="text-end">
                                                                    <div class="d-flex justify-content-end align-items-center">
                                                                        <div class="menu-item">  
                                                                            <a href="#" class="menu-link btn btn-active-light-primary px-2" data-bs-toggle="modal" data-bs-target="#all"><i class="fas fa-eye"></i></a>
                                                                        </div> 
                                                                        <div class="menu-item px-2">  
                                                                            <a href="javascript:void(0);"  class="menu-link px-2"  data-bs-toggle="modal" data-bs-target="#confirmDelete"><i class="fas fa-times not_active text-danger"></i></a>
                                                                        </div> 
                                                                        <div>	
                                                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fas fa-ellipsis-v"></i>
                                                                            </a> 
                                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true"> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#renew_modal2">Renew</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#terminate_modal">Terminate</a>
                                                                                </div> 
                                                                                <div class="menu-item px-3">
                                                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#square-off-modal">Square Off</a>
                                                                                </div>
                                                                            </div> 
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
                    @endcan
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
@endsection
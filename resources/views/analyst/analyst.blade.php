@extends('layout')
@section("page-title","Analst")
@section("analyst","active")
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
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Analyst</h1>
                                <!--end::Title-->
                                <!--begin::Separator-->
                                <span class="h-20px border-gray-200 border-start mx-4"></span>
                                <!--end::Separator-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        <a href="{{route('dashboard')}}" class="text-muted text-hover-primary">Home</a>
                                    </li>
                                    <!--end::Item-->  
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-dark">Analist</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                            <!--begin::Actions-->
                            @can('analyst-create')
                                <div class="d-flex align-items-center py-1"> 
                                    <a href="{{route('createAnalystForm')}}" target="_blank" class="btn btn-lg btn-primary">
                                    Add Analyst
                                    </a>
                                </div>
                            @endcan
                            <!--end::Actions--> 
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Post-->
                    @can('analyst-read')
                        <div class="post d-flex flex-column-fluid" id="kt_post">
                            <!--begin::Container-->
                            <div id="kt_content_container" class="container-xxl">
                                
                                <!--begin:::Tabs-->
                                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1 active"  data-bs-toggle="tab" href="#activeTab">Active</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1"  data-bs-toggle="tab" href="#experimentTab">Experiment</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1"  data-bs-toggle="tab" href="#paperTab">Paper Trade</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1"  data-bs-toggle="tab" href="#terminatedTab">Terminated</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                </ul>
                                <!--end:::Tabs-->

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
                                                                <th class="min-w-125px">Analyst Name</th>
                                                                <th class="min-w-125px">No of Calls</th>
                                                                <th class="min-w-75px">Accuracy</th>
                                                                <th class="min-w-75px">Trading Capacity</th>
                                                                <th class="text-end min-w-100px">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                            @forelse ($analysts['active'] as $analyst)
                                                                <tr> 
                                                                    <td class="d-flex align-items-center"> 
                                                                        <div class="d-flex flex-column">
                                                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$analyst->analyst}}</a>
                                                                        </div> 
                                                                    </td> 
                                                                    <td>{{$analyst->total_calls}}</td>  
                                                                    <td>{{$analyst->accuracy}}</td>
                                                                    <td>{{$analyst->trading_capacity}}</td>
                                                                    <td class="text-end">
                                                                        <div class="d-flex justify-content-end align-items-center">
                                                                            <div class="menu-item px-3">  
                                                                                <a href="javascript:void(0)" class="menu-link px-3 viewAnalyst" data-id='{{$analyst->id}}'>
                                                                                    <img style="height:24px" src="data:image/png;base64,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"/>
                                                                                </a>
                                                                            </div> 
                                                                        </div>
                                                                    </td> 
                                                                </tr> 
                                                            @empty
                                                                <h3>There's no Active Analysts. click <a href='{{route('createAnalystForm')}}'>here</a> to Add new Analyst</h3>
                                                            @endforelse
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
                                    <div class="tab-pane fade" id="experimentTab" aria-labelledby="renewal-tab" role="tabpanel">
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
                                                                <th class="min-w-125px">Client Name</th>
                                                                <th class="min-w-125px">No of Calls</th>
                                                                <th class="min-w-75px">Accuracy</th>
                                                                <th class="min-w-75px">Trading Capacity</th>
                                                                <th class="text-end min-w-100px">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                            @forelse ($analysts['experiment'] as $analyst)
                                                                <tr> 
                                                                    <td class="d-flex align-items-center"> 
                                                                        <div class="d-flex flex-column">
                                                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$analyst->analyst}}</a>
                                                                        </div> 
                                                                    </td> 
                                                                    <td>{{$analyst->total_calls}}</td>  
                                                                    <td>{{$analyst->accuracy}}</td>
                                                                    <td>{{$analyst->trading_capacity}}</td>
                                                                    <td class="text-end">
                                                                        <div class="d-flex justify-content-end align-items-center">
                                                                            <div class="menu-item px-3">  
                                                                                <a href="javascript:void(0)" class="menu-link px-3 viewAnalyst" data-id='{{$analyst->id}}'>
                                                                                    <img style="height:24px" src="data:image/png;base64,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"/>
                                                                                </a>
                                                                            </div> 
                                                                        </div>
                                                                    </td> 
                                                                </tr> 
                                                            @empty
                                                                <h3>There's no Experiment Analysts. click <a href='{{route('createAnalystForm')}}'>here</a> to Add new Analyst</h3>
                                                            @endforelse
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
                                    <div class="tab-pane fade" id="paperTab" aria-labelledby="problem-tab" role="tabpanel">
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
                                                        @if ($analysts['paper_trade']->isNotEmpty())
                                                            <thead>
                                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                    <th class="min-w-125px">Client Name</th>
                                                                    <th class="min-w-125px">No of Calls</th>
                                                                    <th class="min-w-75px">Accuracy</th>
                                                                    <th class="min-w-75px">Trading Capacity</th>
                                                                    <th class="text-end min-w-100px">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-gray-600 fw-bold">
                                                                @foreach ($analysts['paper_trade'] as $analyst)
                                                                    <tr> 
                                                                        <td class="d-flex align-items-center"> 
                                                                            <div class="d-flex flex-column">
                                                                                <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$analyst->analyst}}</a>
                                                                            </div> 
                                                                        </td> 
                                                                        <td>{{$analyst->total_calls}}</td>  
                                                                        <td>{{$analyst->accuracy}}</td>
                                                                        <td>{{$analyst->trading_capacity}}</td>
                                                                        <td class="text-end">
                                                                            <div class="d-flex justify-content-end align-items-center">
                                                                                <div class="menu-item px-3">  
                                                                                    <a href="javascript:void(0)" class="menu-link px-3 viewAnalyst" data-id='{{$analyst->id}}'>
                                                                                        <img style="height:24px" src="data:image/png;base64,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"/>
                                                                                    </a>
                                                                                </div> 
                                                                            </div>
                                                                        </td> 
                                                                    </tr>    
                                                                @endforeach
                                                            </tbody>
                                                        @else
                                                            <h3>There's no Paper Trade Analysts. click <a href='{{route('createAnalystForm')}}'>here</a> to Add new Analyst</h3>
                                                        @endif
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
                                                                <th class="min-w-125px">Client Name</th>
                                                                <th class="min-w-125px">No of Calls</th>
                                                                <th class="min-w-75px">Accuracy</th>
                                                                <th class="min-w-75px">Trading Capacity</th>
                                                                <th class="text-end min-w-100px">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                           @forelse ($analysts['terminated'] as $analyst)
                                                                <tr> 
                                                                    <td class="d-flex align-items-center"> 
                                                                        <div class="d-flex flex-column">
                                                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$analyst->analyst}}</a>
                                                                        </div> 
                                                                    </td> 
                                                                    <td>{{$analyst->total_calls}}</td>  
                                                                    <td>{{$analyst->accuracy}}</td>
                                                                    <td>{{$analyst->trading_capacity}}</td>
                                                                    <td class="text-end">
                                                                        <div class="d-flex justify-content-end align-items-center">
                                                                            <div class="menu-item px-3">  
                                                                                <a href="javascript:void(0)" class="menu-link px-3 viewAnalyst" data-id='{{$analyst->id}}'>
                                                                                    <img style="height:24px" src="data:image/png;base64,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"/>
                                                                                </a>
                                                                            </div> 
                                                                        </div>
                                                                    </td> 
                                                                </tr> 
                                                            @empty
                                                                <h3>There's no Terminated Analysts. click <a href='{{route('createAnalystForm')}}'>here</a> to Add new Analyst</h3>
                                                            @endforelse
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
                    @endcan
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
		<!--begin::Modal - View Analyst Details--> 
		<div class="modal fade" id="viewAnalyst" tabindex="-1" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered mw-650px" role="document">
                <form id="" class="form" method="POST" action="{{route('editAnalyst')}}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="fw-bolder">Analyst Details</h2>
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
                            <input type="hidden" name="analyst_id" id="editAnalystId" value="{{old('analyst_id')}}">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Analyst</label>
                                <div class="col-9">
                                    <input class="form-control" name="analyst" type="text" value="{{old('analyst')}}" id="analyst"  />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-email-input" class="col-3 col-form-label">No of calls</label>
                                <div class="col-9">
                                    <input class="form-control" type="text" name="total_calls" value="{{old('total_calls')}}" id="total_colls"  /> </div>
                            </div> 
                            <div class="form-group row">
                                <label for="example-tel-input" class="col-3 col-form-label">Accuracy</label>
                                <div class="col-9">
                                    <input class="form-control" type="text" value="{{old('accuracy')}}" name="accuracy" id="accuracy"  />
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="example-tel-input" class="col-3 col-form-label">Trading Capacity</label>
                                <div class="col-9">
                                    <input class="form-control" type="text" value="{{old('trading_capacity')}}" name="trading_capacity" id="trading_capacity"  />
                                </div>
                            </div> 
                            <div class="form-group row mb-0">
                                <label for="no-of-demat" class="col-3 col-form-label">Status</label>
                                <div class="col-9">
                                    <select name="status" id="analyst_status" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Status">
                                        <option></option>
                                        <option value="Active" {{(old('status')=="Active")?"selected":""}}>Active</option>
                                        <option value="Experiment" {{(old('status')=="Experiment")?"selected":""}}>Experiment</option>
                                        <option value="Paper Trade" {{(old('status')=="Paper Trade")?"selected":""}}>Paper Trade</option>
                                        <option value="Terminated" {{(old('status')=="Terminated")?"selected":""}}>Terminated</option>
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <!--end::Modal body-->
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-primary" id="closeModel">
                                <span class="indicator-label">Cancle</span>
                            </button> 
                            <button type="submit" id="editAnalyst" class="btn btn-primary" data-kt-users-modal-action="submit">
                                <span class="indicator-label">Save</span>
                            </button> 
                            {{-- <button type="button" id="terminate" name="terminate" class="btn btn-light me-3">Terminate</button> --}}
                        </div>
                    </div>
                </form>
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
    @if ($errors->any())
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $("#viewAnalyst").modal("show");
                $(analyst_status).trigger("change");
            });    
        </script>
    @endif)
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            const analyst = $("#analyst");
            const total_colls = $("#total_colls");
            const accuracy = $("#accuracy");
            const analyst_status = $("#analyst_status");
            const trading_capacity = $("#trading_capacity");
            const editAnalystId = $("#editAnalystId");
            const editAnalyst = $("#editAnalyst");

            $(document).on("click",".viewAnalyst",function(){
                $.ajax("/analyst/"+$(this).attr("data-id"),{
                    type:"GET",
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    }
                })
                .done(data=>{
                    $(analyst).val(data.analyst);
                    $(total_colls).val(data.total_calls);
                    $(accuracy).val(data.accuracy);
                    $(trading_capacity).val(data.trading_capacity);
                    $(analyst_status).val(data.status);
                    $(analyst_status).trigger("change");
                    $(editAnalyst).val(data.id);
                    $(editAnalystId).val(data.id);
                    $("#viewAnalyst").modal("show");
                })
            })
            $("#viewAnalyst").modal("hide");
            $("#closeModel").on("click",function(){
                $("#viewAnalyst").modal("hide");
            })
        })
    </script>
@endsection
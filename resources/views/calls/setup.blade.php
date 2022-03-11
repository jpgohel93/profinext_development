@extends('layout')
@section("page-title","Freelancer")
@section("freelancer","active")
@section("content")
    <link href="{{asset("assets/css/custom.css")}}" rel="stylesheet">
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
                    @if(session("info"))
                        <div class="container">
                            <h6 class="alert alert-info">{{session("info")}}</h6>
                        </div>
                @endif
                <!--begin::Toolbar-->
                        <div class="toolbar" id="kt_toolbar">
                            <!--begin::Container-->
                            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                                <!--begin::Page title-->
                                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                    <!--begin::Title-->
                                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Setup</h1>
                                    <!--end::Title-->
                                    <!--begin::Separator-->
                                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                                    <!--end::Separator-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <a href="profinext/dist/index.html" class="text-muted text-hover-primary">Home</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-dark">Setup</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                            </div>
                            <!--end::Container-->
                        </div>
                    <!--end::Toolbar-->
                    <!--begin::Post-->


                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">

                            <!--begin:::Tabs-->
                            <ul
                                class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1 active" data-bs-toggle="tab"
                                       href="#normalAccount">Normal Account</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#makeAsPreferredAccounr">Make As Preferred Account</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="normalAccount" aria-labelledby="active-tab"
                                     role="tabpanel">
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
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                                  height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                                  fill="black" />
                                                            <path
                                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-user-table-filter="search"
                                                           class="form-control form-control-solid w-250px ps-14"
                                                           placeholder="Search user" />
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
                                                        <a href="#" class="btn btn-light-primary"
                                                           data-kt-menu-trigger="click"
                                                           data-kt-menu-placement="bottom-end">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.3" x="12.75" y="4.25" width="12"
                                                                          height="2" rx="1" transform="rotate(90 12.75 4.25)"
                                                                          fill="black" />
                                                                    <path
                                                                        d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z"
                                                                        fill="black" />
                                                                    <path
                                                                        d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z"
                                                                        fill="#C4C4C4" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Export
                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                        fill="black" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold w-175px py-4"
                                                         data-kt-menu="true">
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
                                                <table class="table align-middle table-row-dashed fs-6 gy-5"
                                                       id="kt_table_users">
                                                @if ($dematAccount['normal']->isNotEmpty())
                                                    <!--begin::Table head-->
                                                        <thead>
                                                        <tr
                                                            class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-10px">Serial Number</th>
                                                            <th class="min-w-75px">Client name</th>
                                                            <th class="min-w-75px">Holder Name</th>
                                                            <th class="min-w-75px">Broker</th>
                                                            <th class="min-w-75px">Available Fund</th>
                                                            <th class="min-w-75px">Profit / Loss</th>
                                                            <th class="min-w-75px">Day of Joining</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @php
                                                            $i=1;
                                                        @endphp
                                                        @foreach($dematAccount['normal'] as $account)
                                                            @php
                                                                $datetime1 = strtotime($account->created_at);
                                                                $datetime2 = strtotime(date("Y-m-d"));
                                                                $days = (int)(($datetime2 - $datetime1)/86400);
                                                            @endphp
                                                            <tr>
                                                                <td>{{$i++}}</td>
                                                                <td> {{$account->st_sg."-".$account->serial_number}} </td>
                                                                <td> {{$account->name}}</td>
                                                                <td> {{$account->holder_name}}</td>
                                                                <td> {{$account->broker}}</td>
                                                                <td> {{$account->available_balance}}</td>
                                                                <td> {{$account->pl}}</td>
                                                                <td> {{ $days }}</td>
                                                                <td class="text-end">
                                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        @can("client-write")
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" data-id='{{$account->id}}' data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' class="menu-link px-3 editDematAccount">Edit</a>
                                                                            </div>
                                                                        @endcan


                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)"
                                                                                   data-id='{{$account->id}}'
                                                                                   class="menu-link px-3 makeAsPreferred"
                                                                                   data-value="1">Make as Preferred</a>
                                                                            </div>
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)"
                                                                                   data-id='{{$account->id}}'
                                                                                   class="menu-link px-3 loginInfo">Login
                                                                                    Info</a>
                                                                            </div>
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)"
                                                                                   class="menu-link px-3"
                                                                                   onclick="myFunction({{$account->id}})">Copy
                                                                                    Login Info</a>
                                                                            </div>
{{--                                                                        <div class="menu-item px-3">--}}
{{--                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 assignFreelancer">Allocate to Trader</a>--}}
{{--                                                                        </div>--}}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    @else
                                                        <h3>there's no normal account.</h3>
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
                                <div class="tab-pane fade show" id="makeAsPreferredAccounr" aria-labelledby="active-tab"
                                     role="tabpanel">
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
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                                  height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                                  fill="black" />
                                                            <path
                                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-user-table-filter="search"
                                                           class="form-control form-control-solid w-250px ps-14"
                                                           placeholder="Search user" />
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
                                                        <a href="#" class="btn btn-light-primary"
                                                           data-kt-menu-trigger="click"
                                                           data-kt-menu-placement="bottom-end">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.3" x="12.75" y="4.25" width="12"
                                                                          height="2" rx="1" transform="rotate(90 12.75 4.25)"
                                                                          fill="black" />
                                                                    <path
                                                                        d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z"
                                                                        fill="black" />
                                                                    <path
                                                                        d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z"
                                                                        fill="#C4C4C4" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Export
                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                        fill="black" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold w-175px py-4"
                                                         data-kt-menu="true">
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
                                                <table class="table align-middle table-row-dashed fs-6 gy-5"
                                                       id="kt_table_users">
                                                @if ($dematAccount['make_as_preferred']->isNotEmpty())
                                                    <!--begin::Table head-->
                                                        <thead>
                                                        <tr
                                                            class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-10px">Serial Number</th>
                                                            <th class="min-w-75px">Client name</th>
                                                            <th class="min-w-75px">Holder Name</th>
                                                            <th class="min-w-75px">Broker</th>
                                                            <th class="min-w-75px">Available Fund</th>
                                                            <th class="min-w-75px">Profit / Loss</th>
                                                            <th class="min-w-75px">Day of Joining</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @php
                                                            $i=1;
                                                        @endphp
                                                        @foreach($dematAccount['make_as_preferred'] as $account)
                                                            @php
                                                                $datetime1 = strtotime($account->created_at);
                                                                $datetime2 = strtotime(date("Y-m-d"));
                                                                $days = (int)(($datetime2 - $datetime1)/86400);
                                                            @endphp
                                                            <tr>
                                                                <td>{{$i++}}</td>
                                                                <td> {{$account->st_sg."-".$account->serial_number}} </td>
                                                                <td> {{$account->name}}</td>
                                                                <td> {{$account->holder_name}}</td>
                                                                <td> {{$account->broker}}</td>
                                                                <td> {{$account->available_balance}}</td>
                                                                <td> {{$account->pl}}</td>
                                                                <td> {{ $days }}</td>
                                                                <td class="text-end">
                                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        @can("client-write")
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" data-id='{{$account->id}}' data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' class="menu-link px-3 editDematAccount">Edit</a>
                                                                            </div>
                                                                        @endcan


                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 makeAsPreferred" data-value="0">Remove as Preferred</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 loginInfo">Login Info</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" class="menu-link px-3" onclick="myFunction({{$account->id}})" >Copy Login Info</a>
                                                                        </div>
{{--                                                                        <div class="menu-item px-3">--}}
{{--                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 assignFreelancer">Allocate to Trader</a>--}}
{{--                                                                        </div>--}}
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    @else
                                                        <h3>there's no make as preferred account.</h3>
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

    <!-- Modal -->
    <div class="modal fade" id="assignFreelancerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('assignClientToFreelancer')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Assign Client to Freelancer</h2>
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
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Client</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="client_Name" readonly/>
                                <input class="form-control" type="hidden" value="" name='client_demate_id' id="assignFreelancerId" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Account Holder Name</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="holder_name" readonly/>
                            </div>
                        </div>
                        <div class="form-group row" id="ams_freelancer">
                            <label for="example-email-input" class="col-3 col-form-label"> AMS freelancer</label>
                            <div class="col-9">
                                <select class="form-select form-select-solid" name='freelancer_id' data-control="select2" data-hide-search="true" data-placeholder="Select AMS freelancer">
                                    <option></option>
                                </select>
                            </div>
                        </div>

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
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - View Client Details-->
    <!--end::Modals-->

    <!-- Modal -->
    <div class="modal fade" id="editDematModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('editClientDematAccount')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Assign Client to Freelancer</h2>
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
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Client</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="demat_client_Name" readonly/>
                                <input class="form-control" type="hidden" value="" name='demate_id' id="demate_id" readonly />
                                <input class="form-control" type="hidden" value="setup" name='form_type' id="form_type" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Account Holder Name</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="demat_holder_name" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Available Balance</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="available_balance" name="available_balance"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Profit / Loss</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="pl" name="pl"/>
                            </div>
                        </div>

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
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - View Client Details-->

    <!-- Modal -->
    <div class="modal fade" id="loginInfoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Login Information</h2>
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
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Broker Name</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="broker_name" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">MPIN</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="mpin" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">User Id</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="user_id" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Password</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="password" readonly/>
                            </div>
                        </div>
                    </div>
                    <!--end::Modal body-->
                    <div class="modal-footer text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                    </div>
                <!--end::Form-->
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

            $(document).on("click",'.assignFreelancer',function(e){
                const id = e.target.getAttribute("data-id");
                const name = e.target.getAttribute("data-name");
                const holderName = e.target.getAttribute("data-holder");
                const service = e.target.getAttribute("data-service");
                if(id){
                    $("#assignFreelancerId").val(id);
                    $("#client_Name").val(name);
                    $("#holder_name").val(holderName);
                    $("#assignFreelancerModal").modal("show");
                }else{
                    window.alert("Unable to Load this Client");
                }
            });

            $(document).on("click",'.editDematAccount',function(e){
                const id = e.target.getAttribute("data-id");
                const name = e.target.getAttribute("data-name");
                const holderName = e.target.getAttribute("data-holder");
                if(id){
                    $("#demate_id").val(id);
                    $("#demat_client_Name").val(name);
                    $("#demat_holder_name").val(holderName);

                    $("#editDematModal").modal("show");
                }else{
                    window.alert("Unable to Load this Client");
                }
            });

            $(document).on("click",'.makeAsPreferred',function(e){
                var id=e.target.getAttribute("data-id");
                var value=e.target.getAttribute("data-value");
                $.ajax("{!! route('makeAsPreferred') !!}",{
                    type:"POST",
                    data:{
                        id:id,
                        is_make_as_preferred: value
                    },
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    success: function(response) {
                        window.location.href = "setup";
                    }
                });
            });

            $(document).on("click",'.loginInfo',function(e){
                $.ajax("/loginInfo/" + $(this).attr("data-id"), {
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    }
                }).done(data => {
                    $("#broker_name").val(data.broker);
                    $("#password").val(data.password);
                    $("#user_id").val(data.user_id);
                    $("#mpin").val(data.mpin);
                    $("#loginInfoModal").modal("show");
                });
            });
        });
        function copyToClipboard(text) {
            var sampleTextarea = document.createElement("textarea");
            document.body.appendChild(sampleTextarea);
            sampleTextarea.value = text; //save main text in it
            sampleTextarea.select(); //select textarea contenrs
            document.execCommand("copy");
            document.body.removeChild(sampleTextarea);
        }

        function myFunction(id){
            $.ajax("/loginInfo/" + id, {
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $("input[name='_token']").val()
                }
            }).done(data => {
                var text =  "Broker Name : " + data.broker + "\n";
                text +=  "MPIN : " + data.password + "\n";
                text +=  "User Id : " + data.user_id + "\n";
                text +=  "Password : " + data.mpin + "\n";
                copyToClipboard(text);
                $("#loginInfoModal").modal("hide");
            });
        }
    </script>
@endsection

@extends('layout')
@section("page-title","Analysis")
@section("analysis.monitor","active")
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
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Monitor</h1>
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
                                    <li class="breadcrumb-item text-dark">Monitor</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center py-1">
                            @can("role-create")
                                <!--begin::Button-->
{{--                                    <a href="#" class="btn btn-sm btn-primary" id="kt_toolbar_primary_button">--}}
{{--									<span class="svg-icon svg-icon-2">--}}
{{--										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--											<rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />--}}
{{--											<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />--}}
{{--										</svg>--}}
{{--									</span>Add Monitor Call--}}
{{--                                    </a>--}}
                                @endcan
                            </div>
                            <!--end::Actions-->
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
                                           href="#analystTab">Analyst</a>
                                    </li>
                                    <!--end:::Tab item-->

                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                           href="#activeTab">Active Call</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                           href="#closedTab">Closed Call</a>
                                    </li>
                                    <!--end:::Tab item-->
                                </ul>
                                <!--end:::Tabs-->

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="analystTab" aria-labelledby="active-tab"
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
                                                    @if ($monitorData['analyst']->isNotEmpty())
                                                        <!--begin::Table head-->
                                                            <thead>
                                                            <tr
                                                                class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-10px">Sr No.</th>
                                                                <th class="min-w-75px">Analyst</th>
                                                                <th class="min-w-75px">Status</th>
                                                                <th class="min-w-75px">No. of Calls Open</th>
                                                                <th class="min-w-75px">No. of Calls Close</th>
                                                                <th class="text-end min-w-100px">Add Call</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                            @php
                                                                $i=1;
                                                            @endphp
                                                            @foreach($monitorData['analyst'] as $monitor)
                                                                <tr>
                                                                    <td>{{$i++}}</td>
                                                                    <td> {{$monitor->analyst}} </td>
                                                                    <td> {{$monitor->status}} </td>
                                                                    <td> {{$monitor->open_call}} </td>
                                                                    <td> {{$monitor->close_call}} </td>
                                                                    <td class="">
                                                                        <div class="d-flex justify-content-center">
                                                                            <div class="menu-item">
                                                                                <!--a href="{{url('/monitor_call/'.$monitor->id)}}" class="menu-link p-1" target="_blank">
                                                                                    <i class="fa fa-plus text-dark fa-2x"></i>
                                                                                </a-->
                                                                                <a data-analysts_id="{{ $monitor->id }}" class="addCall menu-link p-1" target="_blank">
                                                                                    <i class="fa fa-plus text-dark fa-2x"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        @else
                                                            <h3>there's no analyst exists.</h3>
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
                                    <div class="tab-pane fade show" id="activeTab" aria-labelledby="active-tab"
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
                                                    @if ($monitorData['open']->isNotEmpty())
                                                        <!--begin::Table head-->
                                                            <thead>
                                                            <tr
                                                                class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-10px">Sr No.</th>
                                                                <th class="min-w-75px">Date</th>
                                                                <th class="min-w-75px">Script Name</th>
                                                                <th class="min-w-75px">Entry Price</th>
                                                                <th class="min-w-75px">Target</th>
                                                                <th class="text-end min-w-100px">Actions</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                            @php
                                                                $i=1;
                                                            @endphp
                                                            @foreach($monitorData['open'] as $monitor)
                                                                <tr>
                                                                    <td>{{$i++}}</td>
                                                                    <td> {{$monitor->date}} </td>
                                                                    <td> {{$monitor->script_name}} </td>
                                                                    <td> {{$monitor->entry_price}} </td>
                                                                    <td> {{$monitor->target}} </td>
                                                                    <td class="">
                                                                        <div class="d-flex justify-content-center">
                                                                            <div class="menu-item">
                                                                                <!--a href="{{url('/monitor_call_edit/'.$monitor->id)}}" class="menu-link p-1" target="_blank">
                                                                                    <i class="fa fa-edit text-dark fa-2x"></i>
                                                                                </a-->
																				
																				<a data-monitor_id="{{ $monitor->id }}" class="editCall menu-link p-1" target="_blank">
                                                                                    <i class="fa fa-edit text-dark fa-2x"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        @else
                                                            <h3>there's no Active call exists.</h3>
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
                                    <div class="tab-pane fade" id="closedTab" aria-labelledby="closed-tab" role="tabpanel">
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
                                                    @if ($monitorData['close']->isNotEmpty())
                                                        <!--begin::Table head-->
                                                            <thead>
                                                            <tr
                                                                class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-10px">Sr No.</th>
                                                                <th class="min-w-75px">Script Name</th>
                                                                <th class="min-w-75px">P / L</th>
                                                                <th class="min-w-75px">Status</th>
                                                                <th class="min-w-75px">action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="text-gray-600 fw-bold" id="closedCallTable">
                                                            @php
                                                                $i=1;
                                                            @endphp
                                                            @foreach($monitorData['close'] as $monitor)
                                                                <tr>
                                                                    <td>{{$i++}}</td>
                                                                    <td> {{$monitor->script_name}} </td>
                                                                    <td> {{$monitor->exit_price - $monitor->entry_price}} </td>

                                                                        @if($monitor->sl_status == "Target")
                                                                            <td style="background: #0A8A0A;  color: whitesmoke;">{{$monitor->sl_status}}</td>
                                                                        @elseif($monitor->sl_status == "Access Target")
                                                                        <td style="background: #005800;  color: whitesmoke;">{{$monitor->sl_status}}</td>
                                                                        @elseif($monitor->sl_status == "Early Target")
                                                                            <td style="background: #3CBC3C;  color: whitesmoke;">{{$monitor->sl_status}}</td>
                                                                        @elseif($monitor->sl_status == "SL")
                                                                            <td style="background: #FF0A0A;  color: whitesmoke;">{{$monitor->sl_status}}</td>
                                                                        @elseif($monitor->sl_status == "Early SL")
                                                                            <td style="background: #FF4646;  color: whitesmoke;">{{$monitor->sl_status}}</td>
                                                                        @elseif($monitor->sl_status == "Trapped")
                                                                            <td style="background: #C30000; color: whitesmoke;">{{$monitor->sl_status}}</td>
                                                                        @else
                                                                            <td>{{$monitor->sl_status}}</td>
                                                                        @endif

                                                                    <td class="">
                                                                        <div class="d-flex justify-content-center">
                                                                            <div class="menu-item">
                                                                                <a href="{{url('/monitor_call_edit/'.$monitor->id)}}" class="menu-link p-1" target="_blank">
                                                                                    <i class="fa fa-edit text-dark fa-2x"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        @else
                                                            <h3>there's no closed call exists.</h3>
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
            @include("footer")
            </div>
        </div>
    </div>

	<div class="modal fade" id="editCallMdl" tabindex="-1" aria-hidden="true" data-backdrop="true">
		<div class="modal-dialog modal-lg" role="document">
			
		</div>
	</div>

	<div class="modal fade" id="addCallMdl" tabindex="-1" aria-hidden="true" data-backdrop="true">
		<div class="modal-dialog modal-lg" role="document">
			<form id="addCallFrm" class="form" method="POST" action="{{route('createMonitorData')}}">
				@csrf
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="fw-bolder">Add Monitor Data</h2>
						<button type="button" class="btn btn-icon btn-sm btn-active-icon-primary close" data-bs-dismiss="modal" aria-label="Close">
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
								</svg>
							</span>
						</button>
					</div>

					<div class="modal-body mx-md-10">
						<input type="hidden" name="analysts_id" id="analysts_id" value="">
						<div class="row mb-12">
                            <div class="col-md-6">
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Date : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
								<input type="text" value="{{date("Y-m-d",strtotime("now"))}}" class="form-control form-control-lg form-control-solid bdr-ccc" name="date" placeholder="" value="{{date('d-m-Y')}}" />
                            </div>
                        </div>
						
						<div class="row mb-12">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Script Name : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
                                <input list="script_name"  class="form-control form-control-lg form-control-solid bdr-ccc" id="script_name" name="script_name">
								<datalist id="script_name">
									@if(!empty($keywords))
										@foreach($keywords as $keyword)
											<option value="{{$keyword->name}}">{{$keyword->name}}</option>
										@endforeach
									@endif
								</datalist>
                            </div>
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Buy / Sell : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
								<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="buy_sell" id="buy_sell" placeholder="Buy / Sell" value="{{old('buy_sell')}}" />
                            </div>
                            <!--end::Col-->
                        </div>
						
						<div class="row mb-12">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Entry Price : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="entry_price" placeholder="Entry Price" value="{{old('entry_price')}}" />
                            </div>
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Entry Time : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
								<select name="entry_time" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Status">
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
                            </div>
                            <!--end::Col-->
                        </div>
						
						<div class="row mb-12">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">sl : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="sl" placeholder="Enter SL" value="{{old('sl')}}" />
                            </div>
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Target : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
								<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="target" placeholder="Enter Target" value="{{(old('target'))?old('target'):""}}" />
                            </div>
                            <!--end::Col-->
                        </div>
						
					</div>

					<div class="modal-footer text-center">
						<p id="err_msg"></p>
						<button type="button" class="btn btn-primary" id="closeModel">
							<span class="indicator-label">Cancel</span>
						</button>
						<button type="submit" id="submitCall" class="btn btn-primary">
							<span class="indicator-label">Save</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>

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
@endsection

@section('jscript')
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" ></script>
	<script>
	$("#addCallFrm").validate({
		rules: {
			script_name: "required",
			buy_sell: "required",
			entry_price: "required",
			entry_time: "required",
			sl: "required",
			target: "required",
		},
		submitHandler: function(form) {
			$("#submitCall").prop('disabled', true);
			var form_data = new FormData($("#addCallFrm")[0]);
			var formSubmitUrl = $("#addCallFrm").attr('action');
			
			$.ajax({
				type: 'POST',
				url: formSubmitUrl,
				data: form_data,
				dataType: 'json',
				processData: false,
				contentType: false,
				success: function(data) {
					
					if(data.success == true) {
						$("#err_msg").html(data.message).css("color", "green");
						
						setTimeout( function(){
							location.reload(true);
						}, 2500);		
					} else {
						$("#err_msg").html("There is an error, Please correct data.").css("color", "red");
						$("#submitCall").prop('disabled', false);
						
						setTimeout( function(){
							$("#err_msg").html("");
						}, 2500);	
						return false;
					}	
				}, 
				error: function(data) {
					$("#err_msg").html("There is an error, Please correct data.").css("color", "red");
					$("#submitCall").prop('disabled', false);
					
					setTimeout( function(){
						$("#err_msg").html("");
					}, 2500);	
					return false;
				}
			});
		}
	});
		
	 $(document).on('click',"#submitEditCall",function() {
		$("#editCallFrm").validate({
			rules: {
				analysts_id: "required",
				date: "required",
				script_name: "required",
				buy_sell: "required",
				entry_price: "required",
				entry_time: "required",
				sl: "required",
				target: "required",
			},
			submitHandler: function(form) {
				$("#submitEditCall").prop('disabled', true);
				var form_data = new FormData($("#editCallFrm")[0]);
				var formSubmitUrl = $("#editCallFrm").attr('action');
				
				$.ajax({
					type: 'POST',
					url: formSubmitUrl,
					data: form_data,
					dataType: 'json',
					processData: false,
					contentType: false,
					success: function(data) {
						
						if(data.success == true) {
							$("#err_msg1").html(data.message).css("color", "green");
							
							setTimeout( function(){
								location.reload(true);
							}, 2500);		
						} else {
							$("#err_msg1").html("There is an error, Please correct data.").css("color", "red");
							$("#submitEditCall").prop('disabled', false);
							
							setTimeout( function(){
								$("#err_msg1").html("");
							}, 2500);	
							return false;
						}	
					}, 
					error: function(data) {
						$("#err_msg1").html("There is an error, Please correct data.").css("color", "red");
						$("#submitEditCall").prop('disabled', false);
						
						setTimeout( function(){
							$("#err_msg1").html("");
						}, 2500);	
						return false;
					}
				});
			}
		});
	});
	
	$("#addCallMdl").on('shown.bs.modal', function(){
		$("#addCallFrm")[0].reset();
	});
	
	$(document).on("click", ".addCall", function() {
		var analysts_id = $(this).data("analysts_id");
		$("#addCallMdl").modal("show");
		$("#analysts_id").val(analysts_id);
	});
	
	$(document).on("click", ".editCall", function() {
		var edit_id = $(this).data("monitor_id");
		
		$.ajax({
			type: 'POST',
			url: "{{ route('editMonitorDataForm') }}",
			data: {id : edit_id},
			dataType: 'json',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(data) {
				
				$("#editCallMdl .modal-dialog").html(data.message);
				$("#editCallMdl").modal("show");
			}, 
			error: function(data) {
				alert("There is an error, Please try again.");
				//location.reload(true);
			}
		});
	});
	</script>
@endsection

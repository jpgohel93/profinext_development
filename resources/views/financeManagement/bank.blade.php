@extends('layout')
@section("page-title","Bank - Finance Management")
@section("finance_management.bank","active")
@section("finance_management.accordion","hover show")
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
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Finance Management</h1>
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
                                    <li class="breadcrumb-item text-dark">Banks</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <div class="d-flex align-items-center py-1">
								<a href="javascript:void(0);" class="btn btn-sm btn-primary" id="add_bank">
									<span class="svg-icon svg-icon-2">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
											<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
										</svg>
									</span>Add Bank
								</a>
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
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1 active" data-bs-toggle="tab"
                                       href="#forIncome">For Income</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#forSalary">For Salary</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="forIncome" aria-labelledby="active-tab"
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
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                                    @if (isset($forIncomes))
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-10px">Sr. No.</th>
                                                                <th class="min-w-75px">Bank Title</th>
                                                                <th class="min-w-75px">Available Balance</th>
                                                                <th class="min-w-75px">Limit Utilize</th>
                                                                <th class="min-w-75px">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                            @php
                                                                $i=1;
                                                            @endphp
                                                            @foreach($forIncomes as $forIncome)
                                                                <tr>
                                                                    <td>{{sprintf("%04d",$forIncome->id)}}</td>
                                                                    <td>{{$forIncome->title}}</td>
                                                                    <td>{{$forIncome->available_balance}}</td>
                                                                    <td>{{$forIncome->limit_utilize}}</td>
                                                                    <td>
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-eye fa-lg viewBankAccount" data-id="{{$forIncome->id}}" data-bs-toggle="tooltip" title="View More"></i>
                                                                        </a>
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-edit fa-lg setTarget" data-id="{{$forIncome->id}}" data-bs-toggle="tooltip" title="Set Target"></i>
                                                                        </a>
                                                                        @if($forIncome->is_primary)
                                                                            <a href="javascript:void(0)">
                                                                                <i class="fas fa-close fa-lg makeAccountPrimary" id="currentPrimaryAccount" data-id="{{$forIncome->id}}" data-bs-toggle="tooltip" title="Current primary account"></i>
                                                                            </a>
                                                                        @else
                                                                            <a href="javascript:void(0)">
                                                                                <i class="fas fa-check fa-lg makeAccountPrimary" data-id="{{$forIncome->id}}" data-bs-toggle="tooltip" title="Make Account Primary"></i>
                                                                            </a>
                                                                        @endif
                                                                        @if($forIncome->is_active)
                                                                            <a href="javascript:void(0)">
                                                                                <i class="fas fa-unlock fa-lg" data-id="{{$forIncome->id}}" data-bs-toggle="tooltip" title="Deactivate this account"></i>
                                                                            </a>
                                                                        @else
                                                                            <a href="javascript:void(0)">
                                                                                <i class="fas fa-lock fa-lg" data-id="{{$forIncome->id}}" data-bs-toggle="tooltip" title="Deactivated account"></i>
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    @else
                                                        <h3>Details not found</h3>
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
                                <div class="tab-pane fade show" id="forSalary" aria-labelledby="active-tab"
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
                                                @if (isset($forSalaries))
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-10px">Sr No.</th>
                                                                <th class="min-w-75px">Bank Title</th>
                                                                <th class="min-w-75px">Reserve Balance</th>
                                                                <th class="min-w-75px">total Transactions</th>
                                                                <th class="min-w-75px">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                            @php
                                                                $i=1;
                                                            @endphp
                                                            @foreach($forSalaries as $forSalary)
                                                                <tr>
                                                                    <td>{{sprintf("%04d",$forSalary->id)}}</td>
                                                                    <td>{{$forSalary->title}}</td>
                                                                    <td>{{$forSalary->reserve_balance}}</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-eye fa-lg viewBankAccount" data-id="{{$forSalary->id}}" data-bs-toggle="tooltip" title="View More"></i>
                                                                        </a>
                                                                        @if($forSalary->is_active)
                                                                            <a href="javascript:void(0)">
                                                                                <i class="fas fa-unlock fa-lg" data-id="{{$forSalary->id}}" data-bs-toggle="tooltip" title="Deactivate this account"></i>
                                                                            </a>
                                                                        @else
                                                                            <a href="javascript:void(0)">
                                                                                <i class="fas fa-lock fa-lg" data-id="{{$forSalary->id}}" data-bs-toggle="tooltip" title="Deactivated account"></i>
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    @else
                                                        <h3>Details not found</h3>
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
    
    <div class="modal fade" id="add_bank_modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-lg">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0">
                    <!--begin::Close-->
                    <!--begin::Heading-->
                        <div class="">
                            <!--begin::Title-->
                            <h3 class="mb-3" id="modal_title">Add bank</h3>
                            <!--end::Title-->
                        </div>
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
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body">
                    <!--begin:Form-->
                    <form method="POST" action="{{route('addFinanceManagementBank')}}" id="modal_form">
                        @csrf
                        <div id="editIdContainer"></div>
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">Bank Type:</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-select form-select-solid" name="type" id="bank_type" required>
                                        <option value="0">Select Type</option>
                                        <option value='1' {{old('type') && old("type")==1?"selected":""}}>For Income</option>
                                        <option value="2" {{old('type') && old("type")==2?"selected":""}}>For Salary</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">Bank Title:</span>
                                        <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('title')}}" name="title" class="form-control form-control-solid" />
                                </div>
                                
                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">Account Type:</span>
                                        <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('account_type')}}" name="account_type" class="form-control form-control-solid" />
                                </div>
                                
                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">IFSC Code:</span>
                                        <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('ifsc_code')}}" name="ifsc_code" class="form-control form-control-solid" />
                                </div>
                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">Primary Bank:</span>
                                        <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                    </label>
                                    <select class="form-select form-select-solid" name="is_primary" required>
                                        <option value="1" {{old('is_primary') && old("is_primary")==1?"selected":""}}>Yes</option>
                                        <option value="0" {{old('is_primary') && old("is_primary")==2?"selected":""}} selected>No</option>
                                    </select>
                                </div>
                                <div id="forSalaryFields">
                                    <div class="form-group">
                                        <label class="d-flex align-items-center fs-6 fw-bold">
                                            <span class="required">Reserve Balance:</span>
                                            <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" value="{{old('reserve_balance')}}" name="reserve_balance" class="form-control form-control-solid" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="forIncomeFields">
                                    <div class="form-group">
                                        <label class="d-flex align-items-center fs-6 fw-bold">
                                            <span class="required">Available Balance:</span>
                                            <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" value="{{old('available_balance')}}" name="available_balance" class="form-control form-control-solid" />
                                    </div>
                                    <div class="form-group">
                                        <label class="d-flex align-items-center fs-6 fw-bold">
                                            <span class="required">Limit Utilize:</span>
                                            <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" value="{{old('limit_utilize')}}" name="limit_utilize" class="form-control form-control-solid" />
                                    </div>
                                    <div class="form-group">
                                        <label class="d-flex align-items-center fs-6 fw-bold">
                                            <span class="required">Target:</span>
                                            <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" value="{{old('target')}}" name="target" class="form-control form-control-solid" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">Bank Name:</span>
                                        <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('name')}}" name="name" class="form-control form-control-solid" />
                                </div>
                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">Account Name:</span>
                                        <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('account_name')}}" name="account_name" class="form-control form-control-solid" />
                                </div>
                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">Account No:</span>
                                        <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('account_no')}}" name="account_no" class="form-control form-control-solid" />
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        
                        <!--begin::Actions-->
                        <div class="text-end">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary changeStatus">
                                <span class="indicator-label">Add</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <div class="modal fade" id="view_bank_modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-lg">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0">
                    <!--begin::Close-->
                    <!--begin::Heading-->
                        <div class="">
                            <!--begin::Title-->
                            <h3 class="mb-3">View bank</h3>
                            <!--end::Title-->
                        </div>
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
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body">
                    <!--begin:Form-->
                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <div class="form-group">
                                <label class="d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">Bank Type:</span>
                                </label>
                                <!--end::Label-->
                                <select class="form-select form-select-solid" id="view_bank_type" required>
                                    <option value="0">Select Type</option>
                                    <option value='1'>For Income</option>
                                    <option value="2">For Salary</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label class="d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">Bank Title:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="" id="view_title" class="form-control form-control-solid" />
                            </div>
                            
                            <div class="form-group">
                                <label class="d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">Account Type:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="" id="view_account_type" class="form-control form-control-solid" />
                            </div>
                            
                            <div class="form-group">
                                <label class="d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">IFSC Code:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="" id="view_ifsc_code" class="form-control form-control-solid" />
                            </div>
                            <div class="form-group">
                                <label class="d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">Primary Bank:</span>                                    
                                </label>
                                <select class="form-select form-select-solid" id="view_is_primary" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div id="viewForSalaryFields">
                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">Reserve Balance:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="" id="view_reserve_balance" class="form-control form-control-solid" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="viewForIncomeFields">
                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">Available Balance:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="" id="view_available_balance" class="form-control form-control-solid" />
                                </div>
                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">Limit Utilize:</span>                                        
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="" id="view_limit_utilize" class="form-control form-control-solid" />
                                </div>
                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">Target:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="" id="view_target" class="form-control form-control-solid" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">Bank Name:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="" id="view_name" class="form-control form-control-solid" />
                            </div>
                            <div class="form-group">
                                <label class="d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">Account Name:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="" id="view_account_name" class="form-control form-control-solid" />
                            </div>
                            <div class="form-group">
                                <label class="d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">Account No:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="" id="view_account_no" class="form-control form-control-solid" />
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    
                    <!--begin::Actions-->
                    <div class="text-end">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="editBtn" class="btn btn-primary me-3" onclick="window.open('{{route('financeManagementEditBank')}}/'+this.getAttribute('data-id')+'')">Edit</button>
                    </div>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <div class="modal fade" id="setTargetModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0">
                    <!--begin::Close-->
                    <!--begin::Heading-->
                    <div class="">
                        <!--begin::Title-->
                        <h3 class="mb-3">Set target</h3>
                        <!--end::Title-->
                    </div>
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
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body">
                    <!--begin:Form-->
                    <form id="setTargetForm" method="POST" action="{{route('setTargetFinanceManagementBank')}}" class="form">
                        @csrf
                        <div id="editIdContainer"></div>
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Target:</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Set target for selected bank account"></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{old('target')}}" name="target" class="form-control form-control-solid"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        
                        <!--begin::Actions-->
                        <div class="text-end">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Update target</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $("#add_bank").on("click",function(){
                    $("#add_bank_modal").modal("show");
                });
                $("#bank_type").on("change",function(){
                    const type =$(this).val();
                    if(type==1){
                        $("#forIncomeFields").show();
                        $("#forSalaryFields").hide();
                    }else if(type==2){
                        $("#forIncomeFields").hide();
                        $("#forSalaryFields").show();
                    }else{
                        $("#forIncomeFields").hide();
                        $("#forSalaryFields").hide();
                    }
                })
                if({{old('type') && old("type")==1?1:0}}){
                    $("#forIncomeFields").show();
                    $("#forSalaryFields").hide();
                }else if({{old('type') && old("type")==2?1:0}}){
                    $("#forSalaryFields").show();
                    $("#forIncomeFields").hide();
                }else{
                    $("#forSalaryFields").hide();
                    $("#forIncomeFields").hide();
                }
                // view
                $(document).on("click",".viewBankAccount",function(){
                    const id = $(this).data("id");
                    $.ajax("{{route('financeManagementGetBank')}}",{
                        type:"POST",
                        data:{
                            id:id
                        }
                    })
                    .done(data=>{
                        $("#editBtn").attr("data-id",id);
                        $("#view_bank_type").val(data.type).change().prop("disabled",true);
                        if(data.type==1){
                            $("#viewForIncomeFields").show();
                            $("#viewForSalaryFields").hide();
                        }else{
                            $("#viewForSalaryFields").show();
                            $("#viewForIncomeFields").hide();                            
                        }
                        $("#view_title").val(data.title).prop("readonly",true);
                        $("#view_account_type").val(data.account_type).prop("readonly",true);
                        $("#view_ifsc_code").val(data.ifsc_code).prop("readonly",true);
                        $("#view_is_primary").val(data.is_primary).change().prop("disabled",true);
                        $("#view_reserve_balance").val(data.reserve_balance).prop("readonly",true);
                        $("#view_available_balance").val(data.available_balance).prop("readonly",true);
                        $("#view_limit_utilize").val(data.limit_utilize).prop("readonly",true);
                        $("#view_target").val(data.target).prop("readonly",true);
                        $("#view_name").val(data.name).prop("readonly",true);
                        $("#view_account_name").val(data.account_name).prop("readonly",true);
                        $("#view_account_no").val(data.account_no).prop("readonly",true);
                        $("#view_bank_modal").modal("show");
                    })
                    .fail((err,code,xhr)=>{
                        window.alert("Unable to get bank details");
                    })
                })
                // set target for bank account
                $(document).on("click",".setTarget",function(){
                    const id = $(this).data("id");
                    if(id){
                        $("#setTargetForm #editIdContainer").html(`<input type='hidden' value='${id}' name='id'>`);
                        $("#setTargetModal").modal("show");
                    }else{
                        window.alert("Unable to get bank account")
                    }
                })
                // change primary bank account
                $(document).on("click",".makeAccountPrimary",function(){
                    const id = $(this).data("id");
                    if(id){
                        if(window.confirm("This action cannot be undone! Are you sure you want to perform?")){
                            $.ajax("{{route('setPrimaryFinanceManagementBank')}}",{
                                type:"POST",
                                data:{
                                    id:id
                                }
                            })
                            .done(data=>{
                                if(data['info']){
                                    $("#currentPrimaryAccount").removeClass("fa-close").addClass("fa-check").attr("id","");
                                    $("[data-id='"+id+"'].fa-check").addClass("fa-close").removeClass("fa-check").attr("id","currentPrimaryAccount");
                                    $("#kt_toolbar").before(`<div class="container"><h5 class="alert alert-info">${data['info']}</h5></div>`);
                                }
                            })
                            .fail((err,code,xhr)=>{
                                window.alert("Unable to update bank status");
                            })
                        }
                    }else{
                        window.alert("Unable to get bank");
                    }
                })
                const toggelActivateDeactivateAccounts = (status,id)=>{
                    $.ajax("{{route('activateDeactivateAccountFinanceManagementBank')}}",{
                        type:"POST",
                        data:{
                            id:id,
                            status:status
                        }
                    })
                    .fail((err,code,xhr)=>{
                        $("#kt_toolbar").before(`<div class="container"><h5 class="alert alert-info">Unable to update status</h5></div>`);
                    })
                    .done(data=>{
                        if(status==0){
                            $("[data-id='"+id+"'].fa-unlock").removeClass("fa-unlock").addClass("fa-lock");
                        }else{
                            $("[data-id='"+id+"'].fa-lock").removeClass("fa-lock").addClass("fa-unlock");
                        }
                        $("#kt_toolbar").before(`<div class="container"><h5 class="alert alert-info">${data['info']}</h5></div>`);
                    })
                }
                $(document).on("click",".fa-unlock",function(){
                    const id = $(this).data("id");
                    if(id){
                        toggelActivateDeactivateAccounts("0",id);
                    }else{
                        window.alert("Unable to get bank status");
                    }
                })
                $(document).on("click",".fa-lock",function(){
                    const id = $(this).data("id");
                    if(id){
                        toggelActivateDeactivateAccounts("1",id);
                    }else{
                        window.alert("Unable to get bank status");
                    }
                })
            },jQuery)
        })
    </script>
@endsection
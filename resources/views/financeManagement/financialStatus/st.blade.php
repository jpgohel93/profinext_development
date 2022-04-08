@extends('layout')
@section("page-title","View ST - Finance Management")
@section("finance_management.financialStatus","active")
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
                    <div class="card mb-6">
                        <div class="card-body pt-9 pb-0">
                            <!--begin::Details-->
                            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                                <!--begin: Pic-->
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                        <img src="{{asset("assets/media/avatars/150-26.jpg")}}" alt="image" />
                                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                                    </div>
                                </div>
                                <!--end::Pic-->
                                <!--begin::Info-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                        <!--begin::User-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Name-->
                                            <div class="d-flex align-items-center mb-2">
                                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{auth()->user()->name}}</a>
                                            </div>
                                            <!--end::Name-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::Actions-->
                                        <div class="d-flex my-4">
                                            <a href="#" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr012.svg-->
                                                <span class="svg-icon svg-icon-3 d-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M10 18C9.7 18 9.5 17.9 9.3 17.7L2.3 10.7C1.9 10.3 1.9 9.7 2.3 9.3C2.7 8.9 3.29999 8.9 3.69999 9.3L10.7 16.3C11.1 16.7 11.1 17.3 10.7 17.7C10.5 17.9 10.3 18 10 18Z" fill="black" />
                                                        <path d="M10 18C9.7 18 9.5 17.9 9.3 17.7C8.9 17.3 8.9 16.7 9.3 16.3L20.3 5.3C20.7 4.9 21.3 4.9 21.7 5.3C22.1 5.7 22.1 6.30002 21.7 6.70002L10.7 17.7C10.5 17.9 10.3 18 10 18Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <!--begin::Indicator-->
                                                <span class="indicator-label">Follow</span>
                                                <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                <!--end::Indicator-->
                                            </a>
                                            <a href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_offer_a_deal">Hire Me</a>
                                            <!--begin::Menu-->
                                            <div class="me-0">
                                                <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <i class="bi bi-three-dots fs-3"></i>
                                                </button>
                                                <!--begin::Menu 3-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                                                    <!--begin::Heading-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Create Invoice</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link flex-stack px-3">Create Payment
                                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i></a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Generate Bill</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
                                                        <a href="#" class="menu-link px-3">
                                                            <span class="menu-title">Subscription</span>
                                                            <span class="menu-arrow"></span>
                                                        </a>
                                                        <!--begin::Menu sub-->
                                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Plans</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Billing</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Statements</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu separator-->
                                                            <div class="separator my-2"></div>
                                                            <!--end::Menu separator-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <div class="menu-content px-3">
                                                                    <!--begin::Switch-->
                                                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                                                        <!--begin::Input-->
                                                                        <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
                                                                        <!--end::Input-->
                                                                        <!--end::Label-->
                                                                        <span class="form-check-label text-muted fs-6">Recuring</span>
                                                                        <!--end::Label-->
                                                                    </label>
                                                                    <!--end::Switch-->
                                                                </div>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu sub-->
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3 my-1">
                                                        <a href="#" class="menu-link px-3">Settings</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu 3-->
                                            </div>
                                            <!--end::Menu-->
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-wrap flex-stack">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column flex-grow-1 pe-8">
                                            <!--begin::Stats-->
                                            <div class="d-flex flex-wrap">
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$income['day']}}">0</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">
                                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$income['month']}}">0</div>
                                                    </div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$expense['day']}}">0</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">
                                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$expense['month']}}">0</div>
                                                    </div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$income['day']-$expense['day']}}">0</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">
                                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$income['month']-$expense['month']}}">0</div>
                                                    </div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Progress-->
                                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                                <span class="fw-bold fs-6 text-gray-400">Profile Compleation</span>
                                                <span class="fw-bolder fs-6">50%</span>
                                            </div>
                                            <div class="h-5px mx-3 w-100 bg-light mb-3">
                                                <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->
                            <!--begin::Navs-->
                            <div class="d-flex overflow-auto h-55px">
                                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                                    <!--begin::Nav item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#overview">Overview</a>
                                    </li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#demat">Demat</a>
                                    </li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#pl">P & L</a>
                                    </li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#distribution">Distribution</a>
                                    </li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#loan">Loan</a>
                                    </li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#bank">Bank</a>
                                    </li>
                                    <!--end::Nav item-->
                                </ul>
                            </div>
                            <!--begin::Navs-->
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show" id="overview" aria-labelledby="active-tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                            <thead>
                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-10px">Firm Name:</th>
                                                    <th class="min-w-75px">Income</th>
                                                    <th class="min-w-75px">Expense</th>
                                                    <th class="min-w-75px">Clients</th>
                                                    <th class="min-w-75px">Users</th>
                                                    <th class="min-w-75px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold"></tbody>
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <div class="tab-pane fade show active" id="demat" aria-labelledby="active-tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card header-->
                                <div class="card-header border-0 pt-6">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <!--begin::Search-->
                                        <div class="d-flex align-items-center position-relative my-1">
                                            <div class="form-group">
                                                <div id="dematrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                                    <i class="fa fa-calendar"></i>&nbsp;
                                                    <span></span> <i class="fa fa-caret-down"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Search-->
                                    </div>
                                    <!--begin::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="dematTable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr. No</th>
                                                            <th class="min-w-75px">Demat Holder Name</th>
                                                            <th class="min-w-75px">Client Type</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                    </tbody>
                                                
                                                <!--end::Table body-->
                                                </table>
                                                {{-- @if (isset($demat['accounts']))
                                                @else
                                                    <h3>Details not found</h3>
                                                @endif --}}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <!--begin::Summary-->
                                            <div class="card card-flush h-lg-100">
                                                <!--begin::Card header-->
                                                <div class="card-header mt-6">
                                                    <!--begin::Card title-->
                                                    <div class="card-title flex-column">
                                                        <h3 class="fw-bolder mb-1">Client Summary</h3>
                                                    </div>
                                                    <!--end::Card title-->
                                                    <!--begin::Card toolbar-->
                                                    {{-- <div class="card-toolbar">
                                                        <a href="#" class="btn btn-light btn-sm">View Tasks</a>
                                                    </div> --}}
                                                    <!--end::Card toolbar-->
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="card-body p-9 pt-5">
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex flex-wrap">
                                                        <!--begin::Chart-->
                                                        <div class="position-relative d-flex flex-center h-175px w-100 m-auto">
                                                            <div
                                                                class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
                                                                <span class="fs-2qx fw-bolder">{{((isset($demat))?$demat['service_details']['prime']:0)+((isset($demat))?$demat['service_details']['ams']:"")}}</span>
                                                                <span class="fs-6 fw-bold text-gray-400">Total Clients</span>
                                                            </div>
                                                            <canvas id="project_overview_chart" style="display: block;box-sizing: border-box;height: 175px;width: 175px;"></canvas>
                                                        </div>
                                                        <!--end::Chart-->
                                                        <!--begin::Labels-->
                                                        <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                                                            <!--begin::Label-->
                                                            <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                                                <div class="bullet bg-primary me-3"></div>
                                                                <div class="text-gray-400">Prime</div>
                                                                <div class="ms-auto fw-bolder text-gray-700">{{(isset($demat))?$demat['service_details']['prime']:""}}</div>
                                                            </div>
                                                            <!--end::Label-->
                                                            <!--begin::Label-->
                                                            <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                                                <div class="bullet bg-success me-3"></div>
                                                                <div class="text-gray-400">AMS</div>
                                                                <div class="ms-auto fw-bolder text-gray-700">{{(isset($demat))?$demat['service_details']['ams']:""}}</div>
                                                            </div>
                                                            <!--end::Label-->
                                                        </div>
                                                        <!--end::Labels-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                                <!--end::Card body-->
                                            </div>
                                            <!--end::Summary-->
                                        </div>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <div class="tab-pane fade show" id="pl" aria-labelledby="active-tab" role="tabpanel">
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
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-10px">Sr. No</th>
                                                    <th class="min-w-75px">User Name</th>
                                                    <th class="min-w-75px">User Type</th>
                                                    <th class="min-w-75px">Earning</th>
                                                    <th class="min-w-75px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold">
                                                @forelse($usersTab as $user)
                                                    <tr>
                                                        <td>{{$loop->iteration)}}</td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{Config::get("constants.USERS_TYPE")[$user->user_type]}}</td>
                                                        <td>0</td>
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-eye fa-lg" data-id="{{$user->id}}"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    {{-- empty --}}
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
                        <div class="tab-pane fade show" id="distribution" aria-labelledby="active-tab" role="tabpanel">
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
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-75px">Service Type</th>
                                                    <th class="min-w-75px">Clients</th>
                                                    <th class="min-w-75px">Revenue</th>
                                                    <th class="min-w-75px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold">
                                                @if (isset($servicesTab))
                                                    <tr>
                                                        <td>Prime</td>
                                                        <td>{{$servicesTab['prime']}}</td>
                                                        <td>0</td>
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-eye fa-lg"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>AMS</td>
                                                        <td>{{$servicesTab['ams']}}</td>
                                                        <td>0</td>
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-eye fa-lg"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Prime next</td>
                                                        <td>{{$servicesTab['prime_next']}}</td>
                                                        <td>0</td>
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-eye fa-lg"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
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
                        <div class="tab-pane fade show" id="loan" aria-labelledby="active-tab" role="tabpanel">
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
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-75px">Service Type</th>
                                                    <th class="min-w-75px">Clients</th>
                                                    <th class="min-w-75px">Revenue</th>
                                                    <th class="min-w-75px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold">
                                                @if (isset($servicesTab))
                                                    <tr>
                                                        <td>Prime</td>
                                                        <td>{{$servicesTab['prime']}}</td>
                                                        <td>0</td>
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-eye fa-lg"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>AMS</td>
                                                        <td>{{$servicesTab['ams']}}</td>
                                                        <td>0</td>
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-eye fa-lg"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Prime next</td>
                                                        <td>{{$servicesTab['prime_next']}}</td>
                                                        <td>0</td>
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-eye fa-lg"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
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
                        <div class="tab-pane fade show" id="bank" aria-labelledby="active-tab" role="tabpanel">
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
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-75px">Service Type</th>
                                                    <th class="min-w-75px">Clients</th>
                                                    <th class="min-w-75px">Revenue</th>
                                                    <th class="min-w-75px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold">
                                                @if (isset($servicesTab))
                                                    <tr>
                                                        <td>Prime</td>
                                                        <td>{{$servicesTab['prime']}}</td>
                                                        <td>0</td>
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-eye fa-lg"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>AMS</td>
                                                        <td>{{$servicesTab['ams']}}</td>
                                                        <td>0</td>
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-eye fa-lg"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Prime next</td>
                                                        <td>{{$servicesTab['prime_next']}}</td>
                                                        <td>0</td>
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-eye fa-lg"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
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
                <!--end::Content-->
                <!--begin::Footer-->
                @include("footer")
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            // $(".datatable").DataTable();
            // chart
            const project_overview_chart = document.getElementById("project_overview_chart");
            var config = {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: ["{{$demat['service_details']['prime']}}", "{{$demat['service_details']['ams']}}"],
                        backgroundColor: ['#00A3FF', '#50CD89']
                    }],
                    labels: ['Prime', 'AMS']
                },
                options: {
                    chart: {
                        fontFamily: 'inherit'
                    },
                    cutoutPercentage: 75,
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    title: {
                        display: false
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    tooltips: {
                        enabled: true,
                        intersect: false,
                        mode: 'nearest',
                        bodySpacing: 5,
                        yPadding: 10,
                        xPadding: 10,
                        caretPadding: 0,
                        displayColors: false,
                        backgroundColor: '#20D489',
                        titleFontColor: '#ffffff',
                        cornerRadius: 4,
                        footerSpacing: 0,
                        titleSpacing: 0
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            };
            var ctx = project_overview_chart.getContext('2d');
            var myDoughnut = new Chart(ctx, config);
            // date to date filter
            var start = moment().startOf('month');
            var end = moment().endOf('month');

            function cb(start, end) {
                $('#dematrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#dematrange').daterangepicker({
                "showDropdowns": true,
                startDate: start,
                endDate: end,
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);
            cb(start, end);

            // demat table
            // Pipelining function for DataTables. To be used to the `ajax` option of DataTables
            $.fn.dataTable.pipeline = function ( opts ) {
                // Configuration options
                var conf = $.extend( {
                    pages: 5,     // number of pages to cache
                    url: '',      // script url
                    data: null,   // function or object with parameters to send to the server
                                // matching how `ajax.data` works in DataTables
                    method: 'POST' // Ajax HTTP method
                }, opts );
            
                // Private variables for storing the cache
                var cacheLower = -1;
                var cacheUpper = null;
                var cacheLastRequest = null;
                var cacheLastJson = null;
            
                return function ( request, drawCallback, settings ) {
                    var ajax          = false;
                    var requestStart  = request.start;
                    var drawStart     = request.start;
                    var requestLength = request.length;
                    var requestEnd    = requestStart + requestLength;
                    
                    if ( settings.clearCache ) {
                        // API requested that the cache be cleared
                        ajax = true;
                        settings.clearCache = false;
                    }
                    else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
                        // outside cached data - need to make a request
                        ajax = true;
                    }
                    else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
                            JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
                            JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
                    ) {
                        // properties changed (ordering, columns, searching)
                        ajax = true;
                    }
                    
                    // Store the request for checking next time around
                    cacheLastRequest = $.extend( true, {}, request );
            
                    if ( ajax ) {
                        // Need data from the server
                        if ( requestStart < cacheLower ) {
                            requestStart = requestStart - (requestLength*(conf.pages-1));
            
                            if ( requestStart < 0 ) {
                                requestStart = 0;
                            }
                        }
                        
                        cacheLower = requestStart;
                        cacheUpper = requestStart + (requestLength * conf.pages);
            
                        request.start = requestStart;
                        request.length = requestLength*conf.pages;
            
                        // Provide the same `data` options as DataTables.
                        if ( typeof conf.data === 'function' ) {
                            // As a function it is executed with the data object as an arg
                            // for manipulation. If an object is returned, it is used as the
                            // data object to submit
                            var d = conf.data( request );
                            if ( d ) {
                                $.extend( request, d );
                            }
                        }
                        else if ( $.isPlainObject( conf.data ) ) {
                            // As an object, the data given extends the default
                            $.extend( request, conf.data );
                        }
            
                        return $.ajax( {
                            "type":     conf.method,
                            "url":      conf.url,
                            "data":     request,
                            "dataType": "json",
                            "cache":    false,
                            "success":  function ( json ) {
                                cacheLastJson = $.extend(true, {}, json);
            
                                if ( cacheLower != drawStart ) {
                                    json.data.splice( 0, drawStart-cacheLower );
                                }
                                if ( requestLength >= -1 ) {
                                    json.data.splice( requestLength, json.data.length );
                                }
                                
                                drawCallback( json );
                            }
                        } );
                    }
                    else {
                        json = $.extend( true, {}, cacheLastJson );
                        json.draw = request.draw; // Update the echo for each response
                        json.data.splice( 0, requestStart-cacheLower );
                        json.data.splice( requestLength, json.data.length );
            
                        drawCallback(json);
                    }
                }
            };
            
            // Register an API method that will empty the pipelined data, forcing an Ajax
            // fetch on the next draw (i.e. `table.clearPipeline().draw()`)
            $.fn.dataTable.Api.register( 'clearPipeline()', function () {
                return this.iterator( 'table', function ( settings ) {
                    settings.clearCache = true;
                } );
            } );
            
            
            //
            // DataTables initialisation
            //
            $(document).ready(function() {
                $('#dematTable').DataTable( {
                    "processing": true,
                    "serverSide": true,
                    "ajax": $.fn.dataTable.pipeline( {
                        url: '{{route("dematDetailsFinancialStatus")}}',
                        pages: 5 // number of pages to cache
                    } )
                } );
            } );

            // on date change
            $('#dematrange').on('apply.daterangepicker', function(ev, picker) {
                let startDate = picker.startDate.format('YYYY-MM-DD');
                let endDate = picker.endDate.format('YYYY-MM-DD');
                $("#dematTable").dataTable().fnDestroy();
                $("#dematTable").dataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": $.fn.dataTable.pipeline( {
                        url: '{{route("dematDetailsFinancialStatus")}}',
                        pages: 5,
                        data:{
                            startDate:startDate,
                            endDate:endDate
                        }
                    } )
                } );
            });
        })
    </script>
    @section('jscript')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    @endsection
@endsection
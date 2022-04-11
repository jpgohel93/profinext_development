@extends('layout')
@section("page-title","Financial Status - Finance Management")
@section("finance_management.financialStatus","active")
@section("finance_management.accordion","hover show")
@section("content")

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
                                    <li class="breadcrumb-item text-dark">Financial Status</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            {{-- <div class="d-flex align-items-center py-1">
								<a href="javascript:void(0);" class="btn btn-sm btn-primary" id="add_bank">
									<span class="svg-icon svg-icon-2">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
											<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
										</svg>
									</span>Add Bank
								</a>
                            </div> --}}
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
                                       href="#formTab">Firm</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#bankTab">Bank</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#usersTab">User</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#servicesTab">Service</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#balanceTab">Balance</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="formTab" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
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
                                                    <tbody class="text-gray-600 fw-bold">
                                                        @if (isset($firmTab))
                                                            <tr>
                                                                <td>ST</td>
                                                                <td>{{$firmTab['st']['income']}}</td>
                                                                <td>{{$firmTab['st']['expense']}}</td>
                                                                <td>{{$firmTab['st']['clients']}}</td>
                                                                <td>{{$firmTab['st']['users']}}</td>
                                                                <td>
                                                                    <a href="{{route('viewMoreSt')}}" target="_blank">
                                                                        <i class="fas fa-eye fa-xl"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>SG</td>
                                                                <td>{{$firmTab['sg']['income']}}</td>
                                                                <td>{{$firmTab['sg']['expense']}}</td>
                                                                <td>{{$firmTab['sg']['clients']}}</td>
                                                                <td>{{$firmTab['sg']['users']}}</td>
                                                                <td>
                                                                    <a href="{{route('viewMoreSg')}}" target="_blank">
                                                                        <i class="fas fa-eye fa-xl"></i>
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
                                <div class="tab-pane fade show" id="bankTab" aria-labelledby="active-tab"
                                     role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Bank Type</th>
                                                            <th class="min-w-75px">Available Balance</th>
                                                            <th class="min-w-75px">Reserve Balance</th>
                                                            <th class="min-w-75px">Firm’s Balance</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        @forelse($banksTab as $bank)
                                                            <tr>
                                                                <td>{{($bank->type==1?"Income":"Salary")}}</td>
                                                                <td>{{$bank->available_balance}}</td>
                                                                <td>{{$bank->reserve_balance}}</td>
                                                                <td>0</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-eye fa-lg" data-id="{{$bank->id}}"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            {{-- empty --}}
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <div class="tab-pane fade show" id="usersTab" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
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
                                                                <td>{{$loop->iteration}}</td>
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
                                <div class="tab-pane fade show" id="servicesTab" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
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
                                                                <td>Prime Next</td>
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
                                 <div class="tab-pane fade show" id="balanceTab" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-75px">Sr. No</th>
                                                            <th class="min-w-75px">Particular</th>
                                                            <th class="min-w-75px">Balance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        
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
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $(".datatable").DataTable();
            },jQuery)
        })
    </script>
@endsection

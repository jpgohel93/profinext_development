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
                        <div id="kt_toolbar_container" class="container-fluid mx-7 d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Banks</h1>
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
                                    <li class="breadcrumb-item text-dark">Finance management</li>
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
                            <ul class="mx-9 nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1 active" data-bs-toggle="tab" href="#forIncome">For Income</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" href="#forSalary">For Salary</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" href="#cash">Cash</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" href="#blockamount">Block Amount </a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="forIncome" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr. No.</th>
                                                            <th class="min-w-75px">Bank Title</th>
                                                            <th class="min-w-75px">Available Balance</th>
                                                            <th class="min-w-75px">Limit Utilize</th>
                                                            <th class="min-w-75px">Block Amount</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        @forelse($forIncomes as $forIncome)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$forIncome->title}}</td>
                                                                <td>{{$forIncome->available_balance}}</td>
                                                                <td class="text-end">
                                                                    <div class="d-flex flex-column w-100 me-2">
                                                                        <div class="d-flex flex-stack mb-2">
                                                                            <span class="text-muted me-2 fs-7 fw-bold">{{$forIncome->per_limit_utilize}}%({{$forIncome->limit_utilize}})</span>
                                                                        </div>
                                                                        <div class="progress h-6px w-100">
                                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{$forIncome->per_limit_utilize}}%" aria-valuenow="{{$forIncome->per_limit_utilize}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{$forIncome->block_amount}}</td>
                                                                <td>
                                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-state-bg-light-primary menu-gray-600 fw-bold w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" class="menu-link px-3 viewBankAccount" data-id="{{$forIncome->id}}">
                                                                                view
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" class="menu-link px-3" onclick="window.open('{{route('financeManagementEditBank',$forIncome->id)}}')">
                                                                                Edit
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" class="menu-link px-3 setTarget" data-id="{{$forIncome->id}}">
                                                                                Set target
                                                                            </a>
                                                                        </div>
                                                                        @if($forIncome->is_primary)
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" class="menu-link px-3 close makeAccountPrimary" id="currentPrimaryAccount" data-id="{{$forIncome->id}}">
                                                                                    Primary Account
                                                                                </a>
                                                                            </div>
                                                                        @else
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" class="menu-link px-3 check makeAccountPrimary" data-id="{{$forIncome->id}}">
                                                                                    Make primary
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                        @if($forIncome->is_active)
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" class="unlock menu-link px-3" data-id="{{$forIncome->id}}">
                                                                                    Deactivate
                                                                                </a>
                                                                            </div>
                                                                        @else
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" class="lock menu-link px-3" data-id="{{$forIncome->id}}">
                                                                                    Activate
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    </div>
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
                                <div class="tab-pane fade show" id="forSalary" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
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
                                                        @forelse($forSalaries as $forSalary)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$forSalary->title}}</td>
                                                                <td>{{$forSalary->reserve_balance}}</td>
                                                                <td>0</td>
                                                                <td>
                                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-state-bg-light-primary menu-gray-600 fw-bold w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" class="menu-link px-3 viewBankAccount" data-id="{{$forSalary->id}}">
                                                                                view
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" class="menu-link px-3" onclick="window.open('{{route('financeManagementEditBank',$forSalary->id)}}')">
                                                                                Edit
                                                                            </a>
                                                                        </div>
                                                                        @if($forSalary->is_active)
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" class="unlock menu-link px-3" data-id="{{$forSalary->id}}">
                                                                                    Deactivate
                                                                                </a>
                                                                            </div>
                                                                        @else
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" class="lock menu-link px-3" data-id="{{$forSalary->id}}">
                                                                                    Activate
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    </div>
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
                                <div class="tab-pane fade show" id="cash" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Date</th>
                                                            <th class="min-w-75px">Client Name</th>
                                                            <th class="min-w-75px">Received By</th>
                                                            <th class="min-w-75px">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        @forelse($forCashes as $cash)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$cash->joining_date!=""?date("Y-m-d",strtotime($cash->joining_date)):""}}</td>
                                                                <td>{{$cash->clientName}}</td>
                                                                <td>{{$cash->receivedBy}}</td>
                                                                <td>{{$cash->capital}}</td>
                                                            </tr>
                                                        @empty
                                                            {{-- empty  --}}
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
                                <div class="tab-pane fade show" id="blockamount" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Bank Title</th>
                                                            <th class="min-w-75px">Client Name</th>
                                                            <th class="min-w-75px">Received By</th>
                                                            <th class="min-w-75px">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        @forelse($blockAmountlist as $block_amount)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$block_amount['title']}}</td>
                                                                <td>{{$block_amount['st_sg']." - ".$block_amount['serial_number']."  ".$block_amount['name']}}</td>
                                                                <td>{{$block_amount['name']}}</td>
                                                                <td>{{$block_amount['final_amount']}}</td>
                                                            </tr>
                                                        @empty
                                                            {{-- empty  --}}
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
                                    <select class="form-select form-select-solid" name="type" id="bank_type" data-control="select2" data-placeholder="Select bank type" required>
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
                                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Add as primary bank?" name="is_primary" required>
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
                                        <input type="number" value="{{old('available_balance')}}" name="available_balance" class="form-control form-control-solid" />
                                    </div>
                                   <!--  <div class="form-group">
                                        <label class="d-flex align-items-center fs-6 fw-bold">
                                            <span class="required">Limit Utilize:</span>
                                            <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!-- <input type="text" value="{{old('limit_utilize')}}" name="limit_utilize" class="form-control form-control-solid" />
                                    </div> -->
                                    <div class="form-group">
                                        <label class="d-flex align-items-center fs-6 fw-bold">
                                            <span class="required">Target:</span>
                                            <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" value="{{old('target')}}" name="target" class="form-control form-control-solid" />
                                    </div>

                                    <div class="form-group">
                                        <label class="d-flex align-items-center fs-6 fw-bold">
                                            <span class="required">Invoice Code:</span>
                                            <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" value="{{old('invoice_code')}}" name="invoice_code" class="form-control form-control-solid" />
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

                                <div class="form-group">
                                    <label class="d-flex align-items-center fs-6 fw-bold">
                                        <span class="required">PAN Number:</span>
                                        <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('pan_number')}}" name="pan_number" class="form-control form-control-solid" />
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
                                <select class="form-select form-select-solid" id="view_bank_type" data-control="select2" data-placeholder="Select bank type" required>
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
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="add as primary bank?" id="view_is_primary" required>
                                    <option value=""></option>
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
                                    <input type="number" value="" id="view_available_balance" class="form-control form-control-solid" />
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label class="d-flex align-items-center fs-6 fw-bold">--}}
{{--                                        <span class="required">Limit Utilize:</span>--}}
{{--                                    </label>--}}
{{--                                    <!--end::Label-->--}}
{{--                                    <input type="text" value="" id="view_limit_utilize" class="form-control form-control-solid" />--}}
{{--                                </div>--}}
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
                $(".datatable").DataTable();
                $("select[data-control='select2']").select2();
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
                                    $("#currentPrimaryAccount").removeClass("close").addClass("check").attr("id","").text("Make primary");
                                    $("[data-id='"+id+"'].check").addClass("close").removeClass("check").attr("id","currentPrimaryAccount").text("Primary Account");
                                    $("#kt_toolbar").prev(".errContainer").remove();
                                    $("#kt_toolbar").before(`<div class="container errContainer"><h5 class="alert alert-info">${data['info']}</h5></div>`);
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
                            $("[data-id='"+id+"'].unlock").removeClass("unlock").addClass("lock");
                            $("[data-id='"+id+"'].lock").text("Activate");
                        }else{
                            $("[data-id='"+id+"'].lock").removeClass("lock").addClass("unlock");
                            $("[data-id='"+id+"'].unlock").text("Deactivate");
                        }
                        $("#kt_toolbar").prev(".errContainer").remove();
                        $("#kt_toolbar").before(`<div class="container errContainer"><h5 class="alert alert-info">${data['info']}</h5></div>`);
                    })
                }
                $(document).on("click",".unlock",function(){
                    const id = $(this).data("id");
                    if(id){
                        toggelActivateDeactivateAccounts("0",id);
                    }else{
                        window.alert("Unable to get bank status");
                    }
                })
                $(document).on("click",".lock",function(){
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

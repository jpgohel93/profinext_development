@extends('layout')
@section("page-title","Accounting - Finance Management")
@section("finance_management.accounting","active")
@section("finance_management.accordion","hover show")
@section("content")
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
                                    <li class="breadcrumb-item text-dark">Accounting</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Toolbar-->
                    <div>
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold my-3 bg-light navpad"
                            style="float: right;">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <button style="background-color:#3cba54"
                                        class="btn btn-sm mx-2 acountingBtns shadow text-light" id="incomeBtn">
                                    Income
                                </button>
                            </li>
                            <!--end:::Tab item-->

                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <button style="background-color:#db3236"
                                        class="btn btn-sm mx-2 acountingBtns shadow text-light" id="expenseBtn">
                                    Expense
                                </button>
                            </li>
                            <!--end:::Tab item-->

                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <button style="background-color:#4885ed"
                                        class="btn btn-sm mx-2 acountingBtns shadow text-light" id="transferBtn">
                                    Transfer
                                </button>
                            </li>
                            <!--end:::Tab item-->

                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <button style="background-color:#f4c20d"
                                        class="btn btn-sm mx-2 acountingBtns shadow text-light" id="loanBtn">Loan
                                </button>
                            </li>
                            <!--end:::Tab item-->

                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <button style="background-color:#BEBEBE"
                                        class="btn btn-sm mx-2 acountingBtns shadow text-light"
                                        onclick="window.open('{{route('financeManagementHeadings')}}')">Headings
                                </button>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                    </div>
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin:::Tabs-->
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">
                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1 active" data-bs-toggle="tab"href="#all">All</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"href="#income">Income</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"href="#expenses">Expenses</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"href="#transfer">Transfer</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"href="#loan">Loan</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="all" aria-labelledby="active-tab"
                                     role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <div class="form-group">
                                                        <select class="form-select form-select-solid" multiple id="filterDropDown" style="width:100%" data-control="select2" data-placeholder="Select sub heading">
                                                            <option value="all" selected>All</option>
                                                            <option value="income">Income</option>
                                                            <option value="expense">Expense</option>
                                                            <option value="transfer">Transfer</option>
                                                            <option value="loan">Loan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
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
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable" id="allTable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Date</th>
                                                            <th class="min-w-75px">Heading</th>
                                                            <th class="min-w-75px">Sub Heading</th>
                                                            <th class="min-w-75px">Particular</th>
                                                            <th class="min-w-75px">Mode</th>
                                                            <th class="min-w-75px">Amount</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        @php
                                                            $i=1;
                                                        @endphp
                                                        @forelse($incomeRecords as $incomeRecord)
                                                            <tr>
                                                                <td>{{$i++}}</td>
                                                                <td data-sort="{{date("Ymdhis",strtotime($incomeRecord->created_at))}}">{{$incomeRecord->date}}</td>
                                                                <td>Income</td>
                                                                <td>{{$incomeRecord->sub_heading}}</td>
                                                                <td>{{$incomeRecord->text_box}}</td>
                                                                <td>{{($incomeRecord->mode==0)?"Cash":(isset($incomeRecord->bank_name)?$incomeRecord->bank_name->title:"")}}</td>
                                                                <td style="color:#3cba54">{{$incomeRecord->amount}}</td>
                                                                <td>
                                                                    <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$incomeRecord->id}}" class='menu-link px-3 income edit'>
                                                                                Edit
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{route('accounting.income.remove',$incomeRecord->id)}}" class='menu-link px-3 income delete'>
                                                                                Delete
                                                                            </a>
                                                                        </div>
                                                                        @if($incomeRecord->renewal_account_id!=null)
                                                                            @php
                                                                                $invoice_type = isset(Config()->get("constants.INVOICE_TYPE_BY_SUB_HEADING")[$incomeRecord->sub_heading])?Config()->get("constants.INVOICE_TYPE_BY_SUB_HEADING")[$incomeRecord->sub_heading]:3;
                                                                            @endphp
                                                                            <div class="menu-item px-3">
                                                                                <a href="{{route('viewFeesInvoice',[$incomeRecord->renewal_account_id,$invoice_type])}}" class='menu-link px-3 income invoice'>
                                                                                    View invoice
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            {{-- empty --}}
                                                        @endforelse
                                                        @forelse($expensRecords as $expense)
                                                            <tr>
                                                                <td>{{$i++}}</td>
                                                                <td data-sort="{{date("Ymdhis",strtotime($expense->created_at))}}">{{$expense->date}}</td>
                                                                <td>Expense</td>
                                                                <td>{{$expense->sub_heading}}</td>
                                                                <td>{{$expense->text_box}}</td>
                                                                <td>{{($expense->mode==0)?"Cash":(isset($expense->bank_name)?$expense->bank_name->title:"")}}</td>
                                                                <td style="color:#db3236">{{$expense->amount}}</td>
                                                                <td>
                                                                    <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$expense->id}}" class='menu-link px-3 expense edit'>
                                                                                Edit
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{route('accounting.expense.remove',$expense->id)}}" class='menu-link px-3 expense delete'>
                                                                                Delete
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            {{-- empty --}}
                                                        @endforelse
                                                        @forelse($transferRecords as $transfer)
                                                            <tr>
                                                                <td>{{$i++}}</td>
                                                                <td data-sort="{{date("Ymdhis",strtotime($transfer->created_at))}}">{{$transfer->date}}</td>
                                                                <td>Transfer</td>
                                                                <td>{{$transfer->purpose}}</td>
                                                                <td>{{$transfer->narration}}</td>
                                                                <td>{{$transfer->from}}</td>
                                                                <td style="color:#4885ed">{{$transfer->amount}}</td>
                                                                <td>
                                                                    <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$transfer->id}}" class='menu-link px-3 transfer edit'>
                                                                                Edit
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{route('accounting.transfer.remove',$transfer->id)}}" class='menu-link px-3 transfer delete'>
                                                                                Delete
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            {{-- empty --}}
                                                        @endforelse
                                                        @forelse($loanRecords as $loan)
                                                            <tr>
                                                                <td>{{$i++}}</td>
                                                                <td data-sort="{{date("Ymdhis",strtotime($loan->created_at))}}">{{$loan->date}}</td>
                                                                <td>Loan</td>
                                                                <td>{{$loan->sub_heading}}</td>
                                                                <td>{{$loan->narration}}</td>
                                                                <td>{{($loan->mode==0)?"Cash":(isset($loan->bank_name)?$loan->bank_name->title:"")}}</td>
                                                                <td style="color:#f4c20d">{{$loan->amount}}</td>
                                                                <td>
                                                                    <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$loan->id}}" class='menu-link px-3 loan edit'>
                                                                                Edit
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{route('accounting.loan.remove',$loan->id)}}" class='menu-link px-3 loan delete'>
                                                                                Delete
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$loan->id}}" class='menu-link px-3 loan invoice'>
                                                                                View invoice
                                                                            </a>
                                                                        </div>
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
                                <div class="tab-pane fade show" id="income" aria-labelledby="active-tab"
                                     role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <div class="form-group">
                                                        <div id="incomeFilter" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
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
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable" id="incomeTable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Date</th>
                                                            <th class="min-w-75px">Sub Heading</th>
                                                            <th class="min-w-75px">Client Name</th>
                                                            <th class="min-w-75px">Mode</th>
                                                            <th class="min-w-75px">Amount</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($incomeRecords as $incomeRecord)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$incomeRecord->date}}</td>
                                                                <td>{{$incomeRecord->sub_heading}}</td>
                                                                <td>{{$incomeRecord->text_box}}</td>
                                                                <td>{{($incomeRecord->mode==0)?"Cash":(isset($incomeRecord->bank_name)?$incomeRecord->bank_name->title:"")}}</td>
                                                                <td style="color:#3cba54">{{$incomeRecord->amount}}</td>
                                                                <td>
                                                                    <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$incomeRecord->id}}" class='menu-link px-3 income edit'>
                                                                                Edit
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$incomeRecord->id}}" class='menu-link px-3 income delete'>
                                                                                Delete
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$incomeRecord->id}}" class='menu-link px-3 income invoice'>
                                                                                View invoice
                                                                            </a>
                                                                        </div>
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
                                <div class="tab-pane fade show" id="expenses" aria-labelledby="active-tab"
                                     role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <div class="form-group">
                                                        <div id="expenseFilter" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
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
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable" id="expenseTable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Date</th>
                                                            <th class="min-w-75px">Sub Heading</th>
                                                            <th class="min-w-75px">Client Name</th>
                                                            <th class="min-w-75px">Mode</th>
                                                            <th class="min-w-75px">Amount</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        @forelse($expensRecords as $expense)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$expense->date}}</td>
                                                                <td>{{$expense->sub_heading}}</td>
                                                                <td>{{$expense->text_box}}</td>
                                                                <td>{{($expense->mode==0)?"Cash":(isset($expense->bank_name)?$expense->bank_name->title:"")}}</td>
                                                                <td style="color:#db3236">{{$expense->amount}}</td>
                                                                <td>
                                                                    <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$expense->id}}" class='menu-link px-3 expense edit'>
                                                                                Edit
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$expense->id}}" class='menu-link px-3 expense delete'>
                                                                                Delete
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$expense->id}}" class='menu-link px-3 expense invoice'>
                                                                                View invoice
                                                                            </a>
                                                                        </div>
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
                                <div class="tab-pane fade show" id="transfer" aria-labelledby="active-tab"
                                     role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <div class="form-group">
                                                        <div id="transferFilter" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
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
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable" id="transferTable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Date</th>
                                                            <th class="min-w-75px">From</th>
                                                            <th class="min-w-75px">Purpose</th>
                                                            <th class="min-w-75px">To</th>
                                                            <th class="min-w-75px">Narration</th>
                                                            <th class="min-w-75px">Amount</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        @forelse($transferRecords as $transfer)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$transfer->date}}</td>
                                                                <td>{{$transfer->from}}</td>
                                                                <td>{{$transfer->purpose}}</td>
                                                                <td>{{$transfer->to}}</td>
                                                                <td>{{$transfer->narration}}</td>
                                                                <td style="color:#4885ed">{{$transfer->amount}}</td>
                                                                <td>
                                                                    <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$transfer->id}}" class='menu-link px-3 transfer edit'>
                                                                                Edit
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$transfer->id}}" class='menu-link px-3 transfer delete'>
                                                                                Delete
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$transfer->id}}" class='menu-link px-3 transfer invoice'>
                                                                                View invoice
                                                                            </a>
                                                                        </div>
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
                                <div class="tab-pane fade show" id="loan" aria-labelledby="active-tab"
                                     role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <div class="form-group">
                                                        <div id="loanFilter" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
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
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable" id="loanTable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Date</th>
                                                            <th class="min-w-75px">Sub Heading</th>
                                                            <th class="min-w-75px">User</th>
                                                            <th class="min-w-75px">Narration</th>
                                                            <th class="min-w-75px">Mode</th>
                                                            <th class="min-w-75px">Interest</th>
                                                            <th class="min-w-75px">Amount</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($loanRecords as $loan)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$loan->date}}</td>
                                                                <td>{{$loan->sub_heading}}</td>
                                                                <td>{{$loan->user_name->name}}</td>
                                                                <td>{{$loan->narration}}</td>
                                                                <td>{{($loan->mode==0)?"Cash":(isset($loan->bank_name)?$loan->bank_name->title:"")}}</td>
                                                                <td>{{$loan->interest}}</td>
                                                                <td style="color:#f4c20d">{{$loan->amount}}</td>
                                                                <td>
                                                                    <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$loan->id}}" class='menu-link px-3 loan edit'>
                                                                                Edit
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$loan->id}}" class='menu-link px-3 loan delete'>
                                                                                Delete
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$loan->id}}" class='menu-link px-3 loan invoice'>
                                                                                View invoice
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            {{-- empty --}}
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            <!--end::Table body-->
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
    <div class="modal fade" id="incomeModel" tabindex="-1" aria-hidden="true">
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
                            <h3 class="mb-3">Income:</h3>
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
                    <form method="POST" action="{{route('accounting.income')}}" id="incomeForm" class="form">
                        @csrf
                        <div class="row mb-8">
                            <div id="incomeEditIdContainer"></div>
                            <!--begin::Col-->
                            <div class="col-md-12">
                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Date:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="date" value="{{old('date')}}" id='date' name="date" class="form-control form-control-solid" value="{{date("Y/m/d")}}"/>
                                </div>

                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Sub Heading:</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-select form-select-solid" id="sub_heading" name="sub_heading" data-control="select2" data-placeholder="Select sub heading">
                                        <option value=""></option>
                                        @forelse ($headings['income'] as $heading)
                                            <option value="{{$heading->sub_heading}}">{{$heading->sub_heading}}</option>
                                        @empty
                                            {{-- empty --}}
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Text Box:</span>
                                    </label>
                                    <textarea type="text" class="form-control mx-3" id="text_box" name='text_box'></textarea>
                                </div>
                                <div class="form-group col-md-3">
                                     <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Cash</span>
                                        <input class="form-check-input togglePaymentMode" togglePaymentMode type="checkbox" name="mode" value="0" />
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 px-2 me-2" style="min-width: max-content;">By Bank</span>
                                    </label>
                                </div>
                                <div class="form-group incomeBankDropDown" style="display:none">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Bank:</span>
                                    </label>
                                    <select class="form-select form-select-solid" id="bank" name="bank" data-control="select2">
                                        @forelse ($incomeBanks as $bank)
                                            <option value="{{$bank->id}}">{{$bank->title}}</option>
                                        @empty
                                            <option value="" selected>Select bank</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group transactionFormDropDown">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Income form:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select form of income"></i>
                                    </label>
                                    <select class="form-select form-select-solid transactionForm" id="income_form" name="income_form" id="income_smartId" data-control="select2">
                                        <option value="st" selected>ST</option>
                                        <option value="sg">SG</option>
                                        <option value="both">Both</option>
                                    </select>
                                </div>
                                <div class="row bothFormOfIncome" id="bothFormOfIncome" style="display:none">
                                    <div class="form-group">
                                        <!--begin::Label-->
                                       <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                           <span class="required">ST:</span>
                                       </label>
                                       <!--end::Label-->
                                       <input type="text" value="{{old('st_amount')}}" id="st_amount" name="st_amount" class="form-control form-control-solid" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <!--begin::Label-->
                                       <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                           <span class="required">SG:</span>
                                       </label>
                                       <!--end::Label-->
                                       <input type="text" value="{{old('sg_amount')}}" id="sg_amount" name="sg_amount" class="form-control form-control-solid" value=""/>
                                    </div>
                                </div>
                                <div class="form-group mainAmount">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Amount:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('amount')}}" name="amount" id="incomeAmount" class="form-control form-control-solid" value=""/>
                                </div>
                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Narration:</span>
                                    </label>
                                    <textarea type="text" class="form-control mx-3" id="narration" name='narration'></textarea   tarea>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-left">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
    <div class="modal fade" id="expensesModel" tabindex="-1" aria-hidden="true">
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
                            <h3 class="mb-3">Expenses:</h3>
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
                    <form method="POST" id="expenseForm" action="{{route('accounting.expense')}}" class="form">
                        @csrf
                        <div class="row mb-8">
                            <div id="expenseEditIdContainer"></div>
                            <!--begin::Col-->
                            <div class="col-md-12">
                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Date:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="date" value="{{old('date')}}" name="date" class="form-control form-control-solid" value="{{date("Y/m/d")}}"/>
                                </div>

                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Sub Heading:</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-select form-select-solid" name="sub_heading" data-control="select2" data-placeholder="Select sub heading">
                                        @forelse ($headings['expenses'] as $heading)
                                            <option value="{{$heading->sub_heading}}">{{$heading->sub_heading}}</option>
                                        @empty
                                            <option value="">Select Heading</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Text Box:</span>
                                    </label>
                                    <textarea type="text" class="form-control mx-3" name='text_box'></textarea>
                                </div>
                                <div class="form-group col-md-3">
                                     <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Cash</span>
                                        <input class="form-check-input togglePaymentMode" togglePaymentMode type="checkbox" name="mode" value="0" />
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 px-2 me-2" style="min-width: max-content;">By Bank</span>
                                    </label>
                                </div>
                                <div class="form-group incomeBankDropDown" style="display:none">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Bank:</span>
                                    </label>
                                    <select class="form-select form-select-solid" name="bank" data-control="select2">
                                        @forelse ($incomeBanks as $bank)
                                            <option value="{{$bank->id}}">{{$bank->title}}</option>
                                        @empty
                                            <option value="" selected>Select bank</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group transactionFormDropDown">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Income form:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select form of income"></i>
                                    </label>
                                    <select class="form-select form-select-solid transactionForm" name="income_form" id="expense_smartId" data-control="select2">
                                        <option value="st" selected>ST</option>
                                        <option value="sg">SG</option>
                                        <option value="both">Both</option>
                                    </select>
                                </div>
                                <div class="row bothFormOfIncome" id="bothFormOfIncome" style="display:none">
                                    <div class="form-group">
                                        <!--begin::Label-->
                                       <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                           <span class="required">ST:</span>
                                       </label>
                                       <!--end::Label-->
                                       <input type="text" value="{{old('st_amount')}}" name="st_amount" class="form-control form-control-solid" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <!--begin::Label-->
                                       <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                           <span class="required">SG:</span>
                                       </label>
                                       <!--end::Label-->
                                       <input type="text" value="{{old('sg_amount')}}" name="sg_amount" class="form-control form-control-solid" value=""/>
                                    </div>
                                </div>
                                <div class="form-group mainAmount">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Amount:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('amount')}}" name="amount" class="form-control form-control-solid" value=""/>
                                </div>
                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Narration:</span>
                                    </label>
                                    <textarea type="text" class="form-control mx-3" name='narration'></textarea   tarea>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-left">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
    <div class="modal fade" id="transferModel" tabindex="-1" aria-hidden="true">
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
                        <h3 class="mb-3">Transfer:</h3>
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
                    <form method="POST" id="transferForm" action="{{route('accounting.transfer')}}" class="form">
                        @csrf
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-md-12">
                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Date:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="date" value="{{old('date')}}" name="date" class="form-control form-control-solid" value="{{date("Y/m/d")}}"/>
                                </div>

                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">From:</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-select form-select-solid" name="from" id="transferFrom" data-control="select2" data-placeholder="Select sub heading">
                                        @forelse ($incomeBanks as $bank)
                                            <option value="cash">Cash</option>
                                            <option value="{{$bank->title}}">{{$bank->title}}</option>
                                        @empty
                                            <option value="">Select option</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Purpose:</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-select form-select-solid" name="purpose" id="transferPurpose" data-control="select2" data-placeholder="Select sub heading">
                                        @forelse ($headings['income'] as $heading)
                                            <option value="{{$heading->sub_heading}}">{{$heading->sub_heading}}</option>
                                        @empty
                                            <option value="">Select Heading</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">To:</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-select form-select-solid" name="to" id="transferTo" data-control="select2" data-placeholder="Select Bank"></select>
                                </div>
                                <div class="form-group transactionFormDropDown">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Income form:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select form of income"></i>
                                    </label>
                                    <select class="form-select form-select-solid transactionForm" name="income_form" id="transfer_smartID" data-control="select2">
                                        <option value="st" selected>ST</option>
                                        <option value="sg">SG</option>
                                        <option value="both">Both</option>
                                    </select>
                                </div>
                                <div class="row bothFormOfIncome" id="bothFormOfIncome" style="display:none">
                                    <div class="form-group">
                                        <!--begin::Label-->
                                       <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                           <span class="required">ST:</span>
                                       </label>
                                       <!--end::Label-->
                                       <input type="text" value="{{old('st_amount')}}" name="st_amount" class="form-control form-control-solid" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <!--begin::Label-->
                                       <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                           <span class="required">SG:</span>
                                       </label>
                                       <!--end::Label-->
                                       <input type="text" value="{{old('sg_amount')}}" name="sg_amount" class="form-control form-control-solid" value=""/>
                                    </div>
                                </div>
                                <div class="form-group mainAmount">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Amount:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('amount')}}" name="amount" class="form-control form-control-solid" value=""/>
                                </div>
                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Narration:</span>
                                    </label>
                                    <textarea type="text" class="form-control mx-3" name='narration'></textarea>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-left">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
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
    <div class="modal fade" id="loanModel" tabindex="-1" aria-hidden="true">
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
                            <h3 class="mb-3">Loan:</h3>
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
                    <form method="POST" action="{{route('accounting.loan')}}" class="form">
                        @csrf
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-md-12">
                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Date:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="date" value="{{old('date')}}" name="date" class="form-control form-control-solid" value="{{date("Y/m/d")}}"/>
                                </div>

                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Sub Heading:</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-select form-select-solid" name="sub_heading" data-control="select2" data-placeholder="Select sub heading">
                                        @forelse ($headings['loan'] as $loan)
                                            <option value="{{$loan->sub_heading}}">{{$loan->sub_heading}}</option>
                                        @empty
                                            <option value="">Select option</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Users:</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-select form-select-solid" name="user" data-control="select2" data-placeholder="Select sub heading">
                                        @forelse ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @empty
                                            <option value="">Select User</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                     <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Cash</span>
                                        <input class="form-check-input togglePaymentMode" togglePaymentMode type="checkbox" name="mode" value="0" />
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 px-2 me-2" style="min-width: max-content;">By Bank</span>
                                    </label>
                                </div>
                                <div class="form-group incomeBankDropDown" style="display:none">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Bank:</span>
                                    </label>
                                    <select class="form-select form-select-solid" name="bank" data-control="select2">
                                        @forelse ($incomeBanks as $bank)
                                            <option value="{{$bank->id}}">{{$bank->title}}</option>
                                        @empty
                                            <option value="" selected>Select bank</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group transactionFormDropDown">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Income form:</span>
                                    </label>
                                    <select class="form-select form-select-solid transactionForm" name="income_form" id="loan_smartId" data-control="select2">
                                        <option value="st" selected>ST</option>
                                        <option value="sg">SG</option>
                                        <option value="both">Both</option>
                                    </select>
                                </div>
                                <div class="row bothFormOfIncome" id="bothFormOfIncome" style="display:none">
                                    <div class="form-group">
                                        <!--begin::Label-->
                                       <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                           <span class="required">ST:</span>
                                       </label>
                                       <!--end::Label-->
                                       <input type="text" value="{{old('st_amount')}}" name="st_amount" class="form-control form-control-solid" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <!--begin::Label-->
                                       <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                           <span class="required">SG:</span>
                                       </label>
                                       <!--end::Label-->
                                       <input type="text" value="{{old('sg_amount')}}" name="sg_amount" class="form-control form-control-solid" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Interest:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('interest')}}" name="interest" class="form-control form-control-solid" value=""/>
                                </div>
                                <div class="form-group mainAmount">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Amount:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('amount')}}" name="amount" class="form-control form-control-solid" value=""/>
                                </div>
                                <div class="form-group">
                                     <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Narration:</span>
                                    </label>
                                    <textarea type="text" class="form-control mx-3" name='narration'></textarea>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-left">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
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
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $("select").select2();
                var table = $("table.datatable").DataTable();
                $("#income_smartId").select2();
                $("#expense_smartId").select2();
                $("#transfer_smartId").select2();
                $("#loan_smartId").select2();

                $("#incomeBtn").on("click",function(e){
                    $("#incomeModel").modal("show");
                })
                $("#expenseBtn").on("click",function(e){
                    $("#expensesModel").modal("show");
                })
                $("#transferBtn").on("click",function(e){
                    $("#transferModel").modal("show");
                })
                $("#loanBtn").on("click",function(e){
                    $("#loanModel").modal("show");
                })
                $(document).on("click",".togglePaymentMode",function(){
                    if($(this).is(":checked")){
                        $(this).val(1);
                        $(this).parents("div.form-group").next(".incomeBankDropDown").show();
                    }else{
                        $(this).val(0);
                        $(this).parents("div.form-group").next(".incomeBankDropDown").hide();
                    }
                })
                // transfer
                $("#transferPurpose").on("change",function(){
                    const purpose = $(this).val();
                    // get user's bank
                    $.ajax("{{route('accounting.TransferGetUsersBank')}}",{
                        type:"POST",
                        data:{
                            purpose:purpose
                        }
                    })
                    .done(data=>{
                        let options = `<option value="">Select option</option>`;
                        if(data.length > 0){
                            $.each(data,(i,v)=>{
                                options+=`<option value='${v}'>${v}</option>`;
                            })
                        }
                        $("#transferTo").html(options);
                    })
                    .fail((err)=>{
                        // window.alert("Unable to get bank details");
                    })
                })
                // filters
                var start = moment().startOf('month');
                var end = moment().endOf('month');

                function cb(start, end) {
                    $('#reportrange span,#incomeFilter span,#expenseFilter span,#transferFilter span,#loanFilter span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('#reportrange,#incomeFilter,#expenseFilter,#transferFilter,#loanFilter').daterangepicker({
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
                var drp = $('#reportrange').data('daterangepicker');
                $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                    let startDate = picker.startDate.format('YYYY-MM-DD');
                    let endDate = picker.endDate.format('YYYY-MM-DD');
                    table.draw();
                });
                $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
                    $('#reportrange').data('daterangepicker').setStartDate("");
                    $('#reportrange').data('daterangepicker').setEndDate("");
                    table.draw();
                    $('#reportrange').data('daterangepicker').setStartDate(new Date());
                    $('#reportrange').data('daterangepicker').setEndDate(new Date());
                });

                $("#filterDropDown").on("change",function(){
                    table.draw();
                })

                // income daterangepicker
                var incomeFilter = $('#incomeFilter').data('daterangepicker');
                var incomeTableApi = $("#incomeTable").dataTable().api();

                $('#incomeFilter').on('apply.daterangepicker', function(ev, picker) {
                    let startDate = picker.startDate.format('YYYY-MM-DD');
                    let endDate = picker.endDate.format('YYYY-MM-DD');
                    incomeTableApi.draw();
                });

                // expense daterangepicker
                var expenseFilter = $('#expenseFilter').data('daterangepicker');
                var expenseTableApi = $("#expenseTable").dataTable().api();

                $('#expenseFilter').on('apply.daterangepicker', function(ev, picker) {
                    let startDate = picker.startDate.format('YYYY-MM-DD');
                    let endDate = picker.endDate.format('YYYY-MM-DD');
                    expenseTableApi.draw();
                });

                // transfer daterangepicker
                var transferFilter = $('#transferFilter').data('daterangepicker');
                var transferTableApi = $("#transferTable").dataTable().api();

                $('#transferFilter').on('apply.daterangepicker', function(ev, picker) {
                    let startDate = picker.startDate.format('YYYY-MM-DD');
                    let endDate = picker.endDate.format('YYYY-MM-DD');
                    transferTableApi.draw();
                });

                // loan daterangepicker
                var loanFilter = $('#loanFilter').data('daterangepicker');
                var loanTableApi = $("#loanTable").dataTable().api();

                $('#loanFilter').on('apply.daterangepicker', function(ev, picker) {
                    let startDate = picker.startDate.format('YYYY-MM-DD');
                    let endDate = picker.endDate.format('YYYY-MM-DD');
                    loanTableApi.draw();
                });


                // date range filter api
                $.fn.dataTable.ext.search.push(
                    function( settings, data, dataIndex ) {
                        if( settings.nTable.id == "allTable"){
                            let filter = $("#filterDropDown").val();
                            let min = drp.startDate.format("YYYY-MM-DD");
                            let max = drp.endDate.format("YYYY-MM-DD");
                            if(min=="Invalid date" || max=="Invalid date"){
                                return true;
                            }else{
                                min = new Date(drp.startDate.format('YYYY-MM-DD'));
                                max = new Date(drp.endDate.format('YYYY-MM-DD'));
                                var date = new Date( data[1] );
                                var heading = data[2];
                                if(filter.length==1 && filter[0]=="all"){
                                    if (
                                        ( min === null && max === null ) ||
                                        ( min === null && date <= max ) ||
                                        ( min <= date   && max === null ) ||
                                        ( min <= date   && date <= max )
                                    ) {
                                        return true;
                                    }else{
                                        return false;
                                    }
                                }else{
                                    if (
                                        ( min === null && max === null ) ||
                                        ( min === null && date <= max ) ||
                                        ( min <= date   && max === null ) ||
                                        ( min <= date   && date <= max ) && $.inArray(heading.toLowerCase(), filter) !== -1
                                    ) {
                                        return true;
                                    }else{
                                        return false;
                                    }
                                }
                            }
                            return false;
                        }else if(settings.nTable.id == "incomeTable"){
                            let min = incomeFilter.startDate.format("YYYY-MM-DD");
                            let max = incomeFilter.endDate.format("YYYY-MM-DD");
                            var date = new Date( data[1] );
                            if(min=="Invalid date" || max=="Invalid date"){
                                return true;
                            }
                            min = new Date(incomeFilter.startDate.format('YYYY-MM-DD'));
                            max = new Date(incomeFilter.endDate.format('YYYY-MM-DD'));
                            if (
                                ( min === null && max === null ) ||
                                ( min === null && date <= max ) ||
                                ( min <= date   && max === null ) ||
                                ( min <= date   && date <= max )
                            ) {
                                return true;
                            }else{
                                return false;
                            }
                        }else if(settings.nTable.id == "expenseTable"){
                            let min = expenseFilter.startDate.format("YYYY-MM-DD");
                            let max = expenseFilter.endDate.format("YYYY-MM-DD");
                            var date = new Date( data[1] );
                            if(min=="Invalid date" || max=="Invalid date"){
                                return true;
                            }
                            min = new Date(expenseFilter.startDate.format('YYYY-MM-DD'));
                            max = new Date(expenseFilter.endDate.format('YYYY-MM-DD'));
                            if (
                                ( min === null && max === null ) ||
                                ( min === null && date <= max ) ||
                                ( min <= date   && max === null ) ||
                                ( min <= date   && date <= max )
                            ) {
                                return true;
                            }else{
                                return false;
                            }
                        }else if(settings.nTable.id == "transferTable"){
                            let min = transferFilter.startDate.format("YYYY-MM-DD");
                            let max = transferFilter.endDate.format("YYYY-MM-DD");
                            var date = new Date( data[1] );
                            if(min=="Invalid date" || max=="Invalid date"){
                                return true;
                            }
                            min = new Date(transferFilter.startDate.format('YYYY-MM-DD'));
                            max = new Date(transferFilter.endDate.format('YYYY-MM-DD'));
                            if (
                                ( min === null && max === null ) ||
                                ( min === null && date <= max ) ||
                                ( min <= date   && max === null ) ||
                                ( min <= date   && date <= max )
                            ) {
                                return true;
                            }else{
                                return false;
                            }
                        }else if(settings.nTable.id == "loanTable"){
                            let min = loanFilter.startDate.format("YYYY-MM-DD");
                            let max = loanFilter.endDate.format("YYYY-MM-DD");
                            var date = new Date( data[1] );
                            if(min=="Invalid date" || max=="Invalid date"){
                                return true;
                            }
                            min = new Date(loanFilter.startDate.format('YYYY-MM-DD'));
                            max = new Date(loanFilter.endDate.format('YYYY-MM-DD'));
                            if (
                                ( min === null && max === null ) ||
                                ( min === null && date <= max ) ||
                                ( min <= date   && max === null ) ||
                                ( min <= date   && date <= max )
                            ) {
                                return true;
                            }else{
                                return false;
                            }
                        }else{
                            return true;
                        }
                    }
                );

                // amount validations
                $(document).on("change",".transactionForm",function(){
                    const val = $(this).val();
                    if(val==="both"){
                        $(this).parents("div.form-group").next("div.bothFormOfIncome").show();
                        $(this).parents("div.col-md-12").find("div.mainAmount").find("[name='amount']").trigger("input");
                    }else{
                        $(this).parents("div.form-group").next("div.bothFormOfIncome").hide();
                        $(this).parents("div.col-md-12").find("div.mainAmount").find("[name='amount']").trigger("input");
                    }
                })
                $("[name='st_amount']").on("input",function(){
                    $(this).parents("div.col-md-12").find("div.mainAmount").find("[name='amount']").trigger("input");
                })
                $("[name='sg_amount']").on("input",function(){
                    $(this).parents("div.col-md-12").find("div.mainAmount").find("[name='amount']").trigger("input");
                })
                $("[name='amount']").on("input",function(){
                    if($(this).next("p.invalidAmount").length!=0){
                        $(this).next("p.invalidAmount").remove();
                    }
                    const amount = $(this).val();
                    const transactionTypeDropDown = $(this).parents("div.col-md-12").find(".transactionFormDropDown");
                    const transactionType = $(transactionTypeDropDown).find("select").val();
                    if(transactionType==="both"){
                        const st = $(transactionTypeDropDown).next(".bothFormOfIncome").find("[name='st_amount']").val();
                        const sg = $(transactionTypeDropDown).next(".bothFormOfIncome").find("[name='sg_amount']").val();
                        if(Number(st)+Number(sg)===Number(amount)){
                            $(this).next("p.invalidAmount").remove();
                        }else{
                            $(this).after(`<p class='invalidAmount h5 text-danger'>Invalid amount</p>`);
                        }
                    }
                })
                // edit
                $(document).on("click",".edit",function(e){
                    const id= e.target.getAttribute("data-id");
                    if($(e.target).hasClass("income")){
                        $.ajax("{{route('financeManagementGetRow')}}",{
                            type:"POST",
                            data:{
                                type:"income",
                                id:id
                            }
                        })
                        .done(data=>{
                            console.log(data);
                            $("#incomeForm").find("#date").val(data.date);
                            $("#incomeForm").find("#sub_heading").val(data.sub_heading).change();
                            $("#incomeForm").find("#text_box").val(data.text_box);
                            $("#incomeForm").find("#st_amount").val(data.st_amount);
                            $("#incomeForm").find("#sg_amount").val(data.sg_amount);
                            $("#incomeForm").find("[togglepaymentmode]").val(data.mode);
                            if(data.mode==1){
                                $("#incomeForm").find("[togglepaymentmode]").prop("checked",true);
                            }else{
                                $("#incomeForm").find("[togglepaymentmode]").prop("checked",false);
                            }
                            $("#incomeForm").find("#incomeAmount").val(data.amount);
                            $("#incomeForm").find("#income_form").val(data.income_form).change();
                            $("#incomeForm").find("#incomeEditIdContainer").html(`<input type='hidden' name='id' value='${data.id}'>`);
                            $("#incomeModel").modal("show");
                        })
                        .fail((err)=>{
                            console.log(err);
                        })
                    }else if($(e.target).hasClass("expense")){
                        $.ajax("{{route('financeManagementGetRow')}}",{
                            type:"POST",
                            data:{
                                type:"expense",
                                id:id
                            }
                        })
                        .done(data=>{
                            console.log(data);
                            $("#expenseForm").find("[name='date']").val(data.date);
                            $("#expenseForm").find("[name='sub_heading']").val(data.sub_heading).change();
                            $("#expenseForm").find("[name='text_box']").val(data.text_box);
                            $("#expenseForm").find("[name='st_amount']").val(data.st_amount);
                            $("#expenseForm").find("[name='sg_amount']").val(data.sg_amount);
                            $("#expenseForm").find("[togglepaymentmode]").val(data.mode);
                            if(data.mode==1){
                                $("#expenseForm").find("[togglepaymentmode]").prop("checked",true);
                            }else{
                                $("#expenseForm").find("[togglepaymentmode]").prop("checked",false);
                            }
                            $("#expenseForm").find("[name='amount']").val(data.amount);
                            $("#expenseForm").find("[name='income_form']").val(data.income_form).change();
                            $("#expenseForm").find("#expenseEditIdContainer").html(`<input type='hidden' name='id' value='${data.id}'>`);
                            $("#expensesModel").modal("show");
                        })
                        .fail((err)=>{
                            console.log(err);
                        })
                    }else if($(e.target).hasClass("transfer")){
                        $.ajax("{{route('financeManagementGetRow')}}",{
                            type:"POST",
                            data:{
                                type:"transfer",
                                id:id
                            }
                        })
                        .done(async data=>{
                            $("#transferForm").find("[name='date']").val(data.date);
                            $("#transferForm").find("[name='from']").val(data.from).change();
                            $("#transferForm").find("[name='purpose']").val(data.purpose);
                            await $.ajax("{{route('accounting.TransferGetUsersBank')}}",{
                                type:"POST",
                                data:{
                                    purpose:data.purpose
                                }
                            })
                            .done(x=>{
                                let options = `<option value="">Select option</option>`;
                                if(x.length > 0){
                                    $.each(x,(i,v)=>{
                                        options+=`<option value='${v}'>${v}</option>`;
                                    })
                                }
                                $("#transferTo").html(options);
                                $("#transferForm").find("[name='to']").val(data.to).change();
                            })
                            .fail((err)=>{
                                // window.alert("Unable to get bank details");
                            })
                            $("#transferForm").find("[name='income_form']").val(data.income_form).change();
                            $("#transferForm").find("[name='st_amount']").val(data.st_amount);
                            $("#transferForm").find("[name='sg_amount']").val(data.sg_amount);
                            $("#transferForm").find("[name='amount']").val(data.amount);
                            $("#transferForm").find("[name='income_form']").val(data.income_form).change();
                            $("#transferForm").find("#expenseEditIdContainer").html(`<input type='hidden' name='id' value='${data.id}'>`);
                            $("#transferModel").modal("show");
                        })
                        .fail((err)=>{
                            console.log(err);
                        })
                    }
                })
                // delete
                $(document).on("click",".delete",function(e){
                    if(!window.confirm("Are you sure you want to delete this record?")){
                        e.preventDefault();
                    }
                })
            },jQuery)
        })
    </script>
    @section('jscript')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    @endsection
@endsection

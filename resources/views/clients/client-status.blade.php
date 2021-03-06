@extends('layout')
@section("page-title","Clients Demat Status - Finance Management")
@section("clientsData.clients.dematStatus","active")
@section("client_management.accordion","hover show")
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
                    @if(session("info"))
                        <div class="container">
                            <h6 class="alert alert-info">{{session("info")}}</h6>
                        </div>
                    @elseif($errors->any())
                        <div class="container">
                            <h6 class="alert alert-danger">{{$errors->first()}}</h6>
                        </div>
                    @endif
                <!--begin::Toolbar-->
                    <div class="toolbar" id="kt_toolbar">
                        <!--begin::Container-->
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Client Demat</h1>
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
                                    <li class="breadcrumb-item text-dark">Clicnt management</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--begin::Input group-->
                            <div class="mb-4" id="clientFilterDiv">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold mb-2">
                                    <span class="required">Client Type</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="hidden" name="form_type" value="{{isset($formType) && $formType ? $formType : ''}}" >
                                @if(isset($formType) && $formType == "channelPartner")
                                    <select name="client_type" id="client_type" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                        <option value="1">Account Handling</option>
                                    </select>
                                @else
                                    <select name="client_type" id="client_type" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Account Handling">
                                        <option></option>
                                        <option value="1">Account Handling</option>
                                        <option value="2">Mutual Fund</option>
                                        <option value="3">Unlisted Shares</option>
                                        <option value="4">Insurance</option>
                                    </select>
                                @endif
                                <!--end::Input-->
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
                                    <a class="nav-link text-active-primary pb-1 active" data-bs-toggle="tab" data-id='clients' href="#clients">Clients ({{count($actives)}})</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" data-id="demat" href="#demat">Demat ({{count($demats)}})</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" data-id="preRenew" href="#preRenew">Pre Renew ({{count($preRenewAccounts)}})</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" data-id="toRenew" href="#toRenew">To Renew ({{count($toRenews)}})</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" data-id="problem" href="#problem">Problem ({{count($problemAccounts)}})</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" data-id="terminated" href="#terminated">Terminated({{count($terminatedAccounts)}})</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" data-id="all" href="#all">All ({{count($allAccounts)}})</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="clients" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable" id="clientsTable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Client Name</th>
                                                            <th class="min-w-75px">Contact No</th>
                                                            <th class="min-w-75px">Communication With</th>
                                                            <th class="min-w-75px">No. of Demat</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="clientsBody">
                                                        @forelse($actives as $active)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$active->name}}</td>
                                                                <td>{{$active->number}}</td>
                                                                <td>{{$active->communication_with_contact_number != '' ? $active->communication_with_contact_number : '-'}}</td>
                                                                <td>{{$active->clientDemat->count()}}</td>
                                                                <td>
                                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$active->id}}" class='menu-link px-3 viewClient'>view</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{route('viewLedger',$active->id)}}" target="_blank" class="menu-link px-3">Ledger</a>
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
                                <div class="tab-pane fade show" id="demat" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">Smart Id</th>
                                                            <th class="min-w-75px">Holder Name</th>
                                                            <th class="min-w-75px">Available Fund</th>
                                                            <th class="min-w-75px">Profit / Loss</th>
                                                            <th class="min-w-75px">Days of Joining</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($demats as $demat)
                                                            <?php $joining_date = !empty($demat->joining_date) && isset($demat->joining_date) ? $demat->joining_date : $demat->created_at;?>
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$demat->st_sg."-".$demat->serial_number}}</td>
                                                                <td>{{$demat->holder_name}}</td>
                                                                <td>{{$demat->available_balance}}</td>
                                                                <td>{{$demat->pl}}</td>
                                                                <td>{{round((time() - strtotime($joining_date)) / (60 * 60 * 24))}}</td>
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
                                                                            <a href="javascript:void(0)" data-id="{{$demat->id}}" data-name="{{isset($demat->withClient->name)?$demat->withClient->name:""}}" data-holder="{{$demat->holder_name}}" class="menu-link px-3 editDematAccount">Update Status</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$demat->id}}" data-name="{{isset($demat->withClient->name)?$demat->withClient->name:""}}" data-holder="{{$demat->holder_name}}" class="menu-link px-3 holdingDematAccount">Add Holding</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$demat->id}}" data-value="renew" class="menu-link px-3 changeStatus">Send for Renewal</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$demat->id}}" class="menu-link px-3 markAsProblem">Mark as Problem</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{route('clientDematTerminate',$demat->id)}}" class='menu-link px-3 terminateDemat'>Terminate</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$demat->id}}" class="menu-link px-3 loginInfo">View Log in Info</a>
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
                                <div class="tab-pane fade show" id="preRenew" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Smart Id</th>
                                                            <th class="min-w-75px">Joining Date</th>
                                                            <th class="min-w-75px">Demat Holder Name</th>
                                                            <th class="min-w-75px">Available Fund</th>
                                                            <th class="min-w-75px">P / L</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($preRenewAccounts as $preRenewAccount)
                                                            <?php $joining_date = !empty($preRenewAccount->joining_date) && isset($preRenewAccount->joining_date) ? $preRenewAccount->joining_date : $preRenewAccount->created_at;?>
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$preRenewAccount->st_sg."-".$preRenewAccount->serial_number}}</td>
                                                                <td>{{date("Y-m-d",strtotime($joining_date))}}</td>
                                                                <td>{{$preRenewAccount->holder_name}}</td>
                                                                <td>{{$preRenewAccount->available_balance}}</td>
                                                                <td>{{$preRenewAccount->pl}}</td>
                                                                <td>
                                                                    <a href="/financeManagement/clientDematDataView/{{$preRenewAccount->id}}/{{2}}" target="_blank" class='verifyDemate'>Verify</a>
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
                                <div class="tab-pane fade show" id="toRenew" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">Client Name</th>
                                                            <th class="min-w-75px">Contact No</th>
                                                            <th class="min-w-75px">Demat Name</th>
                                                            <th class="min-w-75px">Available Fund</th>
                                                            <th class="min-w-75px">P / L</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($toRenews as $toRenew)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$toRenew->name}}</td>
                                                                <td>{{$toRenew->number}}</td>
                                                                <td>{{$toRenew->holder_name}}</td>
                                                                <td>{{$toRenew->available_balance}}</td>
                                                                <td>{{$toRenew->pl}}</td>
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
                                                                            <a href="javascript:void(0)" data-id="{{$toRenew->client_demat_id}}" data-value="renew" class="menu-link px-3 changeStatus">Send for Renewal</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{route('clientDematTerminate',$toRenew->client_demat_id)}}" class="menu-link px-3 terminateDemat">Terminate</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$toRenew->id}}" class="menu-link px-3 addImage">Upload Screenshot</a>
                                                                        </div>
                                                                    </div>
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
                                <div class="tab-pane fade show" id="problem" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">Client Name</th>
                                                            <th class="min-w-75px">Contact No</th>
                                                            <th class="min-w-75px">Demat Name</th>
                                                            <th class="min-w-75px">Problem</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($problemAccounts as $account)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{isset($account->withClient)?$account->withClient->name:""}}</td>
                                                                <td>{{isset($account->withClient)?$account->withClient->number:""}}</td>
                                                                <td>{{$account->holder_name}}</td>
                                                                <td>{{$account->problem}}</td>
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
                                                                            <a href="javascript:void(0)" data-id="{{$account->id}}" data-name='{{isset($account->withClient)?$account->withClient->name:""}}'  data-holder='{{$account->holder_name}}' data-value="normal" data-problem='{{$account->problem}}' class="menu-link px-3 problemDematAccount">Issue Resolved</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{route('clientDematTerminate',$account->id)}}" class="menu-link px-3 terminateDemat">Terminate</a>
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
                                <div class="tab-pane fade show" id="terminated" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">Client Name</th>
                                                            <th class="min-w-75px">Contact No</th>
                                                            <th class="min-w-75px">Demat Name</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($terminatedAccounts as $account)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{isset($account->withClient)?$account->withClient->name:""}}</td>
                                                                <td>{{isset($account->withClient)?$account->withClient->number:""}}</td>
                                                                <td>{{$account->holder_name}}</td>
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
                                                                            <a href="javascript:void(0)" data-id="{{$account->id}}" class="menu-link px-3 activateDematAccount">Active</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$account->id}}" class="menu-link px-3 renewAccount">Renew</a>
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
                                <div class="tab-pane fade show" id="all" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">Client Name</th>
                                                            <th class="min-w-75px">Contact No</th>
                                                            <th class="min-w-75px">No. of Demat</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($allAccounts as $account)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$account->name}}</td>
                                                                <td>{{$account->number}}</td>
                                                                <td>{{$account->total_demats}}</td>
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
                                                                            <a href="javascript:void(0)" data-id="{{$account->client_id}}" class="menu-link px-3 viewClient">View</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id="{{$account->id}}" class="menu-link px-3 renewAccount">Renew</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-delete='true' data-id="{{$account->id}}" class="menu-link px-3 terminateClient">Terminate</a>
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
                <div class="modal-body">
                    <div class="text-end">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary editClientBtn">Edit</button>
                    </div>
                    @can("client-read")
                        <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_app_stepper">
                            <!--begin::Content-->
                            <div class="flex-row-fluid">
                                <!--begin::Step 1-->
                                <div class="current d-block card my-5" data-kt-stepper-element="content">
                                    <div class="w-100">
                                        <div class="stepper-label mt-0" style="margin-top:30px;margin-bottom:20px;">
                                            <h3 class="stepper-title text-primary">Personal Details</h3>
                                        </div>
                                        <div class="row">
                                            <!--begin::Input group-->
                                            <div class="col-md-6 mb-4">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Client Name</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" id="name" readonly />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="col-md-6 mb-4">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Mobile No.</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc client-mobile" id="number" readonly />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <div class="row">

                                        <!--begin::Input group-->
                                        <div class="col-md-6 mb-4">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Communication with</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" id="communication_with" readonly  />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="col-md-6 mb-4">
                                            <!--begin::Label-->
                                            <label class="d-md-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">WhatsApp No.</span>
                                                <div class="form-check form-check-custom form-check-solid small" style="margin-left: auto;">
                                                    <input class="form-check-input " id="wpsameascontact" type="checkbox" value="1" disabled/>
                                                    <label class="form-check-label" for="wpsameascontact" style="font-size: x-small;">
                                                        (Select if WhatsApp No. is same as Mobile No.)
                                                    </label>
                                                </div>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc wp" id="wp_number" readonly />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="col-md-6 mb-4">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Profession</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" id="profession" class="form-control form-control-lg form-control-solid bdr-ccc" readonly />
                                            <!--end::Input-->
                                        </div>

                                        <!--end::Input group-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                @else
                    <h1>Unauthorised</h1>
                @endcan
                </div>
                <!--end::Modal body-->
                <div class="modal-footer text-center">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary editClientBtn">Edit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="demateAccountProblemModal" tabindex="-1" aria-hidden="true">
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
                            <h3 class="mb-3">Account has Problem</h3>
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
                    <form id="demateAccountProblemForm" method="POST" action="{{route('update_mark_as_problem')}}" class="form">
                        @csrf
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-12">
                                <div id="editIdContainer"></div>
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Problem:</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Problems marked by Accountant"></i>
                                </label>
                                <textarea type="text" class="form-control mx-3" name='problem' value="" id="problemText"></textarea>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-end">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Update</span>
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
    <div class="modal fade" id="mark_as_problem_modal" tabindex="-1" aria-hidden="true">
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
                            <h3 class="mb-3">Mark as Problem</h3>
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
                    <form id="mark_as_problem_form" method="POST" action="{{route('mark_as_problem')}}" class="form">
                        @csrf
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <div id="editIdContainer">

                                </div>
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Select options:</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a Profession name"></i>
                                </label>
                                <!--end::Label-->
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" name='paymentPending' value="0" id="paymentPending">
                                    <label class="custom-control-label" for="paymentPending">Payment Pending</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" name='SegmentNotActive' value="0" id="SegmentNotActive">
                                    <label class="custom-control-label" for="SegmentNotActive">Segment Not Active</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" name='PANCardPending' value="0" id="PANCardPending">
                                    <label class="custom-control-label" for="PANCardPending">PAN Card Pending</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" name='WrongInformation' value="0" id="WrongInformation">
                                    <label class="custom-control-label" for="WrongInformation">Wrong Information</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" name='Other' value="0" id="Other">
                                    <label class="custom-control-label" for="Other">Other</label>
                                </div>
                            </div>
                            <div class="m-2" id="WrongInformationTextDiv">
                                <label class="custom-control-label" for="Other">Wrong Information</label>
                                <textarea type="text" class="form-control mx-3" name='WrongInformationText' value="" id="WrongInformationText"></textarea>
                            </div>
                            <div class="m-2" id="OtherTextDiv">
                                <label class="custom-control-label" for="Other">Other</label>
                                <textarea type="text" class="form-control mx-3" name='OtherText' value="" id="OtherText"></textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-end">
                            <button type="reset" id="call_modal_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="call_modal_submit" class="btn btn-primary">
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
    <div class="modal fade" id="holdingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('addDematHolding')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Holding</h2>
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
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Account Holder Name</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="holding_holder_name" readonly/>
                                <input class="form-control" type="hidden" value="" name='client_demate_id' id="holding_demate_id"/>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Script Name</label>
                            <div class="col-9">
                                <input type="type" class="form-control form-control-solid" id="script_name"  name="script_name" list="listValue"/>
                                <datalist id="listValue">
                                    @if(!empty($keywords))
                                        @foreach($keywords as $keyword)
                                            <option value="{{$keyword->name}}">{{$keyword->name}}</option>
                                        @endforeach
                                    @endif
                                </datalist>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Analysts</label>
                            <div class="col-9">
                                <select name="analyst_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Analysts">
                                    <option></option>
                                    @if(!empty($analysts))
                                        @foreach($analysts as $analyst)
                                            <option value="{{$analyst->id}}">{{$analyst->analyst}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Entry Price</label>
                            <div class="col-9">
                                <input class="form-control" type="number" id="entry_price" name="entry_price"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Quantity</label>
                            <div class="col-9">
                                <input class="form-control" type="number" id="quantity" name="quantity"/>
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
                                <input class="form-control" type="hidden" value="back" name='form_type' id="form_type" readonly />
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
    <div class="modal fade" id="problemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('updateDematStatus')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Problem</h2>
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
                                <input class="form-control" type="text" id="problem_client_Name" readonly/>
                                <input class="form-control" type="hidden" value="" name='id' id="problem_demate_id" readonly />
                                <input class="form-control" type="hidden" value="problem" name='status' id="status" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Account Holder Name</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="problem_holder_name" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Problem</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="dematProblemInput" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Notes</label>
                            <div class="col-9">
                                <textarea class="form-control" name="other_problem" type="text" id="notesTextarea" ></textarea>
                            </div>
                        </div>
                    </div>
                    <!--end::Modal body-->
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-light me-3 addNoteBtn">Add note</button>
                        <button type="submit" class="btn btn-primary" id="issueResolved">Issue Resolved</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
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
                <div class="modal-body">
                    <div class="text-end">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary editClientBtn">Edit</button>
                    </div>
                    @can("client-read")
                        <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_app_stepper">
                            <!--begin::Content-->
                            <div class="flex-row-fluid">
                                <!--begin::Step 1-->
                                <div class="current d-block card my-5" data-kt-stepper-element="content">
                                    <div class="w-100">
                                        <div class="stepper-label mt-0" style="margin-top:30px;margin-bottom:20px;">
                                            <h3 class="stepper-title text-primary">Personal Details</h3>
                                        </div>
                                        <div class="row">
                                            <!--begin::Input group-->
                                            <div class="col-md-6 mb-4">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Client Name</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" id="name" readonly />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="col-md-6 mb-4">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Mobile No.</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc client-mobile" id="number" readonly />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <div class="row">

                                        <!--begin::Input group-->
                                        <div class="col-md-6 mb-4">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Communication with</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" id="communication_with" readonly  />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="col-md-6 mb-4">
                                            <!--begin::Label-->
                                            <label class="d-md-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">WhatsApp No.</span>
                                                <div class="form-check form-check-custom form-check-solid small" style="margin-left: auto;">
                                                    <input class="form-check-input " id="wpsameascontact" type="checkbox" value="1" disabled/>
                                                    <label class="form-check-label" for="wpsameascontact" style="font-size: x-small;">
                                                        (Select if WhatsApp No. is same as Mobile No.)
                                                    </label>
                                                </div>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc wp" id="wp_number" readonly />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="col-md-6 mb-4">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Profession</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" id="profession" class="form-control form-control-lg form-control-solid bdr-ccc" readonly />
                                            <!--end::Input-->
                                        </div>

                                        <!--end::Input group-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                @else
                    <h1>Unauthorised</h1>
                @endcan
                </div>
                <!--end::Modal body-->
                <div class="modal-footer text-center">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary editClientBtn">Edit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addImageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form enctype="multipart/form-data" action="{{route('renewalAccountImageUpload')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Upload Screenshot</h2>
                        <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    <div id="imageIdContainer"></div>
                    <!--begin::Modal body-->
                    <div class="modal-body mx-md-10">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Title</label>
                            <div class="col-9">
                                <input class="form-control" type="text" name="title"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Image</label>
                            <div class="col-9">
                                <input type="file" name="image" id="image" accept="image/*" class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="Upload image"/>
                            </div>
                        </div>
                        <div class="form-group row" id="previewImageContainer">
                            <label class="col-3 col-form-label">preview</label>
                            <div class="col-9" id="previewImage">
                                <img src="" style="width:200px" id="prev_image">
                            </div>
                        </div>
                    </div>
                    <!--end::Modal body-->
                    <div class="modal-footer text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" class="btn btn-primary me-3">Upload</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $(".datatable").DataTable();
                const name = $("#client_name");
                const number = $("#client_number");
                const profession = $("#client_profession");
                const status = $("#client_status");

                $(document).on("click",".viewClient",function(e){
                    $.ajax("/client/view/"+e.target.getAttribute("data-id"),{
                        type:"GET",
                        cache:false
                    })
                    .done(data=>{
                        $("#name").val(data.name);
                        $("#number").val(data.number);
                        $("#communication_with").val(data.communication_with);
                        $("#wp_number").val(data.wp_number);
                        $("#profession").val(data.profession);
                        if(data.number===data.wp_number){
                            $("#wpsameascontact").prop("checked",true);
                        }else{
                            $("#wpsameascontact").prop("checked",false);
                        }
                        $(".editClientBtn").each(function () {
                            $(this).attr("data-id",data.id);
                        });
                        $("#viewClient").modal("show");
                    })
                })
                // edit client
                $(document).on("click",".editClientBtn",function(e){
                    const id = e.target.getAttribute("data-id");
                    if(id){
                        window.open("/client/edit/"+id);
                    }else{
                        window.alert("Unable to Load this Client");
                    }
                })
                // get demat login info
                $(document).on("click",".loginInfo",function(e){
                    $.ajax("/loginInfo/" + e.target.getAttribute("data-id"), {
                        type: "GET"
                    }).done(data => {
                        $("#broker_name").val(data.broker);
                        $("#password").val(data.password);
                        $("#user_id").val(data.user_id);
                        $("#mpin").val(data.mpin);
                        $("#loginInfoModal").modal("show");
                    });
                })
                // markAsProblem
                $(document).on("click",".markAsProblem",function(e){
                    const id = e.target.getAttribute("data-id");
                    if(id){
                        $("#mark_as_problem_modal").modal("show");
                        $("#mark_as_problem_modal #editIdContainer").html(`<input type="hidden" name="demat_id" value="${id}">`);
                    }else{
                        window.alert("invalid demat account");
                    }
                })
                // change checkbox value on click
                $(document).on("click",".markAsProblemCheckbox",function(e){
                    if($(this).is(":checked")){
                        $(this).val(1);
                    }else{
                        $(this).val(0);
                    }
                })
                // textbox for wrong information
                $("#WrongInformation").on("click",function(e){
                    if($(this).is(":checked")){
                        $("#WrongInformationTextDiv").show();
                    }else{
                        $("#WrongInformationTextDiv").hide();
                    }
                })
                $("#WrongInformationTextDiv").hide();
                // textbox for other information
                $("#Other").on("click",function(e){
                    if($(this).is(":checked")){
                        $("#OtherTextDiv").show();
                    }else{
                        $("#OtherTextDiv").hide();
                    }
                })
                $("#OtherTextDiv").hide();
                $(document).on("click",".terminateDemat",function(e){
                    if(!window.confirm("Are you sure you want to terminate this account?")){
                        e.preventDefault();
                    }
                })
                // sendForRenewalDemat
                $(document).on("click",".changeStatus",function(e){
                    const id=e.target.getAttribute("data-id");
                    const value=e.target.getAttribute("data-value");
                    if(id){
                        if(window.confirm("Send this account for renew?")){
                            $.ajax("{!! route('updateDematStatus') !!}",{
                                type:"POST",
                                data:{
                                    id:id,
                                    status: value
                                }
                            })
                            .done(data=>{
                                if(data && status=="renew"){
                                    window.alert("Account send for renew");
                                    window.location.reload();
                                }else if(data==1){
                                    window.alert("Request completed");
                                    window.location.reload();
                                }else{
                                    window.alert("Unable to complete request");
                                }
                            })
                            .fail((err)=>{
                                if(err.status===403){
                                    window.alert("Unauthorized Action");
                                }else if(err.status===500){
                                    window.alert("Server Error");
                                }
                            })
                        }
                    }else{
                        window.alert("Unable to load this account");
                    }
                })
                // add notes
                $(document).on("click",".addNoteBtn",function(e){
                    e.preventDefault();
                    const id=$("#problem_demate_id").val();
                    const value=$("#notesTextarea").val();
                    if(id){
                        if(window.confirm("update status of this demat account?")){
                            $.ajax("{!! route('updateDematStatus') !!}",{
                                type:"POST",
                                data:{
                                    id:id,
                                    problem: "other",
                                    other_problem:value,
                                    status:"problem"
                                }
                            })
                            .done(data=>{
                                if(data==1){
                                    window.alert("Notes added");
                                    window.location.reload();
                                }else{
                                    window.alert("Unable to complete request");
                                }
                            })
                            .fail((err)=>{
                                if(err.status===403){
                                    window.alert("Unauthorized Action");
                                }else if(err.status===500){
                                    window.alert("Server Error");
                                }
                            })
                        }
                    }else{
                        window.alert("Unable to load this account");
                    }
                })
                // add holding
                $(document).on("click",".holdingDematAccount",function(e){
                    console.log("abc");
                    const id = e.target.getAttribute("data-id");
                    const name = e.target.getAttribute("data-name");
                    const holderName = e.target.getAttribute("data-holder");
                    if(id){
                        $("#holding_demate_id").val(id);
                        $("#holding_client_Name").val(name);
                        $("#holding_holder_name").val(holderName);
                        $("#holdingModal").modal("show");
                    }else{
                        window.alert("Unable to Load this Client");
                    }
                })
                // update status
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
                // issue resolved
                $(document).on("click",".problemDematAccount",function(e){
                    const client = e.target.getAttribute("data-name");
                    const holderName = e.target.getAttribute("data-holder");
                    const problem = e.target.getAttribute("data-problem");
                    const id = e.target.getAttribute("data-id");
                    $("#problem_client_Name").val(client);
                    $("#problem_holder_name").val(holderName);
                    $("#problem_demate_id").val(id);
                    $("#dematProblemInput").val(problem);
                    $("#problemModal").modal("show");
                })
                // activate account
                $(document).on("click",'.activateDematAccount',function(e){
                    const id = e.target.getAttribute("data-id");
                    if(id){
                        if(window.confirm("Activate this account?")){
                            $.ajax("{{route('clientDematActivated')}}",{
                                type:"POST",
                                data:{
                                    id:id
                                }
                            })
                            .done(data=>{
                                if(data?.info){
                                    window.alert(data.info);
                                    window.location.reload();
                                }else{
                                    window.alert("Unable to update status");
                                }
                            })
                            .fail((err)=>{
                                if(err.status==500){
                                    window.alert("Server Error");
                                }else if(err.status==403){
                                    window.alert("Unauthorized Action");
                                }
                            })
                        }
                    }else{
                        window.alert("Unable to Load this Client")
                    }
                })
                // terminate client
                $(document).on("click",".terminateClient",function(e){
                    const id = e.target.getAttribute("data-id");
                    const trash = e.target.getAttribute("data-delete");
                    if(id){
                        if(window.confirm("terminate this account?")){
                            $.ajax("{{route('terminateClient')}}",{
                                type:"POST",
                                data:{
                                    id:id,
                                    status:trash
                                }
                            })
                            .done(data=>{
                                if(data?.info){
                                    window.alert(data.info);
                                    window.location.reload();
                                }else{
                                    window.alert("Unable to terminate this Client");
                                }
                            })
                            .fail(err=>{
                                if(err.status===500){
                                    window.alert("Server Error");
                                }else if(err.status===403){
                                    window.alert("Unauthorized Action");
                                }
                            })
                        }
                    }else{
                        window.alert("Unable to Load this Client")
                    }
                })
                // renew
                $(document).on("click",".renewAccount",function(e){
                    const id = e.target.getAttribute("data-id");
                    if(id){
                        $.ajax("{{route('clientDematView')}}/"+id,{
                            type:"get",
                        })
                        .done(data=>{
                            console.log(data);
                        })
                    }else{
                        window.alert("Unable to Load this Client")
                    }
                })
                // filter client type
                $(document).on("change","#client_type",function(e){
                    const val = e.target.value;
                    $('#clientsTable').DataTable().destroy();
                    if(val==1){
                        window.location.reload();
                    }else if(val==2){
                        $('#clientsTable').DataTable( {
                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                type:"POST",
                                url: '{{route("getMutualFundClient")}}',
                            }
                        } );
                    }else if(val==3){
                        $('#clientsTable').DataTable( {
                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                type:"POST",
                                url: '{{route("getUnlistedSharesClient")}}',
                            }
                        } );
                    }else if(val==4){
                        $('#clientsTable').DataTable( {
                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                type:"POST",
                                url: '{{route("getInsuranceClients")}}',
                            }
                        } );
                    }
                })
                $(document).on("click",'.dropdown-toggle',function(e){
                   $(e.target).next(".dropdown-menu").toggleClass("d-block");
                });
                // preview image
                function readURL(input,id) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $("#previewImageContainer").show();
                            $('#'+id).attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }
                // add image
                $(document).on("click",".addImage",function(e){
                    const id = e.target.getAttribute("data-id");
                    if(id){
                        $("#imageIdContainer").html(`<input type="hidden" name='renewal_account_id' value="${id}">`);
                        $("#addImageModal").modal("show");
                    }else{
                        window.alert("Unable to Load this account");
                    }
                })
                $("#image").on("change",function(){
                    readURL(this,"prev_image");
                })
                $("#previewImageContainer").hide();
                // hide filter
                $(document).on("click","[data-bs-toggle='tab']",function(e){
                    const tab = e.target.getAttribute("data-id");
                    if(tab==="clients"){
                        $("#clientFilterDiv").css({"opacity":"1"});
                    }else{
                        $("#clientFilterDiv").css({"opacity":"0"});
                    }
                })
            },jQuery)
        })
    </script>
@endsection

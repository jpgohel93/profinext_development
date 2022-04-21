@extends('layout')
@section("page-title","Trader - Trade Management")
@section("traders","active")
@section("trade_management.accordion","hover show")
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
                            <h6 class="alert alert-danger">{{$errors->first()}}</h6>
                        </div>
                    @elseif(session("info"))
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
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Trader Clients</h1>
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
                                    <li class="breadcrumb-item text-dark">Trade management</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                            <div class="d-flex align-items-center py-1">
                                <button type="button" class="btn btn-primary jump" id="jump">Jump</button>
                            </div>
                        <!--end::Actions-->
                        </div>
                        <!--end::Container-->
                    </div>

                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">

                            <!--begin:::Tabs-->
                            <ul
                                class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1 active" data-bs-toggle="tab"
                                       href="#preferredAccount">Preferred</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#allAccount">All</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#holdingAccount">Holding</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#renewAccount">Renew</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#problemAccount">Problem</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="preferredAccount" aria-labelledby="active-tab"
                                     role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <thead>
                                                        <tr
                                                            class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-10px">Serial Number</th>
                                                            <th class="min-w-75px">Holder Name</th>
                                                            <th class="min-w-75px">Broker</th>
                                                            <th class="min-w-75px">User Id</th>
                                                            <th class="min-w-75px">Password</th>
                                                            <th class="min-w-75px">MPIN</th>
                                                            <th class="min-w-75px">Available Fund</th>
                                                            <th class="min-w-75px">Profit / Loss</th>
                                                            <th class="min-w-75px">Day of Joining</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($dematAccount['preferred'] as $account)
                                                            @php
                                                                $datetime1 = strtotime($account->created_at);
                                                                $datetime2 = strtotime(date("Y-m-d"));
                                                                $days = (int)(($datetime2 - $datetime1)/86400);
                                                            @endphp
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td> {{$account->st_sg."-".$account->serial_number}} </td>
                                                                <td> {{$account->holder_name}}</td>
                                                                <td> {{$account->broker}}</td>
                                                                <td class="copy" style="cursor: copy;" title="copy text"> {{$account->user_id}}</td>
                                                                <td class="copy" style="cursor: copy;" title="copy text"> {{$account->password}}</td>
                                                                <td class="copy" style="cursor: copy;" title="copy text"> {{$account->mpin}}</td>
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
                                                                        @can("client-demat-write")
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" data-id='{{$account->id}}' data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' class="menu-link px-3 editDematAccount">Update Status</a>
                                                                            </div>
                                                                        @endcan
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 holdingDematAccount"  data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' data-value="holding">Add Holding</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{route('squareOffDemat',$account->id,$account)}}" class="menu-link px-3 squareOffDematAccount" >Square off</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                             <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 changeStatus" data-value="renew">Send for Renew</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                             <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 problemDematAccount" data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' data-value="problem">Make as Problem</a>
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
                                <div class="tab-pane fade show" id="allAccount" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable" id="kt_table_users">
                                                    <thead>
                                                        <tr
                                                            class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-10px">Serial Number</th>
                                                            <th class="min-w-75px">Holder Name</th>
                                                            <th class="min-w-75px">Broker</th>
                                                            <th class="min-w-75px">User Id</th>
                                                            <th class="min-w-75px">Password</th>
                                                            <th class="min-w-75px">MPIN</th>
                                                            <th class="min-w-75px">Available Fund</th>
                                                            <th class="min-w-75px">Profit / Loss</th>
                                                            <th class="min-w-75px">Day of Joining</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($dematAccount['all'] as $account)
                                                            @php
                                                                $datetime1 = strtotime($account->created_at);
                                                                $datetime2 = strtotime(date("Y-m-d"));
                                                                $days = (int)(($datetime2 - $datetime1)/86400);
                                                            @endphp
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td> {{$account->st_sg."-".$account->serial_number}} </td>
                                                                <td> {{$account->holder_name}}</td>
                                                                <td> {{$account->broker}}</td>
                                                                <td class="copy" style="cursor: copy;" title="copy text"> {{$account->user_id}}</td>
                                                                <td class="copy" style="cursor: copy;" title="copy text"> {{$account->password}}</td>
                                                                <td class="copy" style="cursor: copy;" title="copy text"> {{$account->mpin}}</td>
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
                                                                        @can("client-demat-write")
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" data-id='{{$account->id}}' data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' class="menu-link px-3 editDematAccount">Update Status</a>
                                                                            </div>
                                                                        @endcan
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 holdingDematAccount"  data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' data-value="holding">Add Holding</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{route('squareOffDemat',$account->id,$account)}}" class="menu-link px-3 squareOffDematAccount" >Square off</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 changeStatus" data-value="renew">Send for Renew</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 problemDematAccount" data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' data-value="problem">Make as Problem</a>
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
                                <div class="tab-pane fade show" id="holdingAccount" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <thead>
                                                        <tr
                                                            class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-10px">Serial Number</th>
                                                            <th class="min-w-75px">Holder Name</th>
                                                            <th class="min-w-75px">Broker</th>
                                                            <th class="min-w-75px">User Id</th>
                                                            <th class="min-w-75px">Password</th>
                                                            <th class="min-w-75px">MPIN</th>
                                                            <th class="min-w-75px">Available Fund</th>
                                                            <th class="min-w-75px">Profit / Loss</th>
                                                            <th class="min-w-75px">Day of Joining</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($dematAccount['holding'] as $account)
                                                            @php
                                                                $datetime1 = strtotime($account->created_at);
                                                                $datetime2 = strtotime(date("Y-m-d"));
                                                                $days = (int)(($datetime2 - $datetime1)/86400);
                                                            @endphp
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td> {{$account->st_sg."-".$account->serial_number}} </td>
                                                                <td> {{$account->holder_name}}</td>
                                                                <td> {{$account->broker}}</td>
                                                                <td class="copy" style="cursor: copy;" title="copy text"> {{$account->user_id}}</td>
                                                                <td class="copy" style="cursor: copy;" title="copy text"> {{$account->password}}</td>
                                                                <td class="copy" style="cursor: copy;" title="copy text"> {{$account->mpin}}</td>
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
                                                                        @can("client-demat-write")
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" data-id='{{$account->id}}' data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' class="menu-link px-3 editDematAccount">Update Status</a>
                                                                            </div>
                                                                        @endcan
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 changeStatus" data-value="normal">Remove as Holding</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 holdingDematAccount"  data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' data-value="holding">Add Holding</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{route('squareOffDemat',$account->id,$account)}}" class="menu-link px-3 squareOffDematAccount" >Square off</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 viewDematHolding"  data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' data-value="holding">View Holding</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 changeStatus" data-value="renew">Send for Renew</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 problemDematAccount" data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' data-value="problem">Make as Problem</a>
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
                                <div class="tab-pane fade show" id="renewAccount" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
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
                                                        @forelse($dematAccount['renew'] as $account)
                                                            @php
                                                                $datetime1 = strtotime($account->created_at);
                                                                $datetime2 = strtotime(date("Y-m-d"));
                                                                $days = (int)(($datetime2 - $datetime1)/86400);
                                                            @endphp
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
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
                                                                        @can("client-demat-write")
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" data-id='{{$account->id}}' data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' class="menu-link px-3 editDematAccount">Update Status</a>
                                                                            </div>
                                                                        @endcan
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 changeStatus" data-value="normal">Remove as Renew</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 problemDematAccount" data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' data-value="problem">Make as Problem</a>
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
                                <div class="tab-pane fade show" id="problemAccount" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
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
                                                            <th class="min-w-75px">Problem</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($dematAccount['problem'] as $account)
                                                            @php
                                                                $datetime1 = strtotime($account->created_at);
                                                                $datetime2 = strtotime(date("Y-m-d"));
                                                                $days = (int)(($datetime2 - $datetime1)/86400);
                                                            @endphp
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$account->st_sg."-".$account->serial_number}} </td>
                                                                <td>{{$account->name}}</td>
                                                                <td>{{$account->holder_name}}</td>
                                                                <td>{{$account->broker}}</td>
                                                                <td>{{$account->available_balance}}</td>
                                                                <td>{{$account->pl}}</td>
                                                                <td>{{$days}}</td>
                                                                <td>{{$account->problem}}</td>
                                                                <td class="text-end">
                                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        @can("client-demat-write")
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" data-id='{{$account->id}}' data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' class="menu-link px-3 editDematAccount">Update Status</a>
                                                                            </div>
                                                                        @endcan
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 changeStatus" data-value="renew">Send for Renew</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 changeStatus" data-value="normal">Remove as Problem</a>
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
                        <button type="submit" class="btn btn-primary">Submit</button>
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

    <!-- Modal -->
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
                            <label class="col-10 col-form-label">Fund Not Available</label>
                            <div class="col-2">
                                <input class="form-check-input toggleUserType" type="radio" name="problem" value="Fund Not Available" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-10 col-form-label">Password Incorrect</label>
                            <div class="col-2">
                                <input class="form-check-input toggleUserType" type="radio" name="problem" value="Password Incorrect" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-10 col-form-label">Trade Byself</label>
                            <div class="col-2">
                                <input class="form-check-input toggleUserType" type="radio" name="problem" value="Trade Byself" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-10 col-form-label">Mpin Incorrect</label>
                            <div class="col-2">
                                <input class="form-check-input toggleUserType" type="radio" name="problem" value="Mpin Incorrect" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-10 col-form-label">Other</label>
                            <div class="col-2">
                                <input class="form-check-input toggleUserType" type="radio" name="problem" value="other" />
                            </div>
                        </div>
                        <div class="form-group row" id="other_problem">
                            <label class="col-3 col-form-label">Other Problem</label>
                            <div class="col-9">
                                <input class="form-control" type="text" name="other_problem" />
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
                            <label class="col-3 col-form-label"></label>
                            <div class="col-9">
                                <select name="options" id="options" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                    <option value='' selected>Option</option>
                                    <option value='future'>Future</option>
                                    <option value='quantity'>Equity</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="margin_value_div">
                            <label class="col-3 col-form-label">Margin Value</label>
                            <div class="col-9">
                                <input class="form-control" type="text" name="margin_value" id="margin_value" />
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
    <!--end::Modal - View Client Details-->


    <!-- Modal -->
    <div class="modal fade" id="jumpModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('viewTraderClient')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Jump To Trader Client List</h2>
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
                            <label class="col-3 col-form-label">Trader</label>
                            <select class="form-select form-select-solid" id='trader_id' name="trader_id" data-control="select2" data-hide-search="true" data-placeholder="Select Trader">
                                <option value="">Select Trader</option>
                                @forelse ($traders as $trader)
                                    <option value="{{$trader->id}}">{{$trader->name}}</option>
                                @empty
                                @endforelse
                            </select>
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

    <!--begin::Modal - Call Modal-->
    <div class="modal fade" id="script_modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
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
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <div class="table-responsive">
                        <h3>Account Holding</h3>
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                            <tr
                                class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-10px">Sr No.</th>
                                <th class="min-w-125px">Script Name</th>
                                <th class="min-w-75px">Quantity</th>
                                <th class="min-w-75px">Entry Price</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-bold" id="script_data">

                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Call Modal-->

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
            $("select").select2();
            $(".datatable").DataTable();
            //for copy text
            var copy = document.querySelectorAll(".copy");
            for (const copied of copy) {
                copied.onclick = function() {
                    document.execCommand("copy");
                };
                copied.addEventListener("copy", function(event) {
                    event.preventDefault();
                    if (event.clipboardData) {
                        event.clipboardData.setData("text/plain", copied.textContent);
                    };
                });
            };
            //for copy text end

            $("#other_problem").hide();
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

            $(document).on("click",'.holdingDematAccount',function(e){
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
            });

            $(document).on("click",'.viewDematHolding',function(e){
                const id = e.target.getAttribute("data-id");
                const holderName = e.target.getAttribute("data-holder");
                $.ajax("{!! route('getScriptCall') !!}", {
                    type: "POST",
                    data:{
                        id:id
                    }
                })
                .done(data => {
                    var html = "";
                    var counter = 1;
                    $.each(data, function(index) {
                        html += " <tr>";
                        html += "<td>"+ (counter++) + "</td>";
                        html += "<td>"+ data[index]['script_name'] + "</td>";
                        html += "<td>"+ data[index]['quantity'] + "</td>";
                        html += "<td>"+ data[index]['entry_price'] + "</td>";
                        html += " </tr>";
                    });
                    $("#script_data").html(html);
                    $("#script_modal").modal("show");
                })
            });

            $(document).on("click",'.problemDematAccount',function(e){
                const id = e.target.getAttribute("data-id");
                const name = e.target.getAttribute("data-name");
                const holderName = e.target.getAttribute("data-holder");
                if(id){
                    $("#problem_demate_id").val(id);
                    $("#problem_client_Name").val(name);
                    $("#problem_holder_name").val(holderName);

                    $("#problemModal").modal("show");
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
                    success: function(response) {
                        window.location.href = "{{route('viewTraderAccounts')}}";
                    }
                });
            });

            $(document).on("click",'.changeStatus',function(e){
                var id=e.target.getAttribute("data-id");
                var value=e.target.getAttribute("data-value");
                $.ajax("{!! route('updateDematStatus') !!}",{
                    type:"POST",
                    data:{
                        id:id,
                        status: value
                    },
                    success: function(response) {
                        if(response){
                            window.location.href = "{{route('viewTraderAccounts')}}";
                        }else{
                            window.alert("Something want wrong");
                        }
                    }
                })
                .fail((err)=>{
                    if(err.status===403){
                        window.alert("Unauthorized Action");
                    }
                })
            });

            $(document).on("click",'.loginInfo',function(e){
                $.ajax("/loginInfo/" + $(this).attr("data-id"), {
                    type: "GET",
                }).done(data => {
                    $("#broker_name").val(data.broker);
                    $("#password").val(data.password);
                    $("#user_id").val(data.user_id);
                    $("#mpin").val(data.mpin);
                    $("#loginInfoModal").modal("show");
                });
            });

            $('input[type=radio][name=problem]').on('change', function() {
                if ($(this).val() == 'other') {
                    $("#other_problem").show();
                }else{
                    $("#other_problem").hide();
                }
            });

            $(document).on("click",'.jump',function(e){
                $("#jumpModal").modal("show");
            });
            $("#options").on("change",function(e){
                const val = e.target.value;
                $("#margin_value_div").hide();
                if(val=="future"){
                    $("#margin_value_div").show();
                }
            })
            $("#margin_value_div").hide();
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
            $.ajax("{{route('getLoginInfo')}}/" + id, {
                type: "GET",
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

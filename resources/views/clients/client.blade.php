@extends('layout')
@section("page-title","Clients - Client Management ")
@section("clientsData.clients","active")
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
                    @endif
                    <!--begin::Toolbar-->
                        <div class="toolbar" id="kt_toolbar">
                            <!--begin::Container-->
                            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                                <!--begin::Page title-->
                                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                    <!--begin::Title-->
                                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Clients</h1>
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
                                        <li class="breadcrumb-item text-dark">Client management</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                <!--begin::Actions-->
                                @can("client-create")
                                    <div class="d-flex align-items-center py-1">
                                        <!--begin::Button-->
                                        <a href="{{route('createClientForm')}}" class="btn btn-sm btn-primary" target="_blank">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>Add Client
                                        </a>
                                    </div>
                                @endcan
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
                                       href="#accountHandling">Account Handling ({{$clients['account_handling']['count']}})</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#mutualFund">Mutual Fund ({{$clients['mutual_fund']['count']}})</a>
                                </li>
                                <!--end:::Tab item-->


                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#unlistedShares">Unlisted Shares ({{$clients['unlisted_shares']['count']}})</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" href="#insurance">Insurance ({{$clients['insurance']['count']}})</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="accountHandling" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="">Sr. No.</th>
                                                            <th class="min-w-125px">Client Name</th>
                                                            <th class="min-w-125px">Contact Number</th>
                                                            <th class="min-w-75px">No. of Demat</th>
                                                            <th class="min-w-75px">Status</th>
                                                            <th class="text-end min-w-100px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($clients['account_handling'] as $client)
                                                            @if (isset($client->id))
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td class="d-flex align-items-center">
                                                                        <div class="d-flex flex-column">
                                                                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary mb-1">{{(isset($client->name))?$client->name:""}}</a>
                                                                            <span>{{isset($client->email)?$client->email:""}}</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{isset($client->number)?$client->number:""}}</td>
                                                                    <td>{{ isset($client->clientDemat)?$client->clientDemat->count():""}}</td>
                                                                    <td>{{ ($client->status=="2")?"Verified":"Unverified"}}</td>
                                                                    <td class="text-end">
                                                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                            @can("client-read")
                                                                                <div class="menu-item px-3">
                                                                                    <a href="{{route('clientView',$client->id)}}" data-id='{{$client->id}}' class="menu-link px-3">View</a>
                                                                                </div>
                                                                            @endcan
                                                                            @can("client-write")
                                                                                <div class="menu-item px-3">
                                                                                    <a href="{{route('updateClientForm',$client->id)}}" data-id='{{$client->id}}' class="menu-link px-3">Edit</a>
                                                                                </div>
                                                                            @endcan
                                                                            <!--div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" data-id='{{$client->id}}' data-name='{{$client->name}}' class="menu-link px-3 assignTrader">Assign Trader</a>
                                                                            </div-->
                                                                            @can("client-delete")
                                                                                <div class="menu-item px-3">
                                                                                    <a href="{{route('removeClient',$client->id)}}" data-id='{{$client->id}}' class="menu-link px-3 removeClient">Remove</a>
                                                                                </div>
                                                                            @endcan
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
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
                                <div class="tab-pane fade show" id="mutualFund" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="">Sr. No.</th>
                                                            <th class="min-w-125px">Client Name</th>
                                                            <th class="min-w-125px">No. of Investments</th>
                                                            <th class="min-w-75px">Investment</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($clients['mutual_fund'] as $client)
                                                            @if (isset($client->id))
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td>{{$client->name}}</td>
                                                                    <td>{{ $client->clientDemat->count()}}</td>
                                                                    <td>{{ ($client->status)?"Verified":"unverified"}}</td>
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
                                                                                <a href="javascript:void(0)" data-id='{{$client->id}}' class="menu-link px-3">View Investments</a>
                                                                            </div>
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" data-id='{{$client->id}}' class="menu-link px-3">Terminate</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
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
                                <div class="tab-pane fade show" id="unlistedShares" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="">Sr. No.</th>
                                                            <th class="min-w-125px">Client Name</th>
                                                            <th class="min-w-125px">Contact Number</th>
                                                            <th class="min-w-75px">No. of Demat</th>
                                                            <th class="min-w-75px">Status</th>
                                                            <th class="text-end min-w-100px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($clients['unlisted_shares'] as $client)
                                                            @if (isset($client->id))
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td class="d-flex align-items-center">
                                                                        <div class="d-flex flex-column">
                                                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$client->name}}</a>
                                                                            <span>{{$client->email}}</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{$client->number}}</td>
                                                                    <td>{{ $client->clientDemat->count()}}</td>
                                                                    <td>{{ ($client->status)?"Verified":"unverified"}}</td>
                                                                    <td class="text-end">
                                                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                            @can("client-read")
                                                                                <div class="menu-item px-3">
                                                                                    <a href="{{route('clientView',$client->id)}}" data-id='{{$client->id}}' class="menu-link px-3">View</a>
                                                                                </div>
                                                                            @endcan
                                                                            @can("client-write")
                                                                                <div class="menu-item px-3">
                                                                                    <a href="{{route('updateClientForm',$client->id)}}" data-id='{{$client->id}}' class="menu-link px-3">Edit</a>
                                                                                </div>
                                                                            @endcan
                                                                            <!--div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" data-id='{{$client->id}}' data-name='{{$client->name}}' class="menu-link px-3 assignTrader">Assign Trader</a>
                                                                            </div-->
                                                                            @can("client-delete")
                                                                                <div class="menu-item px-3">
                                                                                    <a href="{{route('removeClient',$client->id)}}" data-id='{{$client->id}}' class="menu-link px-3 removeClient">Remove</a>
                                                                                </div>
                                                                            @endcan
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
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
                                <div class="tab-pane fade show" id="insurance" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="">Sr. No.</th>
                                                            <th class="min-w-125px">Client Name</th>
                                                            <th class="min-w-125px">Contact Number</th>
                                                            <th class="min-w-75px">No. of Demat</th>
                                                            <th class="min-w-75px">Status</th>
                                                            <th class="text-end min-w-100px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($clients['insurance'] as $client)
                                                            @if (isset($client->id))
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td class="d-flex align-items-center">
                                                                        <div class="d-flex flex-column">
                                                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$client->name}}</a>
                                                                            <span>{{$client->email}}</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{$client->number}}</td>
                                                                    <td>{{ $client->clientDemat->count()}}</td>
                                                                    <td>{{ ($client->status)?"Verified":"unverified"}}</td>
                                                                    <td class="text-end">
                                                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                            @can("client-read")
                                                                                <div class="menu-item px-3">
                                                                                    <a href="{{route('clientView',$client->id)}}" data-id='{{$client->id}}' class="menu-link px-3">View</a>
                                                                                </div>
                                                                            @endcan
                                                                            @can("client-write")
                                                                                <div class="menu-item px-3">
                                                                                    <a href="{{route('updateClientForm',$client->id)}}" data-id='{{$client->id}}' class="menu-link px-3">Edit</a>
                                                                                </div>
                                                                            @endcan
                                                                            @can("client-delete")
                                                                                <div class="menu-item px-3">
                                                                                    <a href="{{route('removeClient',$client->id)}}" data-id='{{$client->id}}' class="menu-link px-3 removeClient">Remove</a>
                                                                                </div>
                                                                            @endcan
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @empty
                                                            {{-- empty --}}
                                                        @endforelse
                                                    </tbody>
                                                <!--end::Table body-->
                                                </table>
                                            </div>
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
    <!--begin::Modal - View Client Details-->
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
                <div class="modal-body mx-md-10">
                    <!--begin::Form-->
                    <form id="" class="form" action="#">
                        <!--begin::Scroll-->
                        <!-- <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px"> -->

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Client</label>
                            <div class="col-9">
                                <input class="form-control" type="text" value="" id="client_name" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-3 col-form-label">Number</label>
                            <div class="col-9">
                                <input class="form-control" type="text" value="" id="client_number" readonly /> </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-tel-input" class="col-3 col-form-label">Profession</label>
                            <div class="col-9">
                                <input class="form-control" type="text" value="" id="client_profession"  readonly/>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="no-of-demat" class="col-3 col-form-label">Status</label>
                            <div class="col-9">
                                <input class="form-control" type="text" value="" id="client_status"  readonly/>
                            </div>
                        </div>
                        <!-- </div> -->
                        <!--end::Scroll-->
                    </form>
                    <!--end::Form-->
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
            </div>
        </div>
    </div>
    <!-- Modal -->

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
            $(()=>{
                $(".datatable").DataTable();
                const name = $("#client_name");
                const number = $("#client_number");
                const profession = $("#client_profession");
                const status = $("#client_status");

                $(document).on("click",".viewClient",function(){
                    $.ajax("/client/view/"+$(this).attr("data-id"),{
                        type:"GET",
                    })
                    .done(data=>{
                        $(name).val(data.name);
                        $(number).val(data.number);
                        $(profession).val(data.profession);
                        $(status).val(((data.status)?"Active":"Inactive"));
                        $("#viewClient").modal("show");
                    })
                })
                $("#viewClient").modal("hide");
                $(document).on("click",'.assignTrader',function(e){
                    const id = e.target.getAttribute("data-id");
                    const name = e.target.getAttribute("data-name");
                    if(id){
                        $("#assignId").val(id);
                        $("#assignName").val(name);
                        $("#assignTraderModal").modal("show");
                    }else{
                        window.alert("Unable to Load this Client");
                    }
                });
                $(document).on("click",".removeClient",e=>{
                    if(!window.confirm("Are you sure you want to remove this Client?")){
                        e.preventDefault();
                    }
                })
            },jQuery)
        })
    </script>
@endsection

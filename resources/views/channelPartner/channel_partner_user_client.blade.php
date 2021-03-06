@extends('layout')
@section("page-title","Channel Partner - Partner Management")
@section("channelPartnerClient","active")
@section("partner_management.accordion","hover show")
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
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Channel Partner Clients</h1>
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
                                    <li class="breadcrumb-item text-dark">Partner management</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center py-1">
                            </div>
                            <!--end::Actions-->
                            @can("client-create")
                                <div class="d-flex align-items-center py-1">
                                    <!--begin::Button-->
                                    <a href="{{route('channelPartnerClientForm')}}" class="btn btn-sm btn-primary" target="_blank">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>Add Client
                                    </a>
                                </div>
                            @endcan
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
                                       href="#activeTab">Active</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#problebTab">Problem</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#renewTab">Renew</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#terminatedTab">Terminate</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="activeTab" aria-labelledby="active-tab"
                                     role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr
                                                            class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Client</th>
                                                            <th class="min-w-75px">Demat</th>
                                                            <th class="min-w-75px">Capital</th>
                                                            <th class="min-w-75px">P / L</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($demats as $client)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td class="d-flex align-items-center">
                                                                    {{$client->withClient->name}}
                                                                </td>
                                                                <td>
                                                                    {{$client->holder_name}}
                                                                </td>
                                                                <td>
                                                                    {{$client->capital}}
                                                                </td>
                                                                <td>
                                                                    {{$client->pl}}
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-2">
                                                                            <a href="{{route('editRoleForm',$client->id)}}" class="menu-link" data-id="{{$client->id}}">
                                                                                Edit
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-2">
                                                                            <a href="javascript:void(0)" data-id="{{$client->id}}" class="removeRole menu-link">
                                                                                Delete
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
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <div class="tab-pane fade show" id="problebTab" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr
                                                            class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Client</th>
                                                            <th class="min-w-75px">Mobile</th>
                                                            <th class="min-w-75px">Demat</th>
                                                            <th class="min-w-75px">Problem</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($problemAccounts as $client)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td class="d-flex align-items-center">
                                                                    {{$client->withClient->name}}
                                                                </td>
                                                                <td>
                                                                    {{$client->withClient->number}}
                                                                </td>
                                                                <td>
                                                                    {{$client->holder_name}}
                                                                </td>
                                                                <td>
                                                                    {{$client->problem}}
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-2">
                                                                            <a href="{{route('editRoleForm',$client->id)}}" class="menu-link" data-id="{{$client->id}}">
                                                                                View Problem
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item px-2">
                                                                            <a href="javascript:void(0)" data-id="{{$client->id}}" class="removeRole menu-link">
                                                                                Terminate
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
                                <div class="tab-pane fade show" id="renewTab" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr
                                                            class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Client</th>
                                                            <th class="min-w-75px">Demat</th>
                                                            <th class="min-w-75px">Capital</th>
                                                            <th class="min-w-75px">P / L</th>
                                                            <th class="min-w-75px">Payment</th>
                                                            <th class="min-w-75px">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($toRenews as $client)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>
                                                                    {{$client->name}}
                                                                </td>
                                                                <td class="d-flex align-items-center">
                                                                    {{$client->holder_name}}
                                                                </td>
                                                                <td>
                                                                    {{$client->number}}
                                                                </td>
                                                                <td>
                                                                    {{$client->pl}}
                                                                </td>
                                                                <td>
                                                                    {{$client->total_payment}}
                                                                </td>
                                                                <td>
                                                                    {{$client->status=="to_renew"?"Pending":"Renewed"}}
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
                                <div class="tab-pane fade show" id="terminatedTab" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr
                                                            class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr No.</th>
                                                            <th class="min-w-75px">Client</th>
                                                            <th class="min-w-75px">Demat</th>
                                                            <th class="min-w-75px">Terminate on</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($terminatedAccounts as $client)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td class="d-flex align-items-center">
                                                                    {{$client->client_name}}
                                                                </td>
                                                                <td>
                                                                    {{$client->holder_name}}
                                                                </td>
                                                                <td>
                                                                    {{$client->terminated_at}}
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                        <div class="menu-item px-2">
                                                                            <a href="{{route('editRoleForm',$client->client_id)}}" class="menu-link" data-id="{{$client->id}}">
                                                                                Active
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
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $(".datatable").DataTable();
            },jQuery)
        })
    </script>
@endsection

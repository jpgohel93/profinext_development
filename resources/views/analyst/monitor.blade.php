@extends('layout')
@section("page-title","Monitor Data - Analyst Management")
@section("analyst.monitorData","active")
@section("analyst_management.accordion","hover show")
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
                        <div id="kt_toolbar_container" class="container-fluid mx-7 d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Monitor Data</h1>
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
                                    <li class="breadcrumb-item text-dark">Analyst management</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center py-1">
                            @can("monitor-data-create")
                                <!--begin::Button-->
                                    <a href="{{route('users')}}" class="btn btn-sm btn-primary" id="kt_toolbar_primary_button">
									<span class="svg-icon svg-icon-2">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
											<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
										</svg>
									</span>Add Monitor
                                    </a>
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
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        @can("monitor-data-read")
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                        <th class="min-w-10px">Sr No.</th>
                                                        <th class="min-w-75px">Monitor Name</th>
                                                        <th class="min-w-75px">Total Analyst</th>
                                                        @can("monitor-data-write")
                                                            <th class="min-w-75px text-center">Action</th>
                                                        @endcan
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 fw-bold">
                                                    @forelse ($users as $user)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td class="d-flex align-items-center">
                                                                <div class="d-flex flex-column">
                                                                    <a href="#" target="_blank" class="text-gray-800 text-hover-primary mb-1">{{$user->name}}</a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{$user->total_analyst}}
                                                            </td>
                                                            @can("monitor-data-write")
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="menu-item">
                                                                            <a href="{{url('monitor_analysts/'.$user->id)}}" class="menu-link p-1" target="_blank">
                                                                                <i class="fa fa-edit text-dark fa-2x"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            @endcan
                                                        </tr>
                                                    @empty
                                                        {{-- empty --}}
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        @else
                                            <h1>Unauthorised</h1>
                                        @endcan
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
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

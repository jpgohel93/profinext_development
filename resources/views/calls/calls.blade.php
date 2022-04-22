@extends('layout')
@section("page-title","Trade")
@section("calls","active")
@section("trading","hover show")
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
                        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                            <!--begin::Title-->
                            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Trade</h1>
                            <!--end::Title-->
                            <!--begin::Separator-->
                            <span class="h-20px border-gray-200 border-start mx-4"></span>
                            <!--end::Separator-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    <a href="dist/index.html" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-dark">Trade</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                        <!--begin::Actions-->
{{--                        @can("calls-create")--}}
{{--                            <div class="d-flex align-items-center py-1">--}}
{{--                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"--}}
{{--                                    data-bs-target="#call_modal">--}}
{{--                                    <span class="svg-icon svg-icon-2">--}}
{{--										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--											<rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />--}}
{{--											<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />--}}
{{--										</svg>--}}
{{--									</span>--}}
{{--                                    Add Trade--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endcan--}}
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
                                        href="#activeTab">Active</a>
                                </li>
                                <!--end:::Tab item-->
                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                        href="#closedTab">Closed</a>
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
                                                            <th class="min-w-125px">Analyst Name</th>
                                                            <th class="min-w-75px">Script Name</th>
                                                            <th class="min-w-75px">No. of Demat</th>
                                                            <th class="text-center min-w-100px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse($calls['active'] as $call)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td class="d-flex align-items-center">
                                                                    <div class="d-flex flex-column">
                                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$call->analyst->analyst}}</a>
                                                                    </div>
                                                                </td>
                                                                <td>{{$call->script_name}}</td>
                                                                <td>{{$call->total}}</td>
                                                                <td class="">
                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="menu-item">
                                                                            <a href="javascript:void(0)" class="menu-link p-1 script_modal_view" data-type="open" data-script_name="{{$call->script_name}}">
                                                                                <i class="fa fa-eye text-dark fa-2x"></i>
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
                                <div class="tab-pane fade" id="closedTab" aria-labelledby="closed-tab" role="tabpanel">
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
                                                            <th class="min-w-125px">Analyst Name</th>
                                                            <th class="min-w-75px">Script Name</th>
                                                            <th class="min-w-75px">No. of Demat</th>
                                                            <th class="text-end min-w-100px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="closedCallTable">
                                                        @forelse($calls['closed'] as $call)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td class="d-flex align-items-center">
                                                                    <div class="d-flex flex-column">
                                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$call->analyst->analyst}}</a>
                                                                    </div>
                                                                </td>
                                                                <td>{{$call->script_name}}</td>
                                                                <td>{{$call->total}}</td>
                                                                <td class="">
                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="menu-item">
                                                                            <a href="javascript:void(0)" class="menu-link script_modal_view p-1"  data-type="close" data-script_name="{{$call->script_name}}">
                                                                                <i class="fa fa-eye text-dark fa-2x"></i>
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
<!-- delete model -->
<div class="modal fade" id="confirmDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">Delete</h2>
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
            <div class="modal-body mx-md-10" style="text-align: -webkit-center;">
                <div class="d-felx justify-content-center align-items-center">
                    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                    <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_jcuhm71r.json"  background="transparent"  speed="0.5"  style="width: 200px; height: 200px;"  loop autoplay></lottie-player>
                    <h4>Are you sure you want to Delete this user?</h4>
                </div>
            </div>

            <!--end::Modal body-->
            <div class="modal-footer text-center">
                <!-- <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button> -->
                <button type="submit" class="btn btn-primary" id="confirmDeleteCallBtn">Yes</button>
                <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit" data-bs-dismiss="modal">
                    <span class="indicator-label">No</span>
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--end::Modals-->
<div class="modal fade" id="call_modal_view" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px" role="document">
        <div class="modal-content">
            <form id="editCallForm" class="form" method="POST" action="{{route('editCall')}}">
                <div id="editId"></div>
                @csrf
                <div class="modal-header">
                    <h2 class="fw-bolder">View Call Details</h2>
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
                        <label class="col-3 col-form-label">Analyst Name</label>
                        <div class="col-9">
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select a analyst" name="analyst_id" id="analyst_id">
                                @forelse ($calls['analysts'] as $key => $analyst)
                                    <option value='{{$analyst->id}}' {{(old('analyst')==$analyst->id)?"selected":($key==0?"selected":"")}}>{{$analyst->analyst}}</option>
                                @empty
                                    {{-- empty --}}
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-3 col-form-label">Position</label>
                        <div class="col-9">
                            <input class="form-control" type="text" value="Put" id="example-email-input" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-tel-input" class="col-3 col-form-label">Script Name</label>
                        <div class="col-9">
                            <input type="type" class="form-control" id="script_name"  name="script_name" list="listValue" value="{{old('script_name')}}"/>
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
                        <label for="no-of-demat" class="col-3 col-form-label">Entry Price</label>
                        <div class="col-9">
                            <input class="form-control" type="text" value="{{old('entry_price')}}" name="entry_price" id="entry_price" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no-of-demat" class="col-3 col-form-label">Target</label>
                        <div class="col-9">
                            <input class="form-control" type="text" value="{{old('target_price')}}" name="target_price" id="target_price" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no-of-demat" class="col-3 col-form-label">Stoploss</label>
                        <div class="col-9">
                            <input class="form-control" type="text" value="{{old('stop_loss')}}" name="stop_loss" id="stop_loss" />
                        </div>
                    </div>
                </div>
                <!--end::Modal body-->
                <div class="modal-footer text-center">
                    <!-- <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button> -->
                    <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                        <span class="indicator-label">Edit</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--begin::Modal - Call Modal-->
<div class="modal fade" id="call_modal" tabindex="-1" aria-hidden="true">
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
                <!--begin:Form-->
                <form id="call_modal_form" method="POST" action="{{route('createCall')}}" class="form" action="#">
                    @csrf
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Add Call</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <div class="row mb-8">
                        <!--begin::Input group-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Analyst Name</label>
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select a analyst" name="analyst_id">
                                @forelse ($calls['analysts'] as $key => $analyst)
                                    <option value='{{$analyst->id}}' {{(old('analyst')==$analyst->id)?"selected":($key==0?"selected":"")}}>{{$analyst->analyst}}</option>
                                @empty
                                    {{-- empty --}}
                                @endforelse
                            </select>
                        </div>
                        <!--end::Col-->
                        <!--end::Input group-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Due Date</label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">
                                <!--begin::Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                <span class="svg-icon svg-icon-2 position-absolute mx-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black" />
                                        <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black" />
                                        <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Icon-->
                                <!--begin::Datepicker-->
                                <input type="date"  class="form-control form-control-solid ps-12 c-date" placeholder="Select a date" name="due_date" />
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-8">
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Script Name</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a script name"></i>
                        </label>
{{--                        <!--end::Label-->--}}
{{--                        <input type="text" class="form-control form-control-solid" placeholder="Enter script name" name="script_name" />--}}

                        <input type="type" class="form-control form-control-solid" id="script_name"  name="script_name" list="listValue"/>
                        <datalist id="listValue">
                            @if(!empty($keywords))
                                @foreach($keywords as $keyword)
                                    <option value="{{$keyword->name}}">{{$keyword->name}}</option>
                                @endforeach
                            @endif
                        </datalist>

                    </div>
                    <!--end::Col-->

                    <!--begin::Input group-->
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Lot Size</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify lot size"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Lot Size" name="lot_size" />
                    </div>
                    <!--end::Input group-->
                    </div>

                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Entry Price</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a entry price"></i>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" placeholder="Enter entry price" name="entry_price" />

                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Target Price</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target price"></i>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" placeholder="Enter target price" name="target_price" />
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Stop Loss</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a stop loss"></i>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" placeholder="Enter stop loss" name="stop_loss" />
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Margin Value</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a margin value"></i>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" placeholder="Enter margin value" name="margin_value" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="reset" id="call_modal_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="call_modal_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
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
<!--end::Modal - Call Modal-->

<!--begin::Modal - Call Modal-->
<div class="modal fade" id="script_modal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                    <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                            <thead>
                                <tr
                                    class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-10px">Sr No.</th>
                                    <th class="min-w-125px">Holder Name</th>
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

<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
            <path
                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                fill="black" />
        </svg>
    </span>
    <!--end::Svg Icon-->
</div>
@if ($errors->any())
<script>
    window.addEventListener("DOMContentLoaded", function () {
        $("#viewAnalyst").modal("show");
        $(analyst_status).trigger("change");
    });

</script>
@endif)
<script>
    window.addEventListener("DOMContentLoaded", function () {
        $(".datatable").DataTable();
        // cache create fields
        const analyst = $("#analyst");
        const total_colls = $("#total_colls");
        const accuracy = $("#accuracy");
        const analyst_status = $("#analyst_status");
        const trading_capacity = $("#trading_capacity");
        const editAnalystId = $("#editAnalystId");
        const editAnalyst = $("#editAnalyst");

        // cache edit fields
        const analyst_id = $("#analyst_id");
        const script_name = $("#script_name");
        const entry_price = $("#entry_price");
        const target_price = $("#target_price");
        const stop_loss = $("#stop_loss");

        $(document).on("click", ".call_modal_view", function () {
            const id = $(this).attr("data-id");
            $.ajax("{!! route('getCall') !!}", {
                    type: "POST",
                    data:{
                        id:id
                    }
                })
                .done(data => {
                    $(analyst_id).val(data.analyst.id);
                    $(analyst_id).trigger("change");
                    $(script_name).val(data.script_name);
                    $(entry_price).val(data.entry_price);
                    $(target_price).val(data.target_price);
                    $(stop_loss).val(data.stop_loss);
                    $("#editId").html(`<input type='hidden' value='${id}' name='call_id' />`);
                    $("#call_modal_view").modal("show");
                })
        });

        $(document).on("click", ".script_modal_view", function () {
            const scriptName = $(this).attr("data-script_name");
            const type = $(this).attr("data-type");
            $.ajax("{!! route('getScriptCall') !!}", {
                    type: "POST",
                    data:{
                        scriptName:scriptName,
                        type:type
                    }
                })
                .done(data => {
                    var html = "";
                    var counter = 1;
                    $.each(data, function(index) {
                        html += " <tr>";
                        html += "<td>"+ (counter++) + "</td>";
                        html += "<td>"+ data[index]['holder_name'] + "</td>";
                        html += "<td>"+ data[index]['script_name'] + "</td>";
                        html += "<td>"+ data[index]['quantity'] + "</td>";
                        html += "<td>"+ data[index]['entry_price'] + "</td>";
                        html += " </tr>";
                    });
                    $("#script_data").html(html);
                    $("#script_modal").modal("show");
                })
        });

        $("#viewAnalyst").modal("hide");
        // $("#confirmDelete").modal("hide");
        $("#closeModel").on("click", function () {
            $("#viewAnalyst").modal("hide");
        })
        $(document).on("click",".deleteCall",function(e){
            const id = e.target.getAttribute("data-id");
            if(id){
                $("#confirmDeleteCallBtn").attr("data-id",id);
                $("#confirmDelete").modal("show");

            }else{
                window.alert("Unable to close this call");
            }
        })
        $("#confirmDeleteCallBtn").on("click", function(e){
            const id = e.target.getAttribute("data-id");
            if(id){
                $.ajax('{!! route("deleteCall") !!}',{
                    type:"POST",
                    data:{
                        id:id
                    }
                })
                .done(data=>{
                    if(data){
                        const html = `<div class="container" id='tempMsgContainer'><h5 class="alert alert-info">Call Closed</h5></div>`
                        $("#kt_content").prepend(html);
                        $("#confirmDelete").modal("hide");
                        const tr = $("[data-id='"+id+"'][class*='deleteCall']")[0].closest("tr");
                        const call = $(tr).html();
                        $("[data-id='"+id+"'][class*='deleteCall']")[0].closest("tr").remove();
                        $("#closedCallTable").append(call);
                        setTimeout(() => {
                            $("#tempMsgContainer").remove();
                        }, 3000);
                    }
                })
            }else{
                window.alert("Unable to close this call");
            }
        })
    })

</script>
@endsection

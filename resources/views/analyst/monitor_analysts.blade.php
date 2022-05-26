@extends('layout')
@section("page-title","Analysis")
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
                                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Monitor Analyst</h1>
                                    <!--end::Title-->
                                    <!--begin::Separator-->
                                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                                    <!--end::Separator-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <a href="profinext/dist/index.html" class="text-muted text-hover-primary">Home</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-dark">Monitor Analyst</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
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
                                                    <th class="min-w-75px">Analyst Name</th>
                                                    <th class="min-w-75px">status</th>
                                                    <th class="min-w-75px text-end">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-gray-600 fw-bold">
                                                    @forelse ($analysts as $analyst)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td class="d-flex align-items-center">
                                                                <div class="d-flex flex-column">
                                                                    <a href="#" target="_blank" class="text-gray-800 text-hover-primary mb-1">{{$analyst->analyst}}</a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{$analyst->status}}
                                                            </td>
                                                            <td class="text-end">
                                                                <a  href="javascript:void(0)" class="viewAnalyst" data-id='{{$analyst->id}}' >
                                                                    <i class="fa fa-edit text-dark fa-2x px-5"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        {{-- empty --}}
                                                    @endforelse
                                                <!--end::Table row-->
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
                            <!--end::Container-->
                        </div>
                        <!--end::Post-->
                </div>
                <!--end::Content-->

                <!--begin::Modals-->
                <!--begin::Modal - View Analyst Details-->
                <div class="modal fade" id="viewAnalyst" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px" role="document">
                        <form id="" class="form" method="POST" action="{{route('editAnalystAssignTo')}}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="fw-bolder">Analyst Details</h2>
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
                                    <input type="hidden" name="analyst_id" id="editAnalystId" value="{{old('analyst_id')}}">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Analyst</label>
                                        <div class="col-9">
                                            <input class="form-control" name="analyst" type="text" value="{{old('analyst')}}" id="analyst"  />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <label for="no-of-demat" class="col-3 col-form-label">Assign To</label>
                                        <div class="col-9">
                                            <select name="assign_user_id" id="assign_user_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select option">
                                                <option value=""></option>
                                                @if(!empty($monitor))
                                                    @foreach($monitor as $monitorData)
                                                        <option value="{{$monitorData->id}}">{{$monitorData->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Modal body-->
                                <div class="modal-footer text-center">
                                    <button type="button" class="btn btn-primary" id="closeModel">
                                        <span class="indicator-label">Cancle</span>
                                    </button>
                                    <button type="submit" id="editAnalyst" class="btn btn-primary" data-kt-users-modal-action="submit">
                                        <span class="indicator-label">Save</span>
                                    </button>
                                    {{-- <button type="button" id="terminate" name="terminate" class="btn btn-light me-3">Terminate</button> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end::Modal - View Client Details-->
                <!--end::Modals-->

                <!--begin::Footer-->
            @include("footer")
            <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--begin::Modals-->
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(".datatable").DataTable();
            $("select[data-control='select2']").select2();
            const analyst = $("#analyst");
            const editAnalystId = $("#editAnalystId");
            const editAnalyst = $("#editAnalyst");
            const assign_user_id = $("#assign_user_id");


            $(document).on("click",".viewAnalyst",function(){
                $.ajax("/analyst/"+$(this).attr("data-id"),{
                    type:"GET",
                })
                .done(data=>{
                    $(analyst).val(data.analyst);
                    $(editAnalyst).val(data.id);
                    $(editAnalystId).val(data.id);
                    $(assign_user_id).val(data.assign_user_id);
                    $(assign_user_id).trigger("change");
                    $("#viewAnalyst").modal("show");
                })
            })
            $("#viewAnalyst").modal("hide");
            $("#closeModel").on("click",function(){
                $("#viewAnalyst").modal("hide");
            })
        })
    </script>
@endsection

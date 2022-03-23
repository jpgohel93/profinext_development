@extends('layout')
@section("page-title","Client Demat Account - Finance Management")
@section("finance_management.renewal_status","active")
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
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Roles</h1>
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
                                    <li class="breadcrumb-item text-dark">Roles</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center py-1">
                                @can("role-create")
                                <!--begin::Button-->
                                <a href="{{route('addRoles')}}" class="btn btn-sm btn-primary" id="kt_toolbar_primary_button">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                        </svg>
                                    </span>Add Role
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
                            <div class="current d-block card p-7 my-5" data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="stepper-label mt-0" style="margin-top:30px;margin-bottom:20px;">
                                        <h3 class="stepper-title">Client Name:&nbsp;{{$demateDetails->withClient->name}}</h3>
                                    </div>
                                    <div class="my-4">
                                        <div class="row">
                                            <h3 class="stepper-title">Demat Details :</h3>
                                            <!--begin::Input group-->
                                            <div class="col-md-6 mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Smart Id</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->st_sg}}' readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="col-md-6 col-sm-12 mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Demat Holder Name</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->holder_name}}' readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="col-md-6 col-sm-12 mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Broker</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->broker}}' readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="col-md-6 col-sm-12 mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">User id</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->user_id}}' readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="col-md-6 col-sm-12 mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Password</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->password}}' readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="col-md-6 col-sm-12 mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Mpin</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->mpin}}' readonly/>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-4">
                                        <div class="row">
                                            <h3 class="stepper-title">P / L Status :</h3>
                                            <!--begin::Input group-->
                                            <div class="col-md-6 mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Joining Capital</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->capital}}' readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="col-md-6 col-sm-12 mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Available Fund</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->available_balance}}' readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="col-md-6 col-sm-12 mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">P / L</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->pl}}' id="current_pl" readonly/>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-4">
                                        <div class="row">
                                            <div class="d-flex flex-stack pt-10">
                                                <div>
                                                    <button type="button" class="btn btn-sm btn-primary" id="calculationBtn">Rough Calculation</button>
                                                    <button type="button" data-id='{{$demateDetails->id}}' id="backToTrade" class="btn btn-sm btn-primary changeStatus" data-value="normal">Back to trade</button>
                                                </div>
        									</div>
                                        </div>
                                    </div>
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
    <div class="modal fade" id="edit_client_demate_status" tabindex="-1" aria-hidden="true">
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
                            <h3 class="mb-3">Edit P / L</h3>
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
                    @if($errors->any())
                        <h5 class="alert alert-danger">{{$errors->first()}}</h5>
                    @endif
                    <!--begin:Form-->
                    <form method="POST" action="{{route('clientDematupdatePL')}}">
                        @csrf
                        <div id="editIdContainer"></div>
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">P / L:</span>
                                    <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify P/L"></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{old('pl')}}" class="form-control form-control-solid" id="plfield" name="pl" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        
                        <!--begin::Actions-->
                        <div class="text-end">
                            <button type="reset" id="call_modal_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="call_modal_submit" class="btn btn-primary">
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
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $(document).on("click",'.changeStatus',function(e){
                    var id=e.target.getAttribute("data-id");
                    var value=e.target.getAttribute("data-value");
                    $.ajax("{!! route('updateDematStatus') !!}",{
                        type:"POST",
                        data:{
                            id:id,
                            status: value
                        },
                        headers: {
                            'X-CSRF-TOKEN': $("input[name='_token']").val()
                        },
                        success: function(response) {
                            if(response){
                                window.location.href = "{!! route('renewal_status') !!}";
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
                $("#calculationBtn").on("click",function(){
                    $("#plfield").val($("#current_pl").val());
                    const id = $("#backToTrade").attr("data-id");
                    $("#editIdContainer").html(`<input type='hidden' name='id' value='${id}'>`);
                    $("#edit_client_demate_status").modal("show");
                })
            },jQuery)
        })
    </script>
@endsection
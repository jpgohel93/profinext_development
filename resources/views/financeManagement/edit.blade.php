@extends('layout')
@section("page-title","Edit Bank - Finance Management")
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
                                    <li class="breadcrumb-item text-dark">Edit bank</li>
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
                        <div id="kt_content_container" class="container">
                            <!--begin:Form-->
                            <form method="POST" action="{{route('editFinanceManagementBank')}}">
                                @csrf
                                <div id="editIdContainer">
                                    <input type="hidden" name="id" value="{{$bank->id}}">
                                </div>
                                <div class="row mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <!--begin::Label-->
                                        <div class="form-group">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Bank Type:</span>
                                            </label>
                                            <!--end::Label-->
                                            <select class="form-select form-select-solid" name="type" id="bank_type" required>
                                                <option value="0">Select Type</option>
                                                <option value='1' {{old('type') && old("type")==1?"selected":($bank->type==1?"selected":"")}}>For Income</option>
                                                <option value="2" {{old('type') && old("type")==2?"selected":($bank->type==2?"selected":"")}}>For Salary</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Bank Title:</span>
                                                <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" value="{{old('title')?old('title'):$bank->title}}" name="title" class="form-control form-control-solid" />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Account Type:</span>
                                                <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" value="{{old('account_type')?old('account_type'):$bank->account_type}}" name="account_type" class="form-control form-control-solid" />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">IFSC Code:</span>
                                                <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" value="{{old('ifsc_code')?old('ifsc_code'):$bank->ifsc_code}}" name="ifsc_code" class="form-control form-control-solid" />
                                        </div>
                                        <div class="form-group">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Primary Bank:</span>
                                                <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                            </label>
                                            <select class="form-select form-select-solid" name="is_primary" required>
                                                <option value="1" {{old('is_primary') && old("is_primary")==1?"selected":($bank->is_primary==1?"selected":"")}}>Yes</option>
                                                <option value="0" {{old('is_primary') && old("is_primary")==2?"selected":($bank->is_primary==2?"selected":"")}} selected>No</option>
                                            </select>
                                        </div>
                                        <div id="forSalaryFields" style="display:{{old('type') && old("type")==2?"block":($bank->type==2?"block":"none")}}">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-6 fw-bold">
                                                    <span class="required">Reserve Balance:</span>
                                                    <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" value="{{old('reserve_balance')?old('reserve_balance'):$bank->reserve_balance}}" name="reserve_balance" class="form-control form-control-solid" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="forIncomeFields" style="display:{{old('type') && old("type")==1?"block":($bank->type==1?"block":"none")}}">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-6 fw-bold">
                                                    <span class="required">Available Balance:</span>
                                                    <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" value="{{old('available_balance')?old('available_balance'):$bank->available_balance}}" name="available_balance" class="form-control form-control-solid" />
                                            </div>
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-6 fw-bold">
                                                    <span class="required">Limit Utilize:</span>
                                                    <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" value="{{old('limit_utilize')?old('limit_utilize'):$bank->limit_utilize}}" name="limit_utilize" class="form-control form-control-solid" />
                                            </div>
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-6 fw-bold">
                                                    <span class="required">Target:</span>
                                                    <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" value="{{old('target')?old('target'):$bank->target}}" name="target" class="form-control form-control-solid" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Bank Name:</span>
                                                <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" value="{{old('name')?old('name'):$bank->name}}" name="name" class="form-control form-control-solid" />
                                        </div>
                                        <div class="form-group">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Account Name:</span>
                                                <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" value="{{old('account_name')?old('account_name'):$bank->account_name}}" name="account_name" class="form-control form-control-solid" />
                                        </div>
                                        <div class="form-group">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Account No:</span>
                                                <i class="fa fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter bank name"></i>
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" value="{{old('account_no')?old('account_no'):$bank->account_no}}" name="account_no" class="form-control form-control-solid" />
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                
                                <!--begin::Actions-->
                                <div class="text-end">
                                    <button type="reset" class="btn btn-light me-3" onclick="window.close()">Cancel</button>
                                    <button type="submit" class="btn btn-primary changeStatus">
                                        <span class="indicator-label">Update</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end:Form-->
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
    <script>
        window.addEventListener("DOMContentLoaded",function(){
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
        })
    </script>
@endsection
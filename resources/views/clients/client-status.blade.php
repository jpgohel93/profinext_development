@extends('layout')
@section("page-title","Clients Demat Status - Finance Management")
@section("clientsData.clients.dematStatus","active")
@section("client_management.accordion","hover show")
@section("content")
    <link href="{{asset("assets/css/custom.css")}}" rel="stylesheet">
	<style>
	.select2-container {
		z-index: 9 !important;
	}
	</style>
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
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Client Demat</h1>
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
                                    <li class="breadcrumb-item text-dark">Client Demat</li>
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
                                <!--begin::Card header-->
                                <div class="card-header border-0 pt-6">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <!--begin::Search-->
                                        <div class="d-flex align-items-center position-relative my-1">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
												</svg>
											</span>
                                            <!--end::Svg Icon-->
                                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
                                        </div>
                                        <!--end::Search-->
                                    </div>
                                    <!--begin::Card title-->
                                    <!--begin::Card toolbar-->

                                    <div class="card-toolbar">
                                        {{-- <!--begin::Toolbar-->
                                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                            <div class="d-flex justify-content-between">

												<select class="form-select form-select-solid" id='freelancer_type' data-control="select2" data-hide-search="true" data-placeholder="Select Freelancer" style="margin-left: 10px;">
													<option value="">Select freelancer</option>
													@forelse ($freelancerAms as $freelancer)
														<option value="{{$freelancer->id}}" @if($filter_type == 'freelancer' && $filter_id == $freelancer->id) selected @endif >{{$freelancer->name}}</option>
													@empty
													@endforelse

													@forelse ($freelancerPrime as $freelancer)
														<option value="{{$freelancer->id}}" @if($filter_type == 'freelancer' && $filter_id == $freelancer->id) selected @endif >{{$freelancer->name}}</option>
													@empty
													@endforelse
												</select>

												<select class="form-select form-select-solid" id='trader_id' data-control="select2" data-hide-search="true" data-placeholder="Select Trader">
													<option value="">Select Trader</option>
													@forelse ($traders as $trader)
														<option value="{{$trader->id}}" @if($filter_type == 'trader' && $filter_id == $dematAccount[0]->id) selected @endif >{{$trader->name}} - {{$trader->count->count()}} &nbsp; Client</option>
													@empty
													@endforelse
												</select>

                                                <!--begin::Export-->
                                                <a href="javascript:;" class="btn btn-light-primary clear_filter" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" style="width: 300px; margin-left: 10px;">
                                                    <!--end::Svg Icon-->Clear Filter
                                                </a>
                                            </div>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold w-175px py-4" data-kt-menu="true">
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">
														<span class="menu-icon">
															<i class="la la-file-pdf-o"></i>
														</span>PDF
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">
														<span class="menu-icon">
															<i class="la la-file-excel-o"></i>
														</span>Excel
                                                    </a>
                                                </div>
                                            </div>
                                            <!--end::Export-->
                                        </div>
                                        <!--end::Toolbar--> --}}
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                            <!--begin::Table head-->
                                            <thead>
                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="min-w-10px">Sr No.</th>
                                                <th class="min-w-10px">Serial Number</th>
                                                <th class="min-w-75px">Client name</th>
                                                <th class="min-w-75px">Holder Name</th>
                                                <th class="min-w-75px">Service Type</th>
                                                <th class="min-w-75px">Broker</th>
                                                <th class="text-end min-w-100px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold">
                                            @can("client-demat-read")
                                                @forelse ($dematAccount as $account)
                                                    <tr>
                                                        <td>{{sprintf("%04d",$account->id)}}</td>
                                                        <td> {{$account->st_sg."-".$account->serial_number}} </td>
                                                        <td> {{$account->withClient->name}}</td>
                                                        <td> {{$account->holder_name}}</td>
                                                        <td>
                                                            @if($account->service_type == 1)
                                                                Prime
                                                            @elseif($account->service_type == 2)
                                                                AMS
                                                            @endif
                                                        </td>
                                                        <td> {{$account->broker}}</td>
                                                        <td class="text-end">
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-eye fa-2x {{$account->mark_as_problem!=null?"viewProblem":($account->account_status=="terminated"?"terminatedAccount":($account->account_status=="problem"?"issueWithAccount":"unknown"))}}" data-id="{{$account->id}}"></i>
                                                            </a>
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-redo-alt fa-2x backToNormal" data-id="{{$account->id}}" data-toggle="tooltip" title="Restore account"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">No Demat Account  Found</td>
                                                    </tr>
                                                @endforelse
                                            @else
                                                <h1>Unauthorised</h1>
                                            @endcan
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
                            <h3 class="mb-3">Account has following Problems</h3>
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
                        <h5 class="alert alert-danger" id="modelError">{{$errors->first()}}</h5>
                    @endif
                    <!--begin:Form-->
                    <form id="mark_as_problem_form" method="POST" action="{{route('update_mark_as_problem')}}" class="form">
                        @csrf
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <div id="editIdContainer"></div>
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Problems:</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Problems marked by Accountant"></i>
                                </label>
                                <!--end::Label-->
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" id="paymentPending">
                                    <label class="custom-control-label" for="paymentPending">Payment Pending</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" id="SegmentNotActive">
                                    <label class="custom-control-label" for="SegmentNotActive">Segment Not Active</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" id="PANCardPending">
                                    <label class="custom-control-label" for="PANCardPending">PAN Card Pending</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" id="WrongInformation">
                                    <label class="custom-control-label" for="WrongInformation">Wrong Information</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" id="Other">
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
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(document).on("click",'.viewProblem',function(e){
                $("#mark_as_problem_form")[0].reset();
                const id = e.target.getAttribute("data-id");
                const name = e.target.getAttribute("data-name");
                const holderName = e.target.getAttribute("data-holder");

                if(id){
                    $.ajax("{{route('viewDematProblem')}}",{
                        type:"POST",
                        data:{
                            id:id
                        }
                    })
                    .done(data=>{
                        console.log(data);
                        if(data?.paymentPending){
                            $("#paymentPending").prop("checked",true);
                        }
                        if(data?.PANCardPending){
                            $("#PANCardPending").prop("checked",true);
                        }
                        if(data?.WrongInformationText){
                            $("#WrongInformation").prop("checked",true);
                            $("#WrongInformationTextDiv").show();
                            $("#WrongInformationText").val(data.WrongInformationText)
                        }else{
                            $("#WrongInformationTextDiv").hide();
                        }
                        if(data?.OtherText){
                            $("#Other").prop("checked",true);
                            $("#OtherTextDiv").show();
                            $("#OtherText").val(data.OtherText)
                        }else{
                            $("#OtherTextDiv").hide();
                        }
                        $("#editIdContainer").html(`<input type="hidden" name="demat_id" value="${id}">`);
                        $("#mark_as_problem_modal").modal("show");
                    })
                }else{
                    window.alert("Unable to Load this Client");
                }
                $("#WrongInformation").on("click",function(e){
                    if($(this).is(":checked")){
                        $("#WrongInformationTextDiv").show();
                    }else{
                        $("#WrongInformationTextDiv").hide();
                    }
                })
                $("#WrongInformationTextDiv").hide();
                $("#Other").on("click",function(e){
                    if($(this).is(":checked")){
                        $("#OtherTextDiv").show();
                    }else{
                        $("#OtherTextDiv").hide();
                    }
                })
                $("#OtherTextDiv").hide();
            });
            $(document).on("click",".terminatedAccount",function(){
                window.alert("this account has been terminated by accountant");
            })
            $(document).on("click",".issueWithAccount",function(e){
                const id = e.target.getAttribute("data-id");
                if(id){
                    $.ajax("{{route('issueWithDematAccount')}}",{
                        type:"POST",
                        data:{
                            id:id
                        }
                    })
                    .done(data=>{
                        $("#demateAccountProblemForm #editIdContainer").html(`<input type="hidden" name="demat_id" value="${id}">`);
                        if(data?.problem){
                            $("#problemText").val(data?.problem);
                            $("#demateAccountProblemModal").modal("show");
                        }else{
                            window.alert("Account status is unknown");
                        }
                    })
                    .fail((err,code,xhr)=>{
                        window.alert("Unknown error occured while loading this account");
                    })
                }else{
                    window.alert("Unable to Load this Client");
                }
            })
            $(document).on("click",".backToNormal",function(e){
                const id = e.target.getAttribute("data-id");
                if(id){
                    if(window.confirm("Are  you sure you want to restore this account?")){
                        $.ajax("{!! route('dematAccountRestore') !!}",{
                            type:"POST",
                            data: {
                                id:id
                            }
                        })
                        .done(data=>{
                            window.location.reload();
                        })
                        .fail((err,code,xhr)=>{
                            window.alert("Unknown error occured")
                        })
                    }
                }else{
                    window.alert("Unable to Load this Client");
                }
            })
        })
    </script>
@endsection

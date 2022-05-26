@extends('layout')
@section("page-title","Headings - Accounting - Finance Management")
@section("finance_management.accounting","active")
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
                                    <li class="breadcrumb-item text-dark">Headings</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <div class="d-flex align-items-center py-1">
								<a href="javascript:void(0);" class="btn btn-sm btn-primary" id="addSubHeading">
									<span class="svg-icon svg-icon-2">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
											<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
										</svg>
									</span>Add
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
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin:::Tabs-->
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1 active" data-bs-toggle="tab" href="#income">Income</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" href="#expenses">Expenses</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" href="#transfer">Transfer</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" href="#loan">Loan</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab" href="#deactivated">Deactivate</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->
                            <!--end:::Tabs-->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="income" aria-labelledby="active-tab"
                                     role="tabpanel">
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
                                                            <th class="min-w-75px">Sub Heading</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="incomeTable">
                                                        @forelse($headings['income'] as $income)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$income->sub_heading}}</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-edit fa-xl editHeading" title="Edit this Sub heading" data-id="{{$income->id}}"></i>
                                                                    </a>
                                                                    @if($income->is_active==1)
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-unlock fa-xl" data-id="{{$income->id}}"bs-toggle="tooltip" title="This is label is Activated"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-lock fa-xl" data-id="{{$income->id}}"bs-toggle="tooltip" title="This is label is Deactivated"></i>
                                                                        </a>
                                                                    @endif
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
                                <div class="tab-pane fade show" id="expenses" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">Sub Heading</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="expenseTable">
                                                        @forelse($headings['expenses'] as $expense)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$expense->sub_heading}}</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-edit fa-xl editHeading" data-id="{{$expense->id}}" title="Edit this Sub heading"></i>
                                                                    </a>
                                                                    @if($expense->is_active==1)
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-unlock fa-xl" data-id="{{$expense->id}}" title="This is label is Activated"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-lock fa-xl" data-id="{{$expense->id}}" title="This is label is Deactivated"></i>
                                                                        </a>
                                                                    @endif
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
                                <div class="tab-pane fade show" id="transfer" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">Sub Heading</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="transferTable">
                                                        @forelse($headings['transfer'] as $transfer)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$transfer->sub_heading}}</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-edit fa-xl editHeading" data-id="{{$transfer->id}}" title="Edit this Sub heading"></i>
                                                                    </a>
                                                                    @if($transfer->is_active==1)
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-unlock fa-xl" data-id="{{$transfer->id}}" title="This is label is Activated"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-lock fa-xl" data-id="{{$transfer->id}}" title="This is label is Deactivated"></i>
                                                                        </a>
                                                                    @endif
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
                                <div class="tab-pane fade show" id="loan" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">Sub Heading</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="loanTable">
                                                        @forelse($headings['loan'] as $loan)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$loan->sub_heading}}</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-edit fa-xl editHeading" data-id="{{$loan->id}}" title="Edit this Sub heading"></i>
                                                                    </a>
                                                                    @if($loan->is_active==1)
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-unlock fa-xl" data-id="{{$loan->id}}" title="This is label is Activated"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-lock fa-xl" data-id="{{$loan->id}}" title="This is label is Deactivated"></i>
                                                                        </a>
                                                                    @endif
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
                                <div class="tab-pane fade show" id="deactivated" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-10px">Heading</th>
                                                            <th class="min-w-75px">Sub Heading</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="deactivatedTable">
                                                        @forelse($headings['deactivated'] as $deactivated)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{ucwords($deactivated->label_type)}}</td>
                                                                <td>{{$deactivated->sub_heading}}</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-edit fa-xl editHeading" data-id="{{$deactivated->id}}" title="Edit this Sub heading"></i>
                                                                    </a>
                                                                    @if($deactivated->is_active==1)
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-unlock fa-xl" data-id="{{$deactivated->id}}" title="This is label is Activated"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="javascript:void(0)">
                                                                            <i class="fas fa-lock fa-xl" data-id="{{$deactivated->id}}" title="This is label is Deactivated"></i>
                                                                        </a>
                                                                    @endif
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
    <div class="modal fade" id="addIncomeHeadingModal" tabindex="-1" aria-hidden="true">
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
                        <h3 class="mb-3">Add sub heading</h3>
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
                    <form method="POST" action="{{route('financeManagementAddHeadings')}}" class="form">
                        @csrf
                        <div id="editIdContainer"></div>
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Label type:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select type of sub heading"></i>
                                    </label>
                                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select Type" name="label_type">
                                        <option value=""></option>
                                        <option value="income" {{old('label_type') && old("label_type")=="income"?"selected":""}}>Income</option>
                                        <option value="expense" {{old('label_type') && old("label_type")=="expense"?"selected":""}}>Expense</option>
                                        <option value="transfer" {{old('label_type') && old("label_type")=="transfer"?"selected":""}}>Transfer</option>
                                        <option value="loan" {{old('label_type') && old("label_type")=="loan"?"selected":""}}>Loan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Sub heading:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter sub heading here"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('sub_heading')}}" name="sub_heading" class="form-control form-control-solid input-sm"/>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-end">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
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
    <div class="modal fade" id="editIncomeHeadingModal" tabindex="-1" aria-hidden="true">
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
                        <h3 class="mb-3">Edit sub heading</h3>
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
                    <form method="POST" action="{{route('financeManagementEditHeadings')}}" class="form">
                        @csrf
                        <div id="editHeadingIdContainer"></div>
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Label type:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select type of sub heading"></i>
                                    </label>
                                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select Type" id="editLabelType" name="label_type">
                                        <option value=""></option>
                                        <option value="income" {{old('label_type') && old("label_type")=="income"?"selected":""}}>Income</option>
                                        <option value="expense" {{old('label_type') && old("label_type")=="expense"?"selected":""}}>Expense</option>
                                        <option value="transfer" {{old('label_type') && old("label_type")=="transfer"?"selected":""}}>Transfer</option>
                                        <option value="loan" {{old('label_type') && old("label_type")=="loan"?"selected":""}}>Loan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Sub heading:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter sub heading here"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('sub_heading')}}" id="editSubHeading" name="sub_heading" class="form-control form-control-solid input-sm"/>
                                </div>
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
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $("select").select2();
                $(".datatable").DataTable();
                $("#addSubHeading").on("click",function(){
                    $("#addIncomeHeadingModal").modal("show");
                });
                const toggelActivateDeactivateHeadings = (status,id)=>{
                    $.ajax("{{route('activateDeactivateHeadingFinanceManagementAccounting')}}",{
                        type:"POST",
                        data:{
                            id:id,
                            status:status
                        }
                    })
                    .fail((err,code,xhr)=>{
                        $("#kt_toolbar").before(`<div class="container"><h5 class="alert alert-info">Unable to update status</h5></div>`);
                    })
                    .done(data=>{
                        window.location.reload();
                        $("#kt_toolbar").before(`<div class="container"><h5 class="alert alert-info">${data['info']}</h5></div>`);
                    })
                }
                $(document).on("click",".fa-unlock",function(){
                    const id = $(this).data("id");
                    if(id){
                        toggelActivateDeactivateHeadings("0",id);
                    }else{
                        window.alert("Unable to get bank status");
                    }
                })
                $(document).on("click",".fa-lock",function(){
                    const id = $(this).data("id");
                    if(id){
                        toggelActivateDeactivateHeadings("1",id);
                    }else{
                        window.alert("Unable to get bank status");
                    }
                })
                $(document).on("click",".editHeading",function(){
                    const id = $(this).data("id");
                    if(id){
                        $.ajax("{{route('financeManagementGetHeadings')}}",{
                            type:"POST",
                            data:{
                                id:id,
                            }
                        })
                        .fail((err,code,xhr)=>{
                            $("#kt_toolbar").before(`<div class="container"><h5 class="alert alert-info">Unable to get Heading</h5></div>`);
                        })
                        .done(data=>{
                            $("#editHeadingIdContainer").html(`<input type="hidden" name="id" value="${data.id}">`);
                            $("#editLabelType").val(data.label_type).change();
                            $("#editSubHeading").val(data.sub_heading);
                            $("#editIncomeHeadingModal").modal("show");
                        })
                    }else{
                        window.alert("Unable to get heading");
                    }
                })
            },jQuery)
        })
    </script>
@endsection

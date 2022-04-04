@extends('layout')
@section("page-title","Setup - Trade Management")
@section("setup","active")
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
								<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Setup</h1>
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
									<li class="breadcrumb-item text-dark">Setup</li>
									<!--end::Item-->
								</ul>
								<!--end::Breadcrumb-->
							</div>
							<!--end::Page title-->
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
                                       href="#makeAsPreferredAccounr">Make As Preferred Account</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#normalAccount">Normal Account</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#holding">Holding</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#trader">Trader</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#freelancer">Freelancer</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#all">All</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#unallotted">Unallotted</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="makeAsPreferredAccounr" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="preferred_table">
                                                    <!--begin::Table head-->
                                                        <thead>
															<tr
																class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
																<th class="min-w-10px">Sr No.</th>
																<th class="min-w-10px">Serial Number</th>
																<th class="min-w-75px">Holder Name</th>
																<th class="min-w-75px">Available Fund</th>
																<th class="min-w-75px">Profit / Loss</th>
																<th class="min-w-75px">Day of Joining</th>
																<th class="min-w-75px">Action</th>
															</tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">

                                                        </tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                               
								<div class="tab-pane fade show" id="normalAccount" aria-labelledby="active-tab" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header border-0 pt-6">
                                            <div class="card-title">
                                                <div class="d-flex align-items-center position-relative my-1">
													<label>Filter&nbsp;:&nbsp;</label>&nbsp;
                                                    <select class="form-select form-select-solid" id="service_type" data-control="select2" data-hide-search="true">
														<option value="">Select Service Type</option>
														<option value="1">PRIME</option>
														<option value="2">AMS</option>
													</select>
                                                </div>
                                            </div>
                                            <div class="card-toolbar">
                                                
                                            </div>
                                        </div>
										
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="normal_acc_table">
													<thead>
													<tr
														class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
														<th class="min-w-10px">Sr No.</th>
														<th class="min-w-10px">Serial Number</th>
														<th class="min-w-75px">Holder Name</th>
														<th class="min-w-75px">Available Fund</th>
														<th class="min-w-75px">Profit / Loss</th>
														<th class="min-w-75px">Day of Joining</th>
														<th class="min-w-75px">Action</th>
													</tr>
													</thead>
													<tbody class="text-gray-600 fw-bold" id="activeCallTable">
													
													</tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                
								<div class="tab-pane fade show" id="holding" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                           
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="holding_table">
													<thead>
														<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
															<th class="min-w-10px">Sr No.</th>
															<th class="min-w-10px">Serial Number</th>
															<th class="min-w-75px">Holder Name</th>
															<th class="min-w-75px">Positions</th>
															<th class="min-w-75px">Available Fund</th>
															<th class="min-w-75px">Profit / Loss</th>
															<th class="min-w-75px">Day of Joining</th>
															<th class="min-w-75px">Action</th>
														</tr>
													</thead>
													<tbody class="text-gray-600 fw-bold" id="activeCallTable">
													
													</tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                
								<div class="tab-pane fade show" id="all" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            <div class="card-title">
                                                <div class="d-flex align-items-center position-relative my-1">
													<label>Filter&nbsp;:&nbsp;</label>&nbsp;
                                                    <select class="form-select form-select-solid" id="allotment_type" data-control="select2" data-hide-search="true">
														<option value="">Select Allotment Type</option>
														<option value="1">Trader</option>
														<option value="2">Freelancer</option>
													</select>
                                                </div>
                                            </div>
                                            <div class="card-toolbar">
                                                
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="all_table">
													<thead>
														<tr
															class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
															<th class="min-w-10px">Sr No.</th>
															<th class="min-w-10px">Serial Number</th>
															<th class="min-w-75px">Holder Name</th>
															<th class="min-w-75px">Available Fund</th>
															<th class="min-w-75px">Profit / Loss</th>
															<th class="min-w-75px">Service Type </th>
															<th class="min-w-75px">Action</th>
														</tr>
													</thead>
													<tbody class="text-gray-600 fw-bold" id="activeCallTable">
													
													</tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                               
								<div class="tab-pane fade show" id="trader" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
                                            
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="trader_table">
													<thead>
														<tr
															class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
															<th class="min-w-10px">Sr No.</th>
															<th class="min-w-10px">Serial Number</th>
															<th class="min-w-75px">Holder Name</th>
															<th class="min-w-75px">Trader Name</th>
															<th class="min-w-75px">Available Fund</th>
															<th class="min-w-75px">Profit / Loss</th>
															<th class="min-w-75px">Day of Joining</th>
															<th class="min-w-75px">Action</th>
														</tr>
													</thead>
													<tbody class="text-gray-600 fw-bold" id="activeCallTable">
													
													</tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                
								<div class="tab-pane fade show" id="freelancer" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
										
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="freelancer_table">
													<thead>
														<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
															<th class="min-w-10px">Sr No.</th>
															<th class="min-w-10px">Serial Number</th>
															<th class="min-w-75px">Holder Name</th>
															<th class="min-w-75px">Freelancer Name</th>
															<th class="min-w-75px">Available Fund</th>
															<th class="min-w-75px">Profit / Loss</th>
															<th class="min-w-75px">Day of Joining</th>
															<th class="min-w-75px">Action</th>
														</tr>
													</thead>
													<tbody class="text-gray-600 fw-bold" id="activeCallTable">
													
													</tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                
								<div class="tab-pane fade show" id="unallotted" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 pt-6">
										
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="unallotted_table">
													<thead>
														<tr
															class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
															<th class="min-w-10px">Sr No.</th>
															<th class="min-w-10px">Serial Number</th>
															<th class="min-w-75px">Holder Name</th>
															<th class="min-w-75px">Capital</th>
															<th class="min-w-75px">Date of Joining</th>
															<th class="min-w-75px">Action</th>
														</tr>
													</thead>
													<tbody class="text-gray-600 fw-bold" id="activeCallTable">
													
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

	<div class="modal fade" id="assignTraderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('assignTraderToDemat')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Assign Client Demat to Trader</h2>
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
                                <input class="form-control" type="text" id="assignName" readonly/>
                                <input class="form-control" type="hidden" value="" name='client_id' id="assignId" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Account Holder Name</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="holderName" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-3 col-form-label">Trader</label>
                            <div class="col-9">
                                <select class="form-select form-select-solid" name='trader_id' data-control="select2" data-hide-search="true" data-placeholder="Select Trader">
                                    @forelse ($traders as $trader)
                                        <option value="{{$trader->id}}">{{$trader->name}} - {{$trader->count->count()}} &nbsp; Client</option>
                                    @empty
                                        <option>Select Trader</option>
                                    @endforelse
                                </select>
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

    <!-- Modal -->
    <div class="modal fade" id="assignFreelancerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('assignClientToFreelancer')}}">
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
                                <input class="form-control" type="text" id="freelancer_client_Name" readonly/>
                                <input class="form-control" type="hidden" value="" name='client_demate_id' id="assignFreelancerId" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Account Holder Name</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="freelancer_holder_name" readonly/>
                            </div>
                        </div>
                        <div class="form-group row" id="ams_freelancer">
                            <label for="example-email-input" class="col-3 col-form-label"> AMS freelancer</label>
                            <div class="col-9">
                                <select class="form-select form-select-solid" name='freelancer_id' data-control="select2" data-hide-search="true" data-placeholder="Select AMS freelancer">
                                    <option></option>
                                    @forelse ($freelancerAms as $freelancer)
                                        <option value="{{$freelancer->id}}">{{$freelancer->name}}</option>
                                    @empty
                                        <option>Select AMS freelancer</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" id="prime_freelancer">
                            <label for="example-email-input" class="col-3 col-form-label"> Prime freelancer</label>
                            <div class="col-9">
                                <select class="form-select form-select-solid" name='ams_freelancer_id' data-control="select2" data-hide-search="true" data-placeholder="Select Prime freelancer">
                                    <option></option>
                                    @forelse ($freelancerPrime as $freelancer)
                                        <option value="{{$freelancer->id}}">{{$freelancer->name}}</option>
                                    @empty
                                        <option>Select Prime freelancer</option>
                                    @endforelse
                                </select>
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
    <!--end::Modals-->

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
                        <table class="table align-middle table-row-dashed fs-6 gy-5"
                               id="kt_table_users">
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

            $(document).on("click",'.assignFreelancer',function(e){
                const id = e.target.getAttribute("data-id");
                const name = e.target.getAttribute("data-name");
                const holderName = e.target.getAttribute("data-holder");
                const service = e.target.getAttribute("data-service");
                if(id){
                    $("#assignFreelancerId").val(id);
                    $("#freelancer_client_Name").val(name);
                    $("#freelancer_holder_name").val(holderName);
                    $("#prime_freelancer").hide();
                    $("#ams_freelancer").hide();
                    if(service == 1){
                        $("#prime_freelancer").show();
                        $("#ams_freelancer").hide();
                    }else if(service == 2){
                        $("#ams_freelancer").show();
                        $("#prime_freelancer").hide();
                    }
                    $("#assignFreelancerModal").modal("show");
                }else{
                    window.alert("Unable to Load this Client");
                }
            });

			$(document).on("click",'.assignTrader',function(e){
                const id = e.target.getAttribute("data-id");
                const name = e.target.getAttribute("data-clname");
                const holderName = e.target.getAttribute("data-name");
                if(id){
                    $("#assignId").val(id);
                    $("#assignName").val(name);
                    $("#holderName").val(holderName);
                    $("#assignTraderModal").modal("show");
                }else{
                    window.alert("Unable to Load this Client");
                }
            });

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

            $(document).on("click",'.makeAsPreferred',function(e){
                var id=e.target.getAttribute("data-id");
                var value=e.target.getAttribute("data-value");
                $.ajax("{!! route('makeAsPreferred') !!}",{
                    type:"POST",
                    data:{
                        id:id,
                        is_make_as_preferred: value
                    },
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    success: function(response) {
                        window.location.href = "setup";
                    }
                });
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
            $.ajax("/loginInfo/" + id, {
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $("input[name='_token']").val()
                }
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

@section('jscript')
	<script>
        window.addEventListener("DOMContentLoaded",function(){
            $(function() {
                analyst_table = $('#preferred_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ordering": true,
                    "info":     false,
                    ajax: {
                        type: "POST",
                        url : "{{ route('getPreferredAccountData') }}",
                        data: {_token : "{{csrf_token()}}"}
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'serial_number'},
                        {data: 'holder_name'},
                        {data: 'available_balance'},
                        {data: 'pl'},
                        {data: 'days'},
                        {data: 'action'},
                    ],
                    "drawCallback": function(settings) {
                        KTMenu.createInstances();
                    }
                });
                
                normal_acc_table = $('#normal_acc_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ordering": true,
                    "info":     false,
                    ajax: {
                        type: "POST",
                        url : "{{ route('getNormalAccountData') }}",
                        data: function(d){
                            var service_type = $('#service_type').val();
                            return $.extend( {}, d, {
                                _token : "{{csrf_token()}}",
                                service_type : service_type
                            });
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'serial_number'},
                        {data: 'holder_name'},
                        {data: 'available_balance'},
                        {data: 'pl'},
                        {data: 'days'},
                        {data: 'action'},
                    ],
                    "drawCallback": function(settings) {
                        KTMenu.createInstances();
                    }
                });
                
                holding_table = $('#holding_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ordering": true,
                    "info":     false,
                    ajax: {
                        type: "POST",
                        url : "{{ route('getHoldingData') }}",
                        data: {_token : "{{csrf_token()}}"}
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'serial_number'},
                        {data: 'holder_name'},
                        {data: 'no_of_holding'},
                        {data: 'available_balance'},
                        {data: 'pl'},
                        {data: 'days'},
                        {data: 'action'},
                    ],
                    "drawCallback": function(settings) {
                        KTMenu.createInstances();
                    }
                });
                
                all_table = $('#all_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ordering": true,
                    "info":     false,
                    ajax: {
                        type: "POST",
                        url : "{{ route('getAllAcountData') }}",
                        data: function(d){
                            var allotment_type = $('#allotment_type').val();
                            return $.extend( {}, d, {
                                _token : "{{csrf_token()}}",
                                allotment_type : allotment_type
                            });
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'serial_number'},
                        {data: 'holder_name'},
                        {data: 'available_balance'},
                        {data: 'pl'},
                        {data: 'serviceType'},
                        {data: 'action'},
                    ],
                    "drawCallback": function(settings) {
                        KTMenu.createInstances();
                    }
                });
                
                trader_table = $('#trader_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ordering": true,
                    "info":     false,
                    ajax: {
                        type: "POST",
                        url : "{{ route('getTraderAcountData') }}",
                        data: {_token : "{{csrf_token()}}"}
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'serial_number'},
                        {data: 'holder_name'},
                        {data: 'trader_name'},
                        {data: 'available_balance'},
                        {data: 'pl'},
                        {data: 'days'},
                        {data: 'action'},
                    ],
                    "drawCallback": function(settings) {
                        KTMenu.createInstances();
                    }
                });
                
                freelancer_table = $('#freelancer_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ordering": true,
                    "info":     false,
                    ajax: {
                        type: "POST",
                        url : "{{ route('getFreelancerAccountData') }}",
                        data: {_token : "{{csrf_token()}}"}
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'serial_number'},
                        {data: 'holder_name'},
                        {data: 'freelancer_name'},
                        {data: 'available_balance'},
                        {data: 'pl'},
                        {data: 'days'},
                        {data: 'action'},
                    ],
                    "drawCallback": function(settings) {
                        KTMenu.createInstances();
                    }
                });
                
                unallotted_table = $('#unallotted_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ordering": true,
                    "info":     false,
                    ajax: {
                        type: "POST",
                        url : "{{ route('getUnallotedData') }}",
                        data: {_token : "{{csrf_token()}}"}
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'serial_number'},
                        {data: 'holder_name'},
                        {data: 'capital'},
                        {data: 'created_at'},
                        {data: 'action'},
                    ],
                    "drawCallback": function(settings) {
                        KTMenu.createInstances();
                    }
                });
                
                $(document).on('change','#service_type',function(){
                    normal_acc_table.draw();
                });
                
                $(document).on('change','#allotment_type',function(){
                    all_table.draw();
                });
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
        })
	</script>
@endsection

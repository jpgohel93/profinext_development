@extends('layout')
@section("page-title","Monitor - Analyst Management")
@section("analysis.monitor","active")
@section("analyst_management.accordion","hover show")

@section("content")
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<style>
	#active_call_table, #close_call_table {
		width: 100% !important;
	}
	</style>

	<div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
        @include("sidebar")
        <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            @include("header")
			@can("monitor-read")
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @if(session("info"))
                        <div class="container">
                            <h6 class="alert alert-info">{{session("info")}}</h6>
                        </div>
                    @elseif($errors->any())
                        <div class="container">
                            <h6 class="alert alert-danger">{{$errors->first()}}</h6>
                        </div>
                    @endif
                	<!--begin::Toolbar-->
                    <div class="toolbar" id="kt_toolbar">
                        <!--begin::Container-->
                        <div id="kt_toolbar_container" class="container-fluid mx-7 d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Monitor</h1>
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
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Post-->

                    <div class="post d-flex flex-column-fluid" id="kt_post">
                            <!--begin::Container-->
                            <div id="kt_content_container" class="container-xxl">

                                <!--begin:::Tabs-->
                                <ul class="mx-9 nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">

                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1 active" data-bs-toggle="tab"
                                           href="#analystTab">Analyst</a>
                                    </li>
                                    <!--end:::Tab item-->

                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                           href="#activeTab">Active Call</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                           href="#closedTab">Closed Call</a>
                                    </li>
                                    <!--end:::Tab item-->
                                </ul>
                                <!--end:::Tabs-->

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="analystTab" aria-labelledby="active-tab"
                                         role="tabpanel">
                                        <!--begin::Card-->
                                        <div class="card">
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="analyst_table">
														<thead>
															<tr
																class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
																<th class="min-w-10px">Sr No.</th>
																<th class="min-w-75px">Analyst</th>
																<th class="min-w-75px">Status</th>
																<th class="min-w-75px">No. of Calls Open</th>
																<th class="min-w-75px">No. of Calls Close</th>
																<th class="min-w-100px text-center">Add Call</th>
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
                                    <div class="tab-pane fade show" id="activeTab" aria-labelledby="active-tab" role="tabpanel">
                                        <!--begin::Card-->
                                        <div class="card">
                                            <!--begin::Card header-->
                                            <div class="card-header border-0">
                                                <!--begin::Card title-->
                                                <div class="card-title">
                                                    <!--begin::Search-->
                                                    <div class="d-flex align-items-center position-relative my-1">
														<label>Select Date:</label>
                                                        <input type="text" id="active_datefilter" value="<?php echo date("d/m/Y", strtotime("-30 days"))."-".date("d/m/Y");?>" class="form-control form-control-solid w-250px ps-14" />
                                                    </div>
                                                    <!--end::Search-->
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="active_call_table">
														<thead>
															<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
																<th class="min-w-10px">Sr No.</th>
																<th class="min-w-75px">Date</th>
																<th class="min-w-75px">Script Name</th>
																<th class="min-w-75px">Entry Price</th>
																<th class="min-w-75px">Target</th>
																<th class="min-w-75px">Actions</th>
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
                                    <div class="tab-pane fade" id="closedTab" aria-labelledby="closed-tab" role="tabpanel">
                                        <!--begin::Card-->
                                        <div class="card">
                                            <!--begin::Card header-->
                                            <div class="card-header border-0">
                                                <!--begin::Card title-->
                                                <div class="card-title">
                                                    <!--begin::Search-->
                                                    <div class="d-flex align-items-center position-relative my-1">
														<label>Select Date:</label>
                                                        <input type="text" id="close_datefilter" value="<?php echo date("d/m/Y", strtotime("-30 days"))."-".date("d/m/Y");?>" class="form-control form-control-solid w-250px ps-14" />
                                                    </div>
                                                    <!--end::Search-->
                                                </div>
                                                <!--begin::Card title-->
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="close_call_table">
														<thead>
														<tr
															class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
															<th class="min-w-10px">Sr No.</th>
															<th class="min-w-75px">Script Name</th>
															<th class="min-w-75px">P / L</th>
															<th class="min-w-75px">Status</th>
															<th class="min-w-75px">Action</th>
														</tr>
														</thead>
														<tbody class="text-gray-600 fw-bold" id="closedCallTable">

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
			@endcan
            @include("footer")
            </div>
        </div>
    </div>

	<div class="modal fade" id="editCallMdl" tabindex="-1" aria-hidden="true" data-backdrop="true">
		<div class="modal-dialog modal-lg" role="document">

		</div>
	</div>

	<div class="modal fade" id="addCallMdl" tabindex="-1" aria-hidden="true" data-backdrop="true">
		<div class="modal-dialog modal-lg" role="document">
			<form id="addCallFrm" class="form" method="POST" action="{{route('createMonitorData')}}">
				@csrf
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="fw-bolder">Add Call</h2>
						<button type="button" class="btn btn-icon btn-sm btn-active-icon-primary close" data-bs-dismiss="modal" aria-label="Close">
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
								</svg>
							</span>
						</button>
					</div>

					<div class="modal-body mx-md-10">
						<input type="hidden" name="analysts_id" id="analysts_id" value="">
						<div class="row mb-12">
                            <div class="col-md-6">
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Date : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
								<input type="text" value="{{date("Y-m-d",strtotime("now"))}}" class="form-control form-control-lg form-control-solid bdr-ccc" name="date" placeholder="" value="{{date('d-m-Y')}}" />
                            </div>

                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Analyst</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
                                <p class="form-control form-control-lg form-control-solid bdr-ccc" id="analyst_name"></p>
                            </div>
                        </div>

						<div class="row mb-12">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Script Name : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>

                                <input type="type" class="form-control form-control-lg form-control-solid bdr-ccc" id="script_name"  name="script_name" list="listValue"/>
                                <datalist id="listValue">
                                    @if(!empty($keywords))
                                        @foreach($keywords as $keyword)
                                            <option value="{{$keyword->name}}">{{$keyword->name}}</option>
                                        @endforeach
                                    @endif
                                </datalist>
                            </div>
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Buy / Sell : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
								<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="buy_sell" id="buy_sell" placeholder="Buy / Sell" value="{{old('buy_sell')}}" />
                            </div>
                            <!--end::Col-->
                        </div>

						<div class="row mb-12">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Entry Price : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="entry_price" placeholder="Entry Price" value="{{old('entry_price')}}" />
                            </div>
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Entry Time : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
								<select name="entry_time" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Entry time">
									<option value="yes" {{old('entry_time')=="yes"?"selected":""}}>Yes</option>
									<option value="no" {{old('entry_time')=="no"?"selected":""}}>No</option>
								</select>
                            </div>
                            <!--end::Col-->
                        </div>

						<div class="row mb-12">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="">sl : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="sl" placeholder="Enter SL" value="{{old('sl')}}" />
                            </div>
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="">Target : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
                                </label>
								<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="target" placeholder="Enter Target" value="{{(old('target'))?old('target'):""}}" />
                            </div>
                            <!--end::Col-->
                        </div>

					</div>

					<div class="modal-footer text-center">
						<p id="err_msg"></p>
						<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
							<span class="indicator-label">Cancel</span>
						</button>
						<button type="submit" id="submitCall" class="btn btn-primary">
							<span class="indicator-label">Save</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="modal fade" id="closeCallMdl" tabindex="-1" aria-hidden="true" data-backdrop="true">
		<div class="modal-dialog modal-lg" role="document">
			<form id="closeCallFrm" class="form" method="POST" action="{{route('closeMonitorData')}}">
				@csrf
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="fw-bolder">Close Call</h2>
						<button type="button" class="btn btn-icon btn-sm btn-active-icon-primary close" data-bs-dismiss="modal" aria-label="Close">
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
								</svg>
							</span>
						</button>
					</div>

					<div class="modal-body mx-md-10">
						<input type="hidden" name="call_id" id="call_id" value="">
						<input type="hidden" name="status" value="close">
                        <div class="row mb-12">
                            <div class="col-md-6">
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Date : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7"></i>
                                </label>
                                <input type="text" value="{{date("Y-m-d",time())}}" class="form-control form-control-lg form-control-solid bdr-ccc" name="exit_date" placeholder="" value="{{old('exit_date')?old('exit_date'):date('d-m-Y')}}" />
                            </div>
                        </div>

						<div class="row mb-12">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Exit Price : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7"></i>
                                </label>
                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="exit_price" id="exit_price" placeholder="Exit Price" value="{{old('exit_price')}}" />
                            </div>
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Exit Time : </span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7"></i>
                                </label>
								<select name="exit_time" class="form-select form-select-solid" id="exit_time" dat   a-control="select2" data-hide-search="true" data-placeholder="Exit time">
									<option value="yes" {{old('exit_time')=="yes"?"selected":""}}>Yes</option>
									<option value="no" {{old('exit_time')=="no"?"selected":""}}>No</option>
								</select>
                            </div>
                            <!--end::Col-->
                        </div>

					</div>

					<div class="modal-footer text-center">
						<p id="err_msg"></p>
						<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
							<span class="indicator-label">Cancel</span>
						</button>
						<button type="submit" id="closeCall" class="btn btn-primary">
							<span class="indicator-label">Save</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>

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
                        <h4>Are you sure you want to Delete this call?</h4>
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
                $("select[data-control='select2']").select2();
            },jQuery)
        })
    </script>
@endsection
@section('jscript')
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" ></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script>
	$(function() {

		analyst_table = $('#analyst_table').DataTable({
			processing: true,
			serverSide: true,
			"ordering": false,
			"info":     false,
			ajax: {
				type: "POST",
				url : "{{ route('getAnalystData') }}",
				data: {_token : "{{csrf_token()}}"}
			},
			columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'analyst', profile: 'analyst'},
				{data: 'status', name: 'status'},
				{data: 'open_call', name: 'open_call'},
				{data: 'close_call', name: 'close_call'},
				{data: 'action', name: 'action'},
			]
		});

		active_call_table = $('#active_call_table').DataTable({
			processing: true,
			serverSide: true,
			"ordering": false,
			"info":     false,
			ajax: {
				type: "POST",
				url : "{{ route('getActiveCallData') }}",
				data: function(d){
					var date = $('#active_datefilter').val();
                    return $.extend( {}, d, {
						_token : "{{csrf_token()}}",
						start_date : date
					});
				}
			},
			columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'date'},
				{data: 'script_name'},
				{data: 'entry_price'},
				{data: 'target'},
				{data: 'action', name: 'action'},
			]
		});

		close_call_table = $('#close_call_table').DataTable({
			processing: true,
			serverSide: true,
			"ordering": false,
			"info":     false,
			ajax: {
				type: "POST",
				url : "{{ route('getCloseCallData') }}",
				data: function(d){
					var date = $('#close_datefilter').val();
                    return $.extend( {}, d, {
						_token : "{{csrf_token()}}",
						start_date : date
					});
				}
			},
			columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'script_name'},
				{data: 'exit_price'},
				{data: 'sl_status'},
				{data: 'action', name: 'action'},
			],
			rowCallback: function(row, data, index){
				if(data['sl_status'] == 'Target'){
					$(row).find('td:eq(3)').css('background', '#0A8A0A').css('color', 'whitesmoke');
				} else if(data['sl_status'] == 'Access Target'){
					$(row).find('td:eq(3)').css('background', '#005800').css('color', 'whitesmoke');
				} else if(data['sl_status'] == 'Early Target'){
					$(row).find('td:eq(3)').css('background', '#3CBC3C').css('color', 'whitesmoke');
				} else if(data['sl_status'] == 'SL'){
					$(row).find('td:eq(3)').css('background', '#FF0A0A').css('color', 'whitesmoke');
				} else if(data['sl_status'] == 'Early SL'){
					$(row).find('td:eq(3)').css('background', '#FF4646').css('color', 'whitesmoke');
				} else if(data['sl_status'] == 'Trapped'){
					$(row).find('td:eq(3)').css('background', '#C30000').css('color', 'whitesmoke');
				}
			}
		});

		$('#active_datefilter, #close_datefilter').daterangepicker({
				opens: 'right',
				startDate: moment().subtract(30, 'days'),
				maxDate: moment(),
				locale: {
					format: 'DD/MM/YYYY'
				}
			}
		);

		$(document).on('change','#active_datefilter',function(){
			active_call_table.draw();
		});
		$(document).on('change','#close_datefilter',function(){
			close_call_table.draw();
		});
	});

	$("#addCallFrm").validate({
		rules: {
			script_name: "required",
			buy_sell: "required",
			entry_price: "required",
			entry_time: "required",
			// sl: "required",
			// target: "required",
		},
		submitHandler: function(form) {
			$("#submitCall").prop('disabled', true);
			var form_data = new FormData($("#addCallFrm")[0]);
			var formSubmitUrl = $("#addCallFrm").attr('action');

			$.ajax({
				type: 'POST',
				url: formSubmitUrl,
				data: form_data,
				dataType: 'json',
				processData: false,
				contentType: false,
				success: function(data) {

					if(data.success == true) {
						$("#err_msg").html(data.message).css("color", "green");

						setTimeout( function(){
							location.reload(true);
						}, 2500);
					} else {
						$("#err_msg").html("There is an error, Please correct data.").css("color", "red");
						$("#submitCall").prop('disabled', false);

						setTimeout( function(){
							$("#err_msg").html("");
						}, 2500);
						return false;
					}
				},
				error: function(data) {
					$("#err_msg").html("There is an error, Please correct data.").css("color", "red");
					$("#submitCall").prop('disabled', false);

					setTimeout( function(){
						$("#err_msg").html("");
					}, 2500);
					return false;
				}
			});
		}
	});

	 $(document).on('click',"#submitEditCall",function() {
		$("#editCallFrm").validate({
			rules: {
				analysts_id: "required",
				date: "required",
				script_name: "required",
				buy_sell: "required",
				entry_price: "required",
				entry_time: "required",
				// sl: "required",
				// target: "required",
			},
			submitHandler: function(form) {
				$("#submitEditCall").prop('disabled', true);
				var form_data = new FormData($("#editCallFrm")[0]);
				var formSubmitUrl = $("#editCallFrm").attr('action');

				$.ajax({
					type: 'POST',
					url: formSubmitUrl,
					data: form_data,
					dataType: 'json',
					processData: false,
					contentType: false,
					success: function(data) {

						if(data.success == true) {
							$("#err_msg1").html(data.message).css("color", "green");

							setTimeout( function(){
								location.reload(true);
							}, 2500);
						} else {
							$("#err_msg1").html("There is an error, Please correct data.").css("color", "red");
							$("#submitEditCall").prop('disabled', false);

							setTimeout( function(){
								$("#err_msg1").html("");
							}, 2500);
							return false;
						}
					},
					error: function(data) {
						$("#err_msg1").html("There is an error, Please correct data.").css("color", "red");
						$("#submitEditCall").prop('disabled', false);

						setTimeout( function(){
							$("#err_msg1").html("");
						}, 2500);
						return false;
					}
				});
			}
		});
	});

	$("#addCallMdl").on('shown.bs.modal', function(){
		$("#addCallFrm")[0].reset();
	});

	$(document).on("click", ".addCall", function() {
		var analysts_id = $(this).data("analysts_id");
		var analystName = $(this).data("name");
		$("#addCallMdl").modal("show");
		$("#analysts_id").val(analysts_id);
		$("#analyst_name").text(analystName);
	});

	$(document).on("click", ".editCall", function() {
		var edit_id = $(this).data("monitor_id");
		var call_type = $(this).data("call_type");

		$.ajax({
			type: 'POST',
			url: "{{ route('editMonitorDataForm') }}",
			data: {id : edit_id,call_type:call_type},
			dataType: 'json',
			success: function(data) {
                $("select[data-control='select2']").select2("destroy");
				$("#editCallMdl .modal-dialog").html(data.message);
                $("select[data-control='select2']").select2();
				$("#editCallMdl").modal("show");
			},
			error: function(data) {
				alert("There is an error, Please try again.");
				//location.reload(true);
			}
		});
	});

    $(document).on("click", ".deleteCall", function() {
        var id = $(this).data("monitor_id");

        if(id){
            $("#confirmDeleteCallBtn").attr("data-id",id);
            $("#confirmDelete").modal("show");
        }else{
            window.alert("Unable to delete this keyword");
        }
    });

    $("#confirmDeleteCallBtn").on("click", function(e){
        const id = e.target.getAttribute("data-id");
        if(id){
            $.ajax({
                type: 'POST',
                url: "{{ route('deleteMonitorData') }}",
                data: {id : id},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    window.location.href = "monitor_data";
                }
            });
        }else{
            window.alert("Unable to delete this keyword");
        }
    });

    $(document).on("click", ".updateCall", function() {
        const edit_id = $(this).data("monitor_id");
        $("#call_id").val(edit_id);
        $("#closeCallMdl").modal("show");
    });
    // $("#closeCall").on("click",function(){
    //     const edit_id = $("#call_id").val(edit_id);
    //     const exit_time = $("#exit_time").val();
    //     const exit_price = $("#exit_price").val();

	// 	$.ajax({
	// 		type: 'POST',
	// 		url: "{{ route('closeMonitorData') }}",
	// 		data: {id : edit_id,exit_time : exit_time,exit_price : exit_price},
	// 		dataType: 'json',
	// 		headers: {
	// 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// 		},
	// 		success: function(data) {
    //             console.log(data);
	// 			// $("#editCallMdl .modal-dialog").html(data.message);
	// 			$("#closeCall").modal("show");
	// 		},
	// 		error: function(data) {
	// 			alert("There is an error, Please try again.");
	// 			//location.reload(true);
	// 		}
	// 	});
    // })
	</script>
@endsection

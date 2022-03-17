@extends('layout')
@section("page-title","Users")
@section("users","active")
@section("content")
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				@include("sidebar")
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					@include("header")
					@if ($errors->any())
						<div class="container error">
							<h6 class="alert alert-danger">{{$errors->first()}}</h6>
						</div>
					@elseif(session("info"))
						<div class="container info">
							<h6 class="alert alert-info">{{session("info")}}</h6>
						</div>
					@endif
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Toolbar-->
						<div class="toolbar" id="kt_toolbar">
							<!--begin::Container-->
							<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
								<!--begin::Page title-->
								<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
									<!--begin::Title-->
									<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Edit User</h1>
									<!--end::Title-->
								</div>
								<!--end::Page title-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Toolbar-->
						<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_app_stepper">
							<!--begin::Content-->
							<div class="flex-row-fluid px-lg-15">
								@can("user-write")
                                @if (isset($user->id))
								<!--begin::Form-->
								<form class="form" novalidate="novalidate" action="{{url('/user/update',$user->id)}}" method="POST" id="kt_modal_create_app_form">
									@csrf
									<!--begin::Step 1-->
									<div class="current d-block card p-7 my-5" data-kt-stepper-element="content">
										<div class="w-100">
											<div class="stepper-label mt-0" style="margin-top:30px;margin-bottom:20px;">
												<h3 class="stepper-title text-primary">Personal Details</h3>
											</div>
											<div class="mb-4">
												<div class="row">
													<!--begin::Input group-->
													<div class="col-md-6 mb-5">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span class="required">Name</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->name}}" name="name" placeholder="" value="" />
														<!--end::Input-->
													</div>
													<!--end::Input group-->

													<!--begin::Input group-->
													<div class="col-md-6 col-sm-12 mb-5">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span class="required">Email ID</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->email}}" name="email" placeholder="" value="" />
														<!--end::Input-->
													</div>
												</div>



												<div class="row d-flex align-items-end mb-5 custom_appendDiv">
                                                    @if(isset($userRole) && $userRole == "super-admin")
                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 col-sm-12 mb-5">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="">Password</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old('password')}}" name="password" />
                                                        <!--end::Input-->
                                                    </div>
                                                    @endif

                                                    <div class="col-md-6 col-sm-12 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Mobile Number <span class="compCount"></span></span>
                                                    </label>
                                                    <!--end::Label-->
                                                    @forelse ($user->numbers as $number)
                                                        <!--begin::Input group-->
                                                        <div class="col-md-12 col-sm-12 mb-5">
                                                            <div class="d-flex justify-conetent-end">
                                                                <!--begin::Input-->
                                                                <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc" style="border-radius:5px 0px 0px 5px;" name="number[]" value="{{$number}}" style="display: inline; width: 90%;" />
                                                                <!--end::Input-->
                                                                <button type="button" class="btn btn-primary addremwpnum" id="addmoreWhatsapp" style="border-radius: 0px 5px 5px 0px;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 172 172"
                                                                        style=" fill:#000000;">
                                                                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter"
                                                                            stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                                                            font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                                            <path d="M0,172v-172h172v172z" fill="none"></path>
                                                                            <g fill="#ffffff">
                                                                                <path
                                                                                    d="M85.83203,17.04323c-6.32845,0.09274 -11.38527,5.2949 -11.2987,11.62344v45.86667h-45.86667c-4.13529,-0.05848 -7.98173,2.11417 -10.06645,5.68601c-2.08471,3.57184 -2.08471,7.98948 0,11.56132c2.08471,3.57184 5.93115,5.74449 10.06645,5.68601h45.86667v45.86667c-0.05848,4.13529 2.11417,7.98173 5.68601,10.06645c3.57184,2.08471 7.98948,2.08471 11.56132,0c3.57184,-2.08471 5.74449,-5.93115 5.68601,-10.06645v-45.86667h45.86667c4.13529,0.05848 7.98173,-2.11417 10.06645,-5.68601c2.08471,-3.57184 2.08471,-7.98948 0,-11.56132c-2.08471,-3.57184 -5.93115,-5.74449 -10.06645,-5.68601h-45.86667v-45.86667c0.04237,-3.09747 -1.17017,-6.08033 -3.36168,-8.26973c-2.1915,-2.18939 -5.17553,-3.39907 -8.27296,-3.35371z">
                                                                                </path>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <!--end::Input group-->
                                                    @empty
                                                        <div class="col-md-12 col-sm-12 mb-5">
                                                            <div class="d-flex justify-conetent-end">
                                                                <!--begin::Input-->
                                                                <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc" style="border-radius:5px 0px 0px 5px;" name="number[]" placeholder="" value="" style="    display: inline;
                                                                width: 90%;" />
                                                                <!--end::Input-->
                                                                <button type="button" class="btn btn-primary addremwpnum" id="addmoreWhatsapp" style="border-radius: 0px 5px 5px 0px;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 172 172"
                                                                        style=" fill:#000000;">
                                                                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter"
                                                                            stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                                                            font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                                            <path d="M0,172v-172h172v172z" fill="none"></path>
                                                                            <g fill="#ffffff">
                                                                                <path
                                                                                    d="M85.83203,17.04323c-6.32845,0.09274 -11.38527,5.2949 -11.2987,11.62344v45.86667h-45.86667c-4.13529,-0.05848 -7.98173,2.11417 -10.06645,5.68601c-2.08471,3.57184 -2.08471,7.98948 0,11.56132c2.08471,3.57184 5.93115,5.74449 10.06645,5.68601h45.86667v45.86667c-0.05848,4.13529 2.11417,7.98173 5.68601,10.06645c3.57184,2.08471 7.98948,2.08471 11.56132,0c3.57184,-2.08471 5.74449,-5.93115 5.68601,-10.06645v-45.86667h45.86667c4.13529,0.05848 7.98173,-2.11417 10.06645,-5.68601c2.08471,-3.57184 2.08471,-7.98948 0,-11.56132c-2.08471,-3.57184 -5.93115,-5.74449 -10.06645,-5.68601h-45.86667v-45.86667c0.04237,-3.09747 -1.17017,-6.08033 -3.36168,-8.26973c-2.1915,-2.18939 -5.17553,-3.39907 -8.27296,-3.35371z">
                                                                                </path>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                    </div>
												</div>
                                                <div id="appendDivWp"></div>
											</div>

                                            <div class="row">
												<!--begin::Input group-->
												<div class="col-md-6 col-sm-12 mb-5">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Bank Name</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->bank_name}}" name="bank_name" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->

												<!--begin::Input group-->
												<div class="col-md-6 col-sm-12 mb-5">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Account Number</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="number" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->account_number}}" name="account_number" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
                                            </div>

                                            <div class="row">
												<!--begin::Input group-->
												<div class="col-md-6 col-sm-12 mb-5">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">IFSC Code</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->ifsc_code}}" name="ifsc_code" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->

												<!--begin::Input group-->
												<div class="col-md-6 col-sm-12 mb-5">
                                                    <!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Account Type</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
                                                    <select name="account_type" data-control="select2" class="form-select form-select-sm form-select-solid">
                                                        @forelse ($account_types as $account_type)
															<option value="{{$account_type->account_type}}" {{(old('account_type') && old('account_type')==$account_type->account_type)?"selected":($user->account_type==$account_type->account_type?"selected":"")}}>{{$account_type->account_type}}</option>
														@empty
															<option>Selecte Bank</option>
														@endforelse
                                                    </select>
													<!--end::Input-->
												</div>
												<!--end::Input group-->
                                            </div>

										</div>
									</div>
									<!--end::Step 1-->

                                    <!--begin::Step 2-->
									<div class="current d-block card p-7 my-5" data-kt-stepper-element="content" id="professionalDetails">
										<div class="w-100">
											<div class="stepper-label mt-0" style="margin-top:30px;margin-bottom:20px;">
												<h3 class="stepper-title text-primary">Professional Details</h3>
											</div>

                                            <div class="row col-md-6 mb-8">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-3">
                                                    <span class="required">User Type</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-md-6 mb-4 fv-row">
                                                    <!--begin:Option-->
                                                    <label class="d-flex flex-stack cursor-pointer mb-5">
                                                        <!--begin::Label-->
                                                        <span class="d-flex align-items-center me-2">
                                                            <!--begin::Info-->
                                                            <span class="d-flex flex-column">
                                                                <span class="fw-bolder fs-6">Partner</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </span>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input toggleUserType" type="radio" name="user_type" {{($user->user_type=="1")?"checked":""}} value="1">
                                                        </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>

                                                <!--end::Col-->
                                                <div class="col-1"></div>
                                                <!--begin::Col-->
                                                <div class="col-md-6 mb-4 fv-row">
                                                    <!--begin:Option-->
                                                    <label class="d-flex flex-stack cursor-pointer mb-5">
                                                        <!--begin::Label-->
                                                        <span class="d-flex align-items-center me-2">
                                                            <!--begin::Info-->
                                                            <span class="d-flex flex-column">
                                                                <span class="fw-bolder fs-6">Employee</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </span>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input toggleUserType" type="radio" {{($user->user_type=="2")?"checked":""}} name="user_type" value="2">
                                                        </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                                <!--end::Col-->

                                                <div class="col-1"></div>
                                                <!--begin::Col-->
                                                <div class="col-md-6 mb-4 fv-row">
                                                    <!--begin:Option-->
                                                    <label class="d-flex flex-stack cursor-pointer mb-5">
                                                        <!--begin::Label-->
                                                        <span class="d-flex align-items-center me-2">
                                                            <!--begin::Info-->
                                                            <span class="d-flex flex-column">
                                                                <span class="fw-bolder fs-6">Channel Partner</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </span>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input toggleUserType" type="radio" {{($user->user_type=="3")?"checked":""}} name="user_type" value="3">
                                                        </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                                <!--end::Col-->

                                                <div class="col-1"></div>
                                                <!--begin::Col-->
                                                <div class="col-md-6 mb-4 fv-row">
                                                    <!--begin:Option-->
                                                    <label class="d-flex flex-stack cursor-pointer mb-5">
                                                        <!--begin::Label-->
                                                        <span class="d-flex align-items-center me-2">
                                                            <!--begin::Info-->
                                                            <span class="d-flex flex-column">
                                                                <span class="fw-bolder fs-6">Freelancer AMS</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </span>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input toggleUserType" type="radio" name="user_type" {{($user->user_type=="4")?"checked":""}} value="4">
                                                        </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                                <!--end::Col-->

                                                <div class="col-1"></div>
                                                <!--begin::Col-->
                                                <div class="col-md-6 mb-4 fv-row">
                                                    <!--begin:Option-->
                                                    <label class="d-flex flex-stack cursor-pointer mb-5">
                                                        <!--begin::Label-->
                                                        <span class="d-flex align-items-center me-2">
                                                            <!--begin::Info-->
                                                            <span class="d-flex flex-column">
                                                                <span class="fw-bolder fs-6">Freelancer Prime</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </span>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input toggleUserType" type="radio"  {{($user->user_type=="5")?"checked":""}} name="user_type" value="5">
                                                        </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                                <!--end::Col-->

                                                <div class="col-1"></div>
                                                <!--begin::Col-->
                                                <div class="col-md-6 mb-4 fv-row">
                                                    <!--begin:Option-->
                                                    <label class="d-flex flex-stack cursor-pointer mb-5">
                                                        <!--begin::Label-->
                                                        <span class="d-flex align-items-center me-2">
                                                            <!--begin::Info-->
                                                            <span class="d-flex flex-column">
                                                                <span class="fw-bolder fs-6">Terminate</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </span>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input toggleUserType" type="radio" {{($user->deleted_at!=null)?"checked":""}} name="user_type" value="6">
                                                        </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                                <!--end::Col-->
                                            </div>

                                            <div class="row" id="partnerDiv" style="display:{{($user->user_type=="1")?"flex":"none"}};">
                                                <div class="col-md-2 mb-4 fv-row">
                                                    <label class="d-flex flex-stack cursor-pointer mb-5">
                                                        <!--begin::Label-->
                                                        <span class="d-flex align-items-center me-2">
                                                            <!--begin::Info-->
                                                            <span class="d-flex flex-column">
                                                                <span class="fw-bolder fs-6">Company</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </span>
                                                    </label>
                                                </div>
                                                <!--begin::Col-->
                                                <div class="col-md-5 mb-4 fv-row">
                                                    <!--begin:Option-->
                                                    <label class="d-flex flex-stack cursor-pointer mb-5">
                                                        <!--begin::Label-->
                                                        <span class="d-flex align-items-center me-2">
                                                            <!--begin::Info-->
                                                            <span class="d-flex flex-column">
                                                                <span class="fw-bolder fs-6">Smart Trader</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </span>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input toggleUserType" type="checkbox" {{($user->company_first != '' && $user->company_first != null) ? "checked" : ''}} id="company_1"  name="company_1" value="1">
                                                        </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->

                                                    <div id="profit_company_1">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">Profit Percentage</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->profit_percentage_first}}" name="profit_company_1" placeholder="Profit Percentage"  />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Col-->
                                                <div class="col-md-5 mb-4 fv-row">
                                                    <!--begin:Option-->
                                                    <label class="d-flex flex-stack cursor-pointer mb-5">
                                                        <!--begin::Label-->
                                                        <span class="d-flex align-items-center me-2">
                                                            <!--begin::Info-->
                                                            <span class="d-flex flex-column">
                                                                <span class="fw-bolder fs-6">ProfiNext</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </span>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input toggleUserType" type="checkbox" {{($user->company_second != '' && $user->company_second != null) ? "checked" : '' }} id="company_2" name="company_2" value="1">
                                                        </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->

                                                    <div id="profit_company_2">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">Profit Percentage</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->profit_percentage_second}}" name="profit_company_2" placeholder="Profit Percentage"  />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                            </div>

                                            <div class="row" id="employeeDiv" style="display:{{($user->user_type=="2")?"flex":"none"}};">
                                                <!--begin::Input group-->
												<div class="col-md-6 mb-5">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Salary</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->salary}}" name="salary" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->

                                                <div class="col-md-6 mb-4">
                                                    <!--begin::Label-->
                                                    <label class="required fs-5 fw-bold mb-2">Joining Date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="joining_date" value="{{date("Y-m-d",strtotime("now"))}}" readonly class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="Select date"/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->

                                            </div>

                                            <div class="row" id="freelancerAmsDiv" style="display:{{(old('user_type')==1)?"flex":"none"}};">

                                                <div class="row">
                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 mb-5">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">Percentage of fees</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{isset($user->fees_percentage) ? $user->fees_percentage : ''}}" name="fees_percentage" placeholder="Percentage of fees"  />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <div class="col-md-6 mb-4">
                                                        <!--begin::Label-->
                                                        <label class="required fs-5 fw-bold mb-2">Limit</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="limit" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{isset($user->ams_limit) ? $user->ams_limit : ''}}" placeholder="Limit"/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>

                                                <div class="row">
                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 mb-5">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">Percentage For AMS New Client</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{isset($user->ams_new_client_profit) ? $user->ams_new_client_profit : ''}}" name="ams_new_client_profit" placeholder="Percentage For AMS New Client"  />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <div class="col-md-6 mb-4">
                                                        <!--begin::Label-->
                                                        <label class="required fs-5 fw-bold mb-2">Joining Date</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="joining_date" value="{{isset($user->joining_date) ? $user->joining_date : ''}}" readonly class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="Select date"/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                            </div>

                                            <div class="row" id="freelancerPrimeDiv" style="display:{{(old('user_type')==1)?"flex":"none"}};">

                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Percentage of profit sharing</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{isset($user->percentage) ? $user->percentage : ''}}"  name="percentage" placeholder="Percentage of profit sharing"  />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->

                                                <div class="col-md-6 mb-4">
                                                    <!--begin::Label-->
                                                    <label class="required fs-5 fw-bold mb-2">Joining Date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="joining_date" value="{{date("Y-m-d",strtotime("now"))}}" readonly value="{{isset($user->joining_date) ? $user->joining_date : ''}}" class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="Select date"/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>

                                            <div class="row" id="channelPartnerDiv" style="display:{{(old('user_type')==1)?"flex":"none"}};">

                                                <div class="row">
                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 mb-5">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">Percentage For AMS New Client</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{isset($user->ams_new_client_percentage) ? $user->ams_new_client_percentage : ''}}" name="ams_new_client_percentage" placeholder="Percentage For AMS New Client"  />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <div class="col-md-6 mb-4">
                                                        <!--begin::Label-->
                                                        <label class="required fs-5 fw-bold mb-2">Percentage For AMS Renewal Client</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="ams_renewal_client_percentage" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{isset($user->ams_renewal_client_percentage) ? $user->ams_renewal_client_percentage : ''}}" placeholder="Percentage For AMS Renewal Client"/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>

                                                <div class="row">
                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 mb-5">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">Percentage For Prime New Client</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{isset($user->prime_new_client_percentage) ? $user->prime_new_client_percentage : ''}}" name="prime_new_client_percentage" placeholder="Percentage For Prime New Client"  />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <div class="col-md-6 mb-4">
                                                        <!--begin::Label-->
                                                        <label class="required fs-5 fw-bold mb-2">Percentage For Prime Renewal Client</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="prime_renewal_client_percentage"  class="form-control form-control-lg form-control-solid bdr-ccc" value="{{isset($user->prime_renewal_client_percentage) ? $user->prime_renewal_client_percentage : ''}}" placeholder="Percentage For Prime Renewal Client"/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                            </div>

                                            <div class="row">
												<!--begin::Input group-->
												<div class="col-md-8 col-sm-12 mb-5">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Job Description</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<textarea class="form-control form-control-lg form-control-solid bdr-ccc" name="job_description">{{$user->job_description}}</textarea>
													<!--end::Input-->
												</div>
												<!--end::Input group-->

												<!--begin::Input group-->
												<div class="col-md-6 col-sm-12 mb-5">
                                                    <!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Roles</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													@can("role-write")
														@php
															$userRole = explode(",", $user->role);
														@endphp
														<select name="role[]" id="user_role" aria-label="Select a role" class="form-control" data-placeholder="Select Role">
                                                            <option></option>
                                                            @forelse ($roles as $role)
																<option value="{{$role->name}}" {{(in_array($role->name,$userRole)) ? "selected" : "" }}>{{$role->name}}</option>
															@empty
																<option>Please Add Role</option>
															@endforelse
														</select>
														<div class="col-12" id="manual_permission">
															<table role="table" aria-busy="false" aria-colcount="5" class="table b-table table-striped" id="__BVID__660">
																<!---->
																<!---->
																<thead role="rowgroup" class="">
																	<!---->
																	<tr role="row" class="">
																		<th role="columnheader" scope="col" aria-colindex="1" class="">
																			<div class="font-weight-bold">Module</div>
																		</th>
																		<th role="columnheader" scope="col" aria-colindex="2" class="">
																			<div>Read</div>
																		</th>
																		<th role="columnheader" scope="col" aria-colindex="3" class="">
																			<div>Write</div>
																		</th>
																		<th role="columnheader" scope="col" aria-colindex="4" class="">
																			<div>Create</div>
																		</th>
																		<th role="columnheader" scope="col" aria-colindex="5" class="">
																			<div>Delete</div>
																		</th>
																	</tr>
																</thead>
																<tbody role="rowgroup">
																	@php
																		$user_permissions = json_decode($user->permission);
																	@endphp
																	<tr role="row" class="">
																		<td aria-colindex="1" role="cell" class=""> Client </td>
																		{{-- client permissions from 1 to 4 --}}
																		@for($i=0;$i<=3;$i++)
																			<td aria-colindex="2" role="cell" class="">
																				<div class="form-check form-check-custom form-check-solid">
																					<input type="checkbox" class="form-check-input permissionCheckBox" name='permissions[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
																					<label class="custom-control-label" for="__BVID__675"></label>
																				</div>
																			</td>
																		@endfor
																	</tr>
																	<tr role="row" class="">
																		{{-- role permissions from 5 to 8 --}}
																		<td aria-colindex="1" role="cell" class=""> Role </td>
																		@for($i=4;$i<=7;$i++)
																			<td aria-colindex="2" role="cell" class="">
																				<div class="form-check form-check-custom form-check-solid">
																					<input type="checkbox" class="form-check-input permissionCheckBox" name='permissions[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
																					<label class="custom-control-label" for="__BVID__675"></label>
																				</div>
																			</td>
																		@endfor
																	</tr>
																	<tr role="row" class="">
																		{{-- role permissions from 9 to 11 --}}
																		<td aria-colindex="1" role="cell" class=""> User </td>
																		@for($i=8;$i<12;$i++)
																			<td aria-colindex="2" role="cell" class="">
																				<div class="form-check form-check-custom form-check-solid">
																					<input type="checkbox" class="form-check-input permissionCheckBox" name='permissions[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
																					<label class="custom-control-label" for="__BVID__675"></label>
																				</div>
																			</td>
																		@endfor
																	</tr>
																	<tr role="row" class="">
																		{{-- role permissions from 12 to 14 --}}
																		<td aria-colindex="1" role="cell" class=""> Analysis </td>
																		@for($i=12;$i<16;$i++)
																			<td aria-colindex="2" role="cell" class="">
																				<div class="form-check form-check-custom form-check-solid">
																					<input type="checkbox" class="form-check-input permissionCheckBox" name='permissions[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
																					<label class="custom-control-label" for="__BVID__675"></label>
																				</div>
																			</td>
																		@endfor
																	</tr>
																	<tr role="row" class="">
																		{{-- role permissions from 15 to 17 --}}
																		<td aria-colindex="1" role="cell" class=""> Call </td>
																		@for($i=16;$i<20;$i++)
																			<td aria-colindex="2" role="cell" class="">
																				<div class="form-check form-check-custom form-check-solid">
																					<input type="checkbox" class="form-check-input permissionCheckBox" name='permissions[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
																					<label class="custom-control-label" for="__BVID__675"></label>
																				</div>
																			</td>
																		@endfor
																	</tr>
																	<tr role="row" class="">
																		{{-- role permissions from 15 to 17 --}}
																		<td aria-colindex="1" role="cell" class=""> Trader </td>
																		@for($i=20;$i<24;$i++)
																			<td aria-colindex="2" role="cell" class="">
																				<div class="form-check form-check-custom form-check-solid">
																					<input type="checkbox" class="form-check-input permissionCheckBox" name='permissions[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
																					<label class="custom-control-label" for="__BVID__675"></label>
																				</div>
																			</td>
																		@endfor
																	</tr>
																	<tr role="row" class="">
																		{{-- role permissions from 15 to 17 --}}
																		<td aria-colindex="1" role="cell" class=""> Monitor </td>
																		@for($i=24;$i<28;$i++)
																			<td aria-colindex="2" role="cell" class="">
																				<div class="form-check form-check-custom form-check-solid">
																					<input type="checkbox" class="form-check-input permissionCheckBox" name='permissions[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
																					<label class="custom-control-label" for="__BVID__675"></label>
																				</div>
																			</td>
																		@endfor
																	</tr>
                                                                    <tr role="row" class="">
                                                                        {{-- role permissions from 5 to 8 --}}
                                                                        <td aria-colindex="1" role="cell" class=""> Client Demat </td>
                                                                        @for($i=28;$i<32;$i++)
                                                                            <td aria-colindex="2" role="cell" class="">
                                                                                <div class="form-check form-check-custom form-check-solid">
                                                                                    <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
                                                                                    <label class="custom-control-label" for="__BVID__675"></label>
                                                                                </div>
                                                                            </td>
                                                                        @endfor
                                                                    </tr>
                                                                    <tr role="row" class="">
                                                                        {{-- role permissions from 5 to 8 --}}
                                                                        <td aria-colindex="1" role="cell" class=""> Monitor Data </td>
                                                                        @for($i=32;$i<36;$i++)
                                                                            <td aria-colindex="2" role="cell" class="">
                                                                                <div class="form-check form-check-custom form-check-solid">
                                                                                    <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
                                                                                    <label class="custom-control-label" for="__BVID__675"></label>
                                                                                </div>
                                                                            </td>
                                                                        @endfor
                                                                    </tr>
                                                                    <tr role="row" class="">
                                                                        {{-- role permissions from 5 to 8 --}}
                                                                        <td aria-colindex="1" role="cell" class=""> Report </td>
                                                                        @for($i=36;$i<40;$i++)
                                                                            <td aria-colindex="2" role="cell" class="">
                                                                                <div class="form-check form-check-custom form-check-solid">
                                                                                    <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
                                                                                    <label class="custom-control-label" for="__BVID__675"></label>
                                                                                </div>
                                                                            </td>
                                                                        @endfor
                                                                    </tr>
                                                                    <tr role="row" class="">
                                                                        {{-- role permissions from 5 to 8 --}}
                                                                        <td aria-colindex="1" role="cell" class=""> Freelancer Data </td>
                                                                        @for($i=40;$i<44;$i++)
                                                                            <td aria-colindex="2" role="cell" class="">
                                                                                <div class="form-check form-check-custom form-check-solid">
                                                                                    <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
                                                                                    <label class="custom-control-label" for="__BVID__675"></label>
                                                                                </div>
                                                                            </td>
                                                                        @endfor
                                                                    </tr>

                                                                    <tr role="row" class="">
                                                                        {{-- role permissions from 5 to 8 --}}
                                                                        <td aria-colindex="1" role="cell" class=""> Freelancer </td>
                                                                        @for($i=44;$i<48;$i++)
                                                                            <td aria-colindex="2" role="cell" class="">
                                                                                <div class="form-check form-check-custom form-check-solid">
                                                                                    <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
                                                                                    <label class="custom-control-label" for="__BVID__675"></label>
                                                                                </div>
                                                                            </td>
                                                                        @endfor
                                                                    </tr>

                                                                    <tr role="row" class="">
                                                                        {{-- role permissions from 5 to 8 --}}
                                                                        <td aria-colindex="1" role="cell" class=""> Channel Partner Data </td>
                                                                        @for($i=48;$i<52;$i++)
                                                                            <td aria-colindex="2" role="cell" class="">
                                                                                <div class="form-check form-check-custom form-check-solid">
                                                                                    <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
                                                                                    <label class="custom-control-label" for="__BVID__675"></label>
                                                                                </div>
                                                                            </td>
                                                                        @endfor
                                                                    </tr>

                                                                    <tr role="row" class="">
                                                                        {{-- role permissions from 5 to 8 --}}
                                                                        <td aria-colindex="1" role="cell" class=""> Channel Partner </td>
                                                                        @for($i=52;$i<56;$i++)
                                                                            <td aria-colindex="2" role="cell" class="">
                                                                                <div class="form-check form-check-custom form-check-solid">
                                                                                    <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
                                                                                    <label class="custom-control-label" for="__BVID__675"></label>
                                                                                </div>
                                                                            </td>
                                                                        @endfor
                                                                    </tr>

                                                                    <tr role="row" class="">
                                                                        {{-- role permissions from 5 to 8 --}}
                                                                        <td aria-colindex="1" role="cell" class=""> Keyword </td>
                                                                        @for($i=56;$i<60;$i++)
                                                                            <td aria-colindex="2" role="cell" class="">
                                                                                <div class="form-check form-check-custom form-check-solid">
                                                                                    <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
                                                                                    <label class="custom-control-label" for="__BVID__675"></label>
                                                                                </div>
                                                                            </td>
                                                                        @endfor
                                                                    </tr>

                                                                    <tr role="row" class="">
                                                                        {{-- role permissions from 5 to 8 --}}
                                                                        <td aria-colindex="1" role="cell" class=""> Trader Data </td>
                                                                        @for($i=60;$i<64;$i++)
                                                                            <td aria-colindex="2" role="cell" class="">
                                                                                <div class="form-check form-check-custom form-check-solid">
                                                                                    <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
                                                                                    <label class="custom-control-label" for="__BVID__675"></label>
                                                                                </div>
                                                                            </td>
                                                                        @endfor
                                                                    </tr>

                                                                    <tr role="row" class="">
                                                                        {{-- role permissions from 5 to 8 --}}
                                                                        <td aria-colindex="1" role="cell" class=""> Setup </td>
                                                                        @for($i=64;$i<68;$i++)
                                                                            <td aria-colindex="2" role="cell" class="">
                                                                                <div class="form-check form-check-custom form-check-solid">
                                                                                    <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{isset($all_permissions[$i])?$all_permissions[$i]:""}}" {{(isset($all_permissions[$i]) && !empty($user_permissions)) ? ((in_array($all_permissions[$i],$user_permissions))? 'checked' : ''):""}} id="__BVID__675">
                                                                                    <label class="custom-control-label" for="__BVID__675"></label>
                                                                                </div>
                                                                            </td>
                                                                        @endfor
                                                                    </tr>
																</tbody>
																<!---->
															</table>
														</div>
													@else
														<input type="text" value="{{$user->role}}" readonly class="form-control form-control-lg form-control-solid bdr-ccc"/>
													@endcan
													<!--end::Input-->
												</div>
												<!--end::Input group-->
                                            </div>

										</div>
									</div>
									<!--end::Step 2-->

									<!--begin::Actions-->
									<div class="d-flex flex-stack pt-10">
										<!--begin::Wrapper-->
										<div class="me-2">
											<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="previous">
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
											<span class="svg-icon svg-icon-3 me-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
													<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->Back</button>
										</div>
										<!--end::Wrapper-->
										<!--begin::Wrapper-->
										<div>
											<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
												<span class="indicator-label">Submit
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
												<span class="svg-icon svg-icon-3 ms-2 me-0">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
														<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon--></span>
												<span class="indicator-progress">Please wait...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
											</button>
											<button type="submit" class="btn btn-lg btn-primary" >Submit
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
											<span class="svg-icon svg-icon-3 ms-1 me-0">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
													<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon--></button>
										</div>
										<!--end::Wrapper-->
									</div>
									<!--end::Actions-->
								</form>
								<!--end::Form-->
                                @else
                                    <h1>Invalid user</h1>
                                @endif
								@else
								    <h1>Unauthorised</h1>
								@endcan
							</div>
							<!--end::Content-->
						</div>
					</div>
					<!--end::Content-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		{{-- <!--begin::Drawers-->
		<!--begin::Activities drawer-->
		@include("kt_activities")
		<!--end::Activities drawer-->
		<!--begin::Chat drawer-->
		@include("kt_drawer_chat")
		<!--end::Chat drawer-->
		<!--begin::Exolore drawer toggle-->
		@include("kt_explore_toggle")
		<!--end::Exolore drawer toggle-->
		<!--begin::Exolore drawer-->
		@include("kt_explore")
		<!--end::Exolore drawer--> --}}
		<!--end::Drawers-->
		<!--begin::Modals-->
		<!--begin::Modal - Invite Friends-->
		{{-- <div class="modal fade" id="kt_modal_invite_friends" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog mw-650px">
				<!--begin::Modal content-->
				<div class="modal-content">
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
					<div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
						<!--begin::Heading-->
						<div class="text-center mb-13">
							<!--begin::Title-->
							<h1 class="mb-3">Invite a Friend</h1>
							<!--end::Title-->
							<!--begin::Description-->
							<div class="text-muted fw-bold fs-5">If you need more info, please check out
							<a href="#" class="link-primary fw-bolder">FAQ Page</a>.</div>
							<!--end::Description-->
						</div>
						<!--end::Heading-->
						<!--begin::Google Contacts Invite-->
						<div class="btn btn-light-primary fw-bolder w-100 mb-8">
						<img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Invite Gmail Contacts</div>
						<!--end::Google Contacts Invite-->
						<!--begin::Separator-->
						<div class="separator d-flex flex-center mb-8">
							<span class="text-uppercase bg-body fs-7 fw-bold text-muted px-3">or</span>
						</div>
						<!--end::Separator-->
						<!--begin::Textarea-->
						<textarea class="form-control form-control-solid bdr-ccc mb-8" rows="3" placeholder="Type or paste emails here"></textarea>
						<!--end::Textarea-->
						<!--begin::Users-->
						<div class="mb-10">
							<!--begin::Heading-->
							<div class="fs-6 fw-bold mb-2">Your Invitations</div>
							<!--end::Heading-->
							<!--begin::List-->
							<div class="mh-300px scroll-y me-n7 pe-7">
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/150-1.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Emma Smith</a>
											<div class="fw-bold text-muted">e.smith@kpmg.com.au</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2" selected="selected">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-danger text-danger fw-bold">M</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Melody Macy</a>
											<div class="fw-bold text-muted">melody@altbox.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1" selected="selected">Guest</option>
											<option value="2">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/150-26.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Max Smith</a>
											<div class="fw-bold text-muted">max@kt.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/150-4.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Sean Bean</a>
											<div class="fw-bold text-muted">sean@dellito.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2" selected="selected">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/150-15.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Brian Cox</a>
											<div class="fw-bold text-muted">brian@exchange.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-warning text-warning fw-bold">M</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Mikaela Collins</a>
											<div class="fw-bold text-muted">mikaela@pexcom.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2" selected="selected">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/150-8.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Francis Mitcham</a>
											<div class="fw-bold text-muted">f.mitcham@kpmg.com.au</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-danger text-danger fw-bold">O</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Olivia Wild</a>
											<div class="fw-bold text-muted">olivia@corpmail.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2" selected="selected">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-primary text-primary fw-bold">N</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Neil Owen</a>
											<div class="fw-bold text-muted">owen.neil@gmail.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1" selected="selected">Guest</option>
											<option value="2">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/150-6.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Dan Wilson</a>
											<div class="fw-bold text-muted">dam@consilting.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-danger text-danger fw-bold">E</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Emma Bold</a>
											<div class="fw-bold text-muted">emma@intenso.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2" selected="selected">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/150-7.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Ana Crown</a>
											<div class="fw-bold text-muted">ana.cf@limtel.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1" selected="selected">Guest</option>
											<option value="2">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-info text-info fw-bold">A</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Robert Doe</a>
											<div class="fw-bold text-muted">robert@benko.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/150-17.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">John Miller</a>
											<div class="fw-bold text-muted">miller@mapple.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<span class="symbol-label bg-light-success text-success fw-bold">L</span>
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Lucy Kunic</a>
											<div class="fw-bold text-muted">lucy.m@fentech.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2" selected="selected">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/150-10.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Ethan Wilder</a>
											<div class="fw-bold text-muted">ethan@loop.com.au</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1" selected="selected">Guest</option>
											<option value="2">Owner</option>
											<option value="3">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
								<!--begin::User-->
								<div class="d-flex flex-stack py-4">
									<!--begin::Details-->
									<div class="d-flex align-items-center">
										<!--begin::Avatar-->
										<div class="symbol symbol-35px symbol-circle">
											<img alt="Pic" src="assets/media/avatars/150-17.jpg" />
										</div>
										<!--end::Avatar-->
										<!--begin::Details-->
										<div class="ms-5">
											<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">John Miller</a>
											<div class="fw-bold text-muted">miller@mapple.com</div>
										</div>
										<!--end::Details-->
									</div>
									<!--end::Details-->
									<!--begin::Access menu-->
									<div class="ms-2 w-100px">
										<select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
											<option value="1">Guest</option>
											<option value="2">Owner</option>
											<option value="3" selected="selected">Can Edit</option>
										</select>
									</div>
									<!--end::Access menu-->
								</div>
								<!--end::User-->
							</div>
							<!--end::List-->
						</div>
						<!--end::Users-->
						<!--begin::Notice-->
						<div class="d-flex flex-stack">
							<!--begin::Label-->
							<div class="me-5 fw-bold">
								<label class="fs-6">Adding Users by Team Members</label>
								<div class="fs-7 text-muted">If you need more info, please check budget planning</div>
							</div>
							<!--end::Label-->
							<!--begin::Switch-->
							<label class="form-check form-switch form-check-custom form-check-solid">
								<input class="form-check-input" type="checkbox" value="1" checked="checked" />
								<span class="form-check-label fw-bold text-muted">Allowed</span>
							</label>
							<!--end::Switch-->
						</div>
						<!--end::Notice-->
					</div>
					<!--end::Modal body-->
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>
		<!--end::Modal - Invite Friend-->
		<!--begin::Modal - Create App-->
		<div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-dialog-centered mw-900px">
				<!--begin::Modal content-->
				<div class="modal-content">
					<!--begin::Modal header-->
					<div class="modal-header">
						<!--begin::Modal title-->
						<h2>Create App</h2>
						<!--end::Modal title-->
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
					<!--end::Modal header-->
					<!--begin::Modal body-->
					<div class="modal-body py-lg-10 px-lg-10">
						<!--begin::Stepper-->
						<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_app_stepper">
							<!--begin::Aside-->
							<div class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px">
								<!--begin::Nav-->
								<div class="stepper-nav ps-lg-10">
									<!--begin::Step 1-->
									<div class="stepper-item current" data-kt-stepper-element="nav">
										<!--begin::Line-->
										<div class="stepper-line w-40px"></div>
										<!--end::Line-->
										<!--begin::Icon-->
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">1</span>
										</div>
										<!--end::Icon-->
										<!--begin::Label-->
										<div class="stepper-label">
											<h3 class="stepper-title">Details</h3>
											<div class="stepper-desc">Name your App</div>
										</div>
										<!--end::Label-->
									</div>
									<!--end::Step 1-->
									<!--begin::Step 2-->
									<div class="stepper-item" data-kt-stepper-element="nav">
										<!--begin::Line-->
										<div class="stepper-line w-40px"></div>
										<!--end::Line-->
										<!--begin::Icon-->
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">2</span>
										</div>
										<!--begin::Icon-->
										<!--begin::Label-->
										<div class="stepper-label">
											<h3 class="stepper-title">Frameworks</h3>
											<div class="stepper-desc">Define your app framework</div>
										</div>
										<!--begin::Label-->
									</div>
									<!--end::Step 2-->
									<!--begin::Step 3-->
									<div class="stepper-item" data-kt-stepper-element="nav">
										<!--begin::Line-->
										<div class="stepper-line w-40px"></div>
										<!--end::Line-->
										<!--begin::Icon-->
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">3</span>
										</div>
										<!--end::Icon-->
										<!--begin::Label-->
										<div class="stepper-label">
											<h3 class="stepper-title">Database</h3>
											<div class="stepper-desc">Select the app database type</div>
										</div>
										<!--end::Label-->
									</div>
									<!--end::Step 3-->
									<!--begin::Step 4-->
									<div class="stepper-item" data-kt-stepper-element="nav">
										<!--begin::Line-->
										<div class="stepper-line w-40px"></div>
										<!--end::Line-->
										<!--begin::Icon-->
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">4</span>
										</div>
										<!--end::Icon-->
										<!--begin::Label-->
										<div class="stepper-label">
											<h3 class="stepper-title">Billing</h3>
											<div class="stepper-desc">Provide payment details</div>
										</div>
										<!--end::Label-->
									</div>
									<!--end::Step 4-->
									<!--begin::Step 5-->
									<div class="stepper-item" data-kt-stepper-element="nav">
										<!--begin::Line-->
										<div class="stepper-line w-40px"></div>
										<!--end::Line-->
										<!--begin::Icon-->
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">5</span>
										</div>
										<!--end::Icon-->
										<!--begin::Label-->
										<div class="stepper-label">
											<h3 class="stepper-title">Completed</h3>
											<div class="stepper-desc">Review and Submit</div>
										</div>
										<!--end::Label-->
									</div>
									<!--end::Step 5-->
								</div>
								<!--end::Nav-->
							</div>
							<!--begin::Aside-->
							<!--begin::Content-->
							<div class="flex-row-fluid py-lg-5 px-lg-15">
								<!--begin::Form-->
								<form class="form" novalidate="novalidate" id="kt_modal_create_app_form">
									<!--begin::Step 1-->
									<div class="current" data-kt-stepper-element="content">
										<div class="w-100">
											<!--begin::Input group-->
											<div class="fv-row mb-10">
												<!--begin::Label-->
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">App Name</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify your unique app name"></i>
												</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="name" placeholder="" value="" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="fv-row">
												<!--begin::Label-->
												<label class="d-flex align-items-center fs-5 fw-bold mb-4">
													<span class="required">Category</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select your app category"></i>
												</label>
												<!--end::Label-->
												<!--begin:Options-->
												<div class="fv-row">
													<!--begin:Option-->
													<label class="d-flex flex-stack mb-5 cursor-pointer">
														<!--begin:Label-->
														<span class="d-flex align-items-center me-2">
															<!--begin:Icon-->
															<span class="symbol symbol-50px me-6">
																<span class="symbol-label bg-light-primary">
																	<!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
																	<span class="svg-icon svg-icon-1 svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="black" />
																			<path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z" fill="black" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</span>
															<!--end:Icon-->
															<!--begin:Info-->
															<span class="d-flex flex-column">
																<span class="fw-bolder fs-6">Quick Online Courses</span>
																<span class="fs-7 text-muted">Creating a clear text structure is just one SEO</span>
															</span>
															<!--end:Info-->
														</span>
														<!--end:Label-->
														<!--begin:Input-->
														<span class="form-check form-check-custom form-check-solid">
															<input class="form-check-input" type="radio" name="category" value="1" />
														</span>
														<!--end:Input-->
													</label>
													<!--end::Option-->
													<!--begin:Option-->
													<label class="d-flex flex-stack mb-5 cursor-pointer">
														<!--begin:Label-->
														<span class="d-flex align-items-center me-2">
															<!--begin:Icon-->
															<span class="symbol symbol-50px me-6">
																<span class="symbol-label bg-light-danger">
																	<!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
																	<span class="svg-icon svg-icon-1 svg-icon-danger">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
																				<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																				<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																				<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																			</g>
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</span>
															<!--end:Icon-->
															<!--begin:Info-->
															<span class="d-flex flex-column">
																<span class="fw-bolder fs-6">Face to Face Discussions</span>
																<span class="fs-7 text-muted">Creating a clear text structure is just one aspect</span>
															</span>
															<!--end:Info-->
														</span>
														<!--end:Label-->
														<!--begin:Input-->
														<span class="form-check form-check-custom form-check-solid">
															<input class="form-check-input" type="radio" name="category" value="2" />
														</span>
														<!--end:Input-->
													</label>
													<!--end::Option-->
													<!--begin:Option-->
													<label class="d-flex flex-stack cursor-pointer">
														<!--begin:Label-->
														<span class="d-flex align-items-center me-2">
															<!--begin:Icon-->
															<span class="symbol symbol-50px me-6">
																<span class="symbol-label bg-light-success">
																	<!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
																	<span class="svg-icon svg-icon-1 svg-icon-success">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="black" />
																			<path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="black" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</span>
															<!--end:Icon-->
															<!--begin:Info-->
															<span class="d-flex flex-column">
																<span class="fw-bolder fs-6">Full Intro Training</span>
																<span class="fs-7 text-muted">Creating a clear text structure copywriting</span>
															</span>
															<!--end:Info-->
														</span>
														<!--end:Label-->
														<!--begin:Input-->
														<span class="form-check form-check-custom form-check-solid">
															<input class="form-check-input" type="radio" name="category" value="3" />
														</span>
														<!--end:Input-->
													</label>
													<!--end::Option-->
												</div>
												<!--end:Options-->
											</div>
											<!--end::Input group-->
										</div>
									</div>
									<!--end::Step 1-->
									<!--begin::Step 2-->
									<div data-kt-stepper-element="content">
										<div class="w-100">
											<!--begin::Input group-->
											<div class="fv-row">
												<!--begin::Label-->
												<label class="d-flex align-items-center fs-5 fw-bold mb-4">
													<span class="required">Select Framework</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify your apps framework"></i>
												</label>
												<!--end::Label-->
												<!--begin:Option-->
												<label class="d-flex flex-stack cursor-pointer mb-5">
													<!--begin:Label-->
													<span class="d-flex align-items-center me-2">
														<!--begin:Icon-->
														<span class="symbol symbol-50px me-6">
															<span class="symbol-label bg-light-warning">
																<i class="fab fa-html5 text-warning fs-2x"></i>
															</span>
														</span>
														<!--end:Icon-->
														<!--begin:Info-->
														<span class="d-flex flex-column">
															<span class="fw-bolder fs-6">HTML5</span>
															<span class="fs-7 text-muted">Base Web Projec</span>
														</span>
														<!--end:Info-->
													</span>
													<!--end:Label-->
													<!--begin:Input-->
													<span class="form-check form-check-custom form-check-solid">
														<input class="form-check-input" type="radio" checked="checked" name="framework" value="1" />
													</span>
													<!--end:Input-->
												</label>
												<!--end::Option-->
												<!--begin:Option-->
												<label class="d-flex flex-stack cursor-pointer mb-5">
													<!--begin:Label-->
													<span class="d-flex align-items-center me-2">
														<!--begin:Icon-->
														<span class="symbol symbol-50px me-6">
															<span class="symbol-label bg-light-success">
																<i class="fab fa-react text-success fs-2x"></i>
															</span>
														</span>
														<!--end:Icon-->
														<!--begin:Info-->
														<span class="d-flex flex-column">
															<span class="fw-bolder fs-6">ReactJS</span>
															<span class="fs-7 text-muted">Robust and flexible app framework</span>
														</span>
														<!--end:Info-->
													</span>
													<!--end:Label-->
													<!--begin:Input-->
													<span class="form-check form-check-custom form-check-solid">
														<input class="form-check-input" type="radio" name="framework" value="2" />
													</span>
													<!--end:Input-->
												</label>
												<!--end::Option-->
												<!--begin:Option-->
												<label class="d-flex flex-stack cursor-pointer mb-5">
													<!--begin:Label-->
													<span class="d-flex align-items-center me-2">
														<!--begin:Icon-->
														<span class="symbol symbol-50px me-6">
															<span class="symbol-label bg-light-danger">
																<i class="fab fa-angular text-danger fs-2x"></i>
															</span>
														</span>
														<!--end:Icon-->
														<!--begin:Info-->
														<span class="d-flex flex-column">
															<span class="fw-bolder fs-6">Angular</span>
															<span class="fs-7 text-muted">Powerful data mangement</span>
														</span>
														<!--end:Info-->
													</span>
													<!--end:Label-->
													<!--begin:Input-->
													<span class="form-check form-check-custom form-check-solid">
														<input class="form-check-input" type="radio" name="framework" value="3" />
													</span>
													<!--end:Input-->
												</label>
												<!--end::Option-->
												<!--begin:Option-->
												<label class="d-flex flex-stack cursor-pointer">
													<!--begin:Label-->
													<span class="d-flex align-items-center me-2">
														<!--begin:Icon-->
														<span class="symbol symbol-50px me-6">
															<span class="symbol-label bg-light-primary">
																<i class="fab fa-vuejs text-primary fs-2x"></i>
															</span>
														</span>
														<!--end:Icon-->
														<!--begin:Info-->
														<span class="d-flex flex-column">
															<span class="fw-bolder fs-6">Vue</span>
															<span class="fs-7 text-muted">Lightweight and responsive framework</span>
														</span>
														<!--end:Info-->
													</span>
													<!--end:Label-->
													<!--begin:Input-->
													<span class="form-check form-check-custom form-check-solid">
														<input class="form-check-input" type="radio" name="framework" value="4" />
													</span>
													<!--end:Input-->
												</label>
												<!--end::Option-->
											</div>
											<!--end::Input group-->
										</div>
									</div>
									<!--end::Step 2-->
									<!--begin::Step 3-->
									<div data-kt-stepper-element="content">
										<div class="w-100">
											<!--begin::Input group-->
											<div class="fv-row mb-10">
												<!--begin::Label-->
												<label class="required fs-5 fw-bold mb-2">Database Name</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="dbname" placeholder="" value="master_db" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="fv-row">
												<!--begin::Label-->
												<label class="d-flex align-items-center fs-5 fw-bold mb-4">
													<span class="required">Select Database Engine</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select your app database engine"></i>
												</label>
												<!--end::Label-->
												<!--begin:Option-->
												<label class="d-flex flex-stack cursor-pointer mb-5">
													<!--begin::Label-->
													<span class="d-flex align-items-center me-2">
														<!--begin::Icon-->
														<span class="symbol symbol-50px me-6">
															<span class="symbol-label bg-light-success">
																<i class="fas fa-database text-success fs-2x"></i>
															</span>
														</span>
														<!--end::Icon-->
														<!--begin::Info-->
														<span class="d-flex flex-column">
															<span class="fw-bolder fs-6">MySQL</span>
															<span class="fs-7 text-muted">Basic MySQL database</span>
														</span>
														<!--end::Info-->
													</span>
													<!--end::Label-->
													<!--begin::Input-->
													<span class="form-check form-check-custom form-check-solid">
														<input class="form-check-input" type="radio" name="dbengine" checked="checked" value="1" />
													</span>
													<!--end::Input-->
												</label>
												<!--end::Option-->
												<!--begin:Option-->
												<label class="d-flex flex-stack cursor-pointer mb-5">
													<!--begin::Label-->
													<span class="d-flex align-items-center me-2">
														<!--begin::Icon-->
														<span class="symbol symbol-50px me-6">
															<span class="symbol-label bg-light-danger">
																<i class="fab fa-google text-danger fs-2x"></i>
															</span>
														</span>
														<!--end::Icon-->
														<!--begin::Info-->
														<span class="d-flex flex-column">
															<span class="fw-bolder fs-6">Firebase</span>
															<span class="fs-7 text-muted">Google based app data management</span>
														</span>
														<!--end::Info-->
													</span>
													<!--end::Label-->
													<!--begin::Input-->
													<span class="form-check form-check-custom form-check-solid">
														<input class="form-check-input" type="radio" name="dbengine" value="2" />
													</span>
													<!--end::Input-->
												</label>
												<!--end::Option-->
												<!--begin:Option-->
												<label class="d-flex flex-stack cursor-pointer">
													<!--begin::Label-->
													<span class="d-flex align-items-center me-2">
														<!--begin::Icon-->
														<span class="symbol symbol-50px me-6">
															<span class="symbol-label bg-light-warning">
																<i class="fab fa-amazon text-warning fs-2x"></i>
															</span>
														</span>
														<!--end::Icon-->
														<!--begin::Info-->
														<span class="d-flex flex-column">
															<span class="fw-bolder fs-6">DynamoDB</span>
															<span class="fs-7 text-muted">Amazon Fast NoSQL Database</span>
														</span>
														<!--end::Info-->
													</span>
													<!--end::Label-->
													<!--begin::Input-->
													<span class="form-check form-check-custom form-check-solid">
														<input class="form-check-input" type="radio" name="dbengine" value="3" />
													</span>
													<!--end::Input-->
												</label>
												<!--end::Option-->
											</div>
											<!--end::Input group-->
										</div>
									</div>
									<!--end::Step 3-->
									<!--begin::Step 4-->
									<div data-kt-stepper-element="content">
										<div class="w-100">
											<!--begin::Input group-->
											<div class="d-flex flex-column mb-7 fv-row">
												<!--begin::Label-->
												<label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
													<span class="required">Name On Card</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a card holder's name"></i>
												</label>
												<!--end::Label-->
												<input type="text" class="form-control form-control-solid bdr-ccc" placeholder="" name="card_name" value="Max Doe" />
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="d-flex flex-column mb-7 fv-row">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold form-label mb-2">Card Number</label>
												<!--end::Label-->
												<!--begin::Input wrapper-->
												<div class="position-relative">
													<!--begin::Input-->
													<input type="text" class="form-control form-control-solid bdr-ccc" placeholder="Enter card number" name="card_number" value="4111 1111 1111 1111" />
													<!--end::Input-->
													<!--begin::Card logos-->
													<div class="position-absolute translate-middle-y top-50 end-0 me-5">
														<img src="assets/media/svg/card-logos/visa.svg" alt="" class="h-25px" />
														<img src="assets/media/svg/card-logos/mastercard.svg" alt="" class="h-25px" />
														<img src="assets/media/svg/card-logos/american-express.svg" alt="" class="h-25px" />
													</div>
													<!--end::Card logos-->
												</div>
												<!--end::Input wrapper-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="row mb-10">
												<!--begin::Col-->
												<div class="col-md-8 fv-row">
													<!--begin::Label-->
													<label class="required fs-6 fw-bold form-label mb-2">Expiration Date</label>
													<!--end::Label-->
													<!--begin::Row-->
													<div class="row fv-row">
														<!--begin::Col-->
														<div class="col-6">
															<select name="card_expiry_month" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Month">
																<option></option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8</option>
																<option value="9">9</option>
																<option value="10">10</option>
																<option value="11">11</option>
																<option value="12">12</option>
															</select>
														</div>
														<!--end::Col-->
														<!--begin::Col-->
														<div class="col-6">
															<select name="card_expiry_year" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Year">
																<option></option>
																<option value="2021">2021</option>
																<option value="2022">2022</option>
																<option value="2023">2023</option>
																<option value="2024">2024</option>
																<option value="2025">2025</option>
																<option value="2026">2026</option>
																<option value="2027">2027</option>
																<option value="2028">2028</option>
																<option value="2029">2029</option>
																<option value="2030">2030</option>
																<option value="2031">2031</option>
															</select>
														</div>
														<!--end::Col-->
													</div>
													<!--end::Row-->
												</div>
												<!--end::Col-->
												<!--begin::Col-->
												<div class="col-md-4 fv-row">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
														<span class="required">CVV</span>
														<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter a card CVV code"></i>
													</label>
													<!--end::Label-->
													<!--begin::Input wrapper-->
													<div class="position-relative">
														<!--begin::Input-->
														<input type="text" class="form-control form-control-solid bdr-ccc" minlength="3" maxlength="4" placeholder="CVV" name="card_cvv" />
														<!--end::Input-->
														<!--begin::CVV icon-->
														<div class="position-absolute translate-middle-y top-50 end-0 me-3">
															<!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
															<span class="svg-icon svg-icon-2hx">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path d="M22 7H2V11H22V7Z" fill="black" />
																	<path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" fill="black" />
																</svg>
															</span>
															<!--end::Svg Icon-->
														</div>
														<!--end::CVV icon-->
													</div>
													<!--end::Input wrapper-->
												</div>
												<!--end::Col-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="d-flex flex-stack">
												<!--begin::Label-->
												<div class="me-5">
													<label class="fs-6 fw-bold form-label">Save Card for further billing?</label>
													<div class="fs-7 fw-bold text-muted">If you need more info, please check budget planning</div>
												</div>
												<!--end::Label-->
												<!--begin::Switch-->
												<label class="form-check form-switch form-check-custom form-check-solid">
													<input class="form-check-input" type="checkbox" value="1" checked="checked" />
													<span class="form-check-label fw-bold text-muted">Save Card</span>
												</label>
												<!--end::Switch-->
											</div>
											<!--end::Input group-->
										</div>
									</div>
									<!--end::Step 4-->
									<!--begin::Step 5-->
									<div data-kt-stepper-element="content">
										<div class="w-100 text-center">
											<!--begin::Heading-->
											<h1 class="fw-bolder text-dark mb-3">Release!</h1>
											<!--end::Heading-->
											<!--begin::Description-->
											<div class="text-muted fw-bold fs-3">Submit your app to kickstart your project.</div>
											<!--end::Description-->
											<!--begin::Illustration-->
											<div class="text-center px-4 py-15">
												<img src="assets/media/illustrations/sketchy-1/9.png" alt="" class="w-100 mh-300px" />
											</div>
											<!--end::Illustration-->
										</div>
									</div>
									<!--end::Step 5-->
									<!--begin::Actions-->
									<div class="d-flex flex-stack pt-10">
										<!--begin::Wrapper-->
										<div class="me-2">
											<button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
											<span class="svg-icon svg-icon-3 me-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
													<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->Back</button>
										</div>
										<!--end::Wrapper-->
										<!--begin::Wrapper-->
										<div>
											<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
												<span class="indicator-label">Submit
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
												<span class="svg-icon svg-icon-3 ms-2 me-0">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
														<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon--></span>
												<span class="indicator-progress">Please wait...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
											</button>
											<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
											<span class="svg-icon svg-icon-3 ms-1 me-0">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
													<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon--></button>
										</div>
										<!--end::Wrapper-->
									</div>
									<!--end::Actions-->
								</form>
								<!--end::Form-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Stepper-->
					</div>
					<!--end::Modal body-->
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>
		<!--end::Modal - Create App-->
		<!--begin::Modal - Upgrade plan-->
		<div class="modal fade" id="kt_modal_upgrade_plan" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-xl">
				<!--begin::Modal content-->
				<div class="modal-content rounded">
					<!--begin::Modal header-->
					<div class="modal-header justify-content-end border-0 pb-0">
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
					<!--end::Modal header-->
					<!--begin::Modal body-->
					<div class="modal-body pt-0 pb-15 px-5 px-xl-20">
						<!--begin::Heading-->
						<div class="mb-13 text-center">
							<h1 class="mb-3">Upgrade a Plan</h1>
							<div class="text-muted fw-bold fs-5">If you need more info, please check
							<a href="#" class="link-primary fw-bolder">Pricing Guidelines</a>.</div>
						</div>
						<!--end::Heading-->
						<!--begin::Plans-->
						<div class="d-flex flex-column">
							<!--begin::Nav group-->
							<div class="nav-group nav-group-outline mx-auto" data-kt-buttons="true">
								<a href="#" class="btn btn-color-gray-400 btn-active btn-active-secondary px-6 py-3 me-2 active" data-kt-plan="month">Monthly</a>
								<a href="#" class="btn btn-color-gray-400 btn-active btn-active-secondary px-6 py-3" data-kt-plan="annual">Annual</a>
							</div>
							<!--end::Nav group-->
							<!--begin::Row-->
							<div class="row mt-10">
								<!--begin::Col-->
								<div class="col-lg-6 mb-10 mb-lg-0">
									<!--begin::Tabs-->
									<div class="nav flex-column">
										<!--begin::Tab link-->
										<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 active mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_startup">
											<!--end::Description-->
											<div class="d-flex align-items-center me-2">
												<!--begin::Radio-->
												<div class="form-check form-check-custom form-check-solid form-check-success me-6">
													<input class="form-check-input" type="radio" name="plan" checked="checked" value="startup" />
												</div>
												<!--end::Radio-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Startup</h2>
													<div class="fw-bold opacity-50">Best for startups</div>
												</div>
												<!--end::Info-->
											</div>
											<!--end::Description-->
											<!--begin::Price-->
											<div class="ms-5">
												<span class="mb-2">$</span>
												<span class="fs-3x fw-bolder" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">39</span>
												<span class="fs-7 opacity-50">/
												<span data-kt-element="period">Mon</span></span>
											</div>
											<!--end::Price-->
										</div>
										<!--end::Tab link-->
										<!--begin::Tab link-->
										<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_advanced">
											<!--end::Description-->
											<div class="d-flex align-items-center me-2">
												<!--begin::Radio-->
												<div class="form-check form-check-custom form-check-solid form-check-success me-6">
													<input class="form-check-input" type="radio" name="plan" value="advanced" />
												</div>
												<!--end::Radio-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Advanced</h2>
													<div class="fw-bold opacity-50">Best for 100+ team size</div>
												</div>
												<!--end::Info-->
											</div>
											<!--end::Description-->
											<!--begin::Price-->
											<div class="ms-5">
												<span class="mb-2">$</span>
												<span class="fs-3x fw-bolder" data-kt-plan-price-month="339" data-kt-plan-price-annual="3399">339</span>
												<span class="fs-7 opacity-50">/
												<span data-kt-element="period">Mon</span></span>
											</div>
											<!--end::Price-->
										</div>
										<!--end::Tab link-->
										<!--begin::Tab link-->
										<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_enterprise">
											<!--end::Description-->
											<div class="d-flex align-items-center me-2">
												<!--begin::Radio-->
												<div class="form-check form-check-custom form-check-solid form-check-success me-6">
													<input class="form-check-input" type="radio" name="plan" value="enterprise" />
												</div>
												<!--end::Radio-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Enterprise
													<span class="badge badge-light-success ms-2 fs-7">Most popular</span></h2>
													<div class="fw-bold opacity-50">Best value for 1000+ team</div>
												</div>
												<!--end::Info-->
											</div>
											<!--end::Description-->
											<!--begin::Price-->
											<div class="ms-5">
												<span class="mb-2">$</span>
												<span class="fs-3x fw-bolder" data-kt-plan-price-month="999" data-kt-plan-price-annual="9999">999</span>
												<span class="fs-7 opacity-50">/
												<span data-kt-element="period">Mon</span></span>
											</div>
											<!--end::Price-->
										</div>
										<!--end::Tab link-->
										<!--begin::Tab link-->
										<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark d-flex flex-stack text-start p-6">
											<!--end::Description-->
											<div class="d-flex align-items-center me-2">
												<!--begin::Radio-->
												<div class="form-check form-check-custom form-check-solid form-check-success me-6">
													<input class="form-check-input" type="radio" name="plan" value="custom" />
												</div>
												<!--end::Radio-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Custom</h2>
													<div class="fw-bold opacity-50">Requet a custom license</div>
												</div>
												<!--end::Info-->
											</div>
											<!--end::Description-->
											<!--begin::Price-->
											<div class="ms-5">
												<a href="#" class="btn btn-lg btn-primary">Contact Us</a>
											</div>
											<!--end::Price-->
										</div>
										<!--end::Tab link-->
									</div>
									<!--end::Tabs-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-lg-6">
									<!--begin::Tab content-->
									<div class="tab-content rounded h-100 bg-light p-10">
										<!--begin::Tab Pane-->
										<div class="tab-pane fade show active" id="kt_upgrade_plan_startup">
											<!--begin::Heading-->
											<div class="pb-5">
												<h2 class="fw-bolder text-dark">What’s in Startup Plan?</h2>
												<div class="text-muted fw-bold">Optimal for 10+ team size and new startup</div>
											</div>
											<!--end::Heading-->
											<!--begin::Body-->
											<div class="pt-1">
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 10 Active Users</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 30 Project Integrations</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Analytics Module</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-muted flex-grow-1">Finance Module</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
													<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black" />
															<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-muted flex-grow-1">Accounting Module</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
													<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black" />
															<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-muted flex-grow-1">Network Platform</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
													<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black" />
															<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center">
													<span class="fw-bold fs-5 text-muted flex-grow-1">Unlimited Cloud Space</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
													<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black" />
															<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Tab Pane-->
										<!--begin::Tab Pane-->
										<div class="tab-pane fade" id="kt_upgrade_plan_advanced">
											<!--begin::Heading-->
											<div class="pb-5">
												<h2 class="fw-bolder text-dark">What’s in Startup Plan?</h2>
												<div class="text-muted fw-bold">Optimal for 100+ team size and grown company</div>
											</div>
											<!--end::Heading-->
											<!--begin::Body-->
											<div class="pt-1">
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 10 Active Users</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 30 Project Integrations</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Analytics Module</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Finance Module</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Accounting Module</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-muted flex-grow-1">Network Platform</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
													<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black" />
															<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center">
													<span class="fw-bold fs-5 text-muted flex-grow-1">Unlimited Cloud Space</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
													<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black" />
															<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Tab Pane-->
										<!--begin::Tab Pane-->
										<div class="tab-pane fade" id="kt_upgrade_plan_enterprise">
											<!--begin::Heading-->
											<div class="pb-5">
												<h2 class="fw-bolder text-dark">What’s in Startup Plan?</h2>
												<div class="text-muted fw-bold">Optimal for 1000+ team and enterpise</div>
											</div>
											<!--end::Heading-->
											<!--begin::Body-->
											<div class="pt-1">
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 10 Active Users</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 30 Project Integrations</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Analytics Module</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Finance Module</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Accounting Module</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-7">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Network Platform</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center">
													<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Unlimited Cloud Space</span>
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Item-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Tab Pane-->
									</div>
									<!--end::Tab content-->
								</div>
								<!--end::Col-->
							</div>
							<!--end::Row-->
						</div>
						<!--end::Plans-->
						<!--begin::Actions-->
						<div class="d-flex flex-center flex-row-fluid pt-12">
							<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Upgrade Plan</button>
						</div>
						<!--end::Actions-->
					</div>
					<!--end::Modal body-->
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>
		<!--end::Modal - Upgrade plan--> --}}
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
		<!-- hidden More Whatsapp -->
		<div class="d-none" id="hiddenaddmoreWhatsapp">
			<div class="col-md-6 removableDiv">
				<!--begin::Label-->
				<label class="d-flex align-items-center fs-5 fw-bold mb-5">
					<span class="required">Mobile No <span class="compCount"></span></span>
				</label>
				<!--end::Label-->
				<div class="d-flex justify-conetent-end">
					<!--begin::Input-->
					<input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc" style="border-radius:5px 0px 0px 5px;" name="number[]" placeholder="" value="" style="    display: inline;
					width: 90%;" />
					<!--end::Input-->
						<button type="button" class="btn btn-primary btn-danger remove-btn" style="border-radius: 0px 5px 5px 0px;">
							<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 172 172"
								style=" fill:#000000;">
								<g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter"
									stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
									font-size="none" text-anchor="none" style="mix-blend-mode: normal">
									<path d="M0,172v-172h172v172z" fill="none"></path>
									<g fill="#ffffff">
										<path
											d="M28.66667,74.53333c-4.13529,-0.05848 -7.98173,2.11417 -10.06645,5.68601c-2.08471,3.57184 -2.08471,7.98948 0,11.56132c2.08471,3.57184 5.93115,5.74449 10.06645,5.68601h114.66667c4.13529,0.05848 7.98173,-2.11417 10.06645,-5.68601c2.08471,-3.57184 2.08471,-7.98948 0,-11.56132c-2.08471,-3.57184 -5.93115,-5.74449 -10.06645,-5.68601z">
										</path>
									</g>
								</g>
							</svg>
						</button>
				</div>
			</div>
		</div>

		<!-- hidden More Whatsapp Ends-->
		<!--end::Scrolltop-->
		<!--end::Main-->
		<!--end::Page Custom Javascript-->
		@section("jscript")
			<script>
				$(document).ready(function(){

					$('#user_role').select2({
						placeholder: 'Select a role'
					});

                    $("#profit_company_2").hide();
                    $("#profit_company_1").hide();

                    var company_1 = {{isset($user->company_first) && $user->company_first != '' ? $user->company_first : 0}};
                    var company_2 = {{isset($user->company_second) && $user->company_first != '' ? $user->company_second : 0}};
                    if (company_1 == 1) {
                        $("#profit_company_1").show();
                    } else {
                        $("#profit_company_1").hide();
                    }

                    if (company_2 == 1) {
                        $("#profit_company_2").show();
                    } else {
                        $("#profit_company_2").hide();
                    }


                    var userType = {{isset($user->user_type) ? $user->user_type : 0}};

                    if (userType == 1) {
                        $('#partnerDiv').show();
                        $('#employeeDiv').hide();
                        $('#freelancerPrimeDiv').hide();
                        $('#freelancerAmsDiv').hide();
                        $('#channelPartnerDiv').hide();
                    } else if (userType == 2) {
                        $('#employeeDiv').show();
                        $('#partnerDiv').hide();
                        $('#freelancerPrimeDiv').hide();
                        $('#freelancerAmsDiv').hide();
                        $('#channelPartnerDiv').hide();
                    } else if (userType == 3) {
                        $('#employeeDiv').hide();
                        $('#partnerDiv').hide();
                        $('#freelancerPrimeDiv').hide();
                        $('#freelancerAmsDiv').hide();
                        $('#channelPartnerDiv').show();
                    } else if (userType == 4) {
                        $('#employeeDiv').hide();
                        $('#partnerDiv').hide();
                        $('#freelancerPrimeDiv').hide();
                        $('#freelancerAmsDiv').show();
                        $('#channelPartnerDiv').hide();
                    } else if (userType == 5) {
                        $('#employeeDiv').hide();
                        $('#partnerDiv').hide();
                        $('#freelancerPrimeDiv').show();
                        $('#freelancerAmsDiv').hide();
                        $('#channelPartnerDiv').hide();
                    }

					$(document).on("click","#addmoreWhatsapp",function() {
						var newcomp1 = $('#hiddenaddmoreWhatsapp').html();
						// console.log(newcomp1);
						$('.custom_appendDiv').append(newcomp1);
						resetCounter();
					});

					$(document).on("click",".remove-btn",function() {
						$(this).closest(".removableDiv").remove();
						resetCounter();
					})
				});

				function resetCounter() {
					counter = 2;
					$('#appendDivWp').find('.compCount').each(function() {
						$(this).text(counter);
						counter++;
					})
				}


				// current date

				function getCurrentDate(){
					today_date = new Date();

					today_Date_Str = ((today_date.getDate() < 10) ? "0" : "") + String(today_date.getDate()) + "-" +((today_date.getMonth() < 9) ? "0" : "") + String(today_date.getMonth() + 1)+ "-" +today_date.getFullYear();

					return today_Date_Str;
					}

					// $(function() {
					// 	$(".c-date").datepicker({
					// 	dateFormat: "dd-mm-yy",
					// 	numberOfMonths:[1,2],
					// 	minDate: new Date(),
					// 	// gotoCurrent: true
					// 	});
					// });
					$(function() {
						var date = new Date(); // replace with your date
						$(".c-date").val(getCurrentDate());
					});

				// current date end


                $(document).on('click', '.toggleUserType', function() {
                    //alert($('.toggleUserType:checked').val());

                    if($('.toggleUserType:checked').val() == 1) {
                        $(this).closest('#professionalDetails').find('#partnerDiv').show();
                        $(this).closest('#professionalDetails').find('#employeeDiv').hide();
                        $(this).closest('#professionalDetails').find('#freelancerPrimeDiv').hide();
                        $(this).closest('#professionalDetails').find('#freelancerAmsDiv').hide();
                        $(this).closest('#professionalDetails').find('#channelPartnerDiv').hide();
                    } else if($('.toggleUserType:checked').val() == 2) {
                        $(this).closest('#professionalDetails').find('#employeeDiv').show();
                        $(this).closest('#professionalDetails').find('#partnerDiv').hide();
                        $(this).closest('#professionalDetails').find('#freelancerPrimeDiv').hide();
                        $(this).closest('#professionalDetails').find('#freelancerAmsDiv').hide();
                        $(this).closest('#professionalDetails').find('#channelPartnerDiv').hide();
                    }else if($('.toggleUserType:checked').val() == 3 ) {
                        $(this).closest('#professionalDetails').find('#employeeDiv').hide();
                        $(this).closest('#professionalDetails').find('#partnerDiv').hide();
                        $(this).closest('#professionalDetails').find('#freelancerPrimeDiv').hide();
                        $(this).closest('#professionalDetails').find('#freelancerAmsDiv').hide();
                        $(this).closest('#professionalDetails').find('#channelPartnerDiv').show();
                    }else if($('.toggleUserType:checked').val() == 4) {
                        $(this).closest('#professionalDetails').find('#employeeDiv').hide();
                        $(this).closest('#professionalDetails').find('#partnerDiv').hide();
                        $(this).closest('#professionalDetails').find('#freelancerPrimeDiv').hide();
                        $(this).closest('#professionalDetails').find('#freelancerAmsDiv').show();
                        $(this).closest('#professionalDetails').find('#channelPartnerDiv').hide();
                    }else if($('.toggleUserType:checked').val() == 5) {
                        $(this).closest('#professionalDetails').find('#employeeDiv').hide();
                        $(this).closest('#professionalDetails').find('#partnerDiv').hide();
                        $(this).closest('#professionalDetails').find('#freelancerPrimeDiv').show();
                        $(this).closest('#professionalDetails').find('#freelancerAmsDiv').hide();
                        $(this).closest('#professionalDetails').find('#channelPartnerDiv').hide();
                    }
                });


                $('#company_1').click(function () {
                    if ($(this).is(':checked') == true) {
                        $("#profit_company_1").show();
                    }else{
                        $("#profit_company_1").hide();
                    }
                });

                $('#company_2').click(function () {
                    if ($(this).is(':checked') == true) {
                        $("#profit_company_2").show();
                    }else{
                        $("#profit_company_2").hide();
                    }
                });
				const getPermissionByRole = async role =>{
					let permissions = null;
					let allpermissions = null;
					if(typeof role == "string" && role != ""){
						await $.ajax(`/permissionByRole/${role}`,{
							type: "GET",
						})
						.done(data=>{
							if(data.status == 200 && data.data!=""){
								permissions = data.data.permissions;
								allpermissions = data.data.all_permissions;
							}else{
								window.alert(`Unable to get permissions for ${role} Role`);
							}
						})
					}
					// getPermissionByRole.resolve(permissions,allpermissions)
					return {permissions:permissions,allpermissions:allpermissions};
				};
				// on role change
				$(document).on("change","#user_role",function(e){
					const role = $("#user_role").val();
					if(role){
						$("#manual_permission").html("");
						const modules = ["Client","Role","User","Analysis","Call","Trader","Monitor","Client Demat","Monitor Data","Report","Freelancer Data","Freelancer","Channel Partner Data","Channel Partner","Keyword","Trader Data","Setup"];
						let module_index = 0;
						getPermissionByRole(role).then((response)=>{
							if(typeof response['permissions'] != null){
								let html = `
									<div class="row">
										<div class="col-12">
											<h4>${role}</h4>
										</div>
										<div class="col-12">`;
											html += `
												<div class="row">
													<div class="col-md-4">
														<label>Module</label>
													</div>
													<div class="col-md-2">
														<label>Read</label>
													</div>
													<div class="col-md-2">
														<label>Write</label>
													</div>
													<div class="col-md-2">
														<label>Create</label>
													</div>
													<div class="col-md-2">
														<label>Delete</label>
													</div>
												</div>
											`;
											response['allpermissions'].forEach((value,key)=>{
												if(key%4==0){
													if(modules[module_index]){
														html+=` <div class='row form-check form-check-custom form-check-solid my-2'>
																	<div class="col-md-4">
																		<label>${modules[module_index]}</label>
																	</div>`;
																module_index++;
																html +=`
																<div class="col-md-2">
																	<input type="checkbox" class='form-check-input' name="permissions[]" value='${response['allpermissions'][key].name}' ${($.inArray(response['allpermissions'][key].name, response['permissions']) !== -1)?"checked":""}>
																</div>
																<div class="col-md-2">
																	<input type="checkbox" class='form-check-input' name="permissions[]" value='${response['allpermissions'][key+1].name}' ${($.inArray(response['allpermissions'][key+1].name, response['permissions']) !== -1)?"checked":""}>
																</div>
																<div class="col-md-2">
																	<input type="checkbox" class='form-check-input' name="permissions[]" value='${response['allpermissions'][key+2].name}' ${($.inArray(response['allpermissions'][key+2].name, response['permissions']) !== -1)?"checked":""}>
																</div>
																<div class="col-md-2">
																	<input type="checkbox" class='form-check-input' name="permissions[]" value='${response['allpermissions'][key+3].name}' ${($.inArray(response['allpermissions'][key+3].name, response['permissions']) !== -1)?"checked":""}>
																</div>
															</div>`;
													}
												}
											})
								html += `</div></div>`;
								// display permissions
								$("#manual_permission").append(html);
							}
							module_index=0;
						});
					}
				})
			</script>
		@endsection
@endsection

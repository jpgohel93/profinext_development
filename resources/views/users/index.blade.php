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
									<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Add User</h1>
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
								@can("user-create")
								<!--begin::Form-->
								<form class="form" novalidate="novalidate" action="{{route('createUserForm')}}" method="POST" id="kt_modal_create_app_form">
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
														<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("name")}}" name="name" placeholder=""  />
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
														<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("email")}}" name="email" placeholder=""  />
														<!--end::Input-->
													</div>
												</div>

												<div class="row d-flex align-items-end mb-5 custom_appendDiv">
													<!--begin::Input group-->
													<div class="col-md-6 col-sm-12 mb-5">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span class="required">Password</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old('password')}}" name="password" />
														<!--end::Input-->
													</div>
													@if (null!==old("number"))
														@foreach (old("number") as $key => $number)
															@if ($key==0)
																<!--begin::Input group-->
																<div class="col-md-6 col-sm-12 mb-5">
																	<!--begin::Label-->
																	<label class="d-flex align-items-center fs-5 fw-bold mb-2">
																		<span class="required">Mobile Number <span class="compCount">{{1}}</span></span>
																	</label>
																	<!--end::Label-->
																	<div class="d-flex justify-conetent-end">
																		<!--begin::Input-->
																		<input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc" style="border-radius:5px 0px 0px 5px;" value="{{old('number')[0]}}" name="number[]" placeholder=""  style="    display: inline;
																		width: 90%;" />
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
															@else
																<div class="col-md-6 col-sm-12 mb-5">
																	<!--begin::Label-->
																	<label class="d-flex align-items-center fs-5 fw-bold mb-2">
																		<span class="required">Mobile Number <span class="compCount">{{$key+1}}</span></span>
																	</label>
																	<!--end::Label-->
																	<div class="d-flex justify-conetent-end">
																		<!--begin::Input-->
																		<input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc" style="border-radius:5px 0px 0px 5px;" value="{{old('number')[$key]}}" name="number[]" placeholder=""  style="    display: inline;
																		width: 90%;" />
																		<button type="button" class="btn btn-primary btn-danger remove-btn" style="border-radius: 0px 5px 5px 0px;">
																			<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 172 172" style=" fill:#000000;">
																				<g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
																					<path d="M0,172v-172h172v172z" fill="none"></path>
																					<g fill="#ffffff">
																						<path d="M28.66667,74.53333c-4.13529,-0.05848 -7.98173,2.11417 -10.06645,5.68601c-2.08471,3.57184 -2.08471,7.98948 0,11.56132c2.08471,3.57184 5.93115,5.74449 10.06645,5.68601h114.66667c4.13529,0.05848 7.98173,-2.11417 10.06645,-5.68601c2.08471,-3.57184 2.08471,-7.98948 0,-11.56132c-2.08471,-3.57184 -5.93115,-5.74449 -10.06645,-5.68601z">
																						</path>
																					</g>
																				</g>
																			</svg>
																		</button>
																	</div>
																</div>
															@endif
														@endforeach
													@else
														<!--begin::Input group-->
														<div class="col-md-6 col-sm-12 mb-5">
															<!--begin::Label-->
															<label class="d-flex align-items-center fs-5 fw-bold mb-2">
																<span class="required">Mobile Number <span class="compCount"></span></span>
															</label>
															<!--end::Label-->
															<div class="d-flex justify-conetent-end">
																<!--begin::Input-->
																<input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc" style="border-radius:5px 0px 0px 5px;" name="number[]" placeholder=""  style="    display: inline;
																width: 90%;" />
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
													@endif
												<!--end::Input group-->
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
													<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("bank_name")}}" name="bank_name" placeholder=""  />
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
													<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("account_number")}}" name="account_number" placeholder=""  />
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
													<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("ifsc_code")}}" name="ifsc_code" placeholder=""  />
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
															<option value="{{$account_type->account_type}}" {{(old('account_type') && old('account_type')==$account_type->account_type)?"selected":""}}>{{$account_type->account_type}}</option>
														@empty
															<option>Selecte Account Type</option>
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
                                                            <input class="form-check-input toggleUserType" type="radio" name="user_type" {{(old('user_type')== 1?"checked":(old('user_type')!=2?"checked":""))}} value="1">
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
                                                            <input class="form-check-input toggleUserType" type="radio" name="user_type" {{(old('user_type')== 2?"checked":(old('user_type')!=1?"checked":""))}} value="2">
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
                                                            <input class="form-check-input toggleUserType" type="radio" name="user_type" value="3">
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
                                                            <input class="form-check-input toggleUserType" type="radio" name="user_type" value="4">
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
                                                            <input class="form-check-input toggleUserType" type="radio" name="user_type" value="5">
                                                        </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                                <!--end::Col-->
                                            </div>


                                            <div class="row" id="partnerDiv" style="display:{{(old('user_type')==1)?"flex":"none"}};">
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
                                                            <input class="form-check-input toggleUserType" type="checkbox" id="company_1"  name="company_1" value="1">
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
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("percentage")}}" name="profit_company_1" placeholder="Profit Percentage"  />
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
                                                            <input class="form-check-input toggleUserType" type="checkbox" id="company_2" name="company_2" value="1">
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
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("percentage")}}" name="profit_company_2" placeholder="Profit Percentage"  />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                            </div>

                                            <div class="row" id="employeeDiv" style="display:{{(old('user_type')==2)?"flex":(old('user_type')!=1?"flex":"none")}};">

                                                <!--begin::Input group-->
												<div class="col-md-6 mb-5">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Salary</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("salary")}}" name="salary" placeholder=""  />
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
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("percentage")}}" name="fees_percentage" placeholder="Percentage of fees"  />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <div class="col-md-6 mb-4">
                                                        <!--begin::Label-->
                                                        <label class="required fs-5 fw-bold mb-2">Limit</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="limit" class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="Limit"/>
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
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("percentage")}}" name="ams_new_client_profit" placeholder="Percentage For AMS New Client"  />
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
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("percentage")}}" name="percentage" placeholder="Percentage of profit sharing"  />
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
                                                        <input type="number" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("percentage")}}" name="ams_new_client_percentage" placeholder="Percentage For AMS New Client"  />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <div class="col-md-6 mb-4">
                                                        <!--begin::Label-->
                                                        <label class="required fs-5 fw-bold mb-2">Percentage For AMS Renewal Client</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="ams_renewal_client_percentage" class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="Percentage For AMS Renewal Client"/>
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
                                                        <input type="number" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{old("percentage")}}" name="prime_new_client_percentage" placeholder="Percentage For Prime New Client"  />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <div class="col-md-6 mb-4">
                                                        <!--begin::Label-->
                                                        <label class="required fs-5 fw-bold mb-2">Percentage For Prime Renewal Client</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" name="prime_renewal_client_percentage"  class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="Percentage For Prime Renewal Client"/>
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
													<textarea class="form-control form-control-lg form-control-solid bdr-ccc" name="job_description">{{old("job_description")}}</textarea>
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
                                                    <select name="role[]" id="user_role" aria-label="Select a role" class="form-control" data-placeholder="Select Role">
                                                        <option></option>
														@forelse ($roles as $role)
                                                        	<option value="{{$role->name}}" {{old('role')==$role->name?"selected":""}}>{{$role->name}}</option>
														@empty
															<option>Please Add Role</option>
														@endforelse
                                                    </select>
													<!--end::Input-->
												</div>
												<div class="col-md-6 col-sm-12 mb-5">
													
												</div>
												<div class="col-12" id="manual_permission">
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
					<input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc" style="border-radius:5px 0px 0px 5px;" name="number[]" placeholder=""  style="    display: inline;
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

		@section("jscript")
			<script>
				$(document).ready(function(){

                    $("#profit_company_2").hide();
                    $("#profit_company_1").hide();

					$('#user_role').select2({
						placeholder: 'Select a role'
					});

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
					return {permissions:permissions,allpermissions:allpermissions};
				};
				// on role change
				$(document).on("change", "#user_role",function(e){
					const role = $(this).val();
					if(role){
						$("#manual_permission").html("");
                        const modules = @json(Config::get("constants.Permissions"));
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
															module_index++;
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

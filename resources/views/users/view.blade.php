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
									<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">View User</h1>
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
								@can("user-read")
                                    @if ($user->id)
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
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->name}}" name="name" placeholder="" value="" readonly />
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
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->email}}" name="email" placeholder="" value="" readonly />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>



                                                <div class="row d-flex align-items-end mb-5 custom_appendDiv">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Mobile Number <span class="compCount"></span></span>
                                                    </label>
                                                    <!--end::Label-->
                                                    @forelse ($user->numbers as $number)
                                                        <!--begin::Input group-->
                                                        <div class="col-md-6 col-sm-12 mb-5">
                                                            <div class="d-flex justify-conetent-end">
                                                                <!--begin::Input-->
                                                                <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc" style="border-radius:5px 0px 0px 5px;" value="{{$number}}" style="display: inline;width: 90%;" readonly />
                                                            </div>
                                                        </div>
                                                        <!--end::Input group-->
                                                    @empty
                                                        <h1>0 Numbers Found</h1>
                                                    @endforelse
                                                </div>
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
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->bank_name}}" name="bank_name" placeholder="" value="" readonly />
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
                                                    <input type="number" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->account_number}}" name="account_number" placeholder="" value="" readonly />
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
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->ifsc_code}}" name="ifsc_code" placeholder="" value="" readonly />
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
                                                    @php
                                                        $account_type = (($user->account_type==1)?"Saving Account":"Current Account");
                                                    @endphp
                                                    <input type="text" class="form-select form-select-sm form-select-solid" value="{{$account_type}}" readonly>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>

                                            <div class="row">
                                                <!--begin::Input group-->
                                                <div class="col-md-6 col-sm-12 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span>Date Of Birth</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="date" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->dob}}" name="dob" placeholder="" readonly/>
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
                                                @if ($user->user_type=='1')
                                                <!--begin::Col-->
                                                <div class="col-md-12 mb-4 fv-row">
                                                    <div class="col-md-6">
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
                                                                <input class="form-check-input toggleUserType" type="radio" name="user_type" checked="checked" value="1">
                                                            </span>
                                                            <!--end::Input-->
                                                        </label>
                                                        <!--end::Option-->
                                                    </div>
                                                </div>
												<div class="row" id="partnerDiv" style="display:flex;">
													<div class="col-md-12">
														<!--begin::Input group-->
														<div class="col-md-6 mb-5">
															<!--begin::Label-->
															<label class="d-flex align-items-center fs-5 fw-bold mb-2">
																<span class="required">Company</span>
															</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->company}}" name="company" placeholder="" value="" readonly />
															<!--end::Input-->
														</div>
														<!--end::Input group-->

														<!--begin::Input group-->
														<div class="col-md-6 mb-5">
															<!--begin::Label-->
															<label class="d-flex align-items-center fs-5 fw-bold mb-2">
																<span class="required">Percentage</span>
															</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->percentage}}" name="percentage" placeholder="" value="" readonly />
															<!--end::Input-->
														</div>
														<!--end::Input group-->
													</div>
												</div>
                                                @elseif($user->user_type=='2')
													<div class="col-md-6">
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
																<input class="form-check-input toggleUserType" type="radio" name="user_type" value="2" checked="checked">
															</span>
															<!--end::Input-->
														</label>
														<!--end::Option-->
													</div></div>
													<div class="row" id="employeeDiv">
														<!--begin::Input group-->
														<div class="col-md-6 mb-5">
															<!--begin::Label-->
															<label class="d-flex align-items-center fs-5 fw-bold mb-2">
																<span class="required">Salary</span>
															</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="{{$user->salary}}" name="salary" placeholder="" value="" readonly />
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
                                                @elseif($user->user_type=='3')
                                                <div class="col-md-6">
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
																<input class="form-check-input toggleUserType" type="radio" name="user_type" value="3" checked="checked">
															</span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div></div>
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
                                            @elseif($user->user_type=='4')
                                                <div class="col-md-6">
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
                                                                    <input class="form-check-input toggleUserType" type="radio" name="user_type" value="3" checked="checked">
                                                                </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div></div>
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
                                            @elseif($user->user_type=='5')
                                                <div class="col-md-6">
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
                                                                    <input class="form-check-input toggleUserType" type="radio" name="user_type" value="3" checked="checked">
                                                                </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div></div>
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
                                                @endif
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
                                                    <textarea class="form-control form-control-lg form-control-solid bdr-ccc" name="job_description" readonly>{{$user->job_description}}</textarea>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="col-md-12 col-sm-12 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Roles</span>
                                                    </label>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input class="form-select form-select-sm form-select-solid" readonly value="{{$user->role}}">
                                                            <!--end::Input-->
                                                        </div>
                                                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                                                            <div class="wrapper">
                                                                <input type="checkbox" class="form-check-input mx-2" id="selectAll" disabled>
                                                                <label class="" for="selectAll">All</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
												<div class="mb-0 table-responsive">
												<!--begin::Label-->
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Permissioins</span>
												</label>
												<!-- <h3 class="stepper-title">Permissioins</h4> -->
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
													<tbody role="rowgroup" id="permissionsContainer">
														@php
															// here we'll get all modules name
															$permissions_constant = Config::get("constants.Permissions");
															// each modules has 4 permissions
															$permissions_constant_count = count($permissions_constant)*4;
															// module counter
															$module_counter= 0;
														@endphp
														@for ($i = 0; $i < $permissions_constant_count; $i++)
															@if($i%4==0)
																<tr role="row" class="">
																	<td aria-colindex="1" role="cell" class=""> {{$permissions_constant[$module_counter]}} </td>
																	<td aria-colindex="2" role="cell" class="">
																		<div class="form-check form-check-custom form-check-solid">
																			<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{$permissions[$i]['name']}}" {{(in_array($permissions[$i+1]['name'],$rolePermissions))? 'checked':""}} id="__BVID__675">
																			<label class="custom-control-label" for="__BVID__675"></label>
																		</div>
																	</td>
																	<td aria-colindex="2" role="cell" class="">
																		<div class="form-check form-check-custom form-check-solid">
																			<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{$permissions[$i+1]['name']}}" {{(in_array($permissions[$i+2]['name'],$rolePermissions))? 'checked':""}} id="__BVID__675">
																			<label class="custom-control-label" for="__BVID__675"></label>
																		</div>
																	</td>
																	<td aria-colindex="2" role="cell" class="">
																		<div class="form-check form-check-custom form-check-solid">
																			<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{$permissions[$i+2]['name']}}" {{(in_array($permissions[$i+1]['name'],$rolePermissions))? 'checked':""}} id="__BVID__675">
																			<label class="custom-control-label" for="__BVID__675"></label>
																		</div>
																	</td>
																	<td aria-colindex="2" role="cell" class="">
																		<div class="form-check form-check-custom form-check-solid">
																			<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{$permissions[$i+3]['name']}}" {{(in_array($permissions[$i+1]['name'],$rolePermissions))? 'checked':""}} id="__BVID__675">
																			<label class="custom-control-label" for="__BVID__675"></label>
																		</div>
																	</td>
																</tr>
																@php
																	$module_counter++;
																@endphp
															@endif
														@endfor
													</tbody>
													<!---->
												</table>
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
                                    </div>
                                    <!--end::Actions-->
                                    @else
                                        <h1>Invalid User ID</h1>
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
					<input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc" style="border-radius:5px 0px 0px 5px;" name="number[]" placeholder="" value="" readonly style="    display: inline;
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

		<!--end::Page Custom Javascript-->
		@section("jscript")
			<script>
				$(document).ready(function(){
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

					$(function() {
						$(".c-date").datepicker({
						dateFormat: "dd-mm-yy",
						numberOfMonths:[1,2],
						minDate: new Date(),
						// gotoCurrent: true
						});
					});
					$(function() {
						var date = new Date(); // replace with your date
						$(".c-date").val(getCurrentDate());
					});

				// current date end



				$(document).on('click', '.toggleUserType', function() {
					// alert("Hello");

					if($('.toggleUserType:checked').val() == 1) {
						$(this).closest('#professionalDetails').find('#partnerDiv').show();
						$(this).closest('#professionalDetails').find('#employeeDiv').hide();
					} else {
						console.log('not checked');
						$(this).closest('#professionalDetails').find('#employeeDiv').show();
						$(this).closest('#professionalDetails').find('#partnerDiv').hide();
					}
				});
                // check if user has all permissions
                function checkPermissions(){
                    // user not have all permissions
                    let flag = false;
                    $("#selectAll").prop("checked",false);
                    $("#permissionsContainer").find(".permissionCheckBox").each((i,v)=>{
                        if($(v).is(":checked")===false){
                            flag = false;
                            return false;
                        }else{
                            flag = true;
                        }
                    });
                    if(flag){
                        $("#selectAll").prop("checked",true);
                    }else{
                        $("#selectAll").prop("checked",false);
                    }
                }
                $(document).on("click",".permissionCheckBox",function(){
                    checkPermissions();
                });
                checkPermissions();
			</script>
		@endsection
@endsection

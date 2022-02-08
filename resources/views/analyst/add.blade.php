@extends('layout')
@section("page-title","Add Analst")
@section("analyst","active")
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
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Add Analysts
                                </h1>
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
                            <!--begin::Form-->
                            <form class="form" novalidate="novalidate" action='{{route('createAnalyst')}}' method='post' id="kt_modal_create_app_form">
                                @csrf
                                <!--begin::Step 1-->
                                <div class="current d-block card p-7 my-5" data-kt-stepper-element="content">
                                    <div class="w-100">
                                        <div class="stepper-label mt-0" style="margin-top:30px;margin-bottom:20px;">
                                            <h3 class="stepper-title text-primary">Personal Details</h3>
                                        </div>
                                        <div class="mb-4">
                                            <!--begin::Input group-->
                                            <div class="col-12 mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Name of Analyst</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="analyst" placeholder="" value="{{old('analyst')}}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <div class="row d-flex align-items-end mb-5 custom_appendDiv">
                                                
                                            <!--begin::Input group-->
                                            <div class="col-6">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">WhatsApp No <span class="compCount"></span></span>
                                                </label>
                                                <!--end::Label-->
                                                <div class="d-flex justify-conetent-end">
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="numbers[]" placeholder="" value="" style="display: inline; width: 90%;" />
                                                    <!--end::Input-->
                                                    <button type="button" class="btn btn-primary addremwpnum" id="addmoreWhatsapp">
                                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="14" height="14" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M82.41667,7.16667c-1.978,0 -3.58333,1.60533 -3.58333,3.58333v75.25h-75.25c-1.978,0 -3.58333,1.60533 -3.58333,3.58333c0,1.978 1.60533,3.58333 3.58333,3.58333h75.25v75.25c0,1.978 1.60533,3.58333 3.58333,3.58333c1.978,0 3.58333,-1.60533 3.58333,-3.58333v-75.25h75.25c1.978,0 3.58333,-1.60533 3.58333,-3.58333c0,-1.978 -1.60533,-3.58333 -3.58333,-3.58333h-75.25v-75.25c0,-1.978 -1.60533,-3.58333 -3.58333,-3.58333z"></path></g></g></svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            </div>

                                            <div id="appendDivWp"></div>
                                        </div>
                                        <div class="row mb-4">
                                            
                                        <!--begin::Input group-->
                                        <div class="col-4">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Telegram User ID</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="telegram_id" placeholder="" value="{{old('telegram_id')}}" />
                                            <!--end::Input-->
                                        </div>
                                        
                                            
                                        <!--begin::Input group-->
                                        <div class="col-4">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">YouTube</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="youtube" placeholder="" value="{{old('youtube')}}" />
                                            <!--end::Input-->
                                        </div>

                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="col-4">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Website</span>
                                                <div class="form-check form-check-custom form-check-solid small" style="margin-left: auto;">
                                                    <input class="form-check-input" type="checkbox" value="1" name='has_website' {{(old('has_website'))?"checked":""}} id="flexCheckDefault"/>
                                                </div>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="website" placeholder="" value="{{(old('has_website'))?old('website'):""}}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="col-4">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Status</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="status" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Status">
                                                <option></option>
                                                <option value="Active" {{(old('status')=="Active")?"selected":""}}>Active</option>
                                                <option value="Experiment" {{(old('status')=="Experiment")?"selected":""}}>Experiment</option>
                                                <option value="Paper Trade" {{(old('status')=="Paper Trade")?"selected":""}}>Paper Trade</option>
                                                <option value="Terminated" {{(old('status')=="Terminated")?"selected":""}}>Terminated</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Step 1-->
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
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            Submit
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                            <span class="svg-icon svg-icon-3 ms-1 me-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                            <!-- hidden More Whatsapp -->
                            <div class="d-none" id="hiddenaddmoreWhatsapp">
                                <div class="col-6 removableDiv">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">WhatsApp No <span class="compCount"></span></span>
                                    </label>
                                    <!--end::Label-->
                                    <div class="d-flex justify-conetent-end">
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="numbers[]" placeholder="" value="" style="display: inline; width: 90%;" />
                                        <!--end::Input-->
                                        <button type="button" class="btn btn-primary btn-pink remove-btn addremwpnum">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="14" height="14" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M21.5,78.83333v14.33333h129v-14.33333z"></path></g></g></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- hidden More Whatsapp Ends-->
                        </div>
                        <!--end::Content-->
                    </div>
                </div>
                <!--begin::Footer-->
                @include("footer")
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--begin::Modals-->   
		<!--begin::Modal - Add client-->
		<div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered mw-900px">
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
                        @can("client-create")
						<div data-scroll="true" data-height="300">
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
												<h3 class="stepper-title">Personal Details</h3>
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
												<h3 class="stepper-title">Demat Details</h3>
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
												<h3 class="stepper-title">Payment Details</h3>
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
												<h3 class="stepper-title">Completed</h3>
												<div class="stepper-desc">Review and Submit</div>
											</div>
											<!--end::Label-->
										</div>
										<!--end::Step 4-->
									</div>
									<!--end::Nav-->
								</div>
								<!--begin::Aside-->
								<!--begin::Content-->
								<div class="flex-row-fluid px-lg-15">
									<!--begin::Form-->
									<form class="form" novalidate="novalidate" id="kt_modal_create_app_form" action="/clients/add" method="POST">
                                        @csrf
										<!--begin::Step 1-->
										<div class="current" data-kt-stepper-element="content">
											<div class="w-100">
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Client Name</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid" name="client[name]" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Mobile No.</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="tel" class="form-control form-control-lg form-control-solid" name="client[number]" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Communication with</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid" name="client[communication_with]" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">WhatsApp No.</span>
														<div class="form-check form-check-custom form-check-solid small" style="margin-left: auto;">
														    <input class="form-check-input" type="checkbox" name="client[wp_number_same]" id="flexCheckDefault"/>
														    <label class="form-check-label" for="flexCheckDefault">
														        (Select if WhatsApp No. is same as Mobile No.)
														    </label>
														</div>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="tel" class="form-control form-control-lg form-control-solid" name="client[wp_number]" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Profession</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<select name="client[profession]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Profession">
														<option></option>
														<option value="Business Man">Business Man</option>
														<option value="Professional">Professional</option>
														<option value="Govt Job">Govt Job</option>
														<option value="Private Job">Private Job</option>
														<option value="Student">Student</option>
														<option value="House wife">House wife</option> 
													</select>
													<!--end::Input-->
												</div>
												<!--end::Input group-->
											</div>
										</div>
										<!--end::Step 1-->
										<!--begin::Step 2-->
										<div class="pending" data-kt-stepper-element="content">
											<div class="w-100">
												<!--begin::Input group-->
												<div class="row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-3">
														<span class="required">Smart ID</span>
													</label>
													<!--end::Label-->
													<!--begin::Col-->
													<div class="col-md-5 fv-row">
														<!--begin::Label-->
														<label class="required fs-6 fw-bold form-label mb-2">ST/SG</label>
														<!--end::Label-->
														<!--begin::Input wrapper-->
														<div class="position-relative">
															<!--begin::Input-->
															<select name="demat[st_sg]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="ST/SG">
																<option></option>
																<option value="ST">ST</option>
																<option value="SG">SG</option> 
															</select>
														</div>
														<!--end::Input wrapper-->
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col-md-7 fv-row">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
															<span class="required">Serial Number</span>
														</label>
														<!--end::Label-->
														<!--begin::Input wrapper-->
														<div class="position-relative">
															<!--begin::Input-->
															<input type="text" name="demat[serial_number]" class="form-control form-control-solid" minlength="8" maxlength="10" placeholder="Serial No" />
															<!--end::Input--> 
														</div>
														<!--end::Input wrapper-->
													</div>
													<!--end::Col-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-3">
														<span class="required">Service Type</span>
													</label>
													<!--end::Label-->
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<!--begin:Option-->
														<label class="d-flex flex-stack cursor-pointer mb-5">
															<!--begin::Label-->
															<span class="d-flex align-items-center me-2"> 
																<!--begin::Info-->
																<span class="d-flex flex-column">
																	<span class="fw-bolder fs-6">Prime</span>
																</span>
																<!--end::Info-->
															</span>
															<!--end::Label-->
															<!--begin::Input-->
															<span class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="radio" name="demat[service_type]" checked="checked" value="1" />
															</span>
															<!--end::Input-->
														</label>
														<!--end::Option-->
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<!--begin:Option-->
														<label class="d-flex flex-stack cursor-pointer mb-5">
															<!--begin::Label-->
															<span class="d-flex align-items-center me-2"> 
																<!--begin::Info-->
																<span class="d-flex flex-column">
																	<span class="fw-bolder fs-6">AMS</span>
																</span>
																<!--end::Info-->
															</span>
															<!--end::Label-->
															<!--begin::Input-->
															<span class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="radio" name="demat[service_type]" value="2" />
															</span>
															<!--end::Input-->
														</label>
														<!--end::Option--> 
													</div>
													<!--end::Col-->
												</div>
												<!--end::Input group--> 
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">PAN Number</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid" name="demat[pan_number]" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Demat Holder's Name</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid" name="demat[holder_name]" placeholder="" value="" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Broker</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<select name="demat[broker]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Profession">
														<option></option>
														<option value="Business Man">Business Man</option>
														<option value="Professional">Professional</option>
														<option value="Govt Job">Govt Job</option>
														<option value="Private Job">Private Job</option>
														<option value="Student">Student</option>
														<option value="House wife">House wife</option> 
													</select>	
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="row mb-8"> 
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span class="required">User ID</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="text" class="form-control form-control-lg form-control-solid" name="demat[user_id]" placeholder="" value="" />	
														<!--end::Input-->
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span class="required">Password</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="password" class="form-control form-control-lg form-control-solid" name="demat[password]" placeholder="" value="" />	
														<!--end::Input-->
													</div>
													<!--end::Col-->
												</div>
												<!--end::Input group--> 
												<!--begin::Input group-->
												<div class="row mb-8"> 
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span class="required">Mpin</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="password" class="form-control form-control-lg form-control-solid" name="demat[mpin]" placeholder="" value="" />	
														<!--end::Input-->
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col-md-6 fv-row">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span class="required">Capital</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="text" class="form-control form-control-lg form-control-solid" name="demat[capital]" placeholder="" value="" />	
														<!--end::Input-->
													</div>
													<!--end::Col-->
												</div>
												<!--end::Input group--> 
											</div>
										</div>
										<!--end::Step 2-->
										<!--begin::Step 3-->
										<div class="pending" data-kt-stepper-element="content">
											<div class="w-100">
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="required fs-5 fw-bold mb-2">Joining Date</label>
													<!--end::Label-->
													<!--begin::Input--> 
													<input type="date" name="payment[joining_date]" class="form-control form-control-lg form-control-solid" placeholder="Select date"/>
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="required fs-5 fw-bold mb-2">Fees</label>
													<!--end::Label-->
													<!--begin::Input--> 
													<input type="text" class="form-control form-control-lg form-control-solid" readonly placeholder="Select Fee" value="25,000" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-8">
													<!--begin::Label-->
													<label class="required fs-5 fw-bold mb-2">Mode</label>
													<!--end::Label-->
													<!--begin::Input group-->
													<div class="pb-4 border-bottom">
														<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
															<span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Projects</span>
															<input class="form-check-input" name="payment[mode]" type="checkbox" value="1" checked="checked" />
														</label>
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="py-4 border-bottom">
														<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
															<span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Targets</span>
															<input class="form-check-input" name="payment[mode]" type="checkbox" value="1" checked="checked" />
														</label>
													</div>
													<!--end::Input group-->
												</div>
												<!--end::Input group-->
											</div>
										</div>
										<!--end::Step 3-->
										<!--begin::Step 4--> 
										<div class="pending" data-kt-stepper-element="content">
											<div class="w-100 text-center">
												<!--begin::Heading-->
												<h1 class="fw-bolder text-dark mb-3">Release!</h1>
												<!--end::Heading-->
												<!--begin::Description-->
												<div class="text-muted fw-bold fs-3">Submit your app to kickstart your project.</div>
												<!--end::Description-->
												<!--begin::Illustration-->
												<div class="text-center px-4 py-15">
													<img src="{{asset("assets/media/illustrations/sketchy-1/9.png")}}" alt="" class="w-100 mh-300px" />
												</div>
												<!--end::Illustration-->
											</div>
										</div>
										<!--end::Step 4-->
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
												<button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
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
                        @else
                            <h1>Unauthorised</h1>
                        @endcan
					</div>
					<!--end::Modal body-->
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>
		<!--end::Modal - Add client--> 
		<!--begin::Modal - View Client Details--> 
		<div class="modal fade" id="viewClient" tabindex="-1" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered mw-650px" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
						<h2 class="fw-bolder">View Client Details</h2>
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
						<!--begin::Form-->
						<form id="" class="form" action="#">
							<!--begin::Scroll-->
							<!-- <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px"> -->
								
								<div class="form-group row">
									<label class="col-3 col-form-label">Client</label>
									<div class="col-9">
										<input class="form-control" type="text" value="" id="client_name" readonly />
                                    </div>
								</div>
								<div class="form-group row">
									<label for="example-email-input" class="col-3 col-form-label">Number</label>
									<div class="col-9">
										<input class="form-control" type="text" value="" id="client_number" readonly /> </div>
								</div> 
								<div class="form-group row">
									<label for="example-tel-input" class="col-3 col-form-label">Profession</label>
									<div class="col-9">
										<input class="form-control" type="text" value="" id="client_profession"  readonly/>
                                    </div>
								</div> 
								<div class="form-group row mb-0">
									<label for="no-of-demat" class="col-3 col-form-label">Status</label>
									<div class="col-9">
										<input class="form-control" type="text" value="" id="client_status"  readonly/>
                                    </div>
								</div> 
							<!-- </div> -->
							<!--end::Scroll--> 
						</form>
						<!--end::Form-->
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
		        </div>
		    </div>
		</div>
		<!--end::Modal - View Client Details-->
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
            $(document).on("click", "#addmoreWhatsapp", function () {
                var newcomp1 = $('#hiddenaddmoreWhatsapp').html();                
                $('.custom_appendDiv').append(newcomp1);
                resetCounter();
            });

            $(document).on("click", ".remove-btn", function () {
                $(this).closest(".removableDiv").remove();
                resetCounter();
            })

            function resetCounter() {
                counter = 2;
                $('#appendDivWp').find('.compCount').each(function () {
                    $(this).text(counter);
                    counter++;
                })
            }
        });
    </script>
    @section('jscript')
        
    @endsection
@endsection
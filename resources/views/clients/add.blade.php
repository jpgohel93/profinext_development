@extends('layout')
@section("page-title","Add Clients")
@section("clients","active")
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
                    <!--begin::Toolbar-->
                    <div class="toolbar" id="kt_toolbar">
                        <!--begin::Container-->
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Create Client
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
                            <form class="form" novalidate="novalidate" id="kt_modal_create_app_form" action="{{route('clientCreate')}}" method="POST">
                                @csrf
                                <!--begin::Step 1-->
                                <div class="current d-block card p-7 my-5" data-kt-stepper-element="content">
                                    <div class="w-100">
                                        <div class="stepper-label mt-0" style="margin-top:30px;margin-bottom:20px;">
                                            <h3 class="stepper-title text-primary">Personal Details</h3>
                                        </div>
                                        <div class="row">
                                            <!--begin::Input group-->
                                            <div class="col-md-6 mb-4">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Client Name</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="name" placeholder="" value="" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="col-md-6 mb-4">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Mobile No.</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc client-mobile" name="moblie" placeholder="" value="" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <div class="row">
                                            
                                        <!--begin::Input group-->
                                        <div class="col-md-6 mb-4">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Communication with</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="communication" placeholder="" value="" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="col-md-6 mb-4">
                                            <!--begin::Label-->
                                            <label class="d-md-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">WhatsApp No.</span>
                                                <div class="form-check form-check-custom form-check-solid small" style="margin-left: auto;">
                                                    <input class="form-check-input wpsameascontact" type="checkbox" value="1" name="wpsameascontact" id="flexCheckDefault"/>
                                                    <label class="form-check-label" for="flexCheckDefault" style="font-size: x-small;">
                                                        (Select if WhatsApp No. is same as Mobile No.)
                                                    </label>
                                                </div>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc wp" name="whatsapp" placeholder="" value="" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="col-md-6 mb-4">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Profession</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="profession" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Profession">
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
                                <div class="cloningSec">
                                    <!--begin::Step 2-->
                                    <div class="d-block card p-7 my-5" data-kt-stepper-element="content">
                                        <div class="w-100">
                                            <div class="stepper-label d-flex justify-content-between mt-0" style="margin-top:30px;margin-bottom:20px;">
                                                <h3 class="stepper-title text-primary">Demate Details</h3>
                                                <button type="button" class="btn btn-primary" id="addmore">Add More</button>
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="row mb-8">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-3">
                                                    <span class="required">Smart ID</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-md-6 mb-4 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required fs-6 fw-bold form-label mb-2">ST/SG</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input wrapper-->
                                                    <div class="position-relative">
                                                        <!--begin::Input-->
                                                        <select name="st_sg[]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="ST/SG">
                                                            <option></option>
                                                            <option value="ST">ST</option>
                                                            <option value="SG">SG</option> 
                                                        </select>
                                                    </div>
                                                    <!--end::Input wrapper-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-md-6 mb-4 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                        <span class="required">Serial Number</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input wrapper-->
                                                    <div class="position-relative">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid bdr-ccc" minlength="8" maxlength="10" placeholder="Serial No" name="serial_no[]" />
                                                        <!--end::Input--> 
                                                    </div>
                                                    <!--end::Input wrapper-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row col-md-6 mb-8">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-3">
                                                    <span class="required">Service Type</span>
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
                                                                <span class="fw-bolder fs-6">Prime</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </span>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" name="serviceType[][]" checked="checked" value="1" />
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
                                                                <span class="fw-bolder fs-6">AMS</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </span>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" name="serviceType[][]" value="2" />
                                                        </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option--> 
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group--> 
                                                <div class="row mb-4">
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-4">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">PAN Number</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="pan_no[]" placeholder="" value="" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-4">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Demat Holder's Name</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="holdername[]" placeholder="" value="" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-8">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Broker</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="broker[]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Profession">
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
                                            <div class="row"> 
                                                <!--begin::Col-->
                                                <div class="col-md-6 mb-4 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">User ID</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="user_id[]" placeholder="" value="" />	
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-md-6 mb-4 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Password</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="password" class="form-control form-control-lg form-control-solid bdr-ccc" name="password[]" placeholder="" value="" />	
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group--> 
                                            <!--begin::Input group-->
                                            <div class="row mb-4"> 
                                                <!--begin::Col-->
                                                <div class="col-md-6 mb-4 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Mpin</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="password" class="form-control form-control-lg form-control-solid bdr-ccc" name="mpin[]" placeholder="" value="" />	
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-md-6 mb-4 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Capital</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="capital[]" placeholder="" value="" />	
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group--> 
                                        </div>
                                    </div>
                                    <!--end::Step 2-->
                                    <!--begin::Step 3-->
                                    <div class="d-block card p-7 my-5 payment_details" data-kt-stepper-element="content">
                                        <div class="w-100">
                                            <div class="stepper-label d-flex justify-content-between mt-0" style="margin-top:30px;margin-bottom:20px;">
                                                <h3 class="stepper-title text-primary">Payment Details</h3>
                                            </div>
                                            
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-8 col-md-6">
                                                <!--begin::Label-->
                                                <label class="required fs-5 fw-bold mb-2">Mode</label>
                                                <!--end::Label-->
                                                <div class="row col-md-6 mb-4">	
                                                    <!--begin::Input group-->
                                                    <div class="col-md-6">
                                                        <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                                            <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Cash</span>
                                                            <input class="form-check-input" id="togglePaymentMode" name="cash[]" type="checkbox" value="1" checked="checked" />
                                                            <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 px-2 me-2" style="min-width: max-content;">By Bank</span>
                                                        </label>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                            </div>
                                            <!--end::Input group-->


                                            <div class="row mb-4 PaymentSection joining_date" style="display:block;" id="BankDiv">
                                                <!--begin::Col-->
                                                <div class="col-md-5 fv-row mb-4 hideonpending">
                                                    <!--begin::Label-->
                                                    <label class="required fs-6 fw-bold form-label mb-2">Bank Details</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input wrapper-->
                                                    <div class="position-relative">
                                                        <!--begin::Input-->
                                                        <select name="bank[]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Banks">
                                                            <option></option>
                                                            <option value="ICICI" selected >ICICI</option>
                                                            <option value="HDFC">HDFC</option> 
                                                            <option value="Canara">Canara</option> 
                                                            <option value="Axis">Axis</option> 
                                                            <option value="RBL">RBL</option> 
                                                            
                                                        </select>
                                                    </div>
                                                    <!--end::Input wrapper-->
                                                </div>
                                                <!--end::Col-->

                                                <div class="row">
                                                    <!--begin::Input group-->
                                                <div class="col-md-6 mb-4">
                                                    <!--begin::Label-->
                                                    <label class="required fs-5 fw-bold mb-2">Joining Date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input--> 
                                                    <input type="text" name="joining_date[]" class="form-control form-control-lg form-control-solid bdr-ccc c-date" placeholder="Select date"/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-4 hideonpending" id="FeesDiv">
                                                    <!--begin::Label-->
                                                    <label class="required fs-5 fw-bold mb-2">Fees</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input--> 
                                                    <input type="text" name="fees[]" class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="Select Fee" value="25,000" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                </div>
                                                <div class="row mb-8 " id="UploadDiv">
                                                    <!--begin::Input group-->
                                                <div class="col-md-6 mb-4 hideonpending">
                                                    <!--begin::Label-->
                                                    <label class="required fs-5 fw-bold mb-2">Upload Screenshot</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input--> 
                                                    <input type="file" name="screenshot[]" class="form-control form-control-lg form-control-solid bdr-ccc" readonly placeholder="Upload ScreenShot"/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="col-md-6 d-flex justify-content-between">
                                                    <!--begin::Label-->
                                                    <label class="required fs-5 fw-bold mb-2">Pending Payment</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input--> 
                                                    <div>
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input h-20px w-20px PendingMark" type="checkbox" name="pending_payment[]" value="1">
                                                            <span class="form-check-label fw-bold">Pending</span>
                                                        </label>
                                                        <!--end::Checkbox-->
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="appendDiv1"></div>
                                <!--begin::Wrapper-->
                                <div>
                                    <button type="submit" class="btn btn-lg btn-primary">
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
                                </div>
                                <!--end::Wrapper-->    
                                <!--end::Actions-->
                            </form>
                            <!--begin::Step 2 & 3 hidden for add more-->
                            <div class="d-none" id="hiddenaddmore">
                                <div class="removableDiv">
                                <!-- step 2 for more -->
                                    <div class="d-block card p-7 my-5 morecomp" data-kt-stepper-element="content" >
                                        <div class="w-100">
                                            <div class="stepper-label d-flex justify-content-between mt-0" style="margin-top:30px;margin-bottom:20px;">
                                                <h3 class="stepper-title text-primary">Demate Details <span class="compCount"></span></h3>
                                                <button type="button" class="btn btn-primary btn-pink remove-btn">Remove</button>
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="row mb-8">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-3">
                                                    <span class="required">Smart ID</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-md-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required fs-6 fw-bold form-label mb-2">ST/SG</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input wrapper-->
                                                    <div class="position-relative">
                                                        <!--begin::Input-->
                                                        <select name="st_sg[]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="ST/SG">
                                                            <option></option>
                                                            <option value="ST">ST</option>
                                                            <option value="SG">SG</option> 
                                                        </select>
                                                    </div>
                                                    <!--end::Input wrapper-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-md-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                        <span class="required">Serial Number</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input wrapper-->
                                                    <div class="position-relative">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid bdr-ccc" minlength="8" maxlength="10" placeholder="Serial No" name="serial_no[]" />
                                                        <!--end::Input--> 
                                                    </div>
                                                    <!--end::Input wrapper-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row col-md-6 mb-8">
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
                                                            <input class="form-check-input" type="radio" name="serviceType[]" checked="checked" value="1" />
                                                        </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                                <!--end::Col-->
                                                <div class="col-1"></div>
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
                                                            <input class="form-check-input" type="radio" name="serviceType[]" value="2" />
                                                        </span>
                                                        <!--end::Input-->
                                                    </label>
                                                    <!--end::Option--> 
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group--> 
                                                <div class="row mb-4">
                                                <!--begin::Input group-->
                                                <div class="col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">PAN Number</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="pan_no[]" placeholder="" value="" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Demat Holder's Name</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="holdername[]" placeholder="" value="" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-8">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Broker</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="broker[]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Profession">
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
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="user_id[]" placeholder="" value="" />	
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
                                                    <input type="password" class="form-control form-control-lg form-control-solid bdr-ccc" name="password[]" placeholder="" value="" />	
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group--> 
                                            <!--begin::Input group-->
                                            <div class="row mb-4"> 
                                                <!--begin::Col-->
                                                <div class="col-md-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Mpin</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="password" class="form-control form-control-lg form-control-solid bdr-ccc" name="mpin[]" placeholder="" value="" />	
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
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="capital[]" placeholder="" value="" />	
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group--> 
                                        </div>
                                    </div>
                                    <!-- step 2 for more ends -->

                                    <!-- step 3 for more -->
                                    <div class="d-block card p-7 my-5 payment_details morecomp" data-kt-stepper-element="content">
                                        <div class="w-100">
                                            <div class="stepper-label d-flex justify-content-between mt-0" style="margin-top:30px;margin-bottom:20px;">
                                                <h3 class="stepper-title text-primary">Payment Details</h3>
                                            </div>
                                            
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-8 col-md-6 d-flex flex-row justify-content-between">
                                                <!--begin::Label-->
                                                <label class="required fs-5 fw-bold mb-2">Mode</label>
                                                <!--end::Label-->
                                                <div class="row col-md-6 mb-4">	
                                                    <!--begin::Input group-->
                                                    <div class="col-md-6">
                                                        <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                                            <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Cash</span>
                                                            <input class="form-check-input" id="togglePaymentMode" type="checkbox" value="1" name='cash[]' checked="checked" />
                                                            <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 px-2 me-2" style="min-width: max-content;">By Bank</span>
                                                        </label>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                            </div>
                                            <!--end::Input group-->


                                            <div class="row mb-4 PaymentSection joining_date" style="display:block;" id="BankDiv">
                                                <!--begin::Col-->
                                                <div class="col-md-5 fv-row mb-4">
                                                    <!--begin::Label-->
                                                    <label class="required fs-6 fw-bold form-label mb-2">Bank Details</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input wrapper-->
                                                    <div class="position-relative">
                                                        <!--begin::Input-->
                                                        <select name="bank[]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Banks">
                                                            <option></option>
                                                            <option value="ICICI" selected >ICICI</option>
                                                            <option value="HDFC">HDFC</option> 
                                                            <option value="Canara">Canara</option> 
                                                            <option value="Axis">Axis</option> 
                                                            <option value="RBL">RBL</option> 
                                                            
                                                        </select>
                                                    </div>
                                                    <!--end::Input wrapper-->
                                                </div>
                                                <!--end::Col-->

                                                <div class="row">
                                                    <!--begin::Input group-->
                                                <div class="col-md-6 mb-4">
                                                    <!--begin::Label-->
                                                    <label class="required fs-5 fw-bold mb-2">Joining Date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input--> 
                                                    <input type="text" name="joining_date[]" class="form-control form-control-lg form-control-solid bdr-ccc c-date" placeholder="Select date"/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-4" id="FeesDiv">
                                                    <!--begin::Label-->
                                                    <label class="required fs-5 fw-bold mb-2">Fees</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input--> 
                                                    <input type="text" name="fees[]" class="form-control form-control-lg form-control-solid bdr-ccc"  placeholder="Select Fee" value="25,000" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                </div>
                                                <div class="row mb-8" id="UploadDiv">
                                                    <!--begin::Input group-->
                                                <div class="col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fs-5 fw-bold mb-2">Upload Screenshot</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input--> 
                                                    <input type="file" name="screenshot[]" class="form-control form-control-lg form-control-solid bdr-ccc" readonly placeholder="Upload ScreenShot"/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="col-md-6 d-flex justify-content-between">
                                                    <!--begin::Label-->
                                                    <label class="required fs-5 fw-bold mb-2">Pending Payment</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input--> 
                                                    <div>
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input h-20px w-20px PendingMark" type="checkbox" name="pending_payment[]" value="email">
                                                            <span class="form-check-label fw-bold">Pending</span>
                                                        </label>
                                                        <!--end::Checkbox-->
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                </div>
                                                <!--begin::Actions-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--  step 3 for more ends -->
                                </div>
                            </div>
                            <!--end::Step 2 & 3 hidden for add more ends-->
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>
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
            const name = $("#client_name");
            const number = $("#client_number");
            const profession = $("#client_profession");
            const status = $("#client_status");

            $(document).on("click",".viewClient",function(){
                $.ajax("/client/view/"+$(this).attr("data-id"),{
                    type:"GET",
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    }
                })
                .done(data=>{
                    $(name).val(data.name);
                    $(number).val(data.number);
                    $(profession).val(data.profession);
                    $(status).val(((data.status)?"Active":"Inactive"));
                    $("#viewClient").modal("show");
                })
            })
            $(document).on("click","#addmore",function() {
					// var newcomp1 = $('#hiddenaddmore').html();

					var clone = $('.cloningSec').last().clone();
					var rem = clone.find('#addmore');
					$(rem).removeAttr('id');
					$(rem).addClass('btn-pink remove-btn');
					$(rem).text('Remove');
					$('#appendDiv1').append(clone);
					resetCounter();
   		 		});		

				$(document).on("click",".remove-btn",function() {
					$(this).closest(".cloningSec").remove();
					resetCounter();
				})

                function resetCounter() {
                    counter = 1;
                    $('#appendDiv1').find('.compCount').each(function() {
                        $(this).text(counter);
                        counter++;
                    })
                }
                const targetDiv = document.getElementById("PaymentSection");
                const btn = document.getElementById("togglePaymentMode");
                
                btn.addEventListener("click", myFunction);
                $(document).on('click', '#togglePaymentMode', function() {
                    var self = $(this);
                    myFunction(self);
                });
                
                function myFunction(self)   
                {
                    if (self.is(":checked")) {
                        self.closest('.payment_details').find('.joining_date').show();
                        // targetDiv.style.display = "block";
                    } else {
                        self.closest('.payment_details').find('.joining_date').hide();
                        // targetDiv.style.display = "none";
                    }
                }
                $(document).on('click', '.PendingMark', function() {
                    if($(this).is(":checked")) {
                        console.log('checked');
                        $(this).closest('.payment_details').find('.hideonpending').hide();
                    } else {
                        console.log('not checked');
                        $(this).closest('.payment_details').find('.hideonpending').show();cloningSec
                    }
                });
                $(document).on("input",".wpsameascontact",function() {
                    if ($(this).is(':checked')) {					
                        var $cm = $('.client-mobile');
                        var $wp = $('.wp');
                        function onChange() {
                            $wp.val($cm.val());
                        };
                        $('.client-mobile')
                            .change(onChange)
                            .keyup(onChange);

                    }
                    else {
                        $(".wp").val(null);
                    }
                });
            $("#viewClient").modal("hide");
        })
    </script>
    @section('jscript')
        
		<script src="{{asset('assets/js/custom/modals/create-app.js')}}"></script>
    @endsection
@endsection
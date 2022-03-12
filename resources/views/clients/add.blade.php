@extends('layout')
@section("page-title","Add Client")
@section("clientsData.clients","active")
@section("clientsData","hover show")
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
                @can("client-create")
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
                                <form class="form" novalidate="novalidate" id="kt_modal_create_app_form" action="{{route('clientCreate')}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <!--begin::Step 1-->
                                    <div class="current d-block card p-7 my-5" data-kt-stepper-element="content">
                                        <div class="w-100">
                                            <div class="row">
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-4">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">User Type</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select name="client_type" id="client_type" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select User Type">
                                                        <option></option>
                                                        <option value="1">Account Handling</option>
                                                        <option value="2">Mutual Fund</option>
                                                        <option value="3">Unlisted Shares</option>
                                                    </select>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div id="personalDetail">
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
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="name" placeholder="" value="{{old('name')}}" />
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
                                                        <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc client-mobile" name="number" placeholder="" value="{{old('number')}}" />
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
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="communication_with" placeholder="" value="{{old('communication_with')}}" />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 mb-4">
                                                        <!--begin::Label-->
                                                        <label class="d-md-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">WhatsApp No.</span>
                                                            <div class="form-check form-check-custom form-check-solid small" style="margin-left: auto;">
                                                                <input class="form-check-input wpsameascontact" type="checkbox" value="1" {{(old('wpsameascontact')?"checked":"")}} name="wpsameascontact" id="flexCheckDefault"/>
                                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: x-small;">
                                                                    (Select if WhatsApp No. is same as Mobile No.)
                                                                </label>
                                                            </div>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc wp" name="wp_number" placeholder="" value="{{old('wp_number')}}" />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <div class="row">
                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 mb-4">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">Profession</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <select name="profession" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Profession">
                                                            @forelse ($professions as $profession)
                                                                <option value="{{$profession->profession}}" {{(old('profession') && old('profession')==$profession->profession)?"selected":""}}>{{$profession->profession}}</option>
                                                            @empty
                                                                <option>Selecte Profession</option>
                                                            @endforelse
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>

                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 mb-4" id="channelPartnerDiv">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">Select Channel Partner</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <select name="channel_partner_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Channel Partner">
                                                            <option></option>
                                                            @forelse ($channelPartner as $partner)
                                                                <option value="{{$partner->id}}" >{{$partner->name}}</option>
                                                            @empty

                                                            @endforelse
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>

                                                    <!--end::Input group-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accountHandlingDetail">
                                        @php
                                            $main = array();
                                            if(null !== session("_old_input")){
                                                $i=0;
                                                foreach(session("_old_input") as $k => $v){
                                                    if(is_array($v)){
                                                        $data = array();
                                                        $index=0;
                                                        foreach(session("_old_input") as $k2 => $v2){
                                                            if(is_array($v2) && isset(session("_old_input")[$k][$i])){
                                                                $data[$k2]= $v2[$i];
                                                            }
                                                        }
                                                        $index++;
                                                        if(!empty($data)){
                                                            $main[$i]=$data;
                                                        }
                                                        $i++;
                                                    }
                                                }
                                            }
                                        @endphp
                                        @if (empty($main))
                                            <!--end::Step 1-->
                                            <div class="cloningSec">
                                                <!--begin::Step 2-->
                                                <div class="d-block card p-7 my-5" data-kt-stepper-element="content">
                                                    <div class="w-100">
                                                        <div class="stepper-label d-flex justify-content-between mt-0" style="margin-top:30px;margin-bottom:20px;">
                                                            <h3 class="stepper-title text-primary">Demate Details</h3>
                                                            <button type="button" class="btn btn-primary" id="addmore">Add More</button>
                                                        </div>
                                                        <div class="row mb-8">
                                                            <label class="d-flex align-items-center fs-5 fw-bold mb-3">
                                                                <span class="required">Smart ID</span>
                                                            </label>
                                                            <div class="col-md-6 mb-4 fv-row">
                                                                <div class="position-relative">
                                                                    <select name="st_sg[]" class="form-select form-select-solid">
                                                                        <option value="">Select ID</option>
                                                                        <option value="ST">ST</option>
                                                                        <option value="SG">SG</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4 fv-row">
                                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                                    <span class="required">Serial Number</span>
                                                                </label>
                                                                <div class="position-relative">
                                                                    <input type="text" class="form-control form-control-solid bdr-ccc" value="" minlength="8" maxlength="10" placeholder="Serial No" name="serial_number[]" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row col-md-6 mb-8">
                                                            <label class="d-flex align-items-center fs-5 fw-bold mb-3">
                                                                <span class="required">Service Type</span>
                                                            </label>
                                                            <div class="col-md-6 mb-4 fv-row">
                                                                <label class="d-flex flex-stack cursor-pointer mb-5">
                                                                    <span class="d-flex align-items-center me-2">
                                                                        <span class="d-flex flex-column">
                                                                            <span class="fw-bolder fs-6">Prime</span>
                                                                        </span>
                                                                    </span>
                                                                    <span class="form-check form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="radio" data-service_type checked="checked" value="1" />
                                                                        <input class="form-check-input" type="hidden" name="service_type[]" value="1" />
                                                                    </span>
                                                                </label>
                                                            </div>
                                                            <div class="col-1"></div>
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
                                                                        <input class="form-check-input" type="radio" data-service_type value="2" />
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
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="pan_number[]" placeholder="" value="" />
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
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="holder_name[]" placeholder="" value="" />
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
                                                            <select name="broker[]" class="form-select form-select-solid">
                                                                <option></option>
                                                                @forelse ($brokers as $broker)
                                                                    <option value="{{$broker->broker}}" {{(old('broker') && old('broker')==$broker->broker)?"selected":""}}>{{$broker->broker}}</option>
                                                                @empty
                                                                    <option>Selecte Broker</option>
                                                                @endforelse
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
                                                                        <input class="form-check-input" id="togglePaymentMode" togglePaymentMode type="checkbox" value="1" checked="checked" />
                                                                        <input class="form-check-input" type="hidden" name="mode[]" value="2" />

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
                                                                    <select name="bank[]" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Bank">
                                                                        <option></option>
                                                                        @forelse ($banks as $bank)
                                                                            <option value="{{$bank->bank}}" {{(old('bank') && old('bank')==$bank->bank)?"selected":""}}>{{$bank->bank}}</option>
                                                                        @empty
                                                                            <option>Selecte Bank</option>
                                                                        @endforelse
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
                                                                <input type="file" name="screenshot[0][]" class="form-control form-control-lg form-control-solid bdr-ccc" multiple placeholder="Upload ScreenShot"/>
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
                                                                        <input class="form-check-input h-20px w-20px PendingMark" data-pending_payment type="checkbox" value="0">
                                                                        <input class="form-check-input h-20px w-20px PendingMark" type="hidden" name="pending_payment[]" value="0">
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

                                        @else
                                            @foreach($main as $key => $demate_account)
                                                <!--end::Step 1-->
                                                <div class="cloningSec">
                                                    <!--begin::Step 2-->
                                                    <div class="d-block card p-7 my-5" data-kt-stepper-element="content">
                                                        <div class="w-100">
                                                            <div class="stepper-label d-flex justify-content-between mt-0" style="margin-top:30px;margin-bottom:20px;">
                                                                <h3 class="stepper-title text-primary">Demate Details</h3>
                                                                @if ($key==0)
                                                                    <button type="button" class="btn btn-primary" id="addmore">Add More</button>
                                                                @else
                                                                    <button type="button" class="btn btn-primary btn-pink remove-btn">Remove</button>
                                                                @endif
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
                                                                        <select name="st_sg[]" class="form-select form-select-solid">
                                                                            <option></option>
                                                                            <option value="ST" {{$demate_account['st_sg']=="ST"?"selected":""}}>ST</option>
                                                                            <option value="SG" {{$demate_account['st_sg']=="SG"?"selected":""}}>SG</option>
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
                                                                        <input type="text" class="form-control form-control-solid bdr-ccc" value="{{(old('serial_number'))?old('serial_number')[$key]:$demate_account['serial_number']}}" minlength="8" maxlength="10" placeholder="Serial No" name="serial_number[]" />
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
                                                                            <input class="form-check-input" type="radio" data-service_type {{$demate_account['service_type']=="1"?"checked":""}} value="1" />
                                                                            <input class="form-check-input" type="hidden" name="service_type[]" value="{{$demate_account['service_type']=="1"?"1":"2"}}" />
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
                                                                            <input class="form-check-input" type="radio" data-service_type {{$demate_account['service_type']=="2"?"checked":""}} value="2" />
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
                                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="pan_number[]" placeholder="" value="{{$demate_account['pan_number']}}" />
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
                                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="holder_name[]" placeholder="" value="{{$demate_account['holder_name']}}" />
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
                                                                <select name="broker[]" class="form-select form-select-solid">
                                                                    <option></option>
                                                                    <option value="Business Man" {{($demate_account['broker']=="Business Man")?"selected":""}}>Business Man</option>
                                                                    <option value="Professional" {{($demate_account['broker']=="Professional")?"selected":""}}>Professional</option>
                                                                    <option value="Govt Job" {{($demate_account['broker']=="Govt Job")?"selected":""}}>Govt Job</option>
                                                                    <option value="Private Job" {{($demate_account['broker']=="Private Job")?"selected":""}}>Private Job</option>
                                                                    <option value="Student" {{($demate_account['broker']=="Student")?"selected":""}}>Student</option>
                                                                    <option value="House wife" {{($demate_account['broker']=="House wife")?"selected":""}}>House wife</option>
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
                                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="" name="user_id[]" value="{{$demate_account['user_id']}}" />
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
                                                                    <input type="password" class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="" name="password[]" value="{{(session('password')[$key])?session('password')[$key]:""}}" />
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
                                                                    <input type="password" class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="" name="mpin[]" value="{{$demate_account['mpin']}}" />
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
                                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="capital[]" placeholder="" value="{{$demate_account['capital']}}" />
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
                                                                            <input class="form-check-input" id="togglePaymentMode" togglePaymentMode type="checkbox" value="1" {{$demate_account['mode']=="2"?"checked":""}} />
                                                                            <input class="form-check-input" type="hidden" name="mode[]" value="{{$demate_account['mode']=="2"?"2":"1"}}" />

                                                                            <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 px-2 me-2" style="min-width: max-content;">By Bank</span>
                                                                        </label>
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                </div>
                                                            </div>
                                                            <!--end::Input group-->
                                                            <div class="row mb-4 PaymentSection joining_date" style="display:{{$demate_account['mode']=="2"?"block":"none"}};" id="BankDiv">
                                                                <!--begin::Col-->
                                                                <div class="col-md-5 fv-row mb-4 hideonpending" style="display:{{$demate_account['pending_payment']=="1"?"none":""}};">
                                                                    <!--begin::Label-->
                                                                    <label class="required fs-6 fw-bold form-label mb-2">Bank Details</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input wrapper-->
                                                                    <div class="position-relative">
                                                                        <!--begin::Input-->
                                                                        <select name="bank[]" class="form-select form-select-solid" >
                                                                            <option></option>
                                                                            <option value="ICICI" {{$demate_account['bank']=="ICICI"?"selected":""}}>ICICI</option>
                                                                            <option value="HDFC" {{$demate_account['bank']=="HDFC"?"selected":""}}>HDFC</option>
                                                                            <option value="Canara" {{$demate_account['bank']=="Canara"?"selected":""}}>Canara</option>
                                                                            <option value="Axis" {{$demate_account['bank']=="Axis"?"selected":""}}>Axis</option>
                                                                            <option value="RBL" {{$demate_account['bank']=="RBL"?"selected":""}}>RBL</option>

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
                                                                    <input type="text" name="joining_date[]" class="form-control form-control-lg form-control-solid bdr-ccc c-date" placeholder="Select date" value="{{$demate_account['mode']=="2"?($demate_account['joining_date']==""?"":date("Y-m-d",strtotime($demate_account['joining_date']))):""}}"/>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="col-md-6 mb-4 hideonpending" id="FeesDiv" style="display:{{$demate_account['pending_payment']=="1"?"none":""}};">
                                                                    <!--begin::Label-->
                                                                    <label class="required fs-5 fw-bold mb-2">Fees</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" name="fees[]" class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="Select Fee" value="{{$demate_account['mode']=="2"?$demate_account['fees']:""}}" />
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                </div>
                                                                <div class="row mb-8 " id="UploadDiv">
                                                                    <!--begin::Input group-->
                                                                <div class="col-md-6 mb-4 hideonpending" style="display:{{$demate_account['pending_payment']=="1"?"none":""}};">
                                                                    <!--begin::Label-->
                                                                    <label class="required fs-5 fw-bold mb-2">Upload Screenshot</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="file" name="screenshot[{{$key}}][]" class="form-control form-control-lg form-control-solid bdr-ccc" multiple placeholder="Upload ScreenShot"/>
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
                                                                            <input class="form-check-input h-20px w-20px PendingMark" data-pending_payment type="checkbox" {{$demate_account['pending_payment']=="1"?"checked":""}} value="1">
                                                                            <input type="hidden" name="pending_payment[]" value="{{$demate_account['pending_payment']=="1"?1:0}}">
                                                                            <span class="form-check-label fw-bold">Pending</span>
                                                                        </label>
                                                                        <!--end::Checkbox-->
                                                                    </div>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                </div>
                                                                <div class="row">
                                                                    @if (isset($client->clientPayment[$key]))
                                                                        @foreach($client->clientPayment[$key]->Screenshots as $ss)
                                                                            <div class="form-group col-3">
                                                                                <label>
                                                                                    <a href="{{route('removePaymentScreenshot',[$client->id,$ss->id])}}" class="removePaymentScreenshot">Remove</a>
                                                                                </label>
                                                                                <img style="height: 100px;width:auto" loading="lazy" class="m-3 d-block" src="{{url('common/displayFile/'.Crypt::encryptString($ss->id).'/'.Crypt::encryptString('screenshots').'/'.$ss->file)}}" >
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div id="appendDiv1"></div>
                                    <!--begin::Wrapper-->
                                    <div id="submitSmsButton">
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
                                                            <select name="st_sg[]" class="form-select form-select-solid">
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
                                                            <input type="text" class="form-control form-control-solid bdr-ccc" value="" minlength="8" maxlength="10" placeholder="Serial No" name="serial_number[]" />
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
                                                                <input class="form-check-input" type="radio" data-service_type checked="checked" value="1" />
                                                                <input class="form-check-input" type="hidden" name="service_type[]" value="1" />
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
                                                                <input class="form-check-input" type="radio" data-service_type value="2" />
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
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="pan_number[]" placeholder="" value="" />
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
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="holder_name[]" placeholder="" value="" />
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
                                                    <select name="broker[]" class="form-select form-select-solid">
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
                                                                <input class="form-check-input" id="togglePaymentMode" togglePaymentMode type="checkbox" value="1" checked="checked" />
                                                                <input class="form-check-input" type="hidden" name="mode[]" value="2" />

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
                                                            <select name="bank[]" class="form-select form-select-solid" >
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
                                                        <input type="file" name="screenshot[2][]" class="form-control form-control-lg form-control-solid bdr-ccc" multiple placeholder="Upload ScreenShot"/>
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
                                                                <input class="form-check-input h-20px w-20px PendingMark" data-pending_payment type="checkbox" value="0">
                                                                <input class="form-check-input h-20px w-20px PendingMark" type="hidden" name="pending_payment[]" value="0">
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
                                </div>
                                <!--end::Step 2 & 3 hidden for add more ends-->
                                <!--end::Form-->
                            </div>
                            <!--end::Content-->
                        </div>
                    </div>
                @else
                    <h5>Unauthorised</h5>
                @endcan
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
			$(document).on("change","[name='st_sg[]']",function() {
				var lastSGNo = parseInt("<?php echo $newSGNo;?>");
				var lastSTNo = parseInt("<?php echo $newSTNo;?>");
				var string = "000";

				$("[name='st_sg[]']").each( function(index){
					var vl = $(this).val();
					if(vl != "") {
						if(vl == "SG") {
							lastSGNo = (parseInt(lastSGNo) + 1);
							var len = lastSGNo.toString().length;
							var prefix = string.substring(len);
							var newNo = prefix+''+lastSGNo;
							$("[name='serial_number[]']").eq(index).val(newNo);
						} else {
							lastSTNo = (parseInt(lastSTNo) + 1);
							var len1 = lastSTNo.toString().length;
							var prefix1 = string.substring(len1);
							var newNo1 = prefix1+''+lastSTNo;
							$("[name='serial_number[]']").eq(index).val(newNo1);
						}
					}
				});
			});

			$(document).on("click","#addmore",function() {
				// var newcomp1 = $('#hiddenaddmore').html();
				var clone = $('#hiddenaddmore > .cloningSec').clone();
				var rem = clone.find('#addmore');
				$(rem).removeAttr('id');
				$(rem).addClass('btn-pink remove-btn');
				$(rem).text('Remove');
				$('#appendDiv1').append(clone);
				resetCounter();
			});
			// service type this is required else some values are not available server side
			$(document).on("click","input[data-service_type]",function(e){
				if(e.target.value==1){
					$(e.target).closest(".row").find("[data-service_type][value='2'][type='radio']").first().prop('checked', false)
					$(e.target).closest(".row").find("[name='service_type[]'][type='hidden']").first().val("1");
				}else{
					$(e.target).closest(".row").find("[data-service_type][value='1'][type='radio']").first().prop('checked', false)
					$(e.target).closest(".row").find("[name='service_type[]'][type='hidden']").first().val("2");
				}
			})
			$(document).on("click","input[data-pending_payment]",function(e){
				if($(e.target).is(":checked")){
					$(e.target).parent(".form-check").find("[name='pending_payment[]'][type='hidden']").first().val("1");
				}else{
					$(e.target).parent(".form-check").find("[name='pending_payment[]'][type='hidden']").first().val("0");
				}
			})

			$(document).on("click",".remove-btn",function() {
				$(this).closest(".cloningSec").remove();
				$("[name='st_sg[]']").trigger("change");
				resetCounter();
			})

			function resetCounter() {
				counter = 1;
				$.each($('#appendDiv1 .cloningSec'),(i,v)=> {
					let elem = $(v)[0];
					$(elem).find("[type='file']").first().attr("name","screenshot["+counter+"][]")
					$(elem).find("[type='file']").first().attr("name","screenshot["+counter+"][]")
					counter++;
				})
			}
			const targetDiv = document.getElementById("PaymentSection");

			$(document).on('click', '#togglePaymentMode', function() {
				var self = $(this);
				myFunction(self);
			});

			function myFunction(self)
			{
				if (self.is(":checked")) {
					self.closest('.payment_details').find('.joining_date').show();
					$(self).closest('.payment_details').find('[name="mode[]"][type="hidden"]').val(2);
					// targetDiv.style.display = "block";
				} else {
					self.closest('.payment_details').find('.joining_date').hide();
					$(self).closest('.payment_details').find('[name="mode[]"][type="hidden"]').val(1);
					// targetDiv.style.display = "none";
				}
			}
			$(document).on('click', '.PendingMark', function() {
				if($(this).is(":checked")) {
					$(this).closest('.payment_details').find('.hideonpending').hide();
				} else {
					console.log('not checked');
					$(this).closest('.payment_details').find('.hideonpending').show();
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

			$(document).ready(function() {
				$("#personalDetail").hide();
				$("#accountHandlingDetail").hide();
				$("#submitSmsButton").hide();
			});
			$(document).on('change',"#client_type", function () {
				var selectVal = $(this).val();
				if(selectVal == 1){
					$("#personalDetail").show();
					$("#accountHandlingDetail").show();
					$("#submitSmsButton").show();
					$("#channelPartnerDiv").show();
				}else if(selectVal == 2){
					$("#personalDetail").show();
					$("#accountHandlingDetail").hide();
					$("#channelPartnerDiv").hide();
					$("#submitSmsButton").show();
				}else if(selectVal == 3){
					$("#personalDetail").show();
					$("#accountHandlingDetail").hide();
					$("#submitSmsButton").show();
					$("#channelPartnerDiv").hide();
				}
			});
        })
    </script>
    @section('jscript')

		<script src="{{asset('assets/js/custom/modals/create-app.js')}}"></script>
    @endsection
@endsection

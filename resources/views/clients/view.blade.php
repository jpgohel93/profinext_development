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
                @can("client-read")
                    @if (isset($client))
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
                                        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Client</h1>
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
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="name" readonly value="{{$client->name}}" />
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
                                                    <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc client-mobile" name="number" readonly value="{{$client->number}}" />
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
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="communication_with" readonly value="{{$client->communication_with}}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="col-md-6 mb-4">
                                                <!--begin::Label-->
                                                <label class="d-md-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">WhatsApp No.</span>
                                                    <div class="form-check form-check-custom form-check-solid small" style="margin-left: auto;">
                                                        <input class="form-check-input wpsameascontact" type="checkbox" value="1" {{$client->wp_number==$client->number ? 'checked' :""}} disabled/>
                                                        <label class="form-check-label" for="flexCheckDefault" style="font-size: x-small;">
                                                            (Select if WhatsApp No. is same as Mobile No.)
                                                        </label>
                                                    </div>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc wp" name="wp_number" readonly value="{{$client->wp_number}}" />
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
                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{$client->profession}}" />
                                                <!--end::Input-->
                                            </div>
                                        
                                            <!--end::Input group-->
                                        </div>
                                    </div>
                                    
                                    @forelse ($client->clientDemat as $key => $demate_account)
                                        <!--end::Step 1-->
                                        <div class="cloningSec">
                                            <!--begin::Step 2-->
                                            <div class="d-block card p-7 my-5" data-kt-stepper-element="content">
                                                <div class="w-100">
                                                    <div class="stepper-label d-flex justify-content-between mt-0" style="margin-top:30px;margin-bottom:20px;">
                                                        <h3 class="stepper-title text-primary">Demate Details {{$key+1}}</h3>
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
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{$demate_account->st_sg}}" />
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
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{$demate_account->serial_number}}" />
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
                                                                    <input class="form-check-input" type="radio" {{$demate_account->service_type==1?"checked":"disabled"}} value="1" />
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
                                                                    <input class="form-check-input" type="radio" {{$demate_account->service_type==2?"checked":"disabled"}} value="1" />
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
                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{$demate_account->pan_number}}" />
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
                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{$demate_account->holder_name}}" />
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
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{$demate_account->broker}}" />
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
                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{$demate_account->user_id}}" />
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
                                                            <input type="password" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{md5($demate_account->password)}}" />
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
                                                            <input type="password" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{md5($demate_account->mpin)}}" />
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
                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{$demate_account->capital}}" />
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
                                                        <h3 class="stepper-title text-primary">Payment Details {{$key+1}}</h3>
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
                                                                    <input class="form-check-input" id="togglePaymentMode" togglePaymentMode type="checkbox" value="1" {{$client->clientPayment[$key]->mode==2 ? 'checked' :""}} disabled/>
                                                                    <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 px-2 me-2" style="min-width: max-content;">By Bank</span>
                                                                </label>
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->

                                                    <div class="row mb-4 PaymentSection joining_date" style="display:{{$client->clientPayment[$key]->mode==2 ? 'block' :"none"}};" id="BankDiv">
                                                        <!--begin::Col-->
                                                        <div class="col-md-5 fv-row mb-4 hideonpending" style="display:{{$client->clientPayment[$key]->pending_payment==1?"none":"block"}}">
                                                            <!--begin::Label-->
                                                            <label class="required fs-6 fw-bold form-label mb-2">Bank Details</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input wrapper-->
                                                            <div class="position-relative">
                                                                <!--begin::Input-->
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{$client->clientPayment[$key]->bank}}" />
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
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{date("Y-m-d",strtotime($client->clientPayment[$key]->joining_date))}}" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="col-md-6 mb-4 hideonpending" id="FeesDiv" style="display:{{$client->clientPayment[$key]->pending_payment==1?"none":"block"}}">
                                                                <!--begin::Label-->
                                                                <label class="required fs-5 fw-bold mb-2">Fees</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input--> 
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" readonly value="{{$client->clientPayment[$key]->fees}}" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <div class="row mb-8 "  id="UploadDiv">
                                                            <!--begin::Input group-->
                                                            <div class="col-md-6 mb-4 hideonpending" style="display:{{$client->clientPayment[$key]->pending_payment==1?"none":"block"}}">
                                                                <!--begin::Label-->
                                                                <label class="required fs-5 fw-bold mb-2">Screenshot</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input--> 
                                                                {{-- <input type="file" name="screenshot[]" class="form-control form-control-lg form-control-solid bdr-ccc" readonly placeholder="Upload ScreenShot"/> --}}
                                                                {{-- <img src="{{url('screenshots/'.$client->clientPayment[$key]->screenshots)}}" style="width: 200px" class="d-block"> --}}
                                                                
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
                                                                        <input class="form-check-input h-20px w-20px PendingMark" type="checkbox" name="pending_payment[]" value="1" {{$client->clientPayment[$key]->pending_payment==1?"checked":""}} disabled>
                                                                        <span class="form-check-label fw-bold">Pending</span>
                                                                    </label>
                                                                    <!--end::Checkbox-->
                                                                </div>
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <div class="row">
                                                            @foreach($client->clientPayment[$key]->Screenshots as $ss)
                                                                <img style="height: 100px;width:auto" loading="lazy" class="m-3" src="{{url('common/displayFile/'.Crypt::encryptString($ss->id).'/'.Crypt::encryptString('screenshots').'/'.$ss->file)}}" >
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Actions-->
                                    @empty
                                        <h1>No Accounts</h1>
                                    @endforelse
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>
                        <!--end::Content-->
                    @else
                        <h5 class="container alert alert-danger p-4">Invalid Client</h5>
                    @endif
                @else
                    <h1>Unauthorised</h1>
                @endcan
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
@endsection
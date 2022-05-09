@extends('layout')
@section("page-title","Edit Client - Client Management ")
@section("clientsData.clients","active")
@section("client_management.accordion","hover show")
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
                @can("client-write")
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
                        @if (isset($client->id))
                            <!--begin::Toolbar-->
                            <div class="toolbar" id="kt_toolbar">
                                <!--begin::Container-->
                                <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                                    <!--begin::Page title-->
                                    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                        <!--begin::Title-->
                                        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Update Client
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
                                        <form class="form" enctype="multipart/form-data" id="kt_modal_create_app_form" action="{{route('updateClient',$client->id)}}" method="POST">
                                            @csrf
                                            <!--begin::Step 1-->
                                            <div class="current d-block card p-7 my-5" data-kt-stepper-element="content">
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
                                                            <option value="1" {{$client->client_type && $client->client_type==1?"selected":""}}>Account Handling</option>
                                                            <option value="2" {{$client->client_type && $client->client_type==2?"selected":""}}>Mutual Fund</option>
                                                            <option value="3" {{$client->client_type && $client->client_type==3?"selected":""}}>Unlisted Shares</option>
                                                            <option value="4" {{$client->client_type && $client->client_type==4?"selected":""}}>Insurance</option>
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <div id="personalDetail">
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
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="name" placeholder="" value="{{$client->name}}" />
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
                                                                <input type="tel" class="form-control form-control-lg form-control-solid bdr-ccc client-mobile" name="number" placeholder="" value="{{$client->number}}" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <div class="row">
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
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc wp" name="wp_number" placeholder="" value="{{$client->wp_number}}" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->

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
                                                                        <option value="{{$profession->profession}}" {{(old('profession') && old('profession')==$profession->profession)?"selected":($client->profession==$profession->profession?"selected":"")}}>{{$profession->profession}}</option>
                                                                    @empty
                                                                        <option>Select Profession</option>
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
                                                                <select name="channel_partner_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Channel Partner ">
                                                                    <option></option>
                                                                    @forelse ($channelPartner as $partner)
                                                                        @if($client->channel_partner_id == $partner->id)
                                                                            <option selected value="{{$partner->id}}" >{{$partner->name}}</option>
                                                                        @else
                                                                            <option value="{{$partner->id}}" >{{$partner->name}}</option>
                                                                        @endif
                                                                    @empty
                                                                        <option>Select Channel Partner</option>
                                                                    @endforelse
                                                                </select>
                                                                <!--end::Input-->
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <!--begin::Input group-->
                                                            <div class="col-md-6 mb-4">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                    <span>Communication with</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="communication_with" placeholder="" value="{{$client->communication_with}}" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <div class="col-md-6 mb-4">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                    <span>Communication with contact number</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="communication_with_contact_number" placeholder="" value="{{$client->communication_with_contact_number}}" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="mutualFundDiv">
                                                    <button type="button" class="btn btn-primary" id="mutualFundAddMore" style="float:right">Add more</button>
                                                    <div class="stepper-label mt-0" style="margin-top:30px;margin-bottom:20px;">
                                                        <h3 class="stepper-title text-primary">Investment Details</h3>
                                                    </div>
                                                    <div class="row">
                                                        <!--begin::Input group-->
                                                        <div class="col-md-6 mb-4">
                                                            <!--begin::Label-->
                                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                <span class="required">AMC</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="amc[1]" placeholder="" />
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="col-md-6 mb-4">
                                                            <!--begin::Label-->
                                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                <span class="required">Fund</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="fund[1]" placeholder="" />
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                    </div>
                                                    <div class="row">
                                                        <!--begin::Input group-->
                                                        <div class="col-md-6 mb-4">
                                                            <!--begin::Label-->
                                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                <span class="required">Amount</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="amount[1]" placeholder="" />
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="col-md-6 mb-4">
                                                            <!--begin::Label-->
                                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                <span class="required">Investment Type</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <select name="investmentType[1]" id="investmentType" class="form-select form-select-solid" data-control="select2">
                                                                <option value="" selected>Select option</option>
                                                                <option value="sip">SIP</option>
                                                                <option value="lump sum">Lump sum</option>
                                                            </select>
                                                            <!--end::Input-->
                                                        </div>
                                                        <div class="col-md-6 mb-4 sipTimeFrame" id="sipTimeFrame" style="display:none">
                                                            <!--begin::Label-->
                                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                <span class="required">Time Frame</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <select name="sipTimeFrame[1]" class="form-select form-select-solid" data-control="select2">
                                                                <option value="monthly">Monthly</option>
                                                                <option value="quarterly">Quarterly</option>
                                                                <option value="half yearly">Half Yearly</option>
                                                                <option value="yearly">Yearly</option>
                                                            </select>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <div id="mutualFundDivAppend"></div>
                                                    <div id="mutualFundDivClone" class="mutualFundDivClone" style="display:none">
                                                        <button type="button" class="btn btn-light removeMutualFundDiv" style="float:right">Remove</button>
                                                        <div class="stepper-label mt-0" style="margin-top:30px;margin-bottom:20px;">
                                                            <h3 class="stepper-title text-primary">Investment Details <span class="divCounter"></span></h3>
                                                        </div>
                                                        <div class="row">
                                                            <!--begin::Input group-->
                                                            <div class="col-md-6 mb-4">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                    <span class="required">AMC</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" data-name="amc" placeholder="" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="col-md-6 mb-4">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                    <span class="required">Fund</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" data-name="fund" placeholder=""  />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <div class="row">
                                                            <!--begin::Input group-->
                                                            <div class="col-md-6 mb-4">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                    <span class="required">Amount</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" data-name="amount" placeholder=""  />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="col-md-6 mb-4">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                    <span class="required">Investment Type</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <select data-name="investmentType" class="form-select form-select-solid" data-control="select2">
                                                                    <option value="" selected>Select option</option>
                                                                    <option value="sip">SIP</option>
                                                                    <option value="lump sum">Lump sum</option>
                                                                </select>
                                                                <!--end::Input-->
                                                            </div>
                                                            <div class="col-md-6 mb-4 sipTimeFrame" style="display:none">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                    <span class="required">Time Frame</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <select data-name="sipTimeFrame" class="form-select form-select-solid" data-control="select2">
                                                                    <option value="monthly">Monthly</option>
                                                                    <option value="quarterly">Quarterly</option>
                                                                    <option value="half yearly">Half Yearly</option>
                                                                    <option value="yearly">Yearly</option>
                                                                </select>
                                                                <!--end::Input-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div id="accountHandlingDetail">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="button" class="btn btn-primary d-block" style="float:right" id="addmore">Add More</button>
                                                    </div>
                                                </div>
                                                @if(isset($client->clientDemat[0]))
                                                    @foreach($client->clientDemat as $key => $demate_account)
                                                        <!--end::Step 1-->
                                                        <div class="cloningSec">
                                                            <!--begin::Step 2-->
                                                            <div class="d-block card p-7 my-5" data-kt-stepper-element="content">
                                                                <input type="hidden" name="demate_id[]" value="{{$demate_account->id}}">
                                                                <div class="w-100">
                                                                    <div class="stepper-label d-flex justify-content-between mt-0" style="margin-top:30px;margin-bottom:20px;">
                                                                        <h3 class="stepper-title text-primary">Demate Details</h3>
                                                                        <button type="button" class="btn btn-primary btn-pink remove-btn" data-id="{{$demate_account->id}}">Remove</button>
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
                                                                                <select name="st_sg[]" class="form-select form-select-solid" data-control="select2" data-placeholder="Select smart id">
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
                                                                                <input type="text" class="form-control form-control-solid bdr-ccc" value="{{$demate_account['serial_number']}}" minlength="8" maxlength="10" placeholder="Serial No" name="serial_number[]" readonly/>
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
                                                                                    <input class="form-check-input" type="radio" data-service_type {{(old('service_type')?old('service_type')[$key]:$demate_account['service_type'])=="1"?"checked":""}} value="1" />
                                                                                    <input class="form-check-input" type="hidden" name="service_type[]" value="{{(old('service_type')?old('service_type')[$key]:$demate_account['service_type'])=="1"?"1":"2"}}" />
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
                                                                                    <input class="form-check-input" type="radio" data-service_type {{(old('service_type')?old('service_type')[$key]:$demate_account['service_type'])=="2"?"checked":""}} value="2" />
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
                                                                                        <span class="fw-bolder fs-6">PRIME AMS</span>
                                                                                    </span>
                                                                                    <!--end::Info-->
                                                                                </span>
                                                                                <!--end::Label-->
                                                                                <!--begin::Input-->
                                                                                <span class="form-check form-check-custom form-check-solid">
                                                                                    <input class="form-check-input" type="radio" data-service_type {{(old('service_type')?old('service_type')[$key]:$demate_account['service_type'])=="3"?"checked":""}} value="3" />
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
                                                                            <div class="col-md-12 mb-4">
                                                                                <!--begin::Label-->
                                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                                    <span class="required">Upload Demat Holder’s PAN Card</span>
                                                                                </label>

                                                                                <input type="file" class="form-control form-control-lg form-control-solid bdr-ccc" accept="image/*" name="pan_number[{{$key}}][]" multiple placeholder="" />
                                                                                <!--end::Label-->
                                                                                <!--begin::Input-->
                                                                                <div class="row">
                                                                                    @forelse($demate_account->Pancards as $pancard)
                                                                                        <div style="width:max-content">
                                                                                            <label class="h4 mt-3 removePancard" id="{{$pancard->id}}">Remove</label>
                                                                                            @if(file_exists(config()->get('constants.UPLOADS.PANCARDS').$pancard->file))
                                                                                                <div>
                                                                                                    <img style="height: 100px;width:auto" loading="lazy" class="m-3 pancardImage" src="{{url('common/displayFile/'.Crypt::encryptString($pancard->id).'/'.Crypt::encryptString('pancard').'/'.$pancard->file)}}" >
                                                                                                </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    @empty
                                                                                        {{-- <h6>Image not found</h6> --}}
                                                                                    @endforelse
                                                                                </div>
                                                                                {{-- <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="pan_number[]" placeholder="" value="{{(old('pan_number'))?old('pan_number')[$key]:$demate_account['pan_number']}}" /> --}}
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->
                                                                        <!--begin::Input group-->
                                                                        <div class="col-md-6 mb-4">
                                                                            <!--begin::Label-->
                                                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                                <span class="required">Pan Number</span>
                                                                            </label>
                                                                            <!--end::Label-->
                                                                            <!--begin::Input-->
                                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="pan_number_text[]" placeholder="" value="{{(old('pan_number_text')?old('pan_number_text')[$key]:$demate_account['pan_number_text'])}}" />
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
                                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="holder_name[]" placeholder="" value="{{(old('holder_name')?old('holder_name')[$key]:$demate_account['holder_name'])}}" />
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->
                                                                        <!--begin::Input group-->
                                                                        <div class="col-md-6 mb-4">
                                                                            <!--begin::Label-->
                                                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                                <span class="required">Address</span>
                                                                            </label>
                                                                            <!--end::Label-->
                                                                            <!--begin::Input-->
                                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="address[]" placeholder="" value="{{(old('address')?old('address')[$key]:$demate_account['address'])}}" />
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->
                                                                        <!--begin::Input group-->
                                                                        <div class="col-md-6 mb-4">
                                                                            <!--begin::Label-->
                                                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                                <span class="required">Email ID</span>
                                                                            </label>
                                                                            <!--end::Label-->
                                                                            <!--begin::Input-->
                                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="email_id[]" placeholder="" value="{{(old('email_id')?old('email_id')[$key]:$demate_account['email_id'])}}" />
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->
                                                                        <!--begin::Input group-->
                                                                        <div class="col-md-6 mb-4">
                                                                            <!--begin::Label-->
                                                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                                <span class="required">Mobile</span>
                                                                            </label>
                                                                            <!--end::Label-->
                                                                            <!--begin::Input-->
                                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="mobile[]" placeholder="" value="{{(old('mobile')?old('mobile')[$key]:$demate_account['mobile'])}}" />
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
                                                                        <select name="broker[]" class="form-select form-select-solid" data-control="select2">
                                                                            @forelse ($brokers as $broker)
                                                                                <option value="{{$broker->broker}}" {{(old('broker') && old('broker')[$key]==$broker->broker)?"selected":($demate_account['broker']==$broker->broker?"selected":"")}}>{{$broker->broker}}</option>
                                                                            @empty
                                                                                <option>Select Broker</option>
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
                                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" readonly placeholder="" name="user_id[]" value="{{$demate_account['user_id']}}" />
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
                                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="" name="password[]" value="{{$demate_account['password']}}" />
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
                                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="" name="mpin[]" value="{{$demate_account['mpin']}}" />
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
                                                                            <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="capital[]" placeholder="" value="{{(old('capital') ? old('capital')[$key] :$demate_account['capital'])}}" />
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
                                                                    <input type="hidden" name="payment_id[]" value="{{isset(old('payment_id')[$key])?old('payment_id')[$key]:isset($client->clientPayment[$key])?$client->clientPayment[$key]->id:""}}">

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
                                                                                    <input class="form-check-input" id="togglePaymentMode" togglePaymentMode type="checkbox" value="1" {{(isset($client->clientPayment[$key])?$client->clientPayment[$key]->mode:"")=="2"?"checked":""}} />
                                                                                    <input class="form-check-input" type="hidden" name="mode[]" value="{{(isset($client->clientPayment[$key])?$client->clientPayment[$key]->mode:"")=="2"?"2":"1"}}" />

                                                                                    <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 px-2 me-2" style="min-width: max-content;">By Bank</span>
                                                                                </label>
                                                                            </div>
                                                                            <!--end::Input group-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Input group-->


                                                                    <div class="row mb-4 PaymentSection joining_date" style="display:{{(isset($client->clientPayment[$key])?$client->clientPayment[$key]->mode:"")=="2"?"block":"none"}};" id="BankDiv">
                                                                        <!--begin::Col-->
                                                                        <div class="col-md-5 fv-row mb-4 hideonpending" style="display:{{(old('pending_payment')?old('pending_payment')[$key]:isset($client->clientPayment[$key])?$client->clientPayment[$key]->pending_payment:"")=="1"?"none":""}};">
                                                                            <!--begin::Label-->
                                                                            <label class="required fs-6 fw-bold form-label mb-2">Bank Details</label>
                                                                            <!--end::Label-->
                                                                            <!--begin::Input wrapper-->
                                                                            <div class="position-relative">
                                                                                <!--begin::Input-->
                                                                                <select name="bank[]" class="form-select form-select-solid" data-control="select2">
                                                                                    <option></option>
                                                                                    @forelse ($banks as $bank)
                                                                                        <option value="{{$bank->id}}" {{(isset($client->clientPayment[$key])?$client->clientPayment[$key]->bank:"")==$bank->id?"selected":""}}>{{$bank->title}}</option>
                                                                                    @empty
                                                                                        <option>Select Bank</option>
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
                                                                            <input type="date" name="joining_date[]" class="form-control form-control-lg form-control-solid bdr-ccc c-date" placeholder="Select date" value="{{(isset($client->clientPayment[$key])?$client->clientPayment[$key]->mode:"")=="2"?(isset($client->clientPayment[$key])?date("Y-m-d",strtotime($client->clientPayment[$key]->joining_date)):date("Y-m-d")):date("Y-m-d")}}"/>
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->
                                                                        <!--begin::Input group-->
                                                                        <div class="col-md-6 mb-4 hideonpending" id="FeesDiv" style="display:{{(old('pending_payment')?old('pending_payment')[$key]:isset($client->clientPayment[$key])?$client->clientPayment[$key]->pending_payment:"")=="1"?"none":""}};">
                                                                            <!--begin::Label-->
                                                                            <label class="required fs-5 fw-bold mb-2">Fees</label>
                                                                            <!--end::Label-->
                                                                            <!--begin::Input-->
                                                                            <input type="text" name="fees[]" class="form-control form-control-lg form-control-solid bdr-ccc" placeholder="Select Fee" value="{{(isset($client->clientPayment[$key])?$client->clientPayment[$key]->mode:"")=="2"?(old('fees')?old('fees')[$key]:isset($client->clientPayment[$key])?$client->clientPayment[$key]->fees:""):""}}" />
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->
                                                                        </div>
                                                                        <div class="row mb-8 " id="UploadDiv">
                                                                            <!--begin::Input group-->
                                                                        <div class="col-md-6 mb-4 hideonpending" style="display:{{(old('pending_payment')?old('pending_payment')[$key]:isset($client->clientPayment[$key])?$client->clientPayment[$key]->pending_payment:"")=="1"?"none":""}};">
                                                                            <!--begin::Label-->
                                                                            <label class="required fs-5 fw-bold mb-2">Upload Screenshot</label>
                                                                            <!--end::Label-->
                                                                            <!--begin::Input-->
                                                                            <input type="file" name="screenshot[{{$key}}][]" accept="image/*" class="form-control form-control-lg form-control-solid bdr-ccc" multiple placeholder="Upload ScreenShot"/>
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
                                                                                    <input class="form-check-input h-20px w-20px PendingMark" data-pending_payment type="checkbox" {{(isset($client->clientPayment[$key])?$client->clientPayment[$key]->pending_payment:"")=="1"?"checked":""}} value="1">
                                                                                    <input type="hidden" name="pending_payment[]" value="{{(isset($client->clientPayment[$key])?$client->clientPayment[$key]->pending_payment:"")=="1"?1:0}}">
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
                                                <div id="appendDiv1"></div>
                                                <!--begin::Wrapper-->
                                            </div>
                                            <div id="submitSmsButton">
                                                @if(!isset($formType) || $formType!="channelPartner")
                                                    @hasanyrole('super-admin|accountant')
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <input class="form-check-input" type="checkbox" value="{{$client->status=='2'?"2":"1"}}" onclick="this.value = (this.value=='1'?'2':'1')" {{$client->status=='2'?"checked disabled":""}} name="payment_verified" id="paymentVerified"/>
                                                                <label for="paymentVerified" class="h3">is payment Verified?</label>
                                                            </div>
                                                        </div>
                                                    @endhasanyrole
                                                @endif
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
                                                                    <select name="st_sg[]" class="form-select form-select-solid" data-control="select2" data-placeholder="Select smart id">
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
                                                                    <input type="text" class="form-control form-control-solid bdr-ccc" value="" minlength="8" maxlength="10" placeholder="Serial No" name="serial_number[]" readonly/>
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
                                                            <div class="col-1"></div>
                                                            <!--begin::Col-->
                                                            <div class="col-md-6 mb-4 fv-row">
                                                                <!--begin:Option-->
                                                                <label class="d-flex flex-stack cursor-pointer mb-5">
                                                                    <!--begin::Label-->
                                                                    <span class="d-flex align-items-center me-2">
                                                                        <!--begin::Info-->
                                                                        <span class="d-flex flex-column">
                                                                            <span class="fw-bolder fs-6">PRIME AMS</span>
                                                                        </span>
                                                                        <!--end::Info-->
                                                                    </span>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <span class="form-check form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="radio" data-service_type value="3" />
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
                                                                <div class="col-md-12 mb-4">
                                                                    <!--begin::Label-->
                                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                        <span class="required">Upload Demat Holder’s PAN Card</span>
                                                                    </label>
                                                                    <input type="file" class="form-control form-control-lg form-control-solid bdr-ccc" accept="image/*" name="pan_number[][]" multiple placeholder="" />
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                </div>
                                                            <!--begin::Input group-->
                                                            <div class="col-md-6 mb-4">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                    <span class="required">PAN Number</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="pan_number_text[]" placeholder="Enter pan number" value="" />
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
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="holder_name[]" placeholder="Demat holder name" value="" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--begin::Input group-->
                                                            <div class="col-md-6 mb-4">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                    <span class="required">Address</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="address[]" placeholder="City, District, State, Pin code" value="" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="col-md-6 mb-4">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                    <span class="required">Email ID</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="email_id[]" placeholder="Demat Holder’s Email ID" value="" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="col-md-6 mb-4">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                    <span class="required">Mobile</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="mobile[]" placeholder="Demat Holder’s Mobile Number" value="" />
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
                                                            <select name="broker[]" class="form-select form-select-solid" data-control="select2" data-placeholder="Select broker">
                                                                <option value=""></option>
                                                                @forelse ($brokers as $broker)
                                                                    <option value="{{$broker->broker}}">{{$broker->broker}}</option>
                                                                @empty
                                                                    {{-- empty --}}
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
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="user_id[]" placeholder="Enter user id" value="" />
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
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="password[]" placeholder="Enter password for this user id" value="" />
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
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="mpin[]" placeholder="Set MPIN" value="" />
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
                                                                <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="capital[]" placeholder="Capital amount" value="" />
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
                                                                    <select name="bank[]" class="form-select form-select-solid" data-control="select2" data-placeholder="Select bank">
                                                                        <option></option>
                                                                        @forelse ($banks as $bank)
                                                                            <option value="{{$bank->id}}">{{$bank->title}}</option>
                                                                        @empty
                                                                            <option>Select Bank</option>
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
                                                                <input type="date" name="joining_date[]" class="form-control form-control-lg form-control-solid bdr-ccc c-date" value="{{date('Y-m-d')}}" placeholder="Select date"/>
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
                                        @else
                                        <div class="container">
                                            <h5 class="alert alert-danger">Invalid user</h5>
                                        </div>
                                    @endif
                                    <!--end::Form-->
                                </div>
                                <!--end::Content-->
                            </div>
                        @else
                        {{redirect()->route('clients')->with("info","client not found")}}
                        @endcan
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
                window.lastSGNo = parseInt("<?php echo $newSGNo;?>");
                let count = 1;
                $.each($(".cloningSec"),(i,v)=>{
                    $(v).attr("data-count",count);
                    count++;
                })
                // count = $(".cloningSec").length;
                $(document).on("click","#addmore",function() {
                    $("select[data-control='select2']").select2('destroy');
                    window.lastSGNo = (parseInt(window.lastSGNo));
					// var newcomp1 = $('#hiddenaddmore').html();
					var clone = $('#hiddenaddmore > .cloningSec').clone();
					var rem = clone.find('#addmore');
					$(rem).removeAttr('id');
					$(rem).addClass('btn-pink remove-btn');
					$(rem).text('Remove');
					$('#appendDiv1').append(clone);
                    $("#appendDiv1").find("[name*='serial_number']:last").val(String(window.lastSGNo).padStart(3,"0"));
                    let count = 1;
                    $.each($(".cloningSec"),(i,v)=>{
                        $(v).attr("data-count",count);
                        count++;
                    })
                    $("select[data-control='select2']").select2();
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
                const removeDematAccount = async function(id){
                    await $.ajax("{{route('removeDematAccount')}}",{
                        type:"POST",
                        data:{
                            id:id
                        }
                    })
                    .done(data=>{
                        window.alert("Demat account removed");
                    })
                    .fail(err=>{
                        if(err.status==500){
                            window.alert("Server Error");
                        }else if(err.status==403){
                            window.alert("Unauthorised request");
                        }
                    })
                }
				$(document).on("click",".remove-btn",function(e) {
                    const id = e.target.getAttribute("data-id");
                    if(id){
                        if(window.confirm("this cannot be undone! are you sure to remove this account?")){
                            removeDematAccount(id);
                        }else{
                            e.preventDefault();
                            return false;
                        }
                    }
					$(this).closest(".cloningSec").remove();
                    let count = 1;
                    $.each($(".cloningSec"),(i,v)=>{
                        $(v).attr("data-count",count);
                        count++;
                    })
					resetCounter();
				})

                function resetCounter() {
                    counter = 1;
                    $.each($('#appendDiv1 .cloningSec'),(i,v)=> {
                        let elem = $(v)[0];
                        counter++;
                        $(elem).find("[type='file']").first().attr("name","screenshot["+counter+"][]")
                        $(elem).find("[type='file']").first().attr("name","screenshot["+counter+"][]")
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
            $(document).on("click",".removePaymentScreenshot",function(e){
                if(!window.confirm("This cannot be undone!\r\nAre you sure you want to remove this Screenshot?")){
                    e.preventDefault();
                }
            })
            $(document).on("click",".removeDematePancard",function(e){
                if(!window.confirm("This cannot be undone!\r\nAre you sure you want to remove this Pancard image?")){
                    e.preventDefault();
                }
            })

            $(document).ready(function() {
                var selectVal = "{{ isset($client->client_type) ? $client->client_type : 0}}";
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
                }else{
                    $("#personalDetail").hide();
                    $("#accountHandlingDetail").hide();
                    $("#submitSmsButton").hide();
                }
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
            $(document).on("click",".pancardImage",e=>{
                const url = e.target.getAttribute("src");
                if(url){
                    window.open(url);
                }
            })
            // remove pancard
            $(document).on("click",".removePancard",function(e){
                const id = e.target.getAttribute("id");
                if(id){
                    if(window.confirm("Are you sure you want to remove this Pancard?")){
                        $.ajax("{{route('removeDematePancard')}}",{
                            type:"POST",
                            data:{
                                id:id
                            }
                        })
                        .done(data=>{
                            if(data?.info){
                                $(e.target).parent("div").remove();
                            }
                        })
                        .fail(err=>{
                            if(err.status===500){
                                window.alert("Server Error");
                            }else if(err.status===403){
                                window.alert("Unauthorised request");
                            }
                        })
                    }
                }else{
                    window.alert("Unable to Load this image");
                }
            })
            $(document).on('change',"#client_type", function (e) {
                var selectVal = e.target.value;
				if(selectVal == "1"){
					$("#personalDetail").show();
					$("#accountHandlingDetail").show();
					$("#submitSmsButton").show();
					$("#channelPartnerDiv").show();
					$("#addMoreDiv").show();
					$("#mutualFundDiv").hide();
				}else if(selectVal == "2"){
					$("#personalDetail").show();
                    $("#mutualFundDiv").show();
					$("#accountHandlingDetail").hide();
					$("#channelPartnerDiv").hide();
					$("#submitSmsButton").show();
                    $("#addMoreDiv").hide();
				}else if(selectVal == "3"){
					$("#personalDetail").show();
                    $("#mutualFundDiv").hide();
					$("#accountHandlingDetail").hide();
					$("#submitSmsButton").show();
					$("#channelPartnerDiv").hide();
					$("#addMoreDiv").hide();
				}else if(selectVal == "4"){
                    $("#personalDetail").show();
                    $("#mutualFundDiv").hide();
					$("#accountHandlingDetail").hide();
					$("#submitSmsButton").show();
					$("#channelPartnerDiv").hide();
					$("#addMoreDiv").hide();
                }else{
                    $("#mutualFundDiv").hide();
                }
			});
            $("#client_type").trigger("change");
            $(document).on("change","[name*='investmentType']",function(e){
                const val = e.target.value;
                if(val=="sip"){
                    $(e.target).parent(".col-md-6").next(".sipTimeFrame").show();
                }else{
                    $(e.target).parent(".col-md-6").next(".sipTimeFrame").hide();
                }
            })
            // add more for mutual fund Investment
            $("#mutualFundAddMore").on("click",function(e){
                $("[data-control='select2']").select2("destroy");
                let clone = $("#mutualFundDivClone").clone();
                $("#mutualFundDivAppend").append(clone);
                let count = $("#mutualFundDivAppend").children().length+1;
                let elem = $("#mutualFundDivAppend").children().last()[0];
                $(elem).find(".divCounter").text(count);
                $.each($(elem).find("[data-name]"),(i,v)=>{
                    $(v).attr("name",$(v).data("name")+"["+count+"]");
                })
                $("[data-control='select2']").select2();
                $("#mutualFundDivAppend").children().last().show();
            })
            $(document).on("click",".removeMutualFundDiv",function(e){
                $(e.target).closest('.mutualFundDivClone').remove();
            })
            $(document).on("click",".wpsameascontact",e=>{
                if($(e.target).is(":checked")){
                    let number = $(e.target).closest(".row").prev(".row").last(".col-md-6").find(".client-mobile").val();
                    $(e.target).closest(".col-md-6").find(".wp").val(number);
                }else{
                    $(e.target).closest(".col-md-6").find(".wp").val("");
                }
            })
            $(document).on("input",".client-mobile",function(e) {
                if($(e.target).closest(".row").next(".row").last(".col-md-6").find(".wpsameascontact").is(":checked")){
                    $(e.target).closest(".row").next(".row").last(".col-md-6").find(".wp").val($(this).val());
                }
            });
            const addError = (elem,error,index=null)=>{
                // if select2
                if($(elem).hasClass("select2-hidden-accessible")){
                    if($(elem).next("span").next(".error").length>0){
                        $(elem).next("span").next(".error").remove();
                    }
                    $(elem).next("span").after(`<p class='text-danger h5 error' my-2>${error}</p>`);
                }else{
                    if($(elem).next(".error").length>0){
                        $(elem).next(".error").remove();
                    }
                    $(elem).after(`<p class='text-danger h5 error'>${error}</p>`);
                }
                let element = $(elem).parents(".cloningSec").find('input[name*="pan_number_text"]')[0];
                $('html, body').animate({
                    scrollTop: $(element).offset().top
                }, 200);
                console.log();
            }
            const removeError = (elem)=>{
                $(elem).next(".error").remove();
            }
            const validateField = (e,event)=>{
                if($(e).val()==""){
                    addError(e,required);
                    event.preventDefault();
                    return false;
                }else{
                    removeError(e);
                    return true;
                }
            }
            const validateAccountHandlingField = (e,event)=>{
                if($(e).val()==""){
                    let id = $($(e).parents('.cloningSec')).index(e);
                    addError(e,required,id);
                    event.preventDefault();
                    return false;
                }else{
                    removeError(e);
                    return true;
                }
            }
            // error msg
            let required = "This field is required";
            $("#submitSmsButton").find("button[type='submit']").first().on("click",function(e){
                // validate personalDetails
                let field = [];
                field.push($("#personalDetail").find("input[name='name']"));
                field.push($("#personalDetail").find("input[name='number']"));
                field.push($("#personalDetail").find("input[name='wp_number']"));
                field.push($("#personalDetail").find("select[name='profession']"));
                // field.push($("#personalDetail").find("select[name='channel_partner_id']"));
                field.map((elem)=>validateField(elem,e));
                field = [];
                // accountHandlingDetail
                field.push($("#accountHandlingDetail").find("input[name*='pan_number_text']"));
                field.map((elem)=>validateAccountHandlingField(elem,e));

            })
        })
    </script>
    @section('jscript')
		<script src="{{asset('assets/js/custom/modals/create-app.js')}}"></script>
    @endsection
@endsection

@extends('layout')
@section("page-title","Client Demat Account - Finance Management")
@section("finance_management.renewal_status","active")
@section("finance_management.accordion","hover show")
@section("content")
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
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Client Demate Details</h1>
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
                                    <li class="breadcrumb-item text-dark">Client Demate Details</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Toolbar-->
                    <form method="POST" action="{{route('clientDematupdatePL')}}">
                        @csrf
                        <input type='hidden' name='id' value='{{$demateDetails->id}}'>
                        <!--begin::Post-->
                        <div class="post d-flex flex-column-fluid" id="kt_post">
                            <!--begin::Container-->
                            <div id="kt_content_container" class="container-xxl">
                                <div class="current d-block card p-7 my-5" data-kt-stepper-element="content">
                                    <div class="w-100">
                                        <div class="stepper-label mt-0" style="margin-top:30px;margin-bottom:20px;">
                                            <h3 class="stepper-title">Client Name:&nbsp;{{$demateDetails->withClient->name}}</h3>
                                        </div>
                                        <div class="my-4">
                                            <div class="row">
                                                <h3 class="stepper-title">Demat Details :</h3>
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Smart Id</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->st_sg}}' readonly/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="col-md-6 col-sm-12 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Demat Holder Name</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->holder_name}}' readonly/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--begin::Input group-->
                                                <div class="col-md-6 col-sm-12 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Broker</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->broker}}' readonly/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--begin::Input group-->
                                                <div class="col-md-6 col-sm-12 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">User id</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->user_id}}' readonly/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--begin::Input group-->
                                                <div class="col-md-6 col-sm-12 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Password</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->password}}' readonly/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--begin::Input group-->
                                                <div class="col-md-6 col-sm-12 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Mpin</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->mpin}}' readonly/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4">
                                            <div class="row">
                                                <h3 class="stepper-title">P / L Status :</h3>
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Joining Capital</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->capital}}' readonly/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="col-md-6 col-sm-12 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Available Fund</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->available_balance}}' readonly/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--begin::Input group-->

                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">Joining Date</span>
                                                    </label>
                                                    <!--end::Label-->
                                                <?php $joining_date = date('Y-m-d',(strtotime(!empty($demateDetails->joining_date) && isset($demateDetails->joining_date) ? $demateDetails->joining_date : $demateDetails->created_at)));?>

                                                <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="joining_date" value='{{$joining_date}}' readonly/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="col-md-6 col-sm-12 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">End Date</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="end_date" value='<?php echo date('Y-m-d') ;?>' readonly/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--begin::Input group-->

                                                <div class="col-md-6 col-sm-12 mb-5">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required">P / L</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$demateDetails->pl}}' name="pl" id="current_pl"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4">
                                            <div class="row">
                                                <h3 class="stepper-title">Payment Bank</h3>
                                                @if(!empty($primary_bank))
                                                    <input type="hidden" value="{{$primary_bank['id']}}" name="payment_bank_id">

                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 col-sm-12 mb-5">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">Bank Title</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$primary_bank['title']}}' readonly/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--begin::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 col-sm-12 mb-5">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">Bank Name</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$primary_bank['name']}}' readonly/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--begin::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 col-sm-12 mb-5">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">Account Name</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$primary_bank['account_name']}}' readonly/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--begin::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 col-sm-12 mb-5">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">Account No</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$primary_bank['account_no']}}' readonly/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--begin::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="col-md-6 col-sm-12 mb-5">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                            <span class="required">IFAC Code</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$primary_bank['ifsc_code']}}' readonly/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--begin::Input group-->
                                                @elseif(!empty($bankAccountList))
                                                    <?php $count = 1;?>
                                                    @foreach($bankAccountList as $bankAccount)
                                                        <div class="col-md-4 col-sm-12 mb-5">
                                                            <input type="radio" value="{{$bankAccount->id}}" name="payment_bank_id" data-id="{{$count++}}" class="bank_change"> {{$bankAccount->title}}
                                                        </div>
                                                    @endforeach
                                                        <?php $count = 1;?>
                                                        @foreach($bankAccountList as $bankAccount)
                                                            <div class="row" id="bank_{{$count++}}">
                                                                <!--begin::Input group-->
                                                                <div class="col-md-6 col-sm-12 mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                        <span class="required">Bank Title</span>
                                                                    </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$bankAccount->title}}' readonly/>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--begin::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="col-md-6 col-sm-12 mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                        <span class="required">Bank Name</span>
                                                                    </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$bankAccount->name}}' readonly/>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--begin::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="col-md-6 col-sm-12 mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                        <span class="required">Account Name</span>
                                                                    </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$bankAccount->account_name}}' readonly/>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--begin::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="col-md-6 col-sm-12 mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                        <span class="required">Account No</span>
                                                                    </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$bankAccount->account_no}}' readonly/>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--begin::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="col-md-6 col-sm-12 mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                        <span class="required">IFAC Code</span>
                                                                    </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value='{{$bankAccount->ifsc_code}}' readonly/>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--begin::Input group-->
                                                            </div>
                                                        @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="my-4">
                                            <div class="row">
                                                <div class="d-flex flex-stack pt-10">
                                                    <div>
                                                        <button type="submit" class="btn btn-sm btn-primary" id="verifyBtn">Verify</button>
                                                        <button type="button" class="btn btn-sm btn-primary" id="calculationBtn">Rough Calculation</button>
                                                        <button type="button" data-id='{{$demateDetails->id}}' id="backToTrade" class="btn btn-sm btn-primary" data-value="normal">Back to trade</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Post-->
                    </form>
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

    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $("#backToTrade").on("click",function(e){
                    const id = $("#backToTrade").attr("data-id");
                    const value="normal";
                    $.ajax("{!! route('updateDematStatus') !!}",{
                        type:"POST",
                        data:{
                            id:id,
                            status: value
                        },
                        success: function(response) {
                            if(response){
                                window.location.href = "{!! route('renewal_status') !!}";
                            }else{
                                window.alert("Something want wrong");
                            }
                        }
                    })
                    .fail((err)=>{
                        if(err.status===403){
                            window.alert("Unauthorized Action");
                        }
                    })
                });
                // $("#verifyBtn").on("click",function(){
                //     $("#plfield").val($("#current_pl").val());
                //     const id = $("#backToTrade").attr("data-id");
                //     $("#editIdContainer").html(`<input type='hidden' name='id' value='${id}'>`);
                //     $("#edit_client_demate_status").modal("show");
                // })

                $(".bank_change").on("change",function(){
                    var id = $(this).attr('data-id');
                    if(id == 1){
                        $("#bank_1").show();
                        $("#bank_2").hide();
                        $("#bank_3").hide();
                    }else if(id == 2){
                        $("#bank_1").hide();
                        $("#bank_2").show();
                        $("#bank_3").hide();
                    }else if(id == 3){
                        $("#bank_1").hide();
                        $("#bank_2").hide();
                        $("#bank_3").show();
                    }
                });

                $(document).ready(function() {
                   $("#bank_1").hide();
                   $("#bank_2").hide();
                   $("#bank_3").hide();
                });

            },jQuery)
        })


    </script>
@endsection

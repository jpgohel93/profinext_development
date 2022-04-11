@extends('layout')
@section("page-title","Renewal Status - Finance Management")
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

                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <div class="card">
                                <!-- begin::Body-->
                                <div class="card-body py-20">
                                    <!-- begin::Wrapper-->
                                    <div class="mw-lg-950px mx-auto w-100">
                                        <!-- begin::Header-->
                                        <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                                            <h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">{{$title}}</h4>
                                            <!--end::Logo-->
                                            <div class="text-sm-end">
                                                <!--begin::Text-->
                                                <div class="text-sm-end fw-bold fs-4 text-muted mt-7">
                                                    <div>{{$renewData->account_name}}</div>
                                                    <div>{{$renewData->pan_number}}</div>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="pb-12">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column gap-7 gap-md-10">
                                                <!--begin::Message-->
                                                <div class="fw-bolder fs-2">Issue For,
                                                    <br>
                                                    <span class="text-muted fs-5">{{$renewData->holder_name}}</span><br>
                                                    <span class="text-muted fs-5">{{$renewData->address}}</span><br>
                                                    <span class="text-muted fs-5">{{$renewData->pan_number_text}}</span><br>
                                                    <span class="text-muted fs-5">{{$renewData->mobile}}</span><br>
                                                </div>
                                                <!--begin::Message-->
                                                <!--begin::Separator-->
                                                <div class="separator"></div>
                                                <!--begin::Separator-->
                                                <!--begin::Order details-->
                                                <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                                    <div class="flex-root d-flex flex-column">
                                                        <span class="text-muted">Order ID</span>
                                                        <span class="fs-5">{{$renewData->order_id}}</span>
                                                    </div>
                                                    <div class="flex-root d-flex flex-column">
                                                        <span class="text-muted">Date</span>
                                                        <span class="fs-5">{{$renewData->created_at->format('d-m-Y')}}</span>
                                                    </div>
                                                    <div class="flex-root d-flex flex-column">
                                                        <span class="text-muted">Invoice ID</span>
                                                        <span class="fs-5">{{$renewData->bank_code}}/{{$renewData->financial_year}}/{{$renewData->invoice_code}}</span>
                                                    </div>
                                                </div>
                                                <!--end::Order details-->
                                                <!--begin:Order summary-->
                                                <div class="d-flex justify-content-between flex-column">
                                                    <!--begin::Table-->
                                                    <div class="table-responsive border-bottom mb-9">
                                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                            <thead>
                                                            <tr class="border-bottom fs-6 fw-bolder text-muted">
                                                                <th class="min-w-175px pb-2">Action / Sub Heading</th>
                                                                <th class="min-w-70px pb-2">Description</th>
                                                                <th class="min-w-100px text-center pb-2">Total</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="fw-bold text-gray-600">
                                                            <!--begin::Products-->
                                                            @forelse($message as $data)
                                                                <tr>
                                                                    <td>{{$data['heading']}}</td>
                                                                    <td>{{$data['description']}}</td>
                                                                    <td class="text-center">{{$data['amount']}}</td>
                                                                </tr>
                                                            @empty
                                                                {{-- empty --}}
                                                            @endforelse
                                                            <!--end::Products-->
                                                            <!--begin::Subtotal-->
                                                            <tr>
                                                                <td colspan="2" class="text-end">Subtotal</td>
                                                                <td class="text-center">{{$total}}</td>
                                                            </tr>
                                                            <!--end::Subtotal-->

                                                            <!--begin::Grand total-->
                                                            <tr>
                                                                <td colspan="2" class="fs-3 text-dark fw-bolder text-end">Grand Total</td>
                                                                <td class="text-dark fs-3 fw-boldest text-center">{{$grand_total}}</td>
                                                            </tr>
                                                            <!--end::Grand total-->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end:Order summary-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Body-->
                                        <!-- begin::Footer-->
                                        <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                                            <!-- begin::Actions-->
                                            <div class="my-1 me-5">
                                                <!-- begin::Pint-->
                                                <button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print Invoice</button>
                                                <!-- end::Pint-->
                                                <!-- begin::Download-->
                                                <button type="button" class="btn btn-light-success my-1">Download</button>
                                                <!-- end::Download-->
                                            </div>
                                            <!-- end::Actions-->
                                            <!-- begin::Action-->
                                            <a href="javascript:void(0)" class="btn btn-primary my-1">Create Invoice</a>
                                            <!-- end::Action-->
                                        </div>
                                        <!-- end::Footer-->
                                    </div>
                                    <!-- end::Wrapper-->
                                </div>
                                <!-- end::Body-->
                            </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
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
    <div class="modal fade" id="mark_as_problem_modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0">
                    <!--begin::Close-->
                    <!--begin::Heading-->
                    <div class="">
                        <!--begin::Title-->
                        <h3 class="mb-3">Mark as Problem</h3>
                        <!--end::Title-->
                    </div>
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
                <div class="modal-body">
                    <!--begin:Form-->
                    <form id="mark_as_problem_form" method="POST" action="{{route('mark_as_problem')}}" class="form">
                        @csrf
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <div id="editIdContainer">

                                </div>
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Select options:</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a Profession name"></i>
                                </label>
                                <!--end::Label-->
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" name='paymentPending' value="0" id="paymentPending">
                                    <label class="custom-control-label" for="paymentPending">Payment Pending</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" name='SegmentNotActive' value="0" id="SegmentNotActive">
                                    <label class="custom-control-label" for="SegmentNotActive">Segment Not Active</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" name='PANCardPending' value="0" id="PANCardPending">
                                    <label class="custom-control-label" for="PANCardPending">PAN Card Pending</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" name='WrongInformation' value="0" id="WrongInformation">
                                    <label class="custom-control-label" for="WrongInformation">Wrong Information</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid m-2">
                                    <input type="checkbox" class="form-check-input markAsProblemCheckbox mx-3" name='Other' value="0" id="Other">
                                    <label class="custom-control-label" for="Other">Other</label>
                                </div>
                            </div>
                            <div class="m-2" id="WrongInformationTextDiv">
                                <label class="custom-control-label" for="Other">Wrong Information</label>
                                <textarea type="text" class="form-control mx-3" name='WrongInformationText' value="" id="WrongInformationText"></textarea>
                            </div>
                            <div class="m-2" id="OtherTextDiv">
                                <label class="custom-control-label" for="Other">Other</label>
                                <textarea type="text" class="form-control mx-3" name='OtherText' value="" id="OtherText"></textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-end">
                            <button type="reset" id="call_modal_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="call_modal_submit" class="btn btn-primary">
                                <span class="indicator-label">Add</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <div class="modal fade" id="viewImagesModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-lg">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0">
                    <!--begin::Close-->
                    <!--begin::Heading-->
                    <div class="">
                        <!--begin::Title-->
                        <h3 class="mb-3">Images</h3>
                        <!--end::Title-->
                    </div>
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
                <div class="modal-body">
                    <div class="row mb-8" id="viewImagesContainer">

                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-end">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">dismiss</button>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

    <div class="modal fade" id="feesPaymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('feesPayment')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Renew Fees Payment</h2>
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
                        <input class="form-control" type="hidden" value="" name='fees_payment_id' id="fees_payment_id"/>
                        <div class="form-group row">
                            <label for="fees_bank_id" class="col-3 col-form-label">Bank</label>
                            <div class="col-9">
                                <select name="fees_bank_id" id="fees_bank_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Bank">
                                    <option></option>
                                    @if(!empty($forIncomesBank))
                                        @foreach($forIncomesBank as $banks)
                                            <option value="{{$banks->id}}">{{$banks->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Fees Amount</label>
                            <div class="col-9">
                                <input class="form-control" type="number" id="fees_amount" name="fees_amount" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-body mx-md-10" id="fees_message" style="color: green;">
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
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                //fees payment
                $(document).on("click",".fees_pay_button",function(e){
                    const id=e.target.getAttribute("data-id");

                    $.ajax("{!! route('getRenewData') !!}",{
                        type:"POST",
                        data:{
                            id:id
                        }
                    }).done(data => {
                        $("#fees_message").html("Pay a "+data.renewal_fees+" fees for account renew.");
                        $("#fees_payment_id").val(data.id);
                        $("#fees_bank_id").val(data.bank_id).trigger('change');
                        $("#feesPaymentModal").modal("show");
                    });
                });

                $(document).on("click",".mark_as_problem",function(e){
                    const id = $(e.target).data("id");
                    if(id){
                        $("#mark_as_problem_modal").modal("show");
                        $("#editIdContainer").html(`<input type="hidden" name="demat_id" value="${id}">`);
                    }else{
                        window.alert("invalid demat account");
                    }
                })
                $(document).on("click",".markAsProblemCheckbox",function(e){
                    if($(this).is(":checked")){
                        $(this).val(1);
                    }else{
                        $(this).val(0);
                    }
                })
                $("#WrongInformation").on("click",function(e){
                    if($(this).is(":checked")){
                        $("#WrongInformationTextDiv").show();
                    }else{
                        $("#WrongInformationTextDiv").hide();
                    }
                })
                $("#WrongInformationTextDiv").hide();
                $("#Other").on("click",function(e){
                    if($(this).is(":checked")){
                        $("#OtherTextDiv").show();
                    }else{
                        $("#OtherTextDiv").hide();
                    }
                })
                $("#OtherTextDiv").hide();
                $(document).on("click",".terminateDemate",function(e){
                    if(!window.confirm("Are you sure you want to terminate this account?")){
                        e.preventDefault();
                    }
                })
                // view uploaded images
                $(document).on("click",".viewImage",function(e){
                    const id = e.target.getAttribute("data-id");
                    if(id){
                        $.ajax("{{route('viewRenewalAccountImages')}}",{
                            type:"POST",
                            data:{
                                id:id
                            }
                        })
                            .done(data=>{
                                if(data?.data){
                                    $("#viewImagesContainer").html(data.data);
                                    $("#viewImagesModal").modal("show");
                                }else{
                                    window.alert("Unable to get images");
                                }
                            })
                            .fail((err)=>{
                                if(err.status===403){
                                    window.alert("Unauthorized Action");
                                }else if(err.status===500){
                                    window.alert("Server Error");
                                }
                            })
                    }else{
                        window.alert("Unable to load this account");
                    }
                })
                $(".datatable").DataTable();
                $("select").select2();
            },jQuery)
        })
    </script>
@endsection


@extends('layout')
@section("page-title","INVOICE")
@section("content")
    <!--begin::Main-->
    <!--begin::Root-->
    <style>
        @media print {
            .header, .hide { visibility: hidden }
            @page {
                size: A4;
                margin-top: 0;
                margin-bottom: 0;
            }
            body,page[size="A4"]  {
                padding-top: 72px;
                padding-bottom: 72px ;
            }
        }
    </style>
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <div class="card">
                                <!-- begin::Body-->
                                <div class="card-body py-5">
                                    <!-- begin::Wrapper-->
                                    <div class="mw-lg-950px mx-auto w-100">
                                        <!-- begin::Header-->
                                        <div id="print_div">
                                            <!--begin::Body-->
                                            <div class="pb-12">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-column gap-3 gap-md-10">
                                                    <div class="d-flex justify-content-between flex-column flex-sm-row">
                                                        <h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">Profit And Patment Calculation</h4>
                                                    </div>
                                                    <!--begin::Message-->
                                                    <div class="fw-bolder fs-2">For,
                                                        <span class="text-muted fs-5">{{$demateDetails->st_sg}}-{{$demateDetails->serial_number}} - &nbsp;{{(null !== $demateDetails->withClient)?$demateDetails->withClient->name:""}}({{$demateDetails->holder_name}})</span><br>
                                                    </div>
                                                    <!--begin::Message-->
                                                    <!--begin::Separator-->
                                                    <div class="separator"></div>
                                                    <!--begin::Separator-->
                                                    <!--begin::Order details-->

                                                    <!--begin::Order details-->
                                                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                                        <div class="flex-root d-flex flex-column">
                                                            <h4><span>Profit Calculation</span><div class="separator"></div></h4>
                                                            <table class="table align-middle table-row-dashed fs-6 gy-2 mb-0">
                                                                <thead>
                                                                    <tr class="border-bottom fs-6 fw-bolder text-muted">
                                                                        <th class="min-w-175px pb-2 text-center">Description</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="fw-bold">
                                                                    <tr>
                                                                        <td>Joining Capital</td>
                                                                        <td>{{$demateDetails->capital}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Available Fund</td>
                                                                        <td>{{$demateDetails->available_balance}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Total Profit</td>
                                                                        <td>{{$demateDetails->final_pl}}</td>
                                                                    </tr>
                                                                    @if($renewData->promised_profit > 0)
                                                                        <tr>
                                                                            <td>Promised Profit</td>
                                                                            <td>{{$renewData->promised_profit}}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @if($renewData->access_profit > 0)
                                                                        <tr>
                                                                            <td>Access Profit(Total Profit - Promised Profit)</td>
                                                                            <td>{{$renewData->access_profit}}</td>
                                                                        </tr>
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                                        <div class="flex-root d-flex flex-column">
                                                            <span  class="text-center"><?= $message; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                                        <div class="flex-root d-flex flex-column">
                                                            <h4><span>Payment</span><div class="separator"></div></h4>
                                                            <table class="table align-middle table-row-dashed fs-6 gy-2 mb-0">
                                                                <thead>
                                                                <tr class="border-bottom fs-6 fw-bolder text-muted">
                                                                    <th class="min-w-175px pb-2 text-center">Description</th>
                                                                    <th class="text-center">Total</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="fw-bold">
                                                                @if($renewData->profit_sharing > 0 )
                                                                    <tr>
                                                                        <td>{{$service_data->sharing}}% Of Access Profit({{$renewData->access_profit}})</td>
                                                                        <td class="text-center">{{$renewData->profit_sharing}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($renewData->renewal_fees > 0 )
                                                                    <tr>
                                                                        <td>Renewal Fees</td>
                                                                        <td class="text-center">{{$renewData->renewal_fees}}</td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <td>Total Payment</td>
                                                                    <td class="text-center">{{$renewData->total_payment}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td  class="text-end">Round Of Amount</td>
                                                                    <td class="text-center">
                                                                        @if($renewData->round_of_amount > 0)
                                                                            @if($renewData->round_of_amount_type == "minus")
                                                                                -
                                                                            @else
                                                                                +
                                                                            @endif
                                                                            {{$renewData->round_of_amount}}
                                                                        @else
                                                                            0
                                                                        @endif

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fs-3 text-dark fw-bolder text-end">Grand Total</td>
                                                                    <td class="text-dark fs-3 fw-boldest text-center">{{$renewData->final_amount}}</td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                                        <div class="flex-root d-flex flex-column">
                                                            <h4><span>Bank Details</span><div class="separator"></div></h4>
                                                            <table class="table align-middle table-row-dashed fs-6 gy-2 mb-0">
                                                                </thead>
                                                                <tbody class="fw-bold">
                                                                <tr>
                                                                    <td>Bank Name</td>
                                                                    <td>{{$renewData->account_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Account no</td>
                                                                    <td>{{$renewData->account_no}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>IFSC Code</td>
                                                                    <td>{{$renewData->ifsc_code}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                                        <div class="flex-root d-flex flex-column">
                                                            @if($renewData->profit_sharing > 0 && $demateDetails->service_type == 2)
                                                                        <span style="color: red">Please Make Both Payment Separately Fees And Profit Sharing</span>
                                                            @endif
                                                            <span style="color: #009EF7">Kindly Clear Your Payment as soon as possible, So that We can take trade if possible.</span>
                                                        </div>
                                                    </div>

                                                    <!--end::Order details-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                        <!-- begin::Footer-->
                                        <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                                            <!-- begin::Actions-->
                                            <div class="my-1 me-5">
                                                <!-- begin::Pint-->
                                                <button type="button" class="btn btn-success my-1 me-12 hide" onclick="window.print();" value="Print">Print / Download Invoice</button>
                                                <!-- end::Pint-->
                                            </div>
                                            <!-- end::Actions-->
                                            <!-- begin::Action-->
                                            <a href="javascript:void(0)" class="btn btn-primary my-1 hide">Send</a>
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
                    <!--end::Footer-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $(()=>{

                },jQuery)
            })

            function pop_print(){
                w=window.open(null, 'Print_Page', 'scrollbars=yes');
                w.document.write(jQuery('.print_div').html());
                w.document.close();
                w.print();
            }
        </script>
@endsection


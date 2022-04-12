@extends('layout')
@section("page-title","INVOICE")
@section("content")
    <!--begin::Main-->
    <!--begin::Root-->
    <style>
        @media print {
            .header, .hide { visibility: hidden }
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }
            body  {
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
                                <div class="card-body py-20">
                                    <!-- begin::Wrapper-->
                                    <div class="mw-lg-950px mx-auto w-100">
                                        <!-- begin::Header-->
                                        <div id="print_div">
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


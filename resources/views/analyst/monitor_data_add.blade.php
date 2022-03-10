@extends('layout')
@section("page-title","Add Analysis")
@section("analysis.monitor","active")
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
                            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Add Monitor Data
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
                        <form class="form" novalidate="novalidate" action='{{route('createMonitorData')}}' method='post' id="kt_modal_create_app_form">
                        @csrf
                        <!--begin::Step 1-->
                        <div class="current d-block card p-7 my-5" data-kt-stepper-element="content">
                            <div class="w-100">
                                <div class="row mb-4">

                                    <!--begin::Input group-->
                                    <div class="col-4">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Analyst</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="analysts_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Analyst">
                                            @if(!empty($analysts))
                                                @foreach($analysts as $analyst)
                                                    <option value="{{$analyst->id}}">{{$analyst->analyst}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <!--end::Input-->
                                    </div>


                                    <!--begin::Input group-->
                                    <div class="col-4">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Date</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="date" class="form-control form-control-lg form-control-solid bdr-ccc" name="date" placeholder="" value="{{date('d-m-Y')}}" />
                                        <!--end::Input-->
                                    </div>

                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="col-4">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Script Name</span>
                                        </label>
                                        <!--end::Label-->

                                        <input list="script_name"  class="form-control form-control-lg form-control-solid bdr-ccc" name="script_name">
                                        <datalist id="script_name">
                                            @if(!empty($keywords))
                                                @foreach($keywords as $keyword)
                                                    <option value="{{$keyword->name}}">{{$keyword->name}}</option>
                                                @endforeach
                                            @endif
                                        </datalist>
{{--
                                        {{--                                        <!--begin::Input-->--}}
                                        {{--                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="script_name" placeholder="Enter Script Name" value="{{(old('script_name'))?old('script_name'):""}}" />--}}
                                        {{--                                        <!--end::Input-->--}}
                                    </div>
                                    <!--end::Input group-->
                                </div>

                                <div class="row mb-4">

                                    <!--begin::Input group-->
                                    <div class="col-4">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Buy / Sell</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="buy_sell" placeholder="Buy / Sell" value="{{old('buy_sell')}}" />
                                        <!--end::Input-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="col-4">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">sl</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="sl" placeholder="Enter SL" value="{{old('sl')}}" />
                                        <!--end::Input-->
                                    </div>

                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="col-4">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Target</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="target" placeholder="Enter Target" value="{{(old('target'))?old('target'):""}}" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>


                                <div class="row mb-4">

                                    <!--begin::Input group-->
                                    <div class="col-6">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Entry Price</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="entry_price" placeholder="Entry Price" value="{{old('entry_price')}}" />
                                        <!--end::Input-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="col-6">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Entry Time</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="time" class="form-control form-control-lg form-control-solid bdr-ccc" name="entry_time" placeholder="" value="{{old('entry_time')}}" />
                                        <!--end::Input-->
                                    </div>

                                    <!--end::Input group-->
                                </div>

                                <div class="row mb-4">

                                    <!--begin::Input group-->
                                    <div class="col-6">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Status</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="status" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Status">
                                            <option value="open">Open</option>
                                            <option value="close">Close</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="col-6">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Risk Reward</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="risk_reward" placeholder="Risk Reward" value="{{old('risk_reward')}}" />
                                        <!--end::Input-->
                                    </div>

                                    <!--end::Input group-->
                                </div>

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

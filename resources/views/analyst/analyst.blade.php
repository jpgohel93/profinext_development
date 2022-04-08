@extends('layout')
@section("page-title","Analysis - Analyst Management")
@section("analyst.analyst","active")
@section("analyst_management.accordion","hover show")
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
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Analysis</h1>
                                <!--end::Title-->
                                <!--begin::Separator-->
                                <span class="h-20px border-gray-200 border-start mx-4"></span>
                                <!--end::Separator-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        <a href="{{route('dashboard')}}" class="text-muted text-hover-primary">Home</a>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-dark">Analysis</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                            <!--begin::Actions-->
                            @can('analyst-create')
                                <div class="d-flex align-items-center py-1">
                                    <a href="{{route('createAnalystForm')}}" target="_blank" class="btn btn-sm btn-primary">
                                        <span class="svg-icon svg-icon-2">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
											<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
										</svg>
									</span>Add Analyst
                                    </a>
                                </div>
                            @endcan
                            <!--end::Actions-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Post-->
                    @can('analyst-read')
                        <div class="post d-flex flex-column-fluid" id="kt_post">
                            <!--begin::Container-->
                            <div id="kt_content_container" class="container-xxl">

                                <!--begin:::Tabs-->
                                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1 active"  data-bs-toggle="tab" href="#freeTradeTab">Free Trade</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1"  data-bs-toggle="tab" href="#paperTab">Paper Trade</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1"  data-bs-toggle="tab" href="#experimentTab">Experiment</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1"  data-bs-toggle="tab" href="#activeTab">Active</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1"  data-bs-toggle="tab" href="#terminatedTab">Terminated</a>
                                    </li>
                                    <!--end:::Tab item-->
                                    <!--begin:::Tab item-->
                                </ul>
                                <!--end:::Tabs-->

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="freeTradeTab" aria-labelledby="active-tab" role="tabpanel">
                                        <!--begin::Card-->
                                        <div class="card">
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-125px">Sr. No.</th>
                                                                <th class="min-w-125px">Analyst Name</th>
                                                                <th class="min-w-125px">No of Calls</th>
                                                                <th class="min-w-75px">Accuracy</th>
                                                                <th class="min-w-75px">Risk Reward</th>
                                                                @can('analyst-write')
                                                                    <th class="text-end min-w-100px">Actions</th>
                                                                @endcan
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                            @forelse ($analysts['free_trade'] as $analyst)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td class="d-flex align-items-center">
                                                                        <div class="d-flex flex-column">
                                                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$analyst->analyst}}</a>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{$analyst->total_calls}}</td>
                                                                    <td>{{$analyst->accuracy}}</td>
                                                                    <td>{{$analyst->reward}}</td>
                                                                    @can('analyst-write')
                                                                        <td class="text-end">
                                                                            <div class="d-flex justify-content-end align-items-center">
                                                                                <div class="menu-item px-3">
                                                                                    <a href="javascript:void(0)" class="menu-link px-3 viewAnalyst" data-id='{{$analyst->id}}'>
                                                                                        <img style="height:24px" src="data:image/png;base64,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"/>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    @endcan
                                                                </tr>
                                                            @empty
                                                                {{-- <h3>There's no Active Analysts. click <a href='{{route('createAnalystForm')}}'>here</a> to Add new Analyst</h3> --}}
                                                            @endforelse
                                                            <!--end::Table row-->
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <div class="tab-pane fade" id="paperTab" aria-labelledby="problem-tab" role="tabpanel">
                                        <!--begin::Card-->
                                        <div class="card">
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                        <thead>
                                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-125px">Sr. No.</th>
                                                                <th class="min-w-125px">Client Name</th>
                                                                <th class="min-w-125px">No of Calls</th>
                                                                <th class="min-w-75px">Accuracy</th>
                                                                <th class="min-w-75px">Risk Reward</th>
                                                                @can('analyst-write')
                                                                    <th class="text-end min-w-100px">Actions</th>
                                                                @endcan
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                            @forelse ($analysts['paper_trade'] as $analyst)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td class="d-flex align-items-center">
                                                                        <div class="d-flex flex-column">
                                                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$analyst->analyst}}</a>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{$analyst->total_calls}}</td>
                                                                    <td>{{$analyst->accuracy}}</td>
                                                                    <td>{{$analyst->reward}}</td>
                                                                    @can('analyst-write')
                                                                        <td class="text-end">
                                                                            <div class="d-flex justify-content-end align-items-center">
                                                                                <div class="menu-item px-3">
                                                                                    <a href="javascript:void(0)" class="menu-link px-3 viewAnalyst" data-id='{{$analyst->id}}'>
                                                                                        <img style="height:24px" src="data:image/png;base64,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"/>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    @endcan
                                                                </tr>
                                                            @empty
                                                                {{-- empty --}}
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <div class="tab-pane fade" id="experimentTab" aria-labelledby="renewal-tab" role="tabpanel">
                                        <!--begin::Card-->
                                        <div class="card">
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-125px">Sr. No.</th>
                                                                <th class="min-w-125px">Client Name</th>
                                                                <th class="min-w-125px">No of Calls</th>
                                                                <th class="min-w-75px">Accuracy</th>
                                                                <th class="min-w-75px">Risk Reward</th>
                                                                @can('analyst-write')
                                                                <th class="text-end min-w-100px">Actions</th>
                                                                @endcan
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                            @forelse ($analysts['experiment'] as $analyst)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td class="d-flex align-items-center">
                                                                        <div class="d-flex flex-column">
                                                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$analyst->analyst}}</a>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{$analyst->total_calls}}</td>
                                                                    <td>{{$analyst->accuracy}}</td>
                                                                    <td>{{$analyst->reward}}</td>
                                                                    @can('analyst-write')
                                                                        <td class="text-end">
                                                                            <div class="d-flex justify-content-end align-items-center">
                                                                                <div class="menu-item px-3">
                                                                                    <a href="javascript:void(0)" class="menu-link px-3 viewAnalyst" data-id='{{$analyst->id}}'>
                                                                                        <img style="height:24px" src="data:image/png;base64,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"/>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    @endcan
                                                                </tr>
                                                            @empty
                                                                {{-- <h3>There's no Experiment Analysts. click <a href='{{route('createAnalystForm')}}'>here</a> to Add new Analyst</h3> --}}
                                                            @endforelse
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <div class="tab-pane fade show" id="activeTab" aria-labelledby="active-tab" role="tabpanel">
                                        <!--begin::Card-->
                                        <div class="card">
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-125px">Sr. No.</th>
                                                                <th class="min-w-125px">Analyst Name</th>
                                                                <th class="min-w-125px">No of Calls</th>
                                                                <th class="min-w-75px">Accuracy</th>
                                                                <th class="min-w-75px">Risk Reward</th>
                                                                @can('analyst-write')
                                                                    <th class="text-end min-w-100px">Actions</th>
                                                                @endcan
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                            @forelse ($analysts['active'] as $analyst)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td class="d-flex align-items-center">
                                                                        <div class="d-flex flex-column">
                                                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$analyst->analyst}}</a>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{$analyst->total_calls}}</td>
                                                                    <td>{{$analyst->accuracy}}</td>
                                                                    <td>{{$analyst->reward}}</td>
                                                                    @can('analyst-write')
                                                                        <td class="text-end">
                                                                            <div class="d-flex justify-content-end align-items-center">
                                                                                <div class="menu-item px-3">
                                                                                    <a href="javascript:void(0)" class="menu-link px-3 viewAnalyst" data-id='{{$analyst->id}}'>
                                                                                        <img style="height:24px" src="data:image/png;base64,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"/>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    @endcan
                                                                </tr>
                                                            @empty
                                                                {{-- <h3>There's no Active Analysts. click <a href='{{route('createAnalystForm')}}'>here</a> to Add new Analyst</h3> --}}
                                                            @endforelse
                                                            <!--end::Table row-->
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <div class="tab-pane fade" id="terminatedTab" aria-labelledby="terminated-tab" role="tabpanel">
                                        <!--begin::Card-->
                                        <div class="card">
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-125px">Sr. No.</th>
                                                                <th class="min-w-125px">Client Name</th>
                                                                <th class="min-w-125px">No of Calls</th>
                                                                <th class="min-w-75px">Accuracy</th>
                                                                <th class="min-w-75px">Risk Reward</th>
                                                                @can('analyst-write')
                                                                    <th class="text-end min-w-100px">Actions</th>
                                                                @endcan
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                            @forelse ($analysts['terminated'] as $analyst)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td class="d-flex align-items-center">
                                                                        <div class="d-flex flex-column">
                                                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$analyst->analyst}}</a>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{$analyst->total_calls}}</td>
                                                                    <td>{{$analyst->accuracy}}</td>
                                                                    <td>{{$analyst->reward}}</td>
                                                                    @can('analyst-write')
                                                                        <td class="text-end">
                                                                            <div class="d-flex justify-content-end align-items-center">
                                                                                <div class="menu-item px-3">
                                                                                    <a href="javascript:void(0)" class="menu-link px-3 viewAnalyst" data-id='{{$analyst->id}}'>
                                                                                        <img style="height:24px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAABmJLR0QA/wD/AP+gvaeTAAAIRElEQVR4nO2deWxURRzHP0tLi0rLYSyHQVEQixYVBA+URE1UhGAIcmkiGDUmEgGNCKjxiKiJATRovBIFTUQEDajlUP4SJGgwohGwlEPuSw4B0ULL7vrHb1fWsu37vTfzdl9xPsmkTXcz39+8Od7Mb34zBYfD4XA4HA6Hw+FwOBwOh8PhcDgcjjObWL4NCEAhUAa0B9oiZWid+uwwkAQOAXuB34GTebAxMFGvkK7A9UBvoDyVOqG3OwlsB6qBKuBHYCWw2bqlZyilwHBgFrAHeaBhpD0pjWEpTUcGBcAgYB5QQ3iV0FD6G/gEGAg0C7mskaYV8ASwhdxXQkOpCngAKA6x3JGjFHgWefHmuwIaSruAiUBJSM8gMgwCdpD/B65Ne4BRRH/y45tLgaXk/wEHTcuACutPJQ8UAi8DdeT/oZqmWuDFVJlCI8yu2AmYA9xgIa+/gFXAemRNsR7Ynfr7H6mfSaAlskg8B+iI9Mzy1M9rU5+bsgK4G9hpIa+cMQA4gFmL/AF4HugHFFmwqRBpHM8A3xnath/ob8GmnPA0kCBYQXcDrwCX5cDObsAUZCUfxNYEMDkHdgYmBkwjWOG2AOOBFjm3WhaDw4B1PuzNTG8QwQVlMbLSDtIjRhPyi1JJM8RtsxX/5ZiDnWHVCsXA1/ifsUwnmn6ks5GhzK8bZzERqJQC/PeMKqBXPoz1STmwGn9lW0Aee3sM+NDDwPrpXWRK2lQoBl7F3yRlFgbLCZN1yDTgceV364AxwHsGepmUItPhCuBCxFEJcATYBqwFvgWOWtIbCcwEzlJ+fxriOM0Z96FvMQeBmyxoFiIPZimyC+ilWwd8BYxAhlZT+iCTEG25R1nQVNEXOK40ag92fEBDkV0+v7OfdNoEDLFgRxf02wU1iHcgVNqj38nbBlxiqNcW+Fypp0nzgTaGNnVC3DcavV3I/n8oxJAhQGPIXswroytmvaKhtBFp6SZcgH6Fv4iQfIaPKQ04DPQ01OpKuHvquzGvlO6IT0ujN85Q6zR6oHtvxJG9aRPaEk7PyNZT0uFDQbkZ3dZCDXC5oda/FADfK0STiHfWFJvvDK/0mQV7Jyi1VmLJ5zVeKbjIguBQpVZmj1yT0l6U+j3uM4/BhjbHgE+VWo8YatER+FMhtBnz2Ush+qHqIBKE0D5LPh0Qt7g2iGID5uuUEuBXhdbRlH2B+UAhchI78+2RCq0ksr99niK/MmC5Ms/hFuy/EnGaemnNDCpwNbruPz2oQD00QRDL8OdRLUJXKUuslABeUmjFCehcXaTIfDPirjalFd7ukIPoekZ9yvAevuqwE4PVAvFmez23hX4z7qPINAHcYlqCFAMVehMN8p+kyP8Og/wzuRGdd7i3n0wXKjKcZ8V8YbKHVpzsL3At7fAefm16Zz/20EoCX2oz64V3Dddi7hrJ5G0PvV8saKz10HjTgkaai4ETHnoJsng0sq0bxuHte3kHWenawmv8thEDtcPjc5vbyb8Bb3l8JwaMrf/HbBWSUAjGFd+xiQ3nXK7jczWzwaQmo554D1nHgYsCmZkdryFrjQWNXA5Z3fBekySAq7QZVnpklgRmWzPfexYUx2yF2xHvRjbBIP/6LPDQSgJf+MmwtyLDODLFs8EAhZ5JlOCTivxthYbeptBK4HPaC7qpbxV2ThuV4u3GPkSw3bd2SEB2Y3nXYmdh2BLdFm9lkMx7oXOdTDEpQQaaYLvl+HOdFCPRJ175LrZSApih0IpjsIE3UyFQC1wRVCCDEQqtdKVoXCjt0FVGEontNaUvugZsFArVAXEZe4msw/zsRQGyttE8wEPIRCDbi74j8s7wGqbSqRpz9/u56IaqI0hDMWKsQigJzMV8rj9EqZXZ/dchQ87i1O9+j0LcaWhzAfrY5jGGWoAsHrUHXLSRjI0xX6llI9nwx2lc7knk5JW1YwsV6KLB6zCPUmyDfugySdWcCkENymB0PbIGiVKxinZvfT8SOW5CF/yFbfpNuzD3NPRB935NYmEvPRsxZJzWGLAdifAzoQvh9JRqzCvDT0xWJSH60dqhb7nVmFdKayRUx1ZlzMN8mCpHvM8avZ0E2+X0xXXoTxdtwTxCEGSs3qDUbKhxmM6mQNZb+5SaNciwlhNGK41KIj3KhmEFSHTIEnTRgrXIEDsMO8cRbsHf/Sz3BhExGdumoveQ1gD3I9cg2aAEcWxWAJ3574GdrYi7fgVwzJLew4hbpLny+1MxiwEIRAw5vqVtMQngNZrW1Ucl+CtjEnE35e2ymgL8v3R/xmLgcYhcg/9Z3lzsDI9GFKGfDqfTcWSFayOmyzatgdfxf2FOJfohLXSKkMPzfmc/25EQ0ijchNAceBD9LCozfUSEKiNNDHmZ+S1MEomAfIj8FKoIOaAZdFo9g2g0qAaZhP8jAem0AxnKTF0vGnogcclBT2rFyfHRZxNuRy4xDlLQdFoFPIecR7fRc4qRE09TgJ8MbdsH3GrBptMIc3p2PvJe6Wchr/QFZunLy9YjLfsYcqYxvd5IX2BWimxedUdCcroji1Ptwf/GWAbcgyx4mxyFwAvozk1EPZ1AjuzlfVprg274vzEoSukbmsbayTeDCH6DWz7Sbs7Qa2IzKUGuATS9kzHMdAB4iv/BRcqZlCCXEWwi/xWQThuBR7Fze2mTpRlyemk2p657zWU6hqy0+xPxBV4+aAncBbyP7HuHVQm7kIC1IUTsQrWov6w6IxGBvZBZTjly8Yu2JSeQW4mqkZit1ciNClutW2qJqFdINgqQoOsyTu1XZ/7LIxAvwf7Uz1wfLnI4HA6Hw+FwOBwOh8PhcDgcDofD4XA0wj+KPdB3FWpWuQAAAABJRU5ErkJggg=="/>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    @endcan
                                                                </tr>
                                                            @empty
                                                                {{-- <h3>There's no Terminated Analysts. click <a href='{{route('createAnalystForm')}}'>here</a> to Add new Analyst</h3> --}}
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Post-->
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
		<!--begin::Modal - View Analyst Details-->
		<div class="modal fade" id="viewAnalyst" tabindex="-1" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered mw-650px" role="document">
                <form id="" class="form" method="POST" action="{{route('editAnalyst')}}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="fw-bolder">Analyst Details</h2>
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
                            <input type="hidden" name="analyst_id" id="editAnalystId" value="{{old('analyst_id')}}">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Analyst</label>
                                <div class="col-9">
                                    <input class="form-control" name="analyst" type="text" value="{{old('analyst')}}" id="analyst"  />
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="no-of-demat" class="col-3 col-form-label">Status</label>
                                <div class="col-9">
                                    <select name="status" id="analyst_status" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Status">
                                        <option></option>
                                        <option value="Free Trade" {{(old('status')=="Free Trade")?"selected":""}}>Free Trade</option>
                                        <option value="Paper Trade" {{(old('status')=="Paper Trade")?"selected":""}}>Paper Trade</option>
                                        <option value="Experiment" {{(old('status')=="Experiment")?"selected":""}}>Experiment</option>
                                        <option value="Active" {{(old('status')=="Active")?"selected":""}}>Active</option>
                                        <option value="Terminated" {{(old('status')=="Terminated")?"selected":""}}>Terminated</option>
                                    </select>
                                </div>
                            </div><br>
                            <div class="form-group row mb-0">
                                <label for="assign_user" class="col-3 col-form-label">Monitor</label>
                                <div class="col-9">
                                    <select name="assign_user_id" id="assign_user" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Monitor">
                                        <option></option>
                                        @if(!empty($monitor))
                                            @foreach($monitor as $monitorData)
                                                <option value="{{$monitorData->id}}">{{$monitorData->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--end::Modal body-->
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-primary" id="closeModel">
                                <span class="indicator-label">Cancle</span>
                            </button>
                            <button type="submit" id="editAnalyst" class="btn btn-primary" data-kt-users-modal-action="submit">
                                <span class="indicator-label">Save</span>
                            </button>
                            {{-- <button type="button" id="terminate" name="terminate" class="btn btn-light me-3">Terminate</button> --}}
                        </div>
                    </div>
                </form>
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
            $(()=>{
                $(".datatable").DataTable();
                const analyst = $("#analyst");
                const total_colls = $("#total_colls");
                const accuracy = $("#accuracy");
                const analyst_status = $("#analyst_status");
                const trading_capacity = $("#trading_capacity");
                const editAnalystId = $("#editAnalystId");
                const editAnalyst = $("#editAnalyst");
                const assignUser = $("#assign_user");

                $(document).on("click",".viewAnalyst",function(){
                    $.ajax("/analyst/"+$(this).attr("data-id"),{
                        type:"GET",
                        headers: {
                            'X-CSRF-TOKEN': $("input[name='_token']").val()
                        }
                    })
                    .done(data=>{
                        $(analyst).val(data.analyst);
                        $(total_colls).val(data.total_calls);
                        $(accuracy).val(data.accuracy);
                        $(trading_capacity).val(data.trading_capacity);
                        $(analyst_status).val(data.status);
                        $(analyst_status).trigger("change");
                        $(assignUser).val(data.assign_user_id);
                        $(assignUser).trigger("change");
                        $(editAnalyst).val(data.id);
                        $(editAnalystId).val(data.id);
                        $("#viewAnalyst").modal("show");
                    })
                })
                $("#viewAnalyst").modal("hide");
                $("#closeModel").on("click",function(){
                    $("#viewAnalyst").modal("hide");
                })
            }, jQuery)
        })
    </script>
@endsection

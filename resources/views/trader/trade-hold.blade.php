@extends('layout')
@section("page-title","Trade holding - Trader")
@section("tradeHolding","active")
@section("trade_management.accordion","hover show")
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
                    <div class="toolbar" id="kt_toolbar">
						<!--begin::Container-->
						<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
							<!--begin::Page title-->
							<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
								<!--begin::Title-->
								<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Trader</h1>
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
									<li class="breadcrumb-item text-dark">trade hold</li>
									<!--end::Item-->
								</ul>
								<!--end::Breadcrumb-->
							</div>
							<!--end::Page title-->
						</div>
						<!--end::Container-->
					</div>
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body pt-5">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                            <thead>
                                                <tr
                                                    class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-10px">Sr No.</th>
                                                    <th class="min-w-10px">Serial Number</th>
                                                    <th class="min-w-75px">Holder Name</th>
                                                    <th class="min-w-75px">Broker</th>
                                                    <th class="min-w-75px">User Id</th>
                                                    <th class="min-w-75px">Password</th>
                                                    <th class="min-w-75px">MPIN</th>
                                                    <th class="min-w-75px">Available Fund</th>
                                                    <th class="min-w-75px">Profit / Loss</th>
                                                    <th class="min-w-75px">Day of Joining</th>
                                                    <th class="min-w-75px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                @forelse($holding as $account)
                                                    @php
                                                        $datetime1 = strtotime($account->created_at);
                                                        $datetime2 = strtotime(date("Y-m-d"));
                                                        $days = (int)(($datetime2 - $datetime1)/86400);
                                                    @endphp
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td> {{$account->st_sg."-".$account->serial_number}} </td>
                                                        <td> {{$account->holder_name}}</td>
                                                        <td> {{$account->broker}}</td>
                                                        <td class="copy" style="cursor: copy;" title="copy text"> {{$account->user_id}}</td>
                                                        <td class="copy" style="cursor: copy;" title="copy text"> {{$account->password}}</td>
                                                        <td class="copy" style="cursor: copy;" title="copy text"> {{$account->mpin}}</td>
                                                        <td> {{$account->available_balance}}</td>
                                                        <td> {{$account->pl}}</td>
                                                        <td> {{ $days }}</td>
                                                        <td class="text-end">
                                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                <span class="svg-icon svg-icon-5 m-0">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                        </svg>
                                                                    </span>
                                                            </a>
                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                @can("client-demat-write")
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript:void(0)" data-id='{{$account->id}}' data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' class="menu-link px-3 editDematAccount">Update Status</a>
                                                                    </div>
                                                                @endcan
                                                                <div class="menu-item px-3">
                                                                    <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 changeStatus" data-value="normal">Remove as Holding</a>
                                                                </div>
                                                                <div class="menu-item px-3">
                                                                    <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 holdingDematAccount"  data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' data-value="holding">Add Holding</a>
                                                                </div>
                                                                <div class="menu-item px-3">
                                                                    <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 viewDematHolding"  data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' data-value="holding">View Holding</a>
                                                                </div>
                                                                <div class="menu-item px-3">
                                                                    <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 changeStatus" data-value="renew">Send for Renew</a>
                                                                </div>
                                                                <div class="menu-item px-3">
                                                                    <a href="javascript:void(0)" data-id='{{$account->id}}' class="menu-link px-3 problemDematAccount" data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' data-value="problem">Make as Problem</a>
                                                                </div>
                                                            </div>
                                                        </td>
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
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $(".datatable").DataTable();
            },jQuery)
        })
    </script>
@endsection
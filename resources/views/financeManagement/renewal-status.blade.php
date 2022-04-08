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
                    <!--begin::Toolbar-->
                    <div class="toolbar" id="kt_toolbar">
                        <!--begin::Container-->
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Finance Management</h1>
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
                                    <li class="breadcrumb-item text-dark">Renewal Status</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin:::Tabs-->
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1 active" data-bs-toggle="tab"
                                       href="#preRenew">Pre Renew</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#toRenew">To Renew</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#new">New</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#partPayment">Part Payment</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#renewed">Renewed</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="preRenew" aria-labelledby="active-tab"
                                     role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable" id="kt_table_users">
                                                    @if (isset($preRenewAccounts))
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-10px">Sr No.</th>
                                                                <th class="min-w-75px">Smart Id</th>
                                                                <th class="min-w-75px">Joining Date</th>
                                                                <th class="min-w-75px">Demat Holder Name</th>
                                                                <th class="min-w-75px">Available Fund</th>
                                                                <th class="min-w-75px">P / L</th>
                                                                <th class="min-w-75px">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                            @php
                                                                $i=1;
                                                            @endphp
                                                            @foreach($preRenewAccounts as $preRenewAccount)
                                                                <?php $joining_date = !empty($preRenewAccount->joining_date) && isset($preRenewAccount->joining_date) ? $preRenewAccount->joining_date : $preRenewAccount->created_at;?>
                                                                <tr>
                                                                    <td>{{$preRenewAccount->serial_number}}</td>
                                                                    <td>{{$preRenewAccount->st_sg}}</td>
                                                                    <td>{{date("Y-m-d",strtotime($joining_date))}}</td>
                                                                    <td>{{$preRenewAccount->holder_name}}</td>
                                                                    <td>{{$preRenewAccount->available_balance}}</td>
                                                                    <td>{{$preRenewAccount->pl}}</td>
                                                                    <td>
                                                                        <a href="/financeManagement/clientDematDataView/{{$preRenewAccount->id}}/{{1}}" target="_blank" class='verifyDemate'>Verify</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    @else
                                                        <h3>No Clients Found</h3>
                                                    @endif
                                                <!--end::Table body-->
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <div class="tab-pane fade show" id="toRenew" aria-labelledby="active-tab"
                                     role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                @if (isset($toRenewAccounts))
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-10px">Sr No.</th>
                                                                <th class="min-w-75px">Smart Id</th>
                                                                <th class="min-w-75px">Joining Date</th>
                                                                <th class="min-w-75px">Demat Holder Name</th>
                                                                <th class="min-w-75px">Available Fund</th>
                                                                <th class="min-w-75px">P / L</th>
                                                                <th class="min-w-75px">Service Type</th>
                                                                <th class="min-w-75px">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                            @php
                                                                $i=1;
                                                            @endphp
                                                            @foreach($toRenewAccounts as $toRenewAccount)
                                                                <?php $joining_date = !empty($toRenewAccount->joining_date) && isset($toRenewAccount->joining_date) ? $toRenewAccount->joining_date : $toRenewAccount->created_at;?>
                                                                <tr>
                                                                    <td>{{$toRenewAccount->serial_number}}</td>
                                                                    <td>{{$toRenewAccount->st_sg}}</td>
                                                                    <td>{{date("Y-m-d",strtotime($joining_date))}}</td>
                                                                    <td>{{$toRenewAccount->holder_name}}</td>
                                                                    <td>{{$toRenewAccount->available_balance}}</td>
                                                                    <td>{{$toRenewAccount->pl}}</td>
                                                                    <td>
                                                                            @if($toRenewAccount->service_type == 1)
                                                                                Prime
                                                                            @elseif($toRenewAccount->service_type == 2)
                                                                                AMS
                                                                            @elseif($toRenewAccount->service_type == 3)
                                                                                Prime Next
                                                                            @endif
                                                                        </td>
                                                                    <td>
                                                                        <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                            @if($toRenewAccount->service_type == 2 && $toRenewAccount->is_pay_fee == 0)
                                                                                <div class="menu-item px-3">
                                                                                    <a href="javascript:void(0)" data-id="{{$toRenewAccount->id}}" class='menu-link px-3 fees_pay_button'>
                                                                                        Fees Invoice
                                                                                    </a>
                                                                                </div>
                                                                            @endif
                                                                            @if($toRenewAccount->profit_sharing > 0 && $toRenewAccount->profit_sharing != '' && $toRenewAccount->is_pay_profit_sharing == 0 )
                                                                                <div class="menu-item px-3">
                                                                                    <a href="javascript:void(0)" data-id="{{$toRenewAccount->id}}" class='menu-link px-3 profit_sharing_button'>
                                                                                        Profit Sharing Invoice
                                                                                    </a>
                                                                                </div>
                                                                            @endif
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" data-id="{{$toRenewAccount->id}}" class='menu-link px-3 part_payment_button'>
                                                                                    Part Payment
                                                                                </a>
                                                                            </div>
                                                                            @if($toRenewAccount->service_type == 2 && $toRenewAccount->is_pay_fee == 0)
                                                                               <div class="menu-item px-3">
                                                                                   <a href="javascript:void(0)" data-id="{{$toRenewAccount->id}}" class='menu-link px-3 full_payment_button'>
                                                                                       Full Payment
                                                                                   </a>
                                                                               </div>
                                                                            @endif

                                                                            <div class="menu-item px-3">
                                                                                <a href="{{route('clientDematView',$toRenewAccount->id)}}" target="_blank" class='menu-link px-3 verifyDemate'>Generate Invoice</a>
                                                                            </div>
                                                                            <div class="menu-item px-3">
                                                                                <a href="{{route('clientDematTerminate',$toRenewAccount->id)}}" class='menu-link px-3 terminateDemate'>Terminate</a>
                                                                            </div>
                                                                            <div class="menu-item px-3">
                                                                                <a href="javascript:void(0)" data-id="{{$toRenewAccount->id}}" class="menu-link px-3 viewImage">View image</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    @else
                                                        <h3>No Clients Found</h3>
                                                    @endif
                                                <!--end::Table body-->
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <div class="tab-pane fade show" id="new" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable" id="kt_table_users">
                                                    @if (isset($newAccounts))
                                                            <!--begin::Table head-->
                                                            <thead>
                                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                    <th class="min-w-10px">Sr No.</th>
                                                                    <th class="min-w-75px">Smart Id</th>
                                                                    <th class="min-w-75px">Joining Date</th>
                                                                    <th class="min-w-75px">Demat Holder Name</th>
                                                                    <th class="min-w-75px">Joining Capital</th>
                                                                    <th class="min-w-75px">Available Fund</th>
                                                                    <th class="min-w-75px">P / L</th>
                                                                    <th class="min-w-75px">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                                @php
                                                                    $i=1;
                                                                @endphp
                                                                @foreach($newAccounts as $newAccount)
                                                                    <?php $joining_date = !empty($newAccount->joining_date) && isset($newAccount->joining_date) ? $newAccount->joining_date : $newAccount->created_at;?>

                                                                    <tr>
                                                                        <td>{{$newAccount->serial_number}}</td>
                                                                        <td>{{$newAccount->st_sg}}</td>
                                                                        <td>{{date("Y-m-d",strtotime($joining_date))}}</td>
                                                                        <td>{{$newAccount->holder_name}}</td>
                                                                        <td>{{$newAccount->capital}}</td>
                                                                        <td>{{$newAccount->available_balance}}</td>
                                                                        <td>{{$newAccount->pl}}</td>
                                                                        <td>
                                                                            <a href="{{route('clientDematView',$newAccount->id)}}" target="_blank" class='newGenerateInvoice'>
                                                                                <i class="fas fa-file text-primary fa-lg" data-id="{{$newAccount->id}}"></i>
                                                                            </a>
                                                                            <a href="javascript:void(0)" data-id="{{$newAccount->id}}" class='mark_as_problem'>
                                                                                <i class="fas fa-exclamation-circle text-warning fa-lg" data-id="{{$newAccount->id}}"></i>
                                                                            </a>
                                                                            <a href="javascript:void(0)" data-id="{{$newAccount->id}}" class='mark_as_problem'>
                                                                                <i class="fas fa-trash text-danger fa-lg" data-id="{{$newAccount->id}}"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        @else
                                                            <h3>No Clients Found</h3>
                                                        @endif
                                                <!--end::Table body-->
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <div class="tab-pane fade show" id="renewed" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable" id="kt_table_users">
                                                    @if (isset($renewedAccounts))
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-10px">Sr No.</th>
                                                                <th class="min-w-75px">Smart Id</th>
                                                                <th class="min-w-75px">Joining Date</th>
                                                                <th class="min-w-75px">Demat Holder Name</th>
                                                                <th class="min-w-75px">Available Fund</th>
                                                                <th class="min-w-75px">P / L</th>
                                                                <th class="min-w-75px">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                            @php
                                                                $i=1;
                                                            @endphp
                                                            @foreach($renewedAccounts as $renewedAccount)
                                                                <?php $joining_date = !empty($renewedAccount->joining_date) && isset($renewedAccount->joining_date) ? $renewedAccount->joining_date : $renewedAccount->created_at;?>
                                                                <tr>
                                                                    <td>{{$renewedAccount->serial_number}}</td>
                                                                    <td>{{$renewedAccount->st_sg}}</td>
                                                                    <td>{{date("Y-m-d",strtotime($joining_date))}}</td>
                                                                    <td>{{$renewedAccount->holder_name}}</td>
                                                                    <td>{{$renewedAccount->available_balance}}</td>
                                                                    <td>{{$renewedAccount->pl}}</td>
                                                                    <td>
                                                                        <a href="{{route('clientDematView',$renewedAccount->id)}}" target="_blank"class='verifyDemate'>Edit</a><br/>
                                                                        <a href="{{route('clientDematView',$renewedAccount->id)}}" target="_blank"class='verifyDemate'>View Invoice</a><br/>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    @else
                                                        <h3>No Clients Found</h3>
                                                    @endif
                                                <!--end::Table body-->
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <div class="tab-pane fade show" id="partPayment" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable" id="kt_table_users">
                                                    @if (isset($partPaymentData))
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="min-w-10px">Sr No.</th>
                                                                <th class="min-w-75px">Smart Id</th>
                                                                <th class="min-w-75px">Client Name</th>
                                                                <th class="min-w-75px">Demat Holder Name</th>
                                                                <th class="min-w-75px">Joining Date</th>
                                                                <th class="min-w-75px">Unpaid Amount</th>
                                                                <th class="min-w-75px">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                            @php
                                                                $i=1;
                                                            @endphp
                                                            @foreach($partPaymentData as $renewedAccount)
                                                                <?php $joining_date = !empty($renewedAccount->joining_date) && isset($renewedAccount->joining_date) ? $renewedAccount->joining_date : $renewedAccount->created_at;?>
                                                                <tr>
                                                                    <td>{{$i++}}</td>
                                                                    <td>{{$renewedAccount->st_sg}} - {{$renewedAccount->serial_number}}</td>
                                                                    <td>{{$renewedAccount->holder_name}}</td>
                                                                    <td>{{$renewedAccount->name}}</td>
                                                                    <td>{{date("Y-m-d",strtotime($joining_date))}}</td>
                                                                    <td><?php echo $renewedAccount->final_amount - $renewedAccount->part_payment;  ?></td>
                                                                    <td>
                                                                        <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                            <a href="javascript:void(0)" data-id="{{$toRenewAccount->id}}" class='menu-link px-3 part_payment_button'>
                                                                                Add Unpaid Amount
                                                                            </a>
                                                                            <div class="menu-item px-3">
                                                                                <a href="{{route('clientDematView',$renewedAccount->id)}}" class='menu-link px-3'>Reminder </a>
                                                                            </div>

                                                                            <div class="menu-item px-3">
                                                                                <a href="{{route('clientDematView',$renewedAccount->id)}}" class='menu-link px-3 '>View Payment </a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    @else
                                                        <h3>No Clients Found</h3>
                                                    @endif
                                                <!--end::Table body-->
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
                                <select name="fees_bank_id" id="fees_bank_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Bank">
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
    <div class="modal fade" id="partPaymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('partPayment')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Part Payment</h2>
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
                        <input class="form-control" type="hidden" value="" name='part_payment_id' id="part_payment_id"/>
                        <div class="form-group row">
                            <label for="part_bank_id" class="col-3 col-form-label">Bank</label>
                            <div class="col-9">
                                <select name="part_bank_id" id="part_bank_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Bank">
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
                                <input class="form-control" type="number" id="part_amount" name="part_amount" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-body mx-md-10" id="part_message" style="color: green;">
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
    <div class="modal fade" id="fullPaymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('fullPayment')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Payment</h2>
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
                        <input class="form-control" type="hidden" value="" name='full_payment_id' id="full_payment_id"/>
                        <div class="form-group row">
                            <label for="full_bank_id" class="col-3 col-form-label">Bank</label>
                            <div class="col-9">
                                <select name="full_bank_id" id="full_bank_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Bank">
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
                                <input class="form-control" type="number" id="full_amount" name="full_amount" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-body mx-md-10" id="full_message" style="color: green;">
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
    <div class="modal fade" id="profitSharingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('profitSharingPayment')}}">
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
                        <input class="form-control" type="hidden" value="" name='profit_sharing_payment_id' id="profit_sharing_payment_id"/>
                        <div class="form-group row">
                            <label for="fees_bank_id" class="col-3 col-form-label">Bank</label>
                            <div class="col-9">
                                <select name="profit_bank_id" id="profit_bank_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Bank">
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
                                <input class="form-control" type="number" id="profit_amount" name="profit_amount" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-body mx-md-10" id="profit_message" style="color: green;">
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

                //profit sharing payment
                $(document).on("click",".profit_sharing_button",function(e){
                    const id=e.target.getAttribute("data-id");

                    $.ajax("{!! route('getRenewData') !!}",{
                        type:"POST",
                        data:{
                            id:id
                        }
                    }).done(data => {
                        $("#profit_message").html("Pay a "+data.profit_sharing+" profit sharing for account renew.");
                        $("#profit_sharing_payment_id").val(data.id);
                        $("#profit_bank_id").val(data.bank_id).trigger('change');
                        $("#profitSharingModal").modal("show");
                    });
                });

                //part payment
                $(document).on("click",".part_payment_button",function(e){
                    const id=e.target.getAttribute("data-id");

                    $.ajax("{!! route('getRenewData') !!}",{
                        type:"POST",
                        data:{
                            id:id
                        }
                    }).done(data => {
                        $("#part_message").html( data.final_amount+ " total payment for account renew.");
                        $("#part_payment_id").val(data.id);
                        $("#part_bank_id").val(data.bank_id).trigger('change');
                        $("#partPaymentModal").modal("show");
                    });
                });

                //full payment
                $(document).on("click",".full_payment_button",function(e){
                    const id=e.target.getAttribute("data-id");

                    $.ajax("{!! route('getRenewData') !!}",{
                        type:"POST",
                        data:{
                            id:id
                        }
                    }).done(data => {
                        $("#full_message").html( data.final_amount+ " total payment for account renew.");
                        $("#full_payment_id").val(data.id);
                        $("#full_bank_id").val(data.bank_id).trigger('change');
                        $("#fullPaymentModal").modal("show");
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
            },jQuery)
        })
    </script>
@endsection

@extends('layout')
@section("page-title","Clients Demat - Finance Management")
@section("clientsData.clients.demat","active")
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
            <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @if(session("info"))
                        <div class="container">
                            <h6 class="alert alert-info">{{session("info")}}</h6>
                        </div>
                    @endif
                    <!--begin::Toolbar-->
                    <div class="toolbar mx-7 " id="kt_toolbar">
                        <!--begin::Container-->
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Client Demat</h1>
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
                                    <li class="breadcrumb-item text-dark">Client management</li>
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
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card header-->
                                <div class="card-header border-0 pt-6">
                                    <div class="card-toolbar d-block w-100 text-end">
                                        <!--begin::Toolbar-->
                                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                            <div class="d-flex justify-content-between">

												<select class="form-select form-select-solid" id='freelancer_type' data-control="select2" data-hide-search="true" data-placeholder="Select Freelancer" style="margin-left: 10px;">
													<option value="">Select freelancer</option>
													@forelse ($freelancerAms as $freelancer)
														<option value="{{$freelancer->id}}" @if($filter_type == 'freelancer' && $filter_id == $freelancer->id) selected @endif >{{$freelancer->name}}</option>
													@empty
													@endforelse

													@forelse ($freelancerPrime as $freelancer)
														<option value="{{$freelancer->id}}" @if($filter_type == 'freelancer' && $filter_id == $freelancer->id) selected @endif >{{$freelancer->name}}</option>
													@empty
													@endforelse
												</select>

												<select class="form-select form-select-solid" id='trader_id' data-control="select2" data-hide-search="true" data-placeholder="Select Trader">
													<option value="">Select Trader</option>
													@forelse ($traders as $trader)
														<option value="{{$trader->id}}" @if($filter_type == 'trader' && $filter_id == (isset($dematAccount[0])?$dematAccount[0]->id:0)) selected @endif >{{$trader->name}} - {{$trader->count->count()}} &nbsp; Client</option>
													@empty
													@endforelse
												</select>

                                                <!--begin::Export-->
                                                <a href="javascript:;" class="btn btn-light-primary clear_filter" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" style="width: 300px; margin-left: 10px;">
                                                    <!--end::Svg Icon-->Clear Filter
                                                </a>
                                            </div>
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        @can("client-demat-read")
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                        <th class="min-w-10px">Sr No.</th>
                                                        <th class="min-w-10px">Serial Number</th>
                                                        <th class="min-w-75px">Client name</th>
                                                        <th class="min-w-75px">Holder Name</th>
                                                        <th class="min-w-75px">Service Type</th>
                                                        <th class="min-w-75px">Broker</th>
                                                        <th class="text-end min-w-100px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 fw-bold">
                                                    @forelse ($dematAccount as $account)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td> {{$account->st_sg."-".$account->serial_number}} </td>
                                                            <td> {{$account->name}}</td>
                                                            <td> {{$account->holder_name}}</td>
                                                            <td>
                                                                @if($account->service_type == 1)
                                                                    Prime
                                                                @elseif($account->service_type == 2)
                                                                    AMS
                                                                @elseif($account->service_type == 3)
                                                                    Prime Next
                                                                @endif
                                                            </td>
                                                            <td> {{$account->broker}}</td>
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
                                                                            <a href="javascript:void(0)" data-id='{{$account->id}}' data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' class="menu-link px-3 editDematAccount">Edit</a>
                                                                        </div>
                                                                    @endcan
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript:void(0)" data-id='{{$account->id}}' data-name='{{$account->name}}'  data-holder='{{$account->holder_name}}' data-service='{{$account->service_type}}' class="menu-link px-3 assignFreelancer">Assign Freelancer</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        {{-- empty --}}
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        @else
                                            <h1>Unauthorised</h1>
                                        @endcan
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
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
    <!--begin::Modals-->

    <!-- Modal -->
    <div class="modal fade" id="assignFreelancerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('assignClientToFreelancer')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Assign Client to Freelancer</h2>
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
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Client</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="client_Name" readonly/>
                                <input class="form-control" type="hidden" value="" name='client_demate_id' id="assignFreelancerId" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Account Holder Name</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="holder_name" readonly/>
                            </div>
                        </div>
                        <div class="form-group row" id="ams_freelancer">
                            <label for="example-email-input" class="col-3 col-form-label"> AMS freelancer</label>
                            <div class="col-9">
                                <select class="form-select form-select-solid" name='freelancer_id'>
                                    <option value="">Select option</option>
                                    @forelse ($freelancerAms as $freelancer)
                                        <option value="{{$freelancer->id}}">{{$freelancer->name}}</option>
                                    @empty
                                        <option>Select AMS freelancer</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" id="prime_freelancer">
                            <label for="example-email-input" class="col-3 col-form-label"> Prime freelancer</label>
                            <div class="col-9">
                                <select class="form-select form-select-solid" name='ams_freelancer_id'>
                                    <option value="">Select option</option>
                                    @forelse ($freelancerPrime as $freelancer)
                                        <option value="{{$freelancer->id}}">{{$freelancer->name}}</option>
                                    @empty
                                        <option>Select Prime freelancer</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
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
    <!--end::Modal - View Client Details-->
    <!--end::Modals-->

    <!-- Modal -->
    <div class="modal fade" id="editDematModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('editClientDematAccount')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Assign Client to Freelancer</h2>
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
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Client</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="demat_client_Name" readonly/>
                                <input class="form-control" type="hidden" value="" name='demate_id' id="demate_id" readonly />
                                <input class="form-control" type="hidden" value="client_demat" name='form_type' id="form_type" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Account Holder Name</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="demat_holder_name" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Available Balance</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="available_balance" name="available_balance"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Profit / Loss</label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="pl" name="pl"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Notes</label>
                            <div class="col-9">
                                <textarea class="form-control form-control-lg form-control-solid bdr-ccc" id="notes" rows="5" name="notes"></textarea>
                            </div>
                        </div>

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
                $(document).on("change",'#freelancer_type',function(e){
                    var val = $(this).val();
                    window.location.href = "{{ route('clientDematAccount') }}/freelancer/"+val;
                });

                $(document).on("change",'#trader_id',function(e){
                    var val = $(this).val();
                    window.location.href = "{{ route('clientDematAccount') }}/trader/"+val;
                });
                $(document).on("click",'.clear_filter',function(e){
                    window.location.href = "{{ route('clientDematAccount') }}";
                });

                $(document).on("click",'.assignFreelancer',function(e){
                    const id = e.target.getAttribute("data-id");
                    const name = e.target.getAttribute("data-name");
                    const holderName = e.target.getAttribute("data-holder");
                    const service = e.target.getAttribute("data-service");
                    if(id){
                        $("#assignFreelancerId").val(id);
                        $("#client_Name").val(name);
                        $("#holder_name").val(holderName);
                        $("#prime_freelancer").hide();
                        $("#ams_freelancer").hide();
                        if(service == 1){
                            $("#prime_freelancer").show();
                            $("#ams_freelancer").hide();
                        }else if(service == 2){
                            $("#ams_freelancer").show();
                            $("#prime_freelancer").hide();
                        }
                        $("#assignFreelancerModal").modal("show");
                    }else{
                        window.alert("Unable to Load this Client");
                    }
                });

                $(document).on("click",'.editDematAccount',function(e){
                    const id = e.target.getAttribute("data-id");
                    const name = e.target.getAttribute("data-name");
                    const holderName = e.target.getAttribute("data-holder");
                    if(id){
                        // $("#demate_id").val(id);
                        // $("#demat_client_Name").val(name);
                        // $("#demat_holder_name").val(holderName);

                        $.ajax("/loginInfo/"+id,{
                            type:"GET",
                            headers: {
                                'X-CSRF-TOKEN': $("input[name='_token']").val()
                            }
                        })
                            .done(data=>{
                                $("#demate_id").val(data.id);
                                $("#demat_client_Name").val(data.name);
                                $("#demat_holder_name").val(data.holder_name);
                                $("#available_balance").val(data.available_balance);
                                $("#pl").val(data.pl);
                                $("#notes").val(data.notes);
                                $("#editDematModal").modal("show");
                            })

                    }else{
                        window.alert("Unable to Load this Client");
                    }
                });
            },jQuery)
        })
    </script>
@endsection

@extends('layout')
@section("page-title","Freelancer - Partner Management")
@section("freelancer_user","active")
@section("partner_management.accordion","hover show")
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
                    <div class="toolbar" id="kt_toolbar">
                        <!--begin::Container-->
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Freelancer Clients</h1>
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
                                    <li class="breadcrumb-item text-dark">Freelancer</li>
                                    <li class="breadcrumb-item text-dark">Client</li>
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
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
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
                                                    @can('freelancer-write')
                                                        <th class="text-end min-w-100px">Action</th>
                                                    @endcan
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold">
                                                @forelse ($freelancerClient as $client)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td> {{$client->st_sg."-".$client->serial_number}} </td>
                                                        <td> {{$client->name}}</td>
                                                        <td> {{$client->holder_name}}</td>
                                                        <td>
                                                            @if($client->service_type == 1)
                                                                Prime
                                                            @elseif($client->service_type == 2)
                                                                AMS
                                                            @elseif($client->service_type == 3)
                                                                Prime Next
                                                            @endif
                                                        </td>
                                                        <td> {{$client->broker}}</td>
                                                        @can('freelancer-write')
                                                            <td class="text-end">
                                                                <div class="d-flex justify-content-center">
                                                                    <div class="menu-item">
                                                                        <a href="javascript:void(0)" data-id='{{$client->id}}' class="menu-link px-3 editDematAccount">
                                                                            <i class="fa fa-edit text-dark fa-2x"></i>
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
                                <input class="form-control" type="hidden" value="freelancer_demat" name='form_type' id="form_type" readonly />
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
                $(document).on("click",'.editDematAccount',function(e){
                    const id = $(this).attr("data-id");
                    if(id){
                        $.ajax("/loginInfo/"+id,{
                            type:"GET",
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
            })
        })
    </script>
@endsection

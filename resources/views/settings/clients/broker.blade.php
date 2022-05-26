@extends('layout')
@section("page-title","Client Broker - Settings")
@section("settings_management.clients.broker","active")
@section("settings_management.accordion","hover show")
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
                    @if(session("info"))
                        <div class="container">
                            <h5 class="alert alert-info">{{session("info")}}</h5>
                        </div>
                    @endif
                    <div class="toolbar px-0" id="kt_toolbar">
                        <!--begin::Container-->
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Broker</h1>
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
                                    <li class="breadcrumb-item text-dark">Settings</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                            <!--begin::Actions-->
                            @can("settings-client-broker-create")
                                <div class="d-flex align-items-center py-1">
                                    <button type="button" class="btn btn-primary" id="add_client_broker_model">Add</button>
                                </div>
                            @endcan
                        <!--end::Actions-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <div class="container">
                        <div class="row">
                            <table class="table table-striped" id="broker">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Broker</th>
                                        @canany(["settings-client-broker-write","settings-client-broker-delete"])
                                            <th scope="col">Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($brokers as $broker)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$broker->broker}}</td>
                                            @canany(["settings-client-broker-write","settings-client-broker-delete"])
                                                <td>
                                                    @can(["settings-client-broker-write"])
                                                        <a href="javascript:void(0)">
                                                            <i class="fas fa-pen fa-xl px-2 editBroker" data-id="{{$broker->id}}"></i>
                                                        </a>
                                                    @endcan
                                                    @can("settings-client-broker-delete")
                                                        <a href="{{route('removeBroker',$broker->id)}}" class="removeBroker">
                                                            <i class="fas fa-trash text-danger px-2 fa-xl"></i>
                                                        </a>
                                                    @endcan
                                                </td>
                                            @endcan
                                        </tr>
                                    @empty
                                        {{-- <h3>No Broker Added. Click <a href="">here</a> to add</h3> --}}
                                    @endforelse
                                </tbody>
                            </table>
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
    @can("settings-bank-details-create")
        <div class="modal fade" id="add_client_broker" tabindex="-1" aria-hidden="true">
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
                                <h3 class="mb-3">Add Broker</h3>
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
                        @if($errors->any())
                            <h5 class="alert alert-danger">{{$errors->first()}}</h5>
                        @endif
                        <!--begin:Form-->
                        <form id="add_profession_form" method="POST" action="{{route('createBroker')}}" class="form">
                            @csrf
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Broker:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a Broker name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('broker')}}" class="form-control form-control-solid" name="broker" />
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
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $("#add_client_broker_model").on("click",function(){
                    $("#add_client_broker").modal("show");
                })
            })
        </script>
    @endcan
    @can("settings-client-broker-write")
        <div class="modal fade" id="edit_client_broker" tabindex="-1" aria-hidden="true">
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
                                <h3 class="mb-3">Edit Broker</h3>
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
                        @if($errors->any())
                            <h5 class="alert alert-danger">{{$errors->first()}}</h5>
                        @endif
                        <!--begin:Form-->
                        <form id="edit_profession_form" method="POST" action="{{route('editBroker')}}" class="form">
                            @csrf
                            <div id="editIdContainer"></div>
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Broker:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a Broker name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('broker')}}" class="form-control form-control-solid" id="editBrokerField" name="broker" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Actions-->
                            <div class="text-end">
                                <button type="reset" id="call_modal_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="call_modal_submit" class="btn btn-primary">
                                    <span class="indicator-label">Update</span>
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
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $(document).on("click",".editBroker",function(e){
                    const id = e.target.getAttribute("data-id");
                    if(id){
                        $.ajax("{!! route('getBroker') !!}",{
                            type:"POST",
                            data:{
                                id:id
                            },
                            dataType:"JSON"
                        })
                        .done(data=>{
                            if(data.errors){
                                window.alert(data.errors.profession[0]);
                            }
                            $("#editBrokerField").val(data.broker);
                            $("#editIdContainer").html(`<input type='hidden' name='id' value='${id}' />`);
                            $("#edit_client_broker").modal("show");
                            $("#editBrokerField").focus();
                        })
                    }else{
                        window.alert("Unable to Load this Broker");
                    }
                })
            })
        </script>
    @endcan
    @if($errors->any() && null === old('id'))
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $("#add_client_broker").modal("show");
            });
        </script>
    @endif
    @if($errors->any() && null !== old('id'))
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $("#edit_client_broker").modal("show");
            });
        </script>
    @endif
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $('#broker').DataTable();
            $(document).on("click",".removeBroker",function(e){
                if(!window.confirm("Are you sure you want to remove this Item?")){
                    e.preventDefault();
                }
            })
        })
    </script>
@endsection

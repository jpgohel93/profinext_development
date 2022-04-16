@extends('layout')
@section("page-title","Client Service Type - Settings")
@section("settings_management.clients.services_type","active")
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
                    {{-- Profession --}}
                    <div class="row">
                        <div class="container">
                            <div class="row my-3">
                                <div class="col-md-3">
                                    <h3>Service Types</h3>
                                </div>
                                @can("settings-service-type-create")
                                    <div class="col-md-9 text-end">
                                        <button type="button" class="btn btn-primary" id="add_client_service_type_model">Add</button>
                                    </div>
                                @endcan
                            </div>
                            <table class="table table-striped" id="serviceType">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Service type</th>
                                        <th scope="col">Renewal amount</th>
                                        <th scope="col">Cut off</th>
                                        <th scope="col">Sharing persentile</th>
                                        <th scope="col">GST Applicable</th>
                                        <th scope="col">GST rate</th>
                                        @canany(["settings-service-type-write","settings-service-type-delete"])
                                            <th scope="col">Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @can("settings-service-type-read")
                                        @forelse ($serviceTypes as $serviceType)
                                            <tr>
                                                <td scope="row">{{$loop->iteration}}</td>
                                                <td>{{$serviceType->name}}</td>
                                                <td>{{$serviceType->renewal_amount}}</td>
                                                <td>{{$serviceType->cutoff}}</td>
                                                <td>{{$serviceType->sharing}}</td>
                                                <td>{{($serviceType->is_gst_applicable)?"Yes":"No"}}</td>
                                                <td>{{$serviceType->gst_rate}}</td>
                                                @canany(["settings-service-type-write","settings-service-type-delete"])
                                                    <td>
                                                        @can("settings-service-type-write")
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-pen fa-xl px-2 editServiceType" data-id="{{$serviceType->id}}"></i>
                                                            </a>
                                                        @endcan
                                                        @can("settings-service-type-delete")
                                                            <a href="{{route('removeServiceType',$serviceType->id)}}" class="removeServiceType">
                                                                <i class="fas fa-trash text-danger fa-xl px-2"></i>
                                                            </a>
                                                        @endcan
                                                    </td>
                                                @endcan
                                            </tr>
                                        @empty
                                            {{-- empty --}}
                                        @endforelse
                                    @endcan
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
    {{-- models --}}
    <div class="modal fade" id="add_service_type_model" tabindex="-1" aria-hidden="true">
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
                            <h3 class="mb-3">Add Service Type</h3>
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
                    <form id="add_serviceType_form" method="POST" action="{{route('addServiceType')}}" class="form">
                        @csrf
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Service type:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{old('name')}}" class="form-control form-control-solid" name="name"  required/>
                            </div>
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Renewal amount:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{old('renewal_amount')}}" class="form-control form-control-solid" name="renewal_amount"  required/>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Cut off:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{old('cutoff')}}" class="form-control form-control-solid" name="cutoff"  required/>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Sharing:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{old('sharing')}}" class="form-control form-control-solid" name="sharing"  required/>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">GST Applicable:</span>
                                </label>
                                <!--end::Label-->
                                <select class="form-control" name="is_gst_applicable" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">GST Rate:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{old('gst_rate')}}" class="form-control form-control-solid" name="gst_rate" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-end">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Add</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <div class="modal fade" id="edit_client_service_type" tabindex="-1" aria-hidden="true">
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
                            <h3 class="mb-3">Edit Service Type</h3>
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
                    <form id="edit_serviceType_form" method="POST" action="{{route('editServiceType')}}" class="form">
                        @csrf
                        <div id="editIdContainer"></div>
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Service type:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{old('name')}}" class="form-control form-control-solid" id="edit_name" name="name" />
                            </div>
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Renewal amount:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{old('renewal_amount')}}" class="form-control form-control-solid" id="edit_renewal_amount" name="renewal_amount" />
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Cut off:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{old('cutoff')}}" class="form-control form-control-solid" id="edit_cutoff" name="cutoff" />
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Sharing:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{old('sharing')}}" class="form-control form-control-solid" id="edit_sharing" name="sharing" />
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">GST Applicable:</span>
                                </label>
                                <!--end::Label-->
                                <select id="edit_is_gst_applicable" class="form-control" name="is_gst_applicable">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>GST Rate:</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{old('gst_rate')}}" class="form-control form-control-solid" id="edit_gst_rate" name="gst_rate" />
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
    @if($errors->any() && null === old('id'))
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $("#add_service_type_model").modal("show");
            });
        </script>
    @endif
    @if($errors->any() && null !== old('id'))
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $("#edit_client_service_type").modal("show");
            });
        </script>
    @endif
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $("select").select2();
            $('#serviceType').DataTable();
            $("#add_client_service_type_model").on("click",function(){
                $("#add_service_type_model").modal("show");
            })
            $(document).on("click",".removeServiceType",function(e){
                if(!window.confirm("Are you sure you want to remove this Item?")){
                    e.preventDefault();
                }
            })
            $(document).on("click",".editServiceType",function(e){
                const id = e.target.getAttribute("data-id");
                if(id){
                    $.ajax("{!! route('getServiceType') !!}",{
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
                        $("#edit_name").val(data.name);
                        $("#edit_renewal_amount").val(data.renewal_amount);
                        $("#edit_cutoff").val(data.cutoff);
                        $("#edit_sharing").val(data.sharing.replaceAll("%","")+"%");
                        $("#edit_is_gst_applicable").val(data.is_gst_applicable).trigger('change');
                        $("#edit_gst_rate").val(data.gst_rate);
                        $("#editIdContainer").html(`<input type='hidden' name='id' value='${data.id}' />`);
                        $("#edit_client_service_type").modal("show");
                    })
                }else{
                    window.alert("Unable to Load this Profession");
                }
            })
        })
    </script>
@endsection

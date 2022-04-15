@extends('layout')
@section("page-title","Screenshots - Document Management")
@section("documentManagement.screenshot","active")
@section("documentManagement.accordion","hover show")
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
                    {{-- bank --}}
                    <div class="row">
                        <div class="container">
                            <div class="row my-3">
                                <div class="col-md-3">
                                    <h3>Screenshots:</h3>
                                </div>
                                {{-- @can("document-management-data-create")
                                    <div class="col-md-9 text-end">
                                        <button type="button" class="btn btn-primary" id="uploadFile">Upload File</button>
                                    </div>
                                @endcan --}}
                            </div>
                            <table class="table table-striped" id="bank">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr. No</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Client</th>
                                        @canany(["document-management-pan-card-read","document-management-pan-card-write","document-management-pan-card-delete"])
                                            <th scope="col">Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @can("document-management-pan-card-read")
                                        {{-- @forelse ($terms as $term)
                                            <tr scope="row">
                                                <th>{{$loop->iteration}}</th>
                                                <td>{{$term->title}}</td>
                                                <td>{{$term->is_active?"Active":"Inactive"}}</td>
                                                @canany(["settings-terms-and-condition-write","settings-terms-and-condition-delete"])
                                                    <td>
                                                        @can("settings-terms-and-condition-write")
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-pen fa-xl px-3 edit" data-id="{{$term->id}}"></i>
                                                            </a>
                                                        @endcan
                                                        @can("settings-terms-and-condition-delete")
                                                            <a href="{{route('removeTermsAndCondition',$term->id)}}" class="remove">
                                                                <i class="fas fa-trash text-danger fa-xl px-3"></i>
                                                            </a>
                                                        @endcan
                                                    </td>
                                                @endcan
                                            </tr>
                                        @empty
                                            
                                        @endforelse --}}
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
    @can("settings-terms-and-condition-create")
        <div class="modal fade" id="add_client_bank" tabindex="-1" aria-hidden="true">
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
                                <h3 class="mb-3">Add Terms</h3>
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
                        <form id="add_profession_form" method="POST" action="{{route('createTermsAndCondition')}}" class="form">
                            @csrf
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Title:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value="{{old('title')}}" class="form-control form-control-solid" name="title" />
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Description:</span>
                                    </label>
                                    <!--end::Label-->
                                    <textarea type="text" class="form-control form-control-solid" rows="5" name="description" >{{old('description')}}</textarea>
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
    @endcan
    @can("settings-terms-and-condition-write")
        <div class="modal fade" id="editTermsAndCondition" tabindex="-1" aria-hidden="true">
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
                                <h3 class="mb-3">Add Terms</h3>
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
                        <form method="POST" action="{{route('editTermsAndCondition')}}" class="form">
                            @csrf
                            <div id="editIdContainer"></div>
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Title:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" id="title" value="{{old('title')}}" class="form-control form-control-solid" name="title" />
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Description:</span>
                                    </label>
                                    <!--end::Label-->
                                    <textarea type="text" id="description" class="form-control form-control-solid" rows="5" name="description" >{{old('description')}}</textarea>
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
                $(document).on("click",".edit",function(e){
                    const id = e.target.getAttribute("data-id");
                    if(id){
                        $.ajax("{!! route('getTermsAndCondition') !!}",{
                            type:"POST",
                            data:{
                                id:id
                            }
                        })
                        .done(data=>{                            
                            $("#title").val(data.title);
                            $("#description").val(data.description);
                            $("#editIdContainer").html(`<input type='hidden' name='id' value='${id}' />`);
                            $("#editTermsAndCondition").modal("show");
                        })
                    }else{
                        window.alert("Unable to Load this bank");
                    }
                })
            })
        </script>
    @endcan
    @can("settings-terms-and-condition-delete")
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $(document).on("click",".remove",function(e){
                    if(!window.confirm("Are you sure you want to remove this Item?")){
                        e.preventDefault();
                    }
                })
            })
        </script>
    @endcan
    @can("settings-terms-and-condition-create")
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $("#add_client_bank_model").on("click",function(){
                    $("#add_client_bank").modal("show");
                })
            })
        </script>
    @endcan
    @if($errors->any() && null === old('id'))
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $("#add_client_bank").modal("show");
            });
        </script>
    @endif
    @if($errors->any() && null !== old('id'))
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $("#edit_client_bank").modal("show");
            });
        </script>
    @endif
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $('#bank').DataTable();
        })
    </script>
@endsection
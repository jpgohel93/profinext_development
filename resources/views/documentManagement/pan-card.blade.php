@extends('layout')
@section("page-title","Data - Document Management")
@section("documentManagement.panCard","active")
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
                    <!--begin::Toolbar-->
                    <div class="toolbar px-0 mx-0" id="kt_toolbar">
                        <!--begin::Container-->
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Pan Cards</h1>
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
                                    <li class="breadcrumb-item text-dark">Document management</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Toolbar-->
                    <div class="container">
                        <div class="row">
                            <table class="table table-striped" id="bank">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr. No</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Demat Holder name</th>
                                        <th scope="col">Client</th>
                                        @canany(["document-management-pan-card-read","document-management-pan-card-write","document-management-pan-card-delete"])
                                            <th scope="col">Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @can("document-management-pan-card-read")
                                        @forelse ($panCards as $client_id => $demat)
                                            <tr scope="row">
                                                <th>{{$loop->iteration}}</th>
                                                <td>{{date('Y-m-d',strtotime($demat['created_at']))}}</td>
                                                <td>{{$demat['holder_name']}}</td>
                                                <td>{{$demat["name"]}}</td>
                                                @canany(["document-management-pan-card-read","document-management-pan-card-write","document-management-pan-card-delete"])
                                                    <td>
                                                        <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                            <div class="menu-item px-3">
                                                                <a href="{{asset('pan_cards')."/".$demat['file']}}" class='menu-link px-3' target="_blank">
                                                                    View
                                                                </a>
                                                            </div>
                                                            @can("document-management-pan-card-write")
                                                                <div class="menu-item px-3">
                                                                    <a href="javascript:void(0)" class='menu-link px-3 edit' data-id="{{$demat['id']}}">
                                                                        Edit
                                                                    </a>
                                                                </div>
                                                            @endcan
                                                            @can("document-management-pan-card-delete")
                                                                <div class="menu-item px-3">
                                                                    <a href="{{route('removePancardDocument',$demat['id'])}}" class='menu-link px-3 delete'>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                @endcan
                                            </tr>
                                        @empty

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

        <div class="modal fade" id="add_document" tabindex="-1" aria-hidden="true">
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
                            <h3 class="mb-3">Upload File</h3>
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
                        <form method="POST" id="documentForm" enctype="multipart/form-data" action="{{route('editPanCardDocument')}}" class="form">
                            @csrf
                            <div id="editIdContainer"></div>
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Client Name</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value='{{old('client_name')}}' class="form-control form-control-solid" id="client_name" required/>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span>Demate Holder Name</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value='{{old('demate_holder_name')}}' class="form-control form-control-solid" id="demate_holder_name"/>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span>Pan Card Number</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value='{{old('pan_number')}}' class="form-control form-control-solid" name="pan_number" id="pan_number"/>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span>Upload Image</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="file" class="form-control form-control-solid" name="document" accept="image/*"/>
                                </div>
                                <div id="image_preview"></div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Actions-->
                            <div class="text-end">
                                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
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
                $(()=>{
                    $("#uploadFile").on("click",function(){
                        $("#documentForm").find("[name='document']").attr("required",true);
                        $("#add_document").modal("show");
                    })
                },jQuery)
            })
        </script>

    @can("document-management-pan-card-write")
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $(()=>{
                    $(document).on("click",".edit",function(e){
                        const id = e.target.getAttribute("data-id");
                        if(id){
                            $.ajax("{{route('getPancardDocument')}}/"+id,{
                                type:"GET",
                            })
                            .done(data=>{
                                $("#documentForm").find("#editIdContainer").html(`<input type="hidden" name="id" value="${data.id}">`)
                                $("#client_name").val(data.name);
                                $("#demate_holder_name").val(data.holder_name);
                                $("#pan_number").val(data.pan_number_text);
                                var url = "{{asset('pan_cards')}}/"+data.file;
                                $("#image_preview").html("<img style='height:100px;width;70px;' src='"+url+"'>");
                                $("#document").attr("required",false);
                                $("#add_document").modal("show");
                            })
                            .fail((err)=>{
                                if(err.status===403){
                                    window.alert("Unauthorized Action");
                                }
                                if(err.status===500){
                                    window.alert("Server Down");
                                }
                            })
                        }else{
                            window.alert("Unable to Load this document");
                        }
                    })
                },jQuery)
            })
        </script>
    @endcan
    @can("document-management-pan-card-delete")
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $(()=>{
                    $(document).on("click",".delete",function(e){
                        if(!window.confirm("Are you sure you want to remove this Item?")){
                            e.preventDefault();
                        }
                    })
                },jQuery)
            })
        </script>
    @endcan
    @if($errors->any() && null === old('id'))
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $("#add_document").modal("show");
            });
        </script>
    @endif
    @if($errors->any() && null !== old('id'))
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $("#documentForm").find("#editIdContainer").html(`<input type="hidden" name="id" value="{{old('id')}}">`)
                $("#documentForm").find("[name='document']").attr("required",false);
                $("#add_document").modal("show");
            });
        </script>
    @endif
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $('#bank').DataTable();
        })
    </script>
@endsection

@extends('layout')
@section("page-title","Images - Document Management")
@section("documentManagement.images","active")
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
                                    <h3>Image</h3>
                                </div>
                                @can("document-management-data-create")
                                    <div class="col-md-9 text-end">
                                        <button type="button" class="btn btn-primary" id="uploadFile">Upload File</button>
                                    </div>
                                @endcan
                            </div>
                            <table class="table table-striped" id="bank">
                                <thead>
                                <tr>
                                    <th scope="col">Sr. No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Notes</th>
                                    @canany(["document-management-data-read","document-management-data-write","document-management-data-delete"])
                                        <th scope="col">Actions</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @can("document-management-data-read")
                                    @forelse ($images as $image)
                                        <tr scope="row">
                                            <th>{{$loop->iteration}}</th>
                                            <td>{{$image->date}}</td>
                                            <td>{{$image->title}}</td>
                                            <td>{{$image->notes}}</td>
                                            @canany(["document-management-data-write","document-management-data-delete"])
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
                                                            <a href="{{asset('images')."/".$image->image}}" class='menu-link px-3' target="_blank">
                                                                View
                                                            </a>
                                                        </div>
                                                        @can("document-management-data-write")
                                                            <div class="menu-item px-3">
                                                                <a href="javascript:void(0)" class='menu-link px-3 edit' data-id="{{$image->id}}">
                                                                    Edit
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can("document-management-data-delete")
                                                            <div class="menu-item px-3">
                                                                <a href="{{route('removeImage',$image->id)}}" class='menu-link px-3 delete'>
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
    @can("document-management-data-create")
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
                        <form method="POST" id="documentForm" enctype="multipart/form-data" action="{{route('addImage')}}" class="form">
                            @csrf
                            <div id="editIdContainer"></div>
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Date:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="date" value='{{(old('date'))?old('date'):date('Y-m-d')}}' class="form-control form-control-solid" name="date" required/>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Title:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value='{{old('title')}}' class="form-control form-control-solid" name="title" required/>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span>Notes:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" value='{{old('notes')}}' class="form-control form-control-solid" name="notes"/>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Select file:</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="file" class="form-control form-control-solid" name="document" accept="image/*" required/>
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
    @endcan
    @can("document-management-data-write")
        <script>
            window.addEventListener("DOMContentLoaded",function(){
                $(()=>{
                    $(document).on("click",".edit",function(e){
                        const id = e.target.getAttribute("data-id");
                        if(id){
                            $.ajax("{{route('getImage')}}/"+id,{
                                type:"GET",
                            })
                                .done(data=>{
                                    $("#documentForm").find("#editIdContainer").html(`<input type="hidden" name="id" value="${data.id}">`)
                                    $("#documentForm").find("[name='date']").val(data.date);
                                    $("#documentForm").find("[name='title']").val(data.title);
                                    $("#documentForm").find("[name='notes']").val(data.notes);
                                    $("#documentForm").find("[name='document']").attr("required",false);
                                    var url = "{{asset('images')}}/"+data.image;
                                    $("#image_preview").html("<img style='height:100px;width;70px;' src='"+url+"'>");
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
    @can("document-management-data-delete")
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

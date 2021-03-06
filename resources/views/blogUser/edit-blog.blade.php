@extends('layout')
@section("page-title","Edit Blog")
@section("blogs.user","active")
@section("blogTab","hover show")
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
                    @can("blog-user-write")
                    <!--begin::Toolbar-->
                     <div class="toolbar" id="kt_toolbar">
                         <!--begin::Container-->
                         <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                             <!--begin::Page title-->
                             <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                 <!--begin::Title-->
                                 <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Blogs</h1>
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
                                     <li class="breadcrumb-item text-dark">Edit blog</li>
                                     <!--end::Item-->
                                 </ul>
                                 <!--end::Breadcrumb-->
                             </div>
                             <!--end::Page title--> 
                         </div>
                         <!--end::Container-->
                     </div>
                        <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_app_stepper">
                            <!--begin::Content-->
                            <div class="flex-row-fluid px-lg-15">
                                <!--begin::Form-->
                                <!--begin::Form-->
                                <form id="" class="form" method="POST" action="{{route('updateBlogFrm')}}">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{$blog['id']}}">
                                    <!--begin::Modal body-->
                                    <div class="modal-body mx-md-10">
                                        <div class="row">
                                            <label class="col-3 col-form-label">Tab</label>
                                            <select name="tab_id" class="form-control" data-control="select2" data-placeholder="Select tab">
                                                @forelse ($all_tabs as $tab)
                                                    <option value="{{$tab['id']}}" {{$tab['id']==$blog['tab_id']?"selected":""}}>{{$tab['name']}}</option>
                                                @empty
                                                    {{-- empty --}}
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">Date</label>
                                            <input type="date" name="date" id="date" class="form-control" value="<?= date("Y-m-d",strtotime($blog['date'])) ?>"/>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">Title</label>
                                            <input type="text" name="title" id="title" class="form-control" value="{{$blog['title']}}" placeholder="Please Enter Blog Title" />
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">Link</label>
                                            <input type="text" name="link" id="link" value="{{$blog['link']}}" class="form-control" placeholder="Please Enter Blog Link" />
                                        </div>
                                    </div>
                                    <!--end::Modal body-->
                                    <div class="modal-footer text-center">
                                        <button type="button" class="btn btn-light me-3" id="discard">Discard</button>
                                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                            <span class="indicator-label"> Reapproved </span>
                                            <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <h1>Unauthorised</h1>
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
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $("#discard").on("click",function(){
                    window.history.back();
                })
            },jQuery)
        })
    </script>
@endsection
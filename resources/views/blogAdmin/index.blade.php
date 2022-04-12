@extends('layout')
@section("page-title","Blog Data - Blog Management")
@section("blog_management.admin","active")
@section("blog_management.accordion","hover show")
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
                            <h6 class="alert alert-info">{{session("info")}}</h6>
                        </div>
                    @elseif($errors->any())
                        <div class="container">
                            <h6 class="alert alert-danger">{{$errors->first()}}</h6>
                        </div>
                    @endif
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
                                     <li class="breadcrumb-item text-dark">Blogs</li>
                                     <!--end::Item-->
                                 </ul>
                                 <!--end::Breadcrumb-->
                             </div>
                             <!--end::Page title-->
                             <!--begin::Actions-->
                             <div class="d-flex align-items-center py-1">
                                 @can("blog-user-write")
                                    <!--begin::Button-->
                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="addTabBtn">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>Add Tab
                                    </a>
                                 @endcan
                             </div>
                             <!--end::Actions-->
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
                                        @can("blog-admin-read")
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                        <th class="min-w-10px">Sr No.</th>
                                                        <th class="min-w-75px">Blogger name</th>
                                                        <th class="min-w-75px">Achievement</th>
                                                        <th class="min-w-100px">Target</th>
                                                        <th class="text-end min-w-100px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 fw-bold">
                                                    @forelse ($blogs as $blog)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td class="role-value-td">{{$blog['name']}}</td>
                                                            @php
                                                                // total tabs
                                                                $total_tabs = "";
                                                                $total_pending = 0;
                                                                $total_achieve = "";
                                                                foreach ($blog['target'] as $key => $target) {
                                                                    $total_tabs .= ",".$target["target"];
                                                                    $total_achieve .= ",".$target["total_blogs"];
                                                                }
                                                                $total_tabs = substr($total_tabs,1);
                                                                $total_achieve = substr($total_achieve,1);
                                                            @endphp
                                                            <td class="role-value-td">{{($total_achieve=="")?"-":$total_achieve}}</td>
                                                            <td class="role-value-td">{{$total_tabs}}</td>
                                                            <td class="text-end">
                                                                <div class="d-flex justify-content-end align-items-end">
                                                                    @can("blog-user-read")
                                                                        <div class="menu-item">
                                                                            <a href="{{route('editBlogForm',$blog['id'])}}" data-id="{{$blog['id']}}" target="_blank" class="menu-link px-3">
                                                                                <i class='fas fa-eye fa-xl' title="View Blogger"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endcan

                                                                    @can("blog-user-write")
                                                                        <div class="menu-item">
                                                                            <a href="javascript:void(0)" data-id="{{$blog['id']}}" class="menu-link px-3 setTargetUrl">
                                                                                <i class="fas fa-pen fa-xl" title="Set target"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endcan
                                                                    {{-- @can("blog-delete")
                                                                        <div class="menu-item">
                                                                            <a href="{{route('removeBlog')}}" data-id="{{$blog['id']}}" class="menu-link px-2 removeRole">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#009ef7"><path d="M74.53333,17.2c-1.53406,-0.02082 -3.01249,0.574 -4.10468,1.65146c-1.09219,1.07746 -1.70703,2.54767 -1.70704,4.08187h-34.32161c-2.06765,-0.02924 -3.99087,1.05709 -5.03322,2.843c-1.04236,1.78592 -1.04236,3.99474 0,5.78066c1.04236,1.78592 2.96558,2.87225 5.03322,2.843h103.2c2.06765,0.02924 3.99087,-1.05709 5.03322,-2.843c1.04236,-1.78592 1.04236,-3.99474 0,-5.78066c-1.04236,-1.78592 -2.96558,-2.87225 -5.03322,-2.843h-34.32161c-0.00001,-1.53421 -0.61486,-3.00442 -1.70704,-4.08187c-1.09219,-1.07746 -2.57061,-1.67228 -4.10468,-1.65146zM34.4,45.86667v91.73333c0,6.33533 5.13133,11.46667 11.46667,11.46667h80.26667c6.33533,0 11.46667,-5.13133 11.46667,-11.46667v-91.73333z"></path></g></g></svg>
                                                                            </a>
                                                                        </div>
                                                                    @endcan --}}
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
    <div class="modal fade" id="addTabModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" method="POST" action="{{route('addTab')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Add Tab</h2>
                    </div>
                    <!--begin::Modal body-->
                    <div class="modal-body mx-md-10">
                        <div class="row">
                            <label class="col-3 col-form-label">Select Blogger</label>
                            <select name="blogger" class="form-control" data-control="select2" data-placeholder="Select blogger">
                                @forelse ($bloggers as $blogger)
                                    <option value="{{$blogger['id']}}" {{old('blogger')==$blog['id']?"selected":""}}>{{$blogger['name']}}</option>
                                @empty
                                    {{-- empty --}}
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Tab name</label>
                            <input type="text" name="name" value="{{old("name")}}" id="name" class="form-control" placeholder="Please Enter Tab Name" />
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
    <div class="modal fade" id="setTargetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                @if ($errors->any())
                    <h3 class="alert alert-danger">{{$errors->first()}}</h3>
                @endif
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('setTargetFrm')}}">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bolder">Set Target</h2>
                    </div>
                    <!--begin::Modal body-->
                    <div class="modal-body mx-md-10">
                        <div class="row">
                            <label class="col-3 col-form-label">Tab</label>
                            <select name="tab_id" class="form-control" data-control="select2" data-placeholder="Select tab">
                                @forelse ($tabs as $tab)
                                    <option value="{{$tab['id']}}">{{$tab['name']}}</option>
                                @empty
                                    {{-- empty --}}
                                @endforelse
                            </select>
                        </div>
                        <div class="row">
                            <label class="col-3 col-form-label">Target</label>
                            <input type="text" name="target" id="target" class="form-control" placeholder="Please Enter Tab Target" />
                        </div>
                        <div class="row">
                            <label class="col-3 col-form-label">Schedule</label>
                            <textarea type="text" name="schedule" id="schedule" class="form-control"></textarea>
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
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $(".datatable").DataTable();
                $("#select2").select2();
                $("#addTabBtn").on("click",function(){
                    $("#addTabModal").modal("show");
                })
                $(document).on("click",".setTargetUrl",function(){
                    const user_id = $(this).data("id");
                    $("#user_id").val(user_id);
                    $("#setTargetModal").modal("show");
                })
            },jQuery)
        })
    </script>
@endsection

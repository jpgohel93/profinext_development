@extends('layout')
@section("page-title","Blog - Blog Management")
@section("blog_management.user","active")
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
                                 @can("blog-create")
                                 <!--begin::Button-->
                                 <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="addArticleBtn">
                                     <span class="svg-icon svg-icon-2">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                             <rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                             <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                         </svg>
                                     </span>Add Article
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
                             <!--begin:::Tabs-->
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">
                                @forelse ($user['target'] as $target_index => $tabs)
                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1 {{($loop->first)?"active":""}}" data-bs-toggle="tab"
                                        href="#tab{{$user['target'][$target_index]['tab_id']}}"> {{ $user['target'][$target_index]['tab_name'] }} &nbsp;({{$user['target'][$target_index]['total_blogs']."/".$user['target'][$target_index]['target']}})</a>
                                    </li>
                                    <!--end:::Tab item-->
                                @empty
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1 active" data-bs-toggle="tab"
                                        href="#accountHandling">0 target assign</a>
                                    </li>
                                @endforelse
                                {{-- {{dd($user)}} --}}
                            </ul>
                            <div class="tab-content">
                                @forelse ($user['target'] as $target_index => $tabs)
                                    <div class="tab-pane fade show {{($loop->first)?"active":""}}" id="tab{{$user['target'][$target_index]['tab_id']}}" aria-labelledby="active-tab" role="tabpanel">
                                        <!--begin::Card-->
                                        <div class="card">
                                            <!--begin::Card header-->
                                            <div class="card-header border-0 pt-6">
                                                <!--begin::Card title-->
                                                <div class="card-title">
                                                    <!--begin::Search-->
                                                    <div class="d-flex align-items-center position-relative my-1">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
                                                    </div>
                                                    <!--end::Search-->
                                                </div>
                                                <!--begin::Card title-->
                                                <!--begin::Card toolbar-->
                                            
                                                <div class="card-toolbar">
                                                    <!--begin::Toolbar-->
                                                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                                            <div class="d-flex justify-content-between">
                                                        <!--begin::Export--> 
                                                        <a href="#" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
                                                                    <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
                                                                    <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Export
                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                </svg>
                                                            </span> 
                                                        </a> 
                                                            </div>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold w-175px py-4" data-kt-menu="true"> 
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">
                                                                    <span class="menu-icon">
                                                                        <i class="la la-file-pdf-o"></i>
                                                                    </span>PDF
                                                                </a> 
                                                            </div> 
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">
                                                                    <span class="menu-icon">
                                                                        <i class="la la-file-excel-o"></i>
                                                                    </span>Excel
                                                                </a>  
                                                            </div> 
                                                        </div> 
                                                        <!--end::Export--> 
                                                    </div>
                                                    <!--end::Toolbar-->
                                                </div>
                                                <!--end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    @can("blog-read")
                                                        @php
                                                            $i=1;
                                                            $blogs =array();
                                                            $key = array_keys(array_column($user['target'], 'tab_id'),$user['target'][$target_index]['tab_id']);
                                                        @endphp
                                                        @if($user['target'][$target_index]['total_blogs']!="0")
                                                            <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                                <!--begin::Table head-->
                                                                <thead>
                                                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                                        <th class="min-w-10px">Sr No.</th>
                                                                        <th class="min-w-75px">Date</th>
                                                                        <th class="min-w-75px">Title</th>
                                                                        <th class="min-w-100px">Link</th>
                                                                        <th class="text-end min-w-100px">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="text-gray-600 fw-bold">
                                                                    @foreach ($user['target'][$target_index]['tab_blogs'][$user['target'][$target_index]['tab_id']] as $blog_index => $blog)
                                                                        <tr> 
                                                                            <td>{{$blog['srno']}}</td>
                                                                            <td class="role-value-td">{{date("Y-m-d",strtotime($blog['date']))}}</td> 
                                                                            <td class="role-value-td">{{$blog['title']}}</td> 
                                                                            <td class="role-value-td"><a href="{{$blog['link']}}" target="_blank">{{$blog['link']}}</a></td> 
                                                                            <td class="text-end">
                                                                                <div class="d-flex justify-content-end align-items-end">
                                                                                    @can("blog-write")
                                                                                        <div class="menu-item">  
                                                                                            <a href="{{route('editBlog',$blog['id'])}}" data-id="{{$blog['id']}}" class="menu-link px-3">
                                                                                                Edit
                                                                                            </a> 
                                                                                        </div>
                                                                                        @if($blog['notes']!="")
                                                                                            <div class="menu-item">  
                                                                                                <a href="javascript:void(0)" data-id="{{$blog['id']}}" class="menu-link px-3 displayNotes">
                                                                                                    Notes
                                                                                                </a> 
                                                                                            </div>
                                                                                        @endif
                                                                                    @endcan
                                                                                    @can("blog-delete")
                                                                                        <div class="menu-item">  
                                                                                            <a href="{{route('removeBlog')}}" data-id="{{$blog['id']}}" class="menu-link px-2 removeRole">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#009ef7"><path d="M74.53333,17.2c-1.53406,-0.02082 -3.01249,0.574 -4.10468,1.65146c-1.09219,1.07746 -1.70703,2.54767 -1.70704,4.08187h-34.32161c-2.06765,-0.02924 -3.99087,1.05709 -5.03322,2.843c-1.04236,1.78592 -1.04236,3.99474 0,5.78066c1.04236,1.78592 2.96558,2.87225 5.03322,2.843h103.2c2.06765,0.02924 3.99087,-1.05709 5.03322,-2.843c1.04236,-1.78592 1.04236,-3.99474 0,-5.78066c-1.04236,-1.78592 -2.96558,-2.87225 -5.03322,-2.843h-34.32161c-0.00001,-1.53421 -0.61486,-3.00442 -1.70704,-4.08187c-1.09219,-1.07746 -2.57061,-1.67228 -4.10468,-1.65146zM34.4,45.86667v91.73333c0,6.33533 5.13133,11.46667 11.46667,11.46667h80.26667c6.33533,0 11.46667,-5.13133 11.46667,-11.46667v-91.73333z"></path></g></g></svg>
                                                                                            </a>
                                                                                        </div>
                                                                                    @endcan
                                                                                </div>
                                                                            </td> 
                                                                        </tr> 
                                                                    @endforeach
                                                                </tbody>
                                                            </table> 
                                                        @else
                                                            <tr>
                                                                <td colspan="4">No Blogs Found</td>
                                                            </tr>
                                                        @endif
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
                                    @empty
                                        <h1>0 target assigned</h1>
                                @endforelse
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
    <div class="modal fade" id="addArticleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                @if ($errors->any())
                    <h3 class="alert alert-danger">{{$errors->first()}}</h3>
                @endif
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('addBlogFrm')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Add New Blog</h2>
                    </div>
                    <!--begin::Modal body-->
                    <div class="modal-body mx-md-10">
                        <div class="row">
                            <label class="col-3 col-form-label">Tab</label>
                            <select name="tab_id" class="form-control">
                                <option value="">Select Tabs</option>
                                @foreach ($all_tabs as $tab)
                                    <option value="{{$tab['id']}}">{{$tab['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <label class="col-3 col-form-label">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="<?= date("Y-m-d") ?>"/>
                        </div>
                        <div class="row">
                            <label class="col-3 col-form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Please Enter Blog Title" />
                        </div>
                        <div class="row">
                            <label class="col-3 col-form-label">Link</label>
                            <input type="text" name="link" id="link" class="form-control" placeholder="Please Enter Blog Link" />
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
    <div class="modal fade" id="displayNotesModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bolder">Notes</h2>
                </div>
                <!--begin::Modal body-->
                <div class="modal-body mx-md-10">
                    <div class="row">
                        {{-- <label class="col-3 col-form-label">Notes</label> --}}
                        <textarea type="text" id="notes" class="form-control" placeholder="Please Write Note" readonly></textarea>
                    </div>
                </div>
                <!--end::Modal body-->
                <div class="modal-footer text-center">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                    <button type="reset" class="btn btn-primary" data-bs-dismiss="modal">
                        <span class="indicator-label">ok</span>
                        <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $(".datatable").DataTable();
                $("#addArticleBtn").on("click",function(){
                    $("#addArticleModal").modal("show");
                })
                $(document).on("click",".displayNotes",function(e){
                    const id = e.target.getAttribute("data-id");
                    if(id){ 
                        $.ajax("{!! route('getNotes') !!}",{
                            type:"POST",
                            data:{
                                id:id
                            }
                        })
                        .done(data=>{
                            if(data?.notes){
                                $("#notes").val(data.notes);
                                $("#displayNotesModal").modal("show");
                            }
                        })
                    }else{
                        window.alert("Unable to get Notes!");
                    }
                })
            },jQuery)
        })
    </script>
@endsection
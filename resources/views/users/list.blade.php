@extends('layout')
@section("page-title","Users - User Management")
@section("user_management.accordion","hover show")
@section("users","active")
@section("content")
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				@include("sidebar")
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					@include("header")
					@if ($errors->any())
						<div class="container error">
							<h6 class="alert alert-danger">{{$errors->first()}}</h6>
						</div>
					@elseif(session("info"))
						<div class="container info">
							<h6 class="alert alert-info">{{session("info")}}</h6>
						</div>
					@endif
					@can("user-read")
					<!--begin::Content-->
					    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Toolbar-->
						<div class="toolbar" id="kt_toolbar">
							<!--begin::Container-->
							<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
								<!--begin::Page title-->
								<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
									<!--begin::Title-->
									<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Users</h1>
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
										<li class="breadcrumb-item text-dark">User management</li>
										<!--end::Item-->
									</ul>
									<!--end::Breadcrumb-->
								</div>
								<!--end::Page title-->
								@can("user-create")
									<div class="d-flex align-items-center py-1">
										<a href="{{route('createUserForm')}}" class="btn btn-sm btn-primary" target="_blank">
											<span class="svg-icon svg-icon-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
												<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
											</svg>
										</span>Add User
										</a>
									</div>
								@endcan
							</div>
							<!--end::Container-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Row-->
                        <div class="post d-flex flex-column-fluid" id="kt_post">
                            <!--begin::Container-->
                            <div id="kt_content_container" class="container-xxl">

                                <!--begin:::Tabs-->
                                <ul class="mx-9 nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">

                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1 active" data-bs-toggle="tab"
                                           href="#partner">Partner</a>
                                    </li>
                                    <!--end:::Tab item-->

                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                           href="#employee">Employee</a>
                                    </li>
                                    <!--end:::Tab item-->

                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                           href="#channelpartner">Channel Partner</a>
                                    </li>
                                    <!--end:::Tab item-->

                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                           href="#freelancerams">Freelancer AMS</a>
                                    </li>
                                    <!--end:::Tab item-->

                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                           href="#freelancerprime">Freelancer Prime</a>
                                    </li>
                                    <!--end:::Tab item-->

                                    <!--begin:::Tab item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                           href="#terminated">Terminated</a>
                                    </li>
                                    <!--end:::Tab item-->

                                </ul>
                                <!--end:::Tabs-->

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="partner" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">User Name</th>
                                                            <th class="min-w-75px">Role</th>
                                                            <th class="min-w-75px">Joining Date</th>
                                                            <th class="text-center min-w-100px">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                            @forelse ($partner as $user)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td class="role-value-td">{{$user->name}}</td>
                                                                    <td class="role-value-td">{{$user->role}}</td>
                                                                    <td class="role-value-td">{{date("Y-m-d",strtotime($user->joining_date))}}</td>
                                                                    <td class="">
                                                                        @canany(["user-write","user-read"])
                                                                            <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                                <span class="svg-icon svg-icon-5 m-0">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                    </svg>
                                                                                </span>
                                                                            </a>
                                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                                @can("user-write")
                                                                                    <div class="menu-item px-2">
                                                                                        <a href="{{url('/user/edit',$user->id)}}"  class="menu-link px-2"  target="_blank">
                                                                                            Edit
                                                                                        </a>
                                                                                    </div>
                                                                                @endcan
                                                                                @can("user-read")
                                                                                    <div class="menu-item px-2">
                                                                                        <a href="{{route('viewUser',$user->id)}}"  class="menu-link px-2"  target="_blank">
                                                                                            View More
                                                                                        </a>
                                                                                    </div>
                                                                                @endcan
                                                                            </div>
                                                                        @endcan
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <div class="tab-pane fade show" id="employee" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">User Name</th>
                                                            <th class="min-w-75px">Role</th>
                                                            <th class="min-w-75px">Joining Date</th>
                                                            <th class="text-center min-w-100px">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse ($employee as $user)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td class="role-value-td">{{$user->name}}</td>
                                                                <td class="role-value-td">{{$user->role}}</td>
                                                                <td class="role-value-td">{{date("Y-m-d",strtotime($user->joining_date))}}</td>
                                                                <td class="">
                                                                    @canany(["user-write","user-read"])
                                                                        <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                            @can("user-write")
                                                                                <div class="menu-item px-2">
                                                                                    <a href="{{url('/user/edit',$user->id)}}"  class="menu-link px-2"  target="_blank">
                                                                                        Edit
                                                                                    </a>
                                                                                </div>
                                                                            @endcan
                                                                            @can("user-read")
                                                                                <div class="menu-item px-2">
                                                                                    <a href="{{route('viewUser',$user->id)}}"  class="menu-link px-2"  target="_blank">
                                                                                        View More
                                                                                    </a>
                                                                                </div>
                                                                            @endcan
                                                                        </div>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>

                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <div class="tab-pane fade show" id="channelpartner" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">User Name</th>
                                                            <th class="min-w-75px">Role</th>
                                                            <th class="min-w-75px">Joining Date</th>
                                                            <th class="text-center min-w-100px">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse ($channelPartner as $user)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td class="role-value-td">{{$user->name}}</td>
                                                                <td class="role-value-td">{{$user->role}}</td>
                                                                <td class="role-value-td">{{date("Y-m-d",strtotime($user->joining_date))}}</td>
                                                                <td class="">
                                                                    @canany(["user-write","user-read"])
                                                                        <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                            @can("user-write")
                                                                                <div class="menu-item px-2">
                                                                                    <a href="{{url('/user/edit',$user->id)}}"  class="menu-link px-2"  target="_blank">
                                                                                        Edit
                                                                                    </a>
                                                                                </div>
                                                                            @endcan
                                                                            @can("user-read")
                                                                                <div class="menu-item px-2">
                                                                                    <a href="{{route('viewUser',$user->id)}}"  class="menu-link px-2"  target="_blank">
                                                                                        View More
                                                                                    </a>
                                                                                </div>
                                                                            @endcan
                                                                        </div>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>

                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <div class="tab-pane fade show" id="freelancerams" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">User Name</th>
                                                            <th class="min-w-75px">Role</th>
                                                            <th class="min-w-75px">Joining Date</th>
                                                            <th class="text-center min-w-100px">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse ($freelancerAMS as $user)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td class="role-value-td">{{$user->name}}</td>
                                                                <td class="role-value-td">{{$user->role}}</td>
                                                                <td class="role-value-td">{{date("Y-m-d",strtotime($user->joining_date))}}</td>
                                                                <td class="">
                                                                    @canany(["user-write","user-read"])
                                                                        <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                            @can("user-write")
                                                                                <div class="menu-item px-2">
                                                                                    <a href="{{url('/user/edit',$user->id)}}"  class="menu-link px-2"  target="_blank">
                                                                                        Edit
                                                                                    </a>
                                                                                </div>
                                                                            @endcan
                                                                            @can("user-read")
                                                                                <div class="menu-item px-2">
                                                                                    <a href="{{route('viewUser',$user->id)}}"  class="menu-link px-2"  target="_blank">
                                                                                        View More
                                                                                    </a>
                                                                                </div>
                                                                            @endcan
                                                                        </div>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>

                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <div class="tab-pane fade show" id="freelancerprime" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">User Name</th>
                                                            <th class="min-w-75px">Role</th>
                                                            <th class="min-w-75px">Joining Date</th>
                                                            <th class="text-center min-w-100px">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold" id="activeCallTable">
                                                        @forelse ($freelancerPrime as $user)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td class="role-value-td">{{$user->name}}</td>
                                                                <td class="role-value-td">{{$user->role}}</td>
                                                                <td class="role-value-td">{{date("Y-m-d",strtotime($user->joining_date))}}</td>
                                                                <td class="">
                                                                    @canany(["user-write","user-read"])
                                                                        <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                            @can("user-write")
                                                                                <div class="menu-item px-2">
                                                                                    <a href="{{url('/user/edit',$user->id)}}"  class="menu-link px-2"  target="_blank">
                                                                                        Edit
                                                                                    </a>
                                                                                </div>
                                                                            @endcan
                                                                            @can("user-read")
                                                                                <div class="menu-item px-2">
                                                                                    <a href="{{route('viewUser',$user->id)}}"  class="menu-link px-2"  target="_blank">
                                                                                        View More
                                                                                    </a>
                                                                                </div>
                                                                            @endcan
                                                                        </div>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>

                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <div class="tab-pane fade show" id="terminated" aria-labelledby="active-tab" role="tabpanel">
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
                                                            <th class="min-w-75px">User Name</th>
                                                            <th class="min-w-75px">Role</th>
                                                            <th class="min-w-75px">Joining Date</th>
                                                            <th class="min-w-75px">Terminated Date</th>
                                                            <th class="text-center min-w-100px">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-bold">
                                                        @forelse ($terminated as $user)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td class="role-value-td">{{$user->name}}</td>
                                                                <td class="role-value-td">{{$user->role}}</td>
                                                                <td class="role-value-td">{{date("Y-m-d",strtotime($user->joining_date))}}</td>
                                                                <td class="role-value-td">{{date("Y-m-d",strtotime($user->deleted_at))}}</td>
                                                                <td class="">
                                                                    @canany(["user-write","user-read"])
                                                                        <a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
                                                                            @can("user-write")
                                                                                <div class="menu-item px-2">
                                                                                    <a href="{{url('/user/edit',$user->id)}}"  class="menu-link px-2"  target="_blank">
                                                                                        Edit
                                                                                    </a>
                                                                                </div>
                                                                            @endcan
                                                                            @can("user-read")
                                                                                <div class="menu-item px-2">
                                                                                    <a href="{{route('viewUser',$user->id)}}"  class="menu-link px-2"  target="_blank">
                                                                                        View More
                                                                                    </a>
                                                                                </div>
                                                                            @endcan
                                                                        </div>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>

                                                </div>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Container-->
                        </div>
						<!-- Row Ends -->
					</div>
					@else
						<h1>Unauthorised</h1>
					@endcan
					<!--end::Content-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>

		<!-- End Modal View Users -->

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

		<div id="kt_modal_add_user"></div>
		<!-- hidden More Whatsapp Ends-->
		<!--end::Scrolltop-->
		<!--end::Main-->
		@section("jscript")
			<script>
				$(document).ready(function(){
                    $(".datatable").dataTable();
					const url = {!! json_encode(route('deleteUser',"")) !!};
					$('.not_active').click(function() {
					$(this).toggleClass('text-dark');
					$(this).toggleClass('text-danger');

					$(document).on("click",".call_modal_view",function() {
					var $row = $(this).closest("tr");
					$('.call_modal_view').modal('open');
					$('.inputClass').val(row);
					});

					$('#save-role-btn').click(function() {
						$('.role-value-td').html( $('.role-select option:selected' ).val() );
						$('.role-value-input').val( $('.role-select option:selected' ).val() );
					});
				});
			});
			</script>
		@endsection
		<!--end::Javascript-->
@endsection

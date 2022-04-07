@extends('layout')
@section("page-title","Roles - User Management")
@section("user_management.accordion","hover show")
@section("roles","active")
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
								<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Roles</h1>
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
									<li class="breadcrumb-item text-dark">Roles</li>
									<!--end::Item-->
								</ul>
								<!--end::Breadcrumb-->
							</div>
							<!--end::Page title-->
							<!--begin::Actions-->
							<div class="d-flex align-items-center py-1">
								@can("role-create")
								<!--begin::Button-->
								<a href="{{route('addRoles')}}" class="btn btn-sm btn-primary" id="kt_toolbar_primary_button">
									<span class="svg-icon svg-icon-2">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
											<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
										</svg>
									</span>Add Role
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
										<table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
											<!--begin::Table head-->
											<thead>
												<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
													<th class="min-w-10px">Sr No.</th>
													<th class="min-w-75px">Role</th>
													<th class="min-w-75px">Users</th>
													<th class="min-w-75px">Created Date</th>
													<th class="text-end min-w-100px">Actions</th>
												</tr>
											</thead>
											<tbody class="text-gray-600 fw-bold">
												@can("role-read")
												@php
													$i=1;
												@endphp
												@forelse ($roles as $role)
													<tr>
														<td>{{sprintf("%04d",$i++)}}</td>
														<td class="role-value-td">{{$role->name}}</td>
														<td class="role-value-td">{{$role->users_count}}</td>
														<td class="role-value-td">{{date("Y-m-d",strtotime($role->created_at))}}</td>
														<td class="text-end">
															<div class="d-flex justify-content-end align-items-end">
																@can("role-write")
																<div class="menu-item">
																	<a href="{{route('editRoleForm',$role->id)}}" data-id="{{$role->id}}" class="menu-link px-3">
																		{{-- <i class="fas fa-user-edit"></i> --}}
																		<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="24" height="24"viewBox="0 0 172 172"style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#009ef7"><path d="M148.35,6.88c-4.28656,0 -8.55969,1.67969 -11.825,4.945l-2.795,2.795l23.65,23.65c-0.01344,0.01344 2.795,-2.795 2.795,-2.795c6.54406,-6.54406 6.53063,-17.11937 0,-23.65c-3.27875,-3.26531 -7.53844,-4.945 -11.825,-4.945zM128.4625,20.7475c-0.77937,0.1075 -1.505,0.49719 -2.0425,1.075l-111.585,111.6925c-0.44344,0.40313 -0.77937,0.92719 -0.9675,1.505l-6.88,25.8c-0.30906,1.1825 0.04031,2.43219 0.90031,3.29219c0.86,0.86 2.10969,1.20938 3.29219,0.90031l25.8,-6.88c0.57781,-0.18812 1.10188,-0.52406 1.505,-0.9675l111.6925,-111.585c1.37063,-1.33031 1.38406,-3.52062 0.05375,-4.89125c-1.33031,-1.37062 -3.52062,-1.38406 -4.89125,-0.05375l-111.0475,111.0475l-13.975,-13.975l111.0475,-111.0475c1.03469,-0.99437 1.34375,-2.53969 0.76594,-3.85656c-0.57781,-1.31687 -1.90812,-2.13656 -3.34594,-2.05594c-0.1075,0 -0.215,0 -0.3225,0z"></path></g></g></svg>
																	</a>
																</div>
																@endcan
																@can("role-delete")
																<div class="menu-item">
																	<a href="javascript:void(0)" data-id="{{$role->id}}" class="menu-link px-2 removeRole">
																		<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#009ef7"><path d="M74.53333,17.2c-1.53406,-0.02082 -3.01249,0.574 -4.10468,1.65146c-1.09219,1.07746 -1.70703,2.54767 -1.70704,4.08187h-34.32161c-2.06765,-0.02924 -3.99087,1.05709 -5.03322,2.843c-1.04236,1.78592 -1.04236,3.99474 0,5.78066c1.04236,1.78592 2.96558,2.87225 5.03322,2.843h103.2c2.06765,0.02924 3.99087,-1.05709 5.03322,-2.843c1.04236,-1.78592 1.04236,-3.99474 0,-5.78066c-1.04236,-1.78592 -2.96558,-2.87225 -5.03322,-2.843h-34.32161c-0.00001,-1.53421 -0.61486,-3.00442 -1.70704,-4.08187c-1.09219,-1.07746 -2.57061,-1.67228 -4.10468,-1.65146zM34.4,45.86667v91.73333c0,6.33533 5.13133,11.46667 11.46667,11.46667h80.26667c6.33533,0 11.46667,-5.13133 11.46667,-11.46667v-91.73333z"></path></g></g></svg>
																	</a>
																</div>
																@endcan
															</div>
														</td>
													</tr>
												@empty
													<tr>
														<td colspan="4">No Roles Found</td>
													</tr>
												@endforelse
												@else
													<h1>Unauthorised</h1>
												@endcan
												<!--end::Table row-->
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
	<div class="modal fade" id="editRolesModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered mw-650px" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="fw-bolder">Edit Roles</h2>
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
					<!--begin::Form-->
					<form id="" class="form" action="#">
						<!--begin::Scroll-->
						<!-- <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px"> -->
							<div class="form-group row">
								<label for="example-tel-input" class="col-3 col-form-label">Person Name</label>
								<div class="col-9">
									<input class="form-control" type="text" value="Julie" id="example-tel-input" >
								</div>
							</div>

							<!--begin::Input wrapper-->
							<div class="position-relative">
								<!--begin::Input-->
								<select name="profession" class="form-select form-select-solid role-select" data-control="select2" data-hide-search="true" data-placeholder="Select Role">
									<option></option>
									<option value="Client">Client</option>
									<option value="Analyst">Anlyst</option>
									<option value="Call">Call</option>
									<option value="Trader">Trader</option>
								</select>
							</div>
							<!--end::Input wrapper-->
						<!-- </div> -->
						<!--end::Scroll-->
					</form>
					<!--end::Form-->
				</div>
				<!--end::Modal body-->
				<div class="modal-footer text-center">
					<!-- <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button> -->
					<button type="submit" class="btn btn-primary" id="save-role-btn" data-kt-users-modal-action="submit" data-bs-dismiss="modal">
						<span class="indicator-label">Save</span>
						<span class="indicator-progress">Please wait...
						<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
					</button>
				</div>
			</div>
		</div>
	</div>
	<!--end::Modal - Edit Roles-->

	<!-- Modal View Roles -->
	<div class="modal fade" id="viewRolesModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered mw-650px" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="fw-bolder">View Role</h2>
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
					<!--begin::Form-->
					<form id="" class="form" action="#">
						<!--begin::Scroll-->
						<!-- <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px"> -->
							<div class="form-group row">
								<label for="example-tel-input" class="col-3 col-form-label">Person Name</label>
								<div class="col-9">
									<input class="form-control" type="text" value="Julie" id="example-tel-input" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label for="example-tel-input" class="col-3 col-form-label">Role</label>
								<div class="col-9">
									<input class="form-control role-value-input" type="text" value="Anlyst" id="example-tel-input" disabled>
								</div>
							</div>
						<!-- </div> -->
						<!--end::Scroll-->
					</form>
					<!--end::Form-->
				</div>
				<!--end::Modal body-->
				<div class="modal-footer text-center">
					<!-- <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button> -->
					<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit" data-bs-dismiss="modal">
						<span class="indicator-label">ok</span>
						<span class="indicator-progress">Please wait...
						<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
					</button>
				</div>
			</div>
		</div>
	</div>

<!-- delete model -->
<div class="modal fade" id="confirmDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">Delete</h2>
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
            <div class="modal-body mx-md-10" style="text-align: -webkit-center;">
                <div class="d-felx justify-content-center align-items-center">
                    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                    <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_jcuhm71r.json"  background="transparent"  speed="0.5"  style="width: 200px; height: 200px;"  loop autoplay></lottie-player>
                    <h4>Are you sure you want to Delete this role?</h4>
                </div>
            </div>

            <!--end::Modal body-->
            <div class="modal-footer text-center">
                <!-- <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button> -->
                <button type="submit" class="btn btn-primary" id="confirmDeleteCallBtn">Yes</button>
                <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit" data-bs-dismiss="modal">
                    <span class="indicator-label">No</span>
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--end::Modals-->
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
	@section("jscript")
		<script>
			window.addEventListener("DOMContentLoaded",function(){
				$(document).on("click",".removeRole",function(e){
                    const id = $(this).attr("data-id");
                    if(id){
                        $("#confirmDeleteCallBtn").attr("data-id",id);
                        $("#confirmDelete").modal("show");

                    }else{
                        window.alert("Unable to delete this role");
                    }
				});
				$("#confirmDeleteCallBtn").on("click", function(e){
					const id = e.target.getAttribute("data-id");
					if(id){
						$.ajax("/role/remove/"+id,{
							type:"GET",
							headers: {
								'X-CSRF-TOKEN': $("input[name='_token']").val()
							}
						})
							.done(data=>{
								window.location.href = "roles";
							})
					}else{
						window.alert("Unable to delete this role");
					}
				})
				$(".datatable").DataTable();
			});
		</script>
	@endsection
@endsection

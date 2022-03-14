@extends('layout')
@section("page-title","Users")
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
											<a href="index.html" class="text-muted text-hover-primary">Home</a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item">
											<span class="bullet bg-gray-200 w-5px h-2px"></span>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item text-dark">Users</li>
										<!--end::Item-->
									</ul>
									<!--end::Breadcrumb-->
								</div>
								<!--end::Page title-->
								@can("user-create")
								<div class="d-flex align-items-center py-1">
                                    <a href="{{route('createUserForm')}}" class="btn btn-lg btn-primary">
                                    Add User
                                    </a>
								</div>
								@endcan
							</div>
							<!--end::Container-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Row-->
						<div class="row g-6 g-xl-9 mx-4">
							@forelse ($users as $user)
								<!--begin::Col-->
								<div class="col-md-6 col-xl-4">
									<!--begin::Card-->
									<div class="card border border-2 border-gray-300 border-hover">
										<!--begin::Card header-->
										<div class="card-header border-0 pt-9">
											<!--begin::Card Title-->
											<div class="card-title m-0">
												<!--begin::Avatar-->
												<div class="symbol symbol-50px w-50px bg-light">
													<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 172 172"
														style=" fill:#000000;">
														<g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter"
															stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
															font-size="none" text-anchor="none" style="mix-blend-mode: normal">
															<path d="M0,172v-172h172v172z" fill="none"></path>
															<g fill="#ef305e">
																<path
																	d="M86,6.88c-43.69832,0 -79.12,35.42168 -79.12,79.12c0,43.69832 35.42168,79.12 79.12,79.12c43.69832,0 79.12,-35.42168 79.12,-79.12c0,-43.69832 -35.42168,-79.12 -79.12,-79.12zM116.50936,116.96h-7.21024v-47.28624h-0.516l-19.52544,46.85968h-6.52224l-19.52544,-46.85968h-0.516v47.28624h-7.21024v-61.92h8.96808l21.20416,51.23536h0.688l21.19728,-51.23536h8.96808z">
																</path>
															</g>
														</g>
													</svg>
												</div>
												<!--end::Avatar-->
											</div>
											<!--end::Car Title-->
											<!--begin::Card toolbar-->
											<div class="card-toolbar">
												<span class="badge badge-light-primary fw-bolder me-auto px-4 py-3 mx-2">{{$user->role}}</span>
											</div>
											<!--end::Card toolbar-->
										</div>
										<!--end:: Card header-->
										<!--begin:: Card body-->
										<div class="card-body p-9">
											<!--begin::Name-->
											<div class="fs-3 fw-bolder text-dark">{{$user->name}}</div>
											<!--end::Name-->
											<!--begin::Info-->
											<div class="d-flex justify-content-between mt-4">
												<!--begin::Col-->
                                                @if($user->user_type==1 && $user->deleted_at==null)
												<div class="">
													<!--begin::Option-->
													<input type="checkbox" class="btn-check" name="account_type" value="partner" {{($user->user_type==1 && $user->deleted_at==null)?"checked":""}} id="kt_create_account_form_account_type_partner">
													<label class="btn btn-outline btn-outline-dashed btn-outline-default p-2 d-flex align-items-center" for="kt_create_account_form_account_type_partner">
														<!--begin::Info-->
														Partner
														{{-- <span class="d-block fw-bold text-start">
															<span class="text-dark fw-bolder d-block fs-4 mb-2">Partner</span>
														</span> --}}
														<!--end::Info-->
													</label>
													<!--end::Option-->
												<div class=""></div></div>
                                                @endif
												<!--end::Col-->
												<!--begin::Col-->
                                                @if($user->user_type==2 && $user->deleted_at==null)
												<div class="">
													<!--begin::Option-->
													<input type="checkbox" class="btn-check" name="account_type" value="employee" {{($user->user_type==2 && $user->deleted_at==null)?"checked":""}} id="kt_create_account_form_account_type_employee">
													<label class="btn btn-outline btn-outline-dashed btn-outline-default p-2 d-flex align-items-center" for="kt_create_account_form_account_type_employee">
														<!--begin::Info-->
														Employee
														<!-- <span class="d-block fw-bold text-start">
															<span class="text-dark fw-bolder d-block fs-4 mb-2">Employee</span>
														</span> -->
														<!--end::Info-->
													</label>
													<!--end::Option-->
												</div>
                                            @endif
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                @if($user->user_type==3 && $user->deleted_at==null)
                                                <div class="">
                                                    <!--begin::Option-->
                                                    <input type="checkbox" class="btn-check" name="account_type" value="channel_partner" {{($user->user_type==3 && $user->deleted_at==null)?"checked":""}} id="kt_create_account_form_account_type_employee">
                                                    <label class="btn btn-outline btn-outline-dashed btn-outline-default p-2 d-flex align-items-center" for="kt_create_account_form_account_type_employee">
                                                        <!--begin::Info-->
                                                        Channel Partner
                                                        <!-- <span class="d-block fw-bold text-start">
                                                            <span class="text-dark fw-bolder d-block fs-4 mb-2">Employee</span>
                                                        </span> -->
                                                        <!--end::Info-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                            @endif
                                                <!--end::Col-->
                                            </div>
                                            <div class="d-flex justify-content-between mt-4">
                                                <!--begin::Col-->
                                                @if($user->user_type==4 && $user->deleted_at==null)
                                                <div class="">
                                                    <!--begin::Option-->
                                                    <input type="checkbox" class="btn-check" name="account_type" value="freelancer_ams" {{($user->user_type==4 && $user->deleted_at==null)?"checked":""}} id="kt_create_account_form_account_type_employee">
                                                    <label class="btn btn-outline btn-outline-dashed btn-outline-default p-2 d-flex align-items-center" for="kt_create_account_form_account_type_employee">
                                                        <!--begin::Info-->
                                                        Freelancer AMS
                                                        <!-- <span class="d-block fw-bold text-start">
                                                            <span class="text-dark fw-bolder d-block fs-4 mb-2">Employee</span>
                                                        </span> -->
                                                        <!--end::Info-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                            @endif
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                @if($user->user_type==5 && $user->deleted_at==null)
                                                <div class="">
                                                    <!--begin::Option-->
                                                    <input type="checkbox" class="btn-check" name="account_type" value="freelancer_prime" {{($user->user_type==5 && $user->deleted_at==null)?"checked":""}} id="kt_create_account_form_account_type_employee">
                                                    <label class="btn btn-outline btn-outline-dashed btn-outline-default p-2 d-flex align-items-center" for="kt_create_account_form_account_type_employee">
                                                        <!--begin::Info-->
                                                        Freelancer Prime
                                                        <!-- <span class="d-block fw-bold text-start">
                                                            <span class="text-dark fw-bolder d-block fs-4 mb-2">Employee</span>
                                                        </span> -->
                                                        <!--end::Info-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                            @endif
                                                <!--end::Col-->

												<!--begin::Col-->
                                                @if($user->deleted_at!=null)
												<div class="">
													<!--begin::Option-->
													<input type="checkbox" class="btn-check" name="account_type" value="terminated" {{($user->deleted_at!=null)?"checked":""}} id="kt_create_account_form_account_type_terminated">
													<label class="btn btn-outline btn-outline-dashed btn-outline-default p-2 d-flex align-items-center" for="kt_create_account_form_account_type_terminated">
														<!--begin::Info-->
														Terminated
														<!-- <span class="d-block fw-bold text-start">
															<span class="text-dark fw-bolder d-block fs-4 mb-2">Terminated</span>
														</span> -->
														<!--end::Info-->
													</label>
													<!--end::Option-->
												</div>
                                            @endif
												<!--end::Col-->
											</div>
											<!--end::Info-->
										<!--begin::Details toggle-->
{{--										<div class="d-flex justify-content-center align-items-center fs-4 py-3">--}}
{{--											<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="View More Details">--}}
{{--												<a href="{{route('viewUser',$user->id)}}" target="_blank" class="btn btn-sm btn-light-primary">View More</a>--}}
{{--											</span>--}}
{{--										</div>--}}
										<!--end::Details toggle-->

										<div class="d-flex justify-content-between">
											@can("user-write")
											<div class="d-flex align-items-center py-1">
												<a href="{{url('/user/edit',$user->id)}}" target="_blank" class="btn btn-lg btn-primary">
												Edit User
												</a>
											</div>
											@endcan
                                                <div class="d-flex align-items-center py-1">
                                                    <a href="{{route('viewUser',$user->id)}}" target="_blank" class="btn btn-lg btn-primary">View More</a>
                                                </div>

{{--											@can("user-delete")--}}
{{--											<div class="d-flex align-items-center py-1">--}}
{{--												<a href="javascript:void(0);" data-id='{{$user->id}}' class="btn btn-lg btn-primary terminateAccount" data-bs-toggle="modal" data-bs-target="#confirmTerminate">--}}
{{--												Terminate--}}
{{--												</a>--}}
{{--											</div>--}}
{{--											@endcan--}}
										</div>
										</div>
										<!--end:: Card body-->
									</div>
									<!--end::Card-->
								</div>
								<!--end::Col-->
							@empty
								<h1>No Users</h1>
							@endforelse
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
		<!--end::Root-->
		<!--begin::Drawers-->
		{{-- <!--begin::Activities drawer-->
		@include("kt_activities")
		<!--end::Activities drawer-->
		<!--begin::Chat drawer-->
		@include("kt_drawer_chat")
		<!--end::Chat drawer-->
		<!--begin::Exolore drawer toggle-->
		@include("kt_explore_toggle")
		<!--end::Exolore drawer toggle-->
		<!--begin::Exolore drawer-->
		@include("kt_explore")
		<!--end::Exolore drawer-->
		<!--end::Drawers--> --}}

		<!-- Modal View Users -->
		<div class="modal fade" id="confirmTerminate" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered mw-650px" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="fw-bolder">Terminate</h2>
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
						<h4>Are you sure you want to terminate?</h4>
					</div>
					<!--end::Modal body-->
					<div class="modal-footer text-center">
						<!-- <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button> -->
						<a href='' class="btn btn-primary" id="terminate" user-id="">
							<span class="indicator-label">Yes</span>
							<span class="indicator-progress">Please wait...
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</a>
						<button type="submit" class="btn btn-primary" kt-users-modal-action="submit" data-bs-dismiss="modal">
							<span class="indicator-label">No</span>
							<span class="indicator-progress">Please wait...
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button>
					</div>
				</div>
			</div>
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
				$(document).on("click",".terminateAccount",function(e){
					let id = e.target.getAttribute("data-id");
					$("#terminate").attr("href",url+"/"+id);
				})
				$("#confirmTerminate").on("hidden.bs.modal",function(){
					$("#terminate").attr("href","");
				})
			});
			</script>
		@endsection
		<!--end::Javascript-->
@endsection

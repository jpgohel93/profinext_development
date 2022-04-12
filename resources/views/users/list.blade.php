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
										<a href="{{route('createUserForm')}}" class="btn btn-sm btn-primary">
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
						<div class="row g-6 g-xl-9 mx-4">
                            @forelse ($users as $user)
                                <div class="col-md-6 col-xxl-3">
                                <!--begin::Card-->
                                <div class="card border border-2 border-gray-300">
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-center flex-column p-1">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-65px symbol-circle mb-5" style="background: #009ef7;">
                                            <span class="symbol-label fs-2x fw-bold text-primary bg-light-primary"><?php echo ucwords($user->name[0]); ?></span>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Name-->
                                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">{{$user->name}}</a>
                                        <!--end::Name-->
                                        <!--begin::Position-->
                                        <div class="fw-bold text-gray-400 mb-6">
                                            <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3 mx-2">{{$user->role}}</span>
                                        </div>
                                        <!--end::Position-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-center flex-wrap mb-5">
                                            <!--begin::Stats-->
                                            @can("user-write")
                                                <div class="d-flex align-items-left py-1" style="margin-right:10px;">
                                                    <a href="{{url('/user/edit',$user->id)}}" target="_blank" class="btn btn-sm btn-primary">
                                                        Edit User
                                                    </a>
                                                </div>
                                            @endcan
                                            <!--end::Stats-->
                                            <!--begin::Stats-->

                                            <div class="d-flex align-items-right py-1">
                                                <a href="{{route('viewUser',$user->id)}}" target="_blank"
                                                   class="btn btn-sm btn-primary">View More</a>
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Info-->


                                    </div>
                                    <!--begin::Card body-->
                                </div>
                                <!--begin::Card-->
                            </div>
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
			});
			</script>
		@endsection
		<!--end::Javascript-->
@endsection

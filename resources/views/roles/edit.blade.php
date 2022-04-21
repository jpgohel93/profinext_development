@extends('layout')
@section("page-title","Edit Role - User Management")
@section("user_management.accordion","hover show")
@section("roles","active")
@section("content")
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				@include("sidebar")
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					 @include("header")
						<!--end::Toolbar-->
						<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_app_stepper">
							<!--begin::Content-->
							<div class="flex-row-fluid px-lg-15">
								<!--begin::Form-->
								@can("role-write")
									<form class="form" novalidate="novalidate" method="post" action="{{route('editRole',$role->id)}}" id="kt_modal_create_app_form">

										<!--begin::Step 1-->
										<div class="current d-block card p-7 my-5" data-kt-stepper-element="content">
											<div class="w-100">
												@if($errors->any())
													<div class="container-fluid p-0 m-0 error">
														<h6 class="alert alert-danger">{{$errors->first()}}</h6>
													</div>
												@elseif(session("info"))
													<div class="container-fluid p-0 m-0 info">
														<h6 class="alert alert-info">{{session("info")}}</h6>
													</div>
												@endif
                                                <div id="kt_toolbar">
                                                    <!--begin::Container-->
                                                    <div id="kt_toolbar_container">
                                                        <!--begin::Page title-->
                                                        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                                            <!--begin::Title-->
                                                            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Edit role</h1>
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
                                                    </div>
                                                    <!--end::Container-->
                                                </div>
                                                <!--end::Toolbar-->
												<div class="row mt-5">
													<!--begin::Input group-->
													<div class="col-md-6 mb-8">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span class="required">Role</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="role" placeholder="" value="{{$role->name}}" {{isset($userRole) && $userRole == "super-admin" ? '' : 'readonly'}}/>
														<!--end::Input-->
													</div>
													<div class="col-md-6 align-self-center">
														<div class="form-check form-check-custom form-check-solid float-end">
															<input type="checkbox" class="form-check-input mx-3" id="superAdmin">
															<label class="custom-control-label h3" for="superAdmin">Super Admin</label>
														</div>
													</div>
													<!--end::Input group-->
												</div>
												<div class="mb-0 table-responsive">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Permissioins</span>
													</label>
													<!-- <h3 class="stepper-title">Permissioins</h4> -->
													<table role="table" aria-busy="false" aria-colcount="5" class="table b-table table-striped" id="__BVID__660">
														<!---->
														<!---->
														<thead role="rowgroup" class="">
															<!---->
															<tr role="row" class="">
																<th role="columnheader" scope="col" aria-colindex="1" class="">
																	<div class="font-weight-bold">Module</div>
																</th>
																<th role="columnheader" scope="col" aria-colindex="2" class="">
																	<div>Read</div>
																</th>
																<th role="columnheader" scope="col" aria-colindex="3" class="">
																	<div>Write</div>
																</th>
																<th role="columnheader" scope="col" aria-colindex="4" class="">
																	<div>Create</div>
																</th>
																<th role="columnheader" scope="col" aria-colindex="5" class="">
																	<div>Delete</div>
																</th>
															</tr>
														</thead>
														<tbody role="rowgroup">
															@php
																// here we'll get all modules name
																$permissions_constant = Config::get("constants.Permissions");
																// each modules has 4 permissions
																$permissions_constant_count = count($permissions_constant)*4;
																// module counter
																$module_counter= 0;
															@endphp
															@for ($i = 0; $i < $permissions_constant_count; $i++)
																@if($i%4==0)
																	<tr role="row" class="">
																		<td aria-colindex="1" role="cell" class=""> {{$permissions_constant[$module_counter]}} </td>
																		<td aria-colindex="2" role="cell" class="">
																			<div class="form-check form-check-custom form-check-solid">
																				<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{$permissions[$i]->name}}" {{(in_array($permissions[$i+1]->id,$rolePermissions))? 'checked':""}} id="__BVID__675">
																				<label class="custom-control-label" for="__BVID__675"></label>
																			</div>
																		</td>
																		<td aria-colindex="2" role="cell" class="">
																			<div class="form-check form-check-custom form-check-solid">
																				<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{$permissions[$i+1]->name}}" {{(in_array($permissions[$i+2]->id,$rolePermissions))? 'checked':""}} id="__BVID__675">
																				<label class="custom-control-label" for="__BVID__675"></label>
																			</div>
																		</td>
																		<td aria-colindex="2" role="cell" class="">
																			<div class="form-check form-check-custom form-check-solid">
																				<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{$permissions[$i+2]->name}}" {{(in_array($permissions[$i+1]->id,$rolePermissions))? 'checked':""}} id="__BVID__675">
																				<label class="custom-control-label" for="__BVID__675"></label>
																			</div>
																		</td>
																		<td aria-colindex="2" role="cell" class="">
																			<div class="form-check form-check-custom form-check-solid">
																				<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' value="{{$permissions[$i+3]->name}}" {{(in_array($permissions[$i+1]->id,$rolePermissions))? 'checked':""}} id="__BVID__675">
																				<label class="custom-control-label" for="__BVID__675"></label>
																			</div>
																		</td>
																	</tr>
																	@php
																		$module_counter++;
																	@endphp
																@endif
															@endfor
														</tbody>
														<!---->
													</table>
												</div>

											</div>
										</div>
										<!--begin::Actions-->
										<div class="d-flex flex-stack pt-10">
											<!--begin::Wrapper-->
											<div class="me-2">
												<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="previous">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
												<span class="svg-icon svg-icon-3 me-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
														<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->Back</button>
											</div>
											<!--end::Wrapper-->
											<!--begin::Wrapper-->
											<div>
												<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
													<span class="indicator-label">Submit
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
													<span class="svg-icon svg-icon-3 ms-2 me-0">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
															<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon--></span>
													<span class="indicator-progress">Please wait...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
												</button>
												<button type="submit" class="btn btn-lg btn-primary">Submit
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
													<span class="svg-icon svg-icon-3 ms-1 me-0">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
															<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</button>
											</div>
											<!--end::Wrapper-->
										</div>
										<!--end::Actions-->
										@csrf
									</form>
								@else
									<h1>Unauthorized</h1>
								@endcan
								<!--end::Form-->
							</div>
							<!--end::Content-->
						</div>
					</div>
					<!--end::Content-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--begin::Drawers-->
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
		@section('jscript')
		<script>
				window.addEventListener("DOMContentLoaded",function(){
					$("#superAdmin").on("click",function(e){
						if(e.target.checked && window.confirm("assing Super Admin Permissions?")){
							$(".permissionCheckBox").each((i,v)=>{
								$(v).prop("checked",true);
							})
						}else{
							$("#superAdmin").prop("checked",false);
							$(".permissionCheckBox").each((i,v)=>{
								$(v).prop("checked",false);
							})
						}
					})
					const checkIfAdminRole = ()=>{
						let bool = false;
						$(".permissionCheckBox").each((i,v)=>{
							if(!bool && v.checked){
								bool=false;
							}else{
								bool = true;
								return false;
							}
						})
						return bool;
					}
					if(!checkIfAdminRole()){
						$("#superAdmin").prop("checked",true);
					}
					$(document).on("change",".permissionCheckBox",function(){
						if(!checkIfAdminRole()){
							$("#superAdmin").prop("checked",true);
						}else{
							$("#superAdmin").prop("checked",false);
						}
					});
				})
			</script>
		@endsection
@endsection

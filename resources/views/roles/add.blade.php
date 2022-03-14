@extends('layout')
@section("page-title","Add Roles")
@section("create-roles","active")
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
								@can("role-create")
								@if ($errors->any())
									<h3 class="alert alert-danger">{{$errors->first()}}</h3>
								@endif
								<form class="form" novalidate="novalidate" method="post" action="{{route('createRole')}}" id="kt_modal_create_app_form">
									<!--begin::Step 1-->
									<div class="current d-block card p-7 my-5" data-kt-stepper-element="content">
										<div class="w-100">
											<div class="stepper-label mt-0" style="margin-top:30px;margin-bottom:20px;">
												<h3 class="stepper-title text-primary">Create Role</h3>
											</div>
											<div class="row">
												<!--begin::Input group-->
												<div class="col-md-6 mb-8">
													<!--begin::Label-->
													<label class="d-flex align-items-center fs-5 fw-bold mb-2">
														<span class="required">Role</span>
													</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="role" placeholder="" value="{{old('role')}}" />
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
														<tr role="row" class="">
															<td aria-colindex="1" role="cell" class=""> Client </td>
															{{-- client permissions from 1 to 4 --}}
															@for($i=0;$i<=3;$i++)
																<td aria-colindex="2" role="cell" class="">
																	<div class="form-check form-check-custom form-check-solid">
																		<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
																		<label class="custom-control-label" for="__BVID__675"></label>
																	</div>
																</td>
															@endfor
														</tr>
														<tr role="row" class="">
															{{-- role permissions from 5 to 8 --}}
															<td aria-colindex="1" role="cell" class=""> Role </td>
															@for($i=4;$i<=7;$i++)
																<td aria-colindex="2" role="cell" class="">
																	<div class="form-check form-check-custom form-check-solid">
																		<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
																		<label class="custom-control-label" for="__BVID__675"></label>
																	</div>
																</td>
															@endfor
														</tr>
														<tr role="row" class="">
															{{-- role permissions from 5 to 8 --}}
															<td aria-colindex="1" role="cell" class=""> User </td>
															@for($i=8;$i<12;$i++)
																<td aria-colindex="2" role="cell" class="">
																	<div class="form-check form-check-custom form-check-solid">
																		<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
																		<label class="custom-control-label" for="__BVID__675"></label>
																	</div>
																</td>
															@endfor
														</tr>
														<tr role="row" class="">
															{{-- role permissions from 5 to 8 --}}
															<td aria-colindex="1" role="cell" class=""> Analyst </td>
															@for($i=12;$i<16;$i++)
																<td aria-colindex="2" role="cell" class="">
																	<div class="form-check form-check-custom form-check-solid">
																		<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
																		<label class="custom-control-label" for="__BVID__675"></label>
																	</div>
																</td>
															@endfor
														</tr>
														<tr role="row" class="">
															{{-- role permissions from 5 to 8 --}}
															<td aria-colindex="1" role="cell" class=""> Trade </td>
															@for($i=16;$i<20;$i++)
																<td aria-colindex="2" role="cell" class="">
																	<div class="form-check form-check-custom form-check-solid">
																		<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
																		<label class="custom-control-label" for="__BVID__675"></label>
																	</div>
																</td>
															@endfor
														</tr>
														<tr role="row" class="">
															{{-- role permissions from 5 to 8 --}}
															<td aria-colindex="1" role="cell" class=""> Trader </td>
															@for($i=20;$i<24;$i++)
																<td aria-colindex="2" role="cell" class="">
																	<div class="form-check form-check-custom form-check-solid">
																		<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
																		<label class="custom-control-label" for="__BVID__675"></label>
																	</div>
																</td>
															@endfor
														</tr>
														<tr role="row" class="">
															{{-- role permissions from 5 to 8 --}}
															<td aria-colindex="1" role="cell" class=""> Monitor </td>
															@for($i=24;$i<28;$i++)
																<td aria-colindex="2" role="cell" class="">
																	<div class="form-check form-check-custom form-check-solid">
																		<input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
																		<label class="custom-control-label" for="__BVID__675"></label>
																	</div>
																</td>
															@endfor
														</tr>
                                                        <tr role="row" class="">
                                                            {{-- role permissions from 5 to 8 --}}
                                                            <td aria-colindex="1" role="cell" class=""> Client Demat </td>
                                                            @for($i=28;$i<32;$i++)
                                                                <td aria-colindex="2" role="cell" class="">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
                                                                        <label class="custom-control-label" for="__BVID__675"></label>
                                                                    </div>
                                                                </td>
                                                            @endfor
                                                        </tr>
                                                        <tr role="row" class="">
                                                            {{-- role permissions from 5 to 8 --}}
                                                            <td aria-colindex="1" role="cell" class=""> Monitor Data </td>
                                                            @for($i=32;$i<36;$i++)
                                                                <td aria-colindex="2" role="cell" class="">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
                                                                        <label class="custom-control-label" for="__BVID__675"></label>
                                                                    </div>
                                                                </td>
                                                            @endfor
                                                        </tr>
                                                        <tr role="row" class="">
                                                            {{-- role permissions from 5 to 8 --}}
                                                            <td aria-colindex="1" role="cell" class=""> Report </td>
                                                            @for($i=36;$i<40;$i++)
                                                                <td aria-colindex="2" role="cell" class="">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
                                                                        <label class="custom-control-label" for="__BVID__675"></label>
                                                                    </div>
                                                                </td>
                                                            @endfor
                                                        </tr>
                                                        <tr role="row" class="">
                                                            {{-- role permissions from 5 to 8 --}}
                                                            <td aria-colindex="1" role="cell" class=""> Freelancer Data </td>
                                                            @for($i=40;$i<44;$i++)
                                                                <td aria-colindex="2" role="cell" class="">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
                                                                        <label class="custom-control-label" for="__BVID__675"></label>
                                                                    </div>
                                                                </td>
                                                            @endfor
                                                        </tr>

                                                        <tr role="row" class="">
                                                            {{-- role permissions from 5 to 8 --}}
                                                            <td aria-colindex="1" role="cell" class=""> Freelancer </td>
                                                            @for($i=44;$i<48;$i++)
                                                                <td aria-colindex="2" role="cell" class="">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
                                                                        <label class="custom-control-label" for="__BVID__675"></label>
                                                                    </div>
                                                                </td>
                                                            @endfor
                                                        </tr>

                                                        <tr role="row" class="">
                                                            {{-- role permissions from 5 to 8 --}}
                                                            <td aria-colindex="1" role="cell" class=""> Channel Partner Data </td>
                                                            @for($i=48;$i<52;$i++)
                                                                <td aria-colindex="2" role="cell" class="">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
                                                                        <label class="custom-control-label" for="__BVID__675"></label>
                                                                    </div>
                                                                </td>
                                                            @endfor
                                                        </tr>

                                                        <tr role="row" class="">
                                                            {{-- role permissions from 5 to 8 --}}
                                                            <td aria-colindex="1" role="cell" class=""> Channel Partner </td>
                                                            @for($i=52;$i<56;$i++)
                                                                <td aria-colindex="2" role="cell" class="">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
                                                                        <label class="custom-control-label" for="__BVID__675"></label>
                                                                    </div>
                                                                </td>
                                                            @endfor
                                                        </tr>

                                                        <tr role="row" class="">
                                                            {{-- role permissions from 5 to 8 --}}
                                                            <td aria-colindex="1" role="cell" class=""> Keyword </td>
                                                            @for($i=56;$i<60;$i++)
                                                                <td aria-colindex="2" role="cell" class="">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
                                                                        <label class="custom-control-label" for="__BVID__675"></label>
                                                                    </div>
                                                                </td>
                                                            @endfor
                                                        </tr>

                                                        <tr role="row" class="">
                                                            {{-- role permissions from 5 to 8 --}}
                                                            <td aria-colindex="1" role="cell" class=""> Trader Data </td>
                                                            @for($i=60;$i<64;$i++)
                                                                <td aria-colindex="2" role="cell" class="">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
                                                                        <label class="custom-control-label" for="__BVID__675"></label>
                                                                    </div>
                                                                </td>
                                                            @endfor
                                                        </tr>

                                                        <tr role="row" class="">
                                                            {{-- role permissions from 5 to 8 --}}
                                                            <td aria-colindex="1" role="cell" class=""> Setup </td>
                                                            @for($i=64;$i<68;$i++)
                                                                <td aria-colindex="2" role="cell" class="">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input type="checkbox" class="form-check-input permissionCheckBox" name='permission[]' {{(null !== old('permission') && in_array($permissions[$i]->name,old('permission'))?"checked":"")}} value="{{$permissions[$i]->name}}" id="__BVID__675">
                                                                        <label class="custom-control-label" for="__BVID__675"></label>
                                                                    </div>
                                                                </td>
                                                            @endfor
                                                        </tr>


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

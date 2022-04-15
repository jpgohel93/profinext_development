@extends('layout')
@section("page-title","Trade holding - Trader")
@section("tradeHolding","active")
@section("trade_management.accordion","hover show")
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
                    <div class="toolbar" id="kt_toolbar">
						<!--begin::Container-->
						<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
							<!--begin::Page title-->
							<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
								<!--begin::Title-->
								<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Trader</h1>
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
									<li class="breadcrumb-item text-dark">trades</li>
									<!--end::Item-->
								</ul>
								<!--end::Breadcrumb-->
							</div>
							<!--end::Page title-->
						</div>
						<!--end::Container-->
					</div>
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body pt-5">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                            <thead>
                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                    <th>Sr No.</th>
                                                    <th>Script name</th>
                                                    <th>Avg</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold" id="squareOffTable"></tbody>
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
                <!--end::Content-->
                <!--begin::Footer-->
                @include("footer")
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
        <!-- Modal -->
    <div class="modal fade" id="squareOffModel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="" class="form" method="POST" action="{{route('squareOffForm')}}">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bolder">Square off: <span id="squareOffTitle"></span></h2>
                        <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    <div id="editIdContainer"></div>
                    <!--begin::Modal body-->
                    <div class="modal-body mx-md-10">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Price</label>
                            <div class="col-9">
                                <input class="form-control" type="text" value="{{old('price')}}" name="price"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Quantity</label>
                            <div class="col-9">
                                <input class="form-control" type="text" value="{{old('qty')}}" name="qty"/>
                            </div>
                        </div>
                    </div>
                    <!--end::Modal body-->
                    <div class="modal-footer text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" class="btn btn-primary">Sell</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    
    <!--end::Modal - View Client Details-->
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $.ajax('{{route("squareOffDemat",$demat_id)}}',{
                    type:"GET"
                })
                .done(data => {
                    let html = ``;
                    let index = 1;
                    $.each(data["script_name"],function(i,v){
                        html+=`
                            <tr>
                                <td>${++i}</td>
                                <td>${v}</td>
                                <td>${(data["entry_price"][v]).toFixed(2)}</td>
                                <td>${(data["qty"][v])}</td>
                                <td>${((data["total"][v]))}</td>
                                <td>
                                    <a href="javascript:void(0)" class='squareOffModal' data-id='${v}' data-analyst_id='${data["analyst"][v]}'>
                                        Square off
                                    </a>
                                </td>
                            </tr>
                        `;
                    })
                    $("#squareOffTable").html(html);
                    $(".datatable").dataTable();
                })
                $(document).on("click",".squareOffModal",function(e){
                    const id = e.target.getAttribute("data-id");
                    const analyst_id = e.target.getAttribute("data-analyst_id");
                    if(id){
                        $("#squareOffTitle").text(id);
                        $("#editIdContainer").html(`<input type='hidden' name='trade' value='${id}' /><input type='hidden' name='demat_id' value='{{$demat_id}}' /><input type='hidden' name='analyst_id' value='${analyst_id}' />`);
                        $("#squareOffModel").modal("show");
                    }else{
                        window.alert("Unable to load this trade");
                    }
                })
            },jQuery)
        })
    </script>
@endsection
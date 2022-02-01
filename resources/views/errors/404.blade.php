@extends('layout')
@section("page-title","404")
@section("clients","active")
@section("content")
	<!--begin::Body-->	
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - 404 Page-->
			<div class="d-flex flex-column flex-center flex-column-fluid p-10">
				<!--begin::Illustration-->
				<img src="{{asset('assets/media/illustrations/sketchy-1/18.png')}}" alt="" class="mw-100 mb-10 h-lg-450px" />
				<!--end::Illustration-->
				<!--begin::Message-->
				<h1 class="fw-bold mb-10" style="color: #A3A3C7">Seems there is nothing here</h1>
				<!--end::Message-->
				<!--begin::Link-->
				<a href="{{route('dashboard')}}" class="btn btn-primary">Return Home</a>
				<!--end::Link-->
			</div>
			<!--end::Authentication - 404 Page-->
    </div>
@endsection
<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
		<title>@yield("page-title") | Profinext</title>
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="profinext/dist/assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->


		<style>
			.form-check.form-check-solid .form-check-input {
				background-color: #c1c1c1 !important;
			}
			.form-check.form-check-solid .form-check-input:checked {
				background-color: #009ef7 !important;
			}
		</style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
<body id="kt_body" class="bg-body">

    @yield("content")
    
    <!--end::Scrolltop-->
    <!--end::Main-->
    <script>var hostUrl = "{{asset('assets/')}}";</script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
	@yield("jscript")
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    {{-- <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script> --}}
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    {{-- <script src="{{asset('assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
    <script src="{{asset('assets/js/custom/apps/user-management/users/list/add.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/js/custom/widgets.js')}}"></script>
    <script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{asset('assets/js/custom/modals/create-app.js')}}"></script>
    <script src="{{asset('assets/js/custom/documentation/search.js')}}"></script> --}}
    <!-- <script src="E:/xampp/htdocs/smart_trader/profinext/dist/assets/js/custom/apps/user-management/users/list/export-users.js"></script> -->
    <script src="{{asset('js/main.js')}}" defer></script>
</body>
</html>
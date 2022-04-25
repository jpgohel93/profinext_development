@extends('layout')
@section("page-title","Financial Status - Finance Management")
@section("finance_management.financialStatus","active")
@section("finance_management.accordion","hover show")
@section("content")

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
                    <!--begin::Toolbar-->
                    <div class="toolbar" id="kt_toolbar">
                        <!--begin::Container-->
                        <div id="kt_toolbar_container" class="container-fluid mx-7 d-flex flex-stack">
                            <!--begin::Page title-->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Financial status</h1>
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
                                    <li class="breadcrumb-item text-dark">Finance Management</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin:::Tabs-->
                            <ul class="mx-9 nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8 bg-light navpad">

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1 active" data-bs-toggle="tab"
                                       href="#formTab">Firm</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#bankTab">Bank</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#usersTab">User</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#servicesTab">Service</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-1" data-bs-toggle="tab"
                                       href="#balanceTab">Balance</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="formTab" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Firm Name</th>
                                                            <th class="min-w-75px">Income</th>
                                                            <th class="min-w-75px">Expense</th>
                                                            <th class="min-w-75px">Demat</th>
                                                            <th class="min-w-75px">Users</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        @if (isset($firmTab))
                                                            <tr>
                                                                <td>Smart trader</td>
                                                                <td>{{$firmTab['st']['income']}}</td>
                                                                <td>{{$firmTab['st']['expense']}}</td>
                                                                <td>{{$firmTab['st']['clients']}}</td>
                                                                <td>{{$firmTab['st']['users']}}</td>
                                                                <td>
                                                                    <a href="{{route('viewMoreSt')}}" target="_blank">
                                                                        <i class="fas fa-eye fa-xl"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Profinext</td>
                                                                <td>{{$firmTab['sg']['income']}}</td>
                                                                <td>{{$firmTab['sg']['expense']}}</td>
                                                                <td>{{$firmTab['sg']['clients']}}</td>
                                                                <td>{{$firmTab['sg']['users']}}</td>
                                                                <td>
                                                                    <a href="{{route('viewMoreSg')}}" target="_blank">
                                                                        <i class="fas fa-eye fa-xl"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
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
                                <div class="tab-pane fade show" id="bankTab" aria-labelledby="active-tab"
                                     role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Bank Type</th>
                                                            <th class="min-w-75px">Total</th>
                                                            <th class="min-w-75px">Available Balance</th>
                                                            <th class="min-w-75px">Reserve Balance</th>
                                                            <th class="min-w-75px">Firm`s Balance</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        <tr>
                                                            <td>Income</td>
                                                            <td>{{$banksTab['income']+0}}</td>
                                                            <td>{{$banksTab['income']}}</td>
                                                            <td>{{$reserveBalance['income']}}</td>
                                                            <td>{{$firmTab['st']['income'].','.$firmTab['sg']['income']}}</td>
                                                            <td>
                                                                <a href="{{route('viewMoreIncome')}}">
                                                                    <i class="fas fa-eye fa-lg"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Salary</td>
                                                            <td>{{$banksTab['salary']+0}}</td>
                                                            <td>{{$banksTab['salary']}}</td>
                                                            <td>{{$reserveBalance['salary']}}</td>
                                                            <td>{{$banksTab['st']['salary'].','.$banksTab['sg']['salary']}}</td>
                                                            <td>
                                                                <a href="{{route('viewMoreSalary')}}">
                                                                    <i class="fas fa-eye fa-lg"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cash</td>
                                                            <td>{{$banksTab['cash']}}</td>
                                                            <td>{{$banksTab['cash']}}</td>
                                                            <td>0</td>
                                                            <td>{{$banksTab['st']['cash'].','.$banksTab['sg']['cash']}}</td>
                                                            <td>
                                                                <a href="{{route('viewMoreCash')}}">
                                                                    <i class="fas fa-eye fa-lg"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <div class="tab-pane fade show" id="usersTab" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="usersTable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-10px">Sr. No</th>
                                                            <th class="min-w-75px">User Name</th>
                                                            <th class="min-w-75px">User Type</th>
                                                            <th class="min-w-75px">Earning</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        {{-- @forelse($usersTab as $user)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$user->name}}</td>
                                                                <td>{{Config::get("constants.USERS_TYPE")[$user->user_type]}}</td>
                                                                <td>0</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-eye fa-lg" data-id="{{$user->id}}"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @empty

                                                        @endforelse --}}
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
                                <div class="tab-pane fade show" id="servicesTab" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-75px">Service Type</th>
                                                            <th class="min-w-75px">Clients</th>
                                                            <th class="min-w-75px">Revenue</th>
                                                            <th class="min-w-75px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        @if (isset($servicesTab))
                                                            <tr>
                                                                <td>Prime</td>
                                                                <td>{{$servicesTab['prime']}}</td>
                                                                <td>0</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-eye fa-lg"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>AMS</td>
                                                                <td>{{$servicesTab['ams']}}</td>
                                                                <td>0</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-eye fa-lg"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Prime Next</td>
                                                                <td>{{$servicesTab['prime_next']}}</td>
                                                                <td>0</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-eye fa-lg"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mutual Fund</td>
                                                                <td>{{$servicesTab['mutual_fund']}}</td>
                                                                <td>0</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-eye fa-lg"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Unlisted shares</td>
                                                                <td>{{$servicesTab['unlisted_shares']}}</td>
                                                                <td>0</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-eye fa-lg"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Insurance</td>
                                                                <td>{{$servicesTab['insurance']}}</td>
                                                                <td>0</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fas fa-eye fa-lg"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
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
                                <div class="tab-pane fade show" id="balanceTab" aria-labelledby="active-tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 datatable">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-75px">Sr. No</th>
                                                            <th class="min-w-75px">Particular</th>
                                                            <th class="min-w-75px">Balance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold">
                                                        <tr>
                                                            <td>{{1}}</td>
                                                            <td>Bank</td>
                                                            <td>{{$balanceTab['bank']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{2}}</td>
                                                            <td>Cash</td>
                                                            <td>{{$balanceTab['cash']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{4}}</td>
                                                            <td>Profinext</td>
                                                            <td>{{$balanceTab['sg']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{3}}</td>
                                                            <td>Smart trader</td>
                                                            <td>{{$balanceTab['st']}}</td>
                                                        </tr>
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
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
                $(".datatable").DataTable();
                // Pipelining function for DataTables. To be used to the `ajax` option of DataTables
                $.fn.dataTable.pipeline = function ( opts ) {
                    // Configuration options
                    var conf = $.extend( {
                        pages: 5,     // number of pages to cache
                        url: '',      // script url
                        data: null,   // function or object with parameters to send to the server
                                    // matching how `ajax.data` works in DataTables
                        method: 'GET' // Ajax HTTP method
                    }, opts );

                    // Private variables for storing the cache
                    var cacheLower = -1;
                    var cacheUpper = null;
                    var cacheLastRequest = null;
                    var cacheLastJson = null;

                    return function ( request, drawCallback, settings ) {
                        var ajax          = false;
                        var requestStart  = request.start;
                        var drawStart     = request.start;
                        var requestLength = request.length;
                        var requestEnd    = requestStart + requestLength;

                        if ( settings.clearCache ) {
                            // API requested that the cache be cleared
                            ajax = true;
                            settings.clearCache = false;
                        }
                        else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
                            // outside cached data - need to make a request
                            ajax = true;
                        }
                        else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
                                JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
                                JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
                        ) {
                            // properties changed (ordering, columns, searching)
                            ajax = true;
                        }

                        // Store the request for checking next time around
                        cacheLastRequest = $.extend( true, {}, request );

                        if ( ajax ) {
                            // Need data from the server
                            if ( requestStart < cacheLower ) {
                                requestStart = requestStart - (requestLength*(conf.pages-1));

                                if ( requestStart < 0 ) {
                                    requestStart = 0;
                                }
                            }

                            cacheLower = requestStart;
                            cacheUpper = requestStart + (requestLength * conf.pages);

                            request.start = requestStart;
                            request.length = requestLength*conf.pages;

                            // Provide the same `data` options as DataTables.
                            if ( typeof conf.data === 'function' ) {
                                // As a function it is executed with the data object as an arg
                                // for manipulation. If an object is returned, it is used as the
                                // data object to submit
                                var d = conf.data( request );
                                if ( d ) {
                                    $.extend( request, d );
                                }
                            }
                            else if ( $.isPlainObject( conf.data ) ) {
                                // As an object, the data given extends the default
                                $.extend( request, conf.data );
                            }

                            return $.ajax( {
                                "type":     conf.method,
                                "url":      conf.url,
                                "data":     request,
                                "dataType": "json",
                                "cache":    false,
                                "success":  function ( json ) {
                                    cacheLastJson = $.extend(true, {}, json);

                                    if ( cacheLower != drawStart ) {
                                        json.data.splice( 0, drawStart-cacheLower );
                                    }
                                    if ( requestLength >= -1 ) {
                                        json.data.splice( requestLength, json.data.length );
                                    }

                                    drawCallback( json );
                                }
                            } );
                        }
                        else {
                            json = $.extend( true, {}, cacheLastJson );
                            json.draw = request.draw; // Update the echo for each response
                            json.data.splice( 0, requestStart-cacheLower );
                            json.data.splice( requestLength, json.data.length );

                            drawCallback(json);
                        }
                    }
                };

                // Register an API method that will empty the pipelined data, forcing an Ajax
                // fetch on the next draw (i.e. `table.clearPipeline().draw()`)
                $.fn.dataTable.Api.register( 'clearPipeline()', function () {
                    return this.iterator( 'table', function ( settings ) {
                        settings.clearCache = true;
                    } );
                } );
                //
                // DataTables initialisation
                //
                $(document).ready(function() {
                    $('#usersTable').DataTable( {
                        "processing": true,
                        "serverSide": true,
                        "ajax": $.fn.dataTable.pipeline( {
                            url: '{{route("usersTab")}}',
                            pages: 5, // number of pages to cache
                        } )
                    } );
                } );
            },jQuery)
        })
    </script>
@endsection

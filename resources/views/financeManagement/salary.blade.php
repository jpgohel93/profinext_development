@extends('layout')
@section("page-title","Salary - Finance Management")
@section("finance_management.accounting","active")
@section("finance_management.accordion","hover show")
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
                    <div class="row">
                        <div class="container">
                            <div class="row my-3">
                                <div class="col-md-3">
                                    <h3>History of salaries</h3>
                                </div>
                            </div>
                            <table class="table table-striped" id="salariesTable">
                                <thead>
                                    <tr>
                                        <th scope="col">sr no</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">User name</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @can("settings-bank-details-read")
                                        @forelse ($salaries as $salary)
                                            <tr scope="row">
                                                <th>{{$loop->iteration}}</th>
                                                <td>{{$salary->date}}</td>
                                                <td>{{$salary->name}}</td>
                                                <td>{{$salary->amount}}</td>
                                            </tr>
                                        @empty

                                        @endforelse
                                    @endcan --}}
                                </tbody>
                            </table>
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
    <script>
        window.addEventListener("DOMContentLoaded",function(){
            $(()=>{
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
                    $('#salariesTable').DataTable( {
                        "processing": true,
                        "serverSide": true,
                        "ajax": $.fn.dataTable.pipeline( {
                            url: '{{route("financeManagementSalary")}}',
                            pages: 5, // number of pages to cache
                        } )
                    } );
                } );
            },jQuery)
        })
    </script>
@endsection

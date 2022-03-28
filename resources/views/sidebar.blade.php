<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{url("/")}}" >
            <span>
            <div style="float: left;"><img alt="Logo" src="{{asset("assets/media/logo_image.png")}}" class="h-25px logo"/></div>
            <small style="color: #FFFFFF; font-size: large; margin-left: 5px; ">ProfiNext</small>
            </span>
        </a>


        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
                    <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a class="menu-link @yield('dashboard')" href="{{route('dashboard')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
{{--                <div class="menu-item">--}}
{{--                    <a class="menu-link @yield('clients')" href="{{route('clients')}}">--}}
{{--                        <span class="menu-icon">--}}
{{--                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->--}}
{{--                            <span class="svg-icon svg-icon-2">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"></path>--}}
{{--                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"></rect>--}}
{{--                                </svg>--}}
{{--                            </span>--}}
{{--                            <!--end::Svg Icon-->--}}
{{--                        </span>--}}
{{--                        <span class="menu-title">Client</span>--}}
{{--                    </a>--}}
{{--                </div>--}}

                @canany(["user-read","role-read"])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion @yield('user_management.accordion')">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-solid fa-users"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">User Management</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            @can("user-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('users')" href="{{route('users')}}">
                                        <span class="menu-bullet">
                                            <i class="fa fa-solid fa-user"></i>
                                        </span>
                                        <span class="menu-title">Users</span>
                                    </a>
                                </div>
                            @endcan
                            @can("role-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('roles')" href="{{route('roles')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-sparkles"></i>
                                        </span>
                                        <span class="menu-title">Roles</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endcan

                @canany(["client-read","client-demat-read"])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion @yield('client_management.accordion')">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-solid fa-people-pants-simple"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Client Management</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            @can("client-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('clientsData.clients')" href="{{route('clients')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-person"></i>
                                        </span>
                                        <span class="menu-title">Client</span>
                                    </a>
                                </div>
                            @endcan
                            @can("client-demat-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('clientsData.clients.demat')" href="{{route('clientDematAccount')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-file-user"></i>
                                        </span>
                                        <span class="menu-title">Demat Accounts</span>
                                    </a>
                                </div>
                            @endcan
                            @can("client-demat-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('clientsData.clients.demat')" href="{{route('clientDematAccount')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-file-lines"></i>
                                        </span>
                                        <span class="menu-title">Client Status</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endcan
                @canany(["reelancer-data-read","freelancer-read","channelpartner-data-read","channelpartner-read"])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion @yield('partner_management.accordion')">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-solid fa-handshake"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Partner Management</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            @can("freelancer-data-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('freelancer')" href="{{route('freelancerData')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-hat-cowboy"></i>
                                        </span>
                                        <span class="menu-title">Freelancer Data</span>
                                    </a>
                                </div>
                            @endcan

                            @can("freelancer-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('freelancer_user')" href="{{route('freelancerUserData')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-user-cowboy"></i>
                                        </span>
                                        <span class="menu-title">Freelancer</span>
                                    </a>
                                </div>
                            @endcan

                            @can("channelpartner-data-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('channelPartner')" href="{{route('channelPartnerData')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-handshake-angle"></i>
                                        </span>
                                        <span class="menu-title">Channel Partner Data</span>
                                    </a>
                                </div>
                            @endcan

                            @can("channelpartner-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('channelPartnerClient')" href="{{route('channelPartnerUserData')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-handshake-simple"></i>
                                        </span>
                                        <span class="menu-title">Channel Partner</span>
                                    </a>
                                </div>
                            @endcan

                        </div>
                    </div>
                @endcan

                @canany(["analyst-read","monitor-data-read","report-read"])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion @yield('analyst_management.accordion')">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-regular fa-face-thinking"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Analyst Management</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            @can("analyst-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('analyst.analyst')" href="{{route('analysts')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-person-seat"></i>
                                        </span>
                                        <span class="menu-title">Analyst</span>
                                    </a>
                                </div>
                            @endcan
                            @can("user-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('analyst.monitorData')" href="{{route('viewMonitor')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-arrows-down-to-people"></i>
                                        </span>
                                        <span class="menu-title">Monitor Data</span>
                                    </a>
                                </div>
                            @endcan
                            @can("report-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('analyst.report')" href="{{route('report')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-file-chart-column"></i>
                                        </span>
                                        <span class="menu-title">Report</span>
                                    </a>
                                </div>
                            @endcan
                            @can("monitor-read")
                                <div class="menu-item">
                                <a class="menu-link @yield('analysis.monitor')" href="{{route('viewMonitorData')}}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                        <span class="svg-icon svg-icon-2">
                                           <i class="fas fa-solid fa-eyes"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Monitor</span>
                                </a>
                            </div>
                            @endcan
                        </div>
                    </div>
                @endcan

                @canany(["role-read","setup-read","trader-data-read"])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion @yield('trade_management.accordion')">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-solid fa-right-left"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Trade Management</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            @can("role-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('roles')" href="{{route('roles')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-hand-holding"></i>
                                        </span>
                                        <span class="menu-title">Trade Hold</span>
                                    </a>
                                </div>
                            @endcan
                            @can("setup-read")
                                <div class="menu-item">
                                     <a class="menu-link @yield('setup')" href="{{route('setup')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-brain-arrow-curved-right"></i>
                                        </span>
                                        <span class="menu-title">Setup</span>
                                    </a>
                                </div>
                            @endcan
                            @can("trader-data-read")
                                <div class="menu-item">
                                     <a class="menu-link @yield('trader')" href="{{route('viewTraderList')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-person-walking-arrow-right"></i>
                                        </span>
                                        <span class="menu-title">Trader Data</span>
                                    </a>
                                </div>
                            @endcan
                            @can("trader-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('traders')" href="{{route('viewTraderAccounts')}}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="fas fa-solid fa-person-digging"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">Trader</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endcan

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion @yield('finance_management.accordion')">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                            <span class="svg-icon svg-icon-2">
                                <i class="fas fa-solid fa-indian-rupee-sign"></i>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Finance Management</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link @yield('finance_management.renewal_status')" href="{{route('renewal_status')}}">
                                <span class="menu-bullet">
                                    <i class="fas fa-solid fa-money-check-dollar-pen"></i>
                                </span>
                                <span class="menu-title">Revenue Status</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('finance_management.accounting')" href="{{route('viewClientsProfession')}}">
                                <span class="menu-bullet">
                                    <i class="fas fa-solid fa-arrows-turn-to-dots"></i>
                                </span>
                                <span class="menu-title">Accounting</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('finance_management.bank')" href="{{route('financeManagementBank')}}">
                                <span class="menu-bullet">
                                    <i class="fas fa-solid fa-building-columns"></i>
                                </span>
                                <span class="menu-title">Bank</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('finance_management.payout')" href="{{route('viewClientsBroker')}}">
                                <span class="menu-bullet">
                                    <i class="fas fa-solid fa-scale-unbalanced"></i>
                                </span>
                                <span class="menu-title">Financial Status</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('finance_management.report')" href="{{route('viewClientsBanks')}}">
                                <span class="menu-bullet">
                                    <i class="fas fa-solid fa-chart-simple"></i>
                                </span>
                                <span class="menu-title">Report</span>
                            </a>
                        </div>
                    </div>
                </div>

                @canany(["blogAdmin-read","blog-read"])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion @yield('blog_management.accordion')">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-solid fa-pen-swirl"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Blog Management</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            @can("blogAdmin-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('blog_management.admin')" href="{{route('blogAdmin')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-user-group"></i>
                                        </span>
                                        <span class="menu-title">Blog Data</span>
                                    </a>
                                </div>
                            @endcan
                            @can("blog-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('blog_management.user')" href="{{route('blogUser')}}">
                                        <span class="menu-bullet">
                                            <i class="fas fa-solid fa-block-quote"></i>
                                        </span>
                                        <span class="menu-title">Blog</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endcan

{{--                <div class="menu-item">--}}
{{--                    <a class="menu-link @yield('analyst')" href="{{route('analysts')}}">--}}
{{--                        <span class="menu-icon">--}}
{{--                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->--}}
{{--                            <span class="svg-icon svg-icon-2">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"></path>--}}
{{--                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"></rect>--}}
{{--                                </svg>--}}
{{--                            </span>--}}
{{--                            <!--end::Svg Icon-->--}}
{{--                        </span>--}}
{{--                        <span class="menu-title">Analysis</span>--}}
{{--                    </a>--}}
{{--                </div>--}}

                
                @can("businessManagement-read")
                    <div class="menu-item">
                        <a class="menu-link @yield('business_management')" href="{{route('business_management')}}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-solid fa-user-crown"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Business Management</span>
                        </a>
                    </div>
                @endcan

                @can("keyword-read")
                    <div class="menu-item">
                        <a class="menu-link @yield('keyword')" href="{{route('keywordData')}}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-solid fa-list"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Keyword</span>
                        </a>
                    </div>
                @endcan

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion @yield('settings_management.accordion')">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                            <span class="svg-icon svg-icon-2">
                                <i class="fas fa-solid fa-gear"></i>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Settings</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link @yield('settings_management.users.account_type')" href="{{route('viewUsersAccountType')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Users Account Type</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('settings_management.clients.profession')" href="{{route('viewClientsProfession')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Client Profession</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('settings_management.clients.broker')" href="{{route('viewClientsBroker')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Client Broker</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('settings_management.clients.bank_details')" href="{{route('viewClientsBanks')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">bank details</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('settings_management.clients.services_type')" href="{{route('viewClientsServicesType')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Service Type</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- @can("trader-read")
                <div class="menu-item">
                    <a class="menu-link @yield('traders')" href="{{route('viewTraderAccounts')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"></path>
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Trader</span>
                    </a>
                </div>
                @endcan

                @can("blog-read")
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion @yield('blogTab')">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Blog</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">


                    </div>
                </div>
                @endcan



                @canany(["trader-data-read","calls-read","setup-read"])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion @yield('trading')">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
                                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Trading</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            @can("calls-read")
                                <div class="menu-item">
                                    <a class="menu-link @yield('calls')" href="{{route('calls')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Trade</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endcan --}}
                <!--div class="menu-item">
                    <a class="menu-link @yield('trader')" href="{{route('viewTrader')}}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"></path>
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"></rect>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Trader</span>
                    </a>
                </div-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->

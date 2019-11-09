{{--<div id="m_aside_left" class="m-grid__item    m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
         data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow m_sticky">
            <li id="dashboard_link" class="m-menu__item" aria-haspopup="true">
                <a href="{{ url('/dashboard') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-dashboard"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            Dashboard
                        </span>
                    </span>
                </span>
                </a>
            </li>
            <li id="account_link" class="m-menu__item" aria-haspopup="true">
                <a href="{{ url('/admin/accounts') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-suitcase"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            Kunden
                        </span>
                    </span>
                </span>
                </a>
            </li>
            <li id="contact_link" class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"
                data-menu-submenu-toggle="hover">
                <a href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">
                        Kundenkontakte und Kandidaten
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <a href="#" class="m-menu__link ">
                                <span class="m-menu__link-text">
                                    Kundenkontakte und Kandidaten
                                </span>
                            </a>
                        </li>
                        <li id="manager_link" class="m-menu__item " aria-haspopup="true">
                            <a href="{{ url('/admin/contacts') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-users"></i>
                                <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">
                                        Managers
                                    </span>
                                </span>
                            </span>
                            </a>
                        </li>
                        @can('freelancers-list')
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="{{ url('/admin/freelancers') }}" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-user"></i>
                                    <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">
                                        Freelancers
                                    </span>
                                </span>
                            </span>
                                </a>
                            </li>
                        @endcan
                        @can('candidates-list')
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="{{ url('/admin/kandidaten') }}" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-user"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">Festanstellung</span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
            <li id="opportunity_link" class="m-menu__item" aria-haspopup="true">
                <a href="{{ url('/admin/opportunity') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">Projektanfragen und Jobs</span>
                        </span>
                    </span>
                </a>
            </li>
            @can('employees-list')
                <li id="employee_link" class="m-menu__item" aria-haspopup="true">
                    <a href="{{ url('/admin/employees') }}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-users"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">Employees</span>
                            </span>
                        </span>
                    </a>
                </li>
            @endcan
            <li id="task_link" class="m-menu__item" aria-haspopup="true">
                <a href="{{ url('/admin/tasks') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-1"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">Tasks</span>
                        </span>
                    </span>
                </a>
            </li>
            @can('documents-list')
                <li id="document_link" class="m-menu__item" aria-haspopup="true">
                    <a href="{{ url('/admin/documents') }}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-file"></i>
                        <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            Documents
                        </span>
                    </span>
                </span>
                    </a>
                </li>
            @endcan
            <li id="admin_account_link" class="m-menu__item" aria-haspopup="true">
                <a href="{{ url('/admin/ad_accounts') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-suitcase"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            Kunden not in Database
                        </span>
                    </span>
                </span>
                </a>
            </li>
            @can('upload-csv')
                <li class="m-menu__item" aria-haspopup="true">
                    <span href="" class="m-menu__link ">
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <button data-toggle="modal" data-target="#attachscv" class="btn btn-primary">
                                    <span>Upload CSV</span>
                                </button>
                            </span>
                        </span>
                    </span>
                </li>
            @endcan
            @if (Session::has('message'))
                <li class="m-menu__item" aria-haspopup="true">
                    <span href="" class="m-menu__link ">
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <div class="m-alert m-alert--outline alert alert-info alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    {{Session::get('message')}}
                            </div>
                            </span>
                        </span>
                    </span>
                </li>
            @endif
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>--}}
<!-- END: Left Aside -->
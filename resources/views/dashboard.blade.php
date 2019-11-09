<!DOCTYPE html>

<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Argon | Dashboard
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <!--begin::Page Vendors -->
    <link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Page Vendors -->
    <link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <!--end::Base Styles -->
    <link rel="shortcut icon" href="assets/app/media/img/logos/logo.png"/>
</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
    <header class="m-grid__item    m-header " data-minimize-offset="200" data-minimize-mobile-offset="200">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <!-- BEGIN: Brand -->
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="{{ url('/dashboard') }}" class="m-brand__logo-wrapper">
                                <!-- <img alt="" src="../assets/demo/default/media/img/logo/logo_default_dark.png"/> -->
                                <h1>ARGON</h1>
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                            <!-- BEGIN: Left Aside Minimize Toggle -->
                            <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block
					 ">
                                <span></span>
                            </a>
                            <!-- END -->
                            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->
                            <!-- BEGIN: Responsive Header Menu Toggler -->
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->
                            <!-- BEGIN: Topbar Toggler -->
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>
                            <!-- BEGIN: Topbar Toggler -->
                        </div>
                    </div>
                </div>
                <!-- END: Brand -->
                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                    <!-- BEGIN: Horizontal Menu -->
                    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
                            id="m_aside_header_menu_mobile_close_btn">
                        <i class="la la-close"></i>
                    </button>
                    <div id="m_header_menu"
                         class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                        </ul>
                    </div>
                    <!-- END: Horizontal Menu -->                                <!-- BEGIN: Topbar -->
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">
                                <li class="
	m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light"
                                    data-dropdown-toggle="click" data-dropdown-persistent="true" id="m_quicksearch"
                                    data-search-type="dropdown">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon">
													<i class="flaticon-search-1"></i>
												</span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                        <div class="m-dropdown__inner ">
                                            <div class="m-dropdown__header">
                                                <form class="m-list-search__form">
                                                    <div class="m-list-search__form-wrapper">
																<span class="m-list-search__form-input-wrapper">
																	<input id="m_quicksearch_input1" autocomplete="off"
                                                                           type="text" name="q"
                                                                           class="m-list-search__form-input" value="{{request('q')}}"
                                                                           placeholder="Search...">
																</span>
                                                        <span class="m-list-search__form-icon-close"
                                                              id="m_quicksearch_close">
																	<i class="la la-remove"></i>
																</span>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true"
                                                     data-max-height="300" data-mobile-max-height="200">
                                                    <div class="m-dropdown__content1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                    data-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													@if (Session::get('profile_img'))
                                                        <img src="storage/app/Users/profile/{{ Session::get('profile_img')}}"
                                                             class="m--img-rounded m--marginless m--img-centered"
                                                             alt=""/>
                                                    @else
                                                        <img src="assets/app/media/img/users/user4.jpg"
                                                             class="m--img-rounded m--marginless m--img-centered"
                                                             alt=""/>
                                                    @endif
													
												</span>
                                        <span class="m-topbar__username m--hide">
													Nick
												</span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center"
                                                 style="background: url(assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                                <div class="m-card-user m-card-user--skin-dark">
                                                    <div class="m-card-user__pic">
                                                        @if (Session::get('profile_img'))
                                                            <img src="storage/app/Users/profile/{{ Session::get('profile_img')}}"
                                                                 class="m--img-rounded m--marginless m--img-centered"
                                                                 alt=""/>
                                                        @else
                                                            <img src="./assets/app/media/img/users/user4.jpg"
                                                                 class="m--img-rounded m--marginless" alt=""/>
                                                        @endif

                                                    </div>
                                                    <div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	{{ Session::get('name') }}
																</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--skin-light">
                                                        <li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">
																		Section
																	</span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a data-toggle="modal" data-target="#changeProfile"
                                                               class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                <span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																			<span class="m-nav__link-text">
																				Change Profile Picture
																			</span>
																			</span>
																		</span>
                                                            </a>
                                                        </li>

                                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                                        <li>
                                                            <a class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder"
                                                               href="{{ route('logout') }}"
                                                               onclick="event.preventDefault();
						                                                     document.getElementById('logout-form').submit();">
                                                                Logout
                                                            </a>

                                                            <form id="logout-form" action="{{ route('logout') }}"
                                                                  method="POST" style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- <li id="m_quick_sidebar_toggle" title="comments" class="m-nav__item">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
                                        <span class="m-nav__link-icon">
                                            <i class="flaticon-comment"></i>
                                        </span>
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    <!-- END: Topbar -->
                </div>
            </div>
        </div>
    </header>
    <!-- END: Header -->
    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
            <i class="la la-close"></i>
        </button>
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            <!-- BEGIN: Aside Menu -->
            <div
                    id="m_ver_menu"
                    class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
                    data-menu-vertical="true"
                    data-menu-scrollable="false" data-menu-dropdown-timeout="500"
            >
                <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow m_sticky">
                    <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
                        <a href="" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-dashboard  link-icon-active"></i>
                            <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Dashboard
											</span>
										</span>
									</span>
                        </a>
                    </li>
                    <li class="m-menu__item" aria-haspopup="true">
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
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"
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
                                <li class="m-menu__item " aria-haspopup="true">
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
                                @if(Auth::user()->user_role!=1)
                                    @php $freelancer_role = explode(',', $permission->kandidaten_permission); if(in_array('all', $freelancer_role)){ @endphp
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
                                    @php } @endphp
                                @endif
                                @if(Auth::user()->user_role==1)
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
                                @endif
                                @if(Auth::user()->user_role==1)
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="{{ url('/admin/kandidaten') }}" class="m-menu__link ">
                                            <i class="m-menu__link-icon flaticon-user"></i>
                                            <span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Festanstellung
														</span>
													</span>
												</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="{{ url('/admin/opportunity') }}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                            <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Projektanfragen und Jobs
											</span>
										</span>
									</span>
                        </a>
                    </li>
                    @if(Auth::user()->user_role==1)
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{ url('/admin/employees') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-users"></i>
                                <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Employess
											</span>
										</span>
									</span>
                            </a>
                        </li>
                    @endif
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="{{ url('/admin/tasks') }}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-list-1"></i>
                            <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Tasks	
											</span>
										</span>
									</span>
                        </a>
                    </li>
                    @if(Auth::user()->user_role==1)
                        <li class="m-menu__item" aria-haspopup="true">
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
                    @endif
                    <li class="m-menu__item" aria-haspopup="true">
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
                    @if(Auth::user()->user_role==1)
                        <li class="m-menu__item" aria-haspopup="true">
								<span href="" class="m-menu__link ">
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<button data-toggle="modal" data-target="#attachscv"
                                                    class="btn btn-primary">
                							<span>Upload CSV</span>
                							</button>
										</span>
									</span>
								</span>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
								<span href="" class="m-menu__link ">
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<a href="Backup_Database/backup.php" class="btn btn-danger">
											<span>Backup</span>
											</a>
										</span>
									</span>
								</span>
                        </li>
                    @endif
                    @if (Session::has('message'))
                        <li class="m-menu__item" aria-haspopup="true">
								<span href="" class="m-menu__link ">
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<div class="m-alert m-alert--outline alert alert-info alert-dismissible fade show"
                                                 role="alert">
											<button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close"></button>
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
        </div>
        <!-- END: Left Aside -->

        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <div class="m-content">
                <div class="row">
                    @if (session('image_error'))
                        <div class="col-xl-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                 style="display: block; padding: 10px; margin:27px;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <p class="message">
                                    {{session('image_error')}}
                                </p>
                            </div>
                        </div>@endif
                    @if (session('image_success'))
                        <div class="col-xl-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                 style="display: block; padding: 10px; margin:27px;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <p class="message">
                                    {{session('image_success')}}
                                </p>
                            </div>
                        </div>@endif
                    <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__body">
                                <!--begin: Search Form -->
                                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                    <div class="row align-items-center">
                                        <div class="col-xl-8 order-2 order-xl-1">
                                            <div class="form-group m-form__group row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__label">
                                                            <label>
                                                                Tasks:
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control">
                                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid"
                                                                    id="m_form_status">
                                                                <option value="">
                                                                    All Tasks
                                                                </option>
                                                                <option value="1">
                                                                    My Tasks
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="m-input-icon m-input-icon--left">
                                                        <input type="text" class="form-control m-input m-input--solid"
                                                               placeholder="Search..." id="generalSearch">
                                                        <span class="m-input-icon__icon m-input-icon__icon--left">
															<span>
																<i class="la la-search"></i>
															</span>
														</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Search Form -->
                                <!--begin: Datatable -->
                                <div class="loader_msg" style='display: block;'>
                                    <img src="assets/app/media/img/logos/loader.gif" width='132px' height='132px'
                                         style="height: 70px;width: 67px;margin-left: 40%;">
                                </div>
                                <div class="m_datatable" id="local_data"></div>
                                <!--end: Datatable -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Information and To Do List
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            @php if(!empty($comment)){$comments = $comment->comments;}else{$comments ='';}@endphp
                            <div class="m-portlet__body">
                                <div class="widget_content">
                                    <label for="comment_area">
                                        Comment :
                                    </label>
                                    <textarea class="form-control" id="comment_text" name="comment_text"
                                              rows=5>{{$comments}}</textarea>

                                </div>
                                <!-- <div class="form-group">
                                      <button type="button" class="btn btn-success" id="LeaveComment">Submit</button>
                                      <button type="button" class="btn btn-default" id="CancelComment">Cancel</button>
                                </div> -->
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-8">
                        <!--begin::Portlet-->
                        <div class="m-portlet" id="m_portlet">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon">
													<i class="flaticon-calendar-2"></i>
												</span>
                                        <h3 class="m-portlet__head-text">
                                            Calendar Events
                                        </h3>
                                        <a class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air"
                                           data-toggle="modal" data-target="#view_events_modal" style="    width: 147px;
    													margin-top: 14px;"> 
														<span>
															<i class="flaticon-list"></i>
															<span>
																View Events
															</span>
														</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <ul class="m-portlet__nav">
                                        <li class="m-portlet__nav-item">
                                            <a class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air"
                                               data-toggle="modal" data-target="#event_modal">
														<span>
															<i class="la la-plus"></i>
															<span>
																Add Event
															</span>
														</span>
                                            </a>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div id="m_calendar"></div>
                            </div>
                        </div>
                        <!--end::Portlet-->
                    </div>
                    <div class="col-xl-12">
                        <div class="m-portlet ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            @if(Auth::user()->user_role!=1) {{'Set Goal By Admin'}} @else {{'Admin Goal'}} @endif
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body  m-portlet__body--no-padding">
                                <div class="row m-row--no-padding m-row--col-separator-xl">
                                    <div class="col-md-12 col-lg-6 col-xl-3">
                                        <div class="m-widget24">
                                            <div class="m-widget24__item">

                                                <!-- <h4 class="m-widget24__title">
                                                   Client Activities Added
                                               </h4> -->
                                                <input type="hidden" id="auth_id" value="{{Auth::id()}}">
                                                <input type="text" min="1" max="3" name="client_activity"
                                                       id="client_activity"
                                                       class="client_activity form-control m-input m-widget24__title"
                                                       placeholder="Client Activity Goal"
                                                       style="width: 86%;" @if(Auth::user()->user_role!=1) {{'disabled'}} @endif>
                                                <div class="m--space-10"></div>
                                                <div class="m--space-10"></div>
                                                <div class="client_activities" id="client_activities"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 col-xl-3">
                                        <div class="m-widget24">
                                            <div class="m-widget24__item">
                                                <!-- <h4 class="m-widget24__title">
                                                    Clients Added
                                                </h4> -->
                                                <input type="text" min="1" max="3" name="client_add" id="client_add"
                                                       class="form-control m-input m-widget24__title client_add"
                                                       placeholder="Client Added Goal"
                                                       style="width: 86%;" @if(Auth::user()->user_role!=1) {{'disabled'}} @endif>
                                                <div class="m--space-10"></div>
                                                <div class="m--space-10"></div>
                                                <div class="client_added" id="client_added"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 col-xl-3">
                                        <div class="m-widget24">
                                            <div class="m-widget24__item">
                                                <!-- <h4 class="m-widget24__title">
                                                    Candidates Added
                                                </h4> -->
                                                <input type="text" min="1" max="3" name="candidate_add"
                                                       id="candidate_add" class="candidate_add form-control m-input m-widget24__title"
                                                       placeholder="Candidates Added Goal"
                                                       style="width: 86%;" @if(Auth::user()->user_role!=1) {{'disabled'}} @endif>
                                                <div class="m--space-10"></div>
                                                <div class="m--space-10"></div>
                                                <div class="candidate_added" id="candidate_added"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 col-xl-3">
                                        <div class="m-widget24">
                                            <div class="m-widget24__item">
                                                <!-- <h4 class="m-widget24__title">
                                                    Opportunities Added
                                                </h4> -->
                                                <input type="text" name="oppo_add" id="oppo_add"
                                                       class="oppo_add form-control m-input m-widget24__title"
                                                       placeholder="Opportunity Added Goal"
                                                       style="width: 86%;" @if(Auth::user()->user_role!=1) {{'disabled'}} @endif>
                                                <div class="m--space-10"></div>
                                                <div class="m--space-10"></div>
                                                <div class="opportunity_added" id="opportunity_added"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!empty($emp_users))
                        @foreach($emp_users as $emp_users)
                            <div class="col-xl-12">
                                <div class="m-portlet ">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    {{$emp_users->first_name}} {{$emp_users->last_name}} Goal
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body  m-portlet__body--no-padding">
                                        <div class="row m-row--no-padding m-row--col-separator-xl">
                                            <div class="col-md-12 col-lg-6 col-xl-3">
                                                <div class="m-widget24">
                                                    <div class="m-widget24__item">

                                                        <!-- <h4 class="m-widget24__title">
                                                           Client Activities Added
                                                       </h4> -->
                                                        <input type="hidden" id="emp_id" value="{{$emp_users->id}}">
                                                        <input type="text" min="1" max="3"
                                                               name="client_activity{{$emp_users->id}}"
                                                               id="client_activity{{$emp_users->id}}"
                                                               class="client_activity form-control m-input m-widget24__title"
                                                               placeholder="Client Activity Goal" style="width: 86%;"
                                                               value="14"
                                                               >
                                                        <div class="m--space-10"></div>
                                                        <div class="m--space-10"></div>
                                                        <div class="client_activities" id="client_activities{{$emp_users->id}}"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6 col-xl-3">
                                                <div class="m-widget24">
                                                    <div class="m-widget24__item">
                                                        <!-- <h4 class="m-widget24__title">
                                                            Clients Added
                                                        </h4> -->
                                                        <input type="text" min="1" max="3"
                                                               name="client_add{{$emp_users->id}}"
                                                               id="client_add{{$emp_users->id}}"
                                                               class="client_add form-control m-input m-widget24__title"
                                                               placeholder="Client Added Goal" style="width: 86%;"
                                                               >
                                                        <div class="m--space-10"></div>
                                                        <div class="m--space-10"></div>
                                                        <div class="client_added" id="client_added{{$emp_users->id}}"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6 col-xl-3">
                                                <div class="m-widget24">
                                                    <div class="m-widget24__item">
                                                        <!-- <h4 class="m-widget24__title">
                                                            Candidates Added
                                                        </h4> -->
                                                        <input type="text" min="1" max="3"
                                                               name="candidate_add{{$emp_users->id}}"
                                                               id="candidate_add{{$emp_users->id}}"
                                                               class="candidate_add form-control m-input m-widget24__title"
                                                               placeholder="Candidates Added Goal" style="width: 86%;"
                                                               >
                                                        <div class="m--space-10"></div>
                                                        <div class="m--space-10"></div>
                                                        <div class="candidate_added" id="candidate_added{{$emp_users->id}}"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6 col-xl-3">
                                                <div class="m-widget24">
                                                    <div class="m-widget24__item">
                                                        <!-- <h4 class="m-widget24__title">
                                                            Opportunities Added
                                                        </h4> -->
                                                        <input type="text" name="oppo_add{{$emp_users->id}}"
                                                               id="oppo_add{{$emp_users->id}}"
                                                               class="oppo_add form-control m-input m-widget24__title"
                                                               placeholder="Opportunity Added Goal" style="width: 86%;"
                                                               >
                                                        <div class="m--space-10"></div>
                                                        <div class="m--space-10"></div>
                                                        <div class="opportunity_added" id="opportunity_added{{$emp_users->id}}"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Body -->
    <!-- begin::Footer -->
    <div id="attachscv" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 40%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">CSV upload form</h4>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form method="post" action="{{url('admin/data/csv')}}" name="upload_file" id="upload_file"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        Select file : <input type='file' name='attach_csv' id='attach_csv' class='form-control'
                                             required=""><br>
                        <span id="errormessage"></span>
                        <p style="color: red">* Download Sample File from <a href="{{url('admin/upload/exportcsv')}}"
                                                                             id="Exportcsv">here</a></p>
                        <p style="color: red">* Please Select Only CSV format</p>
                        <button class="btn btn-primary" id="upload" name="upload" type="submit">Upload</button>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <div id="changeProfile" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 40%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Profile Pic</h4>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form method="post" name="upload_pic" action="{{url('dashboard/profile/update')}}" id="upload_pic"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        Select file : <input type='file' name='attach_pic' id='attach_pic' class='form-control'
                                             required=""><br>
                        <span id="errormessage"></span>
                        <p style="color: red">* Please Select Only Png and jpg format</p>
                        <button class="btn btn-primary" id="upload_profile" name="upload_profile" type="submit">Upload
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </div>
    <div id="TaskModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 40%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="closemodal">&times;</button>
                    <h4 class="modal-title">Pending Task(s)</h4>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th>S.No</th>
                                    <th>Task Priority</th>
                                    <th>Task Status</th>
                                    <th>Task Date</th>
                                </tr>
                                <?php $i = 1; ?>
                                @foreach ($pendingtask as $task)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$task->priority}}</td>
                                        <td>{{$task->task_status}}</td>
                                        <td>{{$task->task_date}}</td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div id="view_events_modal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 40%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="closemodal">&times;</button>
                    <h4 class="modal-title">Events added In calendar</h4>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th>S.No</th>
                                    <th>Event Date</th>
                                    <th>Event Title</th>
                                    <th>Event Description</th>
                                    <th>Action</th>
                                </tr>
                                <?php $i = 1; ?>
                                @foreach ($events_view as $events_view)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$events_view->task_date}}</td>
                                        <td>{{$events_view->task_type}}</td>
                                        <td>{{$events_view->task_status}}</td>
                                        <td style="width: 10px;">
                                            <a data-id='+row.id+' class="comment_del pull-right"
                                               onclick="deleteList({{$events_view->id}})">
                                                <span><i class="fa fa-trash-o"></i></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div id="event_modal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 40%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Events</h4>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form method="post" name="event_add" id="event_add">
                        {{ csrf_field() }}
                        Event Date* : <input type='text' name='event_date' id='event_date' class='form-control'>
                        Title* : <input type='text' name='event_title' id='event_title' class='form-control'>
                        Description* : <input type='text' name='event_description' id='event_description'
                                              class='form-control'>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add_event_calendar" class="btn btn-primary">Add Event</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>

        </div>
    </div>
    <footer class="m-grid__item		m-footer ">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
                2018 &copy; @Registered
                                <!-- <a href="#" class="m-link">
                                  Keenthemes
                                </a> -->
              </span>
                </div>
            </div>
        </div>
    </footer>
    <!-- end::Footer -->
</div>
<!-- end:: Page -->
<!-- begin::Quick Sidebar -->
<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
    <div class="m-quick-sidebar__content m--hide">
        <span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
          <i class="la la-close"></i>
        </span>
        <ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand comment_div"
            role="tablist">
            <!-- Form area -->
            <li>
                <h3>Leave Comment </h3><br>
                <input type="hidden" id="auth_id" value="{{Auth::id()}}">
            </li>
            <li>
            <li>
                <label for="comment_area">
                    Comment :
                </label>
                <textarea class="form-control" id="comment_area" name="comment_area" rows=5></textarea>
            </li>
            <!-- End form area -->

        </ul>
        <div class="form-group">
            <button type="button" class="btn btn-success" id="LeaveComment">Submit</button>
            <button type="button" class="btn btn-default" id="CancelComment">Cancel</button>
        </div>
    </div>
</div>
<!-- end::Quick Sidebar -->
<!-- begin::Quick Nav -->
<!--begin::Base Scripts -->
<script src="assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="assets/demo/default/custom/components/datatables/base/dashboard_task.js" type="text/javascript"></script>
<!--end::Base Scripts -->
<!--begin::Page Vendors -->
<script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Snippets -->
<!-- <script src="assets/app/js/dashboard.js" type="text/javascript"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script src="assets/demo/default/custom/components/calendar/background-events.js" type="text/javascript"></script>
<script src="assets/app/js/script.js" type="text/javascript"></script>
<!-- <script src="{{asset('/js/gauge.min.js')}}" type="text/javascript"></script> -->
<script type="text/javascript" src="{{asset('/js/justgage.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/raphael-2.1.4.min.js')}}"></script>
<script src="assets/demo/default/custom/components/datatables/base/data_comments.js" type="text/javascript"></script>
<style type="text/css">
    .m-aside-left--minimize .m-aside-menu .m-menu__nav {
        padding: 30px 0 30px 0;
        width: 6%;
    }

    #TaskModal {
        display: none;
    }

    .comment_div li {
        width: 100% !important;
    }

    .m-quick-sidebar__content {
        padding: 61px 14px;
    }

    .gauge {
        margin-left: -20px;
    }
</style>
<script>

    $('#m_quicksearch_input1').keyup(function () {

        var qs = this;
        var query = $('#m_quicksearch_input1').val();
        if (query.length === 0) {
            console.log(query + "is empty");
            $('.m-dropdown__body').css('display', 'none');
            // $('.m-dropdown__content1').html('');
            // $('.m-dropdown__body').css('visibility', 'hidden');
        } else {
            console.log(query);
            url = 'dashboard/search';
            $.ajax({
                url: url,
                data: {
                    query: query,
                },
                dataType: 'html',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('.m-dropdown__content1').html(response);
                    $('.m-dropdown__body').css('display', 'block');
                }
            });
        }

    });

    $('#comment_text').keyup(function () {
        var text = $('#comment_text').val();
        //var account_id = $('#account_id').val();
        url = 'dashboard/updateInfo';
        $.ajax({
            url: url,
            data: {
                comment: text,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
            }
        });
        //localStorage.setItem("comment_text", text);
    });
    // var commenttext = localStorage.getItem("comment_text");
    // if(commenttext!='')
    // {
    // 	$('#comment_text').val(commenttext);
    // }
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }

    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
        }
        return "";
    }

    var cookie = getCookie('shown');
    if (!cookie) {
        showPopup();
    }

    function showPopup() {
        setCookie('shown', 'true', 365);
        document.querySelector('#TaskModal').style.display = 'block';
        $("#TaskModal").addClass('show');
    }

    $("#closemodal").click(function () {
        $("#TaskModal").removeClass('show');
        $("#TaskModal").css('display', 'none');
    })

    $('#event_date').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#add_event_calendar').click(function () {
        var event_date = $('#event_date').val().trim();
        var event_title = $('#event_title').val().trim();
        var event_description = $('#event_description').val().trim();
        if (event_date == '' || event_title == '' || event_description == '') {
            swal('Error', 'All Fields Required', 'error');
            return false;
        }
        $.ajax({
            url: 'dashboard/add_events',
            data: {event_date: event_date, event_title: event_title, event_description: event_description},
            success: function (response) {
                var res = $.parseJSON(response);
                if (res.status == 'error') {
                    swal('Error', res.message, 'error');
                } else {
                    swal('Success', res.message, 'success');
                    setTimeout(function () {
                        window.location.replace('');
                    }, 2000);
                }

            }
        });
    });

    function deleteList(id) {
        swal({
                title: "Are you sure to delete this List?",
                text: "Your will not be able to recover this List!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false,
            },
            function (isConfirm) {
                if (isConfirm) {
                    var del_id = id;
                    url = 'event/deleteList';
                    $.ajax({
                        url: url + '/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            var res = $.parseJSON(data);
                            if (res.status == 'error') {
                                swal('Error', res.message, 'error');
                            } else {
                                swal('Success', res.message, 'success');
                                setTimeout(function () {

                                    window.location.replace('');
                                }, 2000);
                            }
                        },
                        error: function (data) {
                            swal('Error', data, 'error');
                        }
                    });
                } else {

                }
            });
    }
</script>


<!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>

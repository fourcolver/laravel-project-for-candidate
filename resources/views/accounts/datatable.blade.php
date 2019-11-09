<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Version: 5.0.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			Argon | Kunden
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->  
        <!--begin::Page Vendors -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
		<link href="../assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors -->
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
		<link href="../assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="../assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="../assets/app/media/img/logos/logo.png" />
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
			<header class="m-grid__item    m-header "  data-minimize-offset="200" data-minimize-mobile-offset="200" >
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
									<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>
									<!-- END -->
							<!-- BEGIN: Responsive Header Menu Toggler -->
									<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>
									<!-- END -->
			<!-- BEGIN: Topbar Toggler -->
									<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
										<i class="flaticon-more"></i>
									</a>
									<!-- BEGIN: Topbar Toggler -->
								</div>
							</div>
						</div>
						<!-- END: Brand -->
						<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
							<!-- BEGIN: Horizontal Menu -->
							<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
								<i class="la la-close"></i>
							</button>
							<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
								<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
								</ul>
							</div>
							<!-- END: Horizontal Menu -->								<!-- BEGIN: Topbar -->
							<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-topbar__nav-wrapper">
									<ul class="m-topbar__nav m-nav m-nav--inline">
										<li class="
										m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light" 
										data-dropdown-toggle="click" data-dropdown-persistent="true" id="m_quicksearch" data-search-type="dropdown">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon">
													<i class="flaticon-search-1"></i>
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
												<div class="m-dropdown__inner ">
													<div class="m-dropdown__header">
														<form  class="m-list-search__form">
															<div class="m-list-search__form-wrapper">
																<span class="m-list-search__form-input-wrapper">
																	<input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
																</span>
																<span class="m-list-search__form-icon-close" id="m_quicksearch_close">
																	<i class="la la-remove"></i>
																</span>
															</div>
														</form>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-max-height="300" data-mobile-max-height="200">
															<div class="m-dropdown__content"></div>
														</div>
													</div>
												</div>
											</div>
										</li>
										
										<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img src="../assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt=""/>
												</span>
												<span class="m-topbar__username m--hide">
													Nick
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center" style="background: url(../assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
														<div class="m-card-user m-card-user--skin-dark">
															<div class="m-card-user__pic">
																<img src="../assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt=""/>
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
																	<a href="header/profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-profile-1"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">
																					My Profile
																				</span>
																				<span class="m-nav__link-badge">
																					<span class="m-badge m-badge--success">
																						2
																					</span>
																				</span>
																			</span>
																		</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="header/profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-share"></i>
																		<span class="m-nav__link-text">
																			Activity
																		</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="header/profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-chat-1"></i>
																		<span class="m-nav__link-text">
																			Messages
																		</span>
																	</a>
																</li>
																<li class="m-nav__separator m-nav__separator--fit"></li>
																<li class="m-nav__item">
																	<a href="header/profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-info"></i>
																		<span class="m-nav__link-text">
																			FAQ
																		</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="header/profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																		<span class="m-nav__link-text">
																			Support
																		</span>
																	</a>
																</li>
																<li class="m-nav__separator m-nav__separator--fit"></li>
																<li>
						                                        <a class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" href="{{ route('logout') }}"
						                                            onclick="event.preventDefault();
						                                                     document.getElementById('logout-form').submit();">
						                                            Logout
						                                        </a>

						                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						                                            {{ csrf_field() }}
						                                        </form>
                                    							</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li id="m_quick_sidebar_toggle" title="comments" class="m-nav__item">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon">
													<i class="flaticon-comment"></i>
												</span>
											</a>
										</li>
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
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
							<li class="m-menu__item" aria-haspopup="true" >
								<a  href="{{ url('/dashboard') }}" class="m-menu__link ">
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
							<li class="m-menu__item m-menu__item--active" aria-haspopup="true" >
								<a  href="{{ url('/admin/accounts') }}" class="m-menu__link ">
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
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-users"></i>
									<span class="m-menu__link-text">
										Kundenkontakte und Kandidaten
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
												<a  href="#" class="m-menu__link ">
													<span class="m-menu__link-text">
														Kundenkontakte und Kandidaten
													</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true" >
												<a  href="{{ url('/admin/contacts') }}" class="m-menu__link ">
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
											<li class="m-menu__item " aria-haspopup="true" >
												<a  href="{{ url('/admin/freelancers') }}" class="m-menu__link ">
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
										</ul>
									</div>
							</li>
							<li class="m-menu__item" aria-haspopup="true" >
								<a  href="{{ url('/admin/opportunity') }}" class="m-menu__link ">
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
							<li class="m-menu__item" aria-haspopup="true" >
								<a  href="{{ url('/admin/tasks') }}" class="m-menu__link ">
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
							<li class="m-menu__item" aria-haspopup="true" >
								<a  href="{{ url('/admin/documents') }}" class="m-menu__link ">
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
						</ul>
					</div>
					<!-- END: Aside Menu -->
				</div>
				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-page-title">
									Home / Kunden
								</h3>
							</div>
						</div>
					</div>
					<div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none; padding: 10px; margin:27px;">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
					<p class="message">Successfully Created</p>
					</div>
					<!-- END: Subheader -->
					<div class="m-content">
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__body">
								<!--begin: Search Form -->
								<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
									<div class="row align-items-center">
										<div class="col-xl-8 order-2 order-xl-1">
											<div class="form-group m-form__group row align-items-center">
												<div class="col-md-4">
													<div class="m-form__group m-form__group--inline">
														<div class="m-form__label">
															<label>
																Kunden:
															</label>
														</div>
														<div class="m-form__control">
															<select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_status">
																<option value="">
																	All Kunden
																</option>
																<option value="1">
																	My Kunden
																</option>
															</select>
														</div>
													</div>
													<div class="d-md-none m--margin-bottom-10"></div>
												</div>
												<div class="col-md-4" id="hotness">
													<div class="m-form__group m-form__group--inline">
														<div class="m-form__label">
															<label>
																Hotness:
															</label>
														</div>
														<div class="m-form__control">
															<select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_type">
																<option value="">
																	All Clients
																</option>
																<option value="1-3">
																	1-3
																</option>
																<option value="4-7">
																	4-7
																</option>
																<option value="8-10">
																	8-10
																</option>
															</select>
														</div>
													</div>
													<div class="d-md-none m--margin-bottom-10"></div>
												</div>
												<div class="col-md-4">
													<div class="m-input-icon m-input-icon--left">
														<input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="generalSearch">
														<span class="m-input-icon__icon m-input-icon__icon--left">
															<span>
																<i class="la la-search"></i>
															</span>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-4 order-1 order-xl-2 m--align-right">
											<a href="" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" data-toggle="modal" data-target="#addAccountsModal">
												<span>
													<i class="m-menu__link-icon flaticon-user-add"></i>
													<span>
														ADD NEW KUNDEN
													</span>
												</span>
											</a>
											<!-- <a href="" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" data-toggle="modal" data-target="#addAccountColumn">
												<span>
													<i class="m-menu__link-icon flaticon-cogwheel-2"></i>
													<span>
														COLUMNS
													</span>
												</span>
											</a> -->
											<div class="m-separator m-separator--dashed d-xl-none"></div>
										</div>
									</div>
								</div>
								<!--end: Search Form -->
								<!--begin: Datatable -->
								<div class="loader_msg" style='display: block;'>
									<img src="../assets/app/media/img/logos/loader.gif" width='132px' height='132px' style="height: 70px;width: 67px;margin-left: 40%;">
								</div>
								<div class="m_datatable" id="local_data">
								</div>

								<!--end: Datatable -->
							</div>
						</div>
					</div>
					
				</div>
			</div>
<div id="addAccountsModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
			    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
			    <h4 class="modal-title">Add Kunden</h4>
			  </div>
			  <div class="modal-body">
									<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="addAccount" name="addAccount">
					{{ csrf_field() }}
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<div class="col-lg-4">
								<label>
									Kunden Name *:
								</label>
								<input type="text" name="account_name" id="account_name" class="form-control m-input" placeholder="Enter Kunden_name Minimum 3 characters">
                                    <div class="error_msg">
                                    	<span class="account_name"></span>
                                    </div>
							</div>
							<div class="col-lg-4">
									<label for="technology">
									Prozesse of Kunden :
									</label>
									<select class="custom-select" id="prozesse" name="prozesse">
										<option value="">Please Select the Prozesse</option>
										<option value="Telefon Interview">Telefon Interview</option>
										<option value="Telefon Interview und Vor-Ort Gespräch">Telefon Interview und Vor-Ort Gespräch</option>
										<option value="Vor-Ort Gespräch">Vor-Ort Gespräch</option>
										<option value="Testaufgabe">Testaufgabe</option>
										<option value="NSI">NSI</option>
										<option value="Embedded">Embedded</option>
									</select>
									<div class="error_msg">
                                	<span class="prozesse"></span>
                            		</div>
								</div>
								<div class="col-lg-4">
									<label for="freelancers">
									No. of Freelancers :
									</label>
									<select class="custom-select" id="freelancers" name="freelancers">
										<option value="">
										Please Select Number of Freelancers</option>
										@for ($i = 1; $i <= 100; $i++)
    									<option value="{{ $i }}">{{ $i }}</option>
										@endfor
									</select>
									<div class="error_msg">
                                	<span class="freelancers"></span>
                            		</div>
								</div>
							</div>
							<div class="form-group m-form__group row">
								<div class="col-lg-4">
									<label for="Countries">
									Select Country *:
									</label>
									<select class="custom-select" name="country" id="country">
										<optgroup label="Mostly Used">
											@if(isset($countries))
										@foreach($countries as $item)
										@if($item->default_country == '1')
										<option value="{{$item->name}}" @if($item->name== 'Germany') {{ 'selected' }}@endif>{{$item->name}}</option>
										@endif
										@endforeach
										</optgroup>
										<optgroup label="Other Countries">
										@foreach($countries as $item)
										if($item->default_country != '1')
										{
										<option value="{{$item->name}}">{{$item->name}}</option>
										}
										@endforeach
										@endif
										</optgroup>
									</select>
									<div class="error_msg">
                                	<span class="country"></span>
                            		</div>
								</div>
								<div class="col-lg-4">
								<label>
									City :
								</label>
								<input type="text" name="city" id="city" class="form-control m-input" placeholder="Enter Your city">
								<div class="error_msg">
                                	<span class="city"></span>
                            	</div>
								</div>
								<div class="col-lg-4">
									<label>
										Postcode/Zip *:
									</label>
									<input type="text" name="pincode" id="pincode" class="form-control m-input" placeholder="Enter Your Post Code">
									<div class="error_msg">
                                	<span class="pincode"></span>
                            	</div>
								</div>
							</div>
							<div class="form-group m-form__group row">
								<div class="col-lg-4">
									<label for="technology">
									Technological Focus:
									</label>
									<select multiple="multiple" class="custom-select" id="Technology" name="Technology[]" style="height: 99px; width: 100%;">
										<option value="Microsoft .Net">Microsoft .Net</option>
										<option value="Java">Java</option>
										<option value="SAP">SAP</option>
										<option value="PHP">PHP</option>
										<option value="NSI">NSI</option>
										<option value="Embedded">Embedded</option>
									</select>
									<div class="error_msg">
                                	<span class="Technology"></span>
                            		</div>
								</div>
								<div class="col-lg-4">
									<label>
										Owner of Client:
									</label>
									<select class="custom-select" name="owner" id="owner">
										<option value="">
										Please Select Owner of Account</option>
										@if(isset($item))
										@foreach($users as $item)
										<option value="{{$item->id}}">{{$item->first_name}}</option>
										@endforeach
										@endif
									</select>
									<div class="error_msg">
                                	<span class="owner"></span>
                            	</div>
								</div>
								<div class="col-lg-4">
									<label>
										Note :
									</label>
									<textarea class="form-control m-input m-input--air" name="note" id="note" rows="4" placeholder="Enter Note"></textarea>
								</div>
							</div>
							<div class="form-group m-form__group row">
								
								<div class="col-lg-4">
									<label for="source">
									Select Source for Client:
									</label>
									<select class="custom-select" id="source" name="source">
										<option value="">
										Please Select Source of Client</option>
										<option value="Advertisement">Advertisement</option><option value="Email">Email</option><option value="Mailshot">Mailshot</option><option value="Pay Per Click">Pay Per Click</option><option value="Press">Press</option><option value="Referral">Referral</option><option value="Social">Social</option><option value="Telephone">Telephone</option><option value="Web Search">Web Search</option><option value="Web site">Web site</option><option value="Word of Mouth">Word of Mouth</option>
									</select>
									<div class="error_msg">
                                	<span class="source"></span>
                            		</div>
								</div>
								<!-- <div class="col-lg-4">
									<label for="sub_lable">
									Sub - Lable
									</label>
									<select multiple="multiple" class="custom-select" id="sub_lable" name="sub_lable[]" style="height: 99px; width: 100%;">
										<option value="Consultancy">Consultancy</option><option value="Delivery">Delivery</option><option value="Discount">Discount</option><option value="Fee">Fee</option><option value="Other Products">Other Products</option><option value="Other Services">Other Services</option><option value="Product">Product</option><option value="Services">Services</option><option value="Subscription">Subscription</option>
									</select>
									<div class="error_msg">
                                	<span class="sub_lable"></span>
                            	</div>
								</div> -->
								<div class="col-lg-4">
									<label for="client_specification">
									Hotness Of Client :
									</label>
									<select class="custom-select" id="client_specification" name="client_specification">
										<option value="">
										Please Select Client Specification</option>
										<option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
									</select>
									<div class="error_msg">
                                	<span class="client_specification"></span>
                            		</div>
								</div>
								<div class="col-lg-4">
									<label>
										Mobile/ Cell *:
									</label>
									<input type="text" name="telephone" id="telephone" class="form-control m-input" placeholder="Enter Your Telephone Number Only Numeric">
									<div class="error_msg">
                                	<span class="telephone"></span>
                            	</div>
								</div>
							</div>
							<div class="form-group m-form__group row">
								<!-- <div class="col-lg-2">
									<label>
										Decision Maker :
									</label>
									<label>
								    <input type="checkbox" name="decision_maker" id="decision_maker" data-toggle="toggle">

								  </label>
								</div> -->
								<div class="col-lg-4">
									<label>
										IT Department Size   :
									</label>
									<input type="text" name="departement_size" id="departement_size" class="form-control m-input" placeholder="Enter Your Departement Size">
									<div class="error_msg">
                                	<span class="departement_size"></span>
                            	</div>
								</div>
								<!-- <div class="col-lg-2">
									<label>
										Several Outcome :
									</label>
									<label>
								    <input type="checkbox" name="job_outcome" id="job_outcome" data-toggle="toggle">

								  </label>
								</div> -->
							</div>
							</div>
							<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
								<div class="m-form__actions m-form__actions--solid">
									<div class="row">
										<div class="col-lg-4"></div>
										<div class="col-lg-8">
											<button type="submit" id="m_login_signin_submit" name="m_login_signin_submit" class="btn btn-primary">
												Submit
											</button>
											<button type="reset" class="btn btn-secondary" data-dismiss="modal">
												Cancel
											</button>
										</div>
									</div>
								</div>
							</div>
						</form>
									<!--end::Form-->
			  </div>
			</div>

			</div>
</div>

			<!-- end:: Body -->
<!-- begin::Footer -->
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
						<div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
							<ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											About
										</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#"  class="m-nav__link">
										<span class="m-nav__link-text">
											Privacy
										</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											T&C
										</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											Purchase
										</span>
									</a>
								</li>
								<li class="m-nav__item m-nav__item">
									<a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
										<i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
									</a>
								</li>
							</ul>
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
        <ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand comment_div" role="tablist">
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
	    <!-- begin::Scroll Top -->
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->		    <!-- begin::Quick Nav -->
		<!-- begin::Quick Nav -->	
    	<!--begin::Base Scripts -->
		<script src="../assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="../assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Base Scripts -->   
        <!--begin::Page Vendors -->
		<script src="../assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
		<!--end::Page Vendors -->  
		<!--begin::Page Resources -->
		<!-- <script src="../assets/demo/default/custom/components/datatables/base/data-accounts.js" type="text/javascript"></script> -->
        <!--begin::Page Snippets -->
		<script src="../assets/app/js/dashboard.js" type="text/javascript"></script>
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
		<script src="../assets/app/js/script.js" type="text/javascript"></script>
		<!--end::Page Snippets -->
		<script src="../assets/demo/default/custom/components/datatables/base/data_comments.js" type="text/javascript"></script>
		<style type="text/css">
		.abbd{
			word-wrap: true;
		}
			.m-aside-left--minimize .m-aside-menu .m-menu__nav {
    			padding: 30px 0 30px 0; width: 6%; }
    		#TaskModal {
			  display:none;
			}	
			 .comment_div li{
		      width:100%!important;
		     }
		     .m-quick-sidebar__content{
		       padding: 61px 14px;
		     }
		</style>
	</body>
	<!-- end::Body -->
</html>


<script>
//== Class definition
var datatable;
(function() {
	// demo initializer
     $('#loader').css('display','none');
	var accountsdata;

	
			var edit_url = 'accounts/edit';
            var delete_url = 'accounts/delete';
			var view_url = 'accounts/view';
			datatable = $('.m_datatable').mDatatable({
			// datasource definition
			data: {
			    type: 'remote',
			    source: {
			        read: {
			            url: 'accounts/getAllAccounts',
			            method: 'GET',
			            // custom headers
			            headers: { 'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
			            params: {
			                // custom query params
			                query: {
			                    generalSearch: ''
			                }
			            },
			            map: function(raw) {
			                // sample data mapping
			                var dataSet = raw;
			                if (typeof raw.data !== 'undefined') {
			                     dataSet = raw.data;
			                }
			                return dataSet;
			            },
			        }
			    },
			    pageSize: 10,
		        saveState: {
		            cookie: true,
		            webstorage: true
		        },

		        serverPaging: false,
		        serverFiltering: false,
		        serverSorting: false
		    },
			// layout definition
			layout: {
				theme: 'default', // datatable theme
				class: '', // custom wrapper class
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				// height: 450, // datatable's body's fixed height
				footer: false // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch')
			},

			// inline and bactch editing(cooming soon)
			// editable: false,

			// columns definition
			columns: [{
				field: "id",
				title: "ID",
				textAlign: 'center',
                width: 50
			}, {
				field: "account_name",
				title: "Kunden Name",
        template: function (row) {
          var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

          return '\
                <div >\
                  <a title="View this Kunden" href="'+view_url+'/'+row.id+'">'+row.account_name+'</a>\
                </div>\
          ';
        }
			}, 
            {
                field: "client_specification",
                title: "Hotness Of Client",
                width : 150             
            },
            {
				field: "pincode",
				title: "Postcode",
                width: 70
			}, {
				field: "freelancers",
				title: "No.of Freelancers",
				width: 124
			}, {
				field: "Technology",
				title: "Technology"
			}, {
				field: "data",
				title: "Last Contact",
                width : 350,
                template: function (row) {
                    //var timestamp = '';
                    var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                    //$.each(row.data, function(brand) {
                        //alert(brand);
                       //this.timestamp =  brand.timestamp;
                    //});
                    if(row.data==null)
                    {
                            return '\
                        <div >\
                        </div>\
                        ';
                    }
                    return '\
                    <div >\
                        '+row.data['timestamp']+'\
                    </div>\
                    ';
                }

			}]
		});
})();
</script>
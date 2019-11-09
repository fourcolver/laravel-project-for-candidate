<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			Argon | Employees
		</title>
		@extends('layouts.admin_dashboard')
		@section('content')
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-page-title">
									Home / Employees
								</h3>
							</div>
						</div>
					</div>
					@if (session('status'))
					<div class="alert alert-success alert-dismissible fade show" role="alert" style="display: block; padding: 10px; margin:27px;">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
					<p class="message">
    							{{session('status')}}
								 </p>
					</div>@endif
					<!-- END: Subheader -->
					<div class="m-content">
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
																Employees:
															</label>
														</div>
														<div class="m-form__control">
															<select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_status">
																<option value="">
																	All Employees
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
											<a href="" class="btn m-btn--pill btn-success" data-toggle="modal" data-target="#addEmployee">
												<span>
													<i class="m-menu__link-icon flaticon-user-add"></i>
													<span>
														ADD NEW EMPLOYEE
													</span>
												</span>
											</a>
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
			<!-- end:: Body -->
<div id="addEmployee" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width: 50%;">
	<!-- Modal content-->
		<div class="modal-content">
		  	<div class="modal-header">
			    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
		    <h4 class="modal-title">Add New Employee</h4>
		  	</div>
		  	<div class="modal-body">
									<!--begin::Form-->
			<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="addemployee" name="addemployee">
			{{ csrf_field() }}
				<div class="m-portlet__body">
					<div class="form-group m-form__group row">
						<div class="col-lg-6">
							<label>
								First Name *:
							</label>
							<input type="text" name="first_name" id="first_name" class="form-control m-input" placeholder="Enter First name Minimum 3 characters">
                                <div class="error_msg">
                                	<span class="first_name"></span>
                                </div>
						</div>
						<div class="col-lg-6">
							<label>
								Last Name *:
							</label>
							<input type="text" name="last_name" id="last_name" class="form-control m-input" placeholder="Enter Last name Minimum 3 characters">
                                <div class="error_msg">
                                	<span class="last_name"></span>
                                </div>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-6">
							<label>
								Email Id *:
							</label>
							<input type="text" name="employee_email" id="employee_email" class="form-control m-input" placeholder="Enter Email Id of Employee">
                                <div class="error_msg">
                                	<span class="employee_email"></span>
                                </div>
						</div>
						<div class="col-lg-6">
							<label>
								Password *:
							</label>
							<input type="password" name="employee_password" id="employee_password" class="form-control m-input" placeholder="Enter Password">
                                <div class="error_msg">
                                	<span class="employee_password"></span>
                                </div>
						</div>
					</div>
				</div>
				<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions--solid">
						<div class="row">
							<div class="col-lg-4"></div>
							<div class="col-lg-8">
								<button type="submit" id="m_signup_employee" name="m_signup_employee" class="btn btn-primary">
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
	<!-- end::Quick Sidebar -->		    
    <!-- begin::Scroll Top -->
	<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
		<i class="la la-arrow-up"></i>
	</div>
	<!-- end::Scroll Top -->
	@endsection
	@section('js')
    <script src="{{asset('/js/employee.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
    	$('#employee_link').addClass('m-menu__item--active');
    </script>
	@endsection
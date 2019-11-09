<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			Argon | Tasks
		</title>
		@extends('layouts.admin_dashboard')
		@section('content')

			<style>
				.m-datatable__table th {
					font-size: 18px !important;
				}
			</style>
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-page-title">
									Home / Tasks
								</h3>
							</div>
						</div>
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
												<div class="col-md-6">
													<div class="m-form__group m-form__group--inline">
														<div class="m-form__label">
															<label>
																Tasks:
															</label>
														</div>
														<div class="m-form__control">
															<select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_status">
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
									</div>
								</div>
								<!--end: Search Form -->
								<!--begin: Datatable -->
								<div class="loader_msg" style='display: block;'>
									<img src="../assets/app/media/img/logos/loader.gif" width='132px' height='132px' style="height: 70px;width: 67px;margin-left: 40%;">
								</div>
								<div class="m_datatable" id="local_data"></div>
								<!--end: Datatable -->
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<!-- end:: Body -->
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
@endsection
@section('js')
<script src="{{asset('/js/task.js')}}" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery('#task_link').addClass('m-menu__item--active');
jQuery('#task a i').addClass('link-icon-active');
});
</script>
@endsection
	
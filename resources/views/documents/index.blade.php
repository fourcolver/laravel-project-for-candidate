<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			Argon | Documents
		</title>
		@extends('layouts.admin_dashboard')
		@section('content')
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-page-title">
									Home / Documents
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
																Documents:
															</label>
														</div>
														<div class="m-form__control">
															<select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_status">
																<option value="">
																	All Documents
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
											@php
											$module_permission='1';
											if(Auth::user()->user_role=='2'){
											if($permission->emp_add =='add'){$module_permission='1';}
											else{$module_permission='0';}}
											@endphp
											@if($module_permission=='1')
											<a href="" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" data-toggle="modal" data-target="#addDocument">
												<span>
													<i class="m-menu__link-icon flaticon-file"></i>
													<span>
														ADD NEW DOCUMENTS
													</span>
												</span>
											</a>
											@endif
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
			<!-- Modal -->
<div id="addDocument" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 40%;">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">File upload form</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form method="post" action="{{url('admin/file/upload')}}" name="upload_file" id="upload_file" enctype="multipart/form-data">
        	{{ csrf_field() }}
          Select file : <input type='file' name='file_name' id='file_name' class='form-control' required=""><br>
          <span id="errormessage"></span>
          <p style="color: red">* Please Select Only Doc and Pdf File</p>
          <button class="btn btn-primary" id="upload" name="upload" type="submit">Upload</button>
        </form>
      </div>
 
    </div>

  </div>
</div>
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
		<!-- end::Scroll Top -->
		@endsection
		@section('js')
        <script src="{{asset('/js/documents.js')}}" type="text/javascript"></script>
        <script type="text/javascript">
        	$('#document_link').addClass('m-menu__item--active');
        </script>
		@endsection
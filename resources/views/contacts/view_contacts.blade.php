<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
  <meta charset="utf-8" />
  <title>
    Argon | Kontakte
  </title>
  @extends('layouts.admin_dashboard')
  @section('content')
  @foreach ($details as $data)
  @endforeach
  <!-- END: Left Aside -->
  <div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
      <div class="d-flex align-items-center">
        <div class="mr-auto">
          <h3 class="m-page-title ">
            <a href="{{ url('/admin/contacts')}}">View Kontakte</a>
          </h3>
        </div>
      </div>  
    </div>
    @php $edit_manager = '1'; $delete_manager = '1'; if(Auth::user()->user_role!=1) { $manager_roles = explode(',', $permission->knotakte_permission); if(in_array('edit', $manager_roles)){ $edit_manager = '1';} else {$edit_manager=0;} if(in_array('delete', $manager_roles)){ $delete_manager = '1';} else {$delete_manager=0;}}@endphp      
    <div class="sub_btn_header">
      <div class="d-flex align-items-center">
        <div class="mr-auto sub_btn">
          @if($edit_manager=='1')
          <a href="{{ url('/admin/contacts/edit/'.$data->id )}}" class="btn btn-primary">
            <span>EDIT</span>
          </a>
          @endif
          @if($delete_manager=='1')
          <button data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
            <span>DELETE</span>
          </button>
          @endif
          <div id="deleteModal" class="modal fade" role="dialog" style="">
            <div class="modal-dialog" style="width: 40%;">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                  <p style="text-align: center; color: red;">
                  Are you sure you wish to delete this Kontakte.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" id="deleteContact" data-id="{{$data->id}}" class="btn btn-danger">Delete</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </div>
    <div class="m-portlet m-portlet--rounded view_block">
     <div class="m-portlet m-portlet--rounded view_block">
      <div class="form-group m-form__group row view_data">
        <div class="col-lg-5">
          <div class="heading_details">
            <label>First Name</label>
          </div>
          <div class="data_accounts">
            <span>{{$data->first_name}}</span></div>
          </div>
          <div class="col-lg-5">
            <div class="heading_details">
              <label>Last Name</label></div>
              <div class="data_accounts">
                <span>{{$data->last_name}}</span></div>
              </div>
            </div>
            <div class="form-group m-form__group row view_data_row">
              <div class="col-lg-5">
                <div class="heading_details">
                  <label>
                    Job Title 
                  </label>
                </div>
                <div class="data_accounts">
                  <span>{{$data->job_title}}</span></div>
                </div>
                <div class="col-lg-5">
                  <div class="heading_details">
                    <label>
                     Depatment
                   </label></div>
                   <div class="data_accounts">
                    <span>{{$data->departement}}</span></div>
                  </div>
                </div>
                <div class="form-group m-form__group row view_data">
                  <div class="col-lg-5">
                    <div class="heading_details">
                      <label>
                        Phone Number 
                      </label></div>
                      <div class="data_accounts">
                        <span>{{$data->phone}}</span></div>
                      </div>
                      <div class="col-lg-5">
                        <div class="heading_details">
                          <label>
                            Mobile Number
                          </label></div>
                          <div class="data_accounts">
                            <span>{{$data->mobile}}</span></div>
                          </div>
                        </div>
                        <div class="form-group m-form__group row view_data_row">
                          <div class="col-lg-5">
                            <div class="heading_details">
                              <label>
                                City
                              </label></div>
                              <div class="data_accounts">
                                <span>{{$data->city}}</span></div>
                              </div>
                              <div class="col-lg-5">
                                <div class="heading_details">
                                  <label>
                                    Email Id
                                  </label></div>
                                  <div class="data_accounts">
                                    <span>{{$data->email_id}}</span></div>
                                  </div>
                                </div>
                                <div class="form-group m-form__group row view_data">
                                  <div class="col-lg-5">
                                    <div class="heading_details">
                                      <label>Decision Makers</label>
                                    </div>
                                    <div class="data_accounts">
                                      <span> @if($data->decision_maker == '1') {{ 'YES' }} @else {{ 'No' }} @endif</span></div>
                                    </div>
                                    <div class="col-lg-5">
                                      <div class="heading_details">
                                        <label>
                                          Notes
                                        </label></div>
                                        <div class="data_accounts">
                                          <span>{{$data->notes}}</span></div>
                                        </div>
                                      </div>
                                      <div class="form-group m-form__group row view_data_row">
                                        <div class="col-lg-5">
                                          <div class="heading_details">
                                            <label>
                                              Country 
                                            </label></div>
                                            <div class="data_accounts">
                                              <span>{{$data->country}}</span></div>
                                            </div>
                                            <div class="col-lg-5">
                                              <div class="heading_details">
                                                <label>
                                                  Pincode/Zip
                                                </label></div>
                                                <div class="data_accounts">
                                                  <span>{{$data->pincode}}</span></div>
                                                </div>
                                              </div>
                                              <div class="form-group m-form__group row view_data">
                                                <div class="col-lg-5">
                                                  <div class="heading_details">
                                                    <label>Touch Rule</label>
                                                  </div>
                                                  <div class="data_accounts">
                                                    <span>{{$data->touch_rule}}</span></div>
                                                  </div>

                                                  <div class="col-lg-5">   
                                                   <div class="heading_details">
                                                    <label>Client</label>
                                                  </div>            
                                                  <div class="data_accounts">
                                                    <a href="../../accounts/view/{{$data->account_id}}/0">{{$data->account_name}}
                                                    </a>
                                                  </div>
                                                </div>

                                              </div>

                                            </div>
                                          </div>


                                          <!-- END: Subheader -->
                                        </div>
                                      </div>

                                      <!-- end:: Body -->
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
                                    <!-- end::Scroll Top -->
                                    @endsection
                                    @section('js')
                                    <script src="{{url('assets/demo/default/custom/components/datatables/base/view-contact.js')}}" type="text/javascript"></script>
                                    <script type="text/javascript">
                                      $('#contact_link').addClass('m-menu__item--active m-menu__item--expanded m-menu__item--open');
                                      $('#manager_link').addClass('m-menu__item--active');
                                    </script>
                                    @endsection
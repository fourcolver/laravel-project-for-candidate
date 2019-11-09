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
           @php
          $module_permission='1';
          if(Auth::user()->user_role=='2'){
          if($permission->emp_delete =='delete'){$module_permission='1';}
          else{$module_permission='0';}
          }
          @endphp
          <div class="m-subheader">
            <div class="d-flex align-items-center">
              <div class="mr-auto">
                <h3 class="m-page-title ">
                  <a href="{{ url('/admin/freelancers')}}">Add Kandidate Skills</a>
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
          <div class="sub_btn_header">
            <div class="d-flex align-items-center">
              <div class="mr-auto sub_btn">
                <button data-toggle="modal" data-target="#attachdoc" class="btn btn-primary">
                <span>Attach DOC</span>
                </button>
                @if($module_permission=='1')
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
                          Are you sure you wish to delete this Kandidate.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="deleteFreelancer" data-id="{{$data->id}}" class="btn btn-danger">Delete</button>
                        </div>
                      </div>
                    </div>
              </div>
              </div>
            </div>  
          </div>
          <div class="m-portlet m-portlet--rounded view_block">
          <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="add_skills" name="add_skills" method="post">
          {{ csrf_field() }}
          <div class="m-portlet__body">
            @if($data->admin_doc)
            <div class="form-group m-form__group row view_data">
            <div class="col-lg-6">
                <div class="heading_details">
                <label>Documents Attached</label>
                </div>
                <div class="data_accounts">
                <a title="Download Contact" href="../../../storage/app/admin/{{$data->admin_doc}}" download>{{$data->admin_doc}}</span></a>
              </div>
              </div>
            </div>
            </div>
            @endif
          <div class="form-group m-form__group row view_data_row">
              <div class="col-lg-6">
                <label>
                  Freelancer Name*:
                </label>
                <input type="hidden" value="{{$data->id}}" name="freelancer_id" id="freelancer_id">
                <input type="text" value="{{$data->first_name}} {{$data->last_name}}" name="freelancer_name" id="freelancer_name" class="form-control m-input" placeholder="Enter Freelancer Name">
                  <div class="error_msg">
                  <span class="freelancer_name"></span>
                  </div>
              </div>
            </div>
            <div class="form-group m-form__group row view_data_row">
              <div class="col-lg-6">
                <label>
                  Email ID*:
                </label>
                <input type="text" value="{{$data->email}}" name="freelancer_email" id="freelancer_email" class="form-control m-input" placeholder="Enter Freelancer Email Id">
                  <div class="error_msg">
                  <span class="freelancer_email"></span>
                  </div>
              </div>
            </div>
            <div class="form-group m-form__group row view_data_row">
              <div class="col-lg-6">
                <label>
                  Mobile Number*:
                </label>
                <input type="text" value="{{$data->Mobile}}" name="freelancer_mobile" id="freelancer_mobile" class="form-control m-input" placeholder="Enter Mobile Number">
                  <div class="error_msg">
                  <span class="freelancer_mobile"></span>
                  </div>
              </div>
            </div>
            <div class="form-group m-form__group row">
              <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Stundensatz</font></font></label>
                <div class="col-lg-6">
                  <div class="m-checkbox-inline">
                  <label class="m-checkbox">
                      <input name="hourly_rate[]" class="hourly_rate" value="1" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">50-60 € 
                      </font></font><span></span>
                  </label>
                  <label class="m-checkbox">
                      <input name="hourly_rate[]" class="hourly_rate" value="2" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">60-70 € 
                      </font></font><span></span>
                  </label>
                  <label class="m-checkbox">
                          <input name="hourly_rate[]" class="hourly_rate" value="3" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">70-80 € 
                          </font></font><span></span>
                  </label>
                  <label class="m-checkbox">
                      <input name="hourly_rate[]" class="hourly_rate" value="4" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">80-90 € 
                          </font></font><span></span>
                  </label>
                  <label class="m-checkbox">
                      <input name="hourly_rate[]" class="hourly_rate" value="5" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">90-100 € 
                      </font></font><span></span>
                  </label>
                  <label class="m-checkbox">
                      <input name="hourly_rate[]" class="hourly_rate" value="6" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">100-110 € 
                      </font></font><span></span>
                  </label>
                  <label class="m-checkbox">
                      <input name="hourly_rate[]" class="hourly_rate" value="7" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">110-120 € 
                      </font></font><span></span>
                   </label>
                  <div id="hourly_rate_msg"></div>
                </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Rollendefinition</font></font></label>
                <div class="col-lg-6">
                  <div class="m-checkbox-inline">
                      <label class="m-checkbox">
                        <input name="freelancer_roles[]" class="freelancer_roles" value="1" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Entwickler
                        </font></font><span></span>
                      </label>
                      <label class="m-checkbox">
                        <input name="freelancer_roles[]" class="freelancer_roles" value="2" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Architekt
                        </font></font><span></span>
                      </label>
                      <label class="m-checkbox">
                        <input name="freelancer_roles[]" class="freelancer_roles" value="3" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Support 
                        </font></font><span></span>
                      </label>
                      <label class="m-checkbox">
                        <input name="freelancer_roles[]" class="freelancer_roles" value="4" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Projektmanager 
                        </font></font><span></span>
                      </label>
                      <label class="m-checkbox">
                        <input name="freelancer_roles[]" class="freelancer_roles" value="5" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Berater
                        </font></font><span></span>
                      </label>
                      <label class="m-checkbox">
                        <input name="freelancer_roles[]" class="freelancer_roles" value="6" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Administrator 
                        </font></font><span></span>
                      </label>
                    </div>
                </div>
              </div>
              <div class="form-group m-form__group row">
                <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Available from</font></font></label>
                <div class="col-lg-6">
                  <div class="m-radio-inline">
                    <label class="m-radio m-radio--solid">
                    <input name="part_or_full_time" value="1" type="radio" checked=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Full Time
                    </font></font><span></span>
                  </label>
                  <label class="m-radio m-radio--solid">
                    <input name="part_or_full_time" value="0" type="radio"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Part Time
                    </font></font><span></span>
                  </label>
                  <label class="m-radio m-radio--solid">
                    <input name="part_or_full_time" value="2" type="radio"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Not Available
                    </font></font><span></span>
                  </label>
                  </div>
                </div>
              </div>
              <div class="form-group m-form__group row">
                <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Availability per week</font></font></label>
                <div class="col-lg-6">
                  <div class="input-group date" id="m_datepicker_3" style="width: 56%;">
                    <input class="form-control m-input" readonly="" type="text" name="availability_date" required>
                    <span class="input-group-addon">
                    <i class="la la-calendar"></i>
                    </span>
                  </div>
                  <div class="m-checkbox-inline">
                    <label class="m-checkbox">
                      <input name="availabile_days[]" class="availabile_days" value="1" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 1 Tag
                      </font></font><span></span>
                  </label>
                  <label class="m-checkbox">
                      <input name="availabile_days[]" class="availabile_days" value="2" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 2 Tage
                      </font></font><span></span>
                  </label>
                  <label class="m-checkbox">
                      <input name="availabile_days[]" class="availabile_days" value="3" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 3 Tage
                      </font></font><span></span>
                  </label>
                  <label class="m-checkbox">
                      <input name="availabile_days[]" class="availabile_days" value="4" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 4 Tage
                      </font></font><span></span>
                  </label>
                  <label class="m-checkbox">
                      <input name="availabile_days[]" class="availabile_days" value="5" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 5 Tage
                      </font></font><span></span>
                  </label>
                </div>
                </div>
              </div>
              <div class="form-group m-form__group row">
                <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Traveling</font></font></label>
                <div class="col-lg-6">
                  <div class="m-checkbox-inline">
                    <label class="m-checkbox">
                            <input name="can_travel_to_germany[]" value="1" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Weltweit</font></font><span></span>
                    </label>
                    <label class="m-checkbox">
                            <input name="can_travel_to_germany[]" value="2" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Europaweit</font></font><span></span>
                    </label>
                    <label class="m-checkbox">
                            <input name="can_travel_to_germany[]" checked value="3" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Deutschlandweit</font></font><span></span>
                    </label>
                    <label class="m-checkbox">
                            <input name="can_travel_to_germany[]" value="4" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Bundesland</font></font><span></span>
                    </label>
                    <label class="m-checkbox">
                            <input name="can_travel_to_germany[]" value="5" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Stadt</font></font><span></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group m-form__group row">
                <label class="col-lg-12 col-form-label text-left"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Competences</font></font></label>
                <div class="col-lg-12">
                  <div class="panel-group" id="accordion">
                    @foreach($competences as $competences_val)
                      <div class="panel panel-default" >
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#category{{$competences_val->keys}}" style="cursor: pointer;">
                          <div class="panel-title">
                          <a class="m-tabs__link" role="tab"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$competences_val->name}}</font></font></a>
                          </div>
                        </div>
                        <div id="category{{$competences_val->keys}}" class="panel-collapse collapse">
                          <div class="panel-body">
                            <div class="m-checkbox-inline">
                              @foreach($competences_val->competences_skill as $key => $competences_skill)
                                <label class="m-checkbox">
                                        <input name="category_skills[]" value="{{$competences_skill->id}}" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$competences_skill->skill}}</font></font><span></span>
                                </label>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid">
                  <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-8">
                      <button type="submit" id="m_add_skills" name="m_add_skills" class="btn btn-primary">
                        Add Skills
                      </button>
                      <a class="btn btn-secondary" href="{{ url('/admin/freelancers') }}">
                        Cancel
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          </div>

          </div>
      <!-- end:: Body -->

      <div id="attachdoc" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 40%;">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">File upload form</h4>
            </div>
            <div class="modal-body">
              <!-- Form -->
              <form method="post" action="{{url('admin/upload/'.$data->id)}}" name="upload_file" id="upload_file" enctype="multipart/form-data">
                {{ csrf_field() }}
                Select file : <input type='file' name='attach_doc' id='attach_doc' class='form-control' required=""><br>
                <span id="errormessage"></span>
                <p style="color: red">* Please Select Only Doc and Pdf File</p>
                <button class="btn btn-primary" id="upload" name="upload" type="submit">Upload</button>
              </form>
            </div>
       
          </div>

          </div>
        </div>
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
    <script src="{{url('assets/demo/default/custom/components/datatables/base/data_skills.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
    $('#contact_link').addClass('m-menu__item--active m-menu__item--expanded m-menu__item--open');
    $('#freelancer_link').addClass('m-menu__item--active');
    </script>
    @endsection
    @section('css')
    <style type="text/css">
        #accordion .panel-default .panel-heading a {
          color: #fff;
          }
        #accordion .panel-default .panel-heading {
          background-color: #5757f3;
          border-top-left-radius: 3px;
          border-top-right-radius: 3px;
          padding: 10px 15px;
          margin: 0 0 3px;
        }

    </style>
    @endsection

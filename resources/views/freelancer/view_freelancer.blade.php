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
                  <a href="{{ url('/admin/freelancers')}}">View Kandidate</a>
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
                <button data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
                <span>DELETE</span>
                </button>
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
                          <button type="button" id="deleteContact" data-id="{{$data->id}}" class="btn btn-danger">Delete</button>
                        </div>
                      </div>
                    </div>
              </div>
              </div>
            </div>  
          </div>
          <div class="m-portlet m-portlet--rounded view_block">
            <div class="form-group m-form__group row view_data_row">
            <div class="col-lg-5">
                <div class="heading_details">
                <label>Freelancer Name</label>
                </div>
                <div class="data_accounts">
                <span>{{$data->first_name}} {{$data->last_name}}</span></div>
              </div>
              <div class="col-lg-5">
                <div class="heading_details">
                <label>Email Id</label></div>
                <div class="data_accounts">
                <span>{{$data->email}}</span></div>
              </div>
            </div>
            <div class="form-group m-form__group row view_data">
              <div class="col-lg-5">
                <div class="heading_details">
                <label>
                  Mobile Number
                </label></div>
                <div class="data_accounts">
                <span>{{$data->Mobile}}</span></div>
              </div>
              <?php $hourly_rate = array("1"=>"50-60 €", "2"=>"60-70 €", "3"=>"70-80 €","4"=>"80-90 €", "5"=>"90-100 €", "6"=>"100-110 €","7" => "110-120 €","8" => "Other"); ?>
              <div class="col-lg-5">
                <div class="heading_details">
                <label>
                   Hourly rate
                </label></div>
                <div class="data_accounts">
                <span>@if(array_key_exists($data->hourly_rate,$hourly_rate)){{$hourly_rate[$data->hourly_rate]}}@endif</span></div>
              </div>
            </div>
            <div class="form-group m-form__group row view_data_row">
              <?php $role_definition = array("1"=>"Entwickler", "2"=>"Architekt", "3"=>"Support","4"=>"Projektmanager", "5"=>"Berater", "6"=>"Administrator","7" => "Other"); ?>
            <div class="col-lg-5">
                <div class="heading_details">
                <label>
                  Role/Defination
                </label></div>
                <div class="data_accounts">
                <span>@if(array_key_exists($data->role_definition,$role_definition)){{$role_definition[$data->role_definition]}}@endif</span></div>
              </div>
              <div class="col-lg-5">
                <div class="heading_details">
                <label>
                  Availability 
                </label></div>
                <div class="data_accounts">
                <span>@if($data->availability == '1') {{ 'Full Time' }}@else {{ 'Part Time' }}@endif</span></div>
              </div>
            </div>
            <div class="form-group m-form__group row view_data">
            <div class="col-lg-5">
                <div class="heading_details">
                <label>Available Date</label>
                </div>
                <div class="data_accounts">
                <span>{{$data->availability_date}}</span></div>
              </div>
              <div class="col-lg-5">
                <div class="heading_details">
                <label>
                  Available Per Week
                </label></div>
                <div class="data_accounts">
                <span>{{$data->availability_per_week}} Days</span></div>
              </div>
            </div>
            @if($data->admin_doc)
            <div class="form-group m-form__group row view_data">
            <div class="col-lg-5">
                <div class="heading_details">
                <label>Documents Attached</label>
                </div>
                <div class="data_accounts">
                <a title="Download Contact" href="../../../storage/app/admin/{{$data->admin_doc}}" download>{{$data->admin_doc}}</span></a>
              </div>
              </div>
            </div>
            @endif
            <?php $category1_rating = explode(',', $data->competences_skill_category_1);
              $category2_rating = explode(',', $data->competences_skill_category_2);
              $category3_rating = explode(',', $data->competences_skill_category_3);
              $category4_rating = explode(',', $data->competences_skill_category_4);
              $category5_rating = explode(',', $data->competences_skill_category_5);
              $category6_rating = explode(',', $data->competences_skill_category_6);
              $category7_rating = explode(',', $data->competences_skill_category_7);
              $category8_rating = explode(',', $data->competences_skill_category_8); ?>
            <div class="form-group m-form__group row">
                <label class="col-lg-12 col-form-label text-left"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><h4>competences</h4></font></font></label>
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
                                        <input name="category{{$competences_val->keys}}_rating[]" value="{{$key+1}}" type="checkbox" @if(in_array($key+1, ${'category'.$competences_val->keys . '_rating'})) {{ 'checked' }} @endif><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$competences_skill->skill}}</font></font><span></span>
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

          </div>
        </div>
                  
          
          <!-- END: Subheader -->
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
              <form method="post" action="{{url('admin/freelancer/upload/'.$data->user_id)}}" name="upload_file" id="upload_file" enctype="multipart/form-data">
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
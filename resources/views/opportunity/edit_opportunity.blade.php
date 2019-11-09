<!DOCTYPE html>
<html lang="en" >
  <!-- begin::Head -->
  <head>
    <meta charset="utf-8" />
    <title>
      Argon | Opportunity
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
                  Home / Projektanfragen / {{$data->name}}
                </h3>
              </div>
            </div>  
          </div>
          @if (session('upload'))
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: block; padding: 10px; margin:27px;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
          <p class="message">
                  {{session('upload')}}
                 </p>
          </div>@endif
          @if (session('voice_msg'))
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: block; padding: 10px; margin:27px;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
          <p class="message">
                  {{session('voice_msg')}}
                 </p>
          </div>@endif
          <div class="sub_btn_header">
            <div class="d-flex align-items-center">
              <div class="mr-auto sub_btn" style="margin-left: 55%;">
                <button data-toggle="modal" data-target="#attachvoice" class="btn btn-primary">
                <span>Attach Voice Memo</span>
                </button>
                <button data-toggle="modal" data-target="#attachdoc" class="btn btn-primary">
                <span>Attach DOC</span>
                </button>
                @php $delete_oppo = '1'; if(Auth::user()->user_role!=1) { $opportunity_roles = explode(',', $permission->projektanfrage_permission); if(in_array('delete', $opportunity_roles)){ $delete_oppo = '1';} else {$delete_oppo =0;}}@endphp
                @if($delete_oppo=='1')
                <button data-toggle="modal" data-target="#deleteModal" class="btn btn-danger m-btn m-btn--icon">
                <span><i class="fa fa-trash-o"></i><span>Delete</span></span>
                </button>
                @endif
                
                <div id="deleteModal" class="modal fade" role="dialog" style="">
                    <div class="modal-dialog" style="width: 50%;">

                  <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Confirm Delete</h4>
                        </div>
                        <div class="modal-body">
                          <p style="text-align: center; color: red;">
                          Are you sure you wish to delete this Account and Related Records.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="deleteOpportunity" data-id="{{$data->id}}" class="btn btn-danger">Delete</button>
                        </div>
                      </div>
                    </div>
              </div>
              </div>
            </div>  
          </div>
          <div class="m-portlet m-portlet--rounded view_block">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="editOpportunity" name="editOpportunity">
          {{ csrf_field() }}
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-4">
                <label>
                  Opportunity Name *:
                </label>
                <input type="hidden" value="{{$data->account_id}}" name="account_id" id="account_id">
                <input type="text" value="{{$data->name}}" name="name" id="name" class="form-control m-input" placeholder="Enter Opportunity name">
                                    <div class="error_msg">
                                      <span class="name"></span>
                                    </div>
              </div>
              <div class="col-lg-4">
                <label>
                  Closed Date *:
                </label>
                <input type="text" value="{{$data->close_date}}" name="close_date" id="close_date" class="form-control m-input" placeholder="Enter Closed Date" readonly>
                <div class="error_msg">
                                  <span class="close_date"></span>
                              </div>
              </div>
              <div class="col-lg-4">
                <label style="width: 100%;">
                  Select Probability *:
                </label>
                <select class="custom-select" id="probability" name="probability">
                    <option value="">
                    Please Select Probability Of Opportunity</option>
                    <option value="10" @if($data->probability == '10') {{ 'selected' }} @endif>10</option>
                    <option value="25" @if($data->probability == '25') {{ 'selected' }} @endif>25</option>
                    <option value="50" @if($data->probability == '50') {{ 'selected' }} @endif>50</option>
                    <option value="75" @if($data->probability == '75') {{ 'selected' }} @endif>75</option>
                    <option value="100" @if($data->probability == '100') {{ 'selected' }} @endif>100</option>
                </select>
                  <div class="error_msg">
                    <span class="probability"></span>
                  </div>
                </div>
              </div>
              <div class="form-group m-form__group row">
                <div class="col-lg-4">
                <label style="width: 100%;">
                  Hotness of Client:
                </label>
                <input type="text" class="form-control m-input" id="hotness" name="hotness" placeholder="Hotness of Client" readonly="readonly">
                <!-- <select class="custom-select" id="hotness" name="hotness" disabled>
                    <option value="">
                    Please Select Client Specification</option>
                    <option value="1" @if($data->hotness == '1') {{ 'selected' }} @endif>1</option>
                    <option value="2" @if($data->hotness == '2') {{ 'selected' }} @endif>2</option>
                    <option value="3" @if($data->hotness == '3') {{ 'selected' }} @endif>3</option>
                    <option value="4" @if($data->hotness == '4') {{ 'selected' }} @endif>4</option>
                    <option value="5" @if($data->hotness == '5') {{ 'selected' }} @endif>5</option>
                    <option value="6" @if($data->hotness == '6') {{ 'selected' }} @endif>6</option>
                    <option value="7" @if($data->hotness == '7') {{ 'selected' }} @endif>7</option>
                    <option value="8" @if($data->hotness == '8') {{ 'selected' }} @endif>8</option>
                    <option value="9" @if($data->hotness == '9') {{ 'selected' }} @endif>9</option>
                    <option value="10" @if($data->hotness == '10') {{ 'selected' }} @endif>10</option>
                  </select> -->
                    <div class="error_msg">
                      <span class="hotness"></span>
                    </div>
                </div>
                <div class="col-lg-4">
                <label style="width: 100%;">
                  Source of Opportunity*:
                </label>
                <select class="custom-select" id="source" name="source">
                    <option value="">
                    Please Select Source</option>
                    <option value="Advertisement" @if($data->source == 'Advertisement') {{ 'selected' }} @endif>Advertisement</option>
                    <option value="Email" @if($data->source == 'Email') {{ 'selected' }} @endif>Email</option>
                    <option value="Mailshot" @if($data->source == 'Mailshot') {{ 'selected' }} @endif>Mailshot</option>
                    <option value="Pay Per Click" @if($data->source == 'Pay Per Click') {{ 'selected' }} @endif>Pay Per Click</option>
                    <option value="Press" @if($data->source == 'Press') {{ 'selected' }} @endif>Press</option>
                    <option value="Referral" @if($data->source == 'Referral') {{ 'selected' }} @endif>Referral</option>
                    <option value="Social" @if($data->source == 'Social') {{ 'selected' }} @endif>Social</option>
                    <option value="Telephone" @if($data->source == 'Telephone') {{ 'selected' }} @endif>Telephone</option>
                    <option value="Web Search" @if($data->source == 'Web Search') {{ 'selected' }} @endif>Web Search</option>
                    <option value="Web site" @if($data->source == 'Web site') {{ 'selected' }} @endif>Web site</option>
                    <option value="Word of Mouth" @if($data->source == 'Word of Mouth') {{ 'selected' }} @endif>Word of Mouth</option>
                  </select>
                  <div class="error_msg">
                    <span class="source"></span>
                  </div>
              </div>
              <?php $process = explode(',', $data->process);?>
              <div class="col-lg-4">
                <label for="process">
                Process:
                </label>
                <select multiple="multiple" class="custom-select" id="process" name="process[]" style="height: 99px; width: 100%;">
                <option value="Xing" @if(in_array("Xing", $process)) {{ 'selected' }} @endif>Xing</option>
                <option value="Freelance.de" @if(in_array("Freelance.de", $process)) {{ 'selected' }} @endif>Freelance.de</option>
                <option value="Freelancermap.de" @if(in_array("Freelancermap.de", $process)) {{ 'selected' }} @endif>Freelancermap.de</option>
                <option value="Called Top Candidates" @if(in_array("Called Top Candidates", $process)) {{ 'selected' }} @endif>Called Top Candidates</option>
                <option value="Internal CRM System" @if(in_array("Internal CRM System", $process)) {{ 'selected' }} @endif>Internal CRM System</option>
                <option value="LinkedIn" @if(in_array("LinkedIn", $process)) {{ 'selected' }} @endif>LinkedIn</option>
                <option value="Suggestion from Freelancer" @if(in_array("Suggestion from Freelancer", $process)) {{ 'selected' }} @endif>Suggestion from Freelancer</option>
                <option value="Google Search Companies" @if(in_array("Google Search Companies", $process)) {{ 'selected' }} @endif>Google Search Companies</option>
                <option value="Google Search Freelancers" @if(in_array("Google Search Freelancers", $process)) {{ 'selected' }} @endif>Google Search Freelancers</option>
                </select>
                  <div class="error_msg">
                                  <span class="process"></span>
                                </div>
                </div>
              </div>
              <div class="form-group m-form__group row">
                <div class="col-lg-4">
                <label style="width: 100%;">
                  Technology *:
                </label>
                <select class="custom-select" id="technology" name="technology">
                    <option value="">
                    Please Select Technology</option>
                    <option value="Microsoft .Net" @if($data->technology == 'Microsoft .Net') {{ 'selected' }} @endif>Microsoft .Net</option>
                    <option value="Java" @if($data->technology == 'Java') {{ 'selected' }} @endif>Java</option>
                    <option value="SAP" @if($data->technology == 'SAP') {{ 'selected' }} @endif>SAP</option>
                    <option value="PHP" @if($data->technology == 'PHP') {{ 'selected' }} @endif>PHP</option>
                    <option value="NSI" @if($data->technology == 'NSI') {{ 'selected' }} @endif>NSI</option>
                    <option value="Embedded" @if($data->technology == 'Embedded') {{ 'selected' }} @endif>Embedded</option>
                  </select>
                      <div class="error_msg">
                        <span class="technology"></span>
                      </div>
                </div>
                <div class="col-lg-4">
                <label>
                  Client Name *:
                </label>
                <input type="text" value="{{$data->client_name}}" name="client_name" id="client_name" class="form-control m-input" placeholder="Enter Opportunity name" readonly="readonly">
                                    <div class="error_msg">
                                      <span class="client_name"></span>
                                    </div>
                </div>
                <div class="col-lg-4">
                <label>
                  Client Telephone Number *:
                </label>
                <input type="text" value="{{$data->client_number}}" name="client_number" id="client_number" class="form-control m-input" placeholder="Enter Opportunity name" readonly="readonly">
                  <div class="error_msg">
                    <span class="client_number"></span>
                  </div>
                </div>
                
              </div>
              <div class="form-group m-form__group row">
                <div class="col-lg-4">
                <label>
                  Info Field :
                </label>
                <input type="text" value="{{$data->info_field}}" name="info_field" id="info_field" class="form-control m-input" placeholder="Enter Opportunity name">
                  <div class="error_msg">
                    <span class="info_field"></span>
                  </div>
                </div>
                <div class="col-lg-4">
                <label>
                  Outcome of Opportunity:
                </label>
                  <textarea class="form-control m-input m-input--air" name="report" id="report" rows="3">@if($data->report){{$data->report}} @endif</textarea>
                  <div class="error_msg">
                    <span class="report"></span>
                  </div>
                </div>
                <div class="col-lg-4">
                <label style="width: 100%;">
                  Number of Profile Sent :
                </label>
                <select class="custom-select" id="profile_sent" name="profile_sent">
                    <option value="">
                    Please Select Numeber of Profile sent</option>
                    @for ($i = 1; $i <= 50; $i++)
                      <option value="{{$i}}" @if($data->profile_sent == $i) {{ 'selected' }} @endif>{{ $i }}</option>
                    @endfor
                </select>
                
                  <div class="error_msg">
                    <span class="profile_field"></span>
                  </div>
                </div>
              </div>
              <div class="form-group m-form__group row">
                <div class="col-lg-4">
                <label>
                  Permanent Opportunity:
                </label>
                <input type="checkbox" name="opportunity_type" id="opportunity_type" data-toggle="toggle" @if($data->opportunity_type == '1') {{ 'checked' }} @endif>
                  <div class="error_msg">
                    <span class="opportunity_type"></span>
                  </div>
                </div>
                <div class="col-lg-4">
                <label>
                  Active Opportunity:
                </label>
                <input type="checkbox" name="opportunity_status" id="opportunity_status" data-toggle="toggle" @if($data->opportunity_status == '1') {{ 'checked' }} @endif>
                  <div class="error_msg">
                    <span class="opportunity_status"></span>
                  </div>
                </div>
              </div>
              <div class="form-group m-form__group row">
                <div class="col-lg-12">
                  <div class="m-portlet m-portlet--rounded view_block">
                    <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <div class="panel-title">
                          <div class="title_header">
                          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#detailed_technologies" aria-expanded="true" aria-controls="detailed_technologies">
                              <i class="more-less glyphicon glyphicon-plus"></i>
                              <h4>Coding</h4>
                          </a>
                          </div>
                      </div>
                    </div>
                <div id="detailed_technologies" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="clear:both;">
                <div class="panel-body">
                      @foreach($competences as $competences_val)
                      <div class="panel panel-default" >
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#category{{$competences_val->keys}}" style="cursor: pointer;">
                          <div class="panel-title">
                          <a class="m-tabs__link" role="tab"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$competences_val->name}}</font></font></a>
                          </div>
                        </div>
                        <?php $competence_data = explode(',', $data->detailed_coding);?>
                        <div id="category{{$competences_val->keys}}" class="panel-collapse collapse">
                          <div class="panel-body">
                            <div class="m-checkbox-inline">
                              @foreach($competences_val->competences_skill as $key => $competences_skill)
            
                                <label class="m-checkbox">
                                        <input name="category_rating[]"  value="{{$competences_skill->skill}}" type="checkbox" @if(in_array($competences_skill->skill,$competence_data)) {{ 'checked' }} @endif>{{$competences_skill->skill}}<span></span>
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
              </div>
              </div>
              <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="form-group m-form__group row view_data">
                @if($data->attached_doc)
                  <div class="col-lg-5">
                  <div class="heading_details">
                    <label>Documents Attached</label>
                    </div>
                    <div class="data_accounts">
                    <a title="Download Contact" href="../../../storage/app/admin/opportunity/documnents/{{$data->attached_doc}}" download>{{$data->attached_doc}}</span></a>
                  </div>
                  </div>
                
                @endif
                @if($data->attached_voice_memo)
                  <div class="col-lg-5">
                  <div class="heading_details">
                    <label>Audio Attached</label>
                    </div>
                    <div class="data_accounts">
                    <a title="Download Contact" href="../../../storage/app/admin/opportunity/voice/{{$data->attached_voice_memo}}" download>{{$data->attached_voice_memo}}</span></a>
                  </div>
                  </div>
                
                @endif
                </div>
                <div class="m-form__actions m-form__actions--solid">
                  <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-8">
                      <button type="submit" id="m_login_signin_submit" data-id="{{$data->id}}" name="m_login_signin_submit" class="btn btn-primary">
                        Submit
                      </button>
                      <button type="reset" class="btn btn-secondary" data-dismiss="modal">
                        Reset
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- <div class="m-portlet m-portlet--rounded view_block">
            <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <div class="panel-title">
                    <div class="title_header">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#line" aria-expanded="true" aria-controls="line">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        <h4>Opportunity Lines</h4>
                    </a>
                    </div>
                    <div class="add_button">
                    <button class="btn btn-primary m-btn m-btn--icon" data-toggle="modal" data-target="#addOpportunityModal">
                        <span>
                        <i class="fa fa-plus"></i>
                        <span>
                          Add Line
                        </span>
                        </span>
                    </button>
                    </div>
                    <div class="loader" style='display: block;'>
                    <img src="../../../assets/app/media/img/logos/loader.gif" width='132px' height='132px'>
                  </div>
                </div>
            </div>
            <div id="line" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                      <div class="line_datatable" data-type="{{$data->id}}" id="line_data">
                      </div>
                </div>
            </div>
          </div>
          </div> -->
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
              <form method="post" action="{{url('admin/opportunity/upload/'.$data->id)}}" name="upload_file" id="upload_file" enctype="multipart/form-data">
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
        <div id="attachvoice" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 40%;">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Voice upload form</h4>
            </div>
            <div class="modal-body">
              <!-- Form -->
              <form method="post" action="{{url('admin/opportunity/voiceUpload/'.$data->id)}}" name="upload_file" id="upload_file" enctype="multipart/form-data">
                {{ csrf_field() }}
                Select file : <input type='file' name='attach_voice' id='attach_voice' class='form-control' required=""><br>
                <span id="errormessage"></span>
                <p style="color: red">* Please Select Only Mp3 format</p>
                <button class="btn btn-primary" id="upload" name="upload" type="submit">Upload</button>
              </form>
            </div>
       
          </div>

          </div>
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
    <!-- end::Scroll Top -->
    @endsection
    @section('js')
    <script type="text/javascript">
    $(document).ready(function(){
      $('#opportunity_link').addClass('m-menu__item--active');
    });
    </script>
    <script type="text/javascript">
          var id = $('#account_id').val();
          var path = "../showData/"+id;
          $.ajax({
            url: path,
            type: "GET",
            data: {
              id: id,
              _token: '{{csrf_token()}}',  
            },
            success: function(result){
              console.log(result);
              var res = $.parseJSON(result);

              if(res.status == 'error'){

              }else{               
                var data = $.parseJSON(JSON.stringify(res.message));
                $("#client_name").val(data.account_name);
                $("#client_number").val(data.telephone);
                $("#hotness").val(data.client_specification);

              }
            },
            error: function(){
              alert("Error");
            }
           });
    </script>
    <script src="{{url('assets/demo/default/custom/components/datatables/base/view-opportunity.js')}}" type="text/javascript"></script>
    <style type="text/css">
      #detailed_technologies .panel-default .panel-heading a {
          color: #fff;
          }
        #detailed_technologies .panel-default .panel-heading {
          background-color: #5757f3;
          border-top-left-radius: 3px;
          border-top-right-radius: 3px;
          padding: 10px 15px;
          margin: 0 0 3px;
        }
    </style>
    @endsection
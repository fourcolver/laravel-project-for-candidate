<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
  <meta charset="utf-8" />
  <title>
    Argon | kontakte
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
            Edit kontakte / <a href="{{ url('/admin/accounts/view/'.$data->account_id.'/0')}}">{{$data->account_name}}</a> /<a href="{{ url('/admin/contacts/view/'.$data->id)}}">{{$data->first_name}}</a>
          </h3>
        </div>
      </div>  
    </div>
    <div class="m-portlet m-portlet--rounded view_block">
      <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="editContacts" name="editContacts">
        {{ csrf_field() }}
        <div class="m-portlet__body">
          <div class="form-group m-form__group row">
            <div class="col-lg-4">
              <label>
                First Name *:
              </label>
              <input type="hidden" value="{{$data->contact_id}}" name="contact_id" id="contact_id">
              <input type="text" value="{{$data->first_name}}" name="first_name" id="first_name" class="form-control m-input" placeholder="Enter First name Minimum 3 characters">
              <div class="error_msg">
                <span class="first_name"></span>
              </div>
            </div>
            <div class="col-lg-4">
              <label>
                Last Name *:
              </label>
              <input type="text" value="{{$data->last_name}}" name="last_name" id="last_name" class="form-control m-input" placeholder="Enter Last name">
              <div class="error_msg">
                <span class="last_name"></span>
              </div>
            </div>
            <div class="col-lg-4">
              <label style="width: 100%;">
                Job Title *:
              </label>
              <select class="custom-select" id="job_title" name="job_title">
                <option value="">
                Please Select Job Title of Contact</option>
                <option value="Geschäftsführer"  @if($data->job_title == 'Geschäftsführer') {{ 'selected' }} @endif>Geschäftsführer</option>
                <option value="CIO"  @if($data->job_title == 'CIO') {{ 'selected' }} @endif>CIO</option>
                <option value="IT Manager"  @if($data->job_title == 'IT Manager') {{ 'selected' }} @endif>IT Manager</option>
                <option value="IT Direktor"  @if($data->job_title == 'IT Direktor') {{ 'selected' }} @endif>IT Direktor</option>
                <option value="IT Mitarbeiter"  @if($data->job_title == 'IT Mitarbeiter') {{ 'selected' }} @endif>IT Mitarbeiter</option>
                <option value="HR Manager"  @if($data->job_title == 'HR Manager') {{ 'selected' }} @endif>HR Manager</option>
                <option value="HR Direktor"  @if($data->job_title == 'HR Direktor') {{ 'selected' }} @endif>HR Direktor</option>
                <option value="HR Mitarbeiter"  @if($data->job_title == 'HR Mitarbeiter') {{ 'selected' }} @endif>HR Mitarbeiter</option>
                <option value="Manager Einkauf"  @if($data->job_title == 'Manager Einkauf') {{ 'selected' }} @endif>Manager Einkauf</option>
                <option value="Direktor Einkauf"  @if($data->job_title == 'Manager Einkauf') {{ 'selected' }} @endif>Direktor Einkauf</option>
                <option value="Mitarbeiter Einkauf"  @if($data->job_title == 'Mitarbeiter Einkauf') {{ 'selected' }} @endif>Mitarbeiter Einkauf</option>
                <option value="Assistenz"  @if($data->job_title == 'Assistenz') {{ 'selected' }} @endif>Assistenz</option>
                <option value="Andere Abteilung"  @if($data->job_title == 'Andere Abteilung') {{ 'selected' }} @endif>Andere Abteilung</option>
              </select>
              <div class="error_msg">
                <span class="job_title"></span>
              </div>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-4">
              <label style="width: 100%;">
                Department *:
              </label>
              <select class="custom-select" id="departement" name="departement">
                <option value="">
                Please Select Department of Contact</option>
                <option value="Geschäftsführung"  @if($data->departement == 'Geschäftsführung') {{ 'selected' }} @endif>Geschäftsführung</option>
                <option value="IT"  @if($data->departement == 'IT') {{ 'selected' }} @endif>IT</option>
                <option value="Einkauf"  @if($data->departement == 'Einkauf') {{ 'selected' }} @endif>Einkauf</option>
                <option value="HR"  @if($data->departement == 'HR') {{ 'selected' }} @endif>HR</option>
                <option value="Andere Abteilung"  @if($data->departement == 'Andere Abteilung') {{ 'selected' }} @endif>Andere Abteilung</option>
              </select>
              <div class="error_msg">
                <span class="departement"></span>
              </div>
            </div>
            <div class="col-lg-4">
              <label>
                Phone *:
              </label>
              <input type="text" value="{{$data->phone}}" name="phone" id="phone" class="form-control m-input" placeholder="Enter Your Phone Omly Numeric">
              <div class="error_msg">
                <span class="phone"></span>
              </div>
            </div>
            <div class="col-lg-4">
              <label style="width: 100%;">
                Local Country *:
              </label>
              <select class="custom-select" name="country" id="country">
                <optgroup label="Mostly Used">
                  @foreach($countries as $item)
                  @if($item->default_country == '1')
                  <option value="{{$item->name}}" @if($data->country == $item->name) {{ 'selected' }} @endif>{{$item->name}}</option>
                  @endif
                  @endforeach
                </optgroup>
                <optgroup label="Other Countries">
                  @foreach($countries as $item)
                  if($item->default_country != '1')
                  {
                    <option value="{{$item->name}}" @if($data->country == $item->name) {{ 'selected' }} @endif>{{$item->name}}</option>
                  }
                  @endforeach
                </optgroup>
              </select>
              <div class="error_msg">
                <span class="country"></span>
              </div>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-4">
              <label>
                Mobile/ Cell *:
              </label>
              <input type="text" value="{{$data->mobile}}" name="mobile" id="mobile" class="form-control m-input" placeholder="Enter Your Mobile Number Only Numeric">
              <div class="error_msg">
                <span class="mobile"></span>
              </div>
            </div>
            <div class="col-lg-4">
              <label>
                Note :
              </label>
              <input type="text" value="{{$data->notes}}" name="note" id="note" class="form-control m-input" placeholder="Enter Your Note">
            </div>
            <div class="col-lg-4">
              <label>
                Email *:
              </label>
              <input type="text" value="{{$data->email_id}}" name="email_id" id="email_id" class="form-control m-input" placeholder="Enter Your Email">
              <div class="error_msg">
                <span class="email_id"></span>
              </div>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-4">
              <label>
                Decision Maker :
              </label>
              <label>
                <input type="checkbox" name="decision_maker" id="decision_maker" data-toggle="toggle" @if($data->decision_maker == '1') {{ 'checked' }} @endif>

              </label>
            </div>
            <div class="col-lg-4">
              <label>
                Local City :
              </label>
              <input type="text" value="{{$data->city}}" name="city" id="city" class="form-control m-input" placeholder="Enter Your City">
              <div class="error_msg">
                <span class="city"></span>
              </div>
            </div>
            <div class="col-lg-4">
              <label>
                Local Zipcode *:
              </label>
              <input type="text" value="{{$data->pincode}}" name="zipcode" id="zipcode" class="form-control m-input" placeholder="Enter Your Zipcode">
              <div class="error_msg">
                <span class="zipcode"></span>
              </div>
            </div>
          </div>
          <?php $touch_rule = explode(',', $data->touch_rule);?>
          <div class="form-group m-form__group row">
            <label class="col-lg-12" style="text-align: left;">
              Touch Rule :
            </label>
            <div class="col-lg-2">
              <div class="m-checkbox-inline">
                <label class="m-checkbox">
                  <input name="touch_rule[]" class="touch_rule" value="Xing" type="checkbox" @if(in_array("Xing", $touch_rule)) {{ 'checked' }} @endif>Xing<span></span>
                </label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="m-checkbox-inline">
                <label class="m-checkbox">
                  <input name="touch_rule[]" class="touch_rule" value="E-Mail" type="checkbox" @if(in_array("E-Mail", $touch_rule)) {{ 'checked' }} @endif>E-Mail<span></span>
                </label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="m-checkbox-inline">
                <label class="m-checkbox">
                  <input name="touch_rule[]" class="touch_rule" value="Phone" type="checkbox" @if(in_array("Phone", $touch_rule)) {{ 'checked' }} @endif>Phone<span></span>
                </label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="m-checkbox-inline">
                <label class="m-checkbox">
                  <input name="touch_rule[]" class="touch_rule" value="LinkedIn" type="checkbox" @if(in_array("LinkedIn", $touch_rule)) {{ 'checked' }} @endif>LinkedIn<span></span>
                </label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="m-checkbox-inline">
                <label class="m-checkbox">
                  <input name="touch_rule[]" class="touch_rule" value="ArticleSent" type="checkbox" @if(in_array("ArticleSent", $touch_rule)) {{ 'checked' }} @endif>ArticleSent<span></span>
                </label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="m-checkbox-inline">
                <label class="m-checkbox">
                  <input name="touch_rule[]" class="touch_rule" value="Meeting" type="checkbox" @if(in_array("Meeting", $touch_rule)) {{ 'checked' }} @endif>Meeting<span></span>
                </label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="m-checkbox-inline">
                <label class="m-checkbox">
                  <input name="touch_rule[]" class="touch_rule" value="Update " type="checkbox" @if(in_array("Update", $touch_rule)) {{ 'checked' }} @endif>Update <span></span>
                </label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="m-checkbox-inline">
                <label class="m-checkbox">
                  <input name="touch_rule[]" class="touch_rule" value="No Update " type="checkbox" @if(in_array("No Update", $touch_rule)) {{ 'checked' }} @endif>No Update <span></span>
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
          <div class="m-form__actions m-form__actions--solid">
            <div class="row">
              <div class="col-lg-4"></div>
              <div class="col-lg-8">
                <button type="submit" id="m_editcontact" name="m_editcontact" class="btn btn-primary">
                  Submit
                </button>
                <a class="btn btn-secondary" href="{{ url('/admin/contacts/view/'.$data->id) }}">
                  Cancel
                </a>
              </div>
            </div>
          </div>
        </div>
      </form>

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
  $(document).ready(function(){
    $('#contact_link').addClass('m-menu__item--active m-menu__item--expanded m-menu__item--open');
    $('#manager_link').addClass('m-menu__item--active');
    $('#m_editcontact').click(function(){
      $("#editContacts").validate({
        rules: {
          first_name: {
            required: true,
            minlength: 3
          },
          last_name: {
            required: true,
            minlength: 3
          },
          job_title: {
            required: {
              depends: function(element) {
                return $("#job_title").val() == '';
              }
            }
          },
          departement: {
            required: {
              depends: function(element) {
                return $("#departement").val() == '';
              }
            }
          },
          phone : {
            required : true,
            minlength : 10
          },
          country: {
            required: {
              depends: function(element) {
                return $("#country").val() == '';
              }
            }
          },
          mobile : {
            required : true,
            minlength : 10
          },
          email_id: {
            required : true,
            email : true
          },
          zipcode : "required"
        },
        submitHandler: function (form) {
          $('#m_editcontact').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
          $.ajax({
            url: '',
            type: "POST",
            data: $(form).serialize(),
            success: function(response, status, xhr, $form) {
              $('#m_editcontact').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
              var res = $.parseJSON(response);
              if(res.status == 'error'){
                swal('Error',res.message,'error');
              }
              else{
                swal('Success',res.message,'success');
                setTimeout(function() {
                  var referrer =  document.referrer;
                  $(location).attr("href", referrer);
                }, 2000);
              }
            },
            error: function(data){
              $('#m_editcontact').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

              var errors = data.responseJSON;
              $.each(errors, function(key, val){
                $('.'+key).show().html(val);
                $('.'+key).css('color','red');
              });
            }
          });
        }
      });
    });
  });
</script>
@endsection

<!DOCTYPE html>

<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Argon | Kunden
    </title>
@extends('layouts.admin_dashboard')
@section('content')
    @foreach ($details as $data)
    @endforeach
    <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <div id="navigation_next">
                <div id="previous">
                    @if($previous_count=='0')
                        <a href="#"
                           class="btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air"><i
                                    class="fa fa-angle-left"></i></a>
                    @else
                        <a href="{{url('admin/ad_accounts/view/'.$previous->id)}}"
                           class="btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air"><i
                                    class="fa fa-angle-left"></i></a>
                        <span style="color: #aaa;margin: 9px 19px;position: absolute;">{{$previous->account_name}}</span>
                    @endif
                </div>
                <div id="next">
                    @if($next_count=='0')
                        <a href="#"
                           class="btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air"><i
                                    class="fa fa-angle-right"></i></a>
                    @else
                        <span style="color: #aaa;margin: 9px -107px;position: absolute;">{{$next->account_name}}</span>
                        <a href="{{url('admin/ad_accounts/view/'.$next->id)}}"
                           class="btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air"><i
                                    class="fa fa-angle-right"></i></a>
                    @endif
                </div>
            </div>
            <!-- BEGIN: Subheader -->
            <div class="m-subheader">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-page-title ">
                            <a href="{{ url('/admin/ad_accounts')}}">View Kunden</a> / {{$data->account_name}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="sub_btn_header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto sub_btn" style="margin-left: 65%;">
                        <button id="m_quick_sidebar_toggle" class="btn btn-success m-dropdown__toggle">
                            <span>Add Comments</span>
                        </button>
                        @php $edit_kunden = '1'; $delete_kunden = '1'; if(Auth::user()->user_role!=1) { $kunden_role = explode(',', $permission->kunden_permission); if(in_array('edit', $kunden_role)){ $edit_kunden = '1';} else {$edit_kunden=0;} if(in_array('delete', $kunden_role)){ $delete_kunden = '1';} else {$delete_kunden=0;}}@endphp
                        @if($edit_kunden=='1')
                            <a href="{{ url('/admin/ad_accounts/edit/'.$data->id )}}" class="btn btn-primary">
                                <span>EDIT</span>
                            </a>
                        @endif
                        @if($delete_kunden=='1')
                            <button data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
                                <span>DELETE</span>
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
                                            Are you sure you wish to delete this Kunden and Related Records.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                        <button type="button" id="deleteAccount" data-id="{{$data->id}}"
                                                class="btn btn-danger">Delete
                                        </button>
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
                            <label class="font-weight-bold">Kundenname</label>
                        </div>
                        <div class="data_accounts">
                            <span>{{$data->account_name}}</span></div>
                    </div>
                    <div class="col-lg-5">
                        <div class="heading_details">
                            <label class="font-weight-bold">Prozesse</label></div>
                        <div class="data_accounts">
                            <span>{{$data->prozesse}}</span></div>
                    </div>
                </div>
                <div class="form-group m-form__group row view_data">
                    <div class="col-lg-5">
                        <div class="heading_details">
                            <label class="font-weight-bold">
                                Country
                            </label></div>
                        <div class="data_accounts">
                            <span>{{$data->country}}</span></div>
                    </div>
                    <div class="col-lg-5">
                        <div class="heading_details">
                            <label class="font-weight-bold">No of Freelancers</label>
                        </div>
                        <div class="data_accounts">
                            <span>{{$data->freelancers}}</span></div>
                    </div>
                </div>
                <div class="form-group m-form__group row view_data_row">
                    <div class="col-lg-5">
                        <div class="heading_details">
                            <label class="font-weight-bold">
                                Postcode
                            </label></div>
                        <div class="data_accounts">
                            <span>{{$data->pincode}}</span></div>
                    </div>
                    <div class="col-lg-5">
                        <div class="heading_details">
                            <label class="font-weight-bold">
                                Technological Focus
                            </label></div>
                        <div class="data_accounts">
                            <span>{{$data->Technology}}</span></div>
                    </div>
                </div>
                <div class="form-group m-form__group row view_data">
                    <div class="col-lg-5">
                        <div class="heading_details">
                            <label class="font-weight-bold">
                                Source
                            </label></div>
                        <div class="data_accounts">
                            <span>{{$data->source}}</span></div>
                    </div>
                    <div class="col-lg-5">
                        <div class="heading_details">
                            <label class="font-weight-bold">Size of IT Department</label>
                        </div>
                        <div class="data_accounts">
                            <span>{{$data->departement_size}}</span></div>
                    </div>
                </div>
                <div class="form-group m-form__group row view_data_row">
                    <div class="col-lg-5">
                        <div class="heading_details">
                            <label class="font-weight-bold">
                                Telephone
                            </label></div>
                        <div class="data_accounts">
                            <span>{{$data->telephone}}</span></div>
                    </div>
                    <div class="col-lg-5">
                        <div class="heading_details">
                            <label class="font-weight-bold">
                                Hotness of Client
                            </label></div>
                        <div class="data_accounts">
                            <span>{{$data->client_specification}}</span></div>
                    </div>
                </div>
                <div class="form-group m-form__group row view_data">
                    <div class="col-lg-5">
                        <div class="">
                            <label class="font-weight-bold">
                                General Notes
                            </label></div>
                        <div class="data_accounts">
                            <textarea class="form-control" id="general_notes" name="general_notes"
                                      rows=5>{{$data->comments}}</textarea>
                        </div>
                    </div>
                    <?php $touch_rule = explode(',', $data->touch_rule);?>
                    <div class="col-lg-7">
                        <div class="col-lg-12">
                            <label class="font-weight-bold">
                                7 Touch Rule
                            </label></div>
                        <div class="data_accounts col-lg-12">

                            <div class="m-checkbox-inline col-lg-6">
                                <label class="m-checkbox">
                                    <input name="touch_rule[]" class="touch_rule" value="Xing"
                                           type="checkbox" @if(in_array("Xing", $touch_rule)) {{ 'checked' }} @endif>Xing<span></span>
                                </label>
                            </div>
                            <div class="m-checkbox-inline col-lg-6" style="position: absolute;margin: -25px 77px;">
                                <label class="m-checkbox">
                                    <input name="touch_rule[]" class="touch_rule" value="E-Mail"
                                           type="checkbox" @if(in_array("E-Mail", $touch_rule)) {{ 'checked' }} @endif>E-Mail<span></span>
                                </label>
                            </div>
                            <div class="m-checkbox-inline col-lg-6" style="position: absolute;margin: -25px 157px;">
                                <label class="m-checkbox">
                                    <input name="touch_rule[]" class="touch_rule" value="Phone"
                                           type="checkbox" @if(in_array("Phone", $touch_rule)) {{ 'checked' }} @endif>Phone<span></span>
                                </label>
                            </div>
                            <div class="m-checkbox-inline col-lg-6" style="position: absolute;margin: -25px 250px;">
                                <label class="m-checkbox">
                                    <input name="touch_rule[]" class="touch_rule" value="LinkedIn"
                                           type="checkbox" @if(in_array("LinkedIn", $touch_rule)) {{ 'checked' }} @endif>LinkedIn<span></span>
                                </label>
                            </div>
                            <div class="m-checkbox-inline col-lg-6" style="position: absolute;margin: -25px 357px;">
                                <label class="m-checkbox">
                                    <input name="touch_rule[]" class="touch_rule" value="ArticleSent"
                                           type="checkbox" @if(in_array("ArticleSent", $touch_rule)) {{ 'checked' }} @endif>ArticleSent<span></span>
                                </label>
                            </div>
                            <div class="m-checkbox-inline col-lg-6" style="position: absolute;margin: -25px 480px;">
                                <label class="m-checkbox">
                                    <input name="touch_rule[]" class="touch_rule" value="Meeting"
                                           type="checkbox" @if(in_array("Meeting", $touch_rule)) {{ 'checked' }} @endif>Meeting<span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--rounded view_block">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <div class="panel-title">
                            <div class="title_header" style="float:none; width: 100%;">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#activity"
                                   aria-expanded="true" aria-controls="activity">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    <h4>Client Activity</h4>
                                </a>
                            </div>
                            <div class="loader" style='display: block;'>
                                <img src="../../../assets/app/media/img/logos/loader.gif" width='132px' height='132px'>
                            </div>
                        </div>
                    </div>
                    <div id="activity" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="comment_datatable" data-type="{{$data->id}}" id="local_data">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--rounded view_block">
                <div class="panel panel-default">
                    <div class="panel-heading row" role="tab" id="headingOne">
                        <div class="panel-title col-lg-12">
                            <div class="title_header">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#contacts"
                                   aria-expanded="true" aria-controls="contacts">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    <h4>Kontakte</h4>
                                </a>
                            </div>
                            @php $add_manager = '1'; if(Auth::user()->user_role!=1) { $manager_roles = explode(',', $permission->knotakte_permission); if(in_array('add', $manager_roles)){ $add_manager = '1';} else {$add_manager=0;}}@endphp
                            @if($add_manager=='1')
                                <div class="add_button">
                                    <button class="btn btn-primary m-btn m-btn--icon" data-toggle="modal"
                                            data-target="#addContactModal">
                        <span>
                        <i class="fa fa-plus"></i>
                        <span>
                          Add Kontakte
                        </span>
                        </span>
                                    </button>
                                </div>
                        @endif
                        <!-- <div class="loader" style='display: block;'>
                    <img src="../../../assets/app/media/img/logos/loader.gif" width='132px' height='132px'>
                  </div> -->
                        </div>
                    </div>
                    <div id="contacts" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <a id="showEmail" class="btn m-btn--pill btn-primary">
                        <span>
                          <i class="m-menu__link-icon flaticon-cogwheel-2"></i>
                          <span>
                            Show Email
                          </span>
                        </span>
                                </a>
                                <a id="showMobile" class="btn m-btn--pill btn-primary">
                        <span>
                          <i class="m-menu__link-icon flaticon-cogwheel-2"></i>
                          <span>
                            Show Mobile
                          </span>
                        </span>
                                </a>
                            </div>
                            <div class="contact_datatable col-lg-12" data-type="{{$data->id}}" id="local_data">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--rounded view_block">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <div class="panel-title">
                            <div class="title_header">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#tasks"
                                   aria-expanded="true" aria-controls="tasks">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    <h4>Tasks</h4>
                                </a>
                            </div>
                            @php $add_task = '1'; if(Auth::user()->user_role!=1) { $task_roles = explode(',', $permission->task_permission); if(in_array('add', $task_roles)){ $add_task = '1';} else {$add_task=0;}}@endphp
                            @if($add_task=='1')
                                <div class="add_button">
                                    <button class="btn btn-primary m-btn m-btn--icon" data-toggle="modal"
                                            data-target="#addtaskModal">
                        <span>
                        <i class="fa fa-plus"></i>
                        <span>
                          Add Task
                        </span>
                        </span>
                                    </button>
                                </div>
                            @endif
                            <div class="loader" style="display: block;">
                                <img src="../../../assets/app/media/img/logos/loader.gif" width='132px' height='132px'
                                     style="    height: 30px; width: 27px; margin-left: 40%;float: right; margin-top: -27px;">
                            </div>

                        </div>
                    </div>
                    <div id="tasks" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne"
                         style="clear:both;">
                        <div class="panel-body">
                            <div class="task_datatable" data-type="{{$data->id}}" id="local_data">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--rounded view_block">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <div class="panel-title">
                            <div class="title_header">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#opportunities"
                                   aria-expanded="true" aria-controls="opportunities">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    <h4>Projektanfragen</h4>
                                </a>
                            </div>
                            @php $add_oppo = '1'; if(Auth::user()->user_role!=1) { $opportunity_roles = explode(',', $permission->projektanfrage_permission); if(in_array('add', $opportunity_roles)){ $add_oppo = '1';} else {$add_oppo =0;}}@endphp
                            @if($add_oppo=='1')
                                <div class="add_button">
                                    <button class="btn btn-primary m-btn m-btn--icon" data-toggle="modal"
                                            data-target="#addOpportunityModal">
                        <span>
                        <i class="fa fa-plus"></i>
                        <span>
                          Add Projektanfragen
                        </span>
                        </span>
                                    </button>
                                </div>
                            @endif
                            <div class="loader" style='display: block;'>
                                <img src="../../../assets/app/media/img/logos/loader.gif" width='132px' height='132px'
                                     style="    height: 30px; width: 27px; margin-left: 40%;float: right; margin-top: -27px;">
                            </div>
                        </div>
                    </div>
                    <div id="opportunities" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne"
                         style="clear:both;">
                        <div class="panel-body">
                            <div class="opportunity_datatable" data-type="{{$data->id}}" id="local_data">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END: Subheader -->
        </div>
        </div>
        <!-- Add Contact Modal -->
        <div id="addContactModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                        <h4 class="modal-title">Add Contacts</h4>
                    </div>
                    <div class="modal-body">
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                              id="addContact" name="addContact">
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            First Name *:
                                        </label>
                                        <input type="hidden" value="{{$data->id}}" name="account_id" id="account_id">
                                        <input type="text" name="first_name" id="first_name"
                                               class="form-control m-input"
                                               placeholder="Enter First name Minimum 3 characters">
                                        <div class="error_msg">
                                            <span class="first_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Last Name *:
                                        </label>
                                        <input type="text" name="last_name" id="last_name" class="form-control m-input"
                                               placeholder="Enter Last name">
                                        <div class="error_msg">
                                            <span class="last_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Job Title *:
                                        </label>
                                        <select class="custom-select" id="job_title" name="job_title">
                                            <option value="">
                                                Please Select Job Title of Contact
                                            </option>
                                            <option value="Geschäftsführer">Geschäftsführer</option>
                                            <option value="CIO">CIO</option>
                                            <option value="IT Manager">IT Manager</option>
                                            <option value="IT Direktor">IT Direktor</option>
                                            <option value="IT Mitarbeiter">IT Mitarbeiter</option>
                                            <option value="HR Manager">HR Manager</option>
                                            <option value="HR Direktor">HR Direktor</option>
                                            <option value="HR Mitarbeite">HR Mitarbeite</option>
                                            <option value="Manager Einkauf">Manager Einkauf</option>
                                            <option value="Direktor Einkauf">Direktor Einkauf</option>
                                            <option value="Mitarbeiter Einkauf">Mitarbeiter Einkauf</option>
                                            <option value="Assistenz">Assistenz</option>
                                            <option value="Andere Abteilung">Andere Abteilung</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="job_title"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Department *:
                                        </label>
                                        <select class="custom-select" id="departement" name="departement">
                                            <option value="">
                                                Please Select Department of Contact
                                            </option>
                                            <option value="Geschäftsführung">Geschäftsführung</option>
                                            <option value="IT">IT</option>
                                            <option value="Einkauf">Einkauf</option>
                                            <option value="HR">HR</option>
                                            <option value="Andere Abteilung">Andere Abteilung</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="departement"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Phone *:
                                        </label>
                                        <input type="text" name="phone" id="phone" class="form-control m-input"
                                               placeholder="Enter Your Phone Omly Numeric">
                                        <div class="error_msg">
                                            <span class="phone"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Local Country *:
                                        </label>
                                        <select class="custom-select" name="country" id="country">
                                            <option value="">
                                                Please Select Country
                                            </option>
                                            @foreach($countries as $item)
                                                <option value="{{$item->name}}" @if($data->country == $item->name) {{ 'selected' }} @endif>{{$item->name}}</option>
                                            @endforeach
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
                                        <input type="text" name="mobile" id="mobile" class="form-control m-input"
                                               placeholder="Enter Your Mobile Number Only Numeric">
                                        <div class="error_msg">
                                            <span class="mobile"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Note :
                                        </label>
                                        <input type="text" name="note" id="note" class="form-control m-input"
                                               placeholder="Enter Your Note">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Email *:
                                        </label>
                                        <input type="text" name="email_id" id="email_id" class="form-control m-input"
                                               placeholder="Enter Your Email">
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
                                            <input type="checkbox" name="decision_maker" id="decision_maker"
                                                   data-toggle="toggle">

                                        </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Local City :
                                        </label>
                                        <input type="text" value="{{$data->city}}" name="city" id="city"
                                               class="form-control m-input" placeholder="Enter Your City">
                                        <div class="error_msg">
                                            <span class="city"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Local Zipcode *:
                                        </label>
                                        <input type="text" value="{{$data->pincode}}" name="zipcode" id="zipcode"
                                               class="form-control m-input" placeholder="Enter Your Zipcode">
                                        <div class="error_msg">
                                            <span class="zipcode"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-8">
                                            <button type="submit" id="m_login_signin_submit"
                                                    name="m_login_signin_submit" class="btn btn-primary">
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
        <!--     ADD Task Model-->
        <div id="addtaskModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                        <h4 class="modal-title">Add Task</h4>
                    </div>
                    <div class="modal-body">
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                              id="addTask" name="addTask">
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Task Date *:
                                        </label>
                                        <input type="hidden" value="{{$data->id}}" name="account_id" id="account_id">
                                        <input type="text" name="task_date" id="task_date" class="form-control m-input"
                                               placeholder="Enter Task date">
                                        <div class="error_msg">
                                            <span class="task_date"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="Priority">
                                            Priority Of Task *:
                                        </label>
                                        <select class="custom-select" id="task_priority" name="task_priority">
                                            <option value="">
                                                Please Select Priority of Task
                                            </option>
                                            <option value="Low">Low</option>
                                            <option value="Medium">Medium</option>
                                            <option value="High">High</option>
                                            <option value="Really High">Really High</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="task_priority"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="Status">
                                            Status Of Task *:
                                        </label>
                                        <select class="custom-select" id="task_status" name="task_status">
                                            <option value="">
                                                Please Select Status of Task
                                            </option>
                                            <option value="Waiting">Waiting</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="task_status"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label for="Type">
                                            Type Of Task *:
                                        </label>
                                        <select class="custom-select" id="task_type" name="task_type">
                                            <option value="">
                                                Please Select Type of Task
                                            </option>
                                            @foreach($task_type as $item)
                                                <option value="{{$item}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                        <div class="error_msg">
                                            <span class="task_type"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="Priority">
                                            Owner Of Task *:
                                        </label>
                                        <select class="custom-select" id="task_owner" name="task_owner">
                                            <option value="">
                                                Please Select Owner of Task
                                            </option>
                                            @foreach($users as $item)
                                                <option value="{{$item->id}}">{{$item->first_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="error_msg">
                                            <span class="task_owner"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Description :
                                        </label>
                                        <textarea class="form-control m-input m-input--air" name="description"
                                                  id="description" rows="3"></textarea>
                                        <div class="error_msg">
                                            <span class="description"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-8">
                                            <button type="submit" id="m_submit_task" name="m_submit_task"
                                                    class="btn btn-primary">
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

        <!-- Add Opportunity Model-->
        <div id="addOpportunityModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                        <h4 class="modal-title">Add Opportunity</h4>
                    </div>
                    <div class="modal-body">
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                              id="addOpportunity" name="addOpportunity">
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Opportunity Name *:
                                        </label>
                                        <input type="hidden" value="{{$data->id}}" name="account_id" id="account_id">
                                        <input type="text" name="name" id="name" class="form-control m-input"
                                               placeholder="Enter Opportunity name">
                                        <div class="error_msg">
                                            <span class="name"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Closed Date *:
                                        </label>
                                        <input type="text" name="close_date" id="close_date"
                                               class="form-control m-input" placeholder="Enter Closed Date">
                                        <div class="error_msg">
                                            <span class="close_date"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Select Probability *:
                                        </label>
                                        <select class="custom-select" id="probability" name="probability">
                                            <option value="">
                                                Please Select Probability Of Opportunity
                                            </option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="75">75</option>
                                            <option value="100">100</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="probability"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Hotness of Client*:
                                        </label>
                                        <select class="custom-select" id="hotness" name="hotness">
                                            <option value="">
                                                Please Select Client Specification
                                            </option>
                                            <option value="1" @if($data->client_specification == '1') {{ 'selected' }} @endif>
                                                1
                                            </option>
                                            <option value="2" @if($data->client_specification == '2') {{ 'selected' }} @endif>
                                                2
                                            </option>
                                            <option value="3" @if($data->client_specification == '3') {{ 'selected' }} @endif>
                                                3
                                            </option>
                                            <option value="4" @if($data->client_specification == '4') {{ 'selected' }} @endif>
                                                4
                                            </option>
                                            <option value="5" @if($data->client_specification == '5') {{ 'selected' }} @endif>
                                                5
                                            </option>
                                            <option value="6" @if($data->client_specification == '6') {{ 'selected' }} @endif>
                                                6
                                            </option>
                                            <option value="7" @if($data->client_specification == '7') {{ 'selected' }} @endif>
                                                7
                                            </option>
                                            <option value="8" @if($data->client_specification == '8') {{ 'selected' }} @endif>
                                                8
                                            </option>
                                            <option value="9" @if($data->client_specification == '9') {{ 'selected' }} @endif>
                                                9
                                            </option>
                                            <option value="10" @if($data->client_specification == '10') {{ 'selected' }} @endif>
                                                10
                                            </option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="hotness"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Source of Opportunity*:
                                        </label>
                                        <select class="custom-select" id="source" name="source">
                                            <option value="">
                                                Please Select Source
                                            </option>
                                            <option value="Advertisement">Advertisement</option>
                                            <option value="Email">Email</option>
                                            <option value="Mailshot">Mailshot</option>
                                            <option value="Pay Per Click">Pay Per Click</option>
                                            <option value="Press">Press</option>
                                            <option value="Referral">Referral</option>
                                            <option value="Social">Social</option>
                                            <option value="Telephone">Telephone</option>
                                            <option value="Web Search">Web Search</option>
                                            <option value="Web site">Web site</option>
                                            <option value="Word of Mouth">Word of Mouth</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="source"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Technology *:
                                        </label>
                                        <select class="custom-select" id="technology" name="technology">
                                            <option value="">
                                                Please Select Technology
                                            </option>
                                            <option value="Microsoft .Net">Microsoft .Net</option>
                                            <option value="Java">Java</option>
                                            <option value="SAP">SAP</option>
                                            <option value="PHP">PHP</option>
                                            <option value="NSI">NSI</option>
                                            <option value="Embedded">Embedded</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="technology"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Client Name *:
                                        </label>
                                        <input type="text" value="{{$data->account_name}}" name="client_name"
                                               id="client_name" class="form-control m-input"
                                               placeholder="Enter Opportunity name">
                                        <div class="error_msg">
                                            <span class="client_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Client Telephone Number *:
                                        </label>
                                        <input type="text" value="{{$data->telephone}}" name="client_number"
                                               id="client_number" class="form-control m-input"
                                               placeholder="Enter Opportunity name">
                                        <div class="error_msg">
                                            <span class="client_number"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Info Field :
                                        </label>
                                        <input type="text" name="info_field" id="info_field"
                                               class="form-control m-input" placeholder="Enter Opportunity name">
                                        <div class="error_msg">
                                            <span class="info_field"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Outcome Of Opportunity :
                                        </label>
                                        <textarea class="form-control m-input m-input--air" name="report" id="report"
                                                  rows="3"></textarea>
                                        <div class="error_msg">
                                            <span class="report"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Permanent Opportunity:
                                        </label>
                                        <input type="checkbox" name="opportunity_type" id="opportunity_type"
                                               data-toggle="toggle">
                                        <div class="error_msg">
                                            <span class="opportunity_type"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Active Opportunity :
                                        </label>
                                        <input type="checkbox" name="opportunity_status" id="opportunity_status"
                                               data-toggle="toggle">
                                        <div class="error_msg">
                                            <span class="opportunity_status"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-8">
                                            <button type="submit" id="m_login_signin_submit"
                                                    name="m_login_signin_submit" class="btn btn-primary">
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
        <!-- deleteCommentModal -->
        <div id="EditComment" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 50%;">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Edit Comment</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="comment_id" id="comment_id"/>
                        {{csrf_field()}}
                        <label>Comments* : </label>
                        <textarea class="form-control" id="comment_area_edit" name="comment_area_edit"
                                  rows="5"></textarea>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" id="editComment" class="btn btn-info">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End  -->
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
                        <h3>Leave Comment To Client</h3><br>
                        <input type="hidden" id="auth_id" value="{{Auth::id()}}">
                        <input type="hidden" id="account_ids">
                    </li>
                    <li>
                        <label for="user_name">
                            Manager :
                        </label>
                        <select class="form-control" id="user_name" name="user_name">
                            <option value="">Please Select Manager Name</option>
                            @foreach($contacts as $item)
                                <option value="{{$item->id}}">{{$item->first_name.' '.$item->last_name}}</option>
                            @endforeach
                        </select><br>
                    </li>

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

        <!-- end:: Body -->

        <!-- begin::Quick Sidebar -->
        <div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
            <div class="m-quick-sidebar__content m--hide">
        <span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
          <i class="la la-close"></i>
        </span>
                <ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
                </ul>
            </div>
        </div>
        <!-- end::Quick Sidebar -->
        <!-- begin::Scroll Top -->
        <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
             data-scroll-speed="300">
            <i class="la la-arrow-up"></i>
        </div>
        <!-- end::Scroll Top -->
    @endsection
    @section('js')
        <script src="{{url('assets/demo/default/custom/components/datatables/base/view-admin_account.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('/js/admin_accounts_script.js')}}" type="text/javascript"></script>
        <script>
            // $('#admin_account_link').addClass('m-menu__item--active');
            var datatable;
            var id = $('#deleteAccount').attr('data-id');
            edit_contact_url = '../../contacts/edit';

            (function () {
                $('.loader_msg').css('display', 'none');
                datatable = $('.contact_datatable').mDatatable({
                    // datasource definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: '../../../admin/ad_accounts/ContactsDetails/' + id,
                                method: 'GET',
                                // custom headers
                                headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                                params: {
                                    // custom query params
                                    query: {
                                        generalSearch: '',
                                    }
                                },
                                map: function (raw) {
                                    console.log('ITS RUN');
                                    console.log(raw);
                                    // sample data mapping
                                    var dataSet = raw;
                                    if (typeof raw.data !== 'undefined') {
                                        dataSet = raw.data;
                                    }
                                    console.log('Result');
                                    console.log(dataSet);
                                    return dataSet;
                                },
                            }
                        },
                        pageSize: 10,
                        saveState: {
                            cookie: false,
                            webstorage: false
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

                    pagination: false,

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
                        width: 30
                    },
                        {
                            field: "first_name,last_name",
                            title: "Name",
                            template: function (row) {
                                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                                if (row.permission.admin == 'admin') {
                                    return '\
                      <div >\
                        <a title="Edit this Contact" href="' + edit_contact_url + '/' + row.id + '">' + row.first_name + '  <span>' + row.last_name + '</span></a>\
                      </div>\
                      ';
                                }
                                var knotakte_permission = row.permission.knotakte_permission;
                                var knotakte_permission = knotakte_permission.split(',');
                                //alert(task_permission);
                                if ($.inArray('edit', knotakte_permission) != '-1') {
                                    return '\
                      <div >\
                        <a title="Edit this Contact" href="' + edit_contact_url + '/' + row.id + '">' + row.first_name + '  <span>' + row.last_name + '</span></a>\
                      </div>\
                      ';
                                }
                                else {
                                    return '\
                      <div >\
                        <a title="No Permission for Edit this Contact">' + row.first_name + '  <span>' + row.last_name + '</span></a>\
                      </div>\
                      ';
                                }
                            }
                        },
                        {
                            field: "job_title",
                            title: "Job Title",
                            width: 120
                        },
                        {
                            field: "account_name",
                            title: "Kunden Name",
                            width: 110
                        },
                        {
                            field: "departement",
                            title: "Departement",
                            width: 200,
                        },
                        {
                            field: "email_id",
                            title: "Email Id",
                            width: 200,
                            responsive: {hidden: 'lg'}
                        },
                        {
                            field: "mobile",
                            title: "Mobile Number",
                            responsive: {hidden: 'lg'}
                        }]
                });
                var query = datatable.getDataSourceQuery();

                var query = datatable.getDataSourceQuery();

                $('#m_form_status').on('change', function () {
                    datatable.search($(this).val(), 'Status');
                }).val(typeof query.Status !== 'undefined' ? query.Status : '');
                $('#showEmail').on('click', function () {
                    datatable.showColumn('email_id');
                });
                $('#showMobile').on('click', function () {
                    datatable.showColumn('mobile');
                });
                $('#m_form_type').on('change', function () {
                    datatable.search($(this).val(), 'Type');
                }).val(typeof query.Type !== 'undefined' ? query.Type : '');

                $('#m_form_status, #m_form_type').selectpicker();
            })();

            function deleteComment(id) {
                swal({
                        title: "Are you sure to delete this Comment?",
                        text: "Your will not be able to recover this Comment!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false,
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            var del_id = id;
                            var account_id = $('#account_id').val();
                            url = '../deleteComment';
                            $.ajax({
                                url: url + '/' + account_id + '/' + id,
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

            $('.m-checkbox input[type=checkbox]').on('click', function () {
                var id = $('#deleteAccount').attr('data-id');
                if (this.checked) {
                    var value = $(this).val();
                    $.ajax({
                        url: '../../ad_accounts/touch_rule_add',
                        data: {value: value, id: id},
                        Type: 'GET',
                        success: function (response) {
                        }
                    });
                }
                else {
                    var value = $(this).val();
                    $.ajax({
                        url: '../../ad_accounts/touch_rule_remove',
                        data: {value: value, id: id},
                        Type: 'GET',
                        success: function (response) {
                        }
                    });
                }
            });
        </script>
@endsection

<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Argon | Freelancers
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

                        @if(empty($previous->skill_id))
                            <a href="{{url('admin/add/skills/'.$previous->id.'/'.$list)}}"
                               class="btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air"><i
                                        class="fa fa-angle-left"></i></a>
                            <span style="color: #aaa;margin: 9px 19px;position: absolute;">{{$previous->first_name}} {{$previous->last_name}}</span>
                        @else
                            <a href="{{url('admin/edit/skills/'.$previous->skill_id.'/'.$list)}}"
                               class="btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air"><i
                                        class="fa fa-angle-left"></i></a>
                            <span style="color: #aaa;margin: 9px 19px;position: absolute;">{{$previous->first_name}} {{$previous->last_name}}</span>
                        @endif

                    @endif
                </div>
                <div id="next">
                    @if($next_count=='0')
                        <a href="#"
                           class="btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air"><i
                                    class="fa fa-angle-right"></i></a>
                    @else

                        @if(empty($next->skill_id))
                            <span style="color: #aaa;margin: 9px -163px;position: absolute;">{{$next->first_name}} {{$next->last_name}}</span>
                            <a href="{{url('admin/add/skills/'.$next->id.'/'.$list)}}"
                               class="btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air"><i
                                        class="fa fa-angle-right"></i></a>
                        @else
                            <span style="color: #aaa;margin: 9px -163px;position: absolute;">{{$next->first_name}} {{$next->last_name}}</span>
                            <a href="{{url('admin/edit/skills/'.$next->skill_id.'/'.$list)}}"
                               class="btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air"><i
                                        class="fa fa-angle-right"></i></a>
                        @endif

                    @endif
                </div>
            </div>

            <!-- BEGIN: Subheader -->

            <div class="m-subheader">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-page-title ">
                            <a href="{{ url('/admin/freelancers')}}">Edit Kandidate Skills</a>
                        </h3>
                    </div>
                </div>
            </div>
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                     style="display: block; padding: 10px; margin:27px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <p class="message">
                        {{session('message')}}
                    </p>
                </div>@endif
            <div class="sub_btn_header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto sub_btn">
                        <button data-toggle="modal" data-target="#attachdoc" class="btn btn-primary">
                            <span>Attach DOC</span>
                        </button>

                        @php $delete_freelancer = '1'; if(Auth::user()->user_role!=1) { $free_role = explode(',', $permission->kandidaten_permission); if(in_array('delete', $free_role)){ $delete_freelancer = '1';} else {$delete_freelancer=0;}}@endphp
                        @if($delete_freelancer=='1')
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
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                        <button type="button" id="deleteFreelancer" data-id="{{$data->user_id}}"
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
                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                      id="editFreelancer" name="editFreelancer">
                    {{ csrf_field() }}
                    <div class="m-portlet__body">
                        @if($data->admin_doc)
                            <div class="form-group m-form__group row view_data">
                                <div class="col-lg-6">
                                    <div class="heading_details">
                                        <label>Documents Attached</label>
                                    </div>
                                    <div class="data_accounts">
                                        <a title="Download Contact"
                                           href="../../../storage/app/admin/{{$data->admin_doc}}"
                                           download>{{$data->admin_doc}}</span></a>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endif

                    <div class="form-group m-form__group row view_data_row">
                        <div class="col-lg-6">
                            <label>
                                Title:
                            </label>
                            <select class="form-control m-input" name="freelancer_title" id="freelancer_title">
                                <option>Herr</option>
                                <option>Frau</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group m-form__group row view_data_row">
                        <div class="col-lg-6">
                            <label>
                                Freelancer First Name*:
                            </label>
                            <input type="hidden" value="{{$data->user_id}}" name="freelancer_id" id="freelancer_id">
                            <input type="text" value="{{$data->first_name}}" name="freelancer_name" id="freelancer_name"
                                   class="form-control m-input" placeholder="Enter Freelancer First Name">
                            <div class="error_msg">
                                <span class="freelancer_name"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label>
                                Freelancer Last Name*:
                            </label>
                            <input type="hidden" value="{{$data->user_id}}" name="freelancer_id" id="freelancer_id">
                            <input type="text" value="{{$data->last_name}}" name="freelancer_last_name"
                                   id="freelancer_last_name" class="form-control m-input"
                                   placeholder="Enter Freelancer Last Name">
                            <div class="error_msg">
                                <span class="freelancer_last_name"></span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group m-form__group row view_data_row">
                        <div class="col-lg-6">
                            <label>
                                Email ID*:
                            </label>
                            <input type="text" value="{{$data->email}}" name="freelancer_email" id="freelancer_email"
                                   class="form-control m-input" placeholder="Enter Freelancer Email Id">
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
                            <input type="text" value="{{$data->Mobile}}" name="freelancer_mobile" id="freelancer_mobile"
                                   class="form-control m-input" placeholder="Enter Mobile Number">
                            <div class="error_msg">
                                <span class="freelancer_mobile"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row view_data_row">
                        <div class="col-lg-6">
                            <label>
                                Home Number:
                            </label>
                            <input type="text" value="{{$data->home_number}}" name="freelancer_home"
                                   id="freelancer_home" class="form-control m-input" placeholder="Enter Home Number">
                            <div class="error_msg">
                                <span class="freelancer_home"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-form__group row view_data_row">
                        <div class="col-lg-6">
                            <label>
                                Postal Code:
                            </label>
                            <input type="text" name="postal_code" id="postal_code" class="form-control m-input"
                                   value="{{$data->postal_code}}" placeholder="Enter Postal Code">
                            <div class="error_msg">
                                <span class="postal_code"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">CV Received</font></font></label>
                        <div class="col-lg-6">
                            <div class="m-radio-inline col-lg-6">
                                <label class="m-radio m-radio--solid">
                                    <input name="cv_recieved" value="1"
                                           type="radio" @if($data->cv_recieved == '1') {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Yes
                                        </font></font><span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input name="cv_recieved" value="0"
                                           type="radio" @if($data->cv_recieved == '0') {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> No
                                        </font></font><span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">References</font></font></label>
                        <div class="col-lg-6">
                            <div class="m-radio-inline col-lg-6">
                                <label class="m-radio m-radio--solid">
                                    <input name="reference" value="1"
                                           type="radio" @if($data->reference == '1') {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Yes
                                        </font></font><span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input name="reference" value="0"
                                           type="radio" @if($data->reference == '0') {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> No
                                        </font></font><span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" id="reference_form"
                         style="@if($data->reference == '1') {{ 'display: block;' }} @else {{ 'display: none;' }} @endif">
                        <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">References Details</font></font></label>
                        <div class="col-lg-6 ref_input">
                            <input type="text" name="client_name" id="client_name" class="form-control m-input"
                                   placeholder="Enter Client name" value="{{$data->client_name}}">
                            <input type="text" name="manager_name" id="manager_name" class="form-control m-input"
                                   placeholder="Enter Manager Name" value="{{$data->manager_name}}">
                            <input type="text" name="reference_mobile" id="reference_mobile"
                                   class="form-control m-input" placeholder="Enter Mobile Number"
                                   value="{{$data->reference_mobile}}">
                            <input type="text" name="info_field" id="info_field" class="form-control m-input"
                                   placeholder="Enter Information Of Reference" value="{{$data->info_field}}">
                        </div>
                    </div>
                    @php $hourly_rate = explode(',', $data->hourly_rate);@endphp
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Stundensatz</font></font></label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input name="hourly_rate[]" class="hourly_rate" value="1"
                                           type="checkbox" @if(in_array("1", $hourly_rate)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">50-60
                                            €
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="hourly_rate[]" class="hourly_rate" value="2"
                                           type="checkbox" @if(in_array("2", $hourly_rate)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">60-70
                                            €
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="hourly_rate[]" class="hourly_rate" value="3"
                                           type="checkbox" @if(in_array("3", $hourly_rate)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">70-80
                                            €
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="hourly_rate[]" class="hourly_rate" value="4"
                                           type="checkbox" @if(in_array("4", $hourly_rate)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">80-90
                                            €
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="hourly_rate[]" class="hourly_rate" value="5"
                                           type="checkbox" @if(in_array("5", $hourly_rate)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">90-100
                                            €
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="hourly_rate[]" class="hourly_rate" value="6"
                                           type="checkbox" @if(in_array("6", $hourly_rate)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">100-110
                                            €
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="hourly_rate[]" class="hourly_rate" value="7"
                                           type="checkbox" @if(in_array("7", $hourly_rate)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">110-120
                                            €
                                        </font></font><span></span>
                                </label>
                                <div id="hourly_rate_msg"></div>
                            </div>
                        </div>
                    </div>
                    @php $role_definition = explode(',', $data->role_definition);@endphp
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Rollendefinition</font></font></label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="1"
                                           type="checkbox" @if(in_array("1", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Entwickler
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="2"
                                           type="checkbox" @if(in_array("2", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Architekt
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="3"
                                           type="checkbox" @if(in_array("3", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Support
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="4"
                                           type="checkbox" @if(in_array("4", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Projektmanager
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="5"
                                           type="checkbox" @if(in_array("5", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Berater
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="6"
                                           type="checkbox" @if(in_array("6", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Administrator
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="7"
                                           type="checkbox" @if(in_array("7", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">SCRUM
                                            Master
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="8"
                                           type="checkbox" @if(in_array("8", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tester
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="9"
                                           type="checkbox" @if(in_array("9", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Test
                                            Manager
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="10"
                                           type="checkbox" @if(in_array("10", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hardware
                                            Entwickler
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="11"
                                           type="checkbox" @if(in_array("11", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Web
                                            Developer
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="12"
                                           type="checkbox" @if(in_array("12", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Security
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="13"
                                           type="checkbox" @if(in_array("13", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Frontend
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_roles[]" class="freelancer_roles" value="14"
                                           type="checkbox" @if(in_array("14", $role_definition)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Backend
                                        </font></font><span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Available from</font></font></label>
                        <div class="col-lg-6">
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--solid">
                                    <input name="part_or_full_time" value="1"
                                           type="radio" @if($data->availability == '1') {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            Full Time
                                        </font></font><span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input name="part_or_full_time" value="0"
                                           type="radio" @if($data->availability == '0') {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            Part Time
                                        </font></font><span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input name="part_or_full_time" value="2"
                                           type="radio" @if($data->availability == '2') {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Not
                                            Available
                                        </font></font><span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Availability per week</font></font></label>
                        <div class="col-lg-6">
                            <div class="input-group date" id="m_datepicker_3" style="width: 56%;">
                                <input class="form-control m-input" readonly="" type="text" name="availability_date"
                                       value="@if($data->availability_date) {{ date('m/d/Y', strtotime($data->availability_date)) }} @endif">
                                <span class="input-group-addon">
                    <i class="la la-calendar"></i>
                    </span>
                            </div>
                            @php $availability_per_week = explode(',', $data->availability_per_week);@endphp
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input name="availabile_days[]" class="availabile_days" value="1"
                                           type="checkbox" @if(in_array("1", $availability_per_week)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 1
                                            Tag
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="availabile_days[]" class="availabile_days" value="2"
                                           type="checkbox" @if(in_array("2", $availability_per_week)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 2
                                            Tage
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="availabile_days[]" class="availabile_days" value="3"
                                           type="checkbox" @if(in_array("3", $availability_per_week)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 3
                                            Tage
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="availabile_days[]" class="availabile_days" value="4"
                                           type="checkbox" @if(in_array("4", $availability_per_week)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 4
                                            Tage
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="availabile_days[]" class="availabile_days" value="5"
                                           type="checkbox" @if(in_array("5", $availability_per_week)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 5
                                            Tage
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="availabile_days[]" class="availabile_days" value="6"
                                           type="checkbox" @if(in_array("6", $availability_per_week)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            Update
                                        </font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="availabile_days[]" class="availabile_days" value="7"
                                           type="checkbox" @if(in_array("7", $availability_per_week)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> No
                                            Update
                                        </font></font><span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    @php $travelling = explode(',', $data->travelling);@endphp
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Traveling</font></font></label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input name="can_travel_to_germany[]" class="can_travel_to_germany" value="1"
                                           type="checkbox" @if(in_array("1", $travelling)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Weltweit</font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="can_travel_to_germany[]" class="can_travel_to_germany" value="2"
                                           type="checkbox" @if(in_array("2", $travelling)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Europaweit</font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="can_travel_to_germany[]" class="can_travel_to_germany" value="3"
                                           type="checkbox" @if(in_array("3", $travelling)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Deutschlandweit</font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="can_travel_to_germany[]" class="can_travel_to_germany" value="4"
                                           type="checkbox" @if(in_array("4", $travelling)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Bundesland</font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="can_travel_to_germany[]" class="can_travel_to_germany" value="5"
                                           type="checkbox" @if(in_array("5", $travelling)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Stadt</font></font><span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Possible Extension</font></font></label>
                        <div class="col-lg-6">
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--solid">
                                    <input name="possible_extension" value="1"
                                           type="radio" @if($data->possible_extension == '1') {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Yes
                                        </font></font><span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input name="possible_extension" value="0"
                                           type="radio" @if($data->possible_extension == '0') {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> No
                                        </font></font><span></span>
                                </label>
                                <input type="text" name="extension_text" id="extension_text"
                                       class="form-control m-input" placeholder="Enter Extension Details"
                                       style="@if($data->possible_extension == '1') {{ 'display: block;width:56%' }} @else {{ 'display: none;width:56%;' }} @endif"
                                       value="{{$data->extension_text}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Other Interviews and
                                    Offers</font></font></label>
                        <div class="col-lg-6">
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--solid">
                                    <input name="other_interview" value="1"
                                           type="radio" @if($data->other_interview == '1') {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Yes
                                        </font></font><span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input name="other_interview" value="0"
                                           type="radio" @if($data->other_interview == '0') {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> No
                                        </font></font><span></span>
                                </label>
                                <input type="text" name="comment_area_text" id="comment_area_text"
                                       class="form-control m-input" placeholder="Enter Details of Interview and Offer"
                                       style="@if($data->other_interview == '1') {{ 'display: block;width:56%' }} @else {{ 'display: none;width:56%;' }} @endif"
                                       pattern="[0-9]+" value="{{$data->comment_area_text}}">
                            </div>
                        </div>
                    </div>
                    @php $freelancer_source = explode(',', $data->source); @endphp
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Source Of Freelancer</font></font></label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input name="freelancer_source[]" value="Xing"
                                           type="checkbox" @if(in_array("Xing", $freelancer_source)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit;">Xing</font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_source[]" value="Linkedin"
                                           type="checkbox" @if(in_array("Linkedin", $freelancer_source)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Linkedin</font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_source[]" value="Freelancer.de"
                                           type="checkbox" @if(in_array("Freelancer.de", $freelancer_source)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Freelance.de</font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_source[]" value="Word of Mouth"
                                           type="checkbox" @if(in_array("Word of Mouth", $freelancer_source)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Word
                                            of Mouth</font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_source[]" value="References"
                                           type="checkbox" @if(in_array("References", $freelancer_source)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">References</font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_source[]" value="Suggestion"
                                           type="checkbox" @if(in_array("Suggestion", $freelancer_source)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Suggestion</font></font><span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input name="freelancer_source[]" value="Internet and Website"
                                           type="checkbox" @if(in_array("Internet and Website", $freelancer_source)) {{ 'checked' }} @endif><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Internet
                                            and Website</font></font><span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    @php
                        $category_skills = explode(',', $data->category_skills);
                        $category1_rating = explode(',', $data->competences_skill_category_1);
                        $category2_rating = explode(',', $data->competences_skill_category_2);
                        $category3_rating = explode(',', $data->competences_skill_category_3);
                        $category4_rating = explode(',', $data->competences_skill_category_4);
                        $category5_rating = explode(',', $data->competences_skill_category_5);
                        $category6_rating = explode(',', $data->competences_skill_category_6);
                        $category7_rating = explode(',', $data->competences_skill_category_7);
                        $category8_rating = explode(',', $data->competences_skill_category_8);
                        $core_competences = explode(',', $data->core_competences);@endphp
                    <div class="form-group m-form__group row">
                        <label class="col-lg-12 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;"><h4>Competences</h4></font></font></label>
                        <div class="col-lg-12">
                            <div class="panel-group" id="accordion">
                                @foreach($competences as $competences_val)
                                    <div class="panel panel-default">
                                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion"
                                             href="#category{{$competences_val->keys}}" style="cursor: pointer;">
                                            <div class="panel-title">
                                                <a class="m-tabs__link" role="tab"><font
                                                            style="vertical-align: inherit;"><font
                                                                style="vertical-align: inherit;">{{$competences_val->name}}</font></font></a>
                                            </div>
                                        </div>

                                        <div id="category{{$competences_val->keys}}" class="panel-collapse">
                                            <div class="panel-body">
                                                <div class="m-checkbox-inline">
                                                    @foreach($competences_val->competences_skill as $key => $competences_skill)

                                                        <label class="m-checkbox ItDoubleCheck">
                                                            <input name="category_skills[]" id="sigle_checked"
                                                                   class="sigle_checked"
                                                                   value="{{$competences_skill->id}}"
                                                                   type="checkbox" @if(in_array($competences_skill->id,$category_skills)) {{ 'checked' }} @endif>
                                                            {{$competences_skill->skill}}<span
                                                                    class="msinglecheck"></span>

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
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">General Notes</font></font></label>
                        <div class="col-lg-10">
                            <textarea class="form-control m-input" id="general_notes" name="general_notes"
                                      rows="3">{{$data->general_notes}}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-lg-12">
                            <div class="panel-group" id="accordion1">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion1"
                                         href="#core_competences" style="cursor: pointer;">
                                        <div class="panel-title">
                                            <a class="m-tabs__link" role="tab"><font
                                                        style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">Core
                                                        Competences</font></font></a>
                                        </div>
                                    </div>

                                    <div id="core_competences" class="panel-collapse">
                                        <div class="panel-body">
                                            <div class="m-checkbox-inline core_checkbox">
                                            @php if($data->core_competences != '') { $core_competences = explode(',', $data->core_competences); @endphp
                                            <!-- <label class="m-checkbox">
                              </label> -->
                                                @foreach($core_competences as $key => $core_competences)
                                                    <label class="m-checkbox">
                                                        <input name="core_category[]" value="{{$core_competences}}"
                                                               type="checkbox" checked><span
                                                                class="text_competence"></span>
                                                    </label>
                                                @endforeach
                                                @php } @endphp
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-8">
                                    <button type="submit" id="m_edit_skills" name="m_edit_skills"
                                            class="btn btn-primary">
                                        Edit Skills
                                    </button>
                                    <a class="btn btn-secondary" href="{{ url('/admin/freelancers') }}">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
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
                            <form method="post" action="{{url('admin/freelancer/upload/'.$data->skill_id.'/'.$list)}}"
                                  name="upload_file" id="upload_file" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <input type="hidden" name="users_id" id="users_id" value="{{$data->user_id}}">

                                Select file : <input type='file' name='attach_doc' id='attach_doc' class='form-control'
                                                     required=""><br>
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
                    <ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand comment_div"
                        role="tablist">
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
            <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
                 data-scroll-speed="300">
                <i class="la la-arrow-up"></i>
            </div>
            <!-- </div> -->
            <!-- end::Scroll Top -->
            @endsection
            @section('js')
                <script src="{{url('assets/demo/default/custom/components/datatables/base/data_skills.js')}}"
                        type="text/javascript"></script>
                <script type="text/javascript">
                    $('#contact_link').addClass('m-menu__item--active m-menu__item--expanded m-menu__item--open');
                    $('#freelancer_link').addClass('m-menu__item--active');
                    $('footer').css({"margin": "0px", "position": "absolute"});
                </script>
                <script type="text/javascript">
                    $('input[name="other_interview"]').click(function () {
                        if ($(this).val() == '1') {
                            $('#comment_area_text').show();
                        }
                        else {
                            $('#comment_area_text').hide();
                        }
                    });
                    $('input[name="reference"]').click(function () {
                        if ($(this).val() == '1') {
                            $('#reference_form').show();
                        }
                        else {
                            $('#reference_form').hide();
                        }
                    });
                    $('input[name="possible_extension"]').click(function () {
                        if ($(this).val() == '1') {
                            $('#extension_text').show();
                        }
                        else {
                            $('#extension_text').hide();
                        }
                    });
                    // $(document).ready(function(){
                    //    $('#accordion .ItDoubleCheck').on('dblclick',function(e){
                    //        $(this).find('.msinglecheck').addClass('temp');
                    //        $(this).find('.msinglecheck').click();
                    //        $(this).find('.mdoublecheck').show();
                    //        $(this).find('.msinglecheck').show();
                    //        $(this).find('#sigle_checked').attr('checked','checked');

                    //        console.log('Double');
                    //    });
                    //    $('#accordion .ItDoubleCheck').on('click',function(e){
                    //        if($(this).find('.msinglecheck').hasClass('temp')){
                    //          $(this).find('.msinglecheck').removeClass('temp');
                    //        }else{
                    //           $(this).find('#sigle_checked').attr('checked','checked');
                    //          $(this).find('.mdoublecheck').hide();
                    //          $(this).find('.msinglecheck').show();
                    //        }
                    //        console.log('Single');
                    //    });
                    //    var numberOfChecked = $('#accordion input:checkbox:checked').length;
                    //    alert(numberOfChecked);
                    //    if(numberOfChecked>5)
                    //    {
                    //        swal('Error','Please Select Core Competences Only 5','error');
                    //        return false;
                    //    }
                    //  });
                    $('#accordion input[type=checkbox]').on('click', function () {
                        if (this.checked) {
                            //$(this).parent('label.m-checkbox').eq(0).css('color','Red');
                            var competence_text = $(this).parent('label.m-checkbox').eq(0).text();
                            $('.core_checkbox').append('<label class="m-checkbox"><input name="core_category[]"  value="' + $(this).val() + '" type="checkbox">' + competence_text + '<span></span></label>');
                        } else {
                            //$(this).parent('label.m-checkbox').eq(0).css('color','');
                            $('#core_competences input[value=' + $(this).val() + ']').eq(0).parent('label').last().remove();
                        }
                    });
                    var core_array = [];
                    $('#core_competences input[type=checkbox]').each(function (val) {
                        $(this).parent('label').append($('#accordion input[value=' + $(this).val() + ']').eq(0).parent('label').text());
                        core_array.push($(this).val());
                    });

                    $('#accordion input:checkbox:checked').each(function (val) {
                        var skill_value = $(this).val();
                        if ($.inArray(skill_value, core_array) == '-1') {
                            var competence_text = $(this).parent('label.m-checkbox').eq(0).text();
                            $('.core_checkbox').append('<label class="m-checkbox"><input name="core_category[]"  value="' + $(this).val() + '" type="checkbox">' + competence_text + '<span></span></label>');
                        }
                    });
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

                    #accordion1 .panel-default .panel-heading a {
                        color: #fff;
                    }

                    #accordion1 .panel-default .panel-heading {
                        background-color: #5757f3;
                        border-top-left-radius: 3px;
                        border-top-right-radius: 3px;
                        padding: 10px 15px;
                        margin: 0 0 3px;
                    }

                    .ref_input input {
                        margin-top: 10px;
                    }

                    /*.m-checkbox > input:checked ~ span.mdoublecheck:after {
                    top: 60%;
                    }
                    .m-checkbox > input:checked ~ span.msinglecheck:after {
                      top: 33%;
                    }*/

                </style>
@endsection

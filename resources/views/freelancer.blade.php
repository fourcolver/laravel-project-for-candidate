@extends('layouts.dashboard')
@section('content')
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
    </style>

    <div class="m-content">

        <div class="row">
            @if (session('image_error'))
                <div class="col-xl-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                         style="display: block; padding: 10px; margin:27px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        <p class="message">
                            {{session('image_error')}}
                        </p>
                    </div>
                </div>
            @endif
            @if (session('image_success'))
                <div class="col-xl-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                         style="display: block; padding: 10px; margin:27px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        <p class="message">
                            {{session('image_success')}}
                        </p>
                    </div>
                </div>
            @endif
            <div class="col-lg-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
								<i class="la la-gear"></i>
								</span>
                                <h3 class="m-portlet__head-text"><font style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit;">
                                            Stundensatz, Verfügbarkeit und Technischer Fokus
                                        </font></font></h3>
                            </div>
                        </div>
                    </div>
                    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                          id="create_competences" name="create_competences" method="post">
                        {{ csrf_field() }}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit;">CV Received</font></font></label>
                                <div class="col-lg-6">
                                    <div class="m-radio-inline col-lg-6">
                                        <label class="m-radio m-radio--solid">
                                            <input name="cv_recieved" value="1" type="radio"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> Yes
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-radio m-radio--solid">
                                            <input name="cv_recieved" value="0" type="radio" checked><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> No
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
                                            <input name="reference" value="1" type="radio"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> Yes
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-radio m-radio--solid">
                                            <input name="reference" value="0" type="radio" checked><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> No
                                                </font></font><span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row" id="reference_form" style="display: none;">
                                <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit;">References
                                            Details</font></font></label>
                                <div class="col-lg-6 ref_input">
                                    <input type="text" name="client_name" id="client_name" class="form-control m-input"
                                           placeholder="Enter Client name">
                                    <input type="text" name="manager_name" id="manager_name"
                                           class="form-control m-input" placeholder="Enter Manager Name">
                                    <input type="text" name="reference_mobile" id="reference_mobile"
                                           class="form-control m-input" placeholder="Enter Mobile Number">
                                    <input type="text" name="info_field" id="info_field" class="form-control m-input"
                                           placeholder="Enter Information Of Reference">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit;">Stundensatz</font></font></label>
                                <div class="col-lg-6">
                                    <div class="m-checkbox-inline">
                                        <label class="m-checkbox">
                                            <input name="hourly_rate[]" class="hourly_rate" value="1"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">50-60 €
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="hourly_rate[]" class="hourly_rate" value="2"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">60-70 €
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="hourly_rate[]" class="hourly_rate" value="3"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">70-80 €
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="hourly_rate[]" class="hourly_rate" value="4"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">80-90 €
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="hourly_rate[]" class="hourly_rate" value="5"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">90-100 €
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="hourly_rate[]" class="hourly_rate" value="6"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">100-110 €
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="hourly_rate[]" class="hourly_rate" value="7"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">110-120 €
                                                </font></font><span></span>
                                        </label>
                                        <div id="hourly_rate_msg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit;">Rollendefinition</font></font></label>
                                <div class="col-lg-6">
                                    <div class="m-checkbox-inline">
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="1"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Entwickler
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="2"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Architekt
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="3"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Support
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="4"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Projektmanager
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="5"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Berater
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="6"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Administrator
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="7"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">SCRUM Master
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="8"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Tester
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="9"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Test Manager
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="10"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Hardware Entwickler
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="11"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Web Developer
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="12"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Security
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="13"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Frontend
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_roles[]" class="freelancer_roles" value="14"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Backend
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
                                            <input name="part_or_full_time" value="1" type="radio" checked=""><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> Full Time
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-radio m-radio--solid">
                                            <input name="part_or_full_time" value="0" type="radio"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> Part Time
                                                </font></font><span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit;">Availability per
                                            week</font></font></label>
                                <div class="col-lg-6">
                                    <div class="input-group date" id="m_datepicker_3" style="width: 56%;">
                                        <input class="form-control m-input" readonly="" type="text"
                                               name="availability_date" required>
                                        <span class="input-group-addon">
                    <i class="la la-calendar"></i>
                    </span>
                                    </div>
                                    <div class="m-checkbox-inline">
                                        <label class="m-checkbox">
                                            <input name="availabile_days[]" class="availabile_days" value="1"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> 1 Tag
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="availabile_days[]" class="availabile_days" value="2"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> 2 Tage
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="availabile_days[]" class="availabile_days" value="3"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> 3 Tage
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="availabile_days[]" class="availabile_days" value="4"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> 4 Tage
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="availabile_days[]" class="availabile_days" value="5"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> 5 Tage
                                                </font></font><span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit;">Traveling</font></font></label>
                                <div class="col-lg-6">
                                    <div class="m-checkbox-inline">
                                        <label class="m-checkbox">
                                            <input name="can_travel_to_germany[]" value="1" type="checkbox"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Weltweit</font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="can_travel_to_germany[]" value="2" type="checkbox"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Europaweit</font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="can_travel_to_germany[]" checked value="3"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Deutschlandweit</font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="can_travel_to_germany[]" value="4" type="checkbox"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Bundesland</font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="can_travel_to_germany[]" value="5" type="checkbox"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Stadt</font></font><span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit;">Possible
                                            Extension</font></font></label>
                                <div class="col-lg-6">
                                    <div class="m-radio-inline">
                                        <label class="m-radio m-radio--solid">
                                            <input name="possible_extension" value="1" type="radio"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> Yes
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-radio m-radio--solid">
                                            <input name="possible_extension" value="0" type="radio" checked><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> No
                                                </font></font><span></span>
                                        </label>
                                        <input type="text" name="extension_text" id="extension_text"
                                               class="form-control m-input" placeholder="Enter Extension Details"
                                               style="display: none;width:56%;">
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
                                            <input name="other_interview" value="1" type="radio"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> Yes
                                                </font></font><span></span>
                                        </label>
                                        <label class="m-radio m-radio--solid">
                                            <input name="other_interview" value="0" type="radio" checked><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;"> No
                                                </font></font><span></span>
                                        </label>
                                        <input type="text" name="comment_area_text" id="comment_area_text"
                                               class="form-control m-input"
                                               placeholder="Enter Details of Interview and Offer"
                                               style="display: none;width:56%;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit;">Source Of
                                            Freelancer</font></font></label>
                                <div class="col-lg-6">
                                    <div class="m-checkbox-inline">
                                        <label class="m-checkbox">
                                            <input name="freelancer_source[]" value="Xing" type="checkbox"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Xing</font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_source[]" value="Linkedin" type="checkbox"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Linkedin</font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_source[]" value="Freelancer.de"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Freelancer.de</font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_source[]" value="Word of Mouth"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Word of
                                                    Mouth</font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_source[]" value="References" type="checkbox"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">References</font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_source[]" value="Suggestion" type="checkbox"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Suggestion</font></font><span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input name="freelancer_source[]" value="Internet and Website"
                                                   type="checkbox"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Internet and
                                                    Website</font></font><span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-12 col-form-label text-left"><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Competences</font></font></label>
                                <div class="col-lg-12">
                                    <div class="panel-group" id="accordion">
                                        @if(!empty($competences) )
                                            @foreach($competences as $competences_val)
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" data-toggle="collapse"
                                                         data-parent="#accordion" href="#category{{$competences_val->keys}}"
                                                         style="cursor: pointer;">
                                                        <div class="panel-title">
                                                            <a class="m-tabs__link" role="tab"><font
                                                                        style="vertical-align: inherit;"><font
                                                                            style="vertical-align: inherit;">{{$competences_val->name}}</font></font></a>
                                                        </div>
                                                    </div>
                                                    <div id="category{{$competences_val->keys}}"
                                                         class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="m-checkbox-inline">
                                                                @foreach($competences_val->competences_skill as $key => $competences_skill)
                                                                    <label class="m-checkbox">
                                                                        <input name="category_skills[]"
                                                                               value="{{$competences_skill->id}}"
                                                                               type="checkbox"><font
                                                                                style="vertical-align: inherit;"><font
                                                                                    style="vertical-align: inherit;">{{$competences_skill->skill}}</font></font><span></span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label text-left"><font style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit;">General Notes</font></font></label>
                                <div class="col-lg-10">
                                    <textarea class="form-control m-input" id="general_notes" name="general_notes"
                                              rows="3"></textarea>
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

                                            <div id="core_competences" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="m-checkbox-inline core_checkbox">

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
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <button type="submit" id="addfreelancerdata" name="addfreelancerdata"
                                                    class="btn btn-brand"
                                                    data_id="@if(!empty(Session::get('freelancer_id'))){{Session::get('freelancer_id')}}@endif">
                                                <font><font>Add Competence</font></font></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('js')
        <!-- <script src="{{url('assets/demo/default/custom/components/datatables/base/data_skills.js')}}" type="text/javascript"></script> -->
            <script type="text/javascript">
                $('#contact_link').addClass('m-menu__item--active m-menu__item--expanded m-menu__item--open');
                $('#freelancer_link').addClass('m-menu__item--active');
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
                // var category = ["1", "2", "3","4","5","6","7","8"];
                // $.each(category, function(key,val) {
                //     $('input[name="category'+val+'_rating[]"]').click(function(){
                //     alert($('input[name="category'+val+'_rating[]"] p').val());
                //     $('.core_checkbox').append('<label class="m-checkbox"><input name="core_category[]"  value="'+$(this).val()+'" type="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">asdasd</font></font><span></span></label>');
                //     });
                // });
                $('#accordion input[type=checkbox]').on('click', function () {
                    if (this.checked) {
                        //$(this).parent('label.m-checkbox').eq(0).css('color','Red');
                        var competence_text = $(this).parent('label.m-checkbox').eq(0).text();
                        $('.core_checkbox').append('<label class="m-checkbox"><input name="core_category[]"  value="' + $(this).val() + '" type="checkbox">' + competence_text + '<span></span></label>');
                    }
                    else {
                        //$(this).parent('label.m-checkbox').eq(0).css('color','');
                        $('#core_competences input[value=' + $(this).val() + ']').eq(0).parent('label').last().remove();
                    }
                });

                $('#core_competences input[type=checkbox]').each(function (val) {
                    $(this).parent('label').append($('#accordion input[value=' + $(this).val() + ']').eq(0).parent('label').text());
                });

            </script>
@endsection
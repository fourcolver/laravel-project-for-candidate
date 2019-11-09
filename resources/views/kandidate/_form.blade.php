{{ csrf_field() }}
<style>
    .has-error input {
        border-color: red;
    }
    .has-error .help-block {
        color: red;
    }
</style>
<div class="m-portlet__body">
    @if(Auth::user()->isAdmin)
        <div class="form-group m-form__group row">
            <label class="col-lg-4 col-form-label text-left"><font
                        style="vertical-align: inherit;"><font style="vertical-align: inherit;">Is confirmed?</font></font></label>
            <div class="col-lg-6">
                <div class="m-radio-inline">
                    <label class="m-radio m-radio--solid">
                        <input name="is_confirmed" value="1" type="radio" {{$candidate->is_confirmed || !$candidate->id ? 'checked' : ''}}><font
                                style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                Yes
                            </font></font><span></span>
                    </label>
                    <label class="m-radio m-radio--solid">
                        <input name="is_confirmed" value="0" type="radio" {{!$candidate->is_confirmed ? 'checked' : ''}}><font
                                style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                No
                            </font></font><span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-lg-4 col-form-label text-left"><font
                        style="vertical-align: inherit;"><font style="vertical-align: inherit;">Is active?</font></font></label>
            <div class="col-lg-6">
                <div class="m-radio-inline">
                    <label class="m-radio m-radio--solid">
                        <input name="is_approved" value="1" type="radio" {{$candidate->is_active || !$candidate->id ? 'checked' : ''}}><font
                                style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                Yes
                            </font></font><span></span>
                    </label>
                    <label class="m-radio m-radio--solid">
                        <input name="is_approved" value="0" type="radio" {{!$candidate->is_active ? 'checked' : ''}}><font
                                style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                No
                            </font></font><span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group m-form__group row{{ $errors->has('number') ? ' has-error' : '' }}" id="reference_form">
            <label class="col-lg-4 col-form-label text-left">
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Number</font></font>
            </label>
            <div class="col-lg-4 ref_input">
                <input type="number" name="number" id="number" class="form-control m-input"
                       placeholder="Enter Client Number" value="{{$candidate->number}}" required autofocus>
                @if ($errors->has('number'))
                    <span class="help-block">
                   <strong>{{ $errors->first('number') }}</strong>
               </span>
                @endif
            </div>
            <div class="col-lg-2 ref_input">
                <input type="text" name="first_name" id="first_name" class="form-control m-input"
                       placeholder="Name" value="{{$candidate->first_name}}" required>
            </div>
            <div class="col-lg-2 ref_input">
                <input type="text" name="optional_interview" id=optional_interviewfirst_name" class="form-control m-input"
                       placeholder="Unverbindliches Interview" value="{{$candidate->optional_interview}}">
            </div>
        </div>
    @endif
    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left">Picture</label>
        <div class="col-lg-6">
            <div class="m-radio-inline col-lg-6">
                <input type="file" name="picture" id="" accept=".png,.jpeg,.jpg,.bmp,.gif">
                @if(!empty($candidate->picture))
                    <br><a href="/public/uploads/{{$candidate->picture}}">Download</a>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">CV</font></font></label>
        <div class="col-lg-6">
            <div class="m-radio-inline col-lg-6">
                <input type="file" name="attached_cv" id="" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">
                @if(!empty($candidate->attached_cv))
                    <br><a href="/public/uploads/{{$candidate->attached_cv}}">Download</a>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row" id="reference_form">
        <label class="col-lg-4 col-form-label text-left">
            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">References Details</font></font>
        </label>
        <div class="col-lg-6 ref_input">
            <input type="text" name="client_name" id="client_name" class="form-control m-input"
                   placeholder="Enter Client Name" value="{{$candidate->client_name}}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Gehaltsvorstellung</font></font></label>
        <div class="col-lg-6">
            <?php $rates = ['20-30 K', '30-40 K', '40-50 K', '50-60 K', '60-70 K', '70-80 K', '80-90','90-100', '100-110', '110-120', '120+ K']; ?>
            <div class="m-checkbox-inline">
                @foreach($rates as $i => $rate)
                    <label class="m-checkbox">
                        <input name="hourly_rate[]" class="hourly_rate" value="{{$i+1}}" type="checkbox"
                        {{in_array($i+1, explode(',', $candidate->hourly_rate)) ? 'checked' : ''}}>
                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$rate}}</font></font>
                        <span></span>
                    </label>
                @endforeach
                <div id="hourly_rate_msg"></div>
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Rollendefinition</font></font></label>
        <div class="col-lg-6">
            <?php $roles = ['Entwickler', 'Architekt', 'Support', 'Projektmanager', 'Berater', 'Administrator', 'SCRUM Master', 'Tester', 'Test Manager', 'Hardware Entwickler', 'Web Developer', 'Security', 'Frontend', 'Backend']; ?>
            <div class="m-checkbox-inline">
                @foreach($roles as $i => $role)
                <label class="m-checkbox">
                    <input name="freelancer_roles[]" class="freelancer_roles" value="{{$i+1}}"
                           {{in_array($i+1, explode(',', $candidate->role_definition)) ? 'checked' : ''}}
                           type="checkbox"><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;"> {{$role}}
                        </font></font><span></span>
                </label>
                @endforeach
            </div>
        </div>
    </div>
<!--     <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ausbildung, Universität und Abschlüsse </font></font></label>
        <div class="col-lg-6">
            <div class="m-checkbox-inline">
                @foreach(\App\Kandidate::EDUCATION_ITEMS as $i => $value)
                <label class="m-checkbox">
                    <input name="education[]" class="availabile_days" value="{{$i}}"
                           {{$candidate->educationList->contains($i) ? 'checked' : ''}}
                           type="checkbox"><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;"> {{$value}}
                        </font></font><span></span>
                </label>
                @endforeach
            </div>
        </div>
    </div> -->

    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sprachkenntnisse (Deutsch) </font></font></label>
        <div class="col-lg-6">
<!--             <div class="input-group date" id="m_datepicker_3" style="width: 56%; display: none;">
                <input class="form-control m-input" readonly="" type="text"
                       name="availability_date">
                <span class="input-group-addon">
                    <i class="la la-calendar"></i>
                    </span>
            </div> -->
            <?php $availability = array("1" => "A1", "2" => "A2", "3" => "B1", "4" => "B2", "5" => "C1", "6" => "C2",);
            ?>
            <div class="m-checkbox-inline">
                @foreach($availability as $i => $day)
                <label class="m-checkbox">
                    <input name="availabile_days[]" class="availabile_days" value="{{$i}}"
                           {{in_array($i, explode(',', $candidate->availability_per_week)) ? 'checked' : ''}}
                           type="checkbox"><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;"> {{$day}}
                        </font></font><span></span>
                </label>
                @endforeach
            </div>
        </div>
    </div>

    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sprachkenntnisse (Englisch)</font></font></label>
        <div class="col-lg-6">
<!--             <div class="input-group date" id="m_datepicker_3" style="width: 56%; display: none;">
                <input class="form-control m-input" readonly="" type="text"
                       name="availability_date">
                <span class="input-group-addon">
                    <i class="la la-calendar"></i>
                    </span>
            </div> -->
            <?php $availability = array("1" => "A1", "2" => "A2", "3" => "B1", "4" => "B2", "5" => "C1", "6" => "C2",);
            ?>
            <div class="m-checkbox-inline">
                @foreach($availability as $i => $day)
                <label class="m-checkbox">
                    <input name="availabile_days_en[]" class="availabile_days" value="{{$i}}"
                           {{in_array($i, explode(',', $candidate->availabile_days_en)) ? 'checked' : ''}}
                           type="checkbox"><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;"> {{$day}}
                        </font></font><span></span>
                </label>
                @endforeach
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Möglicher Einsatzort</font></font></label>
        <div class="col-lg-6">
            @php $travelling = explode(',', $candidate->travelling);@endphp
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
                <div style="@if(in_array("4", $travelling)) display: inline-block; @else display: none;  @endif  width: 215px; margin-right: 15px;">
                    <select name="traveling_state[]" multiple id="traveling_state" class="form-control m-select2 select2-hidden-accessible">
                        <option value=""></option>
                        @foreach(config('app.states') as $state)
                            <option {{in_array($state, explode(',', $candidate->traveling_state)) ? 'selected' : ''}}>{{$state}}</option>
                        @endforeach
                    </select>
                </div>
                <label class="m-checkbox">
                    <input name="can_travel_to_germany[]" class="can_travel_to_germany" value="5"
                           type="checkbox" @if(in_array("5", $travelling)) {{ 'checked' }} @endif><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Stadt</font></font><span></span>
                </label>
                <div style="@if(in_array("5", $travelling)) display: inline-block; @else display: none;  @endif  width: 215px;margin-right: 15px;">
                    <select name="traveling_city[]" multiple id="traveling_city" class="form-control m-select2 select2-hidden-accessible">
                        <option value=""></option>
                        @foreach(config('app.cities') as $city)
                            <option {{in_array($city, explode(',', $candidate->traveling_city)) ? 'selected' : ''}}>{{$city}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Video</font></font></label>
        <div class="col-lg-6">
            <div class="m-radio-inline">
                <label class="m-radio m-radio--solid">
                    <input name="video" value="1" type="radio" {{$candidate->video ? 'checked' : ''}}><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            Yes
                        </font></font><span></span>
                </label>
                <label class="m-radio m-radio--solid">
                    <input name="video" value="0" type="radio" {{$candidate->video ? '' : 'checked'}}><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            No
                        </font></font><span></span>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Kündigungsfrist</font></font></label>
        <div class="col-lg-6">
            <div class="m-radio-inline">
                <label class="m-radio m-radio--solid">
                    <input name="possible_extension" value="1"
                           type="radio" {{$candidate->possible_extension ? 'checked' : ''}}><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            Yes
                        </font></font><span></span>
                </label>
                <label class="m-radio m-radio--solid">
                    <input name="possible_extension" value="0"
                           type="radio" {{!$candidate->possible_extension ? 'checked' : ''}}><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            No
                        </font></font><span></span>
                </label>
                <input type="text" name="extension_text" id="extension_text"
                       class="form-control m-input" placeholder="Enter Details"
                       style="@if($candidate->possible_extension == '1') {{ 'display: block;width:56%' }} @else {{ 'display: none;width:56%;' }} @endif"
                       value="{{$candidate->extension_text}}">
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Other
                    Interviews and Offers</font></font></label>
        <div class="col-lg-6">
            <div class="m-radio-inline">
                <label class="m-radio m-radio--solid">
                    <input name="other_interview" value="1"
                           type="radio" @if($candidate->other_interview == '1') {{ 'checked' }} @endif><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            Yes
                        </font></font><span></span>
                </label>
                <label class="m-radio m-radio--solid">
                    <input name="other_interview" value="0"
                           type="radio" @if($candidate->other_interview != 1) {{ 'checked' }} @endif><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            No
                        </font></font><span></span>
                </label>
                <input type="text" name="comment_area_text" id="comment_area_text"
                       class="form-control m-input"
                       placeholder="Enter Details of Interview and Offer"
                       style="@if($candidate->other_interview == '1') {{ 'display: block;width:56%' }} @else {{ 'display: none;width:56%;' }} @endif"
                       pattern="[0-9]+" value="{{$candidate->comment_area_text}}">
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Competences</font></font></label>
        <div class="col-lg-6">
            <select class="form-control m-select2" id="competence-skill" name="category_skills[]"
                    multiple>
                @foreach($competences as $competence)
                    <optgroup label="{{$competence->name}}">
                        @foreach ($competence->competences_skill as $skill)
                            <option {{in_array($skill->id, explode(',', $candidate->category_skills)) ? 'selected' : ''}} value="{{$skill->id}}">{{$skill->skill}}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-lg-2 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">General
                    Notes</font></font></label>
        <div class="col-lg-10">
                                <textarea class="form-control m-input" id="general_notes" name="general_notes"
                                          rows="3">{{$candidate->general_notes}}</textarea>
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
                                            style="vertical-align: inherit;">Core Competencesssss</font></font></a>
                        </div>
                    </div>

                    <div id="core_competences" class="panel-collapse collapse show">
                        <div class="panel-body">
                            <div class="m-checkbox-inline core_checkbox">
                                @foreach($competences as $competence)
                                    @foreach ($competence->competences_skill as $skill)
                                        @if(in_array($skill->id, explode(',', $candidate->category_skills)))
                                        <label class="m-checkbox">
                                            <input name="core_category[]"  value="{{$skill->id}}" type="checkbox"
                                                   {{in_array($skill->id, explode(',', $candidate->core_competences)) ? 'checked' : ''}}>{{$skill->skill}}<span></span>
                                        </label>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
    <div class="form-group m-form__group row">
        <div class="col-lg-12 box-container-title"><h2>Berufserfahrung</h2></div>
    </div>
    <div class="content_experience">
        @foreach($candidate_experience as $row)
            <div class="display-flex col-lg-12" id="show_id_{{$row->id}}">
                <div class="box-container">
                    <div class="hf">
                        <div class="sector">{{\App\Kandidate::WORK_EXPERIENCE_SECTORS[$row->experience_sector]}}</div>                 
                        <div class="period">{{$row->experience_end}}</div> 
                        <div class="period">~</div> 
                        <div class="period">{{$row->experience_start}}</div> 
                    </div>
                    <div class="com-name">{{$row->experience_company}}</div>
                    <div class="exp-position">@php $roles = \App\Kandidate::ROLES; @endphp
                    {{isset($roles[$row->experience_postion]) ? $roles[$row->experience_postion] : ''}}</div>
                    <div class="prof-experience">
                        <ui class="list-style ui-margin">
                            @foreach($competences as $competence)
                                @foreach ($competence->competences_skill as $skill)
                                    @if(in_array($skill->id, explode(',', $row->skills_with_work)))
                                        <li class="li-margin">{{$skill->skill}}<li>
                                    @endif
                                @endforeach
                            @endforeach
                        </ui>
                    </div>
                    <div class="prof-experience">{{$row->experience_description}}</div>
                </div>
                <div class="btn_place">
                    <div class="w-100">
                        <button type="button" class="btn btn-light btn-edit id_btn_edit" id="edit_btn_{{$row->id}}"><i class="fa fa-edit"></i></button>
                    </div>
                    <div class="w-100">
                        <button type="button" class="btn btn-light btn-edit id_btn_trash" id="trash_btn_{{$row->id}}"><i class="fa fa-trash"></i></button>
                    </div>
                </div>            
            </div>


            <!--input tag after click-->    
            <div class="form-experience box-container" id="modal_id_{{$row->id}}">
                <div class="form-group m-form__group row">
                    <label class="col-lg-4 col-form-label text-left"><font>Sector</font></label>
                    <div class="col-lg-6">
                        <select class="form-control" name="work_experience_sector_{{$row->id}}">
                            @foreach(\App\Kandidate::WORK_EXPERIENCE_SECTORS as $id => $sector)
                                <option {{$id == $row->experience_sector ? 'selected' : ''}} value="{{$id}}">{{$sector}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label text-left">From</label>
                    <div class="col-lg-4">
                        <div class="m-radio-inline col-lg-12">
                            <input type="text" name="work_start_{{$row->id}}" class="form-control form-control-1 input-sm from" placeholder="CheckIn" value="{{$row->experience_start}}">
                        </div>
                    </div>
                    <label class="col-lg-1 col-form-label text-left">To</label>
                    <div class="col-lg-4">
                        <div class="m-radio-inline col-lg-12">
                            <input type="text" name="work_end_{{$row->id}}" class="form-control form-control-1 input-sm from" placeholder="CheckIn" value="{{$row->experience_end}}">
                        </div>
                    </div>
                    
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-4 col-form-label text-left">Name of Company</label>
                    <div class="col-lg-6">
                        <div class="m-radio-inline col-lg-6">
                            <input type="text" class="form-control" name="work_experience_company_name_{{$row->id}}" value="{{$row->experience_company}}">
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-lg-4 col-form-label text-left">Position</label>
                    <div class="col-lg-6">
                        <div class="m-radio-inline col-lg-6">
                            <select class="form-control" name="work_experience_position_{{$row->id}}">
                                @foreach(\App\Kandidate::ROLES as $id => $role)
                                    <option {{$id == $candidate->work_experience_position ? 'selected' : ''}} value="{{$id}}">{{$role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-4 col-form-label text-left"><font>Abilities used in this assignment</font></label>
                    <div class="col-lg-6" id="competence-skill-work-{{$row->id}}">
                        <select class="form-control m-select2" name="category_skillers_{{$row->id}}" multiple>
                            @foreach($competences as $competence)
                                <optgroup label="{{$competence->name}}">
                                    @foreach ($competence->competences_skill as $skill)
                                        <option {{in_array($skill->id, explode(',', $row->skills_with_work)) ? 'selected' : ''}} value="{{$skill->id}}">{{$skill->skill}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-4 col-form-label text-left">Description of position</label>
                    <div class="col-lg-6">
                        <div class="m-radio-inline col-lg-6">
                            <textarea class="form-control m-input" name="work_experience_position_description_{{$row->id}}"
                                      rows="3">{{$row->experience_description}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <input type="hidden" name="input_experience_{{$row->id}}" value="{{$candidate->id}}">
                    <button type="button" class="btn btn-light btn-edit"><i id="closeIcon{{$row->id}}" class="fa fa-window-close fa-window-close-work"></i></button>
                    <button type="button" class="btn btn-light btn-edit"><i id="checkIcon{{$row->id}}" class="fa fa-check-circle fa-check-circle-work"></i></button>          
                </div>
            </div>        
        @endforeach
        <form></form>

        <!-- add new work experience with form submit-->
        <div class='add-form-container box-container d-none'>
            <form class="add-form-work" method="post" action="/admin/add_experience/{{$candidate->id}}">
                {{ csrf_field() }}
                <div class='form-group m-form__group row'>
                    <label class='col-lg-4 col-form-label text-left'><font>Sector</font></label>
                    <div class='col-lg-6'>
                        <select class='form-control' name='work_exp_sector'>
                            @foreach(\App\Kandidate::WORK_EXPERIENCE_SECTORS as $id => $sector)
                                <option value='{{$id}}'>{{$sector}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class='form-group m-form__group row'>
                    <label class='col-lg-2 col-form-label text-left'>From</label>
                    <div class='col-lg-4'>
                        <div class='m-radio-inline col-lg-12'>
                            <input type="text" name="work_start" class="form-control form-control-1 input-sm from" placeholder="CheckIn" value="">
                        </div>
                    </div>
                    <label class='col-lg-1 col-form-label text-left'>To</label>
                    <div class='col-lg-4'>
                        <div class='m-radio-inline col-lg-12'>
                            <input type="text" name="work_end" class="form-control form-control-1 input-sm from" placeholder="CheckIn" value="">
                        </div>
                    </div>
                </div>
                <div class='form-group m-form__group row'>
                    <label class='col-lg-4 col-form-label text-left'>Name of Company</label>
                    <div class='col-lg-6'>
                        <div class='m-radio-inline col-lg-6'>
                            <input type='text' class='form-control' name='work_exp_company_name' value=''>
                        </div>
                    </div>
                </div>
                <div class='form-group m-form__group row'>
                    <label class='col-lg-4 col-form-label text-left'>Position</label>
                    <div class='col-lg-6'>
                        <div class='m-radio-inline col-lg-6'>
                            <select class='form-control' name='work_exp_position'>
                                @foreach(\App\Kandidate::ROLES as $id => $role)
                                <option value='{{$id}}'>{{$role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-lg-4 col-form-label text-left"><font>Abilities used in this assignment</font></label>
                    <div class="col-lg-6" id="competence-skill-work">
                        <select class="form-control m-select2" name="category_skillers[]" multiple>
                            @foreach($competences as $competence)
                                <optgroup label="{{$competence->name}}">
                                    @foreach ($competence->competences_skill as $skill)
                                        <option value="{{$skill->id}}">{{$skill->skill}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class='form-group m-form__group row'>
                    <label class='col-lg-4 col-form-label text-left'>Description of position</label>
                    <div class='col-lg-6'>
                        <div class='m-radio-inline col-lg-6'>
                            <textarea class='form-control m-input' name='work_exp_pos_description' rows='3'></textarea>
                        </div>
                    </div>
                </div>
                <div class='text-right'>
                    <input type='hidden' name='input_experience'>
                    <button type='button' class='btn btn-light btn-work-close'><i class='fa fa-window-close'></i></button>
                    <button type='button' class='btn btn-light btn-work-add'><i class='fa fa-check-circle'></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center">
        <input type="hidden" name="get_last_work" value="">
        <button type="button" id="add_new_{{$candidate->id}}" class="btn btn-primary btn-addNew-work">Add new experience</button>
    </div>

<!--education begin-->
    <div class="form-group m-form__group row">
        <div class="col-lg-12 box-container-title"><h2>Education, university and degreesg</h2></div>
    </div>

    <div class="education_experience">
        @foreach($candidate_education as $row)
        <div class="display-flex col-lg-12" id="show_id_edu_{{$row->id}}">
            <div class="box-container">
                <div class="hf">
                    <div class="sector">{{$row->graduation}}</div>                 
                    <div class="period">{{$row->education_end}}</div> 
                    <div class="period">~</div> 
                    <div class="period">{{$row->education_start}}</div> 
                </div>       
                <div class="com-name">@php $facility = \App\Kandidate::EDUCATION_ITEMS; @endphp {{isset($facility[$row->training_facility]) ? $facility[$row->training_facility] : ""}}</div>
                <div class="prof-experience">{{$row->description}}</div>
            </div>
            <div class="btn_place">
                <div class="w-100">
                    <button type="button" class="btn btn-light btn-edit id_btn_edit_edu" id="edit_btn_{{$row->id}}"><i class="fa fa-edit"></i></button>
                </div>
                <div class="w-100">
                    <button type="button" class="btn btn-light btn-edit id_btn_trash_edu" id="trash_btn_{{$row->id}}"><i class="fa fa-trash"></i></button>
                </div>
            </div>            
        </div>

                
        <!--input tag after click-->   


        <div class="form-experience box-container" id="modal_id_edu_{{$row->id}}">
            <div class="form-group m-form__group row">
                <label class="col-lg-4 col-form-label text-left">Graduation</label>
                <div class="col-lg-6">
                    <div class="m-radio-inline col-lg-6">
                        <input type="text" class="form-control" name="education_graduation_{{$row->id}}" value="{{$row->graduation}}">
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label text-left">From</label>
                <div class="col-lg-4">
                    <div class="m-radio-inline col-lg-12">
                        <input type="text" name="edu_start_{{$row->id}}" class="form-control form-control-1 input-sm from" placeholder="CheckIn" value="{{$row->education_start}}">
                    </div>
                </div>
                <label class="col-lg-1 col-form-label text-left">To</label>
                <div class="col-lg-4">
                    <div class="m-radio-inline col-lg-12">
                        <input type="text" name="edu_end_{{$row->id}}" class="form-control form-control-1 input-sm from" placeholder="CheckIn" value="{{$row->education_end}}">
                    </div>
                </div>                
            </div>

            <div class="form-group m-form__group row">
                <label class="col-lg-4 col-form-label text-left"><font>Traning Facility</font></label>
                <div class="col-lg-6">
                    <select class="form-control" name="edu_traning_{{$row->id}}">
                        @foreach(\App\Kandidate::EDUCATION_ITEMS as $id => $sector)
                            <option {{$id == $row->training_facility ? 'selected' : ''}} value="{{$id}}">{{$sector}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- <div class="form-group m-form__group row">
                <label class="col-lg-4 col-form-label text-left">Training Facility</label>
                <div class="col-lg-6">
                    <div class="m-radio-inline col-lg-6">
                        <input type="text" class="form-control" name="edu_traning_{{$row->id}}" value="{{$row->training_facility}}">
                    </div>
                </div>
            </div> -->

            <div class="form-group m-form__group row">
                <label class="col-lg-4 col-form-label text-left">Description</label>
                <div class="col-lg-6">
                    <div class="m-radio-inline col-lg-6">
                        <textarea class="form-control m-input" name="edu_description_{{$row->id}}"
                                  rows="3">{{$row->description}}</textarea>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <input type="hidden" name="input_edu_{{$row->id}}" value=<?php echo $candidate->id?>>
                <button type="button" class="btn btn-light btn-edit"><i id="closeIcon{{$row->id}}" class="fa fa-window-close fa-window-close-edu"></i></button>
                <button type="button" class="btn btn-light btn-edit"><i id="checkIcon{{$row->id}}" class="fa fa-check-circle fa-check-circle-edu"></i></button>          
            </div>
        </div>
        @endforeach

        <!--add new education-->
        <div class="add-form-education box-container d-none">
            <form class="add-form-edu" method="post" action="/admin/add_education/{{$candidate->id}}">
            {{ csrf_field() }}
                <div class="form-group m-form__group row">
                    <label class="col-lg-4 col-form-label text-left">Graduation</label>
                    <div class="col-lg-6">
                        <div class="m-radio-inline col-lg-6">
                            <input type="text" class="form-control" name="education_graduation" value="">
                        </div>
                    </div>
                </div>


                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label text-left">From</label>
                    <div class="col-lg-4">
                        <div class="m-radio-inline col-lg-12">
                            <input type="text" name="edu_start" class="form-control form-control-1 input-sm from" placeholder="CheckIn" value="">
                        </div>
                    </div>
                    <label class="col-lg-1 col-form-label text-left">To</label>
                    <div class="col-lg-4">
                        <div class="m-radio-inline col-lg-12">
                            <input type="text" name="edu_end" class="form-control form-control-1 input-sm from" placeholder="CheckIn" value="">
                        </div>
                    </div>                    
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-4 col-form-label text-left"><font>Traning Facility</font></label>
                    <div class="col-lg-6">
                        <select class='form-control' name='work_exp_sector'>
                            @foreach(\App\Kandidate::EDUCATION_ITEMS as $id => $sector)
                                <option value='{{$id}}'>{{$sector}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group m-form__group row">
                    <label class="col-lg-4 col-form-label text-left">Description</label>
                    <div class="col-lg-6">
                        <div class="m-radio-inline col-lg-6">
                            <textarea class="form-control m-input" name="edu_description" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <input type="hidden" name="input_edu" value="">
                    <button type="button" class="btn btn-light btn-edu-close"><i class="fa fa-window-close"></i></button>
                    <button type="button" class="btn btn-light btn-edu-add"><i class="fa fa-check-circle"></i></button>         
                </div>
            </form>            
        </div>
    </div>
    

    <div class="text-center">
         <button type="button" class="btn btn-primary btn-addNew-edu">Add new education</button>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">
            @if($candidate->id)
                Update
            @else
                Add Freelancer
            @endif
        </button>
        <a class="btn btn-secondary" href="{{ url('/admin/kandidaten') }}">
            Cancel
        </a>
    </div>

</div>
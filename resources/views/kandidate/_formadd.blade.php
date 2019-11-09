{{ csrf_field() }}
<style>
    .has-error input {
        border-color: red;
    }
    .has-error .help-block {
        color: red;
    }
    #view{
        margin-right: 0;
        margin-left: 0;
    }
    #event{
        border: 1px solid #d0d1d4;
        margin-left:30px;
        margin-right:30px;
    }
    .event_row{
        margin-top: 10px;
    }
    .event_row_row{
        margin-right:0;
        float:right;
    }
    #del{
        margin-right: 10px;
    }
    #edit{
        border: 1px solid #dbdce0;
    }
    .form_event{
        float:right;
    }
    #add{
        padding-left: 45px;
        padding-top:0px;
        padding-bottom:0px;
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
    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sprachkenntnisse (Deutsch) </font></font></label>
        <div class="col-lg-6">
            <div class="input-group date" id="m_datepicker_3" style="width: 56%; display: none;">
                <input class="form-control m-input" readonly="" type="text"
                       name="availability_date">
                <span class="input-group-addon">
                    <i class="la la-calendar"></i>
                    </span>
            </div>
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
            <div class="input-group date" id="m_datepicker_3" style="width: 56%; display: none;">
                <input class="form-control m-input" readonly="" type="text"
                       name="availability_date">
                <span class="input-group-addon">
                    <i class="la la-calendar"></i>
                    </span>
            </div>
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
                                            style="vertical-align: inherit;">Core Competences</font></font></a>
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

    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-8">
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
        </div>
    </div>
</div>
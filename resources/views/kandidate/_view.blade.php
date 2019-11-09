{{ csrf_field() }}
<div class="m-portlet__body edit-form view-form">
    <div class="form-group m-form__group row" id="reference_form">
        <label class="col-form-label text-left col-lg-4">
            <font style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">Number</font></font>
        </label>
        <div class="col-form-label ref_input col-lg-8">
            {{$candidate->number}}
        </div>
    </div>
    <div class="form-group m-form__group row row-eq-height">
        <div class="container">
            <div class="row">
       <div class="col-lg-6 col-12">
        <div class="admin-item">
        <div class="form-group m-form__group row">
        <label class="col-form-label text-left col-lg-4"><font
                    style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">CV</font></font></label>
            <div class="m-radio-inline cv-sect col-lg-8">
                @if(!empty($candidate->attached_cv))
                    <a style="margin-left: 0px" href="/public/uploads/{{$candidate->attached_cv}}">Download</a>
                @endif
            </div>
        </div>
    <div class="form-group m-form__group row" id="reference_form">
        <label class="col-form-label text-left col-lg-4">
            <font style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">References Details</font></font>
        </label>
        <div class="col-form-label ref_input col-lg-8">
            {{$candidate->client_name}}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-form-label text-left col-lg-4"><font
                    style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">Gehaltsvorstellung</font></font></label>
        <div class="col-form-label col-lg-8">
            <?php $rates = ['20-30 K', '30-40 K', '40-50 K', '50-60 K', '60-70 K', '70-80 K', '80-90','90-100', '100-110', '110-120', '120+ K']; ?>
            <div class="m-checkbox-inline">
                @foreach($rates as $i => $rate)
                    {!! in_array($i+1, explode(',', $candidate->hourly_rate)) ? $rate . '<br/>' : '' !!}
                @endforeach
                <div id="hourly_rate_msg"></div>
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-form-label text-left col-lg-4"><font
                    style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">Rollendefinition</font></font></label>
        <div class="col-form-label col-lg-8">
            <?php $roles = ['Entwickler', 'Architekt', 'Support', 'Projektmanager', 'Berater', 'Administrator', 'SCRUM Master', 'Tester', 'Test Manager', 'Hardware Entwickler', 'Web Developer', 'Security', 'Frontend', 'Backend']; ?>
            <div class="m-checkbox-inline">
                @foreach($roles as $i => $role)
                    {!! in_array($i+1, explode(',', $candidate->role_definition)) ? $role. '<br/>' : '' !!}
                @endforeach
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-form-label text-left col-lg-4"><font
                    style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">Sprachkenntnisse (Deutsch)</font></font></label>
        <div class="col-form-label col-lg-8">
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
                    {!! in_array($i, explode(',', $candidate->availability_per_week)) ? $day . '<br/>' : '' !!}
                @endforeach
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-form-label text-left col-lg-4"><font
                    style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">Sprachkenntnisse (Englisch)</font></font></label>
        <div class="col-form-label col-lg-8">
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
                    {!! in_array($i, explode(',', $candidate->availability_per_week_en)) ? $day . '<br/>' : '' !!}
                @endforeach
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-form-label text-left col-lg-4"><font
                    style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">Möglicher Einsatzort</font></font></label>
        <div class="col-form-label col-lg-8">
            @php $travelling = explode(',', $candidate->travelling);@endphp
            <div class="m-checkbox-inline">
                @if(in_array("1", $travelling)) Weltweit <br>@endif
                @if(in_array("2", $travelling)) Europaweit<br> @endif
                @if(in_array("3", $travelling)) Deutschlandweit <br>@endif
                @if(in_array("4", $travelling)) Bundesland ({{$candidate->traveling_state}})<br>@endif
                @if(in_array("5", $travelling)) Stadt ({{$candidate->traveling_city}}) <br>@endif
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="col-lg-6 col-12">
    <div class="admin-item">
    <div class="form-group m-form__group row">
        <label class="col-form-label text-left col-lg-4"><font
                    style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">Video</font></font></label>
        <div class="col-form-label col-lg-8">
            {{$candidate->video ? 'Yes' : 'No'}}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-form-label text-left col-lg-4"><font
                    style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">Kündigungsfrist</font></font></label>
        <div class="col-form-label col-lg-8">
            {{$candidate->possible_extension ? $candidate->extension_text : 'No'}}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-form-label text-left col-lg-4"><font
                    style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">Other
                    Interviews and Offers</font></font></label>
        <div class="col-form-label col-lg-8">
            {{$candidate->other_interview ? $candidate->comment_area_text : 'No'}}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-form-label text-left col-lg-4"><font
                    style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">Competences</font></font></label>
        <div class="col-form-label col-lg-8">
            @foreach($competences as $competence)
                @foreach ($competence->competences_skill as $skill)
                    @if(in_array($skill->id, explode(',', $candidate->category_skills))) {{$skill->skill}} <br> @endif
                @endforeach
            @endforeach
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-form-label text-left col-lg-4"><font
                    style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">General
                    Notes</font></font></label>
        <div class="col-form-label col-lg-8">
            {{$candidate->general_notes}}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-form-label text-left col-lg-4"><font
                    style="vertical-align: inherit;"><font class="edit-header" style="vertical-align: inherit;">Core Competences</font></font></label>
        <div class="col-form-label col-lg-8">
            @foreach($competences as $competence)
                @foreach ($competence->competences_skill as $skill)
                    @if(in_array($skill->id, explode(',', $candidate->category_skills)))
                        @if(in_array($skill->id, explode(',', $candidate->core_competences)))
                            {{$skill->skill}}<br>
                        @endif
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
</div>
</div>
</div>
</div>
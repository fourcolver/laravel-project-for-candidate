
  <div class="scrollbar">
    <div class="overflow">
<form action="/admin/kandidaten" class="candidates-filter">
    <div class="m-form__group m-form__group--inline w100 admin-item">
        <div class="m-form__label displayb">
            <label>
                Gehaltsvorstellung
                <a href="javascript:;" class="tippy" data-tippy-content="Beispiel: Wenn Sie nach Kandidaten bis maximal 50.000 EUR Jahresgehalt suchen, selektieren Sie Bitte die Range: 20.000 – 30.000 EUR, 30.000 – 40.000 EUR und 40.000 – 50.000 EUR um alle potentiellen Kandidaten angezeigt zu bekommen." style="margin-left: 10px;">
                    <i class="fa fa-info"></i>
                </a>
            </label>
        </div>
        <div class="m-form__control displayb">
            <select multiple="multiple" class="custom-select no-border" id="m_form_rate"
                    v-model="salaryExpectations"
                    name="m_form_rate[]" style="height: 144px; width: 100%;">
                @foreach ($rate as $key => $val )
                    <option value="{{$key}}">{{$val}}</option>
                    <br>
                @endforeach
            </select>
        </div>
    </div>
    <div style="height: 20px;"></div>
    <div class="m-form__group m-form__group--inline w100 admin-item">
    <div class="m-form__label displayb">
        <label>
            Rollendefinition
            <a href="javascript:;" class="tippy" data-tippy-content="Beispiel: Wenn Sie „Entwickler“ und „Architekt“ selektieren werden Ihnen alle Kandidaten welche primär als Entwickler oder Architekt gearbeitet haben angezeigt." style="margin-left: 10px;">
                <i class="fa fa-info"></i>
            </a>
        </label>
    </div>
    <div class="m-form__control displayb">
        <select multiple="multiple" class="custom-select no-border" id="m_form_role"
                v-model="roleDefinitions"
                name="m_form_role[]" style="height: 144px; width: 100%;">
            @foreach ($role as $key => $val )
                <option value="{{$key}}">{{$val}}</option>
            @endforeach
        </select>
    </div>
    </div>
    <div style="height: 20px;"></div>
    <div class="m-form__group m-form__group--inline skill-items w100">
        <div class="m-form__label">
            <label>
                Technische Fähigkeiten
                <a href="javascript:;" class="tippy" data-tippy-content="Diese Tools, Programmiersprachen und Tools beherrschen die Kandidaten!" style="margin-left: 10px;">
                    <i class="fa fa-info"></i>
                </a>
            </label>
        </div>
        <!-- <input type="text" id="m_typeahead_11" name="m_typeahead_11" class="form-control" /> -->
        <select class="form-control m-select2" id="m_select2_9" name="param"
                v-model="techSkills" v-select='techSkills'
                multiple>
            @foreach ($skills as $key => $val )
                <option value="{{$val->id}}">{{$val->skill}}</option>
            @endforeach
        </select>
    </div>
    <div style="height: 20px;"></div>
    <div class="m-form__group m-form__group--inline skill-items w100">
        <div class="m-form__label">
            <label>
                Möglicher Einsatzort
                <a href="javascript:;" class="tippy" data-tippy-content="Beispiel: Deutschlandweit bedeutet, dass der Kandidat überall in Deutschland nach einer Festanstellung sucht; der Ort ist sekundär. Es gibt auch Kandidaten, welche bevorzugt in gewissen Regionen (z.B. Bayern / München) arbeiten möchten. Für diesen Fall selektieren Sie Bitte „Deutschlandweit, Bayern und München“ um sicherzustellen, dass Ihnen alle potentiellen Kandidaten angezeigt werden." style="margin-left: 10px;">
                    <i class="fa fa-info"></i>
                </a>
            </label>
        </div>
        <!-- <input type="text" id="m_typeahead_11" name="m_typeahead_11" class="form-control" /> -->
        <select class="form-control m-select2" id="m_select2_core" name="can_travel_to_germany"
                v-model="possibleLocations" v-select='possibleLocations'
                multiple>
            @foreach ($willingnessToRelocate as $key => $val )
                @if($val == 'Bundesland')
                    <option value="{{$key}}" disabled
                            style="font-weight: bold">{{$val}}</option>
                    @foreach(config('app.states') as $state)
                        <option>{{$state}}</option>
                    @endforeach
                @elseif($val == 'Stadt')
                    <option value="{{$key}}" disabled
                            style="font-weight: bold">{{$val}}</option>
                    @foreach(config('app.cities') as $city)
                        <option>{{$city}}</option>
                    @endforeach
                @else
                    <option value="{{$key}}">{{$val}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div style="height: 20px;"></div>
    <div class="m-form__group m-form__group--inline w100 admin-item">
        <div class="m-form__label displayb">
            <label>
                Sprachkenntnisse (Deutsch)
                <a href="javascript:;" class="tippy" data-tippy-content="Kompetenzniveau A (Elementare Sprachverwendung), B (Selbständige Sprachverwendung), C (Kompetente Sprachverwendung)" style="margin-left: 10px;">
                    <i class="fa fa-info"></i>
                </a>
            </label>
        </div>
        <div class="m-form__control displayb">
            <select multiple="multiple" class="custom-select no-border" id="free_per_week"
                    v-model="linguisticProficiencyDe"
                    name="free_per_week[]" style="height: 130px; width: 100%;">
                @foreach ($availability as $key => $val )
                    <option value="{{$key}}">{{$val}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div style="height: 20px;"></div>
    <div class="m-form__group m-form__group--inline w100 admin-item">
        <div class="m-form__label displayb">
            <label>
                Sprachkenntnisse (Englisch)
                <a href="javascript:;" class="tippy" data-tippy-content="Kompetenzniveau A (Elementare Sprachverwendung), B (Selbständige Sprachverwendung), C (Kompetente Sprachverwendung)" style="margin-left: 10px;">
                    <i class="fa fa-info"></i>
                </a>
            </label>
        </div>
        <div class="m-form__control displayb">
            <select multiple="multiple" class="custom-select no-border" id="free_per_week_en"
                    v-model="linguisticProficiencyEn"
                    name="free_per_week_en[]" style="height: 130px; width: 100%;">
                @foreach ($availability as $key => $val )
                    <option value="{{$key}}">{{$val}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
</div>
</div>

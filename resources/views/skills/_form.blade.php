{{ csrf_field() }}
<div class="m-portlet__body">
    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left">
            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    Competence
            </font></font></label>
        <div class="col-lg-6">
            <div class="m-radio-inline col-lg-6">
                <select name="competences_id" id="" class="form-control">
                    @foreach($competences as $competence)
                        <option value="{{$competence->id}}" {{$competence->id != $skill->competences_id?:'selected'}}>{{$competence->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-lg-4 col-form-label text-left">
            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    Skill
            </font></font></label>
        <div class="col-lg-6">
            <div class="m-radio-inline col-lg-6">
                <input type="text" name="skill" class="form-control" value="{{$skill->skill}}" required>
            </div>
        </div>
    </div>

    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-8">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                    <a class="btn btn-secondary" href="{{ url('/admin/skills') }}">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
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
    #add_exp{
        margin-left: 30px;
    }
</style>
<div class="m-portlet__body">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"></button>
                    <h4 class="modal-title">Add Work Experiences</h4>
                    </div>
                    <div class="modal-body">
                    {{ csrf_field() }}
                    <span id="form_output"></span>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sector</label>
                                        <select id="sector" class="form-control" name="work_experience_sector">
                                            @foreach(\App\Kandidate::WORK_EXPERIENCE_SECTORS as $id => $sector)
                                                <option {{$id == $candidate->work_experience_sector ? 'selected' : ''}} value="{{$id}}">{{$sector}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Position</label>
                                        <select class="form-control" name="work_experience_position">
                                            @foreach(\App\Kandidate::ROLES as $id => $role)
                                                <option {{$id == $candidate->work_experience_position ? 'selected' : ''}} value="{{$id}}">{{$role}}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name of Company</label>
                                        <input type="text" name="work_experience_company_name" id="comp_name" class="form-control" placeholder="Enter Your Company name">
                                    </div>
                                </div>
                                
                            </div> 
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>start month</label>
                                        
                                        <!-- <input type="text" name="work_experience_period" id="work_period" class="form-control" placeholder="Enter Your Last name" value=""> -->
                                        <select class="form-control" name="start_month">
                                                <option >January</option>
                                                <option >February</option>
                                                <option >March</option>
                                                <option >April</option>
                                                <option >May</option>
                                                <option >June</option>
                                                <option >July</option>
                                                <option >August</option>
                                                <option >Setember</option>
                                                <option >October</option>
                                                <option >November</option>
                                                <option >December</option>
                                        </select>
                                        <input type="hidden" name="last_name" id="client_number" class="form-control" placeholder="Enter Your Last name" value="{{$client_number}}">
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>start year</label>
                                        <select class="form-control" name="start_year">
                                               @for($i=2019;$i>=1990; $i--)<option >{{$i}}</option> @endfor
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>End month</label>
                                        <select class="form-control end_month" name="end_month">
                                                <option >January</option>
                                                <option >February</option>
                                                <option >March</option>
                                                <option >April</option>
                                                <option >May</option>
                                                <option >June</option>
                                                <option >July</option>
                                                <option >August</option>
                                                <option >Setember</option>
                                                <option >October</option>
                                                <option >November</option>
                                                <option >December</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>End year</label>
                                        <select class="form-control end_year" name="end_year">
                                               @for($i=2030;$i>=1990; $i--)<option >{{$i}}</option> @endfor
                                        </select>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="currently-working-here" class="checkbox" i18n-id="bedccffba7bf5594ee57cbc421206f73" i18n-msg="currently working here"><input type="checkbox" ng-model="experience.current" ng-change="validateTimePeriod(experience)" id="currently-working-here" class="ng-pristine ng-untouched ng-valid check"> currently working here</label>
                                     <!-- <input type="checkbox" id="checked">currently working here -->
                                     <input type="hidden" id="checked" name="checked" value="">
                                    </div> 
                                </div>
                                 <script src="../../assets/app/js/jquery1.9.1.min.js" type="text/javascript"></script>
                                <script src="../../assets/app/js/jquery-ui1.9.1.min.js" type="text/javascript"></script>
                               <script language="javascript" type="text/javascript">
                                        $(document).ready(function () {
                                            /* Get the checkboxes values based on the class attached to each check box */
                                            $(".checkbox").click(function() {
                                                if ($('#currently-working-here').is(":checked"))
                                                            {
                                                            // it is checked
                                                            $(".end_month").attr("disabled", "disabled");
                                                            $(".end_year").attr("disabled", "disabled");
                                                            $(".end_month").css({"display":"none"});
                                                            $(".end_year").css({"display":"none"});
                                                            $("#checked").val("present");   
                                                            }else{
                                                                $(".end_year").removeAttr('disabled');
                                                                $(".end_month").removeAttr('disabled');
                                                                $(".end_month").removeAttr('style');
                                                                $(".end_year").removeAttr('style');
                                                                $("#checked").val("");    

                                                            }
                                            });
                                        });
                                   

                                </script>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <label>Description of position</label>
                                            <textarea class="form-control m-input" id="position_desc" name="work_experience_position_description" rows="3">{{$candidate->work_experience_position_description}}</textarea>
                                    </div> 
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="button_action" id="button_action" value="insert" />
                        <input type="submit" name="submit" id="" class="btn btn-success pull-left" value="Add" >
                        <a href="{{route('candidates.update_data')}}"><button id="ajaxSubmit" type="button" class="btn btn-danger" data-dismiss="modal">Close</button></a> 
                    </div>
            </div>
            @if(isset($data))
                <div class="col-md-6"id="work_exp">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"></button>
                    <h4 class="modal-title">Experiences List</h4>
                    </div>
                    
                    @foreach ($data as $subdata)

                    <div class="modal-body">
                        {{ csrf_field() }}
                        <span id="form_output"></span>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sector</label>
                                        <select class="form-control" style="background-color: #f2f3f8;" name="work_experience_sector2">
                                            @foreach(\App\Kandidate::WORK_EXPERIENCE_SECTORS as $id => $sector)
                                                <option {{$id == $subdata->sector ? 'selected' : ''}} value="{{$id}}">{{$sector}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Position</label>
                                        <div >
                                        <select class="form-control" style="background-color: #f2f3f8;" name="work_experience_position2">
                                            @foreach(\App\Kandidate::ROLES as $id => $role)
                                                <option {{$id == $subdata->position ? 'selected' : ''}} value="{{$id}}">{{$role}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div> 
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name of Company</label>
                                        <div >
                                            <input type="text" class="form-control" style="background-color: #f2f3f8;border: none;" name="" id="comp_name_view" value="{{$subdata->country_name}}">
                                        </div>
                                    </div>
                                </div>
                                
                            </div> 
                            <div class="row">
                                     <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Start Month</label>
                                            <div >

                                                <input type="text" class="form-control" style="background-color: #f2f3f8;border: none;" name="" id="work_period_view" value="{{$subdata->start_month}}">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Start Year</label>
                                            <div >

                                                <input type="text" class="form-control" style="background-color: #f2f3f8;border: none;" name="" id="work_period_view" value="{{$subdata->start_year}}">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>End Month</label>
                                            <div >

                                                <input type="text" class="form-control" style="background-color: #f2f3f8;border: none;" name="" id="work_period_view" value="{{$subdata->end_month}}">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>End Year</label>
                                            <div >

                                                <input type="text" class="form-control" style="background-color: #f2f3f8;border: none;" name="" id="work_period_view" value="{{$subdata->end_year}}">
                                            </div>
                                        </div> 
                                    </div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid #b5b5b5;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <label>Description of position</label>
                                            <textarea class="form-control m-input" id="position_desc_view" name="work_experience_position_description2" rows="3">{{$subdata->position_desc}}</textarea>
                                    </div> 
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
       @endif
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</div>
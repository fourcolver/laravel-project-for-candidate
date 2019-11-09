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
                    <h4 class="modal-title">Add Education, university and degrees</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <span id="form_output"></span>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Educations</label>
                                        <input type="text" name="education_topic" id="work_period" class="form-control" placeholder="Enter Your Last name" value="">
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>University</label>
                                        <input type="text" name="university_name" id="comp_name" class="form-control" placeholder="Enter Your First name">
                                    </div>
                                </div>
                                
                            </div> 
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>start month</label>
                                        
                                        <!-- <input type="text" name="work_experience_period" id="work_period" class="form-control" placeholder="Enter Your Last name" value=""> -->
                                        <select class="form-control" id="position" name="start_month">
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
                                        <select class="form-control" id="position" name="start_year">
                                               @for($i=2019;$i>=1990; $i--)<option >{{$i}}</option> @endfor
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>End month</label>
                                        <select class="form-control end_month" id="position" name="end_month">
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
                                        <select class="form-control end_year" id="position" name="end_year">
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
                                           <div class="">
                                                <label>Degrees</label>
                                           </div> 
                                           <div class="">
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
                                </div>
                            </div>
                           
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="button_action" id="button_action" value="insert" />
                        <input type="submit" name="submit" id="" class="btn btn-success pull-left" value="Add" >
                        <a href="{{route('candidates.create_end')}}"><button id="ajaxSubmit" type="button" class="btn btn-danger" data-dismiss="modal">Finish</button></a> 
                    </div>
            </div>
       @if(isset($data))
       <div class="col-md-6">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"></button>
                    <h4 class="modal-title"> Education, university and degrees</h4>
                    </div>

                    @foreach ($data as $subdata)
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <span id="form_output"></span>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Education</label>
                                        <input style="background-color: #f2f3f8;border: none;" type="text" name="" id="work_period" class="form-control" placeholder="Enter Your Last name" value="{{$subdata->education_topic}}">
                                    </div>
                                </div>
                                
                               
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>University</label>
                                        <input style="background-color: #f2f3f8;border: none;" type="text" name="" id="comp_name" class="form-control" value="{{$subdata->education_uni}}" placeholder="Enter Your First name">
                                    </div>
                                </div>
                                
                            </div> 
                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Start Month</label>
                                            <input style="background-color: #f2f3f8;border: none;" type="text" name="" id="work_period" class="form-control" placeholder="Enter Your Last name" value="{{$subdata->start_month}}">
                                            <input style="background-color: #f2f3f8;border: none;" type="hidden" name="last_name" id="client_number" class="form-control" placeholder="Enter Your Last name" value="{{$client_number}}">
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Start Year</label>
                                            <input style="background-color: #f2f3f8;border: none;" type="text" name="" id="work_period" class="form-control" placeholder="Enter Your Last name" value="{{$subdata->start_year}}">
                                            <input style="background-color: #f2f3f8;border: none;" type="hidden" name="last_name" id="client_number" class="form-control" placeholder="Enter Your Last name" value="{{$client_number}}">
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>End Month</label>
                                            <input style="background-color: #f2f3f8;border: none;" type="text" name="" id="work_period" class="form-control" placeholder="Enter Your Last name" value="{{$subdata->end_month}}">
                                            <input style="background-color: #f2f3f8;border: none;" type="hidden" name="last_name" id="client_number" class="form-control" placeholder="Enter Your Last name" value="{{$client_number}}">
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>End Year</label>
                                            <input style="background-color: #f2f3f8;border: none;" type="text" name="" id="work_period" class="form-control" placeholder="Enter Your Last name" value="{{$subdata->end_year}}">
                                            <input style="background-color: #f2f3f8;border: none;" type="hidden" name="last_name" id="client_number" class="form-control" placeholder="Enter Your Last name" value="{{$client_number}}">
                                        </div> 
                                    </div>
                                </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                           <div class="">
                                                <label>Degrees</label>
                                           </div> 
                                           <div class="">
                                                @foreach(\App\Kandidate::EDUCATION_ITEMS as $i => $value)
                                                <label class="m-checkbox">
                                                    <input style="background-color: #f2f3f8;border: none;" name="education[]" class="availabile_days" value="{{$i}}"
                                                        {{(strpos($subdata->education_list, (string)$i) !== false) ? 'checked' : ''}}
                                                        type="checkbox"><font style="vertical-align: inherit;"><font
                                                                style="vertical-align: inherit;"> {{$value}}
                                                        </font></font><span></span>
                                                </label>
                                                @endforeach
                                           </div>
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
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
            @if(isset($data))
            <div class="col-md-12">
                            <div class="modal-header">
                                <a href="{{route('candidates.add_education')}}" class="close" data-dismiss="modal">Add</a>
                                <h4 class="modal-title"> Education, university and degrees</h4>
                            </div>
                            @foreach ($data as $subdata)
                            <a href="{{route('candidates.education_sub_delete',$subdata->id)}}"  style="float: none;font-size: 2rem;"  class="close" data-dismiss="modal">&times;</a>
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <span id="form_output"></span>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Education</label>
                                                <input type="text" name="education_topic{{$subdata->id}}" id="work_period" class="form-control" placeholder="Enter Your Last name" value="{{$subdata->education_topic}}">
                                            </div>
                                        </div>
                                       
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>University</label>
                                                <input type="text" name="university_name{{$subdata->id}}" id="comp_name" class="form-control" value="{{$subdata->education_uni}}" placeholder="Enter Your First name">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>start month</label>
                                                    
                                                    <!-- <input type="text" name="work_experience_period" id="work_period" class="form-control" placeholder="Enter Your Last name" value=""> -->
                                                    <select class="form-control" id="position" name="start_month{{$subdata->id}}">
                                                            @if($subdata->start_month == 'January')
                                                                   
                                                                    <option selected>January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option>
                                                            @elseif($subdata->start_month == 'February')
                                                                    <option >January</option>
                                                                    <option selected>February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option>
                                                            @elseif($subdata->start_month == 'March')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option selected>March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->start_month == 'April')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option selected>April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->start_month == 'May')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option selected>May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->start_month == 'June')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option selected>June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->start_month == 'July')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option selected>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->start_month == 'August')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option selected>August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->start_month == 'Setember')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option selected>Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->start_month == 'October')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option selected>October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->start_month == 'November')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option selected>November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->start_month == 'December')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option selected>December</option>   
                                                            @endif
                                                            
                                                    </select>
                                                </div> 
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>start year</label>
                                                    <select class="form-control" id="position" name="start_year{{$subdata->id}}">
                                                        @for($i=2019;$i>=1990; $i--)
                                                            @if($subdata->start_year == $i)
                                                            <option selected> {{$i}} </option>
                                                            @else
                                                             <option > {{$i}} </option> 
                                                            @endif
                                                           
                                                        @endfor
                                                    </select>
                                                </div> 
                                            </div>
                                            <script src="../../assets/app/js/jquery1.9.1.min.js" type="text/javascript"></script>
                                <script src="../../assets/app/js/jquery-ui1.9.1.min.js" type="text/javascript"></script>
                               <script language="javascript" type="text/javascript">
                                        $(document).ready(function () {
                                            // if($('#end_month').val()) 
                                             
                                                // alert($('#end_month').val() + val);
                                                $('.checkpresent').attr('checked', true);
                                                $(".endpresent").attr("disabled", "disabled");
                                                // $(".endpresent").attr("disabled", "disabled");
                                                $(".endpresent").css({"display":"none"});
                                                // $(".endpresent").css({"display":"none"});
                                                // $("#checked").val("present"); 
                                           
                                            
                                            
                                            /* Get the checkboxes values based on the class attached to each check box */
                                            $(".check_true").click(function() {
                                                var val;
                                                val = $(this).val();
                                                // alert(val);
                                                console.log(val);
                                                if ($(this).is(":checked"))
                                                            {
                                                            // it is checked
                                                            $("#end_month"+val).attr("disabled", "disabled");
                                                            $("#end_year"+val).attr("disabled", "disabled");
                                                            $("#end_month"+val).css({"display":"none"});
                                                            $("#end_year"+val).css({"display":"none"});
                                                            $("#checked"+val).val("present");   
                                                            // alert($(this).val());
                                                            }else{
                                                                $("#end_month"+val).removeAttr('disabled');
                                                                $("#end_year"+val).removeAttr('disabled');
                                                                $("#end_month"+val).removeAttr('style');
                                                                $("#end_year"+val).removeAttr('style');
                                                                $("#checked"+val).val("");    
                                                                // alert("testsss");

                                                            }
                                            });
                                        });
                                   

                                </script>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>End month</label>
                                                    <select class="form-control end{{$subdata->end_month}}" id="end_month{{$subdata->id}}" name="end_month{{$subdata->id}}">
                                                        @if($subdata->end_month == 'January')
                                                                    
                                                                    <option selected>January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option>
                                                            @elseif($subdata->end_month == 'February')
                                                                    <option >January</option>
                                                                    <option selected>February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option>
                                                            @elseif($subdata->end_month == 'present')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option>
                                                            @elseif($subdata->end_month == 'March')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option selected>March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->end_month == 'April')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option selected>April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->end_month == 'May')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option selected>May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->end_month == 'June')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option selected>June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->end_month == 'July')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option selected>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->end_month == 'August')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option selected>August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->end_month == 'Setember')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option selected>Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->end_month == 'October')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option selected>October</option>
                                                                    <option >November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->end_month == 'November')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option selected>November</option>
                                                                    <option >December</option> 
                                                            @elseif($subdata->end_month == 'December')
                                                                    <option >January</option>
                                                                    <option >February</option>
                                                                    <option >March</option>
                                                                    <option >April</option>
                                                                    <option >May</option>
                                                                    <option >June</option>
                                                                    <option>July</option>
                                                                    <option >August</option>
                                                                    <option >Setember</option>
                                                                    <option >October</option>
                                                                    <option >November</option>
                                                                    <option selected>December</option>   
                                                            @endif
                                                            
                                                    </select>
                                                </div> 
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>End year</label>
                                                    <select class="form-control end{{$subdata->end_month}}" id="end_year{{$subdata->id}}" name="end_year{{$subdata->id}}">
                                                    @for($i=2030;$i>=1990; $i--)
                                                            @if($subdata->end_year == $i)
                                                            <option selected> {{$i}} </option>
                                                            @else
                                                             <option > {{$i}} </option> 
                                                            @endif
                                                           
                                                        @endfor
                                                    </select>
                                                </div> 
                                            </div>
                            </div>
                                    <input type="hidden" name="last_name" id="client_number" class="form-control" placeholder="Enter Your Last name" value="{{$client_number}}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label for="currently-working-here" class="checkbox" i18n-id="bedccffba7bf5594ee57cbc421206f73" i18n-msg="currently working here"><input type="checkbox" name = "checkbox" id="currently-working-here{{$subdata->id}}" value="{{$subdata->id}}" class="ng-pristine ng-untouched check_true ng-valid check{{$subdata->end_month}}"> currently working here</label>
                                            <!-- <input type="checkbox" id="checked">currently working here -->
                                            <input type="hidden" id="checked{{$subdata->id}}" name="checked" value="">
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
                                                                <input name="education{{$subdata->id}}[]" class="availabile_days" value="{{$i}}"
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
                            <div class="modal-footer">
                                <input type="hidden" name="button_action" id="button_action" value="insert" />
                                <input type="submit" name="submit" id="" class="btn btn-success pull-left" value="Update" >
                                <a href="{{route('candidates.update_end')}}"><button id="ajaxSubmit" type="button" class="btn btn-danger" data-dismiss="modal">Finish</button></a> 
                            </div>
             </div>
            @endif
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</div>
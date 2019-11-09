@extends('layouts.candidates')
@section('template')
    <style>
        .li-margin {
            margin-right: 8px;
            color: #687edf;
        }
        .list-style {
            display: flex;
            list-style-type: none;
        }
        .ui-margin {
            margin-bottom: 10px;
            margin-top: 10px;
        }
        .m-content > div > form {
            display: none !important;
        }
        .m-content.admin-content h4{
            font-family: "Avenir-Heavy" !important;
            font-size: 32px;
            color: #434656;
        }        
        .m-content.admin-content{
            font-family: "Avenir-Roman";
        }
        .candidate-profile {
            margin-bottom: 30px;
        }
        .candidate-profile .profile-details {
            padding: 10px;
            border: 1px solid #ddd;
            border-top: 0;
            height: 250px;
        }
        .prof-experience {
            border-bottom: 1px solid wheat;
        }
        .box-container {
            padding: 15px;
            border-radius: 5px;
            background: #fff;
            margin-top: 20px;
            margin-bottom: 15px;
        }
        .box-container > span{
            font-size: 22px;
            color: #3D4564;
        }
        .admin-content {
            padding: 0px 0px !important;
        }
        .top-section {
            background: linear-gradient(to top,#0074E4,#5867DD);
            padding-top: 80px;
        }
        .top-section .row{
            background: #fff;
        }
        .m-subheader {
            position: absolute;
            left: 0;
            right: 0;
            width: 100%;
            max-width: 1140px;
            display: block;
            padding-top: 0px;
            margin: 0 auto;
            padding-left: 0px !important;
        }
        .mr-auto {
            margin-top: 15px;
            margin-left: 10px;
        }
        .box-skills{
            font-size: 16px;
        }        
        .box-skills2 > span {
            font-size: 20px !important;
        }
        .sector{
            font-size: 12px;
            color: #7A7B81;
            text-transform: uppercase; 
        }
        .period{
            font-size: 12px;
            text-align: right;
            color: #7A7B81;
            margin-right: 5px;
            float: right;
        }
        .hf div{
            display: inline-block;
            margin-top: 20px;
        }
        .hf {
            margin-bottom: 10px;
        }
        .com-name{
            font-size: 22px;
            color: #FF7B7D;
            margin-bottom: 10px;
        }
        .exp-position{
            display: inline-block;
            padding: 5px 15px;
            box-shadow: 0 2px 2px rgba(0,0,0,.1);
            border-radius: 20px;
        }
        .box-container > span.lang{
            color: #FF7B7D;
            font-size: 20px;
        }
        .box-container > span.lang-class{
            font-size: 16px;
        }
        .profile-head-box{
            background: #007BE5;
            display: inline-block;
            border-radius: 5px;
            margin-top: 20px;
        }
        
        .profile-head-box > div{
            display: inline-block;
            text-align: center;
            padding: 10px 20px;
            min-width: 175px;
        }
        .gehal-box{
            color: #fff;
        }
        .head-lang-box{
            border: 1px solid #0074E4;
            background: #fff;
        }
        .head-lang  p{
            font-size: 16px;
        }
        .btn.btn-danger {
            background: #007BE5;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            padding: 15px 65px;
        }        
        .btn.btn-danger span > span {
            padding-left: 0;
        }
        .Verfugbarkeit-info {
            background: rgba(86,104,222,.7);
            color: #fff;
            font-size: 16px;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            margin-top: 40%;
        }
        .Verfugbarkeit-yes{
            color: #28C195;
            font-size: 12px;
            vertical-align: text-bottom;
            margin-right: 10px;
            margin-left: 5px;
        }
        .no{
            font-weight: bold;
            color: #FF7B7D !important;
        }
        .yes{
            font-weight: bold;
            color: #28C195 !important;
        }
        .mr-auto {
            margin-left: 0px;
        }
        .m-page-title{
            color: #fff;
            background: #8895E8;
            padding: 5px 20px;
            border-radius: 20px;
        }
        @media(max-width: 1200px){
            .m-subheader{
                text-align: center;
            }
            .m-subheader .d-flex {
                display: inline-block !important;
            }
        }
        @media (max-width: 1365px){
            .mob-center{
            text-align: center;
            }
            .Verfugbarkeit-info{
            margin-top: 37px;
            }
            .mob-center #festanstellung_send{
                margin-top: 27px;
            }
        }
        @media (min-width: 768px){
            .col-md-8{
                padding-right: 0 !important 
            }
            .col-md-4{
                padding-left: 0 !important
            }
            #candidates .col-md-4{
            padding-left: 0;
            }
        }
    </style>

    <div class="m-content admin-content">
        <div class="m-portlet m-portlet--mobile bg-admin">
            <div class="m-portlet__body">
                @if (Session::has('user_message'))
                    <div class="m-alert m-alert--outline alert alert-info alert-dismissible fade show"
                         role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        {{Session::get('user_message')}}
                    </div>
                @endif
                <div class="top-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                        <img src="{{!empty($candidate->picture) ? '/public/uploads/' . $candidate->picture : '/no-photo.jpg'}}" alt="" style="width: 100%">
                        </div>
                        <div class="col-md-8">
                         <div class="box-container mob-center">
                            <div class="row">
                                <div class=" col-md-12 col-lg-8">
                                                             <h4>{{$candidate->first_name}} - {{$candidate->optional_interview}}</h4>
                                <div style="font-size: 18px !important;;">
                                    {{$candidate->roles->implode(', ')}}
                                </div>
                                <div class="profile-head-box">
                                <div class="gehal-box"><span> Gehaltsvorstellung</span> <br>  <span class="gehal">{{$candidate->salaryExpectations->implode(', ')}}; </span></div>
                                <div class="head-lang-box">
                                <span>Sprachen<br></span>
                                    <span>{{$candidate->linguisticProficiency->implode(', ')}}.</span>
                                </div>     
                                </div>
                                </div>
                                <div class=" col-md-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-12">
                                   <form action="{{url('admin/Festanstellung/sendMail')}}" id="festanstellung_send" method="POST"
                          target="_blank">
                        {{ csrf_field() }}
                        <input type="hidden" name="festanstellung_id" id="festanstellung_id">

                        <button type="submit" class="btn btn-danger m-btn m-btn--icon" id="festanstellung_Send_mail">
                                <span>
                                    <span>
                                        Send Mail
                                    </span>
                                </span>
                        </button>
                                    </form>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-12">
                                    <div class="Verfugbarkeit-info">
                                        <span class="Verfugbarkeit-yes">&#11044;</span>Verfügbarkeit bestätigt
                                    </div>
                                    </div>  
                                </div>
                              </div>
                            </div>

                            </div>   
                        </div>
                    </div>
                </div>
                </div>
                <div class="container">
                    <div class="row" id="candidates">
                        <div class="col-md-4">
                            <div class="box-container box-skills">
                                <span style="font-weight: bold">
                                    Technische Fähigkeiten
                                </span>
                                <p></p><br>{!! $candidate->skills->implode('<hr>') !!}</br>
                                
                            </div>
                            <div class="box-container box-skills">
                                <span style="font-weight: bold">
                                    Core Competences
                                </span>
                                <p></p><br>{!! $candidate->competences->implode('<hr>') !!}</br>
                            </div>
                            <div class="box-container box-skills2">
                                <span style="font-weight: bold">
                                    Other interviews and offers:
                                </span>
                               <span class="no">{!! $candidate->other_interview ? $candidate->comment_area_text : 'No' !!}</span>
                            </div>
                            <div class="box-container box-skills2">
                                <span style="font-weight: bold">
                                    References Details:
                                </span>
                                <span class="no">{{$candidate->client_name}}</span>
                            </div>
                            @if(Auth::user()->isAdmin)
                            <div class="box-container box-skills2">
                                <span style="font-weight: bold">
                                    Is confirmed?
                                </span>
                                <span class="no">{!! $candidate->is_confirmed ? 'Yes' : 'No' !!}</span>
                            </div>
                            <div class="box-container box-skills2">
                                <span style="font-weight: bold">
                                    Is active?
                                </span>
                                <span class="no">{!! $candidate->is_active ? 'Yes' : 'No' !!}</span>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="box-container">
                                <span style="font-weight: bold">in aller Kürze über mich</span>
                                <p></p>
                                <div>{!! nl2br($candidate->general_notes) !!}</div>
                            </div>
                            <div class="box-container">
                                <span style="font-weight: bold">Möglicher Arbeitsort:</span>
                                <p></p>{!! $candidate->possibleLocation->implode(',<br> ') !!}
                            </div>

                            <div class="box-container">
                                <span style="font-weight: bold; margin-bottom: 20px">Berufserfahrung</span>
                                @foreach($candidate_experience as $row)                                
                                    
                                    <div class="hf">
                                        <div class="sector">{{\App\Kandidate::WORK_EXPERIENCE_SECTORS[$row->experience_sector]}}</div>                                    
                                        <div class="period">{{$row->experience_start}}</div> 
                                        <div class="period">-</div> 
                                        <div class="period">{{$row->experience_end}}</div> 
                                    </div>
                                    <div class="com-name">{{$row->experience_company}}</div>
                                    <div class="exp-position">@php $roles = \App\Kandidate::ROLES; @endphp
                                    {{isset($roles[$row->experience_postion]) ? $roles[$row->experience_postion] : ''}}</div>
                                    <br>
                                    <br>
                                    <div class="prof-experience-ui">
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
                                @endforeach
                            </div>



                           <!--  <div class="box-container">
                                <span style="font-weight: bold">Berufserfahrung</span>
                                <br>
                                <div class="hf">
                                    <div class="sector">{{\App\Kandidate::WORK_EXPERIENCE_SECTORS[$candidate->work_experience_sector]}}</div>
                                    <div class="period">{{$candidate->work_experience_period}}</div>   
                                </div>
                                <br>
                                <div class="com-name">{{$candidate->work_experience_company_name}}</div>
                                <br>
                                <div class="exp-position">@php $roles = \App\Kandidate::ROLES; @endphp
                                {{isset($roles[$candidate->work_experience_position]) ? $roles[$candidate->work_experience_position] : ''}}</div>
                                <br>
                                <br>
                                <div class="prof-experience">{!! $candidate->work_experience_position_description !!}</div>
                            </div> -->
<!--                             <div class="box-container">
                                <span style="font-weight: bold">Ausbildung, Universität und Abschlüsse</span>
                                <br>
                                {{$candidate->educationList->implode(', ')}}
                            </div> -->
                            <div class="box-container">
                                <span style="font-weight: bold; margin-bottom: 20px">Ausbildung, Universität und Abschlüsse</span>
                                @foreach($candidate_education as $row)
                                    <div class="hf">
                                        <div class="sector">{{$row->graduation}}</div>                                    
                                        <div class="period">{{$row->education_start}}</div> 
                                        <div class="period">~</div> 
                                        <div class="period">{{$row->education_end}}</div> 
                                    </div>
                                    <div class="com-name">@php $facility = \App\Kandidate::EDUCATION_ITEMS; @endphp {{isset($facility[$row->training_facility]) ? $facility[$row->training_facility] : ""}}</div>
                                    <div class="prof-experience">{{$row->description}}</div>

                                @endforeach
                            </div>
                            <div class="box-container">
                                <span style="font-weight: bold">Languages:</span>
                                <p></p>
                                <span class="lang">Deutsch:</span><br><span class="lang-class">{{$candidate->linguisticProficiency->implode(', ')}}</span>
                                <hr>
                                <span class="lang">English</span><br><span class="lang-class">{{$candidate->linguisticProficiencyEn->implode(', ')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
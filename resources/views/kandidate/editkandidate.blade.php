<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Argon | Festanstellung
    </title>
@extends('layouts.admin_dashboard')
@section('content')
    <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <div class="m-subheader">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-page-title ">
                            <a href="{{ url('/admin/kandidaten')}}">Festanstellung</a>
                        </h3>
                    </div>
                </div>
            </div>
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                     style="display: block; padding: 10px; margin:27px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <p class="message">
                        {{session('message')}}
                    </p>
                </div>
            @endif
            <div class="sub_btn_header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto pull-right" style="margin: 0 0 0 80%;">
                        @if(Auth::user()->isAdmin)
                            <button style="margin-left: 15px;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger float-right">
                                <span>DELETE</span>
                            </button>
                            @if($candidate->is_active)
                                <a href="{{route('candidate.deactivate', $candidate->id)}}" class="btn btn-warning float-right">
                                    <span>Deactivate</span>
                                </a>
                            @else
                                <a href="{{route('candidate.activate', $candidate->id)}}" class="btn btn-info float-right">
                                    <span>Activate</span>
                                </a>
                            @endif
                        @endif

                        <div id="deleteModal" class="modal fade" role="dialog" style="">
                            <div class="modal-dialog" style="width: 40%;">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Confirm Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p style="text-align: center; color: red;">
                                            Are you sure you wish to delete this Festanstellung.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                        <button type="button" id="deleteFreelancer" data-id="{{$candidate->id}}"
                                                class="btn btn-danger">Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--rounded view_block">
                @if(Auth::user()->isAdmin)
                <form action="{{route('candidates.update', $candidate)}}" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" enctype="multipart/form-data">
                    @include('kandidate._form')
                </form>
                @else
                    @include('kandidate._view')
                @endif
            </div>


            <!-- end:: Body -->

            <div id="attachdoc" class="modal fade" role="dialog">
                <div class="modal-dialog" style="width: 40%;">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">File upload form</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Form -->
                            <form method="post" action="{{url('admin/freelancer/upload/'.$candidate->id)}}"
                                  name="upload_file" id="upload_file" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                Select file : <input type='file' name='attach_doc' id='attach_doc' class='form-control'
                                                     required=""><br>
                                <span id="errormessage"></span>
                                <p style="color: red">* Please Select Only Doc and Pdf File</p>
                                <button class="btn btn-primary" id="upload" name="upload" type="submit">Upload</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
            <!-- begin::Quick Sidebar -->
            <div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
                <div class="m-quick-sidebar__content m--hide">
        <span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
          <i class="la la-close"></i>
        </span>
                    <ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand comment_div"
                        role="tablist">
                        <!-- Form area -->
                        <li>
                            <h3>Leave Comment </h3><br>
                            <input type="hidden" id="auth_id" value="{{Auth::id()}}">
                        </li>
                        <li>
                        <li>
                            <label for="comment_area">
                                Comment :
                            </label>
                            <textarea class="form-control" id="comment_area" name="comment_area" rows=5></textarea>
                        </li>
                        <!-- End form area -->

                    </ul>
                    <div class="form-group">
                        <button type="button" class="btn btn-success" id="LeaveComment">Submit</button>
                        <button type="button" class="btn btn-default" id="CancelComment">Cancel</button>
                    </div>
                </div>
            </div>
            <!-- end::Quick Sidebar -->
            <!-- begin::Scroll Top -->
            <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
                 data-scroll-speed="300">
                <i class="la la-arrow-up"></i>
            </div>
            <!-- </div> -->
            <!-- end::Scroll Top -->
            @endsection
            @section('js')
                <script src="{{asset('/js/add_kandidaten.js')}}" type="text/javascript"></script>
                <script type="text/javascript">
                    $('#contact_link').addClass('m-menu__item--active m-menu__item--expanded m-menu__item--open');
                    $('#freelancer_link').addClass('m-menu__item--active');
                    $('footer').css({"margin": "0px", "position": "absolute"});

                    $('.m-checkbox').on('click', function() {
                        var inputName = $(this).find('input').attr('name');
                        if(inputName === 'can_travel_to_germany[]') {
                            if($(this).find('input').is(':checked')) {
                                $(this).next().css('display', 'inline-block');
                            } else {
                                $(this).next().hide();
                            }
                        }
                    });
                    $('.m-select2').select2({
                        placeholder: "Select an option",
                        width: '215px'
                    });
                    $('#competence-skill').on('select2:select', function (e) {
                        var data = e.params.data;
                        $('.core_checkbox').append('<label class="m-checkbox"><input name="core_category[]"  value="' + data.id + '" type="checkbox">' + data.text + '<span></span></label>');
                    });
                    $('#competence-skill').on('select2:unselect', function (e) {
                        var data = e.params.data;
                        $('#core_competences input[value=' + data.id + ']').eq(0).parent('label').last().remove();
                    });

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
                    var core_array = [];
                    $('#core_competences input[type=checkbox]').each(function (val) {
                        $(this).parent('label').append($('#accordion input[value=' + $(this).val() + ']').eq(0).parent('label').text());
                        core_array.push($(this).val());
                    });

                    $('#accordion input:checkbox:checked').each(function (val) {
                        var skill_value = $(this).val();
                        if ($.inArray(skill_value, core_array) == '-1') {
                            var competence_text = $(this).parent('label.m-checkbox').eq(0).text();
                            $('.core_checkbox').append('<label class="m-checkbox"><input name="core_category[]"  value="' + $(this).val() + '" type="checkbox">' + competence_text + '<span></span></label>');
                        }
                    });
                    $(document).ready(function () {

                        $('#deleteFreelancer').on('click', function () {

                            var id = $('#deleteFreelancer').attr('data-id');
                            var url = '/admin/kandidaten/delete' + '/' + id
                            $.ajax({
                                url: url,
                                success: function (response) {
                                    var res = $.parseJSON(response);
                                    if (res.status == 'success') {
                                        swal('Success', res.message, 'success');
                                        setTimeout(function () {
                                            window.location.replace('/admin/kandidaten');
                                        }, 2000);
                                    }

                                }
                            });

                        });
                    });

                </script>
            @endsection
            @section('css')
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
                    .box-container {
                        padding: 15px;
                        border-radius: 5px;
                        background: #fff;
                        margin-top: 20px;
                        margin-bottom: 15px;
                        margin-left: 8%;
                        width: 80%;
                    }
                    .box-container > span{
                        font-size: 22px;
                        color: #3D4564;
                    }
                    .box-container > span.lang{
                        color: #FF7B7D;
                        font-size: 20px;
                    }
                    .box-container > span.lang-class{
                        font-size: 16px;
                    }
                    .box-container-title {
                        align-items: center;
                        justify-content: center;
                        display: flex;
                    }
                    .btn-edit {
                        height: 10%;
                        width: 3.5rem;
                    }
                    .form-experience {
                        display: none;
                    }
                    .display-flex {
                        display: flex;
                    }
                    .btn-addNew-work {
                        margin-bottom: 20px;
                    }
                    .btn-addNew-edu {                        
                        margin-bottom: 20px;
                    }
                    .btn_place {
                        margin-top: 20px;
                    }
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
                    /*.m-checkbox > input:checked ~ span.mdoublecheck:after {
                    top: 60%;
                    }
                    .m-checkbox > input:checked ~ span.msinglecheck:after {
                      top: 33%;
                    }*/

                </style>
@endsection

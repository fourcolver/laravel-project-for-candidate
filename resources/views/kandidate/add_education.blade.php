<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Argon | Festanstellung
    </title>
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-search__field {
            width: 125px !important;
        }
    </style>
@extends('layouts.admin_dashboard')
@section('content')
    <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-page-title ">
                            <a href="{{ url('/admin/kandidaten')}}">Add Festanstellung</a>
                        </h3>
                    </div>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                     style="display: block; padding: 10px; margin:27px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <p class="message">
                        {{session('status')}}
                    </p>
                </div>@endif
            <div class="m-portlet m-portlet--rounded view_block">
                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" action="{{route('candidates.add_education_save')}}"
                enctype="multipart/form-data">
                    @include('kandidate._form_education_add')
                </form>
            </div>
            <!-- end:: Body -->
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
        </div>
        <!-- end::Scroll Top -->
    @endsection
    @section('js')
        <script src="{{asset('/js/add_kandidaten.js')}}" type="text/javascript"></script>
        <script type="text/javascript">
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
            $('#contact_link').addClass('m-menu__item--active m-menu__item--expanded m-menu__item--open');
            $('footer').css({"position": "absolute"});
            $('#freelancer_link').addClass('m-menu__item--active');
            $('.mdoublecheck').hide();
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
                    var competence_text = $(this).parent('label.m-checkbox').eq(0).text();
                    $('.core_checkbox').append('<label class="m-checkbox"><input name="core_category[]"  value="' + $(this).val() + '" type="checkbox">' + competence_text + '<span></span></label>');
                }
                else {
                    $('#core_competences input[value=' + $(this).val() + ']').eq(0).parent('label').last().remove();
                }
            });

            $('#core_competences input[type=checkbox]').each(function (val) {
                $(this).parent('label').append($('#accordion input[value=' + $(this).val() + ']').eq(0).parent('label').text());
            });
            $('#add_free').on('submit', function() {
                return true;
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

            {
            .
            ref_input
            input
            margin-top
            :
            10
            px
            ;
            }
            .m-checkbox > input:checked ~ span.mdoublecheck:after {
                top: 60%;
            }

            .m-checkbox > input:checked ~ span.msinglecheck:after {
                top: 33%;
            }

        </style>
@endsection

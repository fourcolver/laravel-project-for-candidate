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
        <style>
            .displayb >label {
                font-size: 16px !important;
            }
        </style>
    <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper admin-index">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-page-title" style="height: auto;">
                            Home / Festanstellung
                        </h3>
                    </div>
                    @if(Auth::user()->isAdmin)
                        <a href="{{url('admin/kandidaten/add_user')}}" class="btn btn-primary m-btn m-btn--icon"
                           id="add_user" style="position: relative;top: -5px;">
									<span>
										<span>Add Festanstellung</span>
									</span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="m-content" style="position: relative; padding: 0 30px; margin-left: 0%">
                <div class="text-right">
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
            </div>

            <!-- END: Subheader -->
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
                    <!--begin: Search Form -->
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-xl-12 order-2 order-xl-1">
                                    <div class="form-group m-form__group row align-items-center">
                                        <div class="col-md-4">
                                            <div class="m-form__group m-form__group--inline w100 admin-item">
                                                <div class="m-form__label displayb">
                                                    <label>
                                                        Gehaltsvorstellung:
                                                    </label>
                                                </div>
                                                <div class="m-form__control displayb">
                                                    <select multiple="multiple" class="custom-select no-border" id="m_form_rate"
                                                            name="m_form_rate[]" style="height: 130px; width: 100%;">
                                                        @foreach ($rate as $key => $val )
                                                            <option value="{{$key}}">{{$val}}</option>
                                                            <br>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-form__group m-form__group--inline w100 admin-item">
                                                <div class="m-form__label displayb">
                                                    <label>
                                                        Role:
                                                    </label>
                                                </div>
                                                <div class="m-form__control displayb">
                                                    <select multiple="multiple" class="custom-select no-border" id="m_form_role"
                                                            name="m_form_role[]" style="height: 130px; width: 100%;">
                                                        @foreach ($role as $key => $val )
                                                            <option value="{{$key}}">{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-form__group m-form__group--inline w100 admin-item">
                                                <div class="m-form__label displayb">
                                                    <label>
                                                        Sprachkenntnisse:
                                                    </label>
                                                </div>
                                                <div class="m-form__control displayb">
                                                    <select multiple="multiple" class="custom-select no-border" id="free_per_week"
                                                            name="free_per_week[]" style="height: 130px; width: 100%;">
                                                        @foreach ($availability as $key => $val )
                                                            <option value="{{$key}}">{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 order-2 order-xl-1 skill-ad" style="margin-top: 20px;">
                                    <div class="form-group m-form__group row align-items-center skill-items">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="m-form__group m-form__group--inline w100">
                                                <div class="m-form__label">
                                                    <label>
                                                        Core Skills:
                                                    </label>
                                                </div>
                                                <!-- <input type="text" id="m_typeahead_11" name="m_typeahead_11" class="form-control" /> -->
                                                <select class="form-control m-select2" id="m_select2_core" name="param"
                                                        multiple>
                                                    @foreach ($skills as $key => $val )
                                                        <option value="{{$val->id}}">{{$val->skill}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="m-form__group m-form__group--inline skill-items w100">
                                                <div class="m-form__label">
                                                    <label>
                                                        Skills:
                                                    </label>
                                                </div>
                                                <!-- <input type="text" id="m_typeahead_11" name="m_typeahead_11" class="form-control" /> -->
                                                <select class="form-control m-select2" id="m_select2_9" name="param"
                                                        multiple>
                                                    @foreach ($skills as $key => $val )
                                                        <option value="{{$val->id}}">{{$val->skill}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Search Form -->
                        <!--begin: Datatable -->
                        <style>
                            .m-datatable__cell{
                                background: #fff
                            }
                        </style>
                        <div class="loader_msg" style='display: block;'>
                            <img src="../assets/app/media/img/logos/loader.gif" width='132px' height='132px'
                                 style="height: 70px;width: 67px;margin-left: 40%;">
                        </div>
                        <div class="festanstellung_datatable" id="local_data"></div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>

        </div>
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
        <!-- end::Scroll Top -->            <!-- begin::Quick Nav -->

        <!-- begin::Quick Nav -->
        <!-- begin : CSV modal -->
        <div id="ImportCSV" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 40%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">CSV upload form</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Form -->
                        <form method="post" action="{{url('admin/freelancers/csv')}}" name="upload_file"
                              id="upload_file1" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            Select file : <input type='file' name='attach_csv' id='attach_csv' class='form-control'
                                                 required=""><br>
                            <span id="errormessage"></span>
                            <p style="color: red">* Download Sample File from <a
                                        href="{{url('admin/freelancers/csvexport')}}" id="Exportcsv">here</a></p>
                            <p style="color: red">* Please Select Only CSV format</p>
                            <button class="btn btn-primary" id="upload" name="upload" type="submit">Upload</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
@endsection
@section('js')
    <!-- <script src="{{url('assets/demo/default/custom/components/datatables/base/data-freelancers.js')}}" type="text/javascript"></script> -->
        <link rel="stylesheet" type="text/css"
              href="http://keenthemes.com/preview/metronic/theme/assets/global/plugins/typeahead/typeahead.css">
        <script src="{{asset('/js/autocomplete.js')}}" type="text/javascript"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js" type="text/javascript"></script> -->
        <script type="text/javascript">
            @if(session()->has('status'))
                swal('Success', '{{session('status')}}', 'success');
            @endif
            var categorySkills = {!! json_encode(collect($skills)->keyBy('id')) !!};
            $('#contact_link').addClass('m-menu__item--active m-menu__item--expanded m-menu__item--open');
            $('#freelancer_link').addClass('m-menu__item--active');
            $('#m_select2_9').select2({
                placeholder: "Select an option",
                maximumSelectionLength: 20
            });
            $('#m_select2_core').select2({
                placeholder: "Select an option",
                maximumSelectionLength: 20
            });
            var datatable;
            var dataWithKey = {
                '1': '20-30 K',
                '2': '30-40 K',
                '3': '40-50 K',
                '4': '50-60 K',
                '5': '60-70 K',
                '6': '70-80 K',
                '7': '80-90 K',
                '8': '90-100 K',
                '9': '100-110 K',
                '10': '110-120 K'
            };
            (function () {
                $('.loader_msg').css('display', 'none');
                var accountsdata;
                var edit_url = 'kandidaten/edit';
                datatable = $('.festanstellung_datatable').mDatatable({
                    // datasource definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: 'kandidaten/getAllFestanstellung',
                                method: 'GET',
                                // custom headers
                                headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                                params: {
                                    // custom query params
                                    query: {
                                        rate: '',
                                        role: '',
                                        skills: '',
                                        core_skills: '',
                                        free_per_week: '',
                                    }
                                },
                                map: function (raw) {
                                    console.log(raw);
                                    // sample data mapping
                                    var dataSet = raw;
                                    if (typeof raw.data !== 'undefined') {
                                        dataSet = raw.data;
                                    }
                                    return dataSet;
                                },
                            }
                        },
                        pageSize: 10,
                        saveState: {
                            cookie: false,
                            webstorage: false
                        },

                        serverPaging: false,
                        serverFiltering: false,
                        serverSorting: false
                    },
                    // layout definition
                    layout: {
                        theme: 'default', // datatable theme
                        class: '', // custom wrapper class
                        scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                        footer: false // display/hide footer
                    },
                    sortable: false,
                    pagination: true,
                    columns: [
                        {
                            field: "id",
                            title: "#",
                            selector: {class: 'm-checkbox--solid m-checkbox--brand send_mail'},
                            width: 40
                        },
                        {
                            field: "S_No",
                            title: "Sr. No.",
                            textAlign: 'center',
                            width: 40,
                            template: function (row) {
                                return '<a href="'+row.view_url+'">'+row.S_No+'</a>'
                            }
                        },
                        {
                            field: "category_skills",
                            title: "Skills",
                            width: 250,
                            template: function (row) {
                                var currentSkills = row.category_skills.split(',');
                                var skills = [];
                                for(i in currentSkills) {

                                    skills.push(categorySkills[currentSkills[i]].skill);
                                }

                                return skills.join(', ');
                            }
                        },
                        {
                            field: "hourly_rate",
                            title: "Gehaltsvorstellung",
                            width: 170,
                            template: function (row) {
                                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                                var append = '';
                                var hourly_rate = row.hourly_rate;
                                if (hourly_rate == null || hourly_rate == '') {
                                    return '\
	                    <div >\
	                      <span></span>\
	                    </div>\
	                    ';
                                }
                                hourly_rate = hourly_rate.split(',');

                                hourly_rate.forEach(function (val) {
                                    //dataWithKey
                                    append += dataWithKey[val] + ',';
                                });
                                append = append.substring(0, append.length - 1)
                                return '\
                    <div >\
                      <span>' + append + '</span></a>\
                    </div>\
                    ';
                            }
                        },

                        {
                            field: "availability",
                            title: "Sprachkenntnisse",
                            width: 150,
                            template: function (row) {
                                var currentAvailabilities = row.availability_per_week.split(',');
                                var availabilities = ['A1','A2','B1','B2','C1','C2'];
                                var currentAvailabilitiesList = [];
                                for(var i in currentAvailabilities) {
                                    currentAvailabilitiesList.push(availabilities[currentAvailabilities[i]]);
                                }

                                return currentAvailabilitiesList.join(', ');
                            }
                        },

                        {
                            field: "attached_cv",
                            title: "CV",
                            width: 150,
                            template: function (row) {
                                return row.attached_cv
                                    ? '<a target="_blank" href="'+row.cv_url+'">Download</a>'
                                    : '';
                            }
                        },

                        {
                            field: "video",
                            title: "Video",
                            width: 60,
                            template: function (row) {
                                return Number(row.video) === 1 ? 'Yes' : 'No'
                            }
                        }
                    ]
                });
                $('#m_form_rate').on('change', function (event) {
                    var value = $(this).val();
                    var role = $('#m_form_role').val();
                    var skill = $('#m_select2_9').val();
                    var core_skills = $('#m_select2_core').val();
                    var free_availabilty = $('#availability_filter').val();
                    var free_per_week = $('#free_per_week').val();
                    var cv_recieved = $('#cv_filter').val();
                    if (value == '') {
                        datatable.search(value, 'Status');
                    }

                    datatable.setDataSourceQuery({
                        rate: value,
                        role: role,
                        skills: skill,
                        core_skills: core_skills,
                        free_per_week: free_per_week
                    });
                    datatable.reload();
                });
                $('#m_select2_9').on('change', function () {
                    var value = $(this).val();
                    var rate = $('#m_form_rate').val();
                    var role = $('#m_form_role').val();
                    var core_skills = $('#m_select2_core').val();
                    var free_availabilty = $('#availability_filter').val();
                    var free_per_week = $('#free_per_week').val();
                    var cv_recieved = $('#cv_filter').val();
                    if (value == '') {
                        datatable.search(value, 'Status');
                    }

                    datatable.setDataSourceQuery({
                        rate: rate,
                        role: role,
                        skills: value,
                        core_skills: core_skills,
                        free_per_week: free_per_week
                    });
                    datatable.reload();

                });
                $('#m_select2_core').on('change', function () {
                    var value = $(this).val();
                    var rate = $('#m_form_rate').val();
                    var role = $('#m_form_role').val();
                    var skill = $('#m_select2_9').val();
                    var free_availabilty = $('#availability_filter').val();
                    var free_per_week = $('#free_per_week').val();
                    var cv_recieved = $('#cv_filter').val();
                    if (value == '') {
                        datatable.search(value, 'Status');
                    }

                    datatable.setDataSourceQuery({
                        rate: rate,
                        role: role,
                        skills: skill,
                        core_skills: value,
                        free_per_week: free_per_week
                    });
                    datatable.reload();

                });
                $('#m_form_role').on('change', function (event) {
                    var value = $(this).val();
                    var rate = $('#m_form_rate').val();
                    var skill = $('#m_select2_9').val();
                    var core_skills = $('#m_select2_core').val();
                    var free_availabilty = $('#availability_filter').val();
                    var free_per_week = $('#free_per_week').val();
                    var cv_recieved = $('#cv_filter').val();
                    if (value == '') {
                        datatable.search(value, 'Status');
                    }

                    datatable.setDataSourceQuery({
                        rate: rate,
                        role: value,
                        skills: skill,
                        core_skills: core_skills,
                        free_per_week: free_per_week
                    });
                    datatable.reload();

                });
                $('#availability_filter').on('change', function (event) {
                    var value = $(this).val();
                    var rate = $('#m_form_rate').val();
                    var skill = $('#m_select2_9').val();
                    var core_skills = $('#m_select2_core').val();
                    var role = $('#m_form_role').val();
                    var free_per_week = $('#free_per_week').val();
                    var cv_recieved = $('#cv_filter').val();
                    if (value == '') {
                        datatable.search(value, 'Status');
                    }

                    datatable.setDataSourceQuery({
                        rate: rate,
                        role: role,
                        skills: skill,
                        core_skills: core_skills,
                        free_per_week: free_per_week
                    });
                    datatable.reload();

                });
                $('#free_per_week').on('change', function (event) {
                    var value = $(this).val();
                    var rate = $('#m_form_rate').val();
                    var skill = $('#m_select2_9').val();
                    var core_skills = $('#m_select2_core').val();
                    var role = $('#m_form_role').val();
                    var free_availabilty = $('#availability_filter').val();
                    var cv_recieved = $('#cv_filter').val();
                    if (value == '') {
                        datatable.search(value, 'Status');
                    }

                    datatable.setDataSourceQuery({
                        rate: rate,
                        role: role,
                        skills: skill,
                        core_skills: core_skills,
                        free_per_week: value
                    });
                    datatable.reload();

                });
                $('#cv_filter').on('change', function (event) {
                    var value = $(this).val();
                    var rate = $('#m_form_rate').val();
                    var skill = $('#m_select2_9').val();
                    var core_skills = $('#m_select2_core').val();
                    var role = $('#m_form_role').val();
                    var free_availabilty = $('#availability_filter').val();
                    var free_per_week = $('#free_per_week').val();
                    if (value == '') {
                        datatable.search(value, 'Status');
                    }

                    datatable.setDataSourceQuery({
                        rate: rate,
                        role: role,
                        skills: skill,
                        core_skills: core_skills,
                        free_per_week: free_per_week
                    });
                    datatable.reload();

                });
                //$('#m_form_role, #m_form_rate,#m_form_skills').selectpicker();
            })();

            $(document).ready(function () {
                $('#festanstellung_send').hide();

                $(".festanstellung_datatable").on('change', '.send_mail', function () {

                    //alert('Hello Argon');
                    var checkbox_val = $(this).find(':first-child').val();
                    //alert(checkbox_val);

                    var selected = '';
                    //alert(selected);
                    // $('.loader_msg').css('display','none');
                    $("input:checkbox:checked").each(function () {
                        if ($(this).val() != 'on') {
                            selected += $(this).val() + ',';
                        }
                    });

                    // $("#btnSend").attr('href', 'mailto:'+selected.slice(0, -1));

                    if (selected.slice(0, -1) != '') {
                        $('#festanstellung_send').show();
                        $('#festanstellung_id').val(selected.slice(0, -1));
                        console.log(selected.slice(0, -1));
                    }
                    else {
                        $('#festanstellung_send').hide();
                    }

                });
            });
        </script>

@endsection

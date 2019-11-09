<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Argon | Employees
    </title>
@extends('layouts.admin_dashboard')
@section('content')
    @foreach ($details as $details)
    @endforeach
    <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-page-title ">
                            <a href="{{ url('/admin/employees')}}">Employess </a> / {{$details->first_name}} / View
                            Permission
                        </h3>
                    </div>
                </div>
            </div>
            @if (session('update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                     style="display: block; padding: 10px; margin:27px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <p class="message">
                        {{session('update')}}
                    </p>
                </div>@endif
            <div class="sub_btn_header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto sub_btn">
                        <button data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
                            <span>DELETE</span>
                        </button>
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
                                            Are you sure you wish to delete this Employee.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                        <button type="button" id="deleteEmployee" data-id="{{$employee->id}}"
                                                class="btn btn-danger">Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Employee Permission
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                                      id="setpermission" name="setpermission"
                                      action="{{url('admin/employees/setPermission/'.$employee->id)}}">
                                    {{ csrf_field() }}
                                    @php $kunden_roles = explode(',', $details->kunden_permission); @endphp
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-12">
                                            <div class="panel-group" id="kunden">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" data-toggle="collapse"
                                                         data-parent="#kunden" href="#kunden_permission"
                                                         style="cursor: pointer;">
                                                        <div class="panel-title">
                                                            <a class="m-tabs__link" role="tab">Kunden Roles</a>
                                                        </div>
                                                    </div>

                                                    <div id="kunden_permission" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="m-checkbox-inline">
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="kunden_roles[]" class="employee_roles"
                                                                           value="all"
                                                                           type="checkbox" @if(in_array("all", $kunden_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">All
                                                                            Kunden
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="kunden_roles[]" class="employee_roles"
                                                                           value="add"
                                                                           type="checkbox" @if(in_array("add", $kunden_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Add
                                                                            Kunden
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="kunden_roles[]" class="employee_roles"
                                                                           value="edit"
                                                                           type="checkbox" @if(in_array("edit", $kunden_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Edit
                                                                            Kunden
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="kunden_roles[]" class="employee_roles"
                                                                           value="delete"
                                                                           type="checkbox" @if(in_array("delete", $kunden_roles)) {{ 'checked' }} @endif>Delete
                                                                    Kunden
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php $manager_roles = explode(',', $details->knotakte_permission); @endphp
                                        <div class="col-lg-12">
                                            <div class="panel-group" id="contacts">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" data-toggle="collapse"
                                                         data-parent="#contacts" href="#contacts_permission"
                                                         style="cursor: pointer;">
                                                        <div class="panel-title">
                                                            <a class="m-tabs__link" role="tab">Manager Roles</a>
                                                        </div>
                                                    </div>

                                                    <div id="contacts_permission" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="m-checkbox-inline">
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="manager_roles[]" class="employee_roles"
                                                                           value="all"
                                                                           type="checkbox" @if(in_array("all", $manager_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">All
                                                                            Kontakte
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="manager_roles[]" class="employee_roles"
                                                                           value="add"
                                                                           type="checkbox" @if(in_array("add", $manager_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Add
                                                                            Kontakte
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="manager_roles[]" class="employee_roles"
                                                                           value="edit"
                                                                           type="checkbox" @if(in_array("edit", $manager_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Edit
                                                                            Kontakte
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="manager_roles[]" class="employee_roles"
                                                                           value="delete"
                                                                           type="checkbox" @if(in_array("delete", $manager_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Delete
                                                                            Kontakte
                                                                        </font></font><span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php $opportunity_roles = explode(',', $details->projektanfrage_permission); @endphp
                                        <div class="col-lg-12">
                                            <div class="panel-group" id="opportunity">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" data-toggle="collapse"
                                                         data-parent="#opportunity" href="#opportunity_permission"
                                                         style="cursor: pointer;">
                                                        <div class="panel-title">
                                                            <a class="m-tabs__link" role="tab">Projektanfragen Roles</a>
                                                        </div>
                                                    </div>

                                                    <div id="opportunity_permission" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="m-checkbox-inline">
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="opportunity_roles[]"
                                                                           class="employee_roles" value="all"
                                                                           type="checkbox" @if(in_array("all", $opportunity_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">All
                                                                            Projektanfragen
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="opportunity_roles[]"
                                                                           class="employee_roles" value="add"
                                                                           type="checkbox" @if(in_array("add", $opportunity_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Add
                                                                            Projektanfragen
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="opportunity_roles[]"
                                                                           class="employee_roles" value="edit"
                                                                           type="checkbox" @if(in_array("edit", $opportunity_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Edit
                                                                            Projektanfragen
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="opportunity_roles[]"
                                                                           class="employee_roles" value="delete"
                                                                           type="checkbox" @if(in_array("delete", $opportunity_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Delete
                                                                            Projektanfragen
                                                                        </font></font><span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php $freelancer_roles = explode(',', $details->kandidaten_permission); @endphp
                                        <div class="col-lg-12">
                                            <div class="panel-group" id="freelancers">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" data-toggle="collapse"
                                                         data-parent="#freelancers" href="#freelancer_permission"
                                                         style="cursor: pointer;">
                                                        <div class="panel-title">
                                                            <a class="m-tabs__link" role="tab">Kandidaten Roles</a>
                                                        </div>
                                                    </div>

                                                    <div id="freelancer_permission" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="m-checkbox-inline">
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="freelancer_roles[]"
                                                                           class="employee_roles" value="all"
                                                                           type="checkbox" @if(in_array("all", $freelancer_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">View
                                                                            Kandidaten
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="freelancer_roles[]"
                                                                           class="employee_roles" value="add"
                                                                           type="checkbox" @if(in_array("add", $freelancer_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Add
                                                                            Kandidaten
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="freelancer_roles[]"
                                                                           class="employee_roles" value="edit"
                                                                           type="checkbox" @if(in_array("edit", $freelancer_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Edit
                                                                            Kandidaten
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="freelancer_roles[]"
                                                                           class="employee_roles" value="delete"
                                                                           type="checkbox" @if(in_array("delete", $freelancer_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Delete
                                                                            Kandidaten
                                                                        </font></font><span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php $festanstellung_roles = explode(',', $details->festanstellung_permission); @endphp
                                        <div class="col-lg-12">
                                            <div class="panel-group" id="festanstellung">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" data-toggle="collapse"
                                                         data-parent="#festanstellung" href="#festanstellung_permission"
                                                         style="cursor: pointer;">
                                                        <div class="panel-title">
                                                            <a class="m-tabs__link" role="tab">Festanstellung Roles</a>
                                                        </div>
                                                    </div>

                                                    <div id="festanstellung_permission" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="m-checkbox-inline">
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="festanstellung_roles[]"
                                                                           class="employee_roles" value="all"
                                                                           type="checkbox" @if(in_array("all", $festanstellung_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">View
                                                                            Festanstellung
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="festanstellung_roles[]"
                                                                           class="employee_roles" value="add"
                                                                           type="checkbox" @if(in_array("add", $festanstellung_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Add
                                                                            Festanstellung
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="festanstellung_roles[]"
                                                                           class="employee_roles" value="edit"
                                                                           type="checkbox" @if(in_array("edit", $festanstellung_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Edit
                                                                            Festanstellung
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="festanstellung_roles[]"
                                                                           class="employee_roles" value="delete"
                                                                           type="checkbox" @if(in_array("delete", $festanstellung_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Delete
                                                                            Festanstellung
                                                                        </font></font><span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php $task_roles = explode(',', $details->task_permission); @endphp
                                        <div class="col-lg-12">
                                            <div class="panel-group" id="task">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" data-toggle="collapse"
                                                         data-parent="#task" href="#task_permission"
                                                         style="cursor: pointer;">
                                                        <div class="panel-title">
                                                            <a class="m-tabs__link" role="tab"><font
                                                                        style="vertical-align: inherit;">Task Roles</a>
                                                        </div>
                                                    </div>

                                                    <div id="task_permission" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="m-checkbox-inline">
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="task_roles[]" class="employee_roles"
                                                                           value="all"
                                                                           type="checkbox" @if(in_array("all", $task_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">All
                                                                            Task
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="task_roles[]" class="employee_roles"
                                                                           value="add"
                                                                           type="checkbox" @if(in_array("add", $task_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Add
                                                                            Task
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="task_roles[]" class="employee_roles"
                                                                           value="edit"
                                                                           type="checkbox" @if(in_array("edit", $task_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Edit
                                                                            Task
                                                                        </font></font><span></span>
                                                                </label>
                                                                <label class="m-checkbox ItDoubleCheck">
                                                                    <input name="task_roles[]" class="employee_roles"
                                                                           value="delete"
                                                                           type="checkbox" @if(in_array("delete", $task_roles)) {{ 'checked' }} @endif><font
                                                                            style="vertical-align: inherit;"><font
                                                                                style="vertical-align: inherit;">Delete
                                                                            Task
                                                                        </font></font><span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-4 pull-right">
                                            <button type="button" id="m_employee_permission"
                                                    name="m_employee_permission" class="btn btn-primary">
                                                Update Permission
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Employee Goal
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                                      id="setGoal" name="setGoal">
                                    {{ csrf_field() }}
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label>
                                                Client Activity:
                                            </label>
                                            <input type="text" name="client_activity" id="client_activity"
                                                   class="form-control" placeholder="Client Activity Goal">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>
                                                Client Add :
                                            </label>
                                            <input type="text" name="client_add" id="client_add" class="form-control"
                                                   placeholder="Client Added Goal">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label>
                                                Candidate Add :
                                            </label>
                                            <input type="text" name="candidate_add" id="candidate_add"
                                                   class="form-control" placeholder="Candidate Added Goal">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>
                                                Opportunity Add :
                                            </label>
                                            <input type="text" name="oppo_add" id="oppo_add" class="form-control"
                                                   placeholder="Opportunity Added Goal">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="button" id="m_employee_goal" name="m_employee_goal"
                                                    class="btn btn-primary">
                                                Submit
                                            </button>
                                            <a href="{{url('admin/employees')}}" class="btn btn-secondary">
                                                Cancel
                                            </a>
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
        </div>
        </div>

        <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
             data-scroll-speed="300">
            <i class="la la-arrow-up"></i>
        </div>
        <!-- end::Scroll Top -->
@endsection
@section('js')
        <style type="text/css">
            .panel-default .panel-heading a {
                color: #fff;
            }

            .panel-default .panel-heading {
                background-color: #5757f3;
                border-top-left-radius: 3px;
                border-top-right-radius: 3px;
                padding: 10px 15px;
                margin: 0 0 3px;
            }

            .panel-collapse {
                padding: 10px !important;
            }

            .m-checkbox {
                margin: 0px 30px !important;
            }
        </style>
        <script type="text/javascript">
            $('#employee_link').addClass('m-menu__item--active');
        </script>
        <script type="text/javascript">
            var goal_by = {{$employee->id}};
            $.ajax({
                url: '../../employees/getgoalDetails',
                data: {id: goal_by},
                'async': false,
                success: function (response) {
                    if (response != '') {
                        $('#client_activity').val(response.client_activity);
                        $('#client_add').val(response.client_add);
                        $('#candidate_add').val(response.candidate_add);
                        $('#oppo_add').val(response.oppo_add);
                    }

                }
            });
            $('#m_employee_goal').on('click', function () {
                var client_activity = $('#client_activity').val();
                var client_add = $('#client_add').val();
                var candidate_add = $('#candidate_add').val();
                var oppo_add = $('#oppo_add').val();
                $.ajax({
                    url: '../../employees/setGoal',
                    data: {
                        goal_by: goal_by,
                        client_activity: client_activity,
                        client_add: client_add,
                        candidate_add: candidate_add,
                        oppo_add: oppo_add
                    },
                    success: function (response) {
                        var res = $.parseJSON(response);
                        if (res.status == 'error') {
                            swal('Error', res.message, 'error');
                        }
                        else {
                            swal('Success', res.message, 'success');
                            setTimeout(function () {
                                window.location.replace('');
                            }, 2000);
                        }
                    }
                });
            });
            $('#m_employee_permission').click(function () {
                var value = $("input:checkbox[class=employee_roles]:checked").val();
                if (value != undefined) {
                    $('#setpermission').submit();
                }
                else {
                    swal('Error', 'Please Select Atleast one permission', 'error');
                    return false;
                }
            });
            $('#deleteEmployee').click(function () {
                var id = $(this).attr('data-id');
                url = '../delete'
                $.ajax({
                    url: url + '/' + id,
                    success: function (response) {
                        var res = response;
                        if (res.status == 'error') {
                            swal('Error', res.message, 'error');
                        }
                        else {
                            swal('Success', res.message, 'success');
                            setTimeout(function () {
                                window.location.replace('../../employees');
                            }, 2000);
                        }
                    }
                });
            });
        </script>
@endsection
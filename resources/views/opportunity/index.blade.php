<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        Argon | Projektanfragen
    </title>
    @extends('layouts.admin_dashboard')
    @section('content')
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-page-title">
                            Home / Projektanfragen und Jobs
                        </h3>
                    </div>
                </div>
            </div>

            <!-- END: Subheader -->
            <div class="m-content">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__body">
                        <!--begin: Search Form -->
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">

                                <div class="col-xl-12 order-1 order-xl-2 m--align-right">
                                    <select class="selectpicker pull-right" id="load_list" name="load_list">
                                        <option value="">Load List</option>
                                        @foreach($opportunity_list as $item)
                                            <option value="{{$item->list_name}}">{{$item->list_name}}</option>
                                        @endforeach
                                    </select>
                                    @php if(count($opportunity_list)>0){ @endphp
                                    <button href="" class="btn btn-primary" data-toggle="modal" data-target="#viewList">
                                                <span>
                                                    <i class="m-menu__link-icon flaticon-list"></i>
                                                    <span>
                                                        View List
                                                    </span>
                                                </span>
                                    </button>
                                    @php } @endphp
                                    <button class="btn btn-primary" id="createlist" data-toggle="modal"
                                            data-target="#createList">
                                                <span>
                                                    <i class="m-menu__link-icon flaticon-user-add"></i>
                                                    <span>
                                                        CreateList
                                                    </span>
                                                </span>
                                    </button>
                                    @can('project-inquiries-create')
                                        <a href="#" class="btn m-btn--pill btn-success" data-toggle="modal"
                                           data-target="#addOpportunityModal">
                                                <span>
                                                    <i class="m-menu__link-icon flaticon-user-add"></i>
                                                    <span>
                                                        ADD NEW PROJEKTANFRAGEN
                                                    </span>
                                                </span>
                                        </a>
                                    @endcan
                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                </div>
                            </div>
                        </div>
                        <!--end: Search Form -->
                        <!--begin: Datatable -->
                        <div class="loader_msg" style='display: block;'>
                            <img src="../assets/app/media/img/logos/loader.gif" width='132px' height='132px'
                                 style="height: 70px;width: 67px;margin-left: 40%;">
                        </div>
                        <div class="m_datatable" id="local_data"></div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>

        </div>
        </div>
        <!-- Add Contact Modal -->
        <div id="createList" class="modal fade" role="dialog" style="">
            <div class="modal-dialog" style="width: 50%;">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create Opportunity List</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <input type="text" name="list_name" id="list_name" class="form-control m-input"
                                       placeholder="Enter List Name Without Space and Characters Only"
                                       required="required">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label for="technology" style="width: 100%;">
                                    Technology:
                                </label>
                                <select class="custom-select" id="oppo_technology" name="oppo_technology">
                                    <option value="">Please Select Technology</option>
                                    <option value="Microsoft .Net">Microsoft .Net</option>
                                    <option value="Java">Java</option>
                                    <option value="SAP">SAP</option>
                                    <option value="PHP">PHP</option>
                                    <option value="NSI">NSI</option>
                                    <option value="Embedded">Embedded</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label style="width: 100%;">
                                    Coding :
                                </label>
                                <select class="form-control m-select2" id="m_select2_9" name="param" multiple>
                                    @foreach ($skills as $key => $val )
                                        <option value="{{$val->skill}}">{{$val->skill}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label for="hotness" style="width: 100%;">
                                    Hotness of client:
                                </label>
                                <input type="text" name="hotness_client" id="hotness_client"
                                       class="form-control m-input" placeholder="Enter Hotness of Client">
                            </div>
                            <div class="col-lg-6">
                                <label for="list_type" style="width: 100%;">
                                    Opportunity Type :
                                </label>
                                <select class="custom-select" id="list_type" name="list_type">
                                    <option value="">Please Select Type of Opportunity</option>
                                    <option value="0">Contract</option>
                                    <option value="1">Permanent</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label for="technology" style="width: 100%;">
                                    Opportunity Status:
                                </label>
                                <select class="custom-select" id="opportunity_status" name="opportunity_status">
                                    <option value="">Please Select Status of Opportunity</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="opportunityList" class="btn btn-info">Create List</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="viewList" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 80%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" id="closemodal">&times;</button>
                        <h4 class="modal-title">View List</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Form -->
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr>
                                        <th>S.No</th>
                                        <th>List Name</th>
                                        <th>Technology</th>
                                        <th>Coding</th>
                                        <th>Hotness</th>
                                        <th>Opportunity Type</th>
                                        <th>Opportunity Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @php $i = 1; @endphp
                                    @foreach($opportunity_list as $item)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->list_name}}</td>
                                            <td>{{$item->oppo_technology}}</td>
                                            <td>{{$item->detailed_coding}}</td>
                                            <td>{{$item->hotness_client}}</td>
                                            @if($item->list_type=='0')
                                                <td>{{ 'Contract' }}</td>
                                            @elseif($item->list_type=='1')
                                                <td>{{ 'Permanent' }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if($item->opportunity_status=='0')
                                                <td>{{ 'Inactive' }}</td>
                                            @elseif($item->opportunity_status=='1')
                                                <td>{{ 'Active' }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td style="width: 10px;">
                                                <a data-id='+row.id+' class="comment_del pull-right"
                                                   onclick="deleteList({{$item->id}})">
                                                    <span><i class="fa fa-trash-o"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                        @php $i++ ; @endphp
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div id="addOpportunityModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <!--  -->
                        <div class="col-lg-4">
                            <h4 class="modal-title">Add Projektanfragen</h4>
                        </div>
                        <div class="col-lg-8" style="margin-top: 34px;">
                            <form name="select_account" id="select_account" method="post">
                                <select class="custom-select" name="account_name" id="account_name">
                                    <option value="">Please Select Kunden</option>
                                    @foreach($accounts as $item)
                                        <option value="{{$item->id}}">{{$item->account_name}}</option>
                                    @endforeach
                                </select>
                                <select class="custom-select" name="opportunity_type" id="opportunity_type">
                                    <option value="">Select Opportunity Type</option>
                                    <option value="0">Permanent</option>
                                    <option value="1">Contract</option>
                                </select>
                                <button id="account_select" name="account_select" class="btn btn-primary"
                                        style="margin-left:10px;">Submit
                                </button>
                                <button type="button" id="reset_form" class="btn btn-default"
                                        style="margin-left: 10px;">Reset
                                </button>
                                <div>
                    <span class="m-form__help" style="color: red; float: left;">
                    * Please Select Client First then You will Able to add Projektanfragen</span>
                                </div>


                            </form>
                        </div>
                    </div>
                    <div class="modal-body">
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                              id="addOpportunity" name="addOpportunity" style="display: none;">
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Opportunity Name *:
                                        </label>
                                        <input type="hidden" name="account_id" id="account_id">
                                        <input type="hidden" name="oppo_type" id="oppo_type">
                                        <input type="text" name="name" id="name" class="form-control m-input"
                                               placeholder="Enter Opportunity name">
                                        <div class="error_msg">
                                            <span class="name"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Closed Date *:
                                        </label>
                                        <input type="text" name="close_date" readonly id="close_date"
                                               class="form-control m-input" placeholder="Enter Closed Date">
                                        <div class="error_msg">
                                            <span class="close_date"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label style="width: 100%;">
                                            Select Probability *:
                                        </label>
                                        <select class="custom-select" id="probability" name="probability">
                                            <option value="">
                                                Please Select Probability Of Opportunity
                                            </option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="75">75</option>
                                            <option value="100">100</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="probability"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label style="width: 100%;">
                                            Hotness of Client:
                                        </label>
                                        <input type="text" class="form-control m-input" id="hotness" name="hotness"
                                               placeholder="Hotness of Client" readonly="readonly">
                                        <!-- <select class="custom-select" id="hotness" name="hotness" disabled>
                                                <option value="">
                                                Please Select Client Specification</option>
                                                <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
                                            </select> -->
                                        <div class="error_msg">
                                            <span class="hotness"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label style="width: 100%;">
                                            Select Source of Opportunity*:
                                        </label>
                                        <select class="custom-select" id="source" name="source">
                                            <option value="">
                                                Please Select Source of Opportunity
                                            </option>
                                            <option value="Advertisement">Advertisement</option>
                                            <option value="Email">Email</option>
                                            <option value="Mailshot">Mailshot</option>
                                            <option value="Pay Per Click">Pay Per Click</option>
                                            <option value="Press">Press</option>
                                            <option value="Referral">Referral</option>
                                            <option value="Social">Social</option>
                                            <option value="Telephone">Telephone</option>
                                            <option value="Web Search">Web Search</option>
                                            <option value="Web site">Web site</option>
                                            <option value="Word of Mouth">Word of Mouth</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="source"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="process">
                                            Process:
                                        </label>
                                        <select multiple="multiple" class="custom-select" id="process" name="process[]"
                                                style="height: 99px; width: 100%;">
                                            <option value="Xing">Xing</option>
                                            <option value="Freelance.de">Freelance.de</option>
                                            <option value="Freelancermap.de">Freelancermap.de</option>
                                            <option value="Called Top Candidates">Called Top Candidates</option>
                                            <option value="Internal CRM System">Internal CRM System</option>
                                            <option value="LinkedIn">LinkedIn</option>
                                            <option value="Suggestion from Freelancer">Suggestion from Freelancer
                                            </option>
                                            <option value="Google Search Companies">Google Search Companies</option>
                                            <option value="Google Search Freelancers">Google Search Freelancers</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="process"></span>
                                        </div>
                                    </div>


                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label style="width: 100%;">
                                            Select Technology *:
                                        </label>
                                        <select class="custom-select" id="technology" name="technology">
                                            <option value="">
                                                Please Select Technology
                                            </option>
                                            <option value="Microsoft .Net">Microsoft .Net</option>
                                            <option value="Java">Java</option>
                                            <option value="SAP">SAP</option>
                                            <option value="PHP">PHP</option>
                                            <option value="NSI">NSI</option>
                                            <option value="Embedded">Embedded</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="technology"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Client Name *:
                                        </label>
                                        <input type="text" name="client_name" id="client_name"
                                               class="form-control m-input" placeholder="Enter Opportunity name"
                                               readonly="readonly">
                                        <div class="error_msg">
                                            <span class="client_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Client Telephone Number *:
                                        </label>
                                        <input type="text" name="client_number" id="client_number"
                                               class="form-control m-input" placeholder="Enter Opportunity name"
                                               readonly="readonly">
                                        <div class="error_msg">
                                            <span class="client_number"></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Info Field :
                                        </label>
                                        <input type="text" name="info_field" id="info_field"
                                               class="form-control m-input" placeholder="Enter Info Field">
                                        <div class="error_msg">
                                            <span class="info_field"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Outcome Of Opportunity :
                                        </label>
                                        <textarea class="form-control m-input m-input--air" name="report" id="report"
                                                  rows="3"></textarea>
                                        <div class="error_msg">
                                            <span class="report"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label style="width: 100%;">
                                            Number of Profile Sent :
                                        </label>
                                        <select class="custom-select" id="profile_sent" name="profile_sent">
                                            <option value="">
                                                Please Select Numeber of Profile sent
                                            </option>
                                            @for ($i = 1; $i <= 50; $i++)
                                                <option value="{{$i}}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <div class="error_msg">
                                            <span class="profile_field"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Repeat Order :
                                        </label>
                                        <input type="checkbox" name="repeat_order" id="repeat_order"
                                               data-toggle="toggle">
                                        <div class="error_msg">
                                            <span class="repeat_order"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Active Opportunity :
                                        </label>
                                        <input type="checkbox" name="opportunity_status" id="opportunity_status"
                                               data-toggle="toggle">
                                        <div class="error_msg">
                                            <span class="opportunity_status"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-8">
                                            <button type="submit" id="m_login_signin_submit"
                                                    name="m_login_signin_submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>

            </div>
        </div>
        <!-- end:: Page -->
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
        <!-- end::Scroll Top -->
        <!-- begin::Quick Nav -->
@endsection
@section('js')
    <!--begin::Base Scripts -->
        <script src="{{asset('/js/opportunity.js')}}" type="text/javascript"></script>
        <script>
            $('#m_select2_9').select2({
                placeholder: "Select an option",
                maximumSelectionLength: 20
            });
            $('#opportunity_link').addClass('m-menu__item--active');
            $("#reset_form").click(function () {
                $("#account_name").val('');
                $("#opportunity_type").val('');
                $("#account_name").prop('disabled', false);
                $("#opportunity_type").prop('disabled', false);
                $("#addOpportunity").css("display", "none");
                $('#addOpportunity')[0].reset();
                $("#repeat_order").parent().addClass('off');
                $("#repeat_order").parent().addClass('btn-default');
                $("#repeat_order").parent().removeClass('btn-primary');
            })

            function showData(id) {
                var path = document.location.href + "/showData/" + id;
                $.ajax({
                    url: path,
                    type: "GET",
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}',
                    },
                    success: function (result) {
                        console.log(result);
                        var res = $.parseJSON(result);

                        if (res.status == 'error') {

                        }
                        else {
                            var data = $.parseJSON(JSON.stringify(res.message));
                            $("#client_name").val(data.account_name);
                            $("#client_number").val(data.telephone);
                            $("#hotness").val(data.client_specification);

                        }
                    },
                    error: function () {
                        alert("Error");
                    }
                });
            }

            function deleteList(id) {
                swal({
                        title: "Are you sure to delete this List?",
                        text: "Your will not be able to recover this List!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false,
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            var del_id = id;
                            url = 'opportunity/deleteList';
                            $.ajax({
                                url: url + '/' + id,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (data) {
                                    var res = $.parseJSON(data);
                                    if (res.status == 'error') {
                                        swal('Error', res.message, 'error');
                                    }
                                    else {
                                        swal('Success', res.message, 'success');
                                        setTimeout(function () {
                                            window.location.replace('');
                                        }, 2000);
                                    }
                                },
                                error: function (data) {
                                    swal('Error', data, 'error');
                                }
                            });
                        }
                        else {

                        }
                    });
            }
        </script>
        <style type="text/css">
            .select2-container {
                width: 250px !important;
            }

            .select2-search__field {
                width: 200px !important;
            }
        </style>
@endsection
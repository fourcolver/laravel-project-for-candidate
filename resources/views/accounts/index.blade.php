<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Argon | Kunden
    </title>
    @extends('layouts.admin_dashboard')
    @section('content')
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-page-title">
                            Home / Kunden
                        </h3>
                    </div>
                    @if(Auth::user()->isAdmin)
                        <a href="{{url('admin/accounts/exportAccountCsv')}}" class="btn btn-primary m-btn m-btn--icon"
                           id="export_csv" style="margin-top: -30px;">
                            <span>
                                <i class="la la-cloud-download"></i>
                                <span>
                                Export Clients
                                </span>
                            </span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="m-content">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__body">
                        <!--begin: Search Form -->
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-xl-4 order-2 order-xl-1">
                                    <div class="form-group m-form__group row align-items-center">
                                        <div class="col-xl-12 pull-right">
                                            <select class="selectpicker" id="load_list" name="load_list">
                                                <option value="">Load List</option>
                                                @foreach($accountLists as $accountList)
                                                    <option value="{{$accountList->id}}">{{$accountList->list_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 order-1 order-xl-2 m--align-right">
                                    <!--    Check Permission For Employee -->
                                    @can('customers-create')
                                        <a href=""
                                           class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"
                                           data-toggle="modal" data-target="#addAccountsModal">
                                                <span>
                                                    <i class="m-menu__link-icon flaticon-user-add"></i>
                                                    <span>
                                                        ADD NEW CLIENT
                                                    </span>
                                                </span>
                                        </a>
                                    @endcan
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#createList">
                                                <span>
                                                    <i class="m-menu__link-icon flaticon-user-add"></i>
                                                    <span>
                                                        Create List
                                                    </span>
                                                </span>
                                    </a>
                                    @if($accountLists->count())
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#viewList">
                                        <span>
                                            <i class="m-menu__link-icon flaticon-list"></i>
                                            <span>View List</span>
                                        </span>
                                    </a>
                                    @endif
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
                        <div class="m_datatable" id="local_data">
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>

        </div>
        </div>

        <div id="addAccountsModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                        <h4 class="modal-title">Add New Client</h4>
                    </div>
                    <div class="modal-body">
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                              id="addAccount" name="addAccount">
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Kunden Name *:
                                        </label>
                                        <input type="text" name="account_name" id="account_name"
                                               class="form-control m-input"
                                               placeholder="Enter Kunden_name Minimum 3 characters">
                                        <div class="error_msg">
                                            <span class="account_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="Pozesse" style="width: 100%;">
                                            Prozesse of Kunden :
                                        </label>
                                        <select class="custom-select" id="prozesse" name="prozesse">
                                            <option value="">Please Select the Prozesse</option>
                                            <option value="Telefon Interview">Telefon Interview</option>
                                            <option value="Telefon Interview und Vor-Ort Gespräch">Telefon Interview und
                                                Vor-Ort Gespräch
                                            </option>
                                            <option value="Vor-Ort Gespräch">Vor-Ort Gespräch</option>
                                            <option value="Testaufgabe">Testaufgabe</option>
                                            <option value="NSI">NSI</option>
                                            <option value="Embedded">Embedded</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="prozesse"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="freelancers" style="width: 100%;">
                                            No. of Freelancers :
                                        </label>
                                        <select class="custom-select" id="freelancers" name="freelancers">
                                            <option value="">
                                                Please Select Number of Freelancers
                                            </option>
                                            @for ($i = 1; $i <= 100; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <div class="error_msg">
                                            <span class="freelancers"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label for="Countries" style="width: 100%;">
                                            Select Country *:
                                        </label>
                                        <select class="custom-select" name="country" id="country">
                                            <optgroup label="Mostly Used">
                                                @foreach($countries as $item)
                                                    @if($item->default_country == '1')
                                                        <option value="{{$item->name}}" @if($item->name== 'Germany') {{ 'selected' }}@endif>{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Other Countries">
                                                @foreach($countries as $item)
                                                    if($item->default_country != '1')
                                                    {
                                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                                    }
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        <div class="error_msg">
                                            <span class="country"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            City :
                                        </label>
                                        <input type="text" name="city" id="city" class="form-control m-input"
                                               placeholder="Enter Your city">
                                        <div class="error_msg">
                                            <span class="city"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Postcode/Zip *:
                                        </label>
                                        <input type="text" name="pincode" id="pincode" class="form-control m-input"
                                               placeholder="Enter Your Post Code">
                                        <div class="error_msg">
                                            <span class="pincode"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label for="technology">
                                            Technological Focus:
                                        </label>
                                        <select multiple="multiple" class="custom-select" id="Technology"
                                                name="Technology[]" style="height: 99px; width: 100%;">
                                            <option value="Microsoft .Net">Microsoft .Net</option>
                                            <option value="Java">Java</option>
                                            <option value="SAP">SAP</option>
                                            <option value="PHP">PHP</option>
                                            <option value="NSI">NSI</option>
                                            <option value="Embedded">Embedded</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="Technology"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label style="width: 100%;">
                                            Owner of Client:
                                        </label>
                                        <select class="custom-select" name="owner" id="owner">
                                            <option value="">
                                                Please Select Owner of Account
                                            </option>
                                            @foreach($users as $item)
                                                <option value="{{$item->id}}">{{$item->first_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="error_msg">
                                            <span class="owner"></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-4">
                                        <label>
                                            Note :
                                        </label>
                                        <textarea class="form-control m-input m-input--air" name="note" id="note" rows="4" placeholder="Enter Note"></textarea>
                                    </div> -->
                                    <div class="col-lg-4">
                                        <label for="client_specification" style="width: 100%;">
                                            Hotness Of Client :
                                        </label>
                                        <select class="custom-select" id="client_specification"
                                                name="client_specification">
                                            <option value="">
                                                Please Select Client Specification
                                            </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="client_specification"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">

                                    <div class="col-lg-4">
                                        <label for="source" style="width: 100%;">
                                            Select Source for Client:
                                        </label>
                                        <select class="custom-select" id="source" name="source">
                                            <option value="">
                                                Please Select Source of Client
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
                                        <label>
                                            Mobile/ Cell *:
                                        </label>
                                        <input type="text" name="telephone" id="telephone" class="form-control m-input"
                                               placeholder="Enter Your Telephone Number Only Numeric">
                                        <div class="error_msg">
                                            <span class="telephone"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            IT Department Size :
                                        </label>
                                        <input type="text" name="departement_size" id="departement_size"
                                               class="form-control m-input" placeholder="Enter Your Departement Size">
                                        <div class="error_msg">
                                            <span class="departement_size"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label style="width: 100%;">
                                            Type Of Client :
                                        </label>
                                        <select class="custom-select" id="type_of_client" name="type_of_client">
                                            <option value="">
                                                Please Select Type of Client
                                            </option>
                                            <option value="Customer">Customer</option>
                                            <option value="Previous Customer">Previous Customer</option>
                                            <option value="Potential Customer">Potential Customer</option>
                                        </select>
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
        <div id="createList" class="modal fade" role="dialog" style="">
            <div class="modal-dialog" style="width: 50%;">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create List</h4>
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
                                <label>
                                    Hotness :
                                </label>
                                <select class="form-control m-bootstrap-select m-bootstrap-select--solid"
                                        id="m_form_hotness" name="m_form_hotness">
                                    <option value="">
                                        All Clients
                                    </option>
                                    <option value="1-3">
                                        1-3
                                    </option>
                                    <option value="4-7">
                                        4-7
                                    </option>
                                    <option value="8-10">
                                        8-10
                                    </option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    Postcode :
                                </label>
                                <input type="text" name="account_postcode" id="account_postcode"
                                       class="form-control m-input" placeholder="Enter Postcode of Account">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    No. Of Freelancers :
                                </label>
                                <input type="text" name="account_freelancers" id="account_freelancers"
                                       class="form-control m-input" placeholder="Enter No. of Freelancers">
                            </div>
                            <div class="col-lg-6">
                                <label for="technology">
                                    Technology:
                                </label>
                                <select multiple="multiple" class="custom-select" id="account_technology"
                                        name="account_technology[]" style="height: 99px; width: 100%;">
                                    <option value="Microsoft .Net">Microsoft .Net</option>
                                    <option value="Java">Java</option>
                                    <option value="SAP">SAP</option>
                                    <option value="PHP">PHP</option>
                                    <option value="NSI">NSI</option>
                                    <option value="Embedded">Embedded</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    Last Contact :
                                </label>
                                <input type="text" readonly id="account_lastcontact" class="form-control m-input"
                                       placeholder="Select Last Contact Date">
                            </div>
                            <div class="col-lg-6">
                                <label style="width: 100%;">
                                    Detailed Technologies :
                                </label>
                                <select class="form-control m-select2" id="m_select2_9" name="param" multiple>
                                    @foreach ($skills as $key => $val )
                                        <option value="{{$val->skill}}">{{$val->skill}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="accountList" class="btn btn-info">Create List</button>
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
                                        <th>Hotness</th>
                                        <th>Pincode</th>
                                        <th>Freelancer</th>
                                        <th>Technology</th>
                                        <th>Last Contact</th>
                                        <th>Detailed Technologies</th>
                                        <th>Action</th>
                                    </tr>
                                    @php $i = 1; @endphp

                                </table>
                            </div>
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
        <!-- end::Scroll Top -->
@endsection
@section('js')
    <!-- <script src="{{url('assets/demo/default/custom/components/datatables/base/data-accounts.js')}}" type="text/javascript"></script> -->
        <script src="{{asset('/js/account.js')}}" type="text/javascript"></script>
        <script type="text/javascript">
            $('#account_link').addClass('m-menu__item--active');
        </script>
        <style>
            .select2-container {
                width: 100% !important;
            }

            .select2-search__field {
                width: 140px !important;
            }
        </style>
        <script type="text/javascript">
            $('#m_select2_9').select2({
                placeholder: "Select an option",
                maximumSelectionLength: 20
            });
            $('#account_lastcontact').datepicker({
                //orientation: "bottom left",
                autoclose: true,
                format: 'dd-mm-yyyy',
                minDate: 0
            });

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
                            url = 'accounts/deleteList';
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
@endsection
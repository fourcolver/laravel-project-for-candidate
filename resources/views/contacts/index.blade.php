<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Argon | Kundenkontakte und Kandidaten
    </title>
    @extends('layouts.admin_dashboard')
    @section('content')
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-page-title pull-left">
                            Home / Kontakte
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
                                <div class="col-xl-8 order-2 order-xl-1">
                                    <div class="form-group m-form__group row align-items-center">
                                        <div class="col-md-6">
                                            <div class="m-form__group m-form__group--inline">
                                                <div class="m-form__label">
                                                    <label>
                                                        Kontakte:
                                                    </label>
                                                </div>
                                                <div class="m-form__control">
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--solid"
                                                            id="m_form_status">
                                                        <option value="">
                                                            All Managers
                                                        </option>
                                                        <option value="1">
                                                            My Managers
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-input-icon m-input-icon--left">
                                                <input type="text" class="form-control m-input m-input--solid"
                                                       placeholder="Search..." id="generalSearch">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
														<span>
															<i class="la la-search"></i>
														</span>
													</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-xl-2 order-1 order-xl-2 ">
                                    <a href="" class="btn m-btn--pill btn-success" data-toggle="modal" data-target="#addColumn">
                                        <span>
                                            <i class="m-menu__link-icon flaticon-cogwheel-2"></i>
                                            <span>
                                                ADD Columns
                                            </span>
                                        </span>
                                    </a>
                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                </div> -->
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    @can('managers-create')
                                        <a href="" class="btn m-btn--pill btn-success" data-toggle="modal"
                                           data-target="#addContactModal">
												<span>
													<i class="m-menu__link-icon flaticon-user-add"></i>
													<span>
														ADD NEW MANAGER
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
        <!-- Add Colums Modal-->
        <!-- <div id="addColumn" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 40%;"> -->

        <!-- Modal content-->
        <!-- <div class="modal-content">
            <div class="modal-header"> -->
        <!--  -->
        <!-- <div class="col-lg-4">
            <h4 class="modal-title">Add Column</h4>
        </div> -->

        <!-- </div>
        <div class="modal-body">
              <div class="m-portlet__body">

                      <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                          <div class="m-form__actions m-form__actions--solid">
                              <div class="row">
                                  <div class="col-lg-4"></div>
                                  <div class="col-lg-8">
                                      <button type="submit" id="m_column_submit" name="m_column_submit" class="btn btn-primary">
                                          Submit
                                      </button>
                                      <button type="reset" class="btn btn-secondary" data-dismiss="modal">
                                          Reset
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
        </div>
      </div>

      </div>
  </div>
</div> -->
        <!-- Add Contact Modal -->
        <div id="addContactModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <!--  -->
                        <div class="col-lg-4">
                            <h4 class="modal-title">Add Manager</h4>
                        </div>
                        <div class="col-lg-8" style="margin-top: 34px;">
                            <form name="select_account" id="select_account" action="#" method="post">
                                <select class="custom-select" name="account_name" id="account_name">
                                    <option value="">Please Select Kunden</option>
                                    @foreach($accounts as $item)
                                        <option value="{{$item->id}}">{{$item->account_name}}</option>
                                    @endforeach
                                </select>
                                <div>
								<span class="m-form__help" style="color: red; float: left;">
								* Please Select Client First then You will be Able to Add Manager</span>
                                </div>
                                <button id="account_select" name="account_select" class="btn btn-primary"
                                        style="margin-top: -70px;margin-left: 1px;">Submit
                                </button>
                                <button type="button" id="reset_form" class="btn btn-default"
                                        style="margin-left: 10px;margin-top: -70px;">Reset
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-body">
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                              id="addContact" name="addContact" style="display: none;">
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            First Name *:
                                        </label>
                                        <input type="hidden" name="account_id" id="account_id">
                                        <input type="text" name="first_name" id="first_name"
                                               class="form-control m-input"
                                               placeholder="Enter First name Minimum 3 characters">
                                        <div class="error_msg">
                                            <span class="first_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Last Name *:
                                        </label>
                                        <input type="text" name="last_name" id="last_name" class="form-control m-input"
                                               placeholder="Enter Last name">
                                        <div class="error_msg">
                                            <span class="last_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Phone :
                                        </label>
                                        <input type="text" name="phone" id="phone" class="form-control m-input"
                                               placeholder="Enter Your Phone Only Numeric">
                                        <div class="error_msg">
                                            <span class="phone"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label style="width: 100%;">
                                            Job Title *:
                                        </label>
                                        <select class="custom-select" id="job_title" name="job_title">
                                            <option value="">
                                                Please Select Job Title of Contact
                                            </option>
                                            <option value="Geschäftsführer">Geschäftsführer</option>
                                            <option value="CIO">CIO</option>
                                            <option value="IT Manager">IT Manager</option>
                                            <option value="IT Direktor">IT Direktor</option>
                                            <option value="IT Mitarbeiter">IT Mitarbeiter</option>
                                            <option value="HR Manager">HR Manager</option>
                                            <option value="HR Direktor">HR Direktor</option>
                                            <option value="HR Mitarbeiter">HR Mitarbeiter</option>
                                            <option value="Manager Einkauf">Manager Einkauf</option>
                                            <option value="Direktor Einkauf">Direktor Einkauf</option>
                                            <option value="Mitarbeiter Einkauf">Mitarbeiter Einkauf</option>
                                            <option value="Assistenz">Assistenz</option>
                                            <option value="Andere Abteilung">Andere Abteilung</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="job_title"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label style="width: 100%;">
                                            Department *:
                                        </label>
                                        <select class="custom-select" id="departement" name="departement">
                                            <option value="">
                                                Please Select Department of Contact
                                            </option>
                                            <option value="Geschäftsführung">Geschäftsführung</option>
                                            <option value="IT">IT</option>
                                            <option value="Einkauf">Einkauf</option>
                                            <option value="HR">HR</option>
                                            <option value="Andere Abteilung">Andere Abteilung</option>
                                        </select>
                                        <div class="error_msg">
                                            <span class="departement"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label style="width: 100%;">
                                            Local Country *:
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
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Mobile/ Cell *:
                                        </label>
                                        <input type="text" name="mobile" id="mobile" class="form-control m-input"
                                               placeholder="Enter Your Mobile Number Only Numeric">
                                        <div class="error_msg">
                                            <span class="mobile"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Note *:
                                        </label>
                                        <input type="text" name="note" id="note" class="form-control m-input"
                                               placeholder="Enter Your Note">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Email *:
                                        </label>
                                        <input type="text" name="email_id" id="email_id" class="form-control m-input"
                                               placeholder="Enter Your Email">
                                        <div class="error_msg">
                                            <span class="email_id"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Decision Maker :
                                        </label>
                                        <label>
                                            <input type="checkbox" name="decision_maker" id="decision_maker"
                                                   data-toggle="toggle">

                                        </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Local City:
                                        </label>
                                        <input type="text" name="city" id="city" class="form-control m-input"
                                               placeholder="Enter Your City">
                                        <div class="error_msg">
                                            <span class="city"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Local Zipcode *:
                                        </label>
                                        <input type="text" name="zipcode" id="zipcode" class="form-control m-input"
                                               placeholder="Enter Your Zipcode">
                                        <div class="error_msg">
                                            <span class="zipcode"></span>
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
        <!-- end:: Body -->
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
    @endsection
    @section('js')
        <script src="{{asset('/js/contact.js')}}" type="text/javascript"></script>
        <script>
            $('#contact_link').addClass('m-menu__item--active m-menu__item--expanded m-menu__item--open');
            $('#manager_link').addClass('m-menu__item--active');
            $("#reset_form").click(function () {
                $("#account_id").val('');
                $("#account_name").prop('disabled', false);
                $('#account_select').prop('disabled', false);
                $("#addContact").css("display", "none");
                $('#addContact')[0].reset();
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
                            $("#zipcode").val(data.pincode);
                            $("#city").val(data.city);
                            $("#country").val(data.country);

                        }
                    },
                    error: function () {
                        alert("Error");
                    }
                });
            }

            $("#LeaveComment").click(function (e) {
                e.preventDefault();
                var contact_id = $("#user_name").val();
                var comment_val = $("#comment_area").val();
                var auth_id = $("#auth_id").val();
                var account_id = $("#account_ids").val();
                var _token = $('input[name="_token"]').val();
                var url = window.location.pathname;
                if (contact_id == '' || comment_val == '') {
                    swal("Error", "All fields are required", "error");
                }
                else {
                    $.ajax({
                        type: 'POST',
                        url: url + '/comment',
                        data: {
                            contact_id: contact_id,
                            comment: comment_val,
                            auth_id: auth_id,
                            _token: _token,
                            account_id: account_id,
                        },
                        success: function (data) {
                            var res = $.parseJSON(data);
                            if (res.status == 'error') {
                                swal('Error', res.message, 'error');
                            }
                            else {
                                $("#user_name").val('');
                                $("#comment_area").val('');
                                $("#m_quick_sidebar").removeClass(' m-quick-sidebar--on');
                                swal('Success', res.message, 'success');
                            }
                        },
                        error: function (data) {
                            swal('Error', data, 'error');
                        }
                    })
                }
            })

            $("#CancelComment").click(function (e) {
                e.preventDefault();
                $("#user_name").val('');
                $("#comment_area").val('');
            })

            $("#user_name").on('change', function () {
                var acc_id = $(this).val();
                get_account_id(acc_id);
            })

            function get_account_id(acc_id) {
                var path = document.location.href + "/get_account_id/" + acc_id;
                $.ajax({
                    url: path,
                    type: "GET",
                    data: {
                        acc_id: acc_id,
                        _token: '{{csrf_token()}}',
                    },
                    success: function (result) {
                        console.log(result);
                        var res = $.parseJSON(result);

                        if (res.status == 'error') {

                        }
                        else {
                            var data = $.parseJSON(JSON.stringify(res.message));
                            $("#account_ids").val(data.account_id);

                        }
                    },
                    error: function () {
                        alert("Error");
                    }
                });
            }
        </script>
        <script type="text/javascript">
            var datatable;
            (function () {
                $('.loader_msg').css('display', 'none');
                var accountsdata;
                var edit_url = 'contacts/edit';
                var delete_url = 'contacts/delete';
                var view_url = 'contacts/view';
                datatable = $('.m_datatable').mDatatable({
                    // datasource definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: 'contacts/getAllContacts',
                                method: 'GET',
                                // custom headers
                                headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                                params: {
                                    // custom query params
                                    query: {
                                        generalSearch: '',
                                    }
                                },
                                map: function (raw) {
                                    console.log('ITS RUN');
                                    console.log(raw);
                                    // sample data mapping
                                    var dataSet = raw;
                                    if (typeof raw.data !== 'undefined') {
                                        dataSet = raw.data;
                                    }
                                    console.log('Result');
                                    console.log(dataSet);
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
                        // height: 450, // datatable's body's fixed height
                        footer: false // display/hide footer
                    },

                    // column sorting
                    sortable: true,

                    pagination: true,

                    search: {
                        input: $('#generalSearch')
                    },

                    // inline and bactch editing(cooming soon)
                    // editable: false,

                    // columns definition
                    columns: [
                        {
                            field: "S_No",
                            title: "S.No",
                            textAlign: 'center',
                            width: 80,
                        },
                        // {
                        // field: "id",
                        // title: "ID",
                        // textAlign: 'center',
                        // width: 40
                        // },
                        {
                            field: "first_name,last_name",
                            title: "Name",
                            template: function (row) {
                                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                                return '\
		        		<div >\
		        		<a title="View this Contact" href="' + view_url + '/' + row.id + '">' + row.first_name + '  <span>' + row.last_name + '</span></a>\
		        		</div>\
		        		';
                            }
                        },
                        {
                            field: "job_title",
                            title: "Job Title",
                            width: 150
                        },
                        {
                            field: "departement",
                            title: "Departement",
                            width: 150
                        },
                        {
                            field: "account_name",
                            title: "Kunden Name",
                            width: 150
                        },
                        {
                            field: "added_by",
                            title: "Added By",
                            width: 150,
                            template: function (row) {
                                return '\
		        		<span>' + row.added_by + '</div>\
		        		';
                            }
                        },
                        {
                            field: "touch_rule",
                            title: "7 Touch Rule",
                            width: 330,
                            textAlign: 'center',
                            template: function (row) {
                                var touch_rule = row.touch_rule;
                                if (touch_rule == null) {
                                    return '\
		        			<div></div>\
		        			';
                                }
                                touch_rule = touch_rule.replace(/,/g, ",  ");
                                return '\
		        		<div>' + touch_rule + '</div>\
		        		';
                            }
                        },
                        {
                            field: "email_id",
                            title: "Email ID",
                            width: 200
                        },
                        {
                            field: "mobile",
                            title: "Mobile Number",
                            width: 150
                        }]
                });
                var query = datatable.getDataSourceQuery();

                $('#m_form_status').on('change', function () {
                    datatable.search($(this).val(), 'Status');
                }).val(typeof query.Status !== 'undefined' ? query.Status : '');
                // $('#showEmail').on('click', function(){
                //   datatable.hideColumn('email_id');
                // });

                $('#m_form_type').on('change', function () {
                    datatable.search($(this).val(), 'Type');
                }).val(typeof query.Type !== 'undefined' ? query.Type : '');

                $('#m_form_status, #m_form_type').selectpicker();
            })();
        </script>
@endsection
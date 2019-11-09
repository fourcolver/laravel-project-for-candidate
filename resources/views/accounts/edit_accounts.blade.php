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
            <!-- BEGIN: Subheader -->
            <div class="m-subheader">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-page-title ">
                            Edit Kunden / <a
                                    href="{{ url('/admin/accounts/view/'.$data->id.'/0')}}">{{$data->account_name}}</a>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--rounded view_block">
                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                      id="editAccount" name="editAccount">
                    {{ csrf_field() }}
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label>
                                    Kunden Name *:
                                </label>
                                <input type="hidden" value="{{$data->id}}" name="account_id" id="account_id">
                                <input type="text" value="{{$data->account_name}}" name="account_name" id="account_name"
                                       class="form-control m-input"
                                       placeholder="Enter Kunden_name Minimum 3 characters">
                                <div class="error_msg">
                                    <span class="account_name"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label for="technology" style="width: 100%;">
                                    Prozesse of Kunden :
                                </label>
                                <select class="custom-select" id="prozesse" name="prozesse">
                                    <option value="">Please Select the Prozesse</option>
                                    <option value="Telefon Interview" @if($data->prozesse == 'Telefon Interview') {{ 'selected' }} @endif>
                                        Telefon Interview
                                    </option>
                                    <option value="Telefon Interview und Vor-Ort Gespräch" @if($data->prozesse == 'Telefon Interview und Vor-Ort Gespräch') {{ 'selected' }} @endif>
                                        Telefon Interview und Vor-Ort Gespräch
                                    </option>
                                    <option value="Vor-Ort Gespräch" @if($data->prozesse == 'Vor-Ort Gespräch') {{ 'selected' }} @endif>
                                        Vor-Ort Gespräch
                                    </option>
                                    <option value="Testaufgabe" @if($data->prozesse == 'Testaufgabe') {{ 'selected' }} @endif>
                                        Testaufgabe
                                    </option>
                                    <option value="NSI" @if($data->prozesse == 'NSI') {{ 'selected' }} @endif>NSI
                                    </option>
                                    <option value="Embedded" @if($data->prozesse == 'Embedded') {{ 'selected' }} @endif>
                                        Embedded
                                    </option>
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
                                        <option value="{{ $i }}" @if($data->freelancers == $i) {{ 'selected' }} @endif>{{ $i }}</option>
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
                                                <option value="{{$item->name}}" @if($data->country == $item->name) {{ 'selected' }} @endif>{{$item->name}}</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Other Countries">
                                        @foreach($countries as $item)
                                            if($item->default_country != '1')
                                            {
                                            <option value="{{$item->name}}" @if($data->country == $item->name) {{ 'selected' }} @endif>{{$item->name}}</option>
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
                                    City of Kunden:
                                </label>
                                <input type="text" value="{{$data->city}}" name="city" id="city"
                                       class="form-control m-input" placeholder="Enter Your city">
                                <div class="error_msg">
                                    <span class="city"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Postcode/Zip *:
                                </label>
                                <input type="text" value="{{$data->pincode}}" name="pincode" id="pincode"
                                       class="form-control m-input" placeholder="Enter Your Job Title">
                                <div class="error_msg">
                                    <span class="pincode"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <?php $technology = explode(',', $data->Technology);?>
                            <div class="col-lg-4">
                                <label for="technology" style="width: 100%;">
                                    Technological Focus :
                                </label>
                                <select multiple="multiple" class="custom-select" id="Technology" name="Technology[]"
                                        style="height: 99px; width: 100%;">
                                    <option value="Microsoft .Net" @if(in_array("Microsoft .Net", $technology)) {{ 'selected' }} @endif>
                                        Microsoft .Net
                                    </option>
                                    <option value="Java" @if(in_array("Java", $technology)) {{ 'selected' }} @endif>
                                        Java
                                    </option>
                                    <option value="SAP" @if(in_array("SAP", $technology)) {{ 'selected' }} @endif>SAP
                                    </option>
                                    <option value="PHP" @if(in_array("PHP", $technology)) {{ 'selected' }} @endif>PHP
                                    </option>
                                    <option value="NSI" @if(in_array("NSI", $technology)) {{ 'selected' }} @endif>NSI
                                    </option>
                                    <option value="Embedded" @if(in_array("Embedded", $technology)) {{ 'selected' }} @endif>
                                        Embedded
                                    </option>
                                </select>
                                <div class="error_msg">
                                    <span class="Technology"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label style="width: 100%;">
                                    Selected Owner of Client:
                                </label>
                                <select class="custom-select" name="owner" id="owner">
                                    <option value="">
                                        Select Owner of Account
                                    </option>
                                    @foreach($users as $item)
                                        <option value="{{$item->id}}" @if($data->owner == $item->id) {{ 'selected' }} @endif>{{$item->first_name}}</option>
                                    @endforeach
                                </select>
                                <div class="error_msg">
                                    <span class="owner"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label for="client_specification" style="width: 100%;">
                                    Hotness Of Client :
                                </label>
                                <select class="custom-select" id="client_specification" name="client_specification">
                                    <option value="">
                                        Please Select Client Specification
                                    </option>
                                    <option value="1" @if($data->client_specification == '1') {{ 'selected' }} @endif>
                                        1
                                    </option>
                                    <option value="2" @if($data->client_specification == '2') {{ 'selected' }} @endif>
                                        2
                                    </option>
                                    <option value="3" @if($data->client_specification == '3') {{ 'selected' }} @endif>
                                        3
                                    </option>
                                    <option value="4" @if($data->client_specification == '4') {{ 'selected' }} @endif>
                                        4
                                    </option>
                                    <option value="5" @if($data->client_specification == '5') {{ 'selected' }} @endif>
                                        5
                                    </option>
                                    <option value="6" @if($data->client_specification == '6') {{ 'selected' }} @endif>
                                        6
                                    </option>
                                    <option value="7" @if($data->client_specification == '7') {{ 'selected' }} @endif>
                                        7
                                    </option>
                                    <option value="8" @if($data->client_specification == '8') {{ 'selected' }} @endif>
                                        8
                                    </option>
                                    <option value="9" @if($data->client_specification == '9') {{ 'selected' }} @endif>
                                        9
                                    </option>
                                    <option value="10" @if($data->client_specification == '10') {{ 'selected' }} @endif>
                                        10
                                    </option>
                                </select>
                                <div class="error_msg">
                                    <span class="client_specification"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label for="source" style="width: 100%;">
                                    Selected Source of Client :
                                </label>
                                <select class="custom-select" id="source" name="source">
                                    <option value="">
                                        Please Select Source of Client
                                    </option>
                                    <option value="Advertisement" @if($data->source == 'Advertisement') {{ 'selected' }} @endif>
                                        Advertisement
                                    </option>
                                    <option value="Email" @if($data->source == 'Email') {{ 'selected' }} @endif>Email
                                    </option>
                                    <option value="Mailshot" @if($data->source == 'Mailshot') {{ 'selected' }} @endif>
                                        Mailshot
                                    </option>
                                    <option value="Pay Per Click" @if($data->source == 'Pay Per Click') {{ 'selected' }} @endif>
                                        Pay Per Click
                                    </option>
                                    <option value="Press" @if($data->source == 'Press') {{ 'selected' }} @endif>Press
                                    </option>
                                    <option value="Referral" @if($data->source == 'Referral') {{ 'selected' }} @endif>
                                        Referral
                                    </option>
                                    <option value="Social" @if($data->source == 'Social') {{ 'selected' }} @endif>
                                        Social
                                    </option>
                                    <option value="Telephone" @if($data->source == 'Telephone') {{ 'selected' }} @endif>
                                        Telephone
                                    </option>
                                    <option value="Web Search" @if($data->source == 'Web Search') {{ 'selected' }} @endif>
                                        Web Search
                                    </option>
                                    <option value="Web site" @if($data->source == 'Web site') {{ 'selected' }} @endif>
                                        Web site
                                    </option>
                                    <option value="Word of Mouth" @if($data->source == 'Word of Mouth') {{ 'selected' }} @endif>
                                        Word of Mouth
                                    </option>
                                </select>
                                <div class="error_msg">
                                    <span class="source"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Mobile/ Cell *:
                                </label>
                                <input type="text" value="{{$data->telephone}}" name="telephone" id="telephone"
                                       class="form-control m-input"
                                       placeholder="Enter Your Telephone Number Only Numeric">
                                <div class="error_msg">
                                    <span class="telephone"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    IT Department Size :
                                </label>
                                <input type="text" value="{{$data->departement_size}}" name="departement_size"
                                       id="departement_size" class="form-control m-input"
                                       placeholder="Enter Your Departement Size">
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
                                    <option value="Customer" @if($data->type_of_client == 'Customer') {{ 'selected' }} @endif>
                                        Customer
                                    </option>
                                    <option value="Previous Customer" @if($data->type_of_client == 'Previous Customer') {{ 'selected' }} @endif>
                                        Previous Customer
                                    </option>
                                    <option value="Potential Customer" @if($data->type_of_client == 'Potential Customer') {{ 'selected' }} @endif>
                                        Potential Customer
                                    </option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-8">
                                    <button type="submit" id="m_edit_account" name="m_edit_account"
                                            class="btn btn-primary">
                                        Submit
                                    </button>
                                    <a class="btn btn-secondary"
                                       href="{{ url('/admin/accounts/view/'.$data->id.'/0') }}">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END: Subheader -->
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
        <script type="text/javascript">
            $(document).ready(function () {
                $('#account_link').addClass('m-menu__item--active');
                $('#m_edit_account').click(function () {
                    $("#editAccount").validate({
                        rules: {
                            account_name: {
                                required: true,
                                minlength: 3
                            },
                            pincode: "required",
                            country: {
                                required: {
                                    depends: function (element) {
                                        return $("#country").val() == '';
                                    }
                                }
                            },
                            telephone: {
                                required: true,
                                minlength: 9
                            }
                        },
                        submitHandler: function (form) {
                            $('#m_edit_account').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
                            $.ajax({
                                url: '../../accounts/update',
                                type: "POST",
                                data: $(form).serialize(),
                                success: function (response, status, xhr, $form) {
                                    $('#m_edit_account').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                    var res = $.parseJSON(response);
                                    if (res.status == 'error') {
                                        swal('Error', res.message, 'error');
                                    }
                                    else {
                                        swal('Success', res.message, 'success');
                                        setTimeout(function () {
                                            window.location.replace('../../../admin/accounts');
                                        }, 2000);
                                    }
                                },
                                error: function (data) {
                                    $('#m_edit_account').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                                    var errors = data.responseJSON;
                                    $.each(errors, function (key, val) {
                                        $('.' + key).show().html(val);
                                        $('.' + key).css('color', 'red');
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
@endsection

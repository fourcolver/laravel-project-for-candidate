@extends('layouts.dashboard')
@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">Profil</h3>
                </div>
                <div>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
											<span class="m-portlet__head-icon m--hide">
											<i class="la la-gear"></i>
											</span>
                                    <h3 class="m-portlet__head-text">
                                        Profil
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                              name="edit_freelancer" id="edit_freelancer">
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-4 col-form-label text-left">Name</label>
                                    <div class="col-lg-6">
                                        <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}">
                                        <input type="text" name="name" id="" class="form-control m-input"
                                               placeholder="Name" value="{{$user->first_name}}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-4 col-form-label text-left">Email</label>
                                    <div class="col-lg-6">
                                        <input type="email" name="email" id="email" class="form-control m-input"
                                               placeholder="Email" value="{{$user->email}}" required="">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-4 col-form-label text-left">Telefonnummer.</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="phone" id="phone" class="form-control m-input"
                                               placeholder="Telefonnummer." value="{{$user->Mobile}}">
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <button type="submit" id="edit_profile" name="edit_profile"
                                                    class="btn btn-brand">Aktualisieren
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
@endsection
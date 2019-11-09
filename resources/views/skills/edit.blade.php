<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Argon | Technische Fähigkeiten
    </title>
    @extends('layouts.admin_dashboard')
    @section('content')
        <div class="m-grid__item m-grid__item--fluid m-wrapper admin-index">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-page-title" style="height: auto;">
                            Home / Technische Fähigkeiten
                        </h3>
                    </div>
                    @if(Auth::user()->isAdmin)
                        <a href="{{url('admin/skills')}}" class="btn btn-primary m-btn m-btn--icon"
                           id="add_user" style="position: relative;top: -5px;">
									<span>
										<span>Technische Fähigkeiten</span>
									</span>
                        </a>
                    @endif
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
                        <div class="m-portlet m-portlet--rounded view_block">
                            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" action="{{route('skills.update', $skill->id)}}"
                                  enctype="multipart/form-data">
                                {{method_field('PUT')}}
                                @include('skills._form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
        <!-- end:: Body -->
@stop
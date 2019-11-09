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
                        <a href="{{url('admin/skills/create')}}" class="btn btn-primary m-btn m-btn--icon"
                           id="add_user" style="position: relative;top: -5px;">
									<span>
										<span>Add Technische Fähigkeiten</span>
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

                        <div class="festanstellung_datatable m-datatable m-datatable--default m-datatable--loaded"
                             id="local_data" style="">
                            <table class="m-datatable__table" id="m-datatable--19584740886"
                                   style="display: block; height: auto; overflow-x: auto;">
                                <thead class="m-datatable__head">
                                <tr class="m-datatable__row" style="height: 62px;">
                                    <th style="width: 60px;" class="m-datatable__cell--center m-datatable__cell">#</th>
                                    <th class="m-datatable__cell">
                                        Skill
                                    </th>
                                    <th class="m-datatable__cell">
                                        Competence
                                    </th>
                                    <th style="width: 150px;" class="m-datatable__cell"></th>
                                </tr>
                                </thead>
                                <tbody class="m-datatable__body" style="">
                                @foreach($skills as $skill)
                                <tr class="m-datatable__row m-datatable__row--even" style="height: 47px;">
                                    <td style="width: 60px;" class="m-datatable__cell--center m-datatable__cell">{{$skill->id}}</td>
                                    <td class="m-datatable__cell">
                                        {{$skill->skill}}
                                    </td>
                                    <td class="m-datatable__cell">
                                        {{$skill->competence->name}}
                                    </td>
                                    <td style="width: 150px;">
                                        <a href="{{route('skills.edit', $skill->id)}}">Edit</a><br>
                                        <a href="/admin/skills/{{$skill->id}}/delete" style="color: red;">Delete</a>

                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
        <!-- end:: Body -->
@stop
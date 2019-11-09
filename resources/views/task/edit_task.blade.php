<!DOCTYPE html>

<html lang="en" >
<!-- begin::Head -->
<head>
  <meta charset="utf-8" />
  <title>
    Argon | Tasks
  </title>
  @extends('layouts.admin_dashboard')
  @section('content')
  @foreach ($details as $data)
  @endforeach
  <div class="m-grid__item m-grid__item--fluid m-wrapper">
    @if (session('error_msg'))
    <div class="col-xl-12">
      <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: block; padding: 10px; margin:27px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <p class="message">
          {{session('error_msg')}}
        </p>
      </div></div>@endif
      <!-- BEGIN: Subheader -->
      <div class="m-subheader">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-page-title ">
              Home / Account / <a href="{{ url('/admin/accounts/view/'.$data->account_id.'/0')}}">{{$data->account_name}}</a> / New Task
            </h3>
          </div>
        </div>  
      </div>
      <div class="sub_btn_header">
        <div class="d-flex align-items-center">
          <div class="mr-auto sub_btn" style="margin-left: 70%;">
            @php $delete_task = '1'; if(Auth::user()->user_role!=1) { $task_roles = explode(',', $permission->task_permission); if(in_array('delete', $task_roles)){ $delete_task = '1';} else {$delete_task=0;}}@endphp
            @if($delete_task=='1')
            <button data-toggle="modal" data-target="#deleteModal" class="btn btn-danger m-btn m-btn--icon">
              <span><i class="fa fa-trash-o"></i><span>Delete</span></span>
            </button>
            @endif
            <button class="btn btn-primary m-btn m-btn--icon" data-id="{{$data->id}}" id="changeStatus" name="changeStatus">
              <span><i class="fa fa-check"></i><span>Completed</span></span>
            </button>
            <div id="deleteModal" class="modal fade" role="dialog" style="">
              <div class="modal-dialog" style="width: 50%;">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirm Delete</h4>
                  </div>
                  <div class="modal-body">
                    <p style="text-align: center; color: red;">
                    Are you sure you wish to delete this Account and Related Records.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="deleteTask" data-id="{{$data->id}}" class="btn btn-danger">Delete</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>
      <div class="m-portlet m-portlet--rounded view_block">
        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="editTask" name="editTask">
          {{ csrf_field() }}
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-4">
                <label>
                  Task Date *:
                </label>
                <input type="hidden" value="{{$data->account_id}}" name="account_id" id="account_id">
                <input type="text" value="{{$data->task_date}}" readonly name="task_date" id="task_date" class="form-control m-input" placeholder="Enter Task date">
                <div class="error_msg">
                  <span class="task_date"></span>
                </div>
              </div>
              <div class="col-lg-4">
                <label for="Priority">
                  Priority Of Task *:
                </label>
                <select class="custom-select" id="task_priority" name="task_priority">
                  <option value="">
                  Please Select Priority of Task</option>
                  <option value="Low" @if($data->priority == 'Low') {{ 'selected' }} @endif>Low</option>
                  <option value="Medium" @if($data->priority == 'Medium') {{ 'selected' }} @endif>Medium</option>
                  <option value="High" @if($data->priority == 'High') {{ 'selected' }} @endif>High</option>
                  <option value="Really High" @if($data->priority == 'Really High') {{ 'selected' }} @endif>Really High</option>
                </select>
                <div class="error_msg">
                  <span class="task_priority"></span>
                </div>
              </div>
            </div>
            <div class="form-group m-form__group row">
              <div class="col-lg-4">
                <label for="Status">
                  Status Of Task *:
                </label>
                <select class="custom-select" id="task_status" name="task_status">
                  <option value="">
                  Please Select Status of Task</option>
                  <option value="Waiting" @if($data->task_status == 'Waiting') {{ 'selected' }} @endif>Waiting</option>
                  <option value="In Progress" @if($data->task_status == 'In Progress') {{ 'selected' }} @endif>In Progress</option>
                  <option value="Completed" @if($data->task_status == 'Completed') {{ 'selected' }} @endif>Completed</option>
                </select>
                <div class="error_msg">
                  <span class="task_status"></span>
                </div>
              </div>
              <div class="col-lg-4">
                <label for="Type">
                  Type Of Task *:
                </label>
                <select class="custom-select" id="task_type" name="task_type">
                  <option value="">
                  Please Select Type of Task</option>
                  @foreach($task_type as $item)
                  <option value="{{$item}}" @if($data->task_type == $item) {{ 'selected' }} @endif>{{$item}}</option>
                  @endforeach
                </select>
                <div class="error_msg">
                  <span class="task_type"></span>
                </div>
              </div>
            </div>
            <div class="form-group m-form__group row">
              <div class="col-lg-4">
                <label for="Priority">
                  Owner Of Task *:
                </label>
                <select class="custom-select" id="task_owner" name="task_owner">
                  <option value="">
                  Please Select Owner of Task</option>

                  @foreach($users as $item)
                  @if(!$data->task_owner == $item->id)
                  <option value="{{$item->id}}" @if($data->task_owner == $item->id) {{ 'selected' }} @endif>{{$item->first_name}}</option>
                  @endif
                  @endforeach
                  <option value="{{$data->task_owner}}" @if($data->task_owner == $data->owner_id) {{ 'selected' }} @endif>{{$data->owner_name}}</option>

                </select>
                <div class="error_msg">
                  <span class="task_owner"></span>
                </div>
              </div>
              <div class="col-lg-4">
                <label>
                  Description :
                </label>
                <textarea class="form-control m-input m-input--air" name="description" id="description" rows="3">@if($data->description){{$data->description}} @endif</textarea>
                <div class="error_msg">
                  <span class="description"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
              <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-8">
                  <button type="submit" id="m_edittask" data-id="{{$data->id}}" name="m_edittask" class="btn btn-primary">
                    Submit
                  </button>
                  <a class="btn btn-secondary" href="{{ url('/admin/tasks') }}">
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
      <ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand comment_div" role="tablist">
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
<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
  <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->        <!-- begin::Quick Nav -->

<!-- begin::Quick Nav -->
@endsection
@section('js')
<!-- File For View Task And All Functions -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#task_link').addClass('m-menu__item--active');
    $('#task a i').addClass('link-icon-active');
  });
</script>

<script src="{{url('assets/demo/default/custom/components/datatables/base/view-task.js')}}" type="text/javascript"></script>
@endsection


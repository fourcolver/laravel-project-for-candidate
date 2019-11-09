<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>
        Argon | Festanstellung
    </title>
    @extends('layouts.admin_dashboard')
    @section('content')
        <style>
            .m-datatable__table th {
                font-size: 16px !important;
            }
            .displayb >label {
                font-size: 16px !important;
            }
            .m-datatable__cell{
                background: #fff
            }
        </style>
        <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper admin-index">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader " style="display: block !important;">
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
                        <a href="{{route('candidate.invite')}}" class="btn btn-info m-btn m-btn--icon" style="position: relative;top: -5px; margin-left: 10px;">
                            <span><span>Send invite</span></span>
                        </a>
                        @if(request()->route()->parameter('id') > 0)
                            <a href="/admin/kandidaten/{{request()->route()->parameter('id')}}/edit" class="btn btn-success m-btn m-btn--icon" style="position: relative;top: -5px; margin-left: 10px;">
                                <span><span>Edit</span></span> 
                            </a>
                        @endif
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
            @yield('template')

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
                              id="upload_file" enctype="multipart/form-data">
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
            var datatable;
            var dataWithKey = {
                '1': '20-30K',
                '2': '30-40K',
                '3': '40-50K',
                '4': '50-60K',
                '5': '60-70K',
                '6': '70-80K',
                '7': '80-90K',
                '8': '90-100K',
                '9': '100-110K',
                '10': '110-120K',
                '11': '120+K'
            };

            $(document).ready(function () {
                $('#festanstellung_send').hide();

                $(".festanstellung_datatable").on('change', '.send_mail', function () {

                    //alert('Hello Argon');
                    var checkbox_val = $(this).find(':first-child').val();
                    //alert(checkbox_val);

                    var selected = '';
                    //alert(selected);
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

                $('.loader_msg').css('display','none');
                $('.candidate-profile').show();
            });
        </script>

        <script src="https://unpkg.com/popper.js@1"></script>
        <script src="https://unpkg.com/tippy.js@4"></script>
        <script type="text/javascript" src="/vue.js"></script>
        <script type="text/javascript" src="/candidates.js"></script>
@endsection

<div id="attachscv" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 40%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">CSV upload form</h4>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form method="post" action="{{url('admin/data/csv')}}" name="upload_file" id="upload_file"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    Select file : <input type='file' name='attach_csv' id='attach_csv' class='form-control' required=""><br>
                    <span id="errormessage"></span>
                    <p style="color: red">* Download Sample File from <a href="{{url('admin/upload/exportcsv')}}"
                                                                         id="Exportcsv">here</a></p>
                    <p style="color: red">* Please Select Only CSV format</p>
                    <button class="btn btn-primary" id="upload" name="upload" type="submit">Upload</button>
                </form>
            </div>

        </div>

    </div>
</div>
@include('includes.adminChangePasswordPopup')
<div id="changeProfile" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog" style="width: 40%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Profile Pic</h4>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form method="post" name="upload_pic" action="{{url('dashboard/profile/update')}}" id="upload_pic"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    Select file : <input type='file' name='attach_pic' id='attach_pic' class='form-control' required=""><br>
                    <span id="errormessage"></span>
                    <p style="color: red">* Please Select Only Png and jpg format</p>
                    <button class="btn btn-primary" id="upload_profile" name="upload_profile" type="submit">Upload
                    </button>
                </form>
            </div>

        </div>

    </div>
</div>

<input type="hidden" id="url" value='{{ Request::url() }}'>
<footer class="m-grid__item		m-footer ">
    <div class="m-container m-container--fluid m-container--full-height m-page__container">
        <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
            <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
                2018 &copy; @Registered1
                                <!-- <a href="#" class="m-link">
                                  Keenthemes
                                </a> -->
              </span>
            </div>
            <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                <a href="http://www.argon-strategy.com/impressum.html" class="pull-right" style="margin: 10px 40px 0 0;">Impressum</a>
                <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                    <!-- <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                About
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#"  class="m-nav__link">
                            <span class="m-nav__link-text">
                                Privacy
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                T&C
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Purchase
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__item m-nav__item">
                        <a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
                            <i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- end::Footer -->
</div>
<!-- end:: Page -->
<!--begin::Base Scripts -->
<script src="{{url('assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{url('assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script><!-- 
<script src="{{url('assets/demo/default/custom/components/datatables/base/dashboard_task.js')}}" type="text/javascript"></script> -->
<!--end::Base Scripts -->
<!--begin::Page Vendors -->
<script src="{{url('assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Snippets -->
<!-- <script src="assets/app/js/dashboard.js" type="text/javascript"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{url('assets/app/js/dashboard.js')}}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="{{url('assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js')}}"
        type="text/javascript"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="{{url('assets/app/js/script.js')}}" type="text/javascript"></script>

<!--datepicker-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- <script src="{{url('assets/demo/default/custom/components/datatables/base/data_comments.js')}}" type="text/javascript"></script> -->
<!--End Vase Script -->
<!--end::Page Snippets -->
<style type="text/css">
    .m-aside-left--minimize .m-aside-menu .m-menu__nav {
        padding: 30px 0 30px 0;
        width: 6%;
    }

    #TaskModal {
        display: none;
    }

    .comment_div li {
        width: 100% !important;
    }

    .m-quick-sidebar__content {
        padding: 61px 14px;
    }
</style>
<script>
$(function() {
  $('input[name="birthday"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {
    var years = moment().diff(start, 'years');
  });
});

$('body').on( "click", '.id_btn_trash_edu', function( event ){
    let currentId = $(this).attr('id');    
    let currentIndex = currentId.replace('trash_btn_', '');
    let post_id_name = "input_edu_" + currentIndex;
    let post_id = $("input[name="+post_id_name+"]").val();
    $.ajax({
        type: "POST",
        data: {
            "currentIndex": currentIndex,
            "_token": "{{ csrf_token() }}",
        },
        url: "/admin/delete_education/"+ post_id,
        success : function(data){
            console.log("success");
            $("#show_id_edu_"+currentIndex).html(data);
        }
    });
});

$('body').on( "click", '.id_btn_trash', function( event ){
    let currentId = $(this).attr('id');    
    let currentIndex = currentId.replace('trash_btn_', '');
    let post_id_name = "input_experience_" + currentIndex;
    let post_id = $("input[name="+post_id_name+"]").val();
    $.ajax({
        type: "POST",
        data: {
            "currentIndex": currentIndex,
            "_token": "{{ csrf_token() }}",
        },
        url: "/admin/delete_experience/"+ post_id,
        success : function(data){
            console.log("success");
            $("#show_id_"+currentIndex).html(data);
        }
    });
});



$('body').on( "click", '.id_btn_edit', function( event ) {
    $(".display-flex").show();
    $(".form-experience").hide();
    let currentId = $(this).attr('id');
    console.log(currentId);
    let currentIndex = currentId.replace('edit_btn_','');
    $('#show_id_' + currentIndex).hide(500);
    $('#modal_id_' + currentIndex).show(500);
});

$('body').on( "click", '.id_btn_edit_edu', function( event ) {
    $(".display-flex").show();
    $(".form-experience").hide();
    let currentId = $(this).attr('id');
    console.log(currentId);
    let currentIndex = currentId.replace('edit_btn_','');
    $('#show_id_edu_' + currentIndex).hide(500);
    $('#modal_id_edu_' + currentIndex).show(500);
});

$('body').on( "click", '.fa-window-close-work', function( event ) {    
    let currentId = $(this).attr('id');
    let currentIndex = currentId.replace('closeIcon','');
    $('#modal_id_' + currentIndex).hide(500);
    $('#show_id_' + currentIndex).show(500);
});

$('body').on( "click", '.fa-window-close-edu', function( event ) {    
    let currentId = $(this).attr('id');
    let currentIndex = currentId.replace('closeIcon','');
    $('#modal_id_edu_' + currentIndex).hide(500);
    $('#show_id_edu_' + currentIndex).show(500);
});

$(".add-form-container .btn-work-close").on("click", function(e){
    $('.add-form-container').addClass('d-none' );
    console.log("dsf");
});

$(".add-form-education .btn-edu-close").on("click", function(e){
    $('.add-form-education').addClass('d-none');
    console.log("dsf");
});

$(".btn-addNew-edu").on("click", function(e){    
    $('.add-form-education.d-none').removeClass('d-none');
    $('.add-form-education .btn-edu-add').on('click', function(e){
    let data = $(this).closest('form').submit();
    console.log($(this).closest('form'));
    });
});

$(".btn-addNew-work").on("click", function(e){    
    $('.add-form-container.d-none').removeClass('d-none');
    $('.add-form-container .btn-work-add').on('click', function(e){
    let data = $(this).closest('form').submit();
    console.log($(this).closest('form'));
    });
});



$(".fa-check-circle-work").on("click", function(e){
    e.preventDefault();
    let currentId = $(this).attr('id');
    let currentIndex = currentId.replace('checkIcon', '');
    let changeBlock = "#show_id_" + currentIndex;
    let post_id_name = "input_experience_" + currentIndex;
    let work_sector = $("select[name=work_experience_sector_"+currentIndex+"]").val();
    let work_start = $("input[name=work_start_"+currentIndex+"]").val();
    let work_end = $("input[name=work_end_"+currentIndex+"]").val();
    let work_company = $("input[name=work_experience_company_name_"+currentIndex+"]").val();
    let work_position = $("Select[name=work_experience_position_"+currentIndex+"]").val();
    let work_description = $("textarea[name=work_experience_position_description_"+currentIndex+"]").val();
    let post_id = $("input[name="+post_id_name+"]").val();
    let skills = $("select[name=category_skillers_"+currentIndex+"]").val();
    
    // let skill = [];

    // let selectObject = document.getElementById('competence-skill-work-' + currentIndex);
    // let selectOptin = selectObject.getElementsByClassName('select2-selection__rendered');
    // let selectDetail = selectOptin[0].getElementsByClassName('select2-selection__choice');
    // console.log(selectDetail);
    // for(let list of selectDetail){
    //     skill.push(list.title);
    //     console.log(list.title);
    //     console.log(skill);
    // }

    console.log(skills, work_sector, work_start, work_end, work_company, work_position, work_description);
    $.ajax({
        type: "POST",
        data: {
            "currentIndex": currentIndex,
            "work_sector": work_sector,
            "work_start": work_start,
            "work_end": work_end,
            "work_company": work_company,
            "work_position": work_position,
            "work_description": work_description,
            "work_skills": skills,
            "_token": "{{ csrf_token() }}",
        },
        url: "/admin/update_experience/"+ post_id,
        success : function(data){
            console.log("success");
            $("#show_id_"+currentIndex).html(data);
        }
    });
    $("#show_id_"+currentIndex).show(500);
    $("#modal_id_"+currentIndex).hide(500);
});

$(".fa-check-circle-edu").on("click", function(e){
    e.preventDefault();
    let currentId = $(this).attr('id');
    let currentIndex = currentId.replace('checkIcon', '');
    let changeBlock = "#show_id_" + currentIndex;
    let post_id_name = "input_edu_" + currentIndex;
    let edu_graduation = $("input[name=education_graduation_"+currentIndex+"]").val();
    let edu_start = $("input[name=edu_start_"+currentIndex+"]").val();
    let edu_end = $("input[name=edu_end_"+currentIndex+"]").val();
    let edu_training = $("Select[name=edu_traning_"+currentIndex+"]").val();
    let edu_description = $("textarea[name=edu_description_"+currentIndex+"]").val();
    let post_id = $("input[name="+post_id_name+"]").val();
    console.log(edu_graduation, edu_start, edu_end, edu_training, edu_description, post_id);
    $.ajax({
        type: "POST",
        data: {
            "currentIndex": currentIndex,
            "edu_graduation": edu_graduation,
            "edu_start": edu_start,
            "edu_end": edu_end,
            "edu_training": edu_training,
            "edu_description": edu_description,
            "_token": "{{ csrf_token() }}",
        },
        url: "/admin/update_education/"+ post_id,
        success : function(data){
            $("#show_id_edu_"+currentIndex).html(data);
        }
    });
    $("#show_id_edu_"+currentIndex).show(500);
    $("#modal_id_edu_"+currentIndex).hide(500);
});

// data picker.
var startDate = new Date();
var fechaFin = new Date();
var FromEndDate = new Date();
var ToEndDate = new Date();




$('.from').datepicker({
    autoclose: true,
    minViewMode: 1,
    format: 'mm/yyyy'
}).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.to').datepicker('setStartDate', startDate);
    }); 

$('.to').datepicker({
    autoclose: true,
    minViewMode: 1,
    format: 'mm/yyyy'
}).on('changeDate', function(selected){
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('.from').datepicker('setEndDate', FromEndDate);
    });

</script>
<script>
    $('#m_quicksearch_input1').keyup(function () {
        var u = $('#url').val();
        var qs = this;
        var query = $('#m_quicksearch_input1').val();
        //var url = Route::current()->getName();

        if (query.length === 0) {
            console.log(query + "is empty");
            $('.m-dropdown__body').css('display', 'none');
        }
        else {
            url = '/dashboard/search';
            $.ajax({
                url: url,
                data: {
                    query: query,
                },
                dataType: 'html',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('.m-dropdown__content1').html(response);
                    $('.m-dropdown__body').css('display', 'block');
                }
            });
        }

    });
</script>
@yield('inline-js')
</body>
</html>

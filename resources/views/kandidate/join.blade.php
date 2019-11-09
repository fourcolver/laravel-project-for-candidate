<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Argon | Festanstellung
    </title>
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-search__field {
            width: 125px !important;
        }
    </style>


    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <!--begin::Page Vendors -->
    <link href="https://kandidaten.org/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendors -->
    <link href="https://kandidaten.org/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="https://kandidaten.org/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="https://kandidaten.org/css/style.css" rel="stylesheet" type="text/css"/>
    <!--end::Base Styles -->
    <link rel="shortcut icon" href="https://kandidaten.org/assets/app/media/img/logos/logo.png"/>
    <link rel="stylesheet" href="{{asset('css/join.css')}}">
</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
    <header class="m-grid__item    m-header " data-minimize-offset="200" data-minimize-mobile-offset="200">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <!-- BEGIN: Brand -->
                <div class="m-stack__item m-brand  m-brand--skin-light ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo text-center">
                            <a href="https://kandidaten.org/dashboard" class="m-brand__logo-wrapper">
                                <img alt="" src="https://kandidaten.org/img/logo.png"/>

                            </a>
                        </div>

                    </div>
                </div>
                <!-- END: Brand -->
                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                </div>
            </div>
        </div>
    </header>
    <!-- END: Header -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
            <i class="la la-close"></i>
        </button>
        <!-- END: Left Aside -->    <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-page-title ">
                            Join kandidaten.org
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--rounded view_block">
                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post"
                      action=""
                      enctype="multipart/form-data">
                    @include('kandidate._form')
                </form>
            </div>
            <!-- end:: Body -->

            <!-- begin::Scroll Top -->
            <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
                 data-scroll-speed="300">
                <i class="la la-arrow-up"></i>
            </div>
        </div>
    </div>
    <!-- end:: Page -->
</div>
<!--begin::Base Scripts -->
<script src="https://kandidaten.org/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="https://kandidaten.org/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="https://kandidaten.org/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js"
        type="text/javascript"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://kandidaten.org/assets/app/js/dashboard.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://kandidaten.org/assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js"
        type="text/javascript"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://kandidaten.org/assets/app/js/script.js" type="text/javascript"></script>

<script src="https://kandidaten.org/js/add_kandidaten.js" type="text/javascript"></script>
<script type="text/javascript">
    $('.m-checkbox').on('click', function () {
        var inputName = $(this).find('input').attr('name');
        if (inputName === 'can_travel_to_germany[]') {
            if ($(this).find('input').is(':checked')) {
                $(this).next().css('display', 'inline-block');
            } else {
                $(this).next().hide();
            }
        }
    });
    $('.m-select2').select2({
        placeholder: "Select an option",
        width: '215px'
    });
    $('#competence-skill').on('select2:select', function (e) {
        var data = e.params.data;
        $('.core_checkbox').append('<label class="m-checkbox"><input name="core_category[]"  value="' + data.id + '" type="checkbox">' + data.text + '<span></span></label>');
    });
    $('#competence-skill').on('select2:unselect', function (e) {
        var data = e.params.data;
        $('#core_competences input[value=' + data.id + ']').eq(0).parent('label').last().remove();
    });
    $('#contact_link').addClass('m-menu__item--active m-menu__item--expanded m-menu__item--open');
    $('footer').css({"position": "absolute"});
    $('#freelancer_link').addClass('m-menu__item--active');
    $('.mdoublecheck').hide();
    $('input[name="other_interview"]').click(function () {
        if ($(this).val() == '1') {
            $('#comment_area_text').show();
        } else {
            $('#comment_area_text').hide();
        }
    });
    $('input[name="reference"]').click(function () {
        if ($(this).val() == '1') {
            $('#reference_form').show();
        } else {
            $('#reference_form').hide();
        }
    });
    $('input[name="possible_extension"]').click(function () {
        if ($(this).val() == '1') {
            $('#extension_text').show();
        } else {
            $('#extension_text').hide();
        }
    });
    $('#accordion input[type=checkbox]').on('click', function () {
        if (this.checked) {
            //$(this).parent('label.m-checkbox').eq(0).css('color','Red');
            var competence_text = $(this).parent('label.m-checkbox').eq(0).text();
            $('.core_checkbox').append('<label class="m-checkbox"><input name="core_category[]"  value="' + $(this).val() + '" type="checkbox">' + competence_text + '<span></span></label>');
        } else {
            //$(this).parent('label.m-checkbox').eq(0).css('color','');
            $('#core_competences input[value=' + $(this).val() + ']').eq(0).parent('label').last().remove();
        }
    });

    $('#core_competences input[type=checkbox]').each(function (val) {
        $(this).parent('label').append($('#accordion input[value=' + $(this).val() + ']').eq(0).parent('label').text());
    });
    $('#add_free').on('submit', function () {
        return true;
    });
</script>
</body>
</html>
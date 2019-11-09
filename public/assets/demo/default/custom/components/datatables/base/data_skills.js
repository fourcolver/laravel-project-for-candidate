jQuery(document).ready(function () {

    $("#freelancer_mobile").keydown(function (e) {

        // Allow: backspace, delete, tab, escape, enter and .

        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||

             // Allow: Ctrl+A, Command+A

            ((e.keyCode === 65 || e.keyCode === 86 || e.keyCode === 118 ||
             e.keyCode === 67 ||  e.keyCode === 99) && (e.ctrlKey === true || e.metaKey === true)) || 

             // Allow: home, end, left, right, down, up

            (e.keyCode >= 35 && e.keyCode <= 40)) {

                 // let it happen, don't do anything

                 return;

        }

        // Ensure that it is a number and stop the keypress

        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {

            e.preventDefault();

        }

    });

    $('#deleteFreelancer').click(function(){

        var id = $(this).attr('data-id');

        url = '../../../freelancers/delete'

        $.ajax({

        url: url+'/'+id,

            success: function(response) { 

                var res = $.parseJSON(response);

                if(res.status == 'error'){

                  swal('Error',res.message,'error');

                }else{

                  swal('Success',res.message,'success');

                  setTimeout(function() {

                          window.location.replace('../../../../admin/freelancers');

                  }, 3000);

                }

            }});

        });

    $('#m_add_skills').click(function(){

    $("#add_skills").validate({

        rules: {

            freelancer_name: {

                required: true,

                minlength: 3

            },

            freelancer_email: {

                required: true,

                email: true

            },

            freelancer_mobile: {

                required: true,

                minlength: 5

            },

        },



    submitHandler: function (form) {

        var id = $('#freelancer_id').val();

        

        if(numberOfChecked>5)

        {

            swal('Error','Please Select Core Competences Only 5','error');

            return false;var numberOfChecked = $('.core_checkbox input:checkbox:checked').length;

        }

        $('#m_add_skills').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

        $.ajax({

                url: '../../skills/'+ id,

                type: "POST",

                data: $(form).serialize(),

                success: function(response, status, xhr, $form) {

                    setTimeout(function() {

                        $('#m_add_skills').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                        if(response =='success')

                        {

                           window.location.replace('../../../freelancers');

                        }

                    }, 5000);

                },

                error: function(data){

                        $('#m_add_skills').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                        var errors = data.responseJSON;

                        $.each(errors, function(key, val){

                            $('.'+key).show().html(val);

                            $('.'+key).css('color','red');

                        });

                }

            });

    }

    });

    });

    $('#m_edit_skills').click(function(){

    $("#editFreelancer").validate({

        rules: {

            freelancer_name: {

                required: true,

                minlength: 3

            },

            freelancer_email: {

                required: true,

                email: true

            },

            freelancer_mobile: {

                required: true,

                minlength: 5

            }

        },

    submitHandler: function (form) {

        var id = $('#freelancer_id').val();

        var numberOfChecked = $('.core_checkbox input:checkbox:checked').length;

        if(numberOfChecked>5)

        {

            swal('Error','Please Select Core Competences Only 5','error');

            return false;

        }

        $('#m_edit_skills').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

        $.ajax({

                url: '../../../update/skills/'+ id,

                type: "POST",

                data: $(form).serialize(),

                success: function(response, status, xhr, $form) {

                    setTimeout(function() {

                        $('#m_edit_skills').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                        if(response =='success')

                        {

                           window.location.replace('../../../freelancers');

                        }

                    }, 5000);

                },

                error: function(data){

                        $('#m_edit_skills').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                        var errors = data.responseJSON;

                        $.each(errors, function(key, val){

                            $('.'+key).show().html(val);

                            $('.'+key).css('color','red');

                        });

                }

            });

    }

    });

    });

});
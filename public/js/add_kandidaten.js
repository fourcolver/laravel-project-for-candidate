jQuery(document).ready(function () {

    $("#freelancer_mobile,#freelancer_home").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
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
    /*$('#m_add_freelancer').click(function(){
        $("#add_free").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 3
            },
            freelancer_email: {
                required: true,
                email: true
            },
            freelancer_mobile: {
                required: true
            },
            freelancer_home: {
                required: true
            },
            freelancer_password: {
                required: true
            }
        },
    submitHandler: function (form) {
        $('#m_add_freelancer').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
        $.ajax({
                url: 'add',
                type: "POST",
                data: $(form).serialize(),
                cache: false,
                contentType: false,
                processData: false,
                success: function(response, status, xhr, $form) {
                        $('#m_add_freelancer').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        if(response.status=='error')
                        {
                            $('#m_add_freelancer').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                            swal('Error',response.message,'error');
                        }
                        if(response.status=='success')
                        {
                            swal('Success',response.message,'success');
                            setTimeout(function() {
                              window.location.replace('../kandidaten');
                              }, 1000);
                        }
                },
            });
    }
    });
    });*/

    $('#m_edit_kandidate').click(function(){
        $("#editKandidate").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 3
            },
            freelancer_email: {
                required: true,
                email: true
            },
            freelancer_mobile: {
                required: true
            },
            freelancer_home: {
                required: true
            },
            freelancer_password: {
                required: true
            }
        },
    submitHandler: function (form) {
        $('#m_add_freelancer').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
        var free_id = $('#freelancer_id').val();
        $.ajax({
                url: '../../update/'+free_id,
                type: "POST",
                data: $(form).serialize(),
                success: function(response, status, xhr, $form) {
                        $('#m_add_freelancer').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        if(response.status=='error')
                        {
                            $('#m_add_freelancer').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                            swal('Error',response.message,'error');
                        }
                        if(response.status=='success')
                        {
                            swal('Success',response.message,'success');
                            setTimeout(function() {
                              window.location.replace('../../../kandidaten');
                              }, 1000);
                        }
                },
            });
    }
    });
    });
});
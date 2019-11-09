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
    $('#m_add_freelancer').click(function(){
        $("#add_free").validate({

    submitHandler: function (form) {


        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var freelancer_email = $('#freelancer_email').val();
        var freelancer_password = $('#freelancer_password').val();
        var freelancer_mobile = $('#freelancer_mobile').val();
        var freelancer_home = $('#freelancer_home').val();
        var postal_code = $('#postal_code').val();

        if(first_name == '') {
            swal('Error','Please enter First Name','error');
            return false;
        }
        if(last_name == '') {
            swal('Error','Please enter Last Name','error');
            return false;
        }
        if(freelancer_email == '') {
            swal('Error','Please enter email','error');
            return false;
        }
        if(freelancer_password == '') {
            swal('Error','Please enter Password','error');
            return false;
        }
        if(freelancer_mobile == '') {
            swal('Error','Please enter Mobile','error');
            return false;
        }
        // if(freelancer_home == '') {
        //     swal('Error','freelancer_home Required','error');
        //     return false;
        // }
        // if(postal_code == '') {
        //     swal('Error','postal_code Required','error');
        //     return false;
        // }


        $('#m_add_freelancer').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
        $.ajax({
                url: 'add',
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
                              window.location.replace('../freelancers');
                              }, 1000);
                        }
                },
            });
    }
    });
    });
});
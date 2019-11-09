
jQuery(document).ready(function () {
    $('#edit_profile').click(function(){
        $("#edit_freelancer").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 10
            }
        },
    submitHandler: function (form) {
        var id = $('#user_id').val();
        $('#edit_profile').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
        $.ajax({
                url: '../freelancer/profile/edit/'+id,
                type: "POST",
                data: $(form).serialize(),
                success: function(response, status, xhr, $form) {
                    
                        $('#edit_profile').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        if(response =='success')
                        {
                            swal('Success','Profile updated Successfully','success');
                            setTimeout(function() {
                                window.location.replace('');
                           }, 2000);
                        }
                        if(response =='error')
                        {
                           swal('Error','Email Already Exist','error');
                           $('#edit_profile').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        }
                    
                },
                error: function(data){
                    $('#edit_profile').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
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

jQuery(document).ready(function () {
    $("#pincode,#departement_size").keydown(function (e) {
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
    $('#last_time_contact').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy-mm-dd hh:ii'
        });
	$("#addAccount").validate({
     	rules: {
    		account_name: {
                required: true,
                minlength: 3
            },
            pincode: "required",
            country: {
                required: {
                    depends: function(element) {
                        return $("#country").val() == '';
                    }
                 }
            },
            telephone: {
                required: true,
                minlength: 9
            }
		},
    submitHandler: function (form) {
        $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
    	$.ajax({
                url: 'accounts/new',
                type: "POST",
                data: $(form).serialize(),
                success: function(response, status, xhr, $form) {
                	setTimeout(function() {
                    $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        if(response =='success')
                        {
	                       window.location.replace('accounts');
                        }
                    }, 5000);
                },
                error: function(data){
                        $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
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
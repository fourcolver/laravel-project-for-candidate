jQuery(document).ready(function () {
$("#phone,#mobile,#zipcode").keydown(function (e) {
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
    $('#account_select').click(function(){

    $('#select_account').validate({
            rules: {
            account_name: {
                required: {
                    depends: function(element) {
                        return $("#account_name").val() == '';
                    }
                 }
            }
        },
        invalidHandler: function(f,v) {
            $('#addContact').css('display','none');    
        },
        submitHandler: function (form) {
            $('#addContact').css('display','block');
            var account_id = $("#account_name").val();
            $('#account_id').val(account_id);
            $('#account_name').prop('disabled',true);
            $('#account_select').prop('disabled',true);
            showData(account_id);
        }
    });
    });
  $("#addContact").validate({
      rules: {
        first_name: {
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 3
            },
            job_title: {
                required: {
                    depends: function(element) {
                        return $("#job_title").val() == '';
                    }
                 }
            },
            departement: {
                required: {
                    depends: function(element) {
                        return $("#departement").val() == '';
                    }
                 }
            },        
        mobile: {
                required: true,
                minlength: 5
            },
        email_id: "required",
        zipcode: "required",
        country: "required"
    },
    messages: {
          first_name: {
                required: "Field First Name is required",
                minlength: "Field PostCode must contain at least 3 characters" 
            },
            last_name: {
                required: "Field Last Name is required",
                minlength: "Field Last Name must contain at least 3 characters" 
            },
            job_title: {
                required: "Field Job Title is required" 
            },
            departement: {
                required: "Field Departement is required" 
            },            
            mobile: {
                required: "Field Mobile Number is required",
                minlength: "Field Mobile Cell must contain 5 characters" 
            }
      },
    submitHandler: function (form) {
        $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
      $.ajax({
                url: 'contacts/new',
                type: "POST",
                data: $(form).serialize(),
                success: function(response, status, xhr, $form) {
                  setTimeout(function() {
                        $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        if(response =='success')
                        {
                         window.location.replace('contacts');
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

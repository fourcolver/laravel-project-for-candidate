jQuery(document).ready(function () {

  $("#client_number,#quantity,#price").keydown(function (e) {

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

    $('#close_date').datepicker({

            todayHighlight: true,

            autoclose: true,

            format: 'yyyy-mm-dd',

    });

	$('#deleteOpportunity').click(function(){

        var id = $(this).attr('data-id');

        url = '../delete'

            $.ajax({

            url: url+'/'+id,

              success: function(response) { 

                  setTimeout(function() {

                  if(response == 'success'){

                  //$(this).parent().remove();

                  window.location.replace('../../../admin/opportunity');

                  }

                            }, 5000);

                }});

        });

  $('#m_submit_line').click(function(){

    $("#addLine").validate({

      rules: {

        quantity: {

                required: true

        },

        price: {

            required: true

        },

        product: {

            required: {

                depends: function(element) {

                    return $("#product").val() == '';

                }

             }

        }

    },

    submitHandler: function (form) {

            var id =  $('#m_login_signin_submit').attr('data-id');

            $('#m_submit_line').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            $.ajax({

                url: '../../opportunity/addline/'+id,

                type: "POST",

                data: $(form).serialize(),

                success: function(response, status, xhr, $form) {

                  setTimeout(function() {

                        $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                        if(response.message =='Success')

                        {

                         window.location.replace('');

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

	$('#m_login_signin_submit').click(function(){

		$("#editOpportunity").validate({

      rules: {

        name: {

                required: true

        },

        closed_date: {

            required: true

        },

         probability: {

                required: {

                    depends: function(element) {

                        return $("#probability").val() == '';

                    }

                 }

            },

            source: {

                required: {

                    depends: function(element) {

                        return $("#source").val() == '';

                    }

                 }

            },

            // hotness: {

            //     required: {

            //         depends: function(element) {

            //             return $("#hotness").val() == '';

            //         }

            //      }

            // },

            technology: {

                required: {

                    depends: function(element) {

                        return $("#technology").val() == '';

                    }

                 }

            },

            client_name : "required",

            client_number : "required",

    },

    submitHandler: function (form) {

            var id =  $('#m_login_signin_submit').attr('data-id');

            $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            $.ajax({

                url: '../../opportunity/update/'+id,

                type: "POST",

                data: $(form).serialize(),

                success: function(response, status, xhr, $form) {

                  $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                  var res = $.parseJSON(response);

                  if(res.status == 'error')

                  {

                    swal('Error',res.message,'error');

                  }

                  else

                  {

                    swal('Success',res.message,'success');

                    setTimeout(function() {

                          var referrer =  document.referrer;

                          $(location).attr("href", referrer);

                    }, 2000);

                  }

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

});
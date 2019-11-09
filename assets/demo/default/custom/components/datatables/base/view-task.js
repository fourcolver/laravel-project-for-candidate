jQuery(document).ready(function () {
  $('#task_date').datepicker({
            orientation: "bottom left",
            autoclose: true,
            format: 'yyyy-mm-dd',
  });
	$('#deleteTask').click(function(){
        var id = $(this).attr('data-ID');
        url = '../delete'
            $.ajax({
            url: url+'/'+id,
              success: function(response) { 
                  setTimeout(function() {
                  if(response == 'success'){
                  //$(this).parent().remove();
                  window.location.replace('../../../admin/tasks');
                  }
                            }, 5000);
                }});
        });
	$('#changeStatus').click(function(){
		var id = $(this).attr('data-id');
    $('#changeStatus').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
		url = '../changeStatus'
		$.ajax({
            url: url+'/'+id,
              success: function(response) { 
                $('#changeStatus').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
                  setTimeout(function() {
                  if(response.message == 'Success'){
                  //$(this).parent().remove();
                  window.location.replace('../../../admin/tasks');
                  }
                            }, 1000);
                  if(response.message == "Error")
                  {
                     window.location.replace('');
                  }
                }});
	});
	$('#m_edittask').click(function(){
		$('#editTask').validate({
            rules: {
            task_date: "required",
            task_priority: {
                required: {
                    depends: function(element) {
                        return $("#task_priority").val() == '';
                    }
                 }
            },
            task_status: {
                required: {
                    depends: function(element) {
                        return $("#task_status").val() == '';
                    }
                 }
            },
            task_type: {
                required: {
                    depends: function(element) {
                        return $("#task_type").val() == '';
                    }
                 }
            },
            task_owner: {
                required: {
                    depends: function(element) {
                        return $("#task_owner").val() == '';
                    }
                 }
            }
        },
        submitHandler: function (form) {
        	var id = $('#m_edittask').attr('data-id');
        	$('#m_edittask').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            $.ajax({
                url: '../../tasks/update/'+id,
                type: "POST",
                data: $(form).serialize(),
                success: function(response, status, xhr, $form) {
                  $('#m_edittask').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
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
                    $('#m_edittask').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
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

jQuery(document).ready(function () {
    $('#addfreelancerdata').click(function(){
	$("#create_competences").validate({
    submitHandler: function (form) {
        var id = $('#addfreelancerdata').attr('data_id');
        var numberOfChecked = $('.core_checkbox input:checkbox:checked').length;
        if(numberOfChecked>5)
        {
            swal('Error','Please Select Core Competences Only 5','error');
            return false;
        }
        $('#addfreelancerdata').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
    	$.ajax({
                url: 'create/competences/'+ id,
                type: "POST",
                data: $(form).serialize(),
                success: function(response, status, xhr, $form) {
                	setTimeout(function() {
                        $('#addfreelancerdata').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        if(response =='success')
                        {
	                       window.location.replace('dashboard');
                        }
                    }, 5000);
                },
                error: function(data){
                        $('#addfreelancerdata').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
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
    $('#editfreelancerdata').click(function(){
    $("#edit_competences").validate({
    submitHandler: function (form) {
        var id = $('#editfreelancerdata').attr('data_id');
        var numberOfChecked = $('.core_checkbox input:checkbox:checked').length;
        if(numberOfChecked>5)
        {
            swal('Error','Please Select Core Competences Only 5','error');
            return false;
        }
        $('#editfreelancerdata').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
        $.ajax({
                url: 'edit/competences/'+ id,
                type: "POST",
                data: $(form).serialize(),
                success: function(response, status, xhr, $form) {
                    setTimeout(function() {
                        $('#editfreelancerdata').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        if(response.message =='Success')
                        {
                           window.location.replace('dashboard');
                        }
                    }, 5000);
                },
                error: function(data){
                        $('#editfreelancerdata').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
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
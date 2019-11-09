jQuery(document).ready(function () {
	$('#deleteContact').click(function(){
		var id = $(this).attr('data-ID');
		url = '../delete'
      	$.ajax({
        url: url+'/'+id,
        	success: function(response) { 
          		setTimeout(function() {
	            if(response == 'success'){
	            //$(this).parent().remove();
	            window.location.replace('../../../admin/contacts');
	            }
	                      }, 5000);
            }});
		});
});
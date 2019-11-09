jQuery(document).ready(function () {
  $("#LeaveComment").click(function(e){
  e.preventDefault();
  var comment_val = $("#comment_area").val();
  var auth_id = $("#auth_id").val();
  var _token = $('input[name="_token"]').val();
  var url = 'dashboard';
  if(comment_val=='' ){
    swal("Error","All fields are required","error");
  }else{
   $.ajax({
      type: 'POST',
      url: url+'/comment',
      data: {
        comment: comment_val,
        auth_id: auth_id,
        _token: _token,
      },
      success: function(data) {
        var res = $.parseJSON(data);
        if(res.status == 'error'){
          swal('Error',res.message,'error');
        }else{
          $("#comment_area").val('');
          $("#m_quick_sidebar").removeClass('m-quick-sidebar--on');
          swal('Success',res.message,'success');
          setTimeout(function() {
                  window.location.replace('');
          }, 3000);
        } 
      },
      error: function(data) {
        swal('Error',data,'error');
      }
  })
  }
  })
  $("#CancelComment").click(function(e){
  e.preventDefault();
  $("#comment_area").val('');
  })
});
jQuery(document).ready(function () {

  // $('#general_notes').keyup(function(){
  //       var text = $('#general_notes').val();
  //       localStorage.setItem("general_notes", text);
  //     });
  // var general_notes = localStorage.getItem("general_notes");
  // if(general_notes!='')
  // {
  //   $('#general_notes').val(general_notes);
  // }
  $('#general_notes').blur(function(){
        var text = $('#general_notes').val();
        var account_id = $('#account_id').val();
        url = '../updateGeneralNote';
         $.ajax({
            url: url+'/'+account_id,
            data: {
              comment: text,
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response) { 
                    
        }});
  });

  $(document).on("click", ".comment_del", function () {
        var comment_id = $(this).data('id');
        $("#comment_id").val( comment_id );
      });
      $(document).on("click", ".comment_edit", function () {
        var comment_id = $(this).data('id');
        $("#comment_id").val( comment_id );
        var comment = $(this).data('comment');
        $('#comment_area_edit').val(comment);
      });
      $('#editComment').on("click" , function(){
        var id = $('#comment_id').val();
        var account_id = $('#account_id').val();
        var comment    = $('#comment_area_edit').val();
        if(comment==''){
          swal("Error","Comments Field Required","error");
        }else{
        url = '../editComment'
            $.ajax({
            url: url+'/'+account_id+'/'+id,
            data: {
              comment_text: comment,
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response) { 
                    var res = $.parseJSON(response);
                    if(res.status == 'error'){
                      swal('Error',res.message,'error');
                    }else{
                      swal('Success',res.message,'success');
                      setTimeout(function() {
                              window.location.replace('');
                      }, 2000);
                    }
                }});
          }
        });
      $('#admin_account_link').addClass('m-menu__item--active');
      $("#LeaveComment").click(function(e){
        e.preventDefault();
        var contact_id = $("#user_name").val();
        var comment_val = $("#comment_area").val();
        var auth_id = $("#auth_id").val();
        var account_id = $("#account_ids").val();
        var _token = $('input[name="_token"]').val();
        var url = '../../contacts';
        if(contact_id=='' || comment_val=='' ){
          swal("Error","All fields are required","error");
        }else{
         $.ajax({
            type: 'POST',
            url: url+'/comment',
            data: {
              contact_id: contact_id,
              comment: comment_val,
              auth_id: auth_id,
              _token: _token,
              account_id: account_id,
            },
            success: function(data) {
              var res = $.parseJSON(data);
              if(res.status == 'error'){
                swal('Error',res.message,'error');
              }else{
                $("#user_name").val('');
                $("#comment_area").val('');
                $("#m_quick_sidebar").removeClass('m-quick-sidebar--on');
                swal('Success',res.message,'success');
                setTimeout(function() {
                        window.location.replace('');
                }, 1000);
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
        $("#user_name").val('');
        $("#comment_area").val('');
      })

      $("#user_name").on('change',function(){
        var acc_id = $(this).val();
        get_account_id(acc_id);
      })

      function get_account_id(acc_id){
          var path = '../../contacts/get_account_id/'+acc_id;
          $.ajax({
                url: path,
                type: "GET",
                data: {
              acc_id: acc_id,
              _token: '{{csrf_token()}}',  
            },
                success: function(result){
              console.log(result);
              var res = $.parseJSON(result);

              if(res.status == 'error'){

              }else{               
                var data = $.parseJSON(JSON.stringify(res.message));
                $("#account_ids").val(data.account_id);
                

              }
            },
            error: function(){
              swal('Error','Please Select Manager');
            }
               });
        }
});

jQuery(document).ready(function () {
var DropDrownVal="";
	var datatable;
	// $('#m_form_type').one('change', function (event) {
 //       DropDrownVal = $(this).val();
 //       datatable.reload();
 //    });
      (function() {
          $('.loader_msg').css('display','none');
          var view_url = 'employees/view';
          datatable = $('.m_datatable').mDatatable({
            // datasource definition
          data: {
          type: 'remote',
          source: {
              read: {
                  url: 'employees/getAllEmployees',
                  method: 'GET',
                  // custom headers
                  headers: { 'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                  params: {
                      // custom query params
                      query: {
                          generalSearch: '',
                      }
                  },
                  map: function(raw) {
                      // sample data mapping
                      var dataSet = raw;
                      if (typeof raw.data !== 'undefined') {
                           dataSet = raw.data;
                      }
                      return dataSet;
                  },
              }
          },
          pageSize: 10,
            saveState: {
                cookie: false,
                webstorage: false
            },

            serverPaging: false,
            serverFiltering: false,
            serverSorting: false
        },
      // layout definition
        layout: {
          theme: 'default', // datatable theme
          class: '', // custom wrapper class
          scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
          // height: 450, // datatable's body's fixed height
          footer: false // display/hide footer
        },

        // column sorting
        sortable: true,

        pagination: true,

        search: {
          input: $('#generalSearch')
        },

        // inline and bactch editing(cooming soon)
        // editable: false,

        // columns definition
        columns: [{
        field: "S_No",
        title: "S.No",
        textAlign: 'center',
        width:80
      },
      // {
      //   field: "id",
      //   title: "ID",
      //   textAlign: 'center',
      //   }, 
        {
          field: "first_name",
          title: "employees Name",
          template: function (row) {
          var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
          
              return '\
                    <div >\
                      <a title="View Permission" href="'+view_url+'/'+row.id+'">'+row.first_name+'  <span>'+row.last_name+'</span></a>\
                    </div>\
                    ';
          }
        },
        {
          field: "email",
          title: "Email ID",
        }]
      });
      $('#m_form_status, #m_form_type').selectpicker();
      $('#m_form_status').on('change', function (event) {
        var value = $(this).val();
        datatable.search(value,'Status')
        //datatable.setDataSourceQuery({searchhotness:value});
        //datatable.reload();
      });
})();
// $('#employee_email').keyup(function(){
//   var email = $('#employee_email').val();
//   $.ajax({
//     url: 'employee/checkEmailExist',
//     data : {email : email},
//     success: function(response) { 
//       if(response == 'error')
//       {
//         swal('Error','Email_Id already Exist','error');
//         $('#email_exist').html('Email Id ');
//         return false;
//       }
//     }});
// });
$('#m_signup_employee').on('click',function(){
$("#addemployee").validate({
  rules:
  {
    first_name:
    {
      required: true,
      minlength: 3
    },
    last_name:
    {
      required: true,
      minlength: 3
    },
    employee_email: {
      required: true,
      email: true
    },
    employee_password: {
      required: true,
    }
  },
    submitHandler: function (form) {
       var email = $('#employee_email').val(); 
      $.ajax({
        url: 'employee/checkEmailExist',
        data : {email : email},
        success: function(response) { 
          if(response == 'error')
          {
            swal('Error','Email_Id already Exist','error');
            $('#email_exist').html('Email Id ');
            return false;
          }
          else
          {
            $('#m_signup_employee').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            $.ajax({
                url: 'employees/new',
                type: "POST",
                data: $(form).serialize(),
                success: function(response, status, xhr, $form) {
                    $('#m_signup_employee').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    var res = $.parseJSON(response);
                    if(res.status == 'error'){
                      swal('Error',res.message,'error');
                    }
                    else{
                      swal('Success',res.message,'success');
                      setTimeout(function() {
                        window.location.replace('');
                        }, 2000);
                    }    
                    
                },
                error: function(data){
                  $('#m_signup_employee').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                var errors = data.responseJSON;
                $.each(errors, function(key, val){
                  $('.'+key).show().html(val);
                  $('.'+key).css('color','red');
                });
          }
            });
          }
      }});
      
    }
    });
    });

});

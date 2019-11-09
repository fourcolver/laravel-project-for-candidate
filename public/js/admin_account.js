jQuery(document).ready(function () {
var DropDrownVal="";
	var datatable;
	// $('#m_form_type').one('change', function (event) {
 //       DropDrownVal = $(this).val();
 //       datatable.reload();
 //    });
      (function() {
          $('.loader_msg').css('display','none');
          var accountsdata;
          var edit_url = 'ad_accounts/edit';
          var delete_url = 'ad_accounts/delete';
          var view_url = 'ad_accounts/view';
          datatable = $('.m_datatable').mDatatable({
            // datasource definition
          data: {
          type: 'remote',
          source: {
              read: {
                  url: 'ad_accounts/getAllAccounts',
                  method: 'GET',
                  // custom headers
                  headers: { 'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                  params: {
                      // custom query params
                      query: {
                          generalSearch: '',
                          searchhotness: ''
                      }
                  },
                  map: function(raw) {
                  	  console.log('ITS RUN');
                  	  console.log(raw);
                      // sample data mapping
                      var dataSet = raw;
                      if (typeof raw.data !== 'undefined') {
                           dataSet = raw.data;
                      }
                      console.log('Result');
                      console.log(dataSet);
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
        columns: [
        {
          field: "S_No",
          title: "S.No",
          textAlign: 'center',
          width: 50,
        },
        // {
        //   field: "id",
        //   title: "ID",
        //   textAlign: 'center',
        //   width: 50,
        // }, 
        {
          field: "account_name",
          title: "Kundenname",
          template: function (row) {
            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

            return '\
                  <div >\
                    <a title="View this Kunden" href="'+view_url+'/'+row.id+'">'+row.account_name+'</a>\
                  </div>\
            ';
          }
        }, 
        {
            field: "client_specification",
            title: "Hotness Of Client",
            width : 150             
        },
        {
          field: "pincode",
          title: "Postcode",
                  width: 70
        }, {
          field: "freelancers",
          title: "No.of Freelancers",
          width: 124
        }, {
          field: "Technology",
          title: "Technology",
          width: 150,
        },
        {
          field: "type_of_client",
          title: "Type Of Client",
           width : 150
        }, {
          field: "last_activity",
          title: "Last Contact",
	         width : 150
        }]
      });
      $('#m_form_status, #m_form_type').selectpicker();

      $('#m_form_type').on('change', function (event) {
      	var value = $(this).val();
          datatable.setDataSourceQuery({searchhotness:value});
          datatable.reload();
      });
      
})();
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
                url: 'ad_accounts/new',
                type: "POST",
                data: $(form).serialize(),
                success: function(response, status, xhr, $form) {
                  setTimeout(function() {
                    $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        if(response =='success')
                        {
                         window.location.replace('ad_accounts');
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

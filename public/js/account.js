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
          var edit_url = 'accounts/edit';
          var delete_url = 'accounts/delete';
          var view_url = 'accounts/view';
          datatable = $('.m_datatable').mDatatable({
            // datasource definition
          data: {
          type: 'remote',
          source: {
              read: {
                  url: 'accounts/getAllAccounts',
                  method: 'GET',
                  // custom headers
                  headers: { 'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                  params: {
                      // custom query params
                      query: {
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
            serverSorting: true
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

        // search: {
        //   input: $('#generalSearch')
        // },

        // inline and bactch editing(cooming soon)
        // editable: false,

        // columns definition
        columns: [
        // {
        //   field: "action",
        //   title: "#",
        //   textAlign: 'center',
        //   width: 50,
        // },
        {
          field: "S_No",
          title: "S.No",
          textAlign: 'center',
          width: 80,
          textAlign: 'center',
        },
        // {
        //   field: "id",
        //   title: "ID",
        //   textAlign: 'center',
        //   width: 50,
        //   textAlign: 'center',
        // }, 
        {
          field: "account_name",
          title: "Kundenname",
          template: function (row) {
            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

            return '\
                  <div >\
                     <a title="View this Kunden" href="'+view_url+'/'+row.id+'/'+row.list_id+'">'+row.account_name+'</a>\
                  </div>\
            ';
          },
          width : 150,
        }, 
        {
            field: "client_specification",
            title: "Hotness",
            width : 100,
            textAlign: 'center',             
        },
        {
          field: "pincode",
          title: "Postcode",
          width: 100,
          textAlign: 'center',
        }, {
          field: "freelancers",
          title: "No.of Freelancers",
          width: 150,
          textAlign: 'center',
        },
        {
          field: "touch_rule",
          title: "7 Touch Rule",
          width: 330,
          textAlign:'center',
          template: function (row) {
            var touch_rule = row.touch_rule;
            if(touch_rule==null)
            {
              return '\
              <div></div>\
              ';
            }
              touch_rule = touch_rule.replace(/,/g,",  ");
              return '\
                <div>'+touch_rule+'</div>\
              ';
          }
        }, {
          field: "Technology",
          title: "Technology",
          width: 240,
          template: function (row) {
            var Technology = row.Technology;
            if(Technology==null)
            {
              return '\
              <div></div>\
              ';
            }
              Technology = Technology.replace(/,/g,",  ");
              return '\
                <div>'+Technology+'</div>\
              ';
          }
        },
        {
          field: "detailed_technologies",
          title: "Detailed Technologies",
          width: 200,
          template: function (row) {
            var data='<select class="btn dropdown-toggle bs-placeholder btn-default">';
          if(row.detailed_technologies != null)
          {
            var technologies = row.detailed_technologies.split(',');
            $.each(technologies, function(index, value) { 
              data = data+"<option>"+value+"</option>";
            });
            data = data + "</select>"; 
            return '\
                  <span>'+data+'</span>\
            ';
          }
          else
          {
            return '\
                  <span ></span>\
            ';
          }
          }
        },
        {
          field: "type_of_client",
          title: "Type Of Client",
           width : 150
        },
        {
          field: "first_name",
          title: "Added By",
          width : 150,
          template: function (row) {
            return '\
            <span>'+row.first_name+'</div>\
            ';
          }
        },
        {
          field: "last_activity",
          title: "Last Contact",
          width : 150,
          template: function (row) {
            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
            var date = row.last_activity;
            if(date == null)
            {date = '';}
            else{date = date.split(' ')[0];}
            //date = row.task_date.split(' ')[0];
            return '\
            <div >\
              '+date+'\
            </div>\
            ';
          }
        }]
      });
      $('#m_form_status, #m_form_type, #m_form_hotness,#m_form_list').selectpicker();

      $('#m_form_type').on('change', function (event) {
        var value = $(this).val();
          datatable.setDataSourceQuery({searchhotness:value});
          datatable.reload();
      });
      $('#load_list').on('change',function(){
        var value = $(this).val();
        datatable.setDataSourceQuery({load_list:value});
        datatable.reload();
      });
      
})();

$('#accountList').on('click',function(){
      var hotness               = $('#m_form_hotness').val();
      var postcode              = $('#account_postcode').val();
      var freelancer            = $('#account_freelancers').val();
      var technology            = $('#account_technology').val();
      var lastcontact           = $('#account_lastcontact').val();
      var list_name             = $('#list_name').val();     
      var detailed_technologies = $('#m_select2_9').val();     
      if(list_name=='')
      {
        swal('Error','List Name Required','error');
        return false;
      }
      $.ajax({
      url: 'accounts/CreateList',
      data: {hotness : hotness,postcode: postcode,freelancer : freelancer,technology: technology,list_name: list_name,lastcontact: lastcontact,detailed_technologies:detailed_technologies},
          success: function(response) {
          $('#accountList').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
          $('#account_freelancers').val();
          var res = response;
          if(res.status == 'error'){
            swal('Error',res.message,'error');
          }
          else{
            swal('Success',res.message,'success');
            setTimeout(function() {
              window.location.replace('');
              }, 1000);
          }
      }});
  });
$("#pincode,#departement_size,#account_postcode,#account_freelancers").keydown(function (e) {
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

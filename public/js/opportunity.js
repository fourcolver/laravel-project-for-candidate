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
          var edit_url = 'opportunity/edit';
          var view_client = 'accounts/view';
          var delete_url = 'opportunity/delete';
          var view_url = 'opportunity/view';
          datatable = $('.m_datatable').mDatatable({
            // datasource definition
          data: {
          type: 'remote',
          source: {
              read: {
                  url: 'opportunity/getAllOpportunity',
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
        field: "id",
        title: "id",
        selector: {class: 'm-checkbox--solid m-checkbox--brand'},
        width:50
        },
        {
            field: "name",
            title: "Opportunity Name",
            
            template: function (row) {
            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                if(row.permission.admin=='admin')
                {
                return '\
                  <a title="Edit Opportunity" href="'+edit_url+'/'+row.id+'">'+row.name+'</a>\
                ';
                }
                var projektanfrage_permission = row.permission.projektanfrage_permission;
                var projektanfrage_permission = projektanfrage_permission.split(',');
                //alert(task_permission);
                if ($.inArray('edit', projektanfrage_permission)!='-1')
                {
                return '\
                  <a title="Edit Opportunity" href="'+edit_url+'/'+row.id+'">'+row.name+'</a>\
                ';
                }
                else
                {
                  return '\
                  <a title="No Permission For Edit Opportunity">'+row.name+'</a>\
                ';
                }
            },
            width : 180
        },
        {
            field: "probability",
            title: "Probability",
            template: function (row) {
            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                return '\
                  <span>'+row.probability+' %</span>\
                ';
            }
        },
        {
            field: "hotness",
            title: "Hotness of Client",
            
            template: function (row) {
            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                if(row.hotness==0)
                {
                  return '\
                  <span></span>\
                  ';
                }
                return '\
                  <span>'+row.hotness+' /10</span>\
                ';
            },
            width : 155
        },
                {
          field: "detailed_coding",
          title: "Coding",
          width: 160,
          template: function (row) {
            var data='<select class="btn dropdown-toggle bs-placeholder btn-default">';
          if(row.detailed_coding != null)
          {
            var technologies = row.detailed_coding.split(',');
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
          field: "client_name",
          title: "Client Name",

          
          template: function (row) {
            return '\
                  <a title="View client" href="'+view_client+'/'+row.account_id+'/0">'+row.client_name+'</a>\
                ';
          },
          width : 120,
            responsive: {visible: 'lg'}          
        },
        {
            field: "client_number",
            title: "Client Number",
            width : 150,
            responsive: {visible: 'lg'}
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
            field: "technology",
            title: "Technology",
            responsive: {visible: 'lg'}
        },
        {
            field: "info_field",
            title: "Info Field",
            width : 150,
            responsive: {visible: 'lg'}
        },
        {
          field: "opportunity_type",
          title: "Opportunity Type",
          
          template: function (row) {
            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
            if(row.opportunity_type=='0')
            {
              return '\
              <span>Contract</span>\
              ';
            }
            else
            {
             return '\
              <span>Permanent</span>\
              '; 
            }
              
            },
            width: 150
        },
        {
          field: "opportunity_status",
          title: "Opportunity Status",
          
          template: function (row) {
            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
            if(row.opportunity_status=='0')
            {
              return '\
              <span>Inactive</span>\
              ';
            }
            else
            {
             return '\
              <span>Active</span>\
              '; 
            }
              
            },
            width: 180,
        }]
      });
    var query = datatable.getDataSourceQuery();

    $('.m_datatable').on('m-datatable--on-check', function (e, args) {
              var count = datatable.getSelectedRecords().length;
              selcontacts = $.map(datatable.getSelectedRecords(), function (item) {
              return $(item).find("td").eq(0).find("input").val();
              });
            $('#m_datatable_selected_number').html(count);
            if (count > 0) {
              $('#sendBulkprofile').show();
            }
          })
          .on('m-datatable--on-uncheck m-datatable--on-layout-updated', function (e, args) {
            var count = datatable.getSelectedRecords().length;
            $('#m_datatable_selected_number').html(count);
            if (count === 0) {
              $('#sendBulkprofile').hide();
            }
          });
    $('#sendBulkprofile').on('click', function(){
          var path = "opportunity/bulkProfile";
          //alert(path);
          var opportunity_id = JSON.parse(JSON.stringify(selcontacts));
          $.ajax({
          type: 'POST',
          url: path,
          data: {
            opportunity_id : opportunity_id,
          },
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
          success: function(data) {
            var res = $.parseJSON(data);
            if(res.status == 'error'){
              swal('Error',res.message,'error');
            }else{
               swal('Success',res.message,'success');
               //datatable.reload();
            } 
          },
          error: function(data) {
            //swal('Error',data,'error');
            return false;
          }
        });
        })
    $('#opportunityList').on('click',function(){
      var oppo_technology   = $('#oppo_technology').val();
      var list_name         = $('#list_name').val().trim();     
      var opp_coding        = $('#m_select2_9').val();
      var hotness_client    = $('#hotness_client').val();
      var list_type         = $('#list_type').val();
      var opportunity_status= $('#opportunity_status').val();


      if(list_name=='')
      {
        swal('Error','List Name Required','error');
        return false;
      }
      $.ajax({
      url: 'opportunity/CreateList',
      data: {oppo_technology : oppo_technology,list_name: list_name,opp_coding: opp_coding,hotness_client:hotness_client,list_type:list_type,opportunity_status:opportunity_status},
          success: function(response) {
          $('#opportunityList').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
          $('#account_freelancers').val();
          var res = $.parseJSON(response);
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

    $('#m_form_status').on('change', function () {
      datatable.search($(this).val(), 'Status');
    }).val(typeof query.Status !== 'undefined' ? query.Status : '');

    $('#m_form_type').on('change', function () {
      datatable.search($(this).val(), 'Type');
    }).val(typeof query.Type !== 'undefined' ? query.Type : '');
    $('#load_list').on('change',function(){
        var value = $(this).val();
        datatable.setDataSourceQuery({load_list:value});
        datatable.reload();
    });

    $('#m_form_status, #m_form_type').selectpicker();


})();
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
    $('#account_select').click(function(){
    $('#select_account').validate({
            rules: {
            account_name: {
                required: {
                    depends: function(element) {
                        return $("#account_name").val() == '';
                    }
                 }
            },
            opportunity_type: {
                required: {
                    depends: function(element) {
                        return $("#opportunity_type").val() == '';
                    }
                 }
            }
        },
        invalidHandler: function(f,v) {
            $('#addContact').css('display','none');    
        },
        submitHandler: function (form) {
            $('#addOpportunity').css('display','block');
            var account_name = $("#account_name").val();
            var opportunity_type = $("#opportunity_type").val();
            $('#account_id').val(account_name);
            $('#oppo_type').val(opportunity_type);
            $('#account_name').prop('disabled',true);
            $('#opportunity_type').prop('disabled',true);
            var id = $("#account_name").val();
            showData(id);
        }
    });
    });
  $("#addOpportunity").validate({
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
        /*var quantity_1 = $('#quantity_1').val();
        var price_1     = $('#price_1').val();
        var product_1   = $('#product_1').val();
        if(quantity_1 !='' || price_1 !='' || product_1 !='')
        {
            if(price_1 == '')
            {
                $('.price_1').html('Please Enter Price');
                return false;
            }
            if(product_1 == '')
            {
                $('.product_1').html('Please Select Product');
                return false;
            }
            if(quantity_1 == '')
            {
                $('.quantity_1').html('Please Enter Quantity');
                return false;
            }
            if(price_1 == '' && product_1 =='')
            {
                $('.price_1').html('Please Enter Price');
                $('.product_1').html('Please Select Product');
                return false;
            }
            if(quantity_1 == '' && product_1 =='')
            {
                $('.quantity_1').html('Please Enter Quantity');
                $('.product_1').html('Please Select Product');
                return false;
            }
            if(price_1 == '' && quantity_1 =='')
            {
                $('.price_1').html('Please Enter Price');
                $('.quantity_1').html('Please Select Quantity');
                return false;
            }
            
            
        }
        var quantity_2  = $('#quantity_2').val();
        var price_2     = $('#price_2').val();
        var product_2   = $('#product_2').val();
        if(quantity_2 !='' || price_2 !='' || product_2 !='')
        {
            if(price_2 == '')
            {
                $('.price_2').html('Please Enter Price');
                return false;
            }
            if(product_2 == '')
            {
                $('.product_2').html('Please Select Product');
                return false;
            }
            if(quantity_2 == '')
            {
                $('.quantity_2').html('Please Enter Quantity');
                return false;
            }
            if(price_2 == '' && product_2 =='')
            {
                $('.price_1').html('Please Enter Price');
                $('.product_1').html('Please Select Product');
                return false;
            }
            if(quantity_2 == '' && product_2 =='')
            {
                $('.quantity_1').html('Please Enter Quantity');
                $('.product_1').html('Please Select Product');
                return false;
            }
            if(price_2 == '' && quantity_2 =='')
            {
                $('.price_1').html('Please Enter Price');
                $('.product_1').html('Please Select Product');
                return false;
            }
            
        }*/
        $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
      $.ajax({
                url: 'opportunity/new',
                type: "POST",
                data: $(form).serialize(),
                success: function(response, status, xhr, $form) {
                  setTimeout(function() {
                        $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        if(response =='success')
                        {
                         window.location.replace('opportunity');
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

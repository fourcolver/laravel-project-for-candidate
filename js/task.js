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
          var edit_url = 'tasks/edit';
            var delete_url = 'tasks/delete';
            var view_url = 'tasks/view';
          datatable = $('.m_datatable').mDatatable({
            // datasource definition
          data: {
          type: 'remote',
          source: {
              read: {
                  url: 'tasks/getAllTasks',
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
        columns: [{
        field: "S_No",
        title: "S.No",
        textAlign: 'center',
        width:40
      },
      // {
      //   field: "id",
      //   title: "ID",
      //   textAlign: 'center',
      //   width:40
      // }, 
            {
                field: "priority",
                title: "Priority",
                textAlign: 'center',
                template: function (row) {
                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                    if(row.priority=='Medium')
                    {
                    return '\
                    <div >\
                      <span class="m-badge m-badge--info m-badge--wide">'+row.priority+'</span>\
                    </div>\
                    ';
                    }
                    else if(row.priority=='Low')
                    {
                       return '\
                    <div >\
                      <span class="m-badge m-badge--success m-badge--wide">'+row.priority+'</span>\
                    </div>\
                    '; 
                    }
                    else if(row.priority=='High')
                    {
                       return '\
                    <div >\
                      <span class="m-badge m-badge--warning m-badge--wide">'+row.priority+'</span>\
                    </div>\
                    '; 
                    }
                    else
                    {
                      return '\
                    <div >\
                      <span class="m-badge m-badge--danger m-badge--wide">'+row.priority+'</span>\
                    </div>\
                    ';   
                    }
                }
            },
            {
                field: "task_date",
                title: "Task Date",
                textAlign: 'center',
                template: function (row) {
                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                    date = row.task_date.split(' ')[0];
                    if(row.permission.admin=='admin')
                    {
                      return '\
                      <div >\
                        <a title="Edit this Task" href="'+edit_url+'/'+row.id+'">'+date+'</a>\
                      </div>\
                      ';
                    }
                    var task_permission = row.permission.task_permission;
                    var task_permission = task_permission.split(',');
                    //alert(task_permission);
                    if ($.inArray('edit', task_permission)!='-1')
                    {
                      return '\
                      <div >\
                        <a title="Edit this Task" href="'+edit_url+'/'+row.id+'">'+date+'</a>\
                      </div>\
                      ';
                    }
                    else
                    {
                      return '\
                      <div >\
                        <a title="No Permission for Edit Task">'+date+'</a>\
                      </div>\
                      ';
                    }
                }
            },
            {
                field: "account_name",
                title: "Account Name",
                textAlign: 'center'
            },
            {
        field: "task_status",
        title: "Task Status",
        width: 100
      },
            {
                field: "description",
                title: "Description",
                width: 110
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
});

jQuery(document).ready(function () {
var DropDrownVal="";
    var datatable;
    var gauge_data;
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
                  url: 'dashboard/getTasksData',
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
                field: "id",
                title: "S. No",
                textAlign: 'center',
                width:40
            }, 
            {
                field: "priority",
                title: "Priority",
                textAlign: 'center',
                width:90,
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
                width:80,
                template: function (row) {
                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                    date = row.task_date.split(' ')[0];
                    return '\
                    <div >\
                      '+date+'\
                    </div>\
                    ';
                }
            },
            {
                field: "account_name",
                title: "Kunden Name",
                width:120,
                textAlign: 'center',
                template: function (row) {
                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                    date = row.task_date.split(' ')[0];
                    if(row.account_status==0)
                    {
                      return '\
                      <div >\
                        <a title="View Task Account" href="admin/accounts/view/'+row.account_id+'">'+row.account_name+'</a>\
                      </div>\
                      ';
                    }
                    return '\
                      <div >\
                        <a title="View Task Account Not in Database" href="admin/ad_accounts/view/'+row.account_id+'">'+row.account_name+'</a>\
                      </div>\
                      ';
                }
            },
            {
                field: "task_status",
                title: "Task Status",
                width: 100
            },
            {
                field: "description",
                title: "Description",
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
$.ajax({
  url: 'dashboard/getAllGaugeDetails',
  'async': false,
  success: function(response) {
    gauge_data = response;
}});
var goal_by = $('#auth_id').val();
$.ajax({
  url: 'dashboard/getgoalDetails',
  data: {id : goal_by},
  'async': false,
  success: function(response) {
    if(response!='')
    {
      var goalset = response;
      $('#client_activity').val(response.client_activity);
      $('#client_add').val(response.client_add);
      $('#candidate_add').val(response.candidate_add);
      $('#oppo_add').val(response.oppo_add);
    }

}});
$("#client_activity").keydown(function (e) {
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
/***********************************On Change Gauge*******************************/
var client_activity_max = 50;
var client_add_max = 50;
var candidate_add_max = 50;
var oppo_add_max = 50;
var goal_by = $('#auth_id').val();
  $('#client_activity,#client_add,#candidate_add,#oppo_add').blur(function(){ 
  var client_activity = $('#client_activity').val();
  var client_add = $('#client_add').val();
  var candidate_add = $('#candidate_add').val();
  var oppo_add = $('#oppo_add').val();
  $.ajax({
    url: 'dashboard/setGoal',
    data: {goal_by : goal_by,client_activity: client_activity, client_add: client_add, candidate_add: candidate_add,oppo_add:oppo_add},
    success: function(response) {
    
    }});
  if(client_activity !='')
  {
    $('#client_activities').html('');
    client_activity_max = client_activity;
    var client_activitiy_gauge = new JustGage({
        id: "client_activities",
        value: gauge_data.client_activities,
        min: 0,
        max: client_activity_max,
        title: "Client Activities Added",
        label: "",
        levelColors: [
          "#F03E3E",
          "#FFDD00",
          "#30B32D"
        ]
      });
  }
  else
  {
    $('#client_activities').html('');
    var client_activitiy_gauge = new JustGage({
        id: "client_activities",
        value: gauge_data.client_activities,
        min: 0,
        max: 50,
        title: "Client Activities Added",
        label: "",
        levelColors: [
          "#F03E3E",
          "#FFDD00",
          "#30B32D"
        ]
      });
  }
  if(client_add !='')
  {
    $('#client_added').html('');
    client_add_max = client_add;
    var client_added_gauge = new JustGage({
        id: "client_added",
        value: gauge_data.client_added,
        min: 0,
        max: client_add_max,
        title: "Client Added",
        label: "",
        levelColors: [
          "#F03E3E",
          "#FFDD00",
          "#30B32D"
        ]
      });
  }
  else
  {
    $('#client_added').html('');
    var client_added_gauge = new JustGage({
        id: "client_added",
        value: gauge_data.client_added,
        min: 0,
        max: 50,
        title: "Client Added",
        label: "",
        levelColors: [
          "#F03E3E",
          "#FFDD00",
          "#30B32D"
        ]
      });
  }
  if(candidate_add !='')
  {
    $('#candidate_added').html('');
    candidate_add_max = candidate_add;
    var client_added_gauge = new JustGage({
        id: "candidate_added",
        value: gauge_data.candidate_added,
        min: 0,
        max: candidate_add_max,
        title: "Candidate Added",
        label: "",
        levelColors: [
          "#F03E3E",
          "#FFDD00",
          "#30B32D"
        ]
      });
  }
  else
  {
    $('#candidate_added').html('');
    var client_added_gauge = new JustGage({
        id: "candidate_added",
        value: gauge_data.candidate_added,
        min: 0,
        max: 50,
        title: "Candidate Added",
        label: "",
        levelColors: [
          "#F03E3E",
          "#FFDD00",
          "#30B32D"
        ]
      });
  }
  if(oppo_add !='')
  {
    $('#opportunity_added').html('');
    oppo_add_max = oppo_add;
    var client_added_gauge = new JustGage({
        id: "opportunity_added",
        value: gauge_data.opportunity_added,
        min: 0,
        max: oppo_add_max,
        title: "Opportunity Added",
        label: "",
        levelColors: [
          "#F03E3E",
          "#FFDD00",
          "#30B32D"
        ]
      });
  }
  else
  {
    $('#opportunity_added').html('');
    var client_added_gauge = new JustGage({
        id: "opportunity_added",
        value: gauge_data.opportunity_added,
        min: 0,
        max: 50,
        title: "Opportunity Added",
        label: "",
        levelColors: [
          "#F03E3E",
          "#FFDD00",
          "#30B32D"
        ]
      });
  }
  });
/******************************Client Activities Gauge*****************************/
  var client_activity_value = $('#client_activity').val();
  if(client_activity_value !='' && client_activity_value !=null)
  {
    client_activity_max = client_activity_value
  }
  var client_activitiy_gauge = new JustGage({
        id: "client_activities",
        value: gauge_data.client_activities,
        min: 0,
        max: client_activity_max,
        title: "Client Activities Added",
        label: "",
        levelColors: [
          "#F03E3E",
          "#FFDD00",
          "#30B32D"
        ]
      });

/******************************Client Added Gauge *****************************/
  var client_add_value = $('#client_add').val();
  if(client_add_value !='' && client_add_value !=null)
  {
    client_add_max = client_add_value
  }
  var client_added_gauge = new JustGage({
        id: "client_added",
        value: gauge_data.client_added,
        min: 0,
        max: client_add_max,
        title: "Client Added",
        label: "",
        levelColors: [
          "#F03E3E",
          "#FFDD00",
          "#30B32D"
        ]
      });

/******************************Candidates Added Gauge *****************************/
  var candidate_add_value = $('#candidate_add').val();
  if(candidate_add_value !='' && candidate_add_value !=null)
  {
    candidate_add_max = candidate_add_value
  }
  var client_activitiy_gauge = new JustGage({
        id: "candidate_added",
        value: gauge_data.candidate_added,
        min: 0,
        max: candidate_add_max,
        title: "Candidate Added",
        label: "",
        levelColors: [
          "#F03E3E",
          "#FFDD00",
          "#30B32D"
        ]
      });

/******************************Opportunity Added Gauge *****************************/
  var oppo_add_value = $('#oppo_add').val();
  if(oppo_add_value !='' && oppo_add_value !=null)
  {
    oppo_add_max = oppo_add_value
  }
  var client_activitiy_gauge = new JustGage({
        id: "opportunity_added",
        value: gauge_data.opportunity_added,
        min: 0,
        max: oppo_add_max,
        title: "Opportunity Added",
        label: "",
        levelColors: [
          "#F03E3E",
          "#FFDD00",
          "#30B32D"
        ]
      });
});

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
                title: "ID",
                textAlign: 'center'
            }, 
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
                      <span class="m-badge m-badge--success m-badge--wide">'+row.priority+'</span>\
                    </div>\
                    ';
                    }
                    else if(row.priority=='Low')
                    {
                       return '\
                    <div >\
                      <span class="m-badge m-badge--warning m-badge--wide">'+row.priority+'</span>\
                    </div>\
                    '; 
                    }
                    else if(row.priority=='High')
                    {
                       return '\
                    <div >\
                      <span class="m-badge m-badge--danger m-badge--wide">'+row.priority+'</span>\
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
                    return '\
                    <div >\
                      '+date+'\
                    </div>\
                    ';
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
$.ajax({
  url: 'dashboard/getAllGaugeDetails',
  'async': false,
  success: function(response) {
    gauge_data = response;
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
/******************************Client Activities Gauge If not Set*****************************/
var client_activities_opts = {
  angle: 0.05, // The span of the gauge arc
  lineWidth: 0.24, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.51, // // Relative to gauge radius
    strokeWidth: 0.071, // The thickness
    color: '#000000' // Fill color
  },
  // staticLabels: {
  // font: "10px sans-serif",  // Specifies font
  // labels: [100, 530, 1000, 2200, 2600, 3000],  // Print labels at these values
  // color: "#000000",  // Optional: Label text color
  // fractionDigits: 0  // Optional: Numerical precision. 0=round off.
  // },
  staticLabels: {
  font: "10px sans-serif",  // Specifies font
  labels: [0, 100, 200, 300],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
    staticZones: [
    {strokeStyle: "#F03E3E", min: 0, max: 100},
    {strokeStyle: "#FFDD00", min: 100, max: 200},
    {strokeStyle: "#30B32D", min: 200, max: 300}
  ],
  
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support

};

$('#client_activity').blur(function(){ 
  var client_activity = $('#client_activity').val();
  var lable = Math.round(client_activity/3);
  var next_lable = lable + lable;
  var client_activity_opts = {
  angle: 0.05, // The span of the gauge arc
  lineWidth: 0.24, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.51, // // Relative to gauge radius
    strokeWidth: 0.071, // The thickness
    color: '#000000' // Fill color
  },
  staticLabels: {
  font: "10px sans-serif",  // Specifies font
  //labels: [0, lable, next_lable, client_activity],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
  
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support

  };
  if(client_activity !='')
  {
    var client_activity = $('#client_activity').val();
    var client_activities = document.getElementById('client_activities'); // your canvas element
    var gauge = new Gauge(client_activities);
    gauge.setOptions(client_activity_opts); // create sexy gauge!
    gauge.maxValue = client_activity; // set max gauge value
    gauge.animationSpeed = 32; // set animation speed (32 is default value)
    gauge.set(50); // set actual value
  }
});
var client_activity = $('#client_activity').val();
var client_activities = document.getElementById('client_activities'); // your canvas element
var gauge = new Gauge(client_activities);
gauge.setOptions(client_activities_opts); // create sexy gauge!
gauge.maxValue = 300; // set max gauge value
gauge.animationSpeed = 32; // set animation speed (32 is default value)
gauge.set(0); // set actual value

/******************************Client Added Gauge *****************************/

var client_added_opts = {
  angle: 0.05, // The span of the gauge arc
  lineWidth: 0.24, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.51, // // Relative to gauge radius
    strokeWidth: 0.071, // The thickness
    color: '#000000' // Fill color
  },
  // staticLabels: {
  // font: "10px sans-serif",  // Specifies font
  // labels: [100, 530, 1000, 2200, 2600, 3000],  // Print labels at these values
  // color: "#000000",  // Optional: Label text color
  // fractionDigits: 0  // Optional: Numerical precision. 0=round off.
  // },
  staticLabels: {
  font: "10px sans-serif",  // Specifies font
  labels: [0, 100, 200, 300],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
    staticZones: [
    {strokeStyle: "#F03E3E", min: 0, max: 100},
    {strokeStyle: "#FFDD00", min: 100, max: 200},
    {strokeStyle: "#30B32D", min: 200, max: 300}
  ],
  
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
};
var client_added = document.getElementById('client_added'); // your canvas element
var gauge = new Gauge(client_added);
gauge.setOptions(client_added_opts); // create sexy gauge!
gauge.maxValue = 300; // set max gauge value
gauge.animationSpeed = 32; // set animation speed (32 is default value)
gauge.set(100); // set actual value

/******************************Candidates Added Gauge *****************************/

var candidate_added_opts = {
  angle: 0.05, // The span of the gauge arc
  lineWidth: 0.24, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.51, // // Relative to gauge radius
    strokeWidth: 0.071, // The thickness
    color: '#000000' // Fill color
  },
  // staticLabels: {
  // font: "10px sans-serif",  // Specifies font
  // labels: [100, 530, 1000, 2200, 2600, 3000],  // Print labels at these values
  // color: "#000000",  // Optional: Label text color
  // fractionDigits: 0  // Optional: Numerical precision. 0=round off.
  // },
  staticLabels: {
  font: "10px sans-serif",  // Specifies font
  labels: [0, 100, 200, 300],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
    staticZones: [
    {strokeStyle: "#F03E3E", min: 0, max: 100},
    {strokeStyle: "#FFDD00", min: 100, max: 200},
    {strokeStyle: "#30B32D", min: 200, max: 300}
  ],
  
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
};
var candidate_added = document.getElementById('candidate_added'); // your canvas element
var gauge = new Gauge(candidate_added);
gauge.setOptions(candidate_added_opts); // create sexy gauge!
gauge.maxValue = 300; // set max gauge value
gauge.animationSpeed = 32; // set animation speed (32 is default value)
gauge.set(150); // set actual value

/******************************Opportunities Added Gauge *****************************/

var opportunity_added_opts = {
  angle: 0.05, // The span of the gauge arc
  lineWidth: 0.24, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.51, // // Relative to gauge radius
    strokeWidth: 0.071, // The thickness
    color: '#000000' // Fill color
  },
  // staticLabels: {
  // font: "10px sans-serif",  // Specifies font
  // labels: [100, 530, 1000, 2200, 2600, 3000],  // Print labels at these values
  // color: "#000000",  // Optional: Label text color
  // fractionDigits: 0  // Optional: Numerical precision. 0=round off.
  // },
  staticLabels: {
  font: "10px sans-serif",  // Specifies font
  labels: [0, 100, 200, 300],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
    staticZones: [
    {strokeStyle: "#F03E3E", min: 0, max: 100},
    {strokeStyle: "#FFDD00", min: 100, max: 200},
    {strokeStyle: "#30B32D", min: 200, max: 300}
  ],
  
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
};
var opportunity_added = document.getElementById('opportunity_added'); // your canvas element
var gauge = new Gauge(opportunity_added);
gauge.setOptions(opportunity_added_opts); // create sexy gauge!
gauge.maxValue = 300; // set max gauge value
gauge.animationSpeed = 32; // set animation speed (32 is default value)
gauge.set(250); // set actual value

});

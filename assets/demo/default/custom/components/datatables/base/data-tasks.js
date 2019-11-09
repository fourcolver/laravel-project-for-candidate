//== Class definition

var DatatableDataLocalDemo = function () {
	//== Private functions

	// demo initializer
	var taskdata;
	var datatable;
	var demo = function () {
		$.ajax({
			url: 'tasks/getAllTasks',
                beforeSend: function() {
                    setTimeout(function() {
                        $(".loader_msg").css('display','none');
                        }, 2000);
                },
                success: function(response) { 
                	// similate 2s delay
                	setTimeout(function() {
                		taskdata = response;
                		loaddatatable(taskdata);
                		console.log(taskdata);
	                    }, 2000);
                }});
		function loaddatatable(constantdata)
		{
            var edit_url = 'tasks/edit';
            var delete_url = 'tasks/delete';
            var view_url = 'tasks/view';
			var dataJSONArray = taskdata;
			console.log(typeof dataJSONArray);
			var datatable = $('.m_datatable').mDatatable({
			// datasource definition
			data: {
				type: 'local',
				source: dataJSONArray,
				pageSize: 10
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
                      <a title="Edit this Task" href="'+edit_url+'/'+row.id+'">'+date+'</a>\
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

		var query = datatable.getDataSourceQuery();

		$('#m_form_status').on('change', function () {
			datatable.search($(this).val(), 'Status');
		}).val(typeof query.Status !== 'undefined' ? query.Status : '');

		$('#m_form_type').on('change', function () {
			datatable.search($(this).val(), 'Type');
		}).val(typeof query.Type !== 'undefined' ? query.Type : '');

		$('#m_form_status, #m_form_type').selectpicker();

	};
}
	return {
		//== Public functions
		init: function () {
			// init dmeo
			demo();
			//handleSignInFormSubmit();
		}
	};
}();

jQuery(document).ready(function () {
	DatatableDataLocalDemo.init();
});
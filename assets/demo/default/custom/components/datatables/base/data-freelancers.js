//== Class definition

var DatatableDataLocalDemo = function () {
	//== Private functions

	// demo initializer
	var contactsdata;
	var datatable;
	var demo = function () {
		$.ajax({
			url: 'user/getAllFreelancers',
                beforeSend: function() {
                    setTimeout(function() {
                        $(".loader_msg").css('display','none');
                        }, 2000);
                },
                success: function(response) { 
                	// similate 2s delay
                	setTimeout(function() {
                		contactsdata = response;
                		loaddatatable(contactsdata);
                		console.log(contactsdata);
	                    }, 2000);
                }});
		function loaddatatable(constantdata)
		{
			var add_url = 'add/skills';
			var edit_url = 'edit/skills';
			var dataJSONArray = contactsdata;
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
                field: "first_name,last_name",
                title: "Kandidaten Name",
                template: function (row) {
                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                if(row.skill_id == null)
                {
                	return '\
                    <div >\
                      <a title="Add Skills" href="'+add_url+'/'+row.id+'">'+row.first_name+'  <span>'+row.last_name+'</span></a>\
                    </div>\
                    ';
                }
                else
                {
                    return '\
                    <div >\
                      <a title="Edit Skills" href="'+edit_url+'/'+row.id+'">'+row.first_name+'  <span>'+row.last_name+'</span></a>\
                    </div>\
                    ';
                }
                }
            },
            {
				field: "email",
				title: "Email ID",
				width: 150
			},
			{
				field: "Mobile",
				title: "Mobile Number",
				width: 150
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
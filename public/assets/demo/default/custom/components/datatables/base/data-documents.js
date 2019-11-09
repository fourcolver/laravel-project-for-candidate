//== Class definition

var DatatableDataLocalDemo = function () {
	//== Private functions

	// demo initializer
	var contactsdata;
	var datatable;
	var demo = function () {
		$.ajax({
			url: 'documents/getAllDocuments',
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
			download_url = '../storage/app/documents';
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
                field: "documents_name",
                title: "Name",
                textAlign: 'center'
            },
            {
                field: "path",
                title: "Download URL",
                textAlign: 'center',
                template: function (row) {
                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                    return '\
                    <div >\
                      <a title="Download Contact" href="'+download_url+'/'+row.documents_name+'" download>Download</span></a>\
                    </div>\
                    ';
                }
            },
            {
                field: "type",
                title: "Type of Documents",
                textAlign: 'center'
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
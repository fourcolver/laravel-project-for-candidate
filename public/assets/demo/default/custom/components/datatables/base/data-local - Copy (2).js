//== Class definition

var DatatableDataLocalDemo = function () {
	//== Private functions

	// demo initializer

	var contactsdata;
	var datatable;
	var demo = function () {
		$.ajax({
			url: 'contacts/getAllContacts',
                success: function(response) { 
                	// similate 2s delay
                	setTimeout(function() {
                		contactsdata = response;
                		loaddatatable(contactsdata);
                		console.log(contactsdata);
	                    }, 5000);
                }});
		function loaddatatable(constantdata)
		{
			var edit_url = 'contacts/edit';
			var delete_url = 'contacts/delete';
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
			}, {
				field: "first_name",
				title: "First Name"
			}, {
				field: "last_name",
				title: "Last Name"
			}, {
				field: "job_title",
				title: "Job Title",
				width: 100
			}, {
				field: "departement",
				title: "Departement",
				responsive: {visible: 'lg'}
			}, {
				field: "manager",
				title: "manager"				
			}, 
			{
				field: "Actions",
				width: 110,
				title: "Actions",
				sortable: false,
				overflow: 'visible',
				template: function (row) {
					var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

					return '\
						  	<div >\
						    	<a href="'+edit_url+'"><i class="la la-edit" title="Edit Contacts"></i></a>\
						    	<a href="'+delete_url+'"><i class="la la-trash" title="Delete Contacts"></i></a>\
						  	</div>\
					';
				}
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

var handleSignInFormSubmit = function() {
        $('#m_login_signin_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
           btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
           alert($('#first_name').val());
           
            form.ajaxSubmit({
            	type : "POST",
                url: 'contacts/new',
                success: function(response, status, xhr, $form) {
                	// similate 2s delay
                	setTimeout(function() {
	                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        if(response =='success')
                        {
	                       window.location.replace('contacts');
                        }
                    }, 5000);
                },
                error: function(data){
                	btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
	        			var errors = data.responseJSON;
	        			$.each(errors, function(key, val){
	        				$('.'+key).show().html(val);
	        				$('.'+key).css('color','red');
	        			});
      				}
            });
        });
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
	$("#addContact").validate({
     	rules: {
    		first_name: {
                required: true,
                minlength: 3
            },
    		middle_name: {
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 3
            },
    		job_title: "required",
    		departement: "required",
    		manager: "required",
    		assistant: "required",
    		phone: {
                required: true,
                minlength: 5
            },
    		home: {
                required: true,
                minlength: 5
            },
    		mobile: {
                required: true,
                minlength: 10
            },
    		other: {
                required: true,
                minlength: 5
            },
    		skype_id: "required",
    		note: "required",
    		address: "required",
    		email_id: "required",
    		state: "required",
    		city: "required",
    		zipcode: "required",
    		country: "required"
		},
		messages: {
        	first_name: {
                required: "Field First Name is required",
                minlength: "Field PostCode must contain at least 3 characters" 
            },
            middle_name: {
                required: "Field Middle Name is required",
                minlength: "Field Middle Name must contain at least 3 characters" 
            },
            last_name: {
                required: "Field Last Name is required",
                minlength: "Field Last Name must contain at least 3 characters" 
            },
            job_title: {
                required: "Field Job Title is required" 
            },
            departement: {
                required: "Field Departement is required" 
            },
            manager: {
                required: "Field Manager is required" 
            },
            assistant: {
                required: "Field Assistant is required" 
            },
            phone: {
                required: "Field Phone Number is required",
                minlength: "Field Middle Name must contain at least 5 characters" 
            },
            home: {
                required: "Field Home Number is required",
                minlength: "Field Middle Name must contain at least 5 characters" 
            },
            mobile: {
                required: "Field Mobile Number is required",
                minlength: "Field Middle Name must contain at least 10 characters" 
            },
            other: {
                required: "Field Other Number is required",
                minlength: "Field Middle Name must contain at least 5 characters" 
            }
    	},
    submitHandler: function (form) {
		handleSignInFormSubmit();
    }
    });
});
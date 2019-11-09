//== Class definition

var DatatableDataLocalDemo = function () {
	//== Private functions

	// demo initializer
	var contactsdata;
	var datatable;
	var demo = function () {
		$.ajax({
			url: 'contacts/getAllContacts',
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
            // var edit_url = 'contacts/edit';
            // var delete_url = 'contacts/delete';
            var view_url = 'contacts/view';
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
                title: "Name",
                template: function (row) {
                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                    return '\
                    <div >\
                      <a title="View this Contact" href="'+view_url+'/'+row.id+'">'+row.first_name+'  <span>'+row.last_name+'</span></a>\
                    </div>\
                    ';
                }
            },
            {
				field: "job_title",
				title: "Job Title",
				width: 100
			},
            {
                field: "departement",
                title: "Departement",
                width: 100
            },
            {
                field: "account_name",
                title: "Kunden Name",
                width: 110
            },
            {
                field: "email_id",
                title: "Email ID",
                width: 200
            },
            {
                field: "mobile",
                title: "Mobile Number",
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
    $("#phone,#mobile,#zipcode").keydown(function (e) {
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
    $('#account_select').click(function(){

    $('#select_account').validate({
            rules: {
            account_name: {
                required: {
                    depends: function(element) {
                        return $("#account_name").val() == '';
                    }
                 }
            }
        },
        invalidHandler: function(f,v) {
            $('#addContact').css('display','none');    
        },
        submitHandler: function (form) {
            $('#addContact').css('display','block');
            var account_id = $("#account_name").val();
            $('#account_id').val(account_id);
            $('#account_name').prop('disabled',true);
            showData(account_id);
        }
    });
    });
	$("#addContact").validate({
     	rules: {
    		first_name: {
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 3
            },
            job_title: {
                required: {
                    depends: function(element) {
                        return $("#job_title").val() == '';
                    }
                 }
            },
            departement: {
                required: {
                    depends: function(element) {
                        return $("#departement").val() == '';
                    }
                 }
            },
    		phone: {
                required: true,
                minlength: 5
            },
    		mobile: {
                required: true,
                minlength: 9
            },
    		email_id: "required",
    		zipcode: "required",
    		country: "required"
		},
		messages: {
        	first_name: {
                required: "Field First Name is required",
                minlength: "Field PostCode must contain at least 3 characters" 
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
            phone: {
                required: "Field Phone Number is required",
                minlength: "Field Middle Name must contain at least 5 characters" 
            },
            mobile: {
                required: "Field Mobile Number is required",
                minlength: "Field Middle Name must contain 10 characters" 
            }
    	},
    submitHandler: function (form) {
        $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
    	$.ajax({
                url: 'contacts/new',
                type: "POST",
                data: $(form).serialize(),
                success: function(response, status, xhr, $form) {
                	setTimeout(function() {
                        $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        if(response =='success')
                        {
	                       window.location.replace('contacts');
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
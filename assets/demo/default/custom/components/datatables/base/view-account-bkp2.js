//== Class definition



var DatatableDataLocalDemo = function () {



	var contact_data;

	var opportunity_data;

	var task_data;

    var comment_data;

	var datatable;

	var id = $('.contact_datatable').attr('data-type');

	var contact_url = '../../../admin/accounts/ContactsDetails';

	var opportunity_url = '../../../admin/accounts/OpportunityDetails';

	var task_url = '../../../admin/accounts/TaskDetails';

    var comment_url = '../../../admin/accounts/CommentsDetails';

    var acc_id = $("#auth_id").val();

	var demo = function () {

    $.ajax({

            url: comment_url+'/'+acc_id+'/'+id,

                 beforeSend: function() {

                    setTimeout(function() {

                        $(".loader").css('display','none');

                        }, 3000);

                },

                success: function(response) { 

                    

                    setTimeout(function() {

                        comment_data = response;

                        commentdatatable(comment_data);

                        console.log(comment_data);

                        }, 2000);

        }});

    function commentdatatable(constantdata)

        {

            var delete_url = 'activity/delete';

            var dataJSONArray = comment_data;

            var datatable = $('.comment_datatable').mDatatable({

            // datasource definition

            data: {

                type: 'local',

                source: dataJSONArray

            },

            // layout definition

            layout: {

                theme: 'default', // datatable theme

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

                title: "S. No.",

                textAlign: 'center'

            },

            {

               field: "timestamp_date",

               title: "Date",

               width:  150

               // template: function (row) {

               //  var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

               //  date = row.timestamp.split(' ')[0];

               //  return '\

               //  <div >\

               //    '+date+'\

               //  </div>\

               //  ';

               //  }

            }, 

            {

               field: "comment",

               title: "Comment",

               width:  200,

            },

            {

                field: "contact_firstname",

                title: "Contact Name",

                template: function (row) {

                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';



                    return '\
                    <div >\
                    <p>' +row.contact_firstname+' '+row.contact_lastname+'</p>\
                    </div>\
                    ';

                }

            },

            {

                field: "user_firstname",

                title: "Recruiter",

                template: function (row) {

                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';



                    return '\
                    <div >\
                      <p>' +row.user_firstname+'</p>\
                    </div>\
                    ';

                },

                responsive: {visible: 'lg'}

            },

            {

                field: "action",

                title: "Action",

                width:50,

                template: function (row) {

                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                    return '\
                    <div >\
                    <a data-id='+row.id+' data-comment="'+row.comment+'" class="comment_edit" data-toggle="modal" data-target="#EditComment"">\
                    <span><i class="fa fa-edit"></i>\
                    </span></a>\
                      <a data-id='+row.id+' class="comment_del pull-right" onclick="deleteComment('+row.id+')">\
                        <span><i class="fa fa-trash-o"></i>\
                    </span></a>\
                    </div>\
                    ';

                }

            }]

        });

    };



	$.ajax({

			url: opportunity_url+'/'+id,

				 beforeSend: function() {

                    setTimeout(function() {

                        $(".loader").css('display','none');

                        }, 3000);

                },

                success: function(response) { 

                    

                	setTimeout(function() {

                		opportunity_data = response;

                		opportunitydatatable(opportunity_data);

                		console.log(opportunity_data);

	                    }, 2000);

        }});

	function opportunitydatatable(constantdata)

		{

            edit_opportunity = '../../opportunity/edit';

			var dataJSONArray = opportunity_data;

			var datatable = $('.opportunity_datatable').mDatatable({

			// datasource definition

			data: {

				type: 'local',

				source: dataJSONArray

			},

			// layout definition

			layout: {

				theme: 'default', // datatable theme

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

                field: "name",

                title: "Opportunity Name",

                width: 135,

                template: function (row) {

                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                if(row.permission.admin=='admin')

                {

                  return '\
                  <a title="Edit Opportunity" href="'+edit_opportunity+'/'+row.id+'">'+row.name+'</a>\
                    ';

                }

                var projektanfrage_permission = row.permission.projektanfrage_permission;

                var projektanfrage_permission = projektanfrage_permission.split(',');

                //alert(task_permission);

                if ($.inArray('edit', projektanfrage_permission)!='-1')

                {

                return '\
                  <a title="Edit Opportunity" href="'+edit_opportunity+'/'+row.id+'">'+row.name+'</a>\
                ';

                }

                else

                {

                  return '\
                  <a title="No Permission For Edit Opportunity">'+row.name+'</a>\
                ';

                }

                }

            },

            {

                field: "probability",

                title: "Probability",

                template: function (row) {

                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';



                    return '\
                    <div >\
                      <p>'+row.probability+' %</p>\
                    </div>\
                    ';

                }

            },

            {

                field: "hotness",

                title: "Hotness of Client",

                width : 130,

                template: function (row) {

                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';



                     return '\
                    <div >\
                      <p>'+row.hotness+' /10</p>\
                    </div>\
                    ';

                }

            },

            {

				field: "client_name",

				title: "Client Name",

				responsive: {visible: 'lg'}

			},

            {

                field: "client_number",

                title: "Client Number",

                responsive: {visible: 'lg'}

            },

            {

                field: "technology",

                title: "Technology",

                responsive: {visible: 'lg'}

            },

            {

                field: "info_field",

                title: "Info Field",

                responsive: {visible: 'lg'}

            },

            {

          field: "opportunity_type",

          title: "Opportunity Type",

          width:130,

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

              

            }

        },

        {

          field: "opportunity_status",

          title: "Opportunity Status",

          width:140,

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

              

            }

        }]

		});



	};

	$.ajax({

			url: task_url+'/'+id,

				 beforeSend: function() {

                    setTimeout(function() {

                        $(".loader").css('display','none');

                        }, 3000);

                },

                success: function(response) { 

                    

                	setTimeout(function() {

                		task_data = response;

                		taskdatatable(task_data);

                		console.log(task_data);

	                    }, 2000);

        }});

	function taskdatatable(constantdata)

		{

			edit_task_url = '../../tasks/edit';

			var dataJSONArray = task_data;

			var datatable = $('.task_datatable').mDatatable({

			// datasource definition

			data: {

				type: 'local',

				source: dataJSONArray

			},

			// layout definition

			layout: {

				theme: 'default', // datatable theme

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

                    if(row.permission.admin=='admin')

                    {

                      return '\
                      <div >\
                        <a title="Edit this Task" href="'+edit_task_url+'/'+row.id+'">'+date+'</a>\
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
                        <a title="Edit this Task" href="'+edit_task_url+'/'+row.id+'">'+date+'</a>\
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

                title: "Kunden Name",

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

    // $('#deleteComment').on("click" , function(){

    //     var id = $('#comment_id').val();

    //     alert(id);

    //     return false;

    //     var account_id = $('#account_id').val();

    //     url = '../deleteComment'

    //         $.ajax({

    //         url: url+'/'+account_id+'/'+id,

    //           success: function(response) { 

    //                 var res = $.parseJSON(response);

    //                 if(res.status == 'error'){

    //                   swal('Error',res.message,'error');

    //                 }else{

    //                   swal('Success',res.message,'success');

    //                   setTimeout(function() {

    //                           window.location.replace('');

    //                   }, 2000);

    //                 }

    //             }});

    //     });



	$("#phone,#mobile,#zipcode,#client_number").keydown(function (e) {

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

	$('#close_date').datetimepicker({

            orientation: "bottom left",

            autoclose: true,

            format: 'yyyy-mm-dd hh:ii',

            minDate: 0

        });

    $('#task_date').datepicker({

            orientation: "bottom left",

            autoclose: true,

            format: 'yyyy-mm-dd',

            minDate: 0

        });

	$('#deleteAccount').click(function(){

		var id = $(this).attr('data-ID');

		url = '../../delete'

      	$.ajax({

        url: url+'/'+id,

        	success: function(response) { 

          		var res = $.parseJSON(response);

                if(res.status == 'error'){

                  swal('Error',res.message,'error');

                }else{

                  swal('Success',res.message,'success');

                  setTimeout(function() {

                          window.location.replace('../../../accounts');

                  }, 3000);

                }

            }});

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

                url: '../../../contacts/new',

                type: "POST",

                data: $(form).serialize(),

                success: function(response, status, xhr, $form) {

                	setTimeout(function() {

                        $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                        if(response =='success')

                        {

	                       window.location.replace('');

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

	$('#m_submit_task').click(function(){

    $('#addTask').validate({

            rules: {

            task_date: "required",

            task_priority: {

                required: {

                    depends: function(element) {

                        return $("#task_priority").val() == '';

                    }

                 }

            },

            task_status: {

                required: {

                    depends: function(element) {

                        return $("#task_status").val() == '';

                    }

                 }

            },

            task_type: {

                required: {

                    depends: function(element) {

                        return $("#task_type").val() == '';

                    }

                 }

            },

            task_owner: {

                required: {

                    depends: function(element) {

                        return $("#task_owner").val() == '';

                    }

                 }

            }

        },

        submitHandler: function (form) {

        	$('#m_submit_task').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            $.ajax({

                url: '../../tasks/new',

                type: "POST",

                data: $(form).serialize(),

                success: function(response, status, xhr, $form) {

                	setTimeout(function() {

                        $('#m_submit_task').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                        if(response =='success')

                        {

	                       window.location.replace('');

                        }

                    }, 5000);

                },

                error: function(data){

                    $('#m_submit_task').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

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

            hotness: {

                required: {

                    depends: function(element) {

                        return $("#hotness").val() == '';

                    }

                 }

            },

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

        $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

    	$.ajax({

                url: '../../opportunity/new',

                type: "POST",

                data: $(form).serialize(),

                success: function(response, status, xhr, $form) {

                	setTimeout(function() {

                        $('#m_login_signin_submit').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                        if(response =='success')

                        {

	                       window.location.replace('');

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
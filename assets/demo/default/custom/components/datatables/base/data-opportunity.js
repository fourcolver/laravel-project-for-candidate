//== Class definition

var DatatableDataLocalDemo = function () {
	//== Private functions

	// demo initializer
	var opportunitydata;
	var datatable;
	var demo = function () {
		$.ajax({
			url: 'opportunity/getAllOpportunity',
                beforeSend: function() {
                    setTimeout(function() {
                        $(".loader_msg").css('display','none');
                        }, 2000);
                },
                success: function(response) { 
                	// similate 2s delay
                	setTimeout(function() {
                		opportunitydata = response;
                		loaddatatable(opportunitydata);
                		//console.log(opportunitydata);
	                    }, 2000);
                }});
		function loaddatatable(constantdata)
		{
            var edit_url = 'opportunity/edit';
            var delete_url = 'opportunity/delete';
            var view_url = 'opportunity/view';
			var dataJSONArray = opportunitydata;
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
                field: "name",
                title: "Opportunity Name",
                width : 135,
                template: function (row) {
                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                    return '\
                      <a title="View this Contact" href="'+edit_url+'/'+row.id+'">'+row.name+'</a>\
                    ';
                }
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
                 width : 135,
                template: function (row) {
                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                     return '\
                      <span>'+row.hotness+' /10</span>\
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
        var quantity_1 = $('#quantity_1').val();
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
            
        }
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
//== Class definition

var FormControls = function () {
    //== Private functions
    
    var addContactForm = function () {
        $( "#addContactForm" ).validate({
            // define validation rules
            rules: {
                first_name: {
                    required: true
                },
                middle_name: {
                    required: true 
                },
                last_name: {
                    required: true
                },
                job_title: {
                    required: true
                },
                departement: {
                    required: true
                },
                manager: {
                    required: true
                },
                assistant: {
                    required: true
                },
                phone: {
                    required: true
                },
                home: {
                    required: true
                },
                mobile: {
                    required: true
                },
                other: {
                    required: true
                },
                address: {
                    required: true
                },
                email: {
                    required: true,
                    email: true 
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                zipcode: {
                    required: true
                },
                country: {
                    required: true
                }
            },
            
            //display error alert on form submit  
            invalidHandler: function(event, validator) {     
                var alert = $('#m_form_1_msg');
                alert.removeClass('m--hide').show();
                mApp.scrollTo(alert, -200);
            },

            submitHandler: function (form) {
                //form[0].submit(); // submit the form
            }
        });       
    }
    return {
        // public functions
        init: function() {
            addContactForm(); 
        }
    };
}();

jQuery(document).ready(function() { 
    alert("Hello");   
    FormControls.init();
});
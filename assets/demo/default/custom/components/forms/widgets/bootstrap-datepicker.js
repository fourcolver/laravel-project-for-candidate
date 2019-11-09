//== Class definition

var BootstrapDatepicker = function () {
    
    //== Private functions
    var demos = function () {
        // minimum setup
        $('#m_datepicker_1, #m_datepicker_1_validate').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        // minimum setup for modal demo
        $('#m_datepicker_1_modal').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        // input group layout 
        $('#m_datepicker_2, #m_datepicker_2_validate').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        // input group layout for modal demo
        $('#m_datepicker_2_modal').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        // enable clear button 
        var currentTime = new Date()

        // returns the month (from 0 to 11)
        var month = currentTime.getMonth() + 1;
        // returns the day of the month (from 1 to 31)
        var day = currentTime.getDate();
        var year = currentTime.getFullYear();
        // returns the year (four digits)

        var counter_end = year+5; 
        var month_end = 12; 
        var _yeardata =[];
        var substr = ["0" +1,"0" +2,"0" +3,"0" +4,"0" +5,"0" +6,"0" +7,"0" +8,"0" +9,10,11,12];
        for(i=1992;i<counter_end;i++){


            for ( var j = 0, l = substr.length;j < l; j++ ) {
                for(k=2;k<15;k++){
                 _yeardata.push(substr[ j ]+'/'+k+'/'+i); 
                }
                 if(substr[ j ]==04 || substr[ j ]==06 || substr[ j ]==09 || substr[ j ]==11){
                    var t=30;
                 }else if(substr[ j ]==02){
                    if((i % 4 == 0) && (i % 100 != 0) || (i % 400 == 0)){
                         var t=29;
                    }else{
                        var t=28; 
                    }
                   
                 }else{
                    var t=31;
                 }
                for(f=16;f<t;f++){
                 _yeardata.push(substr[ j ]+'/'+f+'/'+i); 
                }

            }

           
        }

        $('#m_datepicker_3, #m_datepicker_3_validate').datepicker({
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            },
            datesDisabled:_yeardata,
        });

        // enable clear button for modal demo
        $('#m_datepicker_3_modal').datepicker({
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        // orientation 
        $('#m_datepicker_4_1').datepicker({
            orientation: "top left",
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        $('#m_datepicker_4_2').datepicker({
            orientation: "top right",
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        $('#m_datepicker_4_3').datepicker({
            orientation: "bottom left",
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        $('#m_datepicker_4_4').datepicker({
            orientation: "bottom right",
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        // range picker
        $('#m_datepicker_5').datepicker({
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

         // inline picker
        $('#m_datepicker_6').datepicker({
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });
    }

    return {
        // public functions
        init: function() {
            demos(); 
        }
    };
}();

jQuery(document).ready(function() {    
    BootstrapDatepicker.init();
});
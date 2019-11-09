$(document).ready(function(){

    $('#sales_welcome_switch').click(function(){

        $('.welcome_block').hide(2000);

    });

    function disableBack() { window.history.forward() }

    // window.onload = disableBack();

    window.onpageshow = function(evt) { if (evt.persisted) disableBack() }

});
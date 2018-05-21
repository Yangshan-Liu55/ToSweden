$(document).ready(function()    {

    //Tar fram klickat val av sport i Modal OS-schema i Home.php
    $(document).on('click','.eventsHeader',function() {  
        $('.eventsBody').hide();
        $(this).children().slideDown();
        $(this).trigger('focus')
    });


    $('#menuSselect').toggle(function() {   
       console.log("State One")
    },
    function() {
        console.log("State Two")
    });

});



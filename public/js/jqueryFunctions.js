$(document).ready(function()    {

    //Tar fram klickat val av sport i Modal OS-schema i Home.php
    $(document).on('click','.eventsHeader',function() {  
        $('.eventsBody').hide();
        $(this).children().slideDown();
    });
});
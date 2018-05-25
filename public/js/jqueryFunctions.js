$(document).ready(function()    {

//Tar fram klickat val av sport i Modal OS-schema
 
 $(document).on('click','.eventsHeader',function() {  
    $('.eventsBody').hide();
    $(this).children().slideDown();
    $(this).trigger('focus');
    });

    //Funktion för OS-schemat
    $('.menuSelect').click(function() {
        $('.menuSelect').removeClass("lightblue-bg").removeClass("lightblue-border").removeClass("white-col").removeClass("schedule-row-selected");
        $(this).toggleClass("lightblue-bg").toggleClass("lightblue-border").toggleClass("white-col").toggleClass("schedule-row-selected");
      });
    //Funktion för Recommended
      $('.rekoSelect').click(function() {
        $(this).toggleClass("lightblue-bg").toggleClass("lightblue-border");
      });
});



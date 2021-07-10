$('.keyfindings_check_others').hide();
$(document).ready(function() {
    window.setTimeout(function() {
        $(".alert")
            .fadeTo(1000, 0)
            .slideUp(1000, function() {
                $(this).remove();
            });
    }, 2000);

    $('.keyfindings_check').click(function(){
        $('.keyfindings_check_others').toggle();
        $('.keyfindings_check_others').val("");
    });

});

$('.keyfindings_check_others').hide();
$(document).ready(function() {

    $('.keyfindings_check').click(function(){
        $('.keyfindings_check_others').toggle();
        $('.keyfindings_check_others').val("");
    });

});

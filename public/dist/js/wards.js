$(document).ready(function(){
    window.setTimeout(function() {
        $(".alert")
            .fadeTo(1000, 0)
            .slideUp(1000, function() {
                $(this).remove();
            });
    }, 2000);
    
    $(".dynamic").change(function() {
        var select = $(this).attr("id");
        var value = $(".dynamic option:selected").attr("id");

        var dependent = "state_id";
        url = $(".url").attr("id");

        if (value != "") {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    select: select,
                    value: value,
                    dependent: dependent
                },
                success: function(result) {
                    $("#lga").html(result);
                },
                error: function(err) {
                    console.log(err);
                },
                headers: {
                    "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                }
            });
        }
    });
});

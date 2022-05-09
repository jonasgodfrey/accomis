$(document).ready(function() {
    $(".dynamic").change(function() {
        var value = $(".dynamic option:selected").attr('value');
        $("#cbo").empty();

        if (value != "") {
            $.ajax({
                headers: {
                    "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                },
                url: "/cei_analysis",
                method: "POST",
                data: {
                    value: value
                },
                success: function(data) {
                    if (data != "") {
                        console.log(data);
                        $("#cbo").empty();
                        $("#cbo").removeAttr('disabled');
                        $("#cbo").append('<option style="display:none" value="">Select cbo</option>');
                        $.each(data, function(key, value) {
                            $("#cbo").append('<option value="' + value.email + '">' + value.cbo_name + '</option>');
                        });
                    } else {
                        $("#cbo").append('<option style="display:none" value="">No data found</option>');
                        $("#cbo").attr('disabled');
                    }
                }

            });
        }
    });
});
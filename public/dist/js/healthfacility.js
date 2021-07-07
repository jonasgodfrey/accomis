$(document).ready(function() {
    $("#spo_name").val('Loading...');
    $("#spo_email").val('Loading...');
    $("#cbo_email").val('Loading...');

    window.setTimeout(function() {
        $(".alert")
            .fadeTo(1000, 0)
            .slideUp(1000, function() {
                $(this).remove();
            });
    }, 2000);

    $(".dynamic").change(function() {
        $("#cbo1").html(
            '<option value="">Loading...</option>'
        );
        $("#ward").html(
            '<option value="">Loading...</option>'
        );
        var select = $(this).attr("id");
        var value = $(".dynamic option:selected").attr("id");
        var value2 = $(".dynamic option:selected").val();

        var dependent = "state_id";
        url = '/healthfacilities/fetch';

        if (value != "") {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    select: select,
                    value: value,
                    value2: value2,
                    dependent: dependent
                },
                success: function(result) {
                    $("#lga").html(result.lga);
                    var spo_name = result.spo_name;
                    var spo_email = result.spo_email;

                    if (spo_name == "") {
                        $("#spo_name").val('Spo not available for this state');

                    }else{
                        $("#spo_name").val(spo_name);
                    }
                    if(spo_email == ""){
                        $("#spo_email").val('Spo not available for this state');
                    }
                    else{
                        $("#spo_email").val(spo_email);
                    }
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

    $(".dynamic2").change(function() {

        var select = $(this).attr("id");
        var value = $(".dynamic2 option:selected").attr("id");
        url = '/healthfacilities/cbo/fetch';

        if (value != "") {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    select: select,
                    value: value,
                },
                success: function(result) {

                    console.log(result);
                    var cbo = result.cbo;
                    var ward = result.ward;

                    if (cbo == "") {
                        $("#cbo1").html(
                            '<option value="">Cbo not available for this lga</option>'
                        );
                    }else{
                        $("#cbo1").html(cbo);
                    }
                    if(ward == ""){
                        $("#ward").html(
                            '<option value="">Ward not available for this lga</option>'
                        );
                    }
                    else{
                        $("#ward").html(ward);
                    }

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

    $(".dynamic3").change(function() {
        var value = $(".dynamic3 option:selected").attr("id");

        var dependent1 = "lga";

        if (value != "") {
            $.ajax({
                url: "/cat/fetch",
                method: "POST",
                data: {
                    value: value
                },
                success: function(result) {
                    if (result == "") {
                        $("#cbo1").html(
                            '<option value="">No Data Found</option>'
                        );
                    } else {
                        $("#cbo1").html(result);
                    }
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

    $(".dynamic4").change(function() {
        var value = $(".dynamic4 option:selected").attr("id");

        if (value != "") {
            $.ajax({
                url: "/healthfacilities/fetch_info",
                method: "POST",
                data: {
                    value: value
                },
                success: function(result) {
                    $("#cbo_email").val(result);
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

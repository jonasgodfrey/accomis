
$(document).ready(function() {
    window.setTimeout(function() {
        $(".alert")
            .fadeTo(1000, 0)
            .slideUp(1000, function() {
                $(this).remove();
            });
    }, 2000);

    $(".dynamic").change(function() {
        var select = $(".dynamic option:selected").val();
        var value = $(".dynamic option:selected").attr('id');

        if (value != "") {
            $.ajax({
                url: "/genanalysis",
                method: "POST",
                data: {
                    select: select,
                    value: value
                },
                success: function(result) {
                    var lgas = result.lgas;
                    var wards = result.wards;
                    var health_facilities = result.health_facilities;
                    var spos = result.spos;
                    var cbos = result.cbos;
                    var cats = result.cats;
                    var remidial = result.remidial;
                    var client_exits = result.client_exits;
                    var tested_malaria = result.tested_malaria;
                    var llin_recipients = result.llin_recipients;
                    var act_recipients = result.act_recipients;
                    var ipt_recipients = result.ipt_recipients;
                    var positive_malaria = result.positive_malaria;
                    var sp_recepients = result.sp_recepients;
                    var smc_recepients = result.smc_recepients;
                    var pregnant_women = result.pregnant_women;


                    $('#lga').html(
                        lgas
                    );
                    $('#ward').html(
                        wards
                    );
                    $('#health').html(
                        health_facilities
                    );
                    $('#spos').html(
                        spos
                    );
                    $('#cbos').html(
                        cbos
                    );
                    $('#cats').html(
                        cats
                    );
                    $('#issues_identified').html(
                        'null'
                    );
                    $('#remedial').html(
                        remidial
                    );
                    $('#c').html(
                        lgas
                    );
                    $('#client_exit').html(
                        client_exits
                    );
                    $('#tested_malaria').html(
                        tested_malaria
                    );
                    $('#llin_recepients').html(
                        llin_recipients
                    );
                    swal.fire({
                        title: "Success",
                        text: "data fetched successfully",
                        icon: "success",
                        button: {
                            text: "close"
                        }
                    });
                },
                error: function(err) {
                    swal.fire({
                        title: "Error",
                        text: err.statusText,
                        icon: "error",
                        button: {
                            text: "close"
                        }
                    });
                    console.log(err);
                },
                headers: {
                    "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                }
            });
        }
    });
});

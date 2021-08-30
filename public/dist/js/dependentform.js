$(document).ready(function() {
    // Handler for .ready() called.
        $(".other_occupation2").hide();
        $(".other_education2").hide();
        $(".other_reasons2").hide();
        $(".other_treatment2").hide();
        $(".llin_true").hide();
        $(".llin_others2").hide();
        $(".ipt_true").hide();
        $(".swallow_false").hide();
        $(".other_services").hide();
        $(".malaria_true").hide();
        $(".malaria_test_no_input").hide();
        $(".malaria_false").hide();
        $(".arthemisinin_therapy_true").hide();
        $(".arthemisinin_therapy_false").hide();
        $(".arthemisinin_therapy_show").hide();
        $(".arthemisinin_therapy_show_yes").hide();
        $(".arthemisinin_therapy_show_no").hide();
        $(".other_causes").hide();
        $(".choice_cause").hide();
        $(".swallow_sp_sulfadoxin").hide();


        //for occupation element
        $('#occupation select[name="occupation"]').change(function() {
            if (
                $(
                    '#occupation select[name="occupation"] option:selected'
                ).val() == ""
            ) {
                $(".other_occupation2").show();
            } else {
                $(".other_occupation2").hide();
                $(".field1").val("");
            }
        });

        //for education element
        $('#education select[name="educational_bg"]').change(function() {
            if (
                $(
                    '#education select[name="educational_bg"] option:selected'
                ).val() == ""
            ) {
                $(".other_education2").show();
            } else {
                $(".other_education2").hide();
                $(".field2").val("");
            }
        });

        //for education element
        $('#what_did_you_come_for select[name="what_did_you_come_for"]').change(
            function() {
                if (
                    $(
                        '#what_did_you_come_for select[name="what_did_you_come_for"] option:selected'
                    ).val() == ""
                ) {
                    $(".other_reasons2").show();
                } else {
                    $(".other_reasons2").hide();
                    $(".field3").val("");
                }
            }
        );

        //for education element
        $(
            '#what_treatment_did_you_recieve select[name="what_treatment_did_you_recieve"]'
        ).change(function() {
            if (
                $(
                    '#what_treatment_did_you_recieve select[name="what_treatment_did_you_recieve"] option:selected'
                ).val() == ""
            ) {
                $(".other_treatment2").show();
            } else {
                $(".other_treatment2").hide();
                $(".field4").val("");
            }
        });

        //recieve_llin section
        $(".llin_recieve_yes").click(function() {
            $(".llin_true").show();
        });
        $(".llin_recieve_no").click(function() {
            $(".llin_true").hide();
        });

        $(".llin_recieve_location").on("change", function() {
            if ($(".llin_recieve_location option:selected").val() == "") {
                $(".llin_others2").show();
            } else {
                $(".field5").val("");
                $(".llin_others2").hide();
            }
        });

        //ipt section
        $(".ipt_recieve_yes").click(function() {
            $(".ipt_true").show();
            $(".swallow_sp_sulfadoxin").show();
        });
        $(".ipt_recieve_no").click(function() {
            $(".ipt_true").hide();
            $(".swallow_sp_sulfadoxin").hide();
        });

        //sp_swallow section
        $(".sp_swallow_yes").click(function() {
            $(".swallow_false").hide();
        });
        $(".sp_swallow_no").click(function() {
            $(".swallow_false").show();
        });
        $('.swallow_false select[name="services"]').change(function() {
            if (
                $(
                    '.swallow_false select[name="services"] option:selected'
                ).val() == ""
            ) {
                $(".other_services").show();
            } else {
                $(".other_services").hide();
                $(".field6").val("");
            }
        });

        //smc section
        $(".smc1").click(function() {
            $(".malaria_true").show();
        });
        $(".smc2").click(function() {
            $(".smc_reception_age").val("selectedIndex", 0);
            $(".malaria_true").hide();
        });

        //malaria_test section
        $(".malaria_test_yes").click(function() {
            $(".malaria_test_no_input").hide();
            $(".malaria_false").show();
            $(".field7").val("");
        });
        $(".malaria_test_no").click(function() {
            $(".malaria_test_period").prop("selectedIndex", 0);
            $(".malaria_test_no_input").show();
            $(".malaria_false").hide();
        });
        $(".malaria_test_not_sure").click(function() {
            $(".malaria_test_no_input").hide();
            $(".malaria_false").hide();
            $(".field7").val("");
        });

        //malaria_test section
        $(".arthemisinin_yes").click(function() {
            $(".arthemisinin_therapy_true").show();
            $(".arthemisinin_therapy_false").hide();
        });
        $(".arthemisinin_no").click(function() {
            $(".arthemisinin_therapy_true").hide();
            $(".arthemisinin_therapy_false").show();
            $(".arthemisinin_therapy_show").hide();
        });

        //arthemisinin_therapy section
        $(".arthemisinin_yes").click(function() {
            $(".arthemisinin_therapy_true").show();
            $(".arthemisinin_therapy_false").hide();
            $(".field200").val("");
        });
        $(".arthemisinin_no").click(function() {
            $(".arthemisinin_therapy_true").hide();
            $(".arthemisinin_therapy_false").show();
            $(".field8").val("");
            $(".field9").val("");
        });
        //arthemisinin_therapy section2
        $(".arthemisinin_drug_finish_yes").click(function() {
            $(".arthemisinin_therapy_show").show();
            $(".arthemisinin_therapy_show_yes").show();
            $(".arthemisinin_therapy_show_no").hide();
            $(".field9").val("");
        });
        $(".arthemisinin_drug_finish_no").click(function() {
            $(".field8").val("");
            $(".arthemisinin_therapy_show").show();
            $(".arthemisinin_therapy_show_no").show();
            $(".arthemisinin_therapy_show_yes").hide();
        });

        $('.satisfaction_level select[name="satisfaction_level"]').change(
            function() {
                $(".choice_cause").show();
            }
        );

        $('.choice_cause select[name="insatisfaction_cause"]').change(
            function() {
                if (
                    $(
                        '.choice_cause select[name="insatisfaction_cause"] option:selected'
                    ).val() == ""
                ) {
                    $(".other_causes").show();
                } else {
                    $(".other_causes").hide();
                    $(".field10").val("");
                }
            }
        );

        //form data collection
        var res_name = "";
        $(".res_name").on("input", function() {
            res_name = $(this).val();
        });

        var child_name = $(".child_name").val();
        $(".child_name").on("input", function() {
            child_name = $(this).val();
        });

        var res_category = "";
        $(".res_category").on("change", function() {
            res_category = $(".res_category option:selected").val();
        });

        var address = "";
        $(".address").on("input", function() {
            address = $(this).val();
        });

        var phone_no = "";
        $(".phone_no").on("input", function() {
            phone_no = $(this).val();
        });

        var health_facility_of_interview = "";
        $(".health_facility_of_interview").on("change", function() {
            health_facility_of_interview = $(".health_facility_of_interview option:selected").val();
        });

        //occupation
        var occupation = "";
        $(".occupation").on("change", function() {
            occupation = $(".occupation option:selected").val();
        });

        //conditional statement
        $(".other_occupation").on("input", function() {
            occupation = $(this).val();
        });

        //educational_bg
        var educational_bg = "";
        $(".education").on("change", function() {
            educational_bg = $(".education option:selected").val();
        });

        $(".educational_bg2").on("input", function() {
            educational_bg = $(this).val();
        });

        //quarter of the year
        var quarter = "";
        $(".quarter").on("change", function() {
            quarter = $(".quarter option:selected").val();
        });

        //what_did_you_come_for
        var what_did_you_come_for = "";
        $(".what_did_you_come_for").on("change", function() {
            what_did_you_come_for = $(
                ".what_did_you_come_for option:selected"
            ).val();
        });

        $(".what_did_you_come_for2").on("input", function() {
            what_did_you_come_for = $(this).val();
        });

        //what_treatment_did_you_recieve
        var what_treatment_did_you_recieve = "";
        $(".what_treatment_did_you_recieve").on("change", function() {
            what_treatment_did_you_recieve = $(
                ".what_treatment_did_you_recieve option:selected"
            ).val();
        });

        //conditional statement
        $(".what_treatment_did_you_recieve2").on("input", function() {
            what_treatment_did_you_recieve = $(this).val();
        });

        //frequency_of_visit
        var frequency_of_visit = "";
        $(".frequency_of_visit").on("change", function() {
            frequency_of_visit = $(".frequency_of_visit option:selected").val();
        });

        //llin_recieve
        var recieve_llin = "";
        $('#llin_recieve input[name="recieve_llin"]').change(function() {
            recieve_llin = $(
                '#llin_recieve input[name="recieve_llin"]:checked'
            ).val();
        });
        var llin_recieve_location = "not applicable";
        var llin_frequency = "not applicable";

        $(".llin_recieve_location").on("change", function() {
            llin_recieve_location = $(
                ".llin_recieve_location option:selected"
            ).val();
        });

        $(".llin_frequency").on("change", function() {
            llin_frequency = $(".llin_frequency option:selected").val();
        });

        var sleep_in_llin = "not applicable";
        $(".sleep_in_llin").on("change", function() {
            sleep_in_llin = $(".sleep_in_llin option:selected").val();
        });

        var sleep_in_llin_interval = "not applicable";
        $(".sleep_in_llin_interval").on("change", function() {
            sleep_in_llin_interval = $(".sleep_in_llin_interval option:selected").val();
        });

        var reason_for_not_sleeping_in_llin = "not applicable";
        $(".reason_for_not_sleeping_in_llin").on("change", function() {
            reason_for_not_sleeping_in_llin = $(".reason_for_not_sleeping_in_llin option:selected").val();
        });


        //ipt
        var recieve_ipt = "";

        $('#recieve_ipt input[name="recieve_ipt"]').change(function() {
            recieve_ipt = $(
                '#recieve_ipt input[name="recieve_ipt"]:checked'
            ).val();
        });

        var ipt_frequency = "not applicable";

        $(".ipt_frequency").on("change", function() {
            ipt_frequency = $(".ipt_frequency option:selected").val();
        });

        //swallow_sp_sulfadoxin
        var swallow_sp_sulfadoxin = "not applicable";
        $('#swallow_sp_sulfadoxin input[name="swallow_sp_sulfadoxin"]').change(
            function() {
                swallow_sp_sulfadoxin = $(
                    '#swallow_sp_sulfadoxin input[name="swallow_sp_sulfadoxin"]:checked'
                ).val();
            }
        );

        var services = "not applicable";

        $(".services").on("change", function() {
            services = $(".services option:selected").val();
        });

        $(".services2").on("input", function() {
            services = $(this).val();
        });

        //smc
        var smc = "";

        $('#smc input[name="smc"]').change(function() {
            smc = $('#smc input[name="smc"]:checked').val();
        });

        var smc_reception_age = "not applicable";

        $(".smc_reception_age").on("change", function() {
            smc_reception_age = $(".smc_reception_age option:selected").val();
        });

        //malaria_test
        var malaria_test = "";
        var malaria_reason = "not applicable";
        var malaria_test_period = "not applicable";

        $('#malaria_test input[name="malaria_test"]').change(function() {
            malaria_test = $(
                '#malaria_test input[name="malaria_test"]:checked'
            ).val();
        });

        $(".malaria_reason").on("input", function() {
            malaria_reason = $(this).val();
        });

        $(".malaria_test_period").on("change", function() {
            malaria_test_period = $(
                ".malaria_test_period option:selected"
            ).val();
        });

        //arthemisinin_based_therapy
        var arthemisinin_based_therapy = "";

        var arthemisinin_therapy_false = "not applicable";
        var arthemisinin_drug_finish = "not applicable";
        var abc_input_details = "not applicable";

        $(
            '#arthemisinin_based_therapy input[name="arthemisinin_based_therapy"]'
        ).change(function() {
            arthemisinin_based_therapy = $(
                '#arthemisinin_based_therapy input[name="arthemisinin_based_therapy"]:checked'
            ).val();
        });

        $(".field200").on("input", function() {
            arthemisinin_therapy_false = $(this).val();
        });

        $(
            '#arthemisinin_drug_finish input[name="arthemisinin_drug_finish"]'
        ).change(function() {
            arthemisinin_drug_finish = $(
                '#arthemisinin_drug_finish input[name="arthemisinin_drug_finish"]:checked'
            ).val();
        });

        $(".arthemisinin_therapy_show_yes").on("input", function() {
            abc_input_details = $(this).val();
        });

        $(".arthemisinin_therapy_show_no").on("input", function() {
            abc_input_details = $(this).val();
        });

        //satisfaction_level
        var satisfaction_level = "";

        $(".satisfaction_level").on("change", function() {
            satisfaction_level = $(".satisfaction_level option:selected").val();
        });

        var insatisfaction_cause = "";

        $(".insatisfaction_cause").on("change", function() {
            insatisfaction_cause = $(
                ".insatisfaction_cause option:selected"
            ).val();
        });

        $(".insatisfaction_cause_others2").on("input", function() {
            insatisfaction_cause = $(this).val();
        });

        //feedback
        var customer_help = "";

        $(".customer_help").on("input", function() {
            customer_help = $(this).val();
        });

        var customer_help_improve = "";

        $(".customer_help_improve").on("input", function() {
            customer_help_improve = $(this).val();
        });
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        $("#submit_form").click(function() {

            var fd = new FormData();
            var uploader = $('#report_file[type="file"]');
            $.each(uploader.files, function() {
                fd.append('file[]', this);
              });
            // Get the selected file

            fd.append('_token',CSRF_TOKEN);
            fd.append('res_name', res_name);
            fd.append('child_name', child_name);
            fd.append('res_category', res_category);
            fd.append('address', address);
            fd.append('phone_no', phone_no);
            fd.append('health_facility_of_interview', health_facility_of_interview);
            fd.append('occupation', occupation);
            fd.append('educational_bg', educational_bg);
            fd.append('quarter', quarter);
            fd.append('what_did_you_come_for', what_did_you_come_for);
            fd.append('what_treatment_did_you_recieve', what_treatment_did_you_recieve);
            fd.append('frequency_of_visit', frequency_of_visit);
            fd.append('recieve_llin', recieve_llin);
            fd.append('llin_recieve_location', llin_recieve_location);
            fd.append('llin_frequency', llin_frequency);
            fd.append('sleep_in_llin',sleep_in_llin);
            fd.append('sleep_in_llin_interval',sleep_in_llin_interval);
            fd.append('reason_for_not_sleeping_in_llin',reason_for_not_sleeping_in_llin);
            fd.append('recieve_ipt', recieve_ipt);
            fd.append('ipt_frequency', ipt_frequency);
            fd.append('swallow_sp_sulfadoxin', swallow_sp_sulfadoxin);
            fd.append('services', services);
            fd.append('smc', smc);
            fd.append('smc_reception_age', smc_reception_age);
            fd.append('malaria_test', malaria_test);
            fd.append('malaria_reason', malaria_reason);
            fd.append('malaria_test_period', malaria_test_period);
            fd.append('arthemisinin_based_therapy', arthemisinin_based_therapy);
            fd.append('arthemisinin_therapy_false', arthemisinin_therapy_false);
            fd.append('arthemisinin_drug_finish', arthemisinin_drug_finish);
            fd.append('abc_input_details', abc_input_details);
            fd.append('satisfaction_level', satisfaction_level);
            fd.append('insatisfaction_cause', insatisfaction_cause);
            fd.append('customer_help', customer_help);
            fd.append('customer_help_improve', customer_help_improve);

            //heavy validation
            var validate = [
                uploader,
                res_name,
                child_name,
                res_category,
                address,
                phone_no,
                health_facility_of_interview,
                occupation,
                educational_bg,
                what_did_you_come_for,
                what_treatment_did_you_recieve,
                frequency_of_visit,
                recieve_llin,
                recieve_ipt,
                smc,
                malaria_test,
                arthemisinin_based_therapy,
                satisfaction_level,
                insatisfaction_cause,
                customer_help,
                customer_help_improve
            ];


            if (validate.includes("")) {
                swal.fire({
                    title: "Error",
                    text: "Please fill all required fields",
                    icon: "warning",
                    button: {
                        text: "close"
                    }
                });
            } else {
                submitData();
            }


            function submitData() {
                $.ajax({
                    url: "/clientexit/",
                    method: "post",
                    contentType: false,
                    processData: false,
                    data: fd,
                    success: function(response) {
                        swal.fire({
                            title: "Success",
                            text: "Client exit data added successfully",
                            icon: "success",
                            button: {
                                text: "close"
                            }
                        });
                        setInterval("location.reload()", 3000);
                    },
                    error: function(err) {
                        console.log(err);
                        swal.fire({
                            title: "Error",
                            text: err.statusText,
                            icon: "error",
                            button: {
                                text: "close"
                            }
                        });
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr(
                            "content"
                        )
                    }
                });

            }
        });

});

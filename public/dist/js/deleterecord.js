$(".checkBoxClass").click(function() {

    if ($(".checkBoxClass:checked").length > 0) {
        $("#bulk-delete").show();
    } else {
        $("#bulk-delete").hide();
    }

});
$(function(e) {

    console.log('page loaded');

    $("#selectall").click(function() {
        if ($("#selectall").is(':checked')) {
            $("input[type=checkbox]").each(function() {
                $(this).attr("checked", true);
            });
            $("#bulk-delete").show();

        } else {
            $("input[type=checkbox]").each(function() {
                $(this).attr("checked", false);
            });
            $("#bulk-delete").hide();
        }
    });




    $("#bulk-delete").click(function() {

        $('#modal-sm').modal('show');

        $('.delete_record').click(function() {
            var allids = [];
            $("input:checkbox[name=ids]:checked").each(function() {
                allids.push($(this).val());
            });


            page = $('.page_name').text();

            console.log(page);


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: page,
                type: "post",
                data: {
                    ids: allids
                },

                success: function(response) {

                    $('#modal-sm').modal('hide');
                    $("input[type=checkbox]").each(function() {
                        $(this).attr("checked", false);
                    });

                    Swal.fire({
                        title: 'Success',
                        text: response,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })

                    location.reload(3000);

                }


            });
        })


    });



});
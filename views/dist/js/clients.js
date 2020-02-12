
$(".btnEditClient").click(function () {
    var clientId = $(this).attr("clientId");

    var _data = new FormData();
    _data.append("clientId", clientId);

    $.ajax({
        url: 'ajax/clients.ajax.php',
        method: 'POST',
        data: _data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (response) {
            console.log("response", response);

            $('#clientId').val(response['id']);
            $('#e_name').val(response['name']);
            $('#e_document_id').val(response['document_id']);
            $('#e_email').val(response['email']);
            $('#e_phone').val(response['phone']);
            $('#e_address').val(response['address']);
            $('#e_date_of_birth').val(response['date_of_birth']);

        }

    });


});


/**
 * :: DELETE CLIENT
 */

$(".btnDeleteClient").click(function () {
   var clientId = $(this).attr("clientId");
   console.log("clientId", clientId);

    Swal.fire({
        title: 'Are you sure you want to delete this client',
        text: 'If you are not sure you can cancel the action',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Ok'
    }).then(result => {
        if (result.value) {
            window.location = "index.php?route=clients&clientId="+clientId;
        }
    });
});


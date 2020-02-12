/**
 * :: EDIT CATEGORY
 */

$(".btnEditCategory").click(function () {

    var categoryId = $(this).attr("categoryId");
    var _data = new FormData();
    _data.append("categoryId", categoryId);

    $.ajax({
        url: 'ajax/categories.ajax.php',
        method: 'POST',
        data: _data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (response) {
            $("#e_category_name").val(response["name"]);
            $("#e_category_id").val(response["id"]);
            console.log("response", response);
        }

    });
});


/**
 * :: DELETE CATEGORY
 */

$(".btnDeleteCategory").click(function () {

    var categoryId = $(this).attr("categoryId");

    Swal.fire({
       title: 'Are you sure you want to delete this category',
        text: 'If you are not sure you can cancel teh action',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Ok'
    }).then(result => {
       if (result.value) {
           window.location = "index.php?route=categories&categoryId="+categoryId;
       }
    });

});














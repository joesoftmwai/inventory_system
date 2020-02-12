$.ajax({
    url: "ajax/datatable-products.ajax.php",
    success: function (response) {
        // console.log("response", response);
    }
});



var hiddenProfile = $("#hiddeProfile").val();

$('._product_tables').DataTable({
    "ajax": "ajax/datatable-products.ajax.php?hiddenProfile="+hiddenProfile,

    // properties to optimise loading process
    "deferRender": true,
    "retrieve": true,
    "processing": true

});

$("#newCategory").change(function () {
    var category_id = $(this).val();

    var _data = new FormData();
    _data.append("category_id", category_id);

    $.ajax({
        url: "ajax/products.ajax.php",
        method: "POST",
        data: _data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {

            if (!response) {
                var newCode = category_id + "01";
                $("#code").val(newCode);
            } else {
                var newCode = Number(response["code"]) + 1;
                $("#code").val(newCode);
            }
        }
    });
});

/**
 * :: ADDING SELLING PRICE
 */

$("#buying_price, #e_buying_price").change(function () {

    if ($(".percentage").prop("checked")) {
        var percentage = $(".new_percentage").val();
        var buying_price = $("#buying_price").val();
        var profit = buying_price * percentage / 100;
        var selling_price = Number(buying_price) + profit;

        $("#selling_price").val(selling_price);
        $("#selling_price").prop("readonly", true);

        var e_buying_price = $("#e_buying_price").val();
        var e_profit = e_buying_price * percentage / 100;
        var e_selling_price = Number(e_buying_price) + e_profit;

        $("#e_selling_price").val(e_selling_price);
        $("#e_selling_price").prop("readonly", true);

    }
});

/**
 * ::PERCENTAGE CHANGE
 */

$(".new_percentage").change(function () {

    if ($(".percentage").prop("checked")) {
        var percentage = $(".new_percentage").val();
        var buying_price = $("#buying_price").val();
        var profit = buying_price * percentage / 100;
        var selling_price = Number(buying_price) + profit;

        $("#selling_price").val(selling_price);
        $("#selling_price").prop("readonly", true);

        var e_buying_price = $("#e_buying_price").val();
        var e_profit = e_buying_price * percentage / 100;
        var e_selling_price = Number(e_buying_price) + profit;

        $("#e_selling_price").val(e_selling_price);
        $("#e_selling_price").prop("readonly", true);




    }
});

/**
 * :: CHECKS IF CHECK BOX IS CHECKED
 */
// executes if unchecked
$(".percentage").on("ifUnchecked", function () {
    $("#selling_price").prop("readonly", false);
    $("#e_selling_price").prop("readonly", false);
});

// executes if checked
$(".percentage").on("ifChecked", function () {
    $("#selling_price").prop("readonly", true);
    $("#e_selling_price").prop("readonly", true);
});


/**
 * :: UPLOADING PRODUCT IMAGE
 */

$(".new_image").change(function () {
    var img = this.files[0];
    console.log("img", img);

    /**
     * Validation
     */

    if (img["type"] != "image/jpeg" && img["type"] != "image/png") {
        $(".new_image").val("");
        Swal.fire({
            title: 'Error uploading image',
            text: 'Image must be in JPEG or PNG format',
            type: 'error',
            confirmButtonText: 'close'
        });
    } else if (img["size"] > 2000000) {
        $(".new_image").val("");
        Swal.fire({
            title: 'Error uploading image',
            text: 'Image file must be less than 2MB',
            type: 'error',
            confirmButtonText: 'close'
        });
    } else {
        var image_data = new FileReader;
        image_data.readAsDataURL(img);

        $(image_data).on("load", function (event) {
            var image_route = event.target.result;
            $(".preview").attr("src", image_route);
        });

    }
});


/**
 * :: EDIT PRODUCT
 */


$("._product_tables tbody").on("click", "button.btnEditProduct", function() {
    var productId = $(this).attr("productId");

    var _data = new FormData();
    _data.append("productId", productId);

    $.ajax({
        url: 'ajax/products.ajax.php',
        method: 'POST',
        data: _data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (response) {
            var _data_categories = new FormData();
            _data_categories.append("categoryId", response['category_id']);
            
            $.ajax({
                url: 'ajax/categories.ajax.php',
                method: 'POST',
                data: _data_categories,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    console.log("response", response);
                    $("#e_category").val(response['id']);
                    $("#e_category").html(response['name']);
                }
            });

            console.log("response", response);

            $("#e_code").val(response['code']);
            $("#e_description").val(response['description']);
            $("#e_stock").val(response['stock']);
            $("#e_buying_price").val(response['buying_price']);
            $("#e_selling_price").val(response['selling_price']);

            if (response['image'] != "") {
                $('.preview').attr("src", response['image']);
            } else {
                var default_pic = "views/img/products/default/anonymous.png";
                $(".preview").attr("src", default_pic);
            }

            $("#existing_image").val(response['image']);


        }
    });

});


/**
 * :: DELETE PRODUCT
 */


$("._product_tables tbody").on("click", "button.btnDeleteProduct", function() {
    var productId = $(this).attr("productId");
    var code= $(this).attr("code");
    var image = $(this).attr("image");

    Swal.fire({
       title: 'Are you sure you want to delete the product',
       text: 'If you are not sure you can cancel the action',
       type: 'warning',
       showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText : 'Ok'

    }).then((result) => {
        if (result.value) {
            window.location = "index.php?route=products&productId="+productId+"&code="+code+"&image=" + image;
        }
    });




});











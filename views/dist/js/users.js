$(".new_picture").change(function () {
    var img = this.files[0];
    console.log("img", img);

    /**
     * Validation
     */

    if (img["type"] != "image/jpeg" && img["type"] != "image/png") {
        $(".new_picture").val("");
        Swal.fire({
            title: 'Error uploading image',
            text: 'Image must be in JPEG or PNG format',
            type: 'error',
            confirmButtonText: 'close'
        });
    } else if (img["size"] > 2000000) {
        $(".new_picture").val("");
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
 *:: EDIT USER
 */

$(".btnEditUsers").click(function () {
    var userId = $(this).attr("userId");

    // doing some little fetching using AJAX
    var _data = new FormData;
    _data.append("userId", userId);

    $.ajax({
        url: "ajax/users.ajax.php",
        method: "POST",
        data: _data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            //console.log("response", response);
            $("#e_name").val(response["name"]);
            $("#e_username").val(response["username"]);
            $("#e_profile").val(response["profile"]);

            if (response["picture"] != "") {
                $(".preview").attr("src", response["picture"]);
            } else {
                var default_pic = "views/img/users/default/anonymous.png";
                $(".preview").attr("src", default_pic);
            }

            $("#current_password").val(response["password"]);
            $("#current_picture").val(response["picture"]);

        }
    });


});


/**
 *:: ACTIVATE USER
 */

$(".btn_activate").click(function () {
    var userId = $(this).attr("userId");
    var userStatus = $(this).attr("userStatus");

    var _data = new FormData();
    _data.append("activateId", userId);
    _data.append("activateUser", userStatus);

    $.ajax({
        url: "ajax/users.ajax.php",
        method: "POST",
        data: _data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {

        }
    });

    if (userStatus == 0) {
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).html("Deactivated");
        $(this).attr("userStatus", 1);
    } else {
        $(this).addClass("btn-success");
        $(this).removeClass("btn-danger");
        $(this).html("Activated");
        $(this).attr("userStatus", 0);

    }
});

/**
 *:: CHECK IF USER IS REGISTERED
 */

$("#username").change(function () {
    $(".error").remove();
    var username = $(this).val();

    var _data = new FormData();
    _data.append("validateUser", username);

    $.ajax({
        url: "ajax/users.ajax.php",
        method: "POST",
        data: _data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            console.log("response", response);
            if (response) {
                $("#username").parent().after("<p class='bg-danger error'>User Already Exists</p>");
                $("#username").val("");
            }
        }
    });
});

/**
 *:: DELETE USER
 */

$(".btnDeleteUsers").click(function () {

    var userId = $(this).attr("userId");
    var userPicture = $(this).attr("userPicture");
    var user = $(this).attr("user");

    Swal.fire({
        title: 'Are you sure you want to delete this user',
        text: 'If you are not sure you can cancel the action',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?route=users&userId="+userId+"&user="+user+"&userPicture=" + userPicture;
        }
    });


});

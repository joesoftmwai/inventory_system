<?php

class UserController
{
    public function ctrUserLogin()
    {
        if (isset($_POST['username'])) {
            if (preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['username'])
                && preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['password'])) {

                $encryptedPass = crypt($_POST['password'], '$2a$07$usesomesillystringforsalt$');

                $table = "test";
                $item = "username";
                $value = $_POST['username'];
                $response = UserModel::mdlShowUsers($table, $item, $value);

                if ($response["username"] == $_POST["username"] && $response["password"] == $encryptedPass) {
                    if ($response["status"] == 1) {
                        $_SESSION["beginSession"] = "ok";
                        $_SESSION["id"] = $response["id"];
                        $_SESSION["name"] = $response["name"];
                        $_SESSION["username"] = $response["username"];
                        $_SESSION["picture"] = $response["picture"];
                        $_SESSION["profile"] = $response["profile"];

                        /**
                         * :: REGISTER THE DATE TO KNOW THE LAST LOGIN
                         */

                        
                        header("Location:home");

                        date_default_timezone_set("Africa/Nairobi");
                        $date = date('Y-m-d');
                        $hour = date ("H:i:s");
                        $full_date = $date.' '.$hour;

                        $item1 = "last_login";
                        $value1 = $full_date;

                        $item2 = "id";
                        $value2 = $response["id"];

                        $last_login = UserModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);

                        if ($last_login == "ok") {
                            header("Location:home");
                        }

                    } else {
                        echo "<br><div class='alert alert-danger'>User is not activated</div>";
                    }

                } else {
                    echo "<br><div class='alert alert-danger'>Error occurred, Please try again</div>";
                }

            }
        }

    }

    public function ctrCreateUser()
    {
        if (isset($_POST["submit"])) {
           
            if (preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['name'])
                && preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['username'])
                && preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['password'])
                && preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['username'])) {

                $route = "";
                if (isset($_FILES["picture"]["tmp_name"])) {

                    var_dump('jkdshcjk');

                    list($width, $height) = getimagesize($_FILES["picture"]["tmp_name"]);
                    $new_width = 50;
                    $new_height = 50;

                    $directory = "views/img/users/" . $_POST['username'];
                    mkdir($directory, 0777);

                    if ($_FILES["picture"]["type"] == "image/jpeg") {
                        $rand = mt_rand(100, 999);
                        $route = "views/img/users/" . $_POST['username'] . "/" . $rand . ".jpg";

                        $source = imagecreatefromjpeg($_FILES["picture"]["tmp_name"]);
                        $destiny = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destiny, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagejpeg($destiny, $route);
                    }

                    if ($_FILES["picture"]["type"] == "image/png") {
                        $rand = mt_rand(100, 999);
                        $route = "views/img/users/" . $_POST['username'] . "/" . $rand . ".png";

                        $source = imagecreatefrompng($_FILES["picture"]["tmp_name"]);
                        $destiny = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destiny, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagepng($destiny, $route);
                    }
                }

                $table = "test";
                $encryptedPass = crypt($_POST['password'], '$2a$07$usesomesillystringforsalt$');
                $data = array("name" => $_POST['name'],
                    "username" => $_POST['username'],
                    "password" => $encryptedPass,
                    "profile" => $_POST['profile'],
                    "picture" => $route,
                    "status" => 0
                    );
                $response = UserModel::mdlCreateUser($table, $data);

                if ($response != "error") {
                    echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'User saved successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'users'
                           }
                        });

                </script>";
                }

            } else {
                echo "<script>
                    Swal.fire({
                        type: 'error',
                        title: 'Error occurred while processing your details Please try again',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'users'
                           }
                        });

                </script>";
            }
        }
    }


    public function ctrShowUsers($item, $value)
    {

        $table = "test";
        $response = UserModel::mdlShowUsers($table, $item, $value);

        return $response;
    }

    /**
     * :: EDIT USERS
     */
    public function ctrEditUser()
    {
        if (isset($_POST['e_submit'])) {
            if (preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['e_name'])
                && preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['e_profile'])) {

                $route = $_POST["current_picture"];

                if (isset($_FILES["e_picture"]["tmp_name"]) && !empty($_FILES["e_picture"]["tmp_name"])) {
                    list($width, $height) = getimagesize($_FILES["e_picture"]["tmp_name"]);
                    $new_width = 50;
                    $new_height = 50;

                    $directory = "views/img/users/" . $_POST['e_username'];

                    if (!empty($_POST["current_picture"])) {
                        unlink($_POST["current_picture"]);
                    } else {
                        mkdir($directory, 0777);
                    }


                    if ($_FILES["e_picture"]["type"] == "image/jpeg") {
                        $rand = mt_rand(100, 999);
                        $route = "views/img/users/" . $_POST['e_username'] . "/" . $rand . ".jpg";

                        $source = imagecreatefromjpeg($_FILES["e_picture"]["tmp_name"]);
                        $destiny = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destiny, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagejpeg($destiny, $route);

                    }

                    if ($_FILES["e_picture"]["type"] == "image/png") {
                        $rand = mt_rand(100, 999);
                        $route = "views/img/users/" . $_POST['e_username'] . "/" . $rand . ".png";

                        $source = imagecreatefrompng($_FILES["e_picture"]["tmp_name"]);
                        $destiny = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destiny, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagepng($destiny, $route);
                    }
                }


                $table = "test";

                if ($_POST["e_password"] != "") {
                    if (preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['e_password'])) {
                        $encryptedPass = crypt($_POST['e_password'], '$2a$07$usesomesillystringforsalt$');
                    } else {
                        echo "<script>
                        Swal.fire({
                            type: 'error',
                            title: 'Error occurred while processing password field',
                            showConfirmButton: true,
                            confirmButtonText: 'Close',
                            closeOnConfirm: false
                            }).then((result) => {
                               if (result.value) {
                                   window.location = 'users'
                               }
                            });

                        </script>";
                    }
                } else {
                    $encryptedPass = $_POST["current_password"];
                } // end of password != ""

                $data = array("name" => $_POST['e_name'],
                    "username" => $_POST['e_username'],
                    "password" => $encryptedPass,
                    "profile" => $_POST['e_profile'],
                    "picture" => $route);


                $response = UserModel::mdlEditUser($table, $data);

                if ($response != "error") {
                    echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'User Modified successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'users'
                           }
                        });

                </script>";
                }

            } else {
                echo "<script>
                    Swal.fire({
                        type: 'error',
                        title: 'Error occurred while processing your details Please try again',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'users'
                           }
                        });

                </script>";
            }

        }
    }

    /**
     * :: DELETE USERS
     */

    public function ctrDeleteUser() {
        if (isset($_GET["userId"])) {
            $table = "test";
            $data = $_GET["userId"];

            if (isset($_GET["userPicture"])) {
                unlink($_GET["userPicture"]);
                rmdir("views/img/users/".$_GET['user']);
            }

            $response = UserModel::mdlDeleteUser($table, $data);

            if ($response == "ok") {
                echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'User Deleted successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'users'
                           }
                        });

                </script>";
            }
        }
    }



}

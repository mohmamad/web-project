<?php
include "models/get-user-data-model.php";
function get_login_data()
{
    $email = "";
    $password = "";
    if (isset($_POST["login-email"])) {
        $email = $_POST["login-email"];
    }
    if (isset($_POST["login-password"])) {
        $password = $_POST["login-password"];
    }

    $emailresult = check_login_email($email);


    if ($emailresult == "") {
        redirect('travel.php?error=no matched email or password!');
    } else {
        $passwordresult = check_login_password($password);
        if($passwordresult == ""){
            redirect('travel.php?error=no matched email or password!');
        }
        else {
            redirect("travel.php?success= login successfully");
        }
    }
}


?>

<?php
include 'functions/functions.php';
include 'functions/create-user-functions.php';
include 'functions/login-function.php';
if(!isset($_SESSION))
{
    session_start();
}
$action = isset($_GET['action']) ? $_GET['action'] : "";
$savedEmail = "";

$savedPassword = "";


include 'functions/functions.php';
include 'functions/create-user-functions.php';
$action=isset($_GET['action'])?$_GET['action']:"";



switch ($action) {
    case "newUser":
        create_new_user();
        break;

    case "sign-in":
//        if(!isset($_SESSION))
//        {
//            session_start();
//        }
//        $email = "";
//        $password = "" ;
//        if (isset($_post["login-email"]) && isset($_post["login-password"])) {
//            echo"test";
//            $_SESSION['login'] = 1;
//            $_SESSION['email'] = $_post['login-email'];
//            $_SESSION['password'] = $_post['login-password'];
//        }
//        if(isset($_SESSION['login'])) {
//            echo"hiiqweqe <br>";
//            $savedEmail = $_SESSION['email'];
//            $savedPassword = $_SESSION['password'];
//           echo"$savedEmail <br>";
//           echo $savedPassword;
//            check_login($savedEmail, $savedPassword);
//
//        }
        get_login_data();

    default:
}
?>
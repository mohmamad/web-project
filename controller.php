<?php;
include 'functions/functions.php';
include 'functions/create-user-functions.php';
$action=isset($_GET['action'])?$_GET['action']:"";


switch ($action) {
    case "newUser":
        create_new_user();
        break;
    default:
}
?>
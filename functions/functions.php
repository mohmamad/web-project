<?php

if(!isset($_SESSION))
{
    session_start();
}

function check_login($email, $password){
    echo"hii12";
    echo"$email <br>";
    echo"$password <br>";
    echo"hii123";

//    redirect('travel.php');
//    if($email == "user@user.com" && $password == "123456"){
//        $_SESSION["id"] = 1;
//        $_SESSION["firstname"] = "page";
//        $_SESSION["lastname"] = "manager";
//
//
//        redirect('travel.php?sccuess=Login Success');
//    }else{
//
//        redirect('travel.php?error=Login Faild');
//
//    }
}

function sign_out(){
    session_destroy();
    redirect('travel.php');
}

function is_user_login(){
    if(!isset($_SESSION['id'])){
        redirect('index.php?error=Session time out');
    }
}

function check_user_login(){
    if(isset($_SESSION['id'])){
        return true;
    }else{
        return false;
    }
}




function redirect($url){
    header('Location: '.$url, true,'302');
    exit();
}
?>
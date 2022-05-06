<?php
include "models/create-user-model.php";

function create_new_user(){
    $email="";
    $firstname="";
    $lastname="";
    $password="";
    $repassword="";
    if(isset($_POST["email"])){
        $email=$_POST["email"];
    }
    if(isset($_POST["firstname"])){
        $firstname=$_POST["firstname"];
    }
    if(isset($_POST["lastname"])){
        $lastname=$_POST["lastname"];
    }
    if(isset($_POST["password"])){
        $password=$_POST["password"];
    }
    if(isset($_POST["repassword"])){
        $repassword=$_POST["repassword"];
    }

    /* if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         redirect('register.php?error=invalid email');
     }
     $uppercase = preg_match('@[A-Z]@', $password);
     $lowercase = preg_match('@[a-z]@', $password);
     $number    = preg_match('@[0-9]@', $password);

     if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
         redirect('register.php?error=inalid password');
     }*/

    if ($password == $repassword && $password!="") {

        $user_obj["email"]=$email;
        $user_obj["firstname"]=$firstname;
        $user_obj["lastname"]=$lastname;
        $user_obj["password"]=$password;
        $user_obj["repassword"]=$repassword;

        $result=add_new_user($user_obj);
        echo $result;
        if($result=="success"){
            redirect('travel.php?success=welcome ,you can login using this account');
        }
        else{
            redirect("travel.php?error=$result");
        }

    }else{
        redirect("travel.php?error=password and confirmation password are not matched!");
    }

}
?>
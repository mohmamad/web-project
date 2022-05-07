<?php
include "model.php";

function add_new_user($user_obj){
    $conn=creat_conn();
    $prepare=$conn->prepare("INSERT INTO `user` (`first-name`,`last-name`, `password`,`phone-number`, `email`) VALUES (?,?,?,?,?)");

    try{
       $prepare->bind_param('sssss',$user_obj['firstname'],$user_obj["lastname"],$user_obj["password"],$user_obj["phonenumber"],$user_obj["email"]);

        $prepare->execute();

        return "success";

    }catch(Exception $e){
        if($prepare->error){
            return $prepare->error;
        }
    }
}

?>
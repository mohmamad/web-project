<?php

function add_new_user($user_obj){
    $conn=creat_conn();
    $prepare=$conn->prepare("INSERT INTO `flights` (`flight-id`,`des`, `flight-date`,`flight-time`, `source`,`description`) VALUES (null,?,?,?,?,?)");

    try{
        $prepare->bind_param('ssssss',$user_obj['firstname'],$user_obj["lastname"],$user_obj["password"],$user_obj["phonenumber"],$user_obj["email"]);

        $prepare->execute();

        return "success";

    }catch(Exception $e){
        if($prepare->error){
            return $prepare->error;
        }
    }
}

?>

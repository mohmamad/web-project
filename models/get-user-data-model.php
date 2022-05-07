<?php
   function check_login_email($email){

      $item = "";
      $conn=creat_conn();
      try {
          $prepare = $conn->prepare("select * from `user` where email=?");
          $prepare->bind_param('s', $email);
          $prepare->execute();
          $result = $prepare->get_result();
          $item = $result->fetch_object();
          return $item;
      }catch (Exception $e) {
          return $item;
      }
   }

   function check_login_password($password){
       $item = "";
       $conn=creat_conn();
       try {
           $prepare = $conn->prepare("select * from `user` where password=?");
           $prepare->bind_param('s', $password);
           $prepare->execute();
           $result = $prepare->get_result();
           $item = $result->fetch_object();
           return $item;
       }catch (Exception $e) {
           return $item;
       }
   }
?>

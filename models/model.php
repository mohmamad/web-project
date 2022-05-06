<?php
function creat_conn(){
    $host="localhost";
    $name="root";
    $pass="";
    $dbname="web-project";
    $conn=new mysqli($host,$name,$pass,$dbname);

    if(mysqli_connect_errno()){
        echo "cant connect to data base";
    }
    else{
        return $conn;
    }
}
?>
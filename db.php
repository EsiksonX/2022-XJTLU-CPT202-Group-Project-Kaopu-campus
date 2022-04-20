<?php

function siam_db(){
    //below is the code to connect MySQL database
    $host = "localhost";
    $user = "application";
    $password = "Hf9ppRBA!uinJQJ";
    $dbName = "campusserver";
    $link=new \mysqli($host,$user,$password,$dbName);
    if ($link->connect_error){
        die("connection error".$link->connect_error);
    }
    
    mysqli_set_charset($link, "utf8");
    return $link;
}
<?php
    $number=$_POST["number"];
    $user_password=$_POST["password"];
    //below is the code to connect MySQL database
    $host = "localhost";
    $user = "application";
    $password = "Hf9ppRBA!uinJQJ";
    $dbName = "campusserver";
    $conn=new mysqli($host,$user,$password,$dbName);
    if ($conn->connect_error){
        die("connection error");
    }
    mysqli_query($conn , "set names utf8");






    $sql_request = "SELECT phone_number FROM user_info";
    $sql_post = "INSERT INTO `user_info` (`phone_number`,`password`) VALUES ('$number', '$user_password')";


    $user_number = mysqli_query($conn, $sql_request);

    if (mysqli_num_rows($user_number) > 0) {
        // 输出数据
        while ($row = mysqli_fetch_assoc($user_number)) {
            $data[] = $row["phone_number"];
        }
    }
    if (in_array($number,$data)){
        echo 1;
    }else{
        mysqli_query($conn, $sql_post);
        echo 2;
    }





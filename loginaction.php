<?php
require_once 'db.php';
if(@ $_POST["login_btn"] == "login"){
    $link = siam_db();

    $number = $_POST["phone_number"];
    $pwd = $_POST["login_pwd"];

    $row = mysqli_query($link,"select * from user_info where phone_number='$number' and password='$pwd'");

    $result = mysqli_fetch_array($row);
    if(empty($result)){
        echo 'The entered phone number or password is incorrect';
    }else{
        session_start();
        echo 'Login successfully';
        $_SESSION['phone'] = $result["phone_number"];
        $_SESSION['nickname'] = $result["nickname"];
        $_SESSION['userid'] = $result["userid"];
        $_SESSION['head'] = $result["head"];

        
        header("Location:http://kaopu-campus.online/kaopuUI/php/loginsucc.php");
    }

}?>
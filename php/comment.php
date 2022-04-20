<?php
   // $arr=$_POST;

    //if($arr["name"]==null){
        //echo 1;
    //}else{
       // echo 0;
    //}

    //below is the code to connect MySQL database
    $host = "localhost";
    $user = "application";
    $password = "Hf9ppRBA!uinJQJ";
    $dbName = "campusserver";
    $link=new mysqli($host,$user,$password,$dbName);
    if ($link->connect_error){
    die("connection error".$link->connect_error);

    $arr=$_POST;
    print_r($arr);

   $sql="insert into store_comment set id='1', store_id='2', onwer='3', article='4', grading='5', image='6', ctreate time='2020'";
    $rst=mysqli_query($link,$sql);
    if($rst){
      echo "<script>alert('Comment published failed');location.href='store_detail.html';</script>";
    }else{
      echo "Comment published failed";
    }


}
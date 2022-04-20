<?php
error_reporting(0);
//below is the code to connect MySQL database
header('Access-Control-Allow-Origin:*');

$host = "localhost";
$user = "application";
$password = "Hf9ppRBA!uinJQJ";
$dbName = "campusserver";
$conn=new mysqli($host,$user,$password,$dbName);
if ($conn->connect_error){
    die("connection error");
}
mysqli_query($conn , "set names utf8");

$sql = "SELECT id, title, article, image, create_time FROM guide;";


$retval = mysqli_query($conn, $sql);

class guide{
    public $id;
    public $title;
    public $article;
    public $image;
    public $creat_time;
}

$retval = mysqli_query($conn, $sql);
if ($retval) {
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        $guide = new guide();
        $guide->id = $row["id"];
        $guide->article = $row["article"];
        $guide->title = $row["title"];
        $guide->image = $row["image"];
        $guide->creat_time = $row["creat_time"];
        $data[] = $guide;
    }
    $result = json_encode($data);
}
echo $result;

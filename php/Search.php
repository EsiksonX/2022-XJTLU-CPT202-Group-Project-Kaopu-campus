<?php
//below is the code to connect MySQL database
header('Access-Control-Allow-Origin:*');

$host = "localhost";
$user = "application";
$password = "Hf9ppRBA!uinJQJ";
$dbName = "campusserver";
$link=new mysqli($host,$user,$password,$dbName);
if ($link->connect_error){
    die("connection error".$link->connect_error);
}
$name=isset($_POST['name']) ? addslashes(trim($_POST['name'])) : '';//取输入框的值

if($name!=''){
    $sql = "select * from store_info where store_name like '%{$name}%' || ((category like '%{$name}%'))";
}

$retval = mysqli_query($link, $sql);
class Search{
    public $storeID;
    public $storeName;
}
if ($retval) {
    while ($row = mysqli_fetch_array($retval,MYSQLI_ASSOC)) {
        $search = new Search();
        $search->storeID = $row["StoreID"];
        $search->storeName = $row["Store_name"];
        $data[]=$search;
    }
    $result = json_encode($data);
}
echo $result;
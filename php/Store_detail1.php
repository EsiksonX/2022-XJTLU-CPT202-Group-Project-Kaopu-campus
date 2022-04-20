<?php
$store_id=$_POST["store_id"];


$host = "localhost";
$user = "application";
$password = "Hf9ppRBA!uinJQJ";
$dbName = "campusserver";
$conn=new mysqli($host,$user,$password,$dbName);
if ($conn->connect_error){
    die("connection error");
}
mysqli_query($conn , "set names utf8");



$store_sql = "SELECT * FROM (SELECT StoreID, Store_name, Price, Begin_hour, End_hour, longitude, latitude FROM store_info WHERE StoreID = $store_id) AS a 
              LEFT JOIN (SELECT store_id, AVG(rate) AS rate FROM store_comment GROUP BY store_id) AS b    
              ON a.StoreID = b.store_id";

$retval = mysqli_query($conn, $store_sql );


if ($retval) {

       $row = mysqli_fetch_array($retval,MYSQLI_ASSOC);
       $data['id'] = $row['StoreID'];
       $data['name'] = $row['Store_name'];
       $data['price'] = $row['Price'];
       $data['Begin_hour'] = $row['Begin_hour'];
       $data['End_hour'] = $row['End_hour'];
       $data['longitude'] = $row['longitude'];
       $data['latitude'] = $row['latitude'];
       $data['rate'] =  $row["rate"];

}
$result = json_encode($data);
echo $result;






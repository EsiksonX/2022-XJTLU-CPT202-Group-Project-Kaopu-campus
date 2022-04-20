<?php
$host = "localhost";
$user = "application";
$password = "Hf9ppRBA!uinJQJ";
$dbName = "campusserver";
$conn=new mysqli($host,$user,$password,$dbName);
if ($conn->connect_error){
    die("connection error");
}
mysqli_query($conn , "set names utf8");



class store{
    public $id;
    public $name;
    public $rate;
    public $longitude;
    public $latitude;
    public $trading_area;
    public $begin_time;
    public $end_time;
    public $avg_price;
}

$store_sql = "SELECT * FROM store_info AS a
               LEFT JOIN (SELECT store_id, AVG(rate) AS rate FROM store_comment GROUP BY store_id) AS b 
            ON a.StoreID = b.store_id
              ";

$retval = mysqli_query($conn, $store_sql );


if ($retval) {
    while ($row = mysqli_fetch_array($retval,MYSQLI_ASSOC)) {
        $store = new store();
        $store->id = $row["StoreID"];
        $store->name = $row["Store_name"];
        $store->rate = $row["rate"];
        $store->longitude = $row["longitude"];
        $store->latitude = $row["latitude"];
        $store->trading_area = $row["Trading_area"];
        $store->begin_time = $row["Begin_hour"];
        $store->end_time = $row["End_hour"];
        $store->avg_price = $row["Price"];
        $data[]=$store;
    }
    $result = json_encode($data);
}
echo $result;

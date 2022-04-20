<?php
    error_reporting(0);
header('Access-Control-Allow-Origin:*');

    $sort = $_POST["sort"];
    $categories = $_POST["category"];
    $price = $_POST["price"];
    $my_longitude = $_POST["lont"];
    $my_latitude = $_POST["lat"];
    $search_key = $_POST["searchKey"];
    if ($categories == "") $categories_filter = "*";
    else $categories_filter = "(Category = '$categories')";
    if ($price == "under20") $price_filter = "(Price > 0) AND (Price <= 20)";
    elseif ($price == "20-50") $price_filter = "(Price > 20) AND (Price <= 50)";
    elseif ($price == "50-70") $price_filter = "(Price > 50) AND (Price <= 70)";
    elseif ($price == "70-100") $price_filter = "(Price > 70) AND (Price <= 100)";
    elseif ($price == "100-150") $price_filter = "(Price > 100) AND (Price <= 150)";
    elseif ($price == "over150") $price_filter = "Price > 150";
    else $price_filter = "*";
    $order = "rate DESC, distance ASC";
    if ($sort == "closest") $order = "distance ASC";
    elseif ($sort == "highest-rated") $order = "rate DESC";
    elseif ($sort == "lowest-price") $order = "Price ASC";
    elseif ($sort == "highest-price") $order = "Price DESC";
    /**
     * Calculate the distance between two points' geographic coordinates
     * @param Decimal $longitude1 starting point longitude
     * @param Decimal $latitude1  starting point latitude
     * @param Decimal $longitude2 end point longitude
     * @param Decimal $latitude2  end point latitude
     * @param Int $decimal    precision: retained decimal places
     * @return float
     */
    function getDistance($longitude1, $latitude1, $longitude2, $latitude2): string {
        $EARTH_RADIUS = 6370.996; // Earth Radius Factor
        $PI = 3.1415926;

        $radLat1 = $latitude1 * $PI / 180.0;
        $radLat2 = $latitude2 * $PI / 180.0;

        $radLng1 = $longitude1 * $PI / 180.0;
        $radLng2 = $longitude2 * $PI /180.0;

        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;

        $distance = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
        $distance = $distance * $EARTH_RADIUS * 1000;

        if ($distance < 1000) {
            $distance = round($distance, 0);
            return "$distance m";
        } else {
            $distance = round($distance / 1000, 2);
            return "$distance km";
        }
    }

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

    //construct a class to store the data selected from database
    class store{
        public $id;
        public $name;
        public $rate;
        public $distance;
        public $trading_area;
        public $category;
        public $begin_time;
        public $end_time;
        public $avg_price;
    }
    if ($price_filter == "*" && $categories_filter =="*") {
        $store_sql = "
            SELECT * 
            FROM (SELECT StoreID, Store_name, longitude, latitude, Trading_area, Category, Begin_hour, End_hour, Price, 
                         SQRT(POWER(longitude - $my_longitude, 2) + POWER(latitude - $my_latitude, 2)) AS distance
            FROM store_info) AS a 
            LEFT JOIN (SELECT store_id, AVG(rate) AS rate FROM store_comment GROUP BY store_id) AS b 
            ON a.StoreID = b.store_id
            ORDER BY $order;
        ";
        if (!empty(trim($search_key))) {
            $store_sql = "
                SELECT * 
                FROM (SELECT StoreID, Store_name, longitude, latitude, Trading_area, Category, Begin_hour, End_hour, Price, 
                             SQRT(POWER(longitude - $my_longitude, 2) + POWER(latitude - $my_latitude, 2)) AS distance
                FROM store_info where  Store_name like '%{$search_key}%') AS a 
                LEFT JOIN (SELECT store_id, AVG(rate) AS rate FROM store_comment GROUP BY store_id) AS b 
                ON a.StoreID = b.store_id
                ORDER BY $order;
            ";
        }
    } elseif ($price_filter == "*") {
        $store_sql = "
            SELECT * 
            FROM (SELECT StoreID, Store_name, longitude, latitude, Trading_area, Category, Begin_hour, End_hour, Price,
                         SQRT(POWER(longitude - $my_longitude, 2) + POWER(latitude - $my_latitude, 2)) AS distance
            FROM store_info WHERE $categories_filter) AS a 
            LEFT JOIN (SELECT store_id, AVG(rate) AS rate FROM store_comment GROUP BY store_id) AS b 
            ON a.StoreID = b.store_id
            ORDER BY $order;
        ";
    } elseif ($categories_filter =="*") {
        $store_sql = "
            SELECT * 
            FROM (SELECT StoreID, Store_name, longitude, latitude, Trading_area, Category, Begin_hour, End_hour, Price,
                         SQRT(POWER(longitude - $my_longitude, 2) + POWER(latitude - $my_latitude, 2)) AS distance
            FROM store_info WHERE $price_filter) AS a 
            LEFT JOIN (SELECT store_id, AVG(rate) AS rate FROM store_comment GROUP BY store_id) AS b 
            ON a.StoreID = b.store_id
            ORDER BY $order;
        ";
    } else {
        $store_sql = "
            SELECT * 
            FROM (SELECT StoreID, Store_name, longitude, latitude, Trading_area, Category, Begin_hour, End_hour, Price,
                         SQRT(POWER(longitude - $my_longitude, 2) + POWER(latitude - $my_latitude, 2)) AS distance
            FROM store_info WHERE $categories_filter AND $price_filter) AS a 
            LEFT JOIN (SELECT store_id, AVG(rate) AS rate FROM store_comment GROUP BY store_id) AS b 
            ON a.StoreID = b.store_id
            ORDER BY $order;
        ";
    }


    $retval = mysqli_query($conn, $store_sql);
    if ($retval) {
        while ($row = mysqli_fetch_array($retval,MYSQLI_ASSOC)) {
            $store = new store();
            $store->id = $row["StoreID"];
            $store->name = $row["Store_name"];
            $store->rate = $row["rate"];
            $store->distance = getDistance($my_latitude, $my_longitude, $row['latitude'], $row['longitude']);
            $store->trading_area = $row["Trading_area"];
            $store->category = $row["Category"];
            $store->begin_time = $row["Begin_hour"];
            $store->end_time = $row["End_hour"];
            $store->avg_price = $row["Price"];
            $data[]=$store;
        }
        $result = json_encode($data);
    }
    echo $result;

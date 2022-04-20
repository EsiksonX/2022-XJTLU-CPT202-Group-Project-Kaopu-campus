<?php


header('Access-Control-Allow-Origin:*'); //注意！跨域要加这个头 之前好像没有有

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $msg = '';
    if (!isset($_POST['pic'])) {
        $msg = 'Please choose photo';
        echoJson($msg, 1);
    }
    if (!isset($_POST['article'])) {
        $msg = 'Please enter the content message';
        echoJson($msg, 1);
    }


    $pics = $_POST['pic'];
    $article = $_POST['article'];
    // foreach ($pics as $key => $value) {
    //     $msg.='，data'.$value;
    // }
    $save_article = $article;
    $save_image1 = count($pics) > 0 ? $pics[0] : '';
    $save_image2 = count($pics) > 1 ? $pics[1] : '';
    $save_image3 = count($pics) > 2 ? $pics[2] : '';
    $save_image4 = count($pics) > 3 ? $pics[3] : '';
    date_default_timezone_set("PRC");
    $creat_time = date("Y-m-d H:i:s", time());
    $msg = $save_article . ',' . $save_image1 . ',' . $save_image2 . ',' . $save_image3 . ',' . $save_image4 . $creat_time;


     
    define('DBSERVER', "localhost");
    define('DBUSER', "application");
    define('DBPASS', "Hf9ppRBA!uinJQJ");
    define('DATABASE', "campusserver");

    // define('DBSERVER', "localhost:3308");
    // define('DBUSER', "root");
    // define('DBPASS', "root");
    // define('DATABASE', "demo");

    $connection = mysqli_connect(DBSERVER, DBUSER, DBPASS);
    if (!$connection) {
        $msg = "Cannot connect";
        echoJson($msg, 1);
    } else {
        $select_db = mysqli_select_db($connection, DATABASE);
        if (!$select_db) {
            $msg = "Unable to select database";
            echoJson($msg, 1);
        } else {

            $insert = "INSERT INTO post (owner, article, image1, image2, image3, image4, creat_time, location, topic, title)
    VALUES (1, '$save_article' , '$save_image1', '$save_image2', '$save_image3' , '$save_image4', NOW(), '', '', '');";




            $result = mysqli_query($connection, $insert);
            if($result){
                echoJson($msg, 0);
            }
            else{
                echoJson($msg, 1);
            }

           
        }
    }




    mysqli_close($connection);


    //echoJson($result , 0);
}
/**
 * 输出json
 * @param string $msg 提示信息
 * @param int $errcode 错误代码
 * @param array $append_array 附加信息
 */
function echoJson($msg, $errcode = 0, $append_array = [])
{
    header('content-type:application/json;charset=utf-8');
    $result = ['errcode' => $errcode, 'msg' => $msg];
    $append_array && $result += $append_array;
    echo json_encode($result);
    exit;
}

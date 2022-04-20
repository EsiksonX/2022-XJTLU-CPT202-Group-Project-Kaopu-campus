<?php

require_once 'db.php';

// 必须是登录用户

session_start();
if(empty($_SESSION['phone'])){
    echo json_encode(['code' => 500, 'msg' => '请登录']);
    die;
}


if(empty($_FILES['file'])) {
    echo json_encode(['code' => 500, 'msg' => '请上传图片']);
    die;
}
// 保存头像文件，更新数据库和session

$path = "img/" . date("YmdHis").$_FILES["file"]["name"];

move_uploaded_file($_FILES["file"]["tmp_name"], $path);


$link = siam_db();

$user_id = $_SESSION['userid'];
$res = mysqli_query($link,"update user_info set head = '{$path}' where userid = {$user_id}");

$_SESSION['head'] = $path;
echo json_encode(['code' => 200, 'data' => [
    'path' => $path,
],'msg' => 'success']);
die;
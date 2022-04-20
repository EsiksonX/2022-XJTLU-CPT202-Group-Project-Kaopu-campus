<?php
    header('Access-Control-Allow-Origin:*');

    error_reporting(0);
    session_start();
    $type = $_POST['type'];
    $id = $_SESSION['userid'];
    if ($id == null && $type == "follow") {
        echo "notlogin";
        end();
    }

    $host = "localhost";
    $user = "application";
    $password = "Hf9ppRBA!uinJQJ";
    $dbName = "campusserver";
    $conn=new mysqli($host,$user,$password,$dbName);
    if ($conn->connect_error){
        die("connection error");
    }
    mysqli_query($conn , "set names utf8");

    if ($type == "recommend") {
        $sql = "SELECT PostID, owner, title, image1, head, nickname, likes FROM
                 (SELECT post.PostID, post.owner, post.title, post.image1, post.creat_time, user_info.head, user_info.nickname
                FROM post, user_info WHERE post.owner = user_info.userid) AS a
                LEFT JOIN (SELECT COUNT(liked.to_pid) AS likes, liked.to_pid FROM liked) AS b
                ON a.PostId = b.to_pid ORDER BY creat_time DESC, likes DESC;";
    } else {
        $sql = "SELECT PostID, owner, title, image1, head, nickname, likes
            FROM (SELECT to_uid FROM follow WHERE from_uid = $id) AS x
            LEFT JOIN (SELECT creat_time, PostID, owner, title, image1, head, nickname, likes FROM
            (SELECT post.PostID, post.owner, post.title, post.image1, post.creat_time, user_info.head, user_info.nickname
            FROM post, user_info WHERE post.owner = user_info.userid) AS a
            LEFT JOIN (SELECT COUNT(liked.to_pid) AS likes, liked.to_pid FROM liked) AS b
            ON a.PostId = b.to_pid) AS y ON to_uid = owner ORDER BY creat_time DESC;";
    }

    class post{
        public $PostID;
        public $owner;
        public $title;
        public $image1;
        public $head;
        public $nickname;
        public $likes;
    }

    $retval = mysqli_query($conn, $sql);
    if ($retval) {
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $post = new post();
            $post->PostID = $row["PostID"];
            $post->owner = $row["owner"];
            $post->title = $row["title"];
            $post->image1 = $row["image1"];
            $post->head = $row["head"];
            $post->nickname = $row["nickname"];
            $post->likes = $row["likes"];
            $data[] = $post;
        }
        $result = json_encode($data);
    }
    echo $result;
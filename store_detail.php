<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link href="css/mui.css" rel="stylesheet" />
    <link href="css/main_Lin.css" rel="stylesheet" />
    <link href="css/store.css" rel="stylesheet" />
    <style>
        .newimg{ width: 100%;}
        .newimg img{ width: 100%;}
        .index-rateWrap{
            transform: scale(1, 1);
            position: relative;
            margin-left: 5%;
        }
    </style>
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

    $store_id=$_GET;

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
        public $url_number;
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
            $store->url_number = $store_id;
            $data[]=$store;
        }
        $result = json_encode($data);
    }

    ?>


</head>
<body>
<!-- 头部 -->
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <ul class="mui-table-view mui-pull-right ">
        <li class="mui-table-view-cell mui-collapse">
            <a class="mui-navigate-right" href="#">More</a>
            <div class="mui-collapse-content">
                <p>Share</p>
            </div>
            <div class="mui-collapse-content">
                <p>Report</p>
            </div>
        </li>
    </ul>
</header>
<!-- 主体 -->
<div class="mui-content">
    <!-- 店铺图片 -->
    <div id="slider" class="mui-slider" >
        <div class="mui-slider-group mui-slider-loop">
            <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
            <div class="mui-slider-item mui-slider-item-duplicate">
                <a href="#">
                    <img src="pic4.jpg"  height="200" width="400">
                </a>
            </div>
            <!-- 第一张 -->
            <div class="mui-slider-item">
                <a href="#">
                    <img src="pic1.jpg" height="200" width="400">
                </a>
            </div>
            <!-- 第二张 -->
            <div class="mui-slider-item">
                <a href="#">
                    <img src="pic2.jpg" height="200" width="400">
                </a>
            </div>
            <!-- 第三张 -->
            <div class="mui-slider-item">
                <a href="#">
                    <img src="pic3.jpg" height="200" width="400">
                </a>
            </div>
            <!-- 第四张 -->
            <div class="mui-slider-item">
                <a href="#">
                    <img src="pic4.jpg" height="200" width="400">
                </a>
            </div>
            <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
            <div class="mui-slider-item mui-slider-item-duplicate">
                <a href="#">
                    <img src="pic1.jpg" height="200" width="400">
                </a>
            </div>
        </div>
        <div class="mui-slider-indicator">
            <div class="mui-indicator mui-active"></div>
            <div class="mui-indicator"></div>
            <div class="mui-indicator"></div>
            <div class="mui-indicator"></div>
        </div>
    </div>

    <!-- 商铺介绍 -->
    <ul id= "shop" class="mui-table-view">
        <li class="mui-table-view-cell mui-media">
            <div id="name" class="mui-media-body">
                <h2 id="store_name">name of shop</h2>
                <p class="mui-ellipsis">star rating  and per capita</p>
                <p class="mui-ellipsis">business hours</p>
                <a class="mui-ellipsis" href = "#">address</a>
            </div>
        </li>
    </ul>

    <!-- 评价 -->
    <div id="part">
        <div>
            <span id ="diamonds">&nbsp&nbsp;</span>
            <span id="evaluate">Comment</span>
            <button onclick="toComment()" id = "button" type = "button" class="mui-btn mui-pull-right">evaluate</button>
            <p></p>
            <section class="index-line">
                <div class="index-rateWrap">
                    <div class='rating-wrapper index-stars'>
                        <div class="rating-gray">
                            <img src="image/stars/gray.svg">
                        </div>
                        <div class="rating-actived" style="width: 50%">
                            <img src="image/stars/actived.svg">
                        </div>
                    </div>
                    <span class="index-rate" style="font-size:14px">2.5</span>
                </div>
            </section>
            <ul id="content" class="mui-table-view">
            </ul>
        </div>
    </div>
</div>
<script src="js/mui.js"></script>
<script type="text/javascript">
    $.ajax({
        type: "POST",
        url: "store_detail.php",
        data: '1',
        success: function (data){
            store_info = jQuery.parseJSON(data);
            alert(123)
        }
    })
    alert(123);
    document.getElementById("store_name").innerHTML =store_info[0].name;

</script>

<script type="text/javascript">

    var storeId = 1;
    if(typeof location.href.split('id=')[1] != 'undefined'){
        storeId = location.href.split('id=')[1];
    }
    console.log(storeId);
    function toComment(){
        location.href = 'comment.html?id='+storeId;
    }
    function ShowData(data){
        let node = document.getElementById('content');
        const size = data.length;
        let html = '';
        for(let i=0;i<size;i++){
            const d = data[i];
            console.log(d);
            let imglist = '';
            if(d.image1){
                imglist += '<img src='+d.image1+' />';
            }
            if(d.image2){
                imglist += '<img src='+d.image2+' />';
            }
            if(d.image3){
                imglist += '<img src='+d.image3+' />';
            }
            if(d.image4){
                imglist += '<img src='+d.image4+' />';
            }
            html += '<li class="mui-table-view-cell mui-media">';
            html += '	<img class="mui-media-object mui-pull-left" src="images/avatar.png">';
            html += '	<div class="mui-media-body">';
            html += '		<div class="newimg"><img style="width:65%" src="images/score'+d['grading']+'.png" /></p>';
            html += '		<p>'+d['article']+'</p>';
            html += '		<div class="imglist">'+imglist+'</div>';
            html += '</div></li>';
        }
        node.innerHTML = html;
    }
    mui.init();
    let url = 'http://146.56.221.17:9090/think/public/StoreComment/'+storeId;
    mui.ajax(url,{
        dataType:'json',//服务器返回json格式数据
        type:'get',//HTTP请求类型
        success:function(data){
            ShowData(data);
        }
    });
</script>
</body>
</html>
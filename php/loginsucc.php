<?php

session_start();
if(empty($_SESSION['phone'])){
    header("Location:login.php");
    die;
}


?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="css/mui.css" rel="stylesheet" />
		<link href="css/my_main.css" rel="stylesheet" />
        <!-- 引入 layui.css -->
        <link rel="stylesheet" href="//unpkg.com/layui@2.6.8/dist/css/layui.css">
        
        <!-- 引入 layui.js -->
        <script src="//unpkg.com/layui@2.6.8/dist/layui.js"></script>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
			<h1 class="mui-title">Me</h1>
		</header>
		<!-- body -->
		<!-- home -->
		<div class="mui-content box-shadow">
			<div class="home-div">
				<div class="home-div-top">
					<div class="home-div-top-l" id="head-div">
						<img src="<?php echo !empty($_SESSION['head']) ? $_SESSION['head'] : 'img/头像.jpg';?>" id="head-img">
					</div>
					<div  class="home-div-top-r">
						<h4><?php echo ($_SESSION['nickname']);?></h4>
					</div>
				</div>
			</div>
		</div>

		<div class="mui-slider">
			<!--选项卡标题区-->
			<div class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted" id="first-part">
			  <a class="mui-control-item" href="#item1">Comment
			  <span class="mui-badge mui-badge-primary">99+</span>
			  </a>
			  <a class="mui-control-item" href="#item2">Like
			  <span class="mui-badge mui-badge-primary">99+</span>
			  </a>
			</div>
			<div class="mui-slider-indicator-low mui-segmented-control mui-segmented-control-inverted" id="first-part">
				<a class="mui-control-item" href="#item3">Following</a>
				<a class="mui-control-item" href="#item4">Followers</a>
			</div>
		</div>
		
		<ul class="mui-table-view" id="second-part">
			<li class="mui-table-view-cell">Moments
			<a href="homepage.html">
				</a>
			</li>
		</ul>
		<ul class="mui-table-view" id="second-part">
				<li class="mui-table-view-cell">Favorites</li>
				<li class="mui-table-view-cell">General</li>
				<li class="mui-table-view-cell">Help & Feedback</li>
			</ul>

		<!-- footer -->
        <script>
            layui.use(['layer', 'upload', 'jquery'], function(){
                var layer = layui.layer
                ,upload = layui.upload;
				let $= layui.jquery;
                
                //头像执行实例ps 名字没有那个大家看看
                var uploadInst = upload.render({
                    elem: '#head-div' //绑定元素
                    ,url: 'upload_head.php' //上传接口
                    ,done: function(res){
                        //上传完毕回调
                        layer.msg("success")
						console.log(res)
						$("#head-img").attr("src", res.data.path)
                    }
                    ,error: function(){
                    //头像请求异常回调
					layer.alert("abnormal")
                    }
                });
            });
        </script> 

	</body>

</html>

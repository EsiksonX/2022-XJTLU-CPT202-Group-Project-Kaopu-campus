<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link href="css/mui.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/my_main.css"/>
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
    <link rel="stylesheet" type="text/css" href="css/me_dw1.css"/>
</head>

<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">Log in</h1>
    <button onclick="window.open('zhuce.html')" class="mui-btn-link mui-pull-right">Sign up</button>
</header>

<div class="mui-content">
    <div class="public-margin-top">
        <form class="mui-input-group" action="loginaction.php" method="post">
            <div class="mui-input-row">
                <input type="text" class="mui-input-clear mui-placeholder" placeholder="Phone number" name="phone_number">
            </div>
            <div class="mui-input-row">
                <input type="password" class="mui-input-password" placeholder="Password" name="login_pwd">
            </div>
        <button class="public-button login-block" name="login_btn" value="login" type="submit" onclick="location.href='http://kaopu-campus.online/kaopuUI/php/loginaction.php'">Log in</button>
        <button class="mui-btn-link mui-pull-right forget-password">Forget password?</button>
        </form>
    </div>
</div>
</body>
<script src="js/mui.js"></script>
<script type="text/javascript">
    mui.init();
</script>

</html>

<?php
error_reporting(0);
?>


<?php
include_once 'checkAdmin.php';//检查权限后才能进来
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理系统</title>
    <style>
        body {
            background-image: url('/photo/tupian3.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            height: 100vh;
            overflow: hidden;
        }

        h1 {
            color: #95ea91
        }

        .main {
            width: 80%;
            margin: 0 auto;
            text-align: center
        }

        h2 {
            font-size: 21px
        }

        h2 a {
            color: #d86ae1;
            text-decoration: none;
            margin-right: 15px
        }

        h2 a:last-child {
            margin-right: 0
        }

        h2 a:hover {
            color: greenyellow;
            text-decoration: underline
        }

        .curr {
            color: darkorchid
        }
    </style>
</head>
<body>
<div class="main">
    <h1>管理主页</h1>
    <h2>
        <a href="index.php">首页</a>
        <a href="_yonghuguanli.php">用户管理</a>
        <a href="_superadblog.php">博客管理</a>
    </h2>

</div>
</body>
</html>
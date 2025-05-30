<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>发表个人博客</title>
    <style>
        body {
            background-image: url('/photo/tupian2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            height: 100vh;
            overflow: hidden;
        }
        .main{width:80%;margin: 0 auto;text-align: center}
        h2{font-size:21px}
        h2 a{color: #3c7ad9;text-decoration: none;margin-right: 15px}
        h2 a:last-child{margin-right: 0}
        h2 a:hover{color:greenyellow;text-decoration: underline}
        .curr{color:darkorchid}
        .red{color:red}
        .yanse{color: #e346ec}
        .yanse0{color:aqua}
        .yanse1{color:green}
        .yanse2{color:pink}
        .yanse3{color: #7ad3fa}
    </style>
</head>
<body>
<div class="main">
    <?php   //读取本来的资料
    include_once "conn.php";
    $sql = "select * from userinfo where sfz = '".$_SESSION['LoggedUsersfz']."'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){
        $info = mysqli_fetch_array($result);//把查到的资料抓取成数组
        $fav = explode( ",",$info['fav']);
    }
    else{
        die('<span class="error-message">未找到有效用户</span>');
    }
    ?>
    <?php
    if(isset($_SESSION['LoggedUsersfz']) && $_SESSION['LoggedUsersfz'] <> ''){
        ?>
        <div class="logged">已登录:<?php echo $_SESSION['LoggedUsersfz']; ?><span class="logout"><a href="logout.php">注销登录</a></span></div>
        <?php
    }
    ?>
    <h1><span class="yanse3">发表博客</span></h1>
    <h2>
        <a href="_myblog.php">返回我的博客</a>
    </h2>
    <form action="_pushblogReg.php" method="post" onsubmit="return check()">
        <table align="center" border="1" style="border-collapse: collapse" cellpadding="10" cellspacing="0">
            <tr>
                <td align="right"><span class="yanse">标题</span></td>
                <td align="left"><input name="title_id"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right" valign="top"><span class="yanse">内容</span></td>
                <td align="left">
                    <textarea name="content" rows="10" cols="21" style="resize: vertical;"></textarea>
                    <span class="red">*</span>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">发布人昵称</span></td>
                <td align="left"><input name="username" placeholder="请勿更改昵称" value="<?php echo $info['username'];?>"><span class="red">请勿更改昵称</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">发布人身份证</span></td>
                <td align="left"><input name="sfz" placeholder="请勿更改身份证" value="<?php echo $info['sfz'];?>"><span class="red">请勿更改身份证</span></td>
            </tr>
            <tr>
                <td align="right"><input type="reset" value="重置"></td>
                <td align="left"><input type="submit" value="马上添加"></td>
            </tr>
        </table>
    </form>
</div>
<script>
    function check(){
        let title_id = document.getElementsByName('title_id')[0].value.trim();
        let content = document.getElementsByName('content')[0].value.trim();
        if(title_id.length == 0){
            alert('请输入标题!');
            return false;
        }
        if(content.length == 0){
            alert('请输入内容!');
            return false;
        }
        return true;
    }
</script>
</body>
</html>
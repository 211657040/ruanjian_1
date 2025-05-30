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
    <title>火车售票管理系统:修改</title>
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
        .logged{color:red}
        .error-message {
            color: #d016ea;
            /* 可以添加更多的样式，如字体大小、字体样式等 */
        }
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
    <h1><span class="yanse3">修改你的资料</span></h1>
    <?php
    if(isset($_SESSION['LoggedUsersfz']) && $_SESSION['LoggedUsersfz'] <> ''){
        ?>
        <div class="logged">已登录:<?php echo $_SESSION['LoggedUsersfz']; ?><span class="logout"><a href="logout.php">注销登录</a></span></div>
        <?php
    }
    ?>
    <h2>
        <a href="index.php">首页</a>
        <a href="login.php">登录</a>
    </h2>
    <form action="postModify.php" method="post" onsubmit="return check()">
        <table align="center" border="1" style="border-collapse: collapse" cellpadding="10" cellspacing="0">
            <tr>
                <td align="right"><span class="yanse">用户名</span></td>
                <td align="left"><input name="username" placeholder="修改你的用户名" value="<?php echo $info['username'];?>"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">密码</span></td>
                <td align="left"><input type="password" name="pw" placeholder="如不修改密码则不填"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">确认密码</span></td>
                <td align="left"><input type="password" name="cpw" placeholder="如不修改密码则不填"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">身份证号码</span></td>
                <td align="left"><input name="sfz" placeholder="请勿更改身份证" value="<?php echo $info['sfz'];?>"><span class="red">请勿更改身份证</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">电话号码</span></td>
                <td align="left"><input name="phone" placeholder="您要更改电话号码吗?" value="<?php echo $info['phone'];?>"><span class="red">请确认是否更改电话号码</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">性别</span></td>
                <td align="left">
                    <input type="radio" name="sex" value="1"><span class="yanse1">男</span>
                    <input type="radio" name="sex" value="2"><span class="yanse2">女</span>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">爱好</span></td>
                <td align="left">
                    <input type="checkbox" name="fav[]" <?php if(in_array( '打电动',$fav)){echo 'checked';}?> value="打电动"><span class="yanse0">打电动</span>
                    <input type="checkbox" name="fav[]" <?php if(in_array( '缘神启动',$fav)){echo 'checked';}?> value="缘神启动"><span class="yanse0">缘神启动</span>
                    <input type="checkbox" name="fav[]" <?php if(in_array( '我潮!原',$fav)){echo 'checked';}?> value="我潮!原"><span class="yanse0">我潮!原</span>
                </td>
            </tr>
            <tr>
                <td align="right"><input type="reset" value="重置"></td>
                <td align="left"><input type="submit" value="提交修改"></td>
            </tr>
        </table>
    </form>
</div>
<script>
    function check(){
        let username = document.getElementsByName('username')[0].value.trim();
        let pw = document.getElementsByName('pw')[0].value.trim();
        let cpw = document.getElementsByName('cpw')[0].value.trim();
        let sfz = document.getElementsByName('sfz')[0].value.trim();
        let phone = document.getElementsByName('phone')[0].value.trim();
        if(username.length == 0){
            alert('输入新的用户名?');
            return false;
        }
        let pwReg = /^[a-zA-Z0-9_*]{6,20}$/;
        if(pw.length > 0){
            if(!pwReg.test(pw)){
                alert('密码格式必须为6至20位，且只能包含大小写字母和数字和_或*');
                return false;
            }
            if(pw != cpw){
                alert('两次输入的密码都不一样了');
                return false;
            }
        }
        let sfzReg = /^[a-zA-Z0-9]{18}$/;
        if(!sfzReg.test(sfz)){
            alert('身份证的输入长度和字符必须合法！');
            return false;
        }
        let phoneReg = /^[a-zA-Z0-9]{11}$/;
        if(!phoneReg.test(phone)){
            alert('电话号码的输入长度和字符必须合法！');
            return false;
        }
        return true;
    }
</script>
</body>
</html>
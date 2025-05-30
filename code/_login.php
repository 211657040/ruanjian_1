<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录Anemoi</title>
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
        .yanse3{color: #7ad3fa}
    </style>
</head>
<body>
<div class="main">
    <h1><span class="yanse3">Anemoi 登录</span></h1>
    <h2>
        <a href="index.php">首页</a>
        <a href="singup.php">账户注册</a>
        <a href="login.php" class="curr">登录</a>
    </h2>
    <form action="postLogin.php" method="post" onsubmit="return check()">
        <table align="center" border="1" style="border-collapse: collapse" cellpadding="10" cellspacing="0">
            <tr>
                <td align="right"><span class="yanse">身份证号码</span></td>
                <td align="left"><input name="sfz"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">密码</span></td>
                <td align="left"><input type="password" name="pw"><span class="red">*</span></td>
            </tr>

            <tr>
                <td align="right"><span class="yanse">验证码</span></td>
                <td align="left">
                    <input name="captcha" placeholder="请输入图片中的验证码">
                    <img style="cursor: pointer" src="captcha.php" onclick="this.src='captcha.php?'+ new Date().getTime();" width = "190" height = "35">
                    <span class="red">*</span>
                </td>
            </tr>

            <tr>
                <td align="right"><input type="reset" value="重置"></td>
                <td align="left"><input type="submit" value="登录"></td>
            </tr>
        </table>
    </form>
</div>
<script>
    function check(){
        let sfz = document.getElementsByName('sfz')[0].value.trim();
        let pw = document.getElementsByName('pw')[0].value.trim();
        let sfzReg = /^[a-zA-Z0-9]{18}$/;
        if(!sfzReg.test(sfz)){
            alert('身份证的输入长度和字符必须合法！');
            return false;
        }
        let pwReg = /^[a-zA-Z0-9_*]{6,20}$/;
        if(!pwReg.test(pw)){
            alert('密码格式必须为6至20位，且只能包含大小写字母和数字和_或*');
            return false;
        }
        let captcha = document.getElementsByName('captcha')[0].value.trim();
        if(captcha === ""){
            alert('请填写验证码！');
            return false;
        }

        return true;
    }
</script>
</body>
</html>
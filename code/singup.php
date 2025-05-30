<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anemoi 注册</title>
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
        .pet {
            position: fixed;
            bottom: 0px;  /* 控制宠物图片距离底部的距离 */
            right: 10px;   /* 控制宠物图片距离右边的距离 */
            cursor: pointer;
            transition: transform 0.3s;
            width: 135px;  /* 缩小宠物图片的宽度 */
            height: auto;  /* 高度自适应，保持图片的比例 */
        }
        .pet:hover {
            transform: scale(1.1); /* 鼠标悬停时稍微放大 */
        }
        .pet img{
            width: 100%;
            height: auto;
        }
        .speech-bubble {
            position: absolute;
            bottom: 102%;  /* 调整这个值来将气泡放在宠物的头上 */
            right: 10px;
            background-color: #45eed5;
            border: 1px solid #0e100e;
            border-radius: 10px;
            padding: 4px;
            width: 175px;  /* 根据需要调整气泡的宽度 */
            text-align: center;
            display: none;  /* 默认不显示气泡 */
        }
        .speech-bubble::after {
            content: '';
            position: absolute;
            top: 100%;
            right: 50px;/* 调整角标左右移动 */
            border-width: 5px;
            border-style: solid;
            border-color: #95ea91 transparent transparent transparent;
        }

        .pet:hover .speech-bubble {
            display: block;  /* 当鼠标悬停在宠物上时显示气泡 */
        }
    </style>
</head>
<body>
<div class="main">
    <h1><span class="yanse3">Anemoi注册</span></h1>
    <h2>
        <a href="index.php">首页</a>
        <a href="singup.php" class="curr">账户注册</a>
        <a href="login.php">登录</a>
    </h2>
    <form action="postReg.php" method="post" onsubmit="return check()">
        <table align="center" border="1" style="border-collapse: collapse" cellpadding="10" cellspacing="0">
            <tr>
                <td align="right"><span class="yanse">用户名</span></td>
                <td align="left"><input name="username"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">密码</span></td>
                <td align="left"><input type="password" name="pw"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">确认密码</span></td>
                <td align="left"><input type="password" name="cpw"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">身份证号码</span></td>
                <td align="left"><input name="sfz"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">电话号码</span></td>
                <td align="left"><input name="phone"><span class="red">*</span></td>
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
                    <input type="checkbox" name="fav[]" value="打电动"><span class="yanse0">Anemoi</span>
                    <input type="checkbox" name="fav[]" value="缘神启动"><span class="yanse0">Air</span>
                    <input type="checkbox" name="fav[]" value="我潮!原"><span class="yanse0">Clannad</span>
                </td>
            </tr>
            <tr>
                <td align="right"><input type="reset" value="重置"></td>
                <td align="left"><input type="submit" value="马上提交"></td>
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
            alert('没有填写用户名怎么注册?');
            return false;
        }
        let pwReg = /^[a-zA-Z0-9_*]{6,20}$/;
        if(!pwReg.test(pw)){
            alert('密码格式必须为6至20位，且只能包含大小写字母和数字和_或*');
            return false;
        }
        if(pw != cpw){
            alert('两次输入的密码都不一样了');
            return false;
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
<div id="pet" class="pet">
    <img src="/photo/chongwu0.jpg" alt="Pet" id="petImage" style="max-width:100%;height:auto;">
    <div id="speechBubble" class="speech-bubble">你马上就会拥有你的账户啦~</div>
</div>

<script>
    var pet = document.getElementById('petImage'); // 获取宠物图片的元素
    var speechBubble = document.getElementById('speechBubble'); // 获取气泡元素
    var phrases = [
        "你马上就会拥有你的账户啦~",
        "首页的是西瓜棒姐姐~",
        "而我是棉花糖妹妹~",
        "姆咻咻咻咻咻~!",
        "天蓝色的发带,是我的宝物~",
        "欢迎回来~",
        "来吃刨冰吧!"
    ];
    var currentPhraseIndex = 0;

    pet.addEventListener('mouseover', function() {
        pet.src = '/photo/kaixin0.jpg'; // 鼠标悬停时更换图片
    });

    pet.addEventListener('mouseout', function() {
        pet.src = '/photo/chongwu0.jpg'; // 鼠标移出时恢复图片
    });

    pet.addEventListener('click', function() {
        currentPhraseIndex = (currentPhraseIndex + 1) % phrases.length; // 更新索引
        speechBubble.textContent = phrases[currentPhraseIndex]; // 更新气泡中的文字
    });
</script>
</body>
</html>
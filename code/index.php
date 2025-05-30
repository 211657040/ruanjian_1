<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shiroha</title>
    <style>
        body {
            background-image: url('/photo/tupian1.jpg');
            background-size: cover;
            background-position: top;
            margin: 0;
            height: 100vh;
            overflow: hidden;
        }

        h1{
            color: #cb8bec;
        }
        .main{width:80%;margin: 0 auto;text-align: center;}
        h2{font-size:21px;}
        h2 a{color:navy;text-decoration: none;margin-right: 15px;}
        h2 a:last-child{margin-right: 0;} /* 最后一个右标签没有右边距 */
        h2 a:hover{color:greenyellow;text-decoration: underline;}/*鼠标覆盖时，颜色+下划线 */
        .curr{color:darkorchid;}
        .logged{font-size: 16px;color: #e45ef6;margin-bottom: 20px;}
        .logout{margin-left:20px;}
        .logout a{color: #e136ee;text-decoration: none;}
        .logout a:hover{text-decoration: underline;}
        .pet {
            position: fixed;
            bottom: 0px;
            right: 10px;
            cursor: pointer;
            transition: transform 0.3s;
            width: 135px;
            height: auto;
        }
        .pet:hover {
            transform: scale(1.1);
        }
        .pet img{
            width: 100%;
            height: auto;
        }
        .speech-bubble {
            position: absolute;
            bottom: 80%;
            right: 10px;
            background-color: #45eed5;
            border: 1px solid #0e100e;
            border-radius: 10px;
            padding: 4px;
            width: 175px;
            text-align: center;
            display: none;
        }
        .speech-bubble::after {
            content: '';
            position: absolute;
            top: 100%;
            right: 50px;
            border-width: 5px;
            border-style: solid;
            border-color: #95ea91 transparent transparent transparent;
        }
        .pet:hover .speech-bubble {
            display: block;
        }
        #musicList {
            background: #f7f7f7;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 200px;
            padding: 15px;
            box-sizing: border-box;
            display: none; /* 隐藏音乐列表，只有点击音乐图标时才显示 */
            position: fixed;
            top: 60px;
            left: 20px;
        }

        .track {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
        }

        .track:hover {
            background-color: #e9e9e9;
        }

        .track button {
            white-space: nowrap;
            margin-left: 10px;
            background: #5cb85c;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .track button:hover {
            background-color: #449d44;
        }

        .track span {
            flex-grow: 1;
            margin-right: 10px;
            font-size: 16px;
            line-height: 1.5;
        }

    </style>
</head>
<body>


<div style="position: fixed; top: 20px; left: 20px; cursor: pointer;">
    <div id="musicIcon">🎵</div>
</div>

<div id="musicList" style="display: none; position: fixed; top: 60px; left: 20px; background: white; border: 1px solid #ccc; padding: 10px;">
    <div class="track" style="margin-bottom: 10px;">
        <span>White with You</span>
        <button onclick="togglePlay('track1')">播放</button>
    </div>


</div>

<audio id="track1" src="/bgm/WhitewithYou.mp3"></audio>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var musicIcon = document.getElementById('musicIcon');
        var musicList = document.getElementById('musicList');
        musicIcon.onclick = function(event) {
            event.stopPropagation();
            musicList.style.display = 'block';
        };
        document.addEventListener('click', function(event) {
            if (!musicList.contains(event.target) && event.target !== musicIcon) {
                musicList.style.display = 'none';
            }
        });
        window.togglePlay = function(trackId) {
            var track = document.getElementById(trackId);
            if (track.paused) {
                document.querySelectorAll('audio').forEach(function(audio) {
                    if (audio !== track) {
                        audio.pause();
                        audio.currentTime = 0; // 重置时间
                    }
                });
                track.play();
            } else {
                track.pause();
            }
        };
    });
</script>

<div class="main">
    <h1>8u</h1>
    <?php
    if(isset($_SESSION['LoggedUsersfz']) && $_SESSION['LoggedUsersfz'] <> ''){
        ?>
        <div class="logged">hi~:<?php echo $_SESSION['name']; ?> <?php if($_SESSION['isAdmin']) {?><span style="color:red">管理员</span><?php } ?> <span class="logout"><a href="logout.php">注销登录</a></span></div>
        <?php
    }
    ?>
    <h2>
        <a href="index.php" class="curr">首页</a>
        <a href="_myblog.php">我の博客</a>
        <a href="_blogcenter.php">博客中心の</a>
        <a href="_singup.php">账户注册</a>
        <a href="_login.php">登录</a>
        <a href="_modify.php">个人资料修改</a>


        <?php
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            echo '<a href="_admin.php">后台管理</a>';
        }
        ?>

    </h2>
</div>
<div id="pet" class="pet">
    <img src="/photo/chongwu.jpg" alt="Pet" id="petImage" style="max-width:100%;height:auto;">
    <div id="speechBubble" class="speech-bubble">打开音乐能听的歌叫做White with You 这是我的角色曲~</div>
</div>

<script>
    window.onload = function() {
        setTimeout(function() {
            document.getElementById('verticalText').style.display = 'block';
        }, 4000); // 背景图片动画 3s + 文字延迟 3s
    };

    var pet = document.getElementById('petImage'); // 获取宠物图片的元素
    var speechBubble = document.getElementById('speechBubble'); // 获取气泡元素
    var phrases = [
        "第一首歌叫做White with You 这是我的角色曲~",
        "我是小白羽~",
        "想听我给你唱歌嘛~",
        "夏日的天空漂浮着淡淡云朵~",
        "温热的气息伴着阵阵海风",
        "向大海伸出双手",
        "幻想有天能拥有",
        "梦中洁白翅膀,飞往青空",
        "梦里又看见千年前那个夏天~~...",
        "这是海妖姐姐唱过的夏影呐!",
        "还想再听呀",
        "仿佛是做了一个悠长的梦~",
        "对于新的生活",
        "也都已经习惯了的时候",
        "即便如此也会偶尔想起你来",
        "欢笑着,喧闹着,奔跑着,劳累了",
        "休息时,仰望着,沉浸到这片天蓝里~",
        "回过神来的瞬间已经漂浮于星海之中",
        "受伤了,苦恼了,懊悔了,迷茫了",
        "寻找着,失去了,又去寻找,再去寻找",
        "如果有你在就好了~",
        "谢谢!"
    ];
    var currentPhraseIndex = 0;

    pet.addEventListener('mouseover', function() {
        pet.src = '/photo/kaixin.jpg'; // 鼠标悬停时更换图片
    });

    pet.addEventListener('mouseout', function() {
        pet.src = '/photo/chongwu.jpg'; // 鼠标移出时恢复图片
    });

    pet.addEventListener('click', function() {
        currentPhraseIndex = (currentPhraseIndex + 1) % phrases.length; // 更新索引
        speechBubble.textContent = phrases[currentPhraseIndex]; // 更新气泡中的文字
    });
</script>


</body>
</html>

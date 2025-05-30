<?php
$id = $_GET['id'];
$title = $_GET['title']
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改我的博客</title>
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
    include_once 'conn.php';
    $sql = "select * from blog_posts where id = '".$id."'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){
        $info = mysqli_fetch_array($result);//把查到的资料抓取成数组
    }
    else{
        die("未找到有效博客内容");
    }
    ?>
    <h1><span class="yanse3">修改博客</span></h1>
    <h2>
        <a href="_admyblog.php">返回</a>
    </h2>
    <form action="_modifyblogReg.php" method="post">
        <table align="center" border="1" style="border-collapse: collapse" cellpadding="10" cellspacing="0">
            <tr>
                <td align="right"><span class="yanse">标题</span></td>
                <td align="left"><input name="title"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right" valign="top"><span class="yanse">内容</span></td>
                <td align="left">
                    <textarea name="content" rows="10" cols="21" style="resize: vertical;"></textarea>
                    <span class="red">*</span>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">主键id(请勿修改)</span></td>
                <td align="left"><input name="id" value="<?php echo $info['id'];?>"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">发布人(请勿修改)</span></td>
                <td align="left"><input name="created_at" value="<?php echo $info['created_at'];?>"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right"><span class="yanse">身份证(请勿修改)</span></td>
                <td align="left"><input name="create_sfz" value="<?php echo $info['create_sfz'];?>"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right"><input type="reset" value="重置"></td>
                <td align="left"><input type="submit" value="马上修改"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
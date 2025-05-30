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
    <title>博客管理</title>
    <style>
        body {
            background-image: url('/photo/tupian4.jpg');
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
        <a href="_myblog.php">我的博客</a>
        <a href="_admyblog.php"><span class="curr">博客管理</span></a>
        <a href="_blogcenter.php">博客中心</a>
    </h2>
    <?php
    include_once 'conn.php';
    include_once 'page.php';
    $sfz = $_SESSION['LoggedUsersfz'];
    $sql = "SELECT COUNT(id) AS total FROM blog_posts WHERE create_sfz = '$sfz'";
    $result = mysqli_query($conn, $sql);
    $info = mysqli_fetch_array($result);
    $total = $info['total'];//此时变量total存储总数
    $perPage = 5;//设置每一页显示几条
    $page = $_GET['page'] ?? 1;//读取当前页码,如果存在就读取该页码值,否则为1
    paging($total, $perPage);//引用分页函数
    $sql = "SELECT * FROM blog_posts WHERE create_sfz = '$sfz' ORDER BY id ASC LIMIT $firstCount, $perPage";
    //limit后面两参数传递从哪一个开始取,一次取多少条
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));//要是上处传参$perPage换成那个什么所谓的$displayPG,传参会报错?那是个什么东西
    }
    ?>
    <table border="1" cellspacing="0" cellpadding="10" style="border-collapse: collapse" align="center" width="90%">
        <tr>
            <td>序号</td>
            <td>主键id</td>
            <td>标题</td>
            <td>内容</td>
            <td>发布人</td>
        </tr>
        <?php
        $i = ($page - 1) * $perPage + 1;
        while ($info = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $info['id']; ?></td>
                <td><?php echo $info['title']?></td>
                <td><?php echo $info['content']; ?></td>
                <td><?php echo $info['created_at']; ?></td>
                <td><a href="javascript:del(<?php echo $info['id'];?>,'<?php echo $info['title'];?>');">删除博客</a>
                <td><a href="javascript:xiugai_(<?php echo $info['id'];?>,'<?php echo $info['title'];?>');">修改</a>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
    <?php
    echo $pageNav;
    ?>
</div>

<script>
    function del(id,name){
        if(confirm('确定删除博客:' + name + '?')){
            location.href='_delblog.php?id=' + id + '&title=' + name;
        }
    }
    function xiugai_(id,name){
        if(confirm('确定修改博客:' + name + '?')){
            location.href='_modifyblog.php?id=' + id + '&title=' + name;
        }
    }
</script>
</body>
</html>
<?php
include_once 'checkAdmin.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户管理</title>
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
        <a href="_admin.php">回到后台</a>
        <a href="_yonghuguanli.php"><span class="curr">用户管理</span></a>
    </h2>
    <?php
    include_once 'conn.php';
    include_once 'page.php';
    $sql = "select count(id) as total from userinfo";
    $result = mysqli_query($conn, $sql);
    $info = mysqli_fetch_array($result);
    $total = $info['total'];//此时变量total存储总数
    $perPage = 5;//设置每一页显示几条
    $page = $_GET['page'] ?? 1;//读取当前页码,如果存在就读取该页码值,否则为1
    paging($total, $perPage);//引用分页函数
    $sql = "select * from userinfo order by id asc limit $firstCount,$perPage";//limit后面两参数传递从哪一个开始取,一次取多少条
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));//要是上处传参$perPage换成那个什么所谓的$displayPG,传参会报错?那是个什么东西
    }
    ?>
    <table border="1" cellspacing="0" cellpadding="10" style="border-collapse: collapse" align="center" width="90%">
        <tr>
            <td>序号</td>
            <td>用户名</td>
            <td>性别</td>
            <td>身份证号</td>
            <td>电话</td>
            <td>爱好</td>
            <td>是否是管理员</td>
            <td>操作</td>
        </tr>
        <?php
        $i = ($page - 1) * $perPage + 1;
        while ($info = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $info['username']; ?></td>
                <td><?php echo $info['sex'] == 1 ? '男' : '女'; ?></td>
                <td><?php echo $info['sfz']; ?></td>
                <td><?php echo $info['phone']; ?></td>
                <td><?php echo $info['fav']; ?></td>
                <td><?php echo $info['admin'] == 1 ? '是' : '否'; ?></td>
                <td><?php if($info['username'] <> 'admin'){?> <a href="javascript:del(<?php echo $info['id'];?>,'<?php echo $info['username'];?>');">删除成员</a> <?php }?>
                    <?php if ($info['admin']) { if($info['username'] <> 'admin'){?><a href="setAdmin.php?action=0&id=<?php echo $info['id'];?>">取消管理员</a><?php } } else { ?><a href="setAdmin.php?action=1&id=<?php echo $info['id'];?>">设置管理员</a><?php } ?>
                    <?php if($info['username'] <> 'admin'){?> <a href="javascript:xiugai(<?php echo $info['id'];?>,'<?php echo $info['username'];?>');">修改</a> <?php }?>
                </td>

            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
    <?php
    echo $pageNav;
    ?>
    <table border="1" cellspacing="0" cellpadding="10" style="border-collapse: collapse" align="center" width="90%">
        <tr>
            <td><a href="_tianjiachengyuan.php">手动添加成员</a></td>
            <td><a href="_jinruchaxun.php">进入查询</a></td>
        </tr>
    </table>
</div>

<script>
    function del(id,name){
        if(confirm('确定删除成员:' + name + '?')){
            location.href='del.php?id=' + id + '&username=' + name;
        }
    }
    function xiugai(id,name){
        if(confirm('确定修改成员:' + name + '?')){
            location.href='xiugai0.php?id=' + id + '&username=' + name;
        }
    }
</script>
</body>
</html>
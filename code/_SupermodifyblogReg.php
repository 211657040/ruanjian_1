<?php
include_once 'checkAdmin';
header("Content-Type: text/html;charset=utf-8");
//在后端获取前端表单数据的方法是使用全局数组$_GET或S_POST  取决于前端form是怎么action过来的  singup 的method是"post"
//所以此处使用$_POST
$id = trim($_POST['id']);
$title = trim($_POST['title']);
$content = trim($_POST['content']);
$created_at = trim($_POST['created_at']);
$create_sfz = trim($_POST['create_sfz']);
include_once "conn.php";

$sql = "select * from blog_posts where id='$id'";
$result = mysqli_query($conn,$sql);
//对于这个select语句，mysqli_query执行以后返回的是一个记录集，将查询到的所有内容放入这个记录集集合里面
$num = mysqli_num_rows($result);//使用这个函数显示result，也就是那个记录集里面的行数，行数不为0则代表已注册该身份证
if(!$num){
    echo "<script>alert('出错了!未找到该博客');history.back();</script>";
    exit;
}

//写入内容，使用sql
$sql = "update blog_posts set title = '$title',content = '$content' where id = '$id'";
//此时这只是一个查询语句$sql，还未执行
$result = mysqli_query($conn,$sql);//对这个MySQL服务器的连接执行这个$sql查询语句进行插入,插入成功result为true
if($result){//下方输出由于php里面不能直接插入html语言...?，直接执行这个脚本进行弹框
    echo "<script>alert('修改成功!');location.href='_superadblog.php';</script>";
}
else{
    echo "<script>alert('修改失败!');location.href='_superadblog.php';</script>";
}

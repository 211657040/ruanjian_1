<?php
header("Content-Type: text/html;charset=utf-8");
//在后端获取前端表单数据的方法是使用全局数组$_GET或S_POST  取决于前端form是怎么action过来的  singup 的method是"post"
//所以此处使用$_POST
$title_id = trim($_POST['title_id']);
$content = trim($_POST['content']);
$username = trim($_POST['username']);
$sfz = trim($_POST['sfz']);
include_once "conn.php";



//写入内容，使用sql
$sql = "insert into blog_posts (title, content, created_at, create_sfz) 
        values ('$title_id', '$content', '$username', '$sfz')";
//此时这只是一个查询语句$sql，还未执行
$result = mysqli_query($conn,$sql);//对这个MySQL服务器的连接执行这个$sql查询语句进行插入,插入成功result为true
if($result){//下方输出由于php里面不能直接插入html语言...?，直接执行这个脚本进行弹框
    echo "<script>alert('发布成功!');location.href='_blogcenter.php';</script>";
}
else{
    echo "<script>alert('发布失败!');location.href='_myblog.php';</script>";
}

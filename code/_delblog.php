<?php
include_once "conn.php";
header('Content-Type: text/html; charset=utf-8'); // 设置文档类型和字符集

$id = $_GET['id'];
$title = $_GET['title'];
if(is_numeric($id)){
    $sql = "delete from blog_posts where id = $id";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "<script>alert('删除博客 $title 成功啦');location.href='_admyblog.php';</script>";
    }
    else{
        echo "<script>alert('删除博客 $title 失败的说!');history.back();</script>";
    }
}
else{
    echo "<script>alert('参数错误');history.back();</script>";
}
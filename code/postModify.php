<?php
header('Content-Type: text/html; charset=utf-8'); // 设置文档类型和字符集
$username = trim($_POST['username']);//定义一个全局变量username，将传输过来的POST中的"usernae"元素(这是刚才的设置的name，name用于标识前端数据)
$sfz = trim($_POST['sfz']);
$phone = trim($_POST['phone']);
$sex = $_POST['sex'];
$fav = implode(",",$_POST['fav']);
include_once "conn.php";
$sql = "update userinfo set username = '$username',sfz = '$sfz',phone = '$phone',sex = '$sex',fav = '$fav' where sfz = '$sfz'";
$url = 'index.php';
$result = mysqli_query($conn,$sql);
if($result){
    echo "<script>alert('更新资料成功!');location.href='$url';</script>";
}
else{
    echo "<script>alert('更新资料失败!');history.back();</script>";
}

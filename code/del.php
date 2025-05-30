<?php
include_once "checkAdmin";
include_once "conn.php";
header('Content-Type: text/html; charset=utf-8'); // 设置文档类型和字符集
$id = $_GET['id'];
$username = $_GET['username'];
if(is_numeric($id)){
    $sql = "delete from userinfo where id = $id";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "<script>alert('删除成员 $username 成功啦');location.href='yonghuguanli.php';</script>";
    }
    else{
        echo "<script>alert('删除成员 $username 失败的说!');history.back();</script>";
    }
}
else{
    echo "<script>alert('参数错误');history.back();</script>";
}
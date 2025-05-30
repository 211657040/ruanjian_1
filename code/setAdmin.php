<?php
include_once "checkAdmin.php";
header('Content-Type: text/html; charset=utf-8'); // 设置文档类型和字符集
$action = $_GET['action'];
$id = $_GET['id'];//拿到地址栏传参的两个参数,对哪个id进行设置(1)或取消(0)管理员权限.
if(is_numeric($action) && is_numeric($id)){
    if($action == 1 || $action == 0){//设置为管理员
        $sql = "update userinfo set admin = $action where id = $id";
    }
    else{
        echo "<script>alert('参数有误');history.back();</script>";
        exit;
    }
    include_once "conn.php";
    $result = mysqli_query($conn,$sql);
    if($action){
        $msg = '设置管理员';
    }
    else{
        $msg = '取消管理员';
    }
    if($result){//为真代表执行成功(代表查询没有出错)
        echo "<script>alert('{$msg}成功!');location.href='_yonghuguanli.php';</script>";
    }
    else{
        echo "<script>alert('{$msg}失败!');history.back();</script>";
    }
}
else{
    echo "<script>alert('参数有误');history.back();</script>";
    exit;
}
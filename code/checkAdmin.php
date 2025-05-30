<?php
//判断是不是管理员
session_start();
if(!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']){//isAdmin为空或者不为空但是为0就不是管理员，退到登录界面
    echo "<script>alert('没有管理员权限!ch!');location.href='login.php';</script>";
    exit;
}
?>
<?php
session_start();
header('Content-Type: text/html; charset=utf-8'); // 设置文档类型和字符集

$usersfz = trim($_POST['sfz']);
$pw = md5(trim($_POST['pw']));
$captcha = $_POST['captcha'];

if(strtolower($_SESSION['captcha']) == strtolower($captcha)){
    $_POST['captcha'] = '';
}
else{
    $_POST['captcha'] = '';
    echo "<script>alert('验证码输入错误!');location.href='login.php';</script>";
    exit;
}

include_once "conn.php";

$sql = "select * from userinfo where sfz='$usersfz' and pw = '$pw'";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);

if($num){
    $info = mysqli_fetch_array($result);
    $_SESSION['LoggedUsersfz'] = $usersfz;
    $_SESSION['name'] = $info['username'];
    if($info['admin']){
        $_SESSION['isAdmin'] = 1;
    }
    else{
        $_SESSION['isAdmin'] = 0;
    }
    echo "<script>alert('登录成功!');location.href = 'index.php';</script>";
}
else{
    unset($_SESSION['isAdmin']);
    unset($_SESSION['LoggedUsersfz']);
    unset($_SESSION['name']);
    echo "<script>alert('输入错误!请检查并重新输入!');history.back();</script>";
}
?>

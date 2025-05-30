<?php
header("Content-Type: text/html;charset=utf-8");
//在后端获取前端表单数据的方法是使用全局数组$_GET或S_POST  取决于前端form是怎么action过来的  singup 的method是"post"
//所以此处使用$_POST
$username = trim($_POST['username']);//定义一个全局变量username，将传输过来的POST中的"usernae"元素(这是刚才的设置的name，name用于标识前端数据)
$pw = trim($_POST['pw']);//trim函数用于将前后空格去掉
$cpw = trim($_POST['cpw']);
$sfz = trim($_POST['sfz']);
$phone = trim($_POST['phone']);
$sex = $_POST['sex'];
$fav = implode(",",$_POST['fav']);
include_once "conn.php";


//对输入的数据进行必要的验证  如用户名是否为空，是否被占用，身份证是否为空，密码是否一致
if(!strlen($username)||!strlen($pw)||!strlen($sfz)||!strlen($cpw)||!strlen($phone)){
    echo "<script>alert('用户名、密码、身份证或电话号码填写不完整');history.back();</script>";//history.back()让浏览器后退一步
    exit;//错误了之后直接退出，后面的代码不执行
}
if($pw!=$cpw){//两次输入密码必须相等
    echo "<script>alert('两次输入的密码不一致');history.back();</script>";
    exit;
}
//判断身份证是否被占用
$sql = "select * from userinfo where sfz='$sfz'";
$result = mysqli_query($conn,$sql);
//对于这个select语句，mysqli_query执行以后返回的是一个记录集，将查询到的所有内容放入这个记录集集合里面
$num = mysqli_num_rows($result);//使用这个函数显示result，也就是那个记录集里面的行数，行数不为0则代表已注册该身份证
if($num){
    echo "<script>alert('该身份证已经注册！');history.back();</script>";
    exit;
}







//写入内容，使用sql
$sql = "insert into userinfo (username,pw,sex,sfz,fav,createTime,phone) values ('$username','".md5($pw)."','$sex','$sfz','$fav','".time()."','$phone')";
//此时这只是一个查询语句$sql，还未执行
$result = mysqli_query($conn,$sql);//对这个MySQL服务器的连接执行这个$sql查询语句进行插入,插入成功result为true
if($result){//下方输出由于php里面不能直接插入html语言...?，直接执行这个脚本进行弹框
    echo "<script>alert('添加成功!');location.href='_yonghuguanli.php';</script>";
}
else{
    echo "<script>alert('添加失败!');location.href='index.php';</script>";
}

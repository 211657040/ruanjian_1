
<?php
// 确保这些参数匹配您在WDCP中创建的数据库信息
$db_host = "localhost"; // 或者WDCP提供的数据库服务器地址
$db_user = "yingxiao"; // 您创建的数据库用户名
$db_password = "wwww.!56."; // 您为数据库用户设置的密码
$db_name = "ruangong"; // 您创建的数据库名称

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if (!$conn) {
    die("连接数据库服务器失败: " . mysqli_connect_error());
} else {
    echo "Ciallo~";
}

mysqli_query($conn,"set names utf8");
mysqli_set_charset($conn, "utf8");
?>

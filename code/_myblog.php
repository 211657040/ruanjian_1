<?php
$db_host = "localhost"; // 或者WDCP提供的数据库服务器地址
$db_user = "yingxiao"; // 您创建的数据库用户名
$db_password = "wwww.!56."; // 您为数据库用户设置的密码
$db_name = "ruangong"; // 您创建的数据库名称

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if (!$conn) {
    die("连接数据库服务器失败: " . mysqli_connect_error());
}
mysqli_query($conn,"set names utf8");
mysqli_set_charset($conn, "utf8");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shiroha</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@300&display=swap" rel="stylesheet">
    <style>
        html {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            padding-top: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            width: 100%;
            padding: 0 20px;
            flex: 1;
        }
        header {
            background-image: url('/photo/smallphoto0.png'); /* 替换为你的GIF文件路径 */
            background-repeat: no-repeat;
            background-position: top; /* 或者你可以使用 'left', 'right', 'top', 'bottom' 来定位背景图片 */
            background-size: cover; /* 或者可以设置为 'contain' 根据你想要的效果 */
            color: #54e3f3;
            padding: 10px 0;
            text-align: center;
        }
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 1px 0;
            margin-top: auto;
        }
        .blog-post {
            background: #fff;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .blog-post h2 {
            border-bottom: 2px solid #eaeaea;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .blog-post p {
            margin-bottom: 20px;
        }
        .blog-post small {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }
            header, footer {
                text-align: left;
            }
        }
        .button-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .publish-button {
            display: inline-block;
            background-color: #54e3f3;
            color: white;
            padding: 10px 18px;
            margin-left: 10px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .publish-button:first-child {
            margin-left: 0;
        }

        .publish-button:hover {
            background-color: #40cbd6;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

    </style>
</head>
<body>

<header>
    <div class="container">
        <h1>约定,在风中</h1>
    </div>
</header>

<div class="container">
    <?php
    // 确认用户已经登录
    if (isset($_SESSION['LoggedUsersfz'])) {
        if (isset($_SESSION['LoggedUsersfz'])) {
            echo '<div class="button-group">
              <a href="index.php" class="publish-button">返回主页</a>
              <a href="_blogcenter.php" class="publish-button">博客中心</a>
              <a href="_admyblog.php" class="publish-button">管理博客</a>
              <a href="_pushblog.php" class="publish-button">+ 发表博客</a>
          </div>';
        }
        // 获取博客文章的SQL查询
        $sql = "SELECT id, title, content, created_at, create_sfz FROM blog_posts ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $found = false; // 用于检查是否找到属于该用户的博客
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['create_sfz'] === $_SESSION['LoggedUsersfz']) {
                    $found = true;
                    echo "<div class='blog-post'>";
                    echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
                    echo "<p>" . nl2br(htmlspecialchars($row["content"])) . "</p>";
                    echo "<small>Posted on: " . htmlspecialchars($row["created_at"]) . "</small>";
                    echo "<a href='_view_comments.php?blog_id=" . $row['id'] . "'>查看评论</a>";
                    echo "</div>";
                }
            }
            if (!$found) {
                echo "<p>还没有发表任何博客，快去发表吧</p>";
            }
        } else {
            echo "<p>No blog posts found.</p>";
        }
    } else {
        // 如果用户没有登录，重定向到登录页面
        header("Location: login.php");
        exit;
    }

    ?>
</div>

<footer>
    <div class="container">
        <p>版权所有 &copy; ruangong</p>
    </div>
</footer>

</body>
</html>
<?php
// 确保没有更多的输出
?>

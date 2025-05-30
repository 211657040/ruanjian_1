<?php
session_start();
include_once "conn.php"; // 数据库连接

if (!isset($_GET['blog_id'])) {
    die("未提供博客 ID");
}

$blog_id = intval($_GET['blog_id']);

// 获取博客内容
$blog_sql = "SELECT * FROM blog_posts WHERE id = $blog_id";
$blog_result = mysqli_query($conn, $blog_sql);
if (!$blog_result || mysqli_num_rows($blog_result) == 0) {
    die("博客不存在");
}
$blog = mysqli_fetch_assoc($blog_result);

// 获取评论
$comment_sql = "SELECT * FROM comment WHERE blog_id = $blog_id ORDER BY id DESC";
$comment_result = mysqli_query($conn, $comment_sql);
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>查看评论</title>
    <style>
        body {
            background-image: url('/photo/Shiroha_main.jpg');
            background-size: cover;
            background-position: top;
            margin: 0;
            min-height: 100vh;
            font-family: sans-serif;
        }
        h1{font-size:21px;}
        h1 a{color:navy;text-decoration: none;margin-right: 15px;}
        h1 a:last-child{margin-right: 0;} /* 最后一个右标签没有右边距 */
        h1 a:hover{color:greenyellow;text-decoration: underline;}/*鼠标覆盖时，颜色+下划线 */
    </style>
</head>


<body>
<h1>
    <a href="_myblog.php" class="publish-button">我的博客</a>
    <a href="_blogcenter.php" class="publish-button">博客中心</a>
</h1>
<h2>
    <?php echo htmlspecialchars($blog['title']); ?>
    <span style="font-size: 16px; color: lightgreen; margin-left: 10px;">
        作者：<?php echo htmlspecialchars($blog['created_at']); ?>
    </span>
</h2>
<p><?php echo nl2br(htmlspecialchars($blog['content'])); ?></p>
<hr>
<h3>评论详情：</h3>
<?php
if (mysqli_num_rows($comment_result) > 0) {
    while($comment = mysqli_fetch_assoc($comment_result)) {
        echo "<p><strong>" . htmlspecialchars($comment['commenter']) . "：</strong>" .
            nl2br(htmlspecialchars($comment['comment_text'])) . "</p><hr>";
    }
} else {
    echo "<p>还没有评论</p>";
}
?>

<div id="commentModal">
    <form action="_addcomments.php" method="post">
        <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
        <input type="hidden" name="commenter" value="<?php echo htmlspecialchars($_SESSION['name']); ?>">
        <p><strong>昵称：</strong><?php echo htmlspecialchars($_SESSION['name']); ?></p>
        <p><strong>添加评论：</strong><br>
            <textarea name="comment_text" rows="4" cols="40" required></textarea>
        </p>
        <p>
            <button type="submit">提交</button>
        </p>
    </form>
</div>

</html>

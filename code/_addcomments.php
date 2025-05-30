<?php
include_once "conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blog_id = intval($_POST['blog_id']);
    $commenter = trim($_POST['commenter']);
    $comment_text = trim($_POST['comment_text']);

    // 校验非空
    if (!empty($commenter) && !empty($comment_text)) {
        $sql = "INSERT INTO comment (blog_id, comment_text, commenter) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "iss", $blog_id, $comment_text, $commenter);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: _view_comments.php?blog_id=" . $blog_id);
                exit;
            } else {
                echo "评论提交失败：" . htmlspecialchars(mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "数据库错误：" . htmlspecialchars(mysqli_error($conn));
        }
    } else {
        echo "请填写完整评论内容。";
    }

    mysqli_close($conn);
} else {
    echo "非法访问。";
}
?>

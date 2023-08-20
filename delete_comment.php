<!-- delete_comment.php -->
<?php
$db_host = 'localhost';
$db_user = 'username';
$db_pass = 'password';
$db_name = 'database_name';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("データベース接続エラー: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];

    $query = "DELETE FROM comments WHERE id = $comment_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: index.html"); // リストページにリダイレクト
    } else {
        echo "コメントの削除に失敗しました。";
    }
}
?>

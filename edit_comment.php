<!-- edit_comment.php -->
<?php
$db_host = 'localhost';
$db_user = 'username';
$db_pass = 'password';
$db_name = 'database_name';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("データベース接続エラー: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment_id']) && isset($_POST['edited_content'])) {
    $comment_id = $_POST['comment_id'];
    $edited_content = $_POST['edited_content'];

    $query = "UPDATE comments SET content = '$edited_content' WHERE id = $comment_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: index.html"); // リストページにリダイレクト
    } else {
        echo "コメントの編集に失敗しました。";
    }
}
?>

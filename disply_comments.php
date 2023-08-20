<!-- display_comments.php -->
<?php
$query = "SELECT * FROM comments";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='comment'>";
    echo "<p>" . htmlspecialchars($row['content']) . "</p>";
    echo "<span class='edit-button' onclick='showEditForm(" . $row['id'] . ")'>編集</span>";
    echo "<span class='delete-button' onclick='deleteComment(" . $row['id'] . ")'>削除</span>";

    // 編集フォーム
    echo "<div class='edit-form' id='edit-form-" . $row['id'] . "'>";
    // ... 編集フォームの内容 ...
    echo "</div>";

    echo "</div>";
}
?>

<?php 





date_default_timezone_set("Asia/Tokyo");

$comment_array = array();
$pdo = null;
$stmt = null;

//DB接続
try{
    $pdo = new PDO('mysql:host=localhost;dbname=bbs-youtube',"root");
    }catch(PDOException $e){
        echo $e->getMessage();
    
    }
    

//フォームを打ち込んだ時
if(!empty($_POST["submitButton"])){

//名前のチェック
if(empty($_POST["username"])){
    echo "名前を入力してください。";
}
//コメントのチェック
if(empty($_POST["comment"])){
    echo "コメントを入力してください。";
}

$postDate = date("Y-m-d H:i:s");


    try{
    $stmt = $pdo->prepare("INSERT INTO `bbs-table` (`username`, `comment`, `postDate`) VALUES (:username, :comment, :postDate)");
    $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
    $stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
    $stmt->bindParam(':postDate', $postDate, PDO::PARAM_STR);

    $stmt->execute();
    }catch(PDOException $e) {
        echo $e->getMessage();
}
}



//DBからコメントデータを取得する
$sql = "SELECT `id`,`username`,`comment`,`postDate` FROM`bbs-table`;";
$comment_array  = $pdo->query($sql);

//DBの接続を閉じる
$pdo = null;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP掲示板</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="title">PHPで掲示板アプリ</h1>
    <div class="boardWrapper">
    <section>
        <?php foreach($comment_array as $comment): ?>
    <article>
    <div class="wrapper">
        <div class="nameArea">
            <span>名前：</span>
            <P class="username"><?php echo $comment ["username"]; ?></P>
            <time>:<?php echo $comment ["postDate"]; ?></time>
            <input type="submit" value="削除"><br/>

        </div>
        <p class="comment"><?php echo $comment ["comment"]; ?></p>
    </div>
    </article>
    <?php endforeach; ?>
    </section>

    <form class="formWrpper" method="POST">
    <div>
        <input type="submit" value="書き込む" name="submitButton">
        <label for="">名前：</label>
        <input type="text" name="username">
    </div>
    <div>
        <textarea calss="commentTextArea" name="comment"></textarea>
    </form>
</body>
</html>
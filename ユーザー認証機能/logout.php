<?php
session_start();

//ログアウトする時は、セッションの内容をdestroyで消去する。その前にセッションに空の配列を入れている。
//var_dump($_SESSION);　
$_SESSION = array();

// セッションクッキーを削除する。これはセッション削除とセットで覚える。このまま決まり文句として。
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 1800, '/');
  }
session_destroy();
//var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト画面</title>
    <link rel="stylesheet" type="text/css" href="./functions&css/style.css">
</head>
<body>
<?php include 'menu.php';?>
<br>
<p>ログアウトしました。</p>
</body>
</html>
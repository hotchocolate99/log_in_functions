<?php
session_start();
//var_dump($_SESSION['user']['user_name']);
//var_dump($user['user_name']); 
//↑　上ではユーザー名確認できるのに、nullになるのなぜ？？　答えvar_dumpの場所の問題。定義する前は当然NULL。定義後は当然代入されているのが確認できる

//ログインフォームで、セッションのログインの値をtrueにすることでログイン中としたけど、
//もしtureでなければ、ログインページに飛ばしてあげる。
if (!$_SESSION['login']) {
    header('Location: login.php');
    exit();
  }

  //「$_SESSION["user"]」には、ログインフォームで入力されたアドレスとDBの
  //それとを照会した上で、DBにある、そのユーザーの情報を全て配列にして入れてある。それを＄userに代入して、
  //マイページにログイン中のユーザーのデータ（名前）を表示する。
  if ($_SESSION['login']= true) {
    $user = $_SESSION['user'];
  }
  //var_dump($user);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
    <link rel="stylesheet" type="text/css" href="./functions&css/style.css">
</head>
<body>

<?php include 'menu.php';?>

<div class="container">

<h1><?php echo $user['user_name'];?>さんのマイページ</h1>

 <div class="bg-example">
    <br>
    <p>ログインユーザー&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<?php echo $user['user_name'];?>&nbsp;&nbsp;&nbsp;さん</p>
    <br>
    <a href="logout.php">ログアウト</a>
</body>
</html>



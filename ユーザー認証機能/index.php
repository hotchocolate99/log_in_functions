<?php
require_once './functions&css/function.php';

$errors =[];

ini_set('display_errors', true);
//if(!empty($_POST)){}がないと、最初からフォーム画面にエラーメッセージが表示される。
if(!empty($_POST)){

$user_name = $_POST['user_name'];
if(!$user_name || 20 < strlen($user_name)){
    $errors[] = '名前を入力して下さい。';
}

$email = $_POST['email'];
if(!$email || !filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors[] = 'メールアドレスを入力して下さい。';
}

require_once './functions&css/database.php';
require_once './functions&css/user_logic.php';
$dbh = dbconnect();
  $user = UserLogic::findUserByEmail($dbh,$email);
if($user){
    $errors[] = 'このメールアドレスは使えません。';
}

$password = $_POST['password'];
if(!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)){
    $errors['password'] = 'パスワードは英数字８文字以上１００文字以下にしてください。';
}

$password_conf = $_POST['password_conf'];
if($password !== $password_conf){
    $errors[] = '確認用パスワードが間違っています。';
}

if(count($errors) === 0){

    require './functions&css/user_logic.php';

     $hasCreated = UserLogic::createUser($_POST);
     header('Location:registered.php');

     if(!$hasCreated){
        $errors[] = '登録に失敗しました';
     }
    }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録画面</title>
    <link rel="stylesheet" type="text/css" href="./functions&css/style.css">
</head>

<body>

<?php include 'menu.php';?>

<div class="container">

<h1>ユーザー登録</h1>

<?php if(isset($errors)): ?> 
    <ul class="error-box">
    <?php foreach($errors as $error): ?> 
        <li><?php echo $error; ?></li>
    <?php endforeach ?> 
    </ul>
  <?php endif ?>

 <div class="bg-example">
    <form action="index.php" method="post">
        <div class="form-group">
            <label for="exampleInputName">名前</label><br>
            <input type="text" name="user_name" id="exampleInputName"  placeholder="名前" value="<?php if(isset($_POST['name'])){echo h($name);}?>" placeholder="メールアドレス"required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail">メールアドレス</label><br>
            <input type="email" name="email" id="exampleInputEmail" value="<?php if(isset($_POST['email'])){echo h($email);}?>" placeholder="メールアドレス" required>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword">パスワード</label><br>
            <input type="password" name="password" id="exampleInputPassword" value="<?php if(isset($_POST['password'])){ echo h($password);}?>" placeholder="パスワード" required>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword_conf">パスワード確認</label><br>
            <input type="password" name="password_conf" id="exampleInputPassword_conf" value="<?php if(isset($_POST['password_conf'])){echo h($password_conf);}?>" placeholder="パスワード" required>
        </div>

        <button class="btn" type="submit">登録</button>

        </form>
    </div>
</div>
</body>
</html>
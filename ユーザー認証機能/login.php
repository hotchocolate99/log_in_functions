<?php
session_start();

ini_set('display_errors', true);

require_once './functions&css/user_logic.php';
require_once './functions&css/function.php';
//var_dump($user);
//↑nullになる。。。なぜ？？
//↓はちゃんと配列になってユーザーのデータが入っている。なのに＄userに代入できない。
//var_dump($_SESSION['user']);

//空欄のままかと言うバリデーションではなく、入力されたアドレスとパスワードが、DBのと合っているかの照会。
$errors = [];


if(!empty($_POST)){
  require_once './functions&css/database.php';
  $dbh = dbconnect();
  $user = UserLogic::findUserByEmail($dbh,$_POST['email']);
//↑　＄userに入っている物は？　UserLogicクラスの静的なfindUserByEmailメソッドで、取得した物＝引数であるログインフォームに入力された
//アドレスを使ってDBに入っているユーザーを見つけ、そのユーザーの全ての情報取得した。配列になっている。
  //var_dump($user);
//↓をやっても＄userの中身はNULLなので、動かない。↑もアドレスでなくパスワードを間違えているのに↑のメッセージが出てしまう。なので、
//下の’パスワードが違います’を’アドレスかパスワードが違います’にするべき。
  //if(!$user['email']){
    //$errors['email'] = 'メールアドレスが違います。';
  //}
  //var_dump($user['email']);
  //上もNULL
  //パスワードの照会 ↓のメソッドは結果をtureかfalseで返すので、if文。第一引数がログインフォームで入力されたパスワード、第二引数がDBに
  //入っているハッシュ化されたパスワード。
  // trueならログイン状態にする。falseならエラーメッセージを出す
  if($user){
    
  if (password_verify($_POST['password'], $user['password'])){
      //まずセッションインジェクション対策で、ログインしたら新しいセッションを作る。書き方は　「session_regenerate_id(true);」とそのまま覚える。
      //マイページにセッションを渡すことでログイン状態にする。セッションのキーを以下のように指定して、マイページに遷移させる。
       session_regenerate_id(true);
       $_SESSION['login'] = true;
       $_SESSION['user'] = $user;
       header('Location: mypage.php');
       exit();

    }else{
      $errors[] = 'パスワードが違います。';
    }
    }

  if(!$user){
      $errors[] = 'メールアドレスが違います。';
  }
  }

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインフォーム画面</title>
    <link rel="stylesheet" type="text/css" href="./functions&css/style.css">
</head>

<body>
<?php include 'menu.php';?>
 
   <div class="container">

      <h1>ログイン</h1>
      <?php if(isset($errors)): ?> 
      <ul class="error-box">
  　　  <?php foreach($errors as $error): ?> 
    　     <li><?php echo $error; ?></li>
  　　   <?php endforeach;?>
  　　  </ul>
     <?php endif;?> 

        <div class="bg-example">
            <form action="login.php" method="post">

                <div class="form-group">
                    <label for="exampleInputEmail">メールアドレス</label><br>
                    <input type="email" name="email" id="exampleInputEmail" value="<?php if(isset($_POST['email'])){echo h($_POST['email']);}?>" required>
                    <!--上で、if文を使わず、echo〜とすると、エラーになる。POSTはグロバール変数だから初回アクセスなのか２回目アクセスなのか処理を切り分けられない。なので初回アクセス時にはもし値が入っていたらと条件をつける-->
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword">パスワード</label><br>
                    <input type="password" name="password" id="exampleInputPassword" value="<?php if(isset($_POST['password'])){echo h($_POST['password']);}?>" required>
                </div>

                <button class="btn" type="submit">ログイン</button><br>
                <div class="jump"><a href="index.php">新規登録はこちら</a></div>
                <div class="jump"><a href="password_reset.php">パスワードの再発行はこちら</a></div>

            </form>
        </div>
    </div>
</body>
</html>
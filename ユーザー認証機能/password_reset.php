<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>未完成　パスワード再発行</title>
    <link rel="stylesheet" type="text/css" href="./functions&css/style.css">
</head>

<body>
<?php include 'menu.php';?>
 
   <div class="container">

      <h1>未完成　パスワードの再発行</h1>
  
        <div class="bg-example">
            <form action="registred.php" method="post">

                <div class="form-group">
                    <label for="exampleInputEmail">メールアドレス</label><br>
                    <input type="email" name="email" id="exampleInputEmail" value="<?php if(isset($_POST['email'])){echo h($_POST['email']);}?>" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword">新パスワード</label><br>
                    <input type="password" name="password" id="exampleInputPassword"  required>
                </div>

                <div class="form-group">
                   <label for="exampleInputPassword_conf">パスワード確認</label><br>
                   <input type="password" name="password_conf" id="exampleInputPassword_conf"  required>
                </div>

               <button class="btn" type="submit">登録</button>


                
                
                

            </form>
        </div>
    </div>
</body>
</html>
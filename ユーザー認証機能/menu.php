 <header>
   <div class="navi">
      <ul>
      <!--↓　ログインとマイページを参照。「$_SESSION['user']」が存在する時＝ログイン状態-。
      ログイン状態でない時は、ユーザー登録とログインのメニューを表示する。-->
      
      <?php if(empty($_SESSION['user'])):?>
        <li><a href="index.php">ユーザー登録</a></li>
        <li><a href="login.php">ログイン</a></li>
      <?php else:?>
        <li><a href="logout.php">ログアウト</a></li>
      <?php endif;?>
      </ul>
   </div>

   <div class="clearlist"></div>
 </header>
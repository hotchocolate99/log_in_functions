<?php
require_once 'database.php';

//ini_set('display_errors', true);


class UserLogic{


  /** ユーザー登録
   * ＠param array $userData
   * return bool $result
  */
    public static function createUser($userData){

      $result = false;
        $sql = 'INSERT INTO users (user_name, email, password) VALUES(?,?,?)';

      //sign_upファイルの方でこのcreateUserメソッドの呼び出し時に引数にPOSTを入れた。そのため、POSTがこの＄userDataに
      //入り、＄userData[name]とすることで、＄＿POST[name]の値が取得できる。
      //パスワードはここでハッシュ化すること！！　DBに入れる時！「password_hash(パスワード,PASSWORD_DEFAULT);」 とする。
      //第二引数は決まり文句。意味：デフォルトでハッシュ化する。

        $arr = [];
          $arr[] = $userData['user_name'];
          $arr[] = $userData['email'];
          $arr[] = password_hash($userData['password'],PASSWORD_DEFAULT);

        try{
          $stmt = dbconnect()->prepare($sql);
          $result = $stmt->execute($arr);
              return $result;
        }catch(\Exception $e){
            return $result;
        }
    }
         //↑プレースホルダーの値が文字列のものだけ、または、数字でも文字列として扱ってもOKな場合は、＄arrのように配列にして、
         //$execute()の引数に入れることが出来る。bindValue使わなくても大丈夫。


  /**
   * email,DBでユーザーを取得
   * ＠param string $dbh 
   * ＠param string $email 
   * return array   (ログインフォームに入力されたアドレスでDBに入っているデータを検索し、照会できたらそのユーザーの登録情報全てを配列で取得)
   */
  public static function findUserByEmail($dbh, $email){
    $data[] = $email;

    try{
      $sql = 'SELECT * FROM users WHERE email = ?';
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
       return $user;
    }catch(\Exception $e){
      exit();
    }
  }

}




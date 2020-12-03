<?php 
//ini_set('display_errors',true);

function dbconnect(){

define('DB_HOST', 'localhost');
define('DB_NAME', 'workshop');
define('DB_USER', 'workshop_user');
define('DB_PASSWORD', 'mayumitoronto123');
define('DB_PORT', '8889');
$options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false, 
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"];


//上の１２行目は「＄dbh=setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);」をtryのインスタンス生成の下に書いても同じ。
//文字化け対策
//$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'");

//PHPのエラーを表示するように設定　E_NOTICE（注意メッセージ）以外の全てのエラーを表示する。
error_reporting(E_ALL & ~E_NOTICE);

//データベースの接続
try{
    $dbh = new PDO('mysql:host='.DB_HOST .';port= '.DB_PORT. ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, $options);
    //echo '接続成功';

}catch(PDOException $e){
 echo $e->getMessage();
 exit('接続失敗');
}
return $dbh;

}

//echo dbconnect();


?>
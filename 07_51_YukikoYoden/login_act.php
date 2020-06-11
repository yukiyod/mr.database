<?php
session_start(); //session変数 ページを跨いで同じ値を使える変数
$lmail = $_POST["lmail"];
$lpw = $_POST["lpw"];

//1. 接続します
try {
  $pdo = new PDO('mysql:dbname=MR_database;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．データ取得SQL作成
$sql = "SELECT * FROM mrdb_user_table WHERE u_mail=:lmail AND u_pw=:lpw"; //idもpassもマッチしてれば
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lmail', $lmail);
$stmt->bindValue(':lpw', $lpw);
$res = $stmt->execute(); //エラー対策

//SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//３．抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法

//４. 該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){  //idが空でない場合
  $_SESSION["chk_ssid"]  = session_id(); //ブラウザごとにsessionスタートしたらユニークきーを渡す
  $_SESSION["u_name"]   = $val['u_name']; //ページを跨いで"hogeさんようこそ"と名前を表示させるためにsessionで入れている
  //Login処理OKの場合kern.phpへ遷移
  header("Location: kern.php");
}else{
  //Login処理NGの場合login.phpへ遷移
  header("Location: login_error.php");
}
//処理終了
exit();
?>
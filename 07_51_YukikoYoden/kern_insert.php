<?php
session_start();
$u_name=$_SESSION['u_name'];

//session idのチェック
session_start();

include("funcs.php"); //今は同じ階層なのでこの書き方でOK
loginCheck();

//入力チェック(受信確認処理追加)
if (
  !isset($_POST["genre"])|| $_POST["genre"] ==""||  //genreがpostされてなくて、値が空っぽなら
  !isset($_POST["s_title"])|| $_POST["s_title"] ==""||
  !isset($_POST["o_title"])|| $_POST["o_title"] ==""||
  !isset($_POST["composer"])|| $_POST["composer"] ==""||
  !isset($_POST["kern"])|| $_POST["kern"] ==""
){
  exit('ParamEroor');
}

//1. POSTデータ取得
$genre = $_POST["genre"];
$s_title = $_POST["s_title"];
$o_title = $_POST["o_title"];
$composer = $_POST["composer"];
$kern = $_POST["kern"];



//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=MR_database;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());//全角チェックテスト
}
//このエラーならそもそもdbへの接続方法で問題がある


//３．データ登録SQL作成 //別の言語なので、文字列として準備する。bind変数を使ってエスケープ処理をしている。
//:a1としているのは、この中に直接$nameなどの変数を入れられない。
//bindvalueを使うと、よくない文字を無効化してくれる。
//excuteで実行
//statusに実行できたかできてないかの情報も格納される。
$stmt = $pdo->prepare("INSERT INTO mrdb_kern_table(id,genre,s_title,o_title,composer,kern,contributor,indate)
VALUES(NULL,:a1,:a2,:a3,:a4,:a5,:a6,sysdate())");
$stmt->bindValue(':a1', $genre, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $s_title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $o_title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $composer, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $kern, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a6', $u_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]); //このエラーなら、sqlの書き方に問題がある。
}else{

  //５．$stateusがfalseでなければ index.phpへリダイレクト
  //header関数の中へ飛ぶようになっている
  //index.phpの前に半角スペースを入れる
header('Location: kern_registered.php');

}
?>

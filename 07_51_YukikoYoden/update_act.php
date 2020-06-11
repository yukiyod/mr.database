<?php
session_start();
$u_name=$_SESSION['u_name'];

//1.POSTでid,name,email,naiyouを取得
$id = $_POST["id"];
$genre = $_POST["genre"];
$s_title = $_POST["s_title"];
$o_title = $_POST["o_title"];
$composer = $_POST["composer"];
$kern = $_POST["kern"];

//2.DB接続
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=MR_database;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());//全角チェックテスト
  }

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
$sql = 'UPDATE mrdb_kern_table SET genre=:genre,s_title=:s_title,o_title=:o_title,composer=:composer,kern=:kern  WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':genre',  $genre,  PDO::PARAM_STR);
$stmt->bindValue(':s_title',  $s_title,  PDO::PARAM_STR);
$stmt->bindValue(':o_title',  $o_title,  PDO::PARAM_STR);
$stmt->bindValue(':composer',  $composer,  PDO::PARAM_STR);
$stmt->bindValue(':kern',  $kern,  PDO::PARAM_STR);
$stmt->bindValue(':id',  $id,  PDO::PARAM_INT);    //更新したいidを渡す
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //select.phpへリダイレクト
  header("Location: select_log.php");
  exit;

}



?>
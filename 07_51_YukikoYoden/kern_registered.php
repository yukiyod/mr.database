<?php

//session idのチェック
session_start();

include("funcs.php"); //今は同じ階層なのでこの書き方でOK
loginCheck();

$u_name=$_SESSION['u_name'];

//1.  DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=MR_database;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }
  
  //２．データ取得SQL作成 (login中のユーザーが登録したdataのみ表示)
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM mrdb_kern_table WHERE contributor = '$u_name'");
  $status = $stmt->execute();


  $count = $stmt->fetchColumn(); 

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>registered</title>
<link rel="stylesheet" href="CSS/style.css" />
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header class="h_kern">
    <h1 class="logo_title">MR.Database</h1>
  <nav class="kern_nav">
      <ul class="kern_nav_list">
      <li><a href="kern.php">Contribute database</a></li>
          <li><a href="select_log.php">Use database</a></li>
          <li><a href="logout.php">LOGOUT</a></li>
      </ul>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<h1>Thank you!</h1>
<h1>New kern data has registered!</h1>
<h2>Your contribute data = <?=$count?> </h2>
<h3>Current Status = "♩"</h3>
<!-- Main[End] -->

</body>
</html>

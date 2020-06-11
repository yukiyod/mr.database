<?php

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=MR_database;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM mrdb_kern_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  //fetchという関数で整形している。1行ずつ取り出すという関数。全件数を1行ずつループさせて$resultに入れ込んでいる
  // .=は、上書きしないという処理。ドットがないと最後のデータのみしか表示されない
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    // $view .= "<p>";
    // $view .= $result['indate'].':'.$result['name'].' '.$result['email'].' '.$result['text'];
    // $view .= "</p>";
     $view .="<tr>";
     $view .="<td>".$result["genre"]."</td>";
     $view .="<td>".$result["s_title"]."</td>"."<td>".$result["composer"]."</td>";
     $view .="<td>";
     $view .='<a href = "get_kern.php?id='.$result["id"].'">'; //idを埋め込んで出してくれる
     $view .=$result["o_title"]."</td>";
     $view .='</a>';
     $view .="</tr>";
  }

}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>data list</title>
<link rel="stylesheet" href="CSS/style.css" />
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header class="h_kern">
    <h1 class="logo_title">MR.Database</h1>
  <nav class="kern_nav">
      <ul class="kern_nav_list">
          <li><a href="login.php">Back to Top</a></li>
      </ul>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<p class="getkern_ex">Click the Title to get the Kern data!</p>
<div>
<table>
<tr><th>Genre</th><th>ScoreTitle</th><th>Composer</th><th>Title</th></tr>
    <div class="select_list"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>

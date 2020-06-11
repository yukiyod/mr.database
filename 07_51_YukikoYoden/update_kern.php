<?php
//session idのチェック
session_start();

include("funcs.php"); //今は同じ階層なのでこの書き方でOK
loginCheck();


//1.GETでid値を取得
$id = $_GET["id"]; //urlにくっついてきてるのでgetで受け取る
// echo $id;


//2.DB接続など
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=MR_database;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }


//3.SELECT * FROM gs_an_table WHERE id=:id;
$stmt = $pdo->prepare("SELECT * FROM mrdb_kern_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //idは絶対数値なのでint
$status = $stmt->execute();


//4.データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  //idで取る場合は、絶対１つ
  $row = $stmt->fetch();
  //$row["id"], $row["name"]...

}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Kern data</title>
  <link rel="stylesheet" href="CSS/style.css" />
</head>
<body>

<!-- Head[Start] -->
<header class="h_kern">
    <h1 class="logo_title">MR.Database</h1>
  <nav class="kern_nav">
      <ul class="kern_nav_list">
      <li><a href="select_log.php">Use database</a></li>
          <li><a href="select_u.php">your database list</a></li>
          <li><a href="logout.php">LOGOUT</a></li>
      </ul>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<form method="post" action="update_act.php">
  <div class="kern_r_form">
   <fieldset>
    <legend>Edit the Kern data</legend>  
    <label>Genre &ensp; <select name="genre" id="genre">
        <option disabled selected value><?=$row["genre"]?></option>
        <option value="Classical">Classical</option>
        <option value="FilmScore">FilmScore</option>
        <option value="EthnicMusic">Ethnic Music</option>
    </select></label><br>
     <label>Score Title &ensp; <input type="text" name="s_title" value="<?=$row["s_title"]?>" ></label><br>
     <label>Opus Title &ensp; <input type="text" name="o_title" value="<?=$row["o_title"]?>" ></label><br>
     <label>Composer &ensp; <input type="text" name="composer" value="<?=$row["composer"]?>"></label><br>
     <label class="label">Kern Data&ensp; <textArea name="kern" rows="10" cols="40"><?=$row["kern"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <input type="submit" value="Update!">
    </fieldset>
  </div>
</form>


<div class="humdrum">
    <a href="https://verovio.humdrum.org/" target="_blank" rel="noopener noreferrer" >Go to Verovio Humdrum Viewer</a>
</div>
<!-- Main[End] -->

<script>
        function copyToClipboard() {
            // コピー対象をJavaScript上で変数として定義する
            var copyTarget = document.getElementById("kern");

            // コピー対象のテキストを選択する
            copyTarget.select();

            // 選択しているテキストをクリップボードにコピーする
            document.execCommand("Copy");

            // コピーをお知らせする
            alert("Copied to Clipboard" );
        }
    </script>
</body>
</html>




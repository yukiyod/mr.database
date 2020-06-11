<?php
session_start();
$u_name=$_SESSION['u_name'];

//session idのチェック

include("funcs.php"); //今は同じ階層なのでこの書き方でOK
loginCheck();



?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="CSS/style.css" />
  
</head>
<body>

<!-- Head[Start] -->
<header class="h_kern">
    <h1 class="logo_title">MR.Database</h1>
  <nav class="kern_nav">
      <ul class="kern_nav_list">
          <li><a href="select_log.php">Use database</a></li>
          <li><a href="select_u.php">Your database list</a></li>
          <li><a href="logout.php">LOGOUT</a></li>
      </ul>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<h3>hello <?=$u_name?></h3>

<form method="post" action="kern_insert.php">
  <div class="kern_r_form">
   <fieldset>
    <legend>Register Kern Data</legend>  
    <label>Genre &ensp; <select name="genre" id="genre">
        <option disabled selected value>Choose...</option>
        <option value="Classical">Classical</option>
        <option value="FilmScore">FilmScore</option>
        <option value="EthnicMusic">Ethnic Music</option>
    </select></label><br>
     <label>Score Title &ensp; <input type="text" name="s_title"></label><br>
     <label>Opus Title &ensp; <input type="text" name="o_title"></label><br>
     <label>Composer &ensp; <input type="text" name="composer"></label><br>
     <label class="label">Kern Data&ensp; <textArea name="kern" rows="10" cols="40"></textArea></label><br>
     <input type="submit" value="Register">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
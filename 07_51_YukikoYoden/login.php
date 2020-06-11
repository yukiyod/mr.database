<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="CSS/style.css" />
<title>Login</title>
</head>
<body>
    <header></header>
<!--title-->
<div class="title">
    <h1 class="maintitle" >MR.Database</h1>
    <div class="logo">
        <img src="./img/mr_db.png" alt="">
    </div>
    <p class="title_ex">Database for Music Researchers</p>
</div>
<!--form parts-->
<div class="forms">
<!--for members-->
    <form method="post" action="login_act.php">
        <div class="mem_box">
            <p class="mbox_title">Login to Your Account</p>
            <input class="textbox" type="text" name="lmail" placeholder="Email"><br>
            <input class="textbox" type="text" name="lpw" placeholder="Passward"><br>
            <input class="login_btn" type="submit" value="Login">
            <div class="gtcreat">
                <p class="gtc1">Not a Member Yet?&nbsp;&nbsp;&nbsp;</p> 
                <p class="gtc2">Creat an Account</p>  
            </div>
        </div>
    </form>
<!--for guests-->
    <div class="guest_box">
        <p class="mbox_title">For Guest</p>
        <div class="gbox_title">
        <a href="select.php">Use Datebase</a>
        </div>
    </div>
</div>
<!-- Main[End] -->
</body>
</html>
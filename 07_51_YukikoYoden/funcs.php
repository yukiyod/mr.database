<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//LOGIN認証チェック関数
function loginCheck(){
    if( !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
        echo "LOGIN ERROR";
        exit();
      }else{
        session_regenerate_id(true);
        $_SESSION["chk_ssid"]= session_id();
      }
}

?>
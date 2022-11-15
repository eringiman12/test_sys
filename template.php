<?php
  session_start();
  include_once './function_folda/function_DB_conect.php';
  include_once './function_folda/function.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./asset/css/Month_Calender.css">
        <link rel="stylesheet" href="./asset/css/header.css">
    <script type="text/javascript" src="./asset/js/main.js"></script>
    <script type="text/javascript" src="./asset/js/real_time.js"></script>
    <title>顧客管理システム</title>
  </head>
  <header>
    <div class="container">
      <ul class="menu">
        <h1 class="jisha"><a href="./index.php">home</a></h1>
        <p class="Today_01"><?php echo date("Y.m.d"."(".$week[$date].")")?></p>
        <p id="RealtimeClockArea"></p>
        <li class="menu-multi">
            <a href="#" class="init-bottom">管理システム</a>
            <ul class="menu-second-level">
                <li>
                  <a href="kokyaku_kanri.php" class="init-right">顧客管理</a>
                </li>
                <li>
                  <a href="#" class="init-right">請求管理</a>
                </li>
                <li>
                  <a href="#" class="init-right">予実管理</a>
                </li>
                <li>
                  <a href="#" class="init-right">案件管理</a>
                </li>
                <li>
                  <a href="#" class="init-right">売掛管理</a>
                </li>
                <li>
                  <a href="./Shain_kanri.php" class="init-right">社員管理</a>
                </li>
            </ul>
        </li>
        <li class="menu-multi">
            <a href="#" class="init-bottom">申請</a>
            <ul class="menu-second-level">
                <li>
                  <a href="#" class="init-right">変更届</a>
                </li>
            </ul>
        </li>
        <li class="menu-multi">
            <a href="#" class="init-bottom">確認</a>
            <ul class="menu-second-level">
                <li>
                  <a href="./Henko_Log.php" class="init-right">月間カレンダー</a>
                </li>
                <li>
                  <a href="./Henko_Log.php" class="init-right">変更履歴</a>
                </li>
            </ul>
        </li>
        <li class="menu-multi">
            <a href="#" class="init-bottom">アカウント情報</a>
            <ul class="menu-second-level">
                <li>
                  <h3 style="color:white;"><?php echo $_SESSION['USER_NAME'];?></h3>
                </li>
                <li>
                  <a href="#" class="init-right">ログオフ</a>
                </li>
            </ul>
        </li>
      </ul>
    </div>
  </header>

  <body>
    <table>

    </table>
  </body>
</html>
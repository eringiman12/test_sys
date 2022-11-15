<?php
  include_once './function_folda/function.php';
  // include_once './function_folda/function_DB_conect.php';
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./asset/css/header.css">
    <link rel="stylesheet" href="./asset/css/TOP.css">
    <script type="text/javascript" src="./asset/js/real_time.js"></script>
    <title>てｓｔ</title>
  </head>
  <header>
    <!-- ログイン情報と時間 -->
    <div class="header_block">
      <div class="header_Box">
        <h1><a href="./index.php">てｓｔ</a></h1>
      </div>
      <div class="header_Box">
        <p>Masagent Customer DataBase</p>
      </div>
      <div class="header_Box">
        <p>ユーザー名</p>
      </div>
      <div class="time_hyoji">
        <p><?php echo date("Y.m.d"."(".$week[$date].")")?></p><br/>
        <p id="RealtimeClockArea"></p>
      </div>
    </div>
    
    <!-- 顧客管理ボタンエリア -->
    <div class="kokayku_bottun">
      <!-- 管理用ボタン -->
      <ul>
        <li><a href="./kokyaku_kanri.php">顧客管理表</a></li>
        <li>変更届</li>
        <li><a href="./yojitu.php">予実管理</a></li>
        <li><a href="./seikyu_kanri.php">請求管理</a></li>
        <li>応対記録</li>
        <!-- <li>業務手順</li> -->
        <li><a href="./anken_top.php">案件管理</a></li>
      </ul>

      <div class="seeach_box">
        <form action="" method="post">
          <input type="search" name="search" placeholder="">
          <select name="example">
            <option value="">選んでください</option>
            <option value="フリガナ">フリガナ</option>
            <option value="商号">商号</option>
            <option value="役職">役職</option>
            <option value="代表者">代表者</option>
            <option value="住所">住所</option>
            <option value="電話番号">電話番号</option>
          </select>
          <input type="submit" name="submit" value="検索">
        </form>
      </div>
    </div>
  </header>

  <body>
  </body>

</html>
<?php
    include_once './function_folda/function.php';
    // 予実管理項目を配列に格納
    $seikyu_status = array("未","自","333","てｓｔ","税","顧問料顧問料顧問料顧問料顧問料顧問料顧問料","","","1000","32,000","3,200","35,200","","","11月より、30000→32000円に下がりました。");
    $seikyu_title = array("ステータス","決済","コード","顧客名","請求元","請求内容","数量","単位","単価","金額","消費税","合計","特記事項","売掛金","修正等");
    
    // 請求テーブル数
    $seikyu_tables_kazu = array();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./asset/css/header.css">
    <link rel="stylesheet" href="./asset/css/seikyu.css">
    <script type="text/javascript" src="./asset/js/real_time.js"></script>
    <title>てｓｔ_予実管理</title>
  </head>
  <header>
    <div class="container">
      <ul class="menu">
        <div class="mokuji">
          <h1 class="jisha"><a href="./index.php">てｓｔ</a></h1>
          <p class="Today_01"><?php echo date("Y.m.d"."(".$week[$date].")")?></p>
          <p id="RealtimeClockArea"></p>
        </div>
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
                <?php if($_SESSION['access'] == 1) {?>
                  <li>
                    <a href="./Shain_kanri.php" class="init-right">社員管理</a>
                  </li>
                <?php }?>
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
            <?php if($_SESSION['access'] == 1) {?>
            <ul class="menu-second-level">
              <li>
                <a href="./Month_Calender.php" class="init-right">月間カレンダー</a>
              </li>
              <li>
                <a href="./Henko_Log.php" class="init-right">変更履歴</a>
              </li>
            </ul>
            <?php }?>
        </li>
        <li class="menu-multi">
            <a href="#" class="init-bottom">アカウント情報</a>
            <ul class="menu-second-level">
                <li>
                  <p class="User_Name"><?php echo $_SESSION['USER_NAME'];?></p>
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
    <div class="seikyu_box">
      <table class="seikyu_table">
        <tr>
          <?php  foreach($seikyu_title as $value) {?>
              <th>
                  <?php echo $value;?>
              </th>
          <?php }?>
        </tr>
        <?php  for ($i = 1; $i <= 15; $i++) {?>
          <tr>
            <?php foreach($seikyu_status as  $key => $value) {?>
              <?php if($key == 0 || $key == 1 || $key == 2 || $key == 4 || $key == 6 || $key == 7 || $key == 8 || $key == 9 || $key == 10 || $key == 11 ) {?>
                <th width="10"><?php echo $value; ?></th>
              <?php } else {?>
                <th width="70"><?php echo $value; ?></th>
              <?php }?>

            <?php }?>
          </tr>
        <?php }?>
      </table>
    </div>
  </body>

</html>
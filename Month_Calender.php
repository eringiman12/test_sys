<?php
  include_once './function_folda/Page.php';
  include_once './function_folda/function_DB_conect.php';
  include_once './function_folda/function.php';
  include_once './function_folda/function_week_config.php'; 
  
  if(!empty($_SESSION['POST_WEEk'])) {
    $st_monday_array = $_SESSION['POST_WEEk'];
    $st_monday_array02 = $_SESSION['POST_WEEk_hikaku'];
  } 

  $Youbi = array(
    "月",
    "火",
    "水",
    "木",
    "金",
    "土",
    "日"
  );


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./asset/css/Month_Calender.css">
        <link rel="stylesheet" href="./asset/css/header.css">
    <script type="text/javascript" src="./asset/js/main.js"></script>
    <script type="text/javascript" src="./asset/js/real_time.js"></script>
    <title>てｓｔ</title>
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
    <div class="week_select">
      <p><a href="./function_folda/function_week_config.php?sensyu=<?php echo $st_monday_array02[0];?>">＜先週 </a>|</p>
      <p><a href="./function_folda/function_week_config.php?today=today"> 本日 </a>|</p>
      <p><a href="./function_folda/function_week_config.php?raisyu=<?php echo $st_monday_array02[6];?>">翌週 ></a></p>
    </div>
    <table class="Calender_table">
      <tr>
        <th><?php echo date('Y');?></th>
        <?php  foreach($st_monday_array as $val) {?>
          <th><?php echo $val;?></th>
        <?php }?>
      </tr>
      <?php foreach($Scejyule_Member as $key => $sce_val) {?>
        <tr>
          <td valign="top" class="member"><p><?php echo $sce_val[1]?></p></td>
          <?php  foreach($st_monday_array02 as $val02) {?>
            <?php if($val02 == date("m/j")) {?>
              <td><?php echo date("m/j");?></td>
              <td style="border:2px solid orange;"><?php echo $val02;?>
                <div id="<?php echo $sce_val[1].$val02;?>" class="overlay">
                  <div class="Event_input">
                    <h1>HI</h1>
                    <p>イベント入力日付:<?php echo $sce_val[1].$val02;?></p>
                    <button onclick="off('<?php echo $sce_val[1].$val02;?>')">閉じる</button>
                  </div>	
                </div>
                <a class="open" onclick="on('<?php echo $sce_val[1].$val02;?>')"></a>
              </td>
            <?php } else {?>
              <td>
                <div id="<?php echo $sce_val[1].$val02;?>" class="overlay">
                  <div class="Event_input">
                    <h1>HI</h1>
                    <p>イベント入力日付:<?php echo $sce_val[1].$val02;?></p>
                    <button onclick="off('<?php echo $sce_val[1].$val02;?>')">閉じる</button>
                  </div>	
                </div>
                <a class="open" onclick="on('<?php echo $sce_val[1].$val02;?>')"></a>
              </td>
            <?php }?>
          <?php }?>
        </tr>
      <?php }?>
    </table>
  </body>
</html>
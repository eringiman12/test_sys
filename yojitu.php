<?php
    include_once './function_folda/function.php';
    // あ管理項目を配列に格納
    $yojitu = array("月次","決算料","消費税","予定納税","年末調整","社労士","行政","その他");
    // あ管理の項目の最後
    $end = end($yojitu);
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./asset/css/header.css">
    <link rel="stylesheet" href="./asset/css/yojitu.css">
    <script type="text/javascript" src="./asset/js/real_time.js"></script>
    <title>てｓｔ_あ管理</title>
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
        <li><a href="./yojitu.php">あ管理</a></li>
        <li><a href="./seikyu_kanri.php">請求管理</a></li>
        <li>応対記録</li>
        <!-- <li>業務手順</li> -->
        <li><a href="./anken_top.php">案件管理</a></li>
      </ul>

      <!-- 検索エリア -->
      <div class="seeach_box">
        <form action="" method="post">
          <input type="search" name="search" placeholder="">
          <select name="example">
            <option value="項目1">項目1</option>
            <option value="項目2">項目2</option>
            <option value="項目3">項目3</option>
          </select>
          <input type="submit" name="submit" value="検索">
        </form>
      </div>
    <div>
  </header>

  <body>
    <table class="yojitu_table">
        <tr>
            <th><?php echo date('Y')-1 .'年';?></th>
            <?php  for ($i = 1; $i <= 13; $i++) {?>
                <?php if($i == 13) {?>
                <th>
                    <?php echo '合計';?>
                </th>
                <?php } else {?>
                <th>
                    <?php echo $i.'月';?>
                </th>
                <?php }?>
            <?php }?>
        </tr>
        <?php foreach($yojitu as $value) {?>
            <tr>
                <td width="400">
                    <?php echo $value; ?>
                </td>
                <?php for($l = 1; $l <= 13; $l++) {?>
                    <td width="200"></td>
                <?php }?>
            </tr> 
        <?php }?>
        <tr>
            <td colspan="13"></td>
            <td>　</td>
        </tr>
    </table>
    <div class="arrow"><p>COPY</p></div>

    <!-- コピー用後で修正 -->
    <table class="yojitu_copy">
        <tr>
            <th><?php echo date('Y').'年';?></th>
            <?php  for ($i = 1; $i <= 13; $i++) {?>
                <?php if($i == 13) {?>
                <th>
                    <?php echo '合計';?>
                </th>
                <?php } else {?>
                <th>
                    <?php echo $i.'月';?>
                </th>
                <?php }?>
            <?php }?>
        </tr>
        <?php foreach($yojitu as $value) {?>
            <tr>
                <td>
                    <?php echo $value; ?>
                </td>
                <?php for($l = 1; $l <= 13; $l++) {?>
                    <td></td>
                <?php }?>
            </tr> 
        <?php }?>
        <tr>
            <td colspan="13"></td>
            <td>　</td>
        </tr>
    </table>

</table>
  </body>

</html>
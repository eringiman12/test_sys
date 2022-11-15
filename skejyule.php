<?php
$today = date("Y年n月j日");
$today_No = date("j");

$to_month = date('Y年n月', mktime(0, 0, 0, date('n') , 1, date('Y')));
$next_month = date('Y年n月', mktime(0, 0, 0, date('n') + 1, 1, date('Y')));

// 現在の年月を取得
$year = date('Y');
$year_next =  date('Y', mktime(0, 0, 0, date('n') + 1, 1, date('Y')));

//今月と来月
$month = date('n');
$month_next =  date('n', mktime(0, 0, 0, date('n') + 1, 1, date('Y')));


//予約時間格納
$yoyaku_time_NO = array('10:00～12:00','12:00～14:00','14:00～16:00','16:00～18:00');
 
//二か月先を格納
for ($i=1; $i < 62; $i++) { 
    $two_month_day[] =  date("Y年n月j日", strtotime($i."day"));
}

//二か月先の日付+予約時間
foreach ($two_month_day as $o_key) {
   foreach ($yoyaku_time_NO as $y_key) {
       $Yoyaku_Time_two_mon[] = $o_key.$y_key;
   }
}

// 月末日を取得
$last_day = date('j', mktime(0, 0, 0, $month + 1, 0, $year));
echo $last_day;
$nextend = new DateTime('last day of next month');
$nextday =  $nextend->format('d');

$calendar = array();

$j = 0;
$l = 0;

// 月末日までループ
for ($i = 1; $i < $last_day + 1; $i++) {
    // 曜日を取得
    $week = date('w', mktime(0, 0, 0, $month, $i, $year));
        // 1日の場合
        if ($i == 1) {
            // 1日目の曜日までをループ
            for ($s = 1; $s <= $week; $s++) {
                // 前半に空文字をセット
                $calendar[$j]['day'] = '';
                $j++;
            }
        }
        
        // 配列に日付をセット
        $calendar[$j]['day'] = $i;
        $j++;

        // 月末日の場合
        if ($i == $last_day) {
            // 月末日から残りをループ
            for ($e = 1; $e <= 6 - $week; $e++) {
                // 後半に空文字をセット
                $calendar[$j]['day'] = '';
                $j++;
            }
        }
}

// 月末日までループ
for ($i = 1; $i < $nextday + 1; $i++) {
    // 曜日を取得
    $week = 6 -date('w', mktime(0, 0, 0, $month, 1, $year));
        // 1日の場合
        if ($i == 1) {
            // 1日目の曜日までをループ
            for ($s = 1; $s <= $week; $s++) {
                // 前半に空文字をセット
                $calendar_next[$j]['day'] = '';
                $j++;
            }
        }
        
        // 配列に日付をセット
        $calendar_next[$j]['day'] = $i;
        $j++;

        // 月末日の場合
        if ($i == $nextday) {
            // 月末日から残りをループ
            for ($e = 1; $e <= 6 - $week; $e++) {
                // 後半に空文字をセット
                $calendar_next[$j]['day'] = '';
                $j++;
            }
        }
}

$array_item = array();
//セレクトボックスの値
if(isset($_POST["yoyaku_day_select"])) {
    // セレクトボックスで選択された値を受け取る
    $yoyaku_Post = $_POST["yoyaku_day_select"]; 
    // 受け取った値を画面に出力
}

?>

<!DOCTYPE html>
<html lang="ja">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="./stylesheet.css"/>
<script src="sample.js"></script>
</head>
<header>
    <div class="container">
      <ul class="menu">
        <div class="mokuji">
          <h1 class="jisha"><a href="./index.php">tesDB</a></h1>
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

<div class= "mont_box">    
    <h2 class="month_title"><?php echo $to_month; ?></h2>
    <form action="calender.php" method="POST">

        <table class="table_claass">
            <tr>
                <th style="color:red;">日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th style="color:#000066;">土</th>
            </tr>
            <tr>
            <?php $cnt = 0; ?>
            <?php foreach ($calendar as $key => $value): ?>
                <?php $cnt++; ?>
                <?php if (!empty($value['day'])): ?>
                    <?php if($today_No >= $value['day']){?>
                        <td>
                            <?php $array_item  =   $value['day'];?>
                            <?php echo $array_item."<br/>×";?>
                        </td>
                    <?php } else {?>
                        <td>
                            <?php $array_item  =   $value['day'];?>
                            <button type="submit" name="submit_item" class = "button_month" value="<?php echo  $array_item;?>"><?php echo  $array_item;?><br/>〇</button>
                        </td>
                    <?php } ?>
                <?php else:?>
                <td></td>
                <?php endif; ?>
            <?php if ($cnt == 7): ?>
            </tr>
            <tr>
            <?php $cnt = 0; ?>
            <?php endif; ?>
            <?php endforeach; ?>
            </tr>
        </table>
    </form>
<br/>
<br/>
    <h2 class="month_title"><?php echo $next_month; ?></h2>
    <form action="calender.php" method="POST">
        <table>
            <tr>
                <th style="color:red;">日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th  style="color:#000066;">土</th>
            </tr>
            <tr>
            <?php $cnt = 0; ?>
            <?php foreach ($calendar_next as $key => $value): ?>
                <?php $cnt++; ?>
                <?php if (!empty($value['day'])): ?>
                        <td>
                            <?php $array_item  =   $value['day'];?>
                            <button type="submit" name="submit_item_next" class= "button_month" value="<?php echo  $array_item;?>"><?php echo  $array_item;?><br/>〇</button>
                        </td>
                <?php else:?>
                <td></td>
                <?php endif; ?>
            <?php if ($cnt == 7): ?>
            </tr>
            <tr>
            <?php $cnt = 0; ?>
            <?php endif; ?>
            <?php endforeach; ?>
            </tr>
        </table>
    </form>
</div>

<div class="yoyaku_hyouji">
    <form class="yoyaku_hyouji_form"  action="./index.php" method = "POST">
        <select name="yoyaku_day_select" class="select_box">
            <option value="" label="日付を選択してください"></option>
            <?php foreach ($two_month_day as $key) {?>
                <option value="<?php echo $key;?>" label="<?php echo $key;?>"><?php echo $key;?></option>
            <?php }?>
        </select>
        <input type="hidden" name="token" value="<?php echo $token;?>">
        <button type="submit" name="submit" class="button_yoyaku"   value="予約を確認" >予約を確認</button></a>
    </form>
    <br/>
    <h2 class="yoyaku_time">〇予約が開いている・×予約が入っている</h2>
    <div class="time_hyoujji">
        <!--予約時間-->
        <?php if (!empty($yoyaku_Post)) { ?>
            <h2 class="yoyaku_time_h2"><?php echo $yoyaku_Post;?></h2>
            <!--選択日付予約確認-->
            <div class="marubatu">
                <?php foreach ($yoyaku_time_NO as $key) { ?>
                    <!--選択した日付をDB内配列と比べて予約時間を判定-->
                    <?php if (array_search($yoyaku_Post.$key, $array_days_yoyaku) !== false) {?>
                        <div class="batu"><?php echo $key;?>×</div>
                    <?php } else {?>
                        <div class="maru"><?php echo $key;?>〇</div>
                    <?php }?>
                <?php }?>
            </div>
        <?php } else { ?>
            <h2 class="yoyaku_time_h2"><?php echo $today;?></h2>
            <!--本日予約確認-->
            <?php foreach ($yoyaku_time_NO as $key) { ?>
                <!--本日の予約をDB内配列と比べるy-->
                <?php if (array_search($today.$key, $array_days_yoyaku) !== false) {?>
                    <div class="batu"><?php echo $key;?>×</div>
                <?php } else {?>
                    <div class="maru"><?php echo $key;?>〇</div>
                <?php }?>
            <?php }?>
        <?php } ?>
    </div>
    <br />
</div>
    
</body>
</html>
</body>
</html>


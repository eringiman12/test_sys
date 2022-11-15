<?php
  if(!empty($_GET['raisyu']) || !empty($_GET['sensyu']) || !empty($_GET['today'])) {
    session_start();
    unset($_SESSION['POST_WEEk']);
    unset($_SESSION['POST_WEEk']);
  }

  $Youbi = array(
    "（月）",
    "（火）",
    "（水）",
    "（木）",
    "（金）",
    "（土）",
    "（日）"
  );
  $Youbi02 = array_reverse($Youbi);

  
  // 先週来週ボタンを押す
  if(!empty($_GET['raisyu'])) {
    create_week_array($_GET['raisyu'],"+",$Youbi,"rai");
    header("Location: ../Month_Calender.php");
  } else if(!empty($_GET['sensyu'])) {
    create_week_array($_GET['sensyu'],"-",$Youbi02,"sen");
    header("Location: ../Month_Calender.php");
  } else {
    $today = date("Ymd");
    $ymd_time = strtotime($today);
    $week_num = date("w",$ymd_time);

    if ($week_num == 0){
    //日曜日だった場合
      $monday = date('Ymd', strtotime("-6 day", $ymd_time));
    }else{
      $ymd_time = $ymd_time + 24*60*60;
      $monday = date('Ymd', strtotime("-{$week_num} day", $ymd_time));
    }
    $a = 0;
    for($i=0;$i < 7;$i++) {
      $st_monday_array[] = date("n/d",strtotime("{$monday} +{$i} day")).$Youbi[$a];
      $st_monday_array02[] = date("n/d",strtotime("{$monday} +{$i} day"));
      $a++;
    }

    if(!empty($_GET['today'])) {
      $_SESSION['POST_WEEk'] = $st_monday_array;
      $_SESSION['POST_WEEk_hikaku'] = $st_monday_array02;
      header("Location: ../Month_Calender.php");

    }

  }  

// 先週と来週の配列作成
function create_week_array($Get_week,$pm,$Youbi_array,$Status) {
    // 先週一週間処理
    $theDate = new DateTime($Get_week);
    $today = $theDate->format('n/d');
    $a = 0;
    for($i=1;$i < 8;$i++) {
      $eb = date("n/d",strtotime("{$today} {$pm}{$i} day")).$Youbi_array[$a];
      $e = date("n/d",strtotime("{$today} {$pm}{$i} day"));
      $st_monday_array[] = $eb;
      $st_monday_array02[] = $e;
      $a++;
    }
    if($Status == "rai") {
      $_SESSION['POST_WEEk'] = $st_monday_array;
      $_SESSION['POST_WEEk_hikaku'] = $st_monday_array02;
    } else {
      $_SESSION['POST_WEEk'] = array_reverse($st_monday_array);
      $_SESSION['POST_WEEk_hikaku'] = array_reverse($st_monday_array02);
    }

}
  
?>
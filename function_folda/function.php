<?php
  // 時間表記
  $week = array(
            "日",
            "月",
            "火",
            "水",
            "木",
            "金",
            "土"
          ); 
  $date = date("w");
          
  if(!strpos($_SERVER["REQUEST_URI"],'index')) {
    if(empty($_SESSION['USER_NAME'])) {
      session_destroy();
      header("Location: http://○○");
    } 
  }

?>
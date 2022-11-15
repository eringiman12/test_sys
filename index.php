<?php
session_start();
if (!empty($_GET['user'])) {
   $_SESSION['USER_NAME'] = $_GET['user'];
   header("Location: ./function_folda/function_check.php");
} else {
   if (empty($_SESSION['Descnets_name'])) {
      session_destroy();
      header("Location: http://○○");
   }
}
include_once './function_folda/Page.php';
include_once './function_folda/function.php';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="./asset/css/main.css">
   <link rel="stylesheet" href="./asset/css/header.css">
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/hot-sneaks/jquery-ui.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   <script type="text/javascript" src="./asset/js/main.js"></script>
   <script type="text/javascript" src="./asset/js/real_time.js"></script>
   <title>てｓｔ</title>
</head>
<header>
   <div class="container">
      <ul class="menu">
         <div class="mokuji">
            <h1 class="jisha"><a href="./index.php">てｓｔ</a></h1>
            <p class="Today_01"><?php echo date("Y.m.d" . "(" . $week[$date] . ")") ?></p>
            <p id="RealtimeClockArea"></p>
         </div>
         <li class="menu-multi">
            <a href="#" class="init-bottom">管理システム</a>
            <ul class="menu-second-level">
               <li>
                  <a href="search_kekka.php" class="init-right">顧客管理</a>
                  <ul class="menu-third-level">
                     <!-- 第二階層 -->
                     <li>
                        <a href="./Tokuisaki.php" class="init-right">件数表</a>
                     </li>
                  </ul>
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
               <?php if ($_SESSION['access'] == 1) { ?>
                  <li>
                     <a href="./Shain_kanri.php" class="init-right">社員管理</a>
                  </li>
               <?php } ?>
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
            <?php if ($_SESSION['access'] == 1) { ?>
               <ul class="menu-second-level">
                  <li>
                     <a href="./Month_Calender.php" class="init-right">月間カレンダー</a>
                  </li>
                  <li>
                     <a href="./Henko_Log.php" class="init-right">更新履歴</a>
                  </li>
               </ul>
            <?php } ?>
         </li>
         <li class="menu-multi">
            <a href="#" class="init-bottom">アカウント情報</a>
            <ul class="menu-second-level">
               <li>
                  <p class="User_Name"><?php echo $_SESSION['USER_NAME'] . $_SESSION['access']; ?></p>
               </li>
               <li>
                  <a href="./function_folda/function_DB_conect.php?LogOFF=LogOFF" class="init-right">ログオフ</a>
               </li>
            </ul>
         </li>
      </ul>
   </div>
</header>

<body>
   <div class="Main_Block">
      <div class="Uriage_kanri">
         <div class="uriage_head">
            <p>売上管理</p>
            <p><?php echo date('Y年n月'); ?>
            <p>
            <p>会計部　○○　○○　売上：100万 予算：2000万 達成率：50%
            <p>
         </div>
         <div class="Graf">
            <img src="./asset/img/グラフ01.jpg">
            <img src="./asset/img/グラフ02.jpg">
            <img src="./asset/img/グラフ03.jpg">
         </div>
         <div class="scrol_table">
            <table border="2">
               <tr>
                  <th class="midashi" rowspan="2">取引先</th>
                  <th class="midashi" colspan="4">第1四半期</th>
                  <th class="midashi" colspan="4">第2四半期</th>
                  <th class="midashi" colspan="4">第3四半期</th>
                  <th class="midashi" colspan="4">第4四半期</th>
                  <th class="midashi">統計</th>
               </tr>

               <tr>
                  <td class="month">1月</td>
                  <td class="month">2月</td>
                  <td class="month">3月</td>
                  <td class="month">計</td>
                  <td class="month">4月</td>
                  <td class="month">5月</td>
                  <td class="month">6月</td>
                  <td class="month">計</td>
                  <td class="month">7月</td>
                  <td class="month">8月</td>
                  <td class="month">9月</td>
                  <td class="month">計</td>
                  <td class="month">10月</td>
                  <td class="month">11月</td>
                  <td class="month">12月</td>
                  <td class="month">計</td>
                  <td class="month">合計金額</td>
               </tr>
               <?php for ($i = 0; $i < 10; $i++) { ?>
                  <tr>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                     <td>Brraaaa</td>
                  </tr>
               <?php } ?>
            </table>
         </div>
      </div>
      <div class="New_info">
         <input type="button" name="Client_Kanri" class="Client_Kanri_Button" value="詳細">
         <p>新着情報</p><br><br>
         <a href="">
            <p>08.20 請求書の確認依頼【＠】</p>
         </a>
         <a href="">
            <p>08.15 長期売掛金の対応確認について</p>
         </a>
         <a href="">
            <p>08.10 【○○】期限1週間前です。【システム】</p>
         </a>
         <a href="">
            <p>08.10 システム不備【てｓｔ】</p>
         </a>
         <a href="">
            <p>08.10 おおおおおお【う】</p>
         </a>
         <a href="">
            <p>08.07 テスト【社長】</p>
         </a>
         <a href="">
            <p>08.07 テスト案件【や】</p>
         </a>
      </div>
      <div class="seikyu_info">
         <input type="button" name="Client_Kanri" class="Client_Kanri_Button" value="詳細">
         <input type="button" name="Client_Kanri" class="Client_Kanri_Button_mikaku" value="未確認">
         <p>請求情報　　　marumaru年batubatu月分作成</p><br /><br />
         <p style="color:red;">※8/17　までに請求の確認お願いします。</p>
         <a href="">
            <p>○○　20社　800,000円</p>
         </a>
         <a href="">
            <p>■■■　1社　20,000円</p>
         </a>
         <a href="">
            <p>△△△　4社　80,000円</p>
         </a>
         <a href="">
            <p>××　2社　200,000円</p>
         </a>
         <a href="">
            <p>○○　0社　0円</p>
         </a>
      </div>
      <div class="Client_Kanri_saishin">
         <input type="button" name="Client_Kanri" class="Client_Kanri_Button" value="詳細">
         <p>顧客管理</p>
         <a href="">
            <p>08.20 【ｔ】「○○社」確認してください。</p>
         </a>
         <a href="">
            <p>08.19 【k.gpppp】「○○社」請求について</p>
         </a>
         <a href="">
            <p>08.15 【hasd】「○○社」住所変更</p>
         </a>
         <a href="">
            <p>08.15 【dadasd】「○○社」OKです。</p>
         </a>
         <a href="">
            <p>08.11 【jfghdg】「○○社」明日謄本出来ます。</p>
         </a>
      </div>
      <div class="Anken_kanri">
         <input type="button" name="Client_Kanri" class="Client_Kanri_Button" value="詳細">
         <p>案件管理</p>
         <a href="">
            <p>08.20 保険　○○社　見積</p>
         </a>
         <a href="">
            <p>08.20　新規　○○社　訪問</p>
         </a>
         <a href="">
            <p>08.05 生産性向上　○○社　受注</p>
         </a>
         <a href="">
            <p>08.15 アドバンテージ　○○社　請求済み</p>
         </a>
         <a href="">
            <p>08.11 手続き　○○社　進行中</p>
         </a>
      </div>
      <div class="Urikake_kanri">
         <input type="button" name="Client_Kanri" class="Client_Kanri_Button" value="詳細">
         <p>売掛管理</p>
         <a href="">
            <p>○○　売掛合計　1,420,000円</p>
         </a>
         <a href="">
            <p>07.31　【掛】○○社　決算　165,000円</p>
         </a>
         <a href="">
            <p>07.31　【掛】○○社　決算　220,000円</p>
         </a>
         <a href="">
            <p>06.30　【未】○○社　謄本立替 500円</p>
         </a>
         <a href="">
            <p>08.11 行政手続き　○○社　進行中</p>
         </a>
         <a href="">
            <p>08.11 行政手続き　○○社　進行中</p>
         </a>
      </div>
   </div>


</body>

</html><!--  -->
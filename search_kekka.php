<?php
  include_once './function_folda/Page.php';
  include_once './function_folda/function_DB_conect.php';
  include_once './function_folda/function.php';
  // 検索ワードチェック
  // $Serach_WORD = array(
  //   "商号" => $_SESSION["Shogo"],
  //   "TKCコード" => $_SESSION["TKC_CD"],
  //   "担当者" => $_SESSION["Shimei"],
  //   "顧客ID" => $_SESSION["Kokyku_ID"],
  //   "関与開始_01" => $_SESSION["Kanyo_ST_01"],
  //   "関与開始_02" => $_SESSION["Kanyo_ST_02"],
  //   "関与終了_01" => $_SESSION["kanyo_ed_01"],
  //   "関与終了_02" => $_SESSION["kanyo_ed_02"],
  // );

  $motourl = $_SERVER['HTTP_REFERER'];
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./asset/css/header.css">
    <link rel="stylesheet" href="./asset/css/search_kekka.css">
    <link rel="stylesheet" href="./asset/css/paging/paging.css">
    <script type="text/javascript" src="./asset/js/real_time.js"></script>
    <title>てｓｔ_検索結果</title>
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
                  <a href="search_kekka.php" class="init-right">顧客管理</a>
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
                  <a href="#" class="init-right">変更</a>
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
                  <a href="./function_folda/function_DB_conect.php?LogOFF=LogOFF" class="init-right">ログオフ</a>
                </li>
            </ul>
        </li>
      </ul>
    </div>
  </header>

  <body>
  <div class="Pageng">
    <?php echo $Counted_No -> html ?>
  </div>

  <div class="Search_Words">
    <a href="./kokyaku_kanri.php"><button class="search_button_client">検索</button></a>
    <?php if(strstr($motourl,'kokyaku_kanri')) {?>
      <?php print("<p>全 " .count($Create_sql_NO). " 件見つかりました。</p>");?>
    <?php } else {?>
      <?php print("<p>全件数：" .count($Create_sql_NO). " 件出力してます。</p>");?>
    <?php }?>
    <p class="Word_P">検索カテゴリ：
      <?php if(empty($_SESSION['Category'])) {?>
        全企業検索
      <?php } else {?>
        <?php echo $_SESSION['Category'];?>
      <?php }?>
      </p>
  </div>


  <?php ?>
  <div class="search_kekka" id="box">
    <table>
        <tbody>
          <?php if(empty($Create_sql)) {?>
            <tr>
              <div class="box22">
                <h1 class="Not_Found">見つかりませんでした。</h3>
              </div>

            </tr>
          <?php } else {?>
            <tr>
              <th class="Nums">ID</th>
              <th class="Nums">事務所コード</th>
              <th class="Nums">関与先コード</th>
              <th class="Num_Minddle_MM">商号</th>
              <th class="Nums_M">代表者</th>
              <th class="Nums_M">本店電話番号</th>
              <th class="Nums_M">監査担当者名</th>
            </tr>
            
            <?php foreach($Create_sql  as $var) {?>
              <tr>
                <td><a href="./Read_Client.php?ID=<?php echo $var['ID'];?>"><?php echo $var['ID'];?></a></td>
                <?php if($var['TKC_ID'] !=0 || $var['Jimusho_ID'] !=0) {?>
                  <td><a href="./Read_Client.php?ID=<?php echo $var['ID'];?>"><?php echo $var['Jimusho_ID'];?></a></td>
                  <?php if(mb_strlen($var['TKC_ID']) <= 2) {?>
                    <td><a href="./Read_Client.php?ID=<?php echo $var['ID'];?>"><?php echo str_pad($var['TKC_ID'],3,0,STR_PAD_LEFT);?></a></td>
                  <?php } else {?>
                    <td><a href="./Read_Client.php?ID=<?php echo $var['ID'];?>"><?php echo $var['TKC_ID'];?></a></td>
                  <?php }?>
                <?php } else {?>
                  <td></td>
                  <td></td>
                <?php }?>
                <td style="text-align:left;"><a href="./Read_Client.php?ID=<?php echo $var['ID'];?>"><?php echo $var['Company_Name'];?></a></td>
                <td><a href="./Read_Client.php?ID=<?php echo $var['ID'];?>"><?php echo $var['daihyo_Name'];?></a></td>
                <td><a href="./Read_Client.php?ID=<?php echo $var['ID'];?>"><?php echo $var['Campany_Tel'];?></a></td>
                <td><a href="./Read_Client.php?ID=<?php echo $var['ID'];?>"><?php echo $var['KansaTanto_Name'];?></a></td>
              </tr>
            <?php }?> 
          <?php } ?>
        </tbody>
    </table>
    </div>
  </body>

</html>
<?php
session_start();
if (!empty($_SESSION['hikaku'])) {
   $sql_ex_client_hikaku = $_SESSION['hikaku'];
   $sql_ex_client_syuturyoku = $_SESSION['syuturyoku'];
   $Last_No = $_SESSION['Last_No'];
}

include_once './function_folda/Page.php';
include_once './function_folda/function_DB_conect.php';
include_once './function_folda/function.php';

$count_NO = -1;
$Loop_No = 1;
$Print_Area = array();
$mae = 1;

foreach ($sql_ex_client_hikaku as $key_rrireki => $var_rireki) {
   // 処理初めの値の格納
   $ima = $var_rireki['ID'];

   // echo $ima."<br/>";
   // 前のポインタ数値と現在のポインタ数値の比較
   if ($ima == $mae) {
      ++$count_NO;
   } else {
      if ($mae == null) {
         continue;
      } else {
         // 現在の主キーの値を取得し配列に格納

         $Print_Area += array($mae => $count_NO);
         $count_NO = 0;
      }
   }


   // 最終行の処理（最終行を配列に格納）
   if ($Loop_No == $Last_No) {

      $Print_Area += array($var_rireki['ID'] => $var_rireki['kousin_id']);
   }
   ++$Loop_No;
   // 処理終了後の値格納
   $mae = $var_rireki['ID'];
}
$USER_NAME = $_SESSION['USER_NAME'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="./asset/css/header.css?<?php echo date('Ymd-Hi'); ?>">
   <link rel="stylesheet" href="./asset/css/Read_Client.css?<?php echo date('Ymd-Hi'); ?>">
   <link rel="stylesheet" href="./asset/css/fonts?<?php echo date('Ymd-Hi'); ?>">
   <link rel="stylesheet" href="./asset/css/style.css?<?php echo date('Ymd-Hi'); ?>">
   <link rel="stylesheet" href="./asset/css/Library/theme.default.min.css?<?php echo date('Ymd-Hi'); ?>">
   <script type="text/javascript" src="./asset/js/real_time.js"></script>
   <script type="text/javascript" src="./asset/js/Library/smooth-scroll.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/css/theme.ice.min.css">
   <link href="asset\css\Reach_Edita\bootstrap.css" rel="stylesheet">
   <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
   <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
   <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
   <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.min.js"></script>
   <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/lang/summernote-ja-JP.js"></script>
   <script src="asset\js\Reach_Edita\script.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/extras/jquery.metadata.min.js"></script>

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
                     <a href="./Henko_Log.php" class="init-right">変更履歴</a>
                  </li>
               </ul>
            <?php } ?>
         </li>
         <li class="menu-multi">
            <a href="#" class="init-bottom">アカウント情報</a>
            <ul class="menu-second-level">
               <li>
                  <p class="User_Name"><?php echo $_SESSION['USER_NAME']; ?></p>
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
   <?php foreach ($sql_ex_client as $key => $var) { ?>
      <div class="search_top">
         <table>
            <tr>
               <th colspan="3">基本情報</th>
               <th colspan="3">郵送情報</th>
            </tr>
            <tr>
               <td class="td_title">TKCコード</td>
               <td colspan="2">
                  <p><?php echo $var['C_ID'];
                     $client_No = $var['ID']; ?></p>
               </td>
               <td class="td_title">ビル・マンション名</td>
               <td colspan="2">
                  <p><?php echo $var['yubin_jyusho_01']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">請求コード</td>
               <td colspan="2">
                  <p><?php echo $var['Tokuisaki_ID']; ?></p>
               </td>
               <td class="td_title">担当者</td>
               <td colspan="2">
                  <p><?php echo $var['daihyo_Name_furigna_kojin_FM']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">商号フリガナ</td>
               <td colspan="2">
                  <p><?php echo $var['Company_Name_furigana']; ?></p>
               </td>
               <td class="td_title">役職</td>
               <td colspan="2">
                  <p><?php echo $var['Yakushoku']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">商号</td>
               <td colspan="2">
                  <p><?php echo $var['Company_Name'];
                     $Client_Name = $var['Company_Name'];
                     $_SESSION['Clinent_Name'] = $Client_Name ?></p>
               </td>
               <td class="td_title">敬称</td>
               <td colspan="2">
                  <p><?php echo $var['Shogo_Keisho']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">通称</td>
               <td colspan="2">
                  <p><?php echo $var['tusho']; ?></p>
               </td>
               <td class="td_title">代表者/個人 宛名印字</td>
               <td colspan="2">
                  <p><?php echo $var['atena']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">代表フリガナ</td>
               <td colspan="2">
                  <p><?php echo $var['daihyo_Name_furigna']; ?></p>
               </td>
               <td class="td_title">郵便物送付先担当者</td>
               <td colspan="2">
                  <p><?php echo $var['yubin_tanto']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">代表者名</td>
               <td colspan="2">
                  <p><?php echo $var['daihyo_Name']; ?></p>
               </td>
               <td class="td_title">〒</td>
               <td colspan="2">
                  <p><?php echo $var['Yubin_No']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">郵便物</td>
               <td colspan="2">
                  <p><?php echo $var['Yubin_syurui']; ?></p>
               </td>
               <td class="td_title">申告住所</td>
               <td colspan="2">
                  <p><?php echo $var['Jyusho_01']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">医療情報誌</td>
               <td colspan="2">
                  <p><?php echo $var['Iryou_zassh']; ?></p>
               </td>
               <td class="td_title">HP</td>
               <td colspan="2">
                  <p><?php echo $var['Company_HP']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">TEL</td>
               <td colspan="2">
                  <p><?php echo $var['Campany_Tel']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">FAX</td>
               <td colspan="2">
                  <p><?php echo $var['Campany_Fax']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">MAIL</td>
               <td colspan="2">
                  <p><?php echo $var['Campany_Mail']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">資本金</td>
               <td class="Money">
                  <p><?php echo number_format($var['Shihonkin']); ?>円</p>
               </td>
            </tr>
            <tr>
               <td class="td_title">発行済株式の総数</td>
               <td class="Money">
                  <p><?php echo $var['Hako_Kabu_sosu']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">自己株式</td>
               <td class="Money">
                  <p><?php echo $var['Jikokabu']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">株式の譲渡制限</td>
               <td colspan="2">
                  <p><?php echo $var['Kabushiki_Jhoto']; ?></p>
               </td>
            </tr>
         </table>
         <br>

         <table>
            <tr>
               <th colspan="3">事務所情報</th>
               <th colspan="3">請求情報</th>
            </tr>
            <tr>
               <td class="td_title">所属名</td>
               <td colspan="2">
                  <p><?php echo $var['oya_kaisha']; ?></p>
               </td>
               <td class="td_title">請求開始</td>
               <td colspan="2">
                  <p><?php echo $var['seikyu_kaishi']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">関与形態</td>
               <td class="kanyo">
                  <p><?php echo $var['ketai']; ?></p>
               </td>
               <td>
                  <p><?php echo $var['KanyoKeitai_Meiboyo']; ?></p>
               </td>
               <td class="td_title">請求開始月</td>
               <td colspan="2">
                  <p><?php echo $var['seikyu_kaishi_month']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">自振請求</td>
               <td colspan="2">
                  <p><?php echo $var['jihuriseikyu']; ?></p>
               </td>
               <td class="td_title">期間</td>
               <td colspan="2">
                  <p><?php echo $var['Jyunkaikansa_Jissi']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">区分名</td>
               <td colspan="2">
                  <p><?php echo $var['hojin_kubun']; ?></p>
               </td>
               <td class="td_title">難易度</td>
               <td colspan="2">
                  <p><?php echo $var['nanido']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">消費税</td>
               <td colspan="2">
                  <p><?php echo $var['Jyutaku_shohizei']; ?></p>
               </td>
               <td class="td_title">月次</td>
               <td colspan="2">
                  <p></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">決算月</td>
               <td colspan="2">
                  <p><?php echo $var['kesan_month']; ?>月</p>
               </td>
               <td class="td_title">決算</td>
               <td class="Money" 　colspan="2">
                  <p><?php echo number_format($var['Jyutaku_Kesanhosyugaku']); ?>円</p>
               </td>
            </tr>
            <tr>
               <td class="td_title">担当者</td>
               <td colspan="2">
                  <p><?php echo $var['KansaTanto_Name']; ?></p>
               </td>
               <td class="td_title">その他</td>
               <td class="Money" 　colspan="2">
                  <p><?php echo number_format($var['Jyutaku_Tahosyu']); ?>円</p>
               </td>
            </tr>
            <tr>
               <td class="td_title">副担当者</td>
               <td colspan="2">
                  <p><?php echo $var['Jishatanto']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">担当者部署</td>
               <td colspan="2">
                  <p><?php echo $var['KansaTanto_Buka_Name']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">副担当者部署</td>
               <td colspan="2">
                  <input type="text" placeholder="" value="<?php echo $var['Jishatanto_Bu_4Ser']; ?>" style="border:none;" disabled>
               </td>
            </tr>
            <tr>
               <td class="td_title">設立年月日</td>
               <td colspan="2">
                  <p><?php echo $var['seturitu_ymd']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">関与開始</td>
               <td colspan="2">
                  <p><?php echo $var['kanyo_kaishi']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">関与終了</td>
               <td colspan="2">
                  <p><?php echo $var['kanyo_syuryo']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">関与人</td>
               <td colspan="2">
                  <p><?php echo $var['Kanyozeirishi_Name']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">登録日</td>
               <td colspan="2">
                  <p><?php echo $var['torokubi']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">修正年月日</td>
               <td colspan="2">
                  <p><?php echo $var['syuseibi']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">基本システム名</td>
               <td colspan="2">
                  <p><?php echo $var['Zaimuhuzoku_System_01']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">期首年月日</td>
               <td colspan="2">
                  <p><?php echo $var['N_jigyo_kisyu_ymd']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">期末年月日</td>
               <td colspan="2">
                  <p><?php echo $var['N_jigyo_kisyu_last_ymd']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">税務署</td>
               <td colspan="2">
                  <p><?php echo $var['zeimusho']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">業種コード</td>
               <td colspan="2">
                  <p><?php echo $var['gyosyu_ID']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">業種種目</td>
               <td colspan="2">
                  <p><?php echo $var['gyosyumoku']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">○○区分</td>
               <td colspan="2">
                  <p><?php echo $var['aoirokubun']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">責任者 フリガナ</td>
               <td colspan="2">
                  <p><?php echo $var['Keiri_Sekinin_Furigana']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">責任者　氏名</td>
               <td colspan="2">
                  <p><?php echo $var['Keiri_Sekinin_Name']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">期限延長</td>
               <td colspan="2">
                  <p><?php echo $var['Keiri_Sekinin_Name']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">期限延長</td>
               <td colspan="2">
                  <p><?php echo $var['Shinkokukigen_Entyo']; ?></p>
               </td>
            </tr>
            <tr>
               <td class="td_title">納期</td>
               <td colspan="2">
                  <p><?php echo $var['gensennouki']; ?></p>
               </td>
            </tr>
         </table>
      </div>
   <?php } ?>

   <div class="Client_Yaritori_Block">
      <!-- 顧客やり取りフォーム -->
      <form action="./function_folda/function_DB_conect.php" enctype="multipart/form-data" method="post">
         <div class="reach_Edita">
            <div class="Daimoku">顧客連絡履歴</div>
            <div class="rich_editer">
               <?php if (!empty($_SESSION['hensyu_content'])) { ?>
                  <textarea id="contents" name="contents_area">
              <?php
                  echo $_SESSION['hensyu_content'] . "<br />";
                  // echo $_SESSION['Client_KanriID'].$_SESSION['Client_IDName'].$_SESSION['Client_Kosin_ID'] ."<br />";
                  unset($_SESSION['hensyu_content']);
                  // session_destroy();
               ?>
              </textarea>
                  <input type="hidden" name="Client_Name" value="<?php echo $Client_Name; ?>">
                  <input type="hidden" name="USER" value="<?php echo $USER_NAME; ?>">
                  <div class="Button_Box">
                     <input name="fname[]" multiple type="file">
                     <button class="btn-border" type="submit" name="client_Update">更新</button>
                     <button class="btn-border" type="submit" name="client_cansel">キャンセル</button>
                  </div>

               <?php } else { ?>
                  <textarea id="contents" name="contents_area">
              </textarea>
                  <div class="Button_Box">
                     <input type="hidden" name="Client_no" value="<?php echo $client_No; ?>">
                     <input type="hidden" name="Client_Name" value="<?php echo $Client_Name; ?>">
                     <input name="fname[]" multiple type="file">
                     <button class="btn-border" type="submit" name="client_send">新規投稿</button>
                  </div>
               <?php } ?>
            </div>
         </div>
      </form>

      <!-- 検索ボックス -->
      <div class="yaritori_search">
         <form action="./function_folda/function_DB_conect.php" method="post">
            <table>
               <tr>
                  <th>投稿内容</th>
                  <th>登録日時開始</th>
                  <th>登録日時終了</th>
                  <th>担当者</th>
               </tr>
               <tr>
                  <td><input type="text" name="SerachPost[gazo]" class="input_with"></td>
                  <td><input type="date" name="SerachPost[date_af_torokujikan]" class="input_with"></td>
                  <td><input type="date" name="SerachPost[date_bf_torokujikan]" class="input_with"></td>
                  <td><input type="text" name="SerachPost[name]" class="input_with"></td>
               </tr>
               <tr>
                  <th>更新日時開始</th>
                  <th>更新日時終了</th>
                  <th class="Last" rowspan="3" colspan="3"><button class="Search_Button_Post" name="Search_post_button" value="">検索</button></th>
                  <th></th>
               </tr>
               <tr>
                  <td><input type="date" name="SerachPost[date_af_koushin_jikan]" class="input_with"></td>
                  <td><input type="date" name="SerachPost[date_bf_koushin_jikan]" class="input_with"></td>
                  <td class="Last"></td>
               </tr>
            </table>
            <input type="hidden" name="client_id" value="<?php echo $client_No; ?>">
         </form>
      </div>

      <!-- 投稿ボックス -->
      <div class="yaritori">
         <?php if (empty($_SESSION['empty_kekka'])) { ?>
            <?php foreach ($sql_ex_client_syuturyoku as $Key_syu => $Var_syu) { ?>
               <?php foreach ($Print_Area as $Key_hika => $Var_hika) { ?>
                  <?php if ($Var_syu['ID'] == $Key_hika && $Var_syu['kousin_id'] == $Var_hika) { ?>
                     <?php if ($Var_syu['rock_flag'] == 0) { ?>
                        <?php $File_Path02 =  Filepath_syuturyoku($Var_syu['ID'], $client_No); ?>
                        <?php foreach ($File_Path02 as $File_key1 => $File_val1) {
                           if (!empty($File_val1['torokujikan'])) {
                              $File_time = substr($File_val1['torokujikan'], 0, strlen($File_val1['torokujikan']) - 3);
                           }
                        } ?>
                        <div class="yaritori_naiyo" id="<?php echo $File_time; ?>">
                           <?php if ($Var_syu['kousin_id'] > 0) { ?>
                              <!-- <p><?php echo $Var_syu['koushin_jikan'] . "：主キー" . $Var_syu['ID'] . "　顧客ID：" . $Var_syu['ID'] . "　更新ID：" . $Var_syu['kousin_id'] . "　　" . $Var_syu['koushin_user']; ?></p></br/> -->
                              <p class="title_mode"><?php echo "登録日時：" . $Var_syu['torokujikan'] . " 更新日時：" . $Var_syu['koushin_jikan'] . "　更新者：" . $Var_syu['name']; ?></p></br />
                           <?php } else { ?>
                              <p class="title_mode"><?php echo "登録日時：" . $Var_syu['torokujikan'] . "　登録者：" . $Var_syu['name']; ?></p></br />
                              <!-- <p><?php echo $Var_syu['torokujikan'] . "：主キー" . $Var_syu['ID'] . "　顧客ID：" . $Var_syu['Client_Master_ID'] . "　更新ID：" . $Var_syu['kousin_id'] . "　　" . $Var_syu['name']; ?></p></br/> -->
                           <?php } ?>

                           <div class="contet">
                              <div class="naiyo_content">
                                 <p><?php echo $Var_syu['gazo']; ?></p>
                              </div>

                              <?php $File_Path =  Filepath_syuturyoku($Var_syu['ID'], $client_No); ?>
                              <form action="./function_folda/function_Image_config.php" method="post">
                                 <input type="hidden" name="Client_IDName" value="<?php echo $client_No; ?>">
                                 <input type="hidden" name="Client_Name" value="<?php echo $Client_Name; ?>">
                                 <?php foreach ($File_Path as $File_key => $File_val) { ?>
                                    <?php if (!empty($File_val['file_path'])) { ?>
                                       <div class="File_block">
                                          <a class="File_Path" href="./function_folda/function_DB_conect.php?Client_ID_DL=<?php echo $client_No; ?>&File_path_DL=<?php echo $File_val['file_path']; ?>">
                                             <?php echo substr($File_val['file_path'], strrpos($File_val['file_path'], "/") + 1, strlen($File_val['file_path'])); ?>
                                          </a>
                                       </div>
                                    <?php } ?>
                                 <?php } ?>
                              </form>
                           </div>
                           </br />
                           <?php if ($USER_NAME == $Var_syu['name']) { ?>
                              <form action="./function_folda/function_DB_conect.php" method="post">
                                 <div class="item_area">
                                    <!-- <p><?php echo $Var_syu['koushin_jikan'] . "：主キー" . $Var_syu['ID'] . "　顧客ID：" . $Var_syu['ID'] . "　更新ID：" . $Var_syu['kousin_id']; ?></p></br/> -->
                                    <input type="hidden" name="Client_KanriID" value="<?php echo $Var_syu['ID']; ?>">
                                    <input type="hidden" name="Client_IDName" value="<?php echo $Var_syu['Client_Master_ID']; ?>">
                                    <input type="hidden" name="Client_Koshin_ID" value="<?php echo $Var_syu['kousin_id']; ?>">
                                    <input type="hidden" name="Client_torokujikan" value="<?php echo $Var_syu['torokujikan']; ?>">

                                    <div class="Con_hen_Box">
                                       <button class="Lock" name="Lock_button"><span class="icon-lock"></span></button>
                                       <button class="hensyu" name="hensyu_button"><span class="icon-pencil2"></span></button>
                                       <button class="del" name="Delete_button"><span class="icon-bin"></span></button>
                                    </div>
                                 </div>
                              </form>
                           <?php } ?>
                        </div>

                     <?php } else { ?>
                        <div class="yaritori_naiyo02">
                           <!-- <?php if ($Var_syu['kousin_id'] > 0) { ?>
                    <p><?php echo $Var_syu['koushin_jikan'] . "：主キー" . $Var_syu['ID'] . "　顧客ID：" . $Var_syu['Client_Master_ID'] . "　更新ID：" . $Var_syu['kousin_id'] . "　　" . $Var_syu['name']; ?></p></br/>
                  <?php } else { ?>
                    <p><?php echo $Var_syu['torokujikan'] . "：主キー" . $Var_syu['ID'] . "　顧客ID：" . $Var_syu['Client_Master_ID'] . "　更新ID：" . $Var_syu['kousin_id'] . "　　" . $Var_syu['name']; ?></p></br/>
                  <?php } ?> -->
                           <p class="title_mode"><?php echo "登録日時：" . $Var_syu['torokujikan'] . "　登録者：" . $Var_syu['name']; ?></p></br />
                           <div class="contet">
                              <p><?php echo $Var_syu['gazo']; ?></p><br />
                              <?php $File_Path =  Filepath_syuturyoku($Var_syu['ID'], $client_No); ?>

                              <form action="./function_folda/function_Image_config.php" method=POST>
                                 <input type="hidden" name="Client_IDName" value="<?php echo $client_No; ?>">
                                 <input type="hidden" name="Client_Name" value="<?php echo $Client_Name; ?>">
                                 <?php foreach ($File_Path as $File_key => $File_val) { ?>
                                    <?php if (!empty($File_val['file_path'])) { ?>
                                       <div class="File_block" id="<?php echo $File_val['koshinjikan']; ?>">
                                          <a class="File_Path" href="./function_folda/function_DB_conect.php?Client_ID_DL=<?php echo $client_No; ?>&File_path_DL=<?php echo $File_val['file_path']; ?>">
                                             <?php echo substr($File_val['file_path'], strrpos($File_val['file_path'], "/") + 1, strlen($File_val['file_path'])); ?>
                                          </a>
                                       </div>
                                    <?php } ?>
                                 <?php } ?>
                              </form>
                           </div>
                           <form action="./function_folda/function_DB_conect.php" method="post">
                              <div class="item_area">
                                 <input type="hidden" name="Client_KanriID" value="<?php echo $Var_syu['ID']; ?>">
                                 <input type="hidden" name="Client_IDName" value="<?php echo $Var_syu['Client_Master_ID']; ?>">
                                 <input type="hidden" name="Client_Koshin_ID" value="<?php echo $Var_syu['kousin_id']; ?>">
                                 <div class="Con_hen_Box">
                                    <button class="Lock_kaijyo" name="Lock_button_kaijyo"><span class="icon-unlocked"></span></button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     <?php } ?>
                  <?php } ?>
               <?php } ?>
            <?php } ?>

         <?php } else { ?>
            <?php echo $_SESSION['empty_kekka'];
            unset($_SESSION['empty_kekka']); ?>
         <?php } ?>
      </div>
   </div>


   <div class="Uploader">
      <div class="Daimoku">顧客関連資料</div>
      <div class="Button_Box_shiryou">
         <a class="trash_mark" href="#modal-01">
            <p>ゴミ箱</p>
         </a>
         <div class="modal-wrapper" id="modal-01">
            <div class="modal-overlay"></div>
            <div class="modal-window">
               <table>
                  <tr>
                     <th>ファイル名</th>
                     <th>最終更新日</th>
                     <th>復活</th>
                     <th>完全削除</th>
                  </tr>
                  <?php
                  foreach ($FilePath_sakujyo as $key => $vall) { ?>
                     <tr>
                        <td><?php echo $File_Name = substr($vall['file_path'], strrpos($vall['file_path'], "/") + 1, strlen($vall['file_path'])); ?></td>
                        <td><?php echo $vall['torokujikan']; ?></td>
                        <td>
                           <a class="File_DL" href="./function_folda/function_DB_conect.php?rireki_ID=<?php echo $vall['rireki_ID']; ?>&Client_ID=<?php echo $vall['Client_ID']; ?>&Client_name=<?php echo $Client_Name; ?>&File_fukatu=<?php echo $vall['file_path']; ?>">復活</a>
                        </td>
                        <td>
                           <a class="File_DL" href="./function_folda/function_DB_conect.php?rireki_ID_buturi=<?php echo $vall['rireki_ID']; ?>&Client_ID_buturi=<?php echo $vall['Client_ID']; ?>&File_path_buturi=<?php echo $vall['file_path']; ?>&Client_name_buturi=<?php echo $Client_Name; ?>">削除</a>
                        </td>
                     </tr>
                  <?php } ?>
               </table>
               <a href="#!" class="modal-close">×</a>
            </div>
         </div>
      </div>

      <div class="Upload_Block">
         <table class="tablesorter" id="myTable">
            <thead>
               <tr>
                  <th>スクロール</th>
                  <th class="th_hover">ファイル名</th>
                  <th class="th_hover">拡張子</th>
                  <th class="th_hover">最終保存時間</th>
                  <th>削除</th>
                  <th>DL</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($FilePath_joinscall as $key => $vall) { ?>
                  <?php if (!empty($vall['file_path'])) { ?>
                     <tr>
                        <td>
                           <a href="#<?php echo substr($vall['torokujikan'], 0, strlen($vall['torokujikan']) - 3); ?>" data-scroll>投稿元へ</a>
                        </td>
                        <td>
                           <?php echo substr($vall['file_path'], strrpos($vall['file_path'], "/") + 1, strlen($vall['file_path'])); ?>
                        </td>
                        <td class="seikei">
                           <?php echo substr($vall['file_path'], strrpos($vall['file_path'], ".") + 1, strlen($vall['file_path'])); ?>
                        </td>
                        <td class="seikei">
                           <?php echo substr($vall['koshinjikan'], 0, strlen($vall['koshinjikan']) - 3); ?>
                        </td>
                        <td class="seikei">
                           <a class="File_DL" href="./function_folda/function_DB_conect.php?rireki_ID_ronri=<?php echo $vall['rireki_ID']; ?>&Client_ID_ronri=<?php echo $vall['Client_ID']; ?>&Client_name_ronri=<?php echo $Client_Name; ?>&File_path_ronri=<?php echo $vall['file_path']; ?>">
                              <span class="icon-bin"></span>
                           </a>
                        </td>
                        <td class="seikei">
                           <!-- ダウンロードボタン -->
                           <a class="File_DL" href="./function_folda/function_DB_conect.php?Client_ID_DL=<?php echo $vall['Client_ID']; ?>&File_path_DL=<?php echo $vall['file_path']; ?>"><span class="icon-download2"></span></a>
                        </td>
                     </tr>
                  <?php } ?>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>
   <script>
      $(document).ready(function() {
         $("#myTable").tablesorter({
            widgets: ['zebra'],
            sortList: [
               [3, 0]
            ],
         });
      });
   </script>
</body>

</html>
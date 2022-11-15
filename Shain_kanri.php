<?php

include_once './function_folda/function_DB_conect.php';
include_once './function_folda/function.php';
include_once './function_folda/function_Column_Array.php';
if (session_status() == PHP_SESSION_NONE) {
   // セッションは有効で、開始していないとき
   session_start();
}

if (!empty($_SESSION['userID'])) {
   $Select_Shain_Call = $_SESSION['userID'];
}

// 最終社員番号を取得
foreach ($LAST_shainID as $a => $dd) {
   // 新規登録時の最終社員番号附番
   $Last_ID = $dd['ID'];
}

// 今年取得
$The_year_Reiwa = gmdate("Y") - 2018;
// 最後の社員番号の附番を取得
$The_year_Reiwa_LID =  mb_substr($Last_ID, 1, 2) + 0;
// 社員番号年跨ぎ処理
if ($The_year_Reiwa == $The_year_Reiwa_LID) {
   $Last_ID = $Last_ID + 1;
} else {
   // 年跨ぎ時に社員番号を年跨ぎの附番で作成
   $Last_ID = "3" . str_pad($The_year_Reiwa_LID, 2, 0, STR_PAD_LEFT) . "01";
}

// 社員検索結果受け取り
if (!empty($_SESSION['Search_Keka_shian'])) {
   $Search_keka = $_SESSION['stack_up'];
}

// 検索履歴（1回前を保存）
if (!empty($_SESSION['Search_keka_hozon'])) {
   $Search_1_process_bf = $_SESSION['Search_keka_hozon'];
}

if (!empty($Shain_write_yo_column) && !empty($Shain_write_yo_con)) {
   $_SESSION['cv_con'] = $Shain_write_yo_con;
   $_SESSION['csv_pro'] = $Shain_hikaku_csv;
   $_SESSION['csv_con2'] = $Shain_hikaku_csv2;
   $_SESSION['csv_col2'] = $Shain_write_yo_column02;
   $search_th = $Shain_write_yo_column;
}

if (!empty($_SESSION['sabun'])) {
   $Denote_Sabun = $_SESSION['sabun'];
   $Post_Db_Replace = $_SESSION['post_DB'];
   unset($_SESSION['sabun']);
   unset($_SESSION['post_DB']);
}

$Ac_Syurui = array(
   'shain_kanri',
);

// 社員検索時の配列変数

?>

<!DOCTYPE html>
<html lang="ja">


<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="./asset/css/header.css">
   <link rel="stylesheet" href="./asset/css/Shain_kanri.css">
   <link rel="stylesheet" href="./asset/css/Shain_kanri.css">
   <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js?ver=1.12.2'></script>
   <script src="https://unpkg.com/@popperjs/core@2"></script>
   <script src="https://unpkg.com/tippy.js@6"></script>
   <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
   <script type="text/javascript" src="./asset/js/real_time.js"></script>
   <script type="text/javascript" src="./asset/js/Library/jquery.quicksearch.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>


   <script type="text/javascript" src="./asset/js/main.js"></script>
   <script type="text/javascript" src="./asset/js/Serach.js"></script>
   <script type="text/javascript" src="./asset/js/Observe.js"></script>
   <script type="text/javascript" src="./asset/js/Library_Process.js"></script>

   <title>てｓｔ_社員管理</title>
</head>
<header>
   <script>
      $(document).ready(function() {
         $('#table_id').tablesorter();
      });
   </script>
   <div class="container">
      <ul class="menu">
         <div class="mokuji">
            <h1 class="jisha"><a href="./index.php">tesDB</a></h1>
            <p class="Today_01"><?php echo date("Y.m.d" . "(" . $week[$date] . ")") ?></p>
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
                  <a href="#" class="init-right">ログオフ</a>
               </li>
            </ul>
         </li>
      </ul>
   </div>
</header>


<body>

   <div class="workflow_box">
      <input id="tab-radio1" class="tab-radio" name="tab" type="radio" checked>
      <input id="tab-radio2" class="tab-radio" name="tab" type="radio">
      <input id="tab-radio3" class="tab-radio" name="tab" type="radio">
      <input id="tab-radio4" class="tab-radio" name="tab" type="radio">

      <!-- 大項目タブ -->
      <ul class="list-tab-label">
         <li>
            <label id="tab-label1" class="tab-label" for="tab-radio1">社員情報管理</label>
         </li>
         <li>
            <label id="tab-label2" class="tab-label" for="tab-radio2">準備中です。</label>
         </li>
         <li>
            <label id="tab-label3" class="tab-label" for="tab-radio3">準備中です。</label>
         </li>
         <li>
            <label id="tab-label4" class="tab-label" for="tab-radio4">準備中です。</label>
         </li>
      </ul>


      <div class="wrap-tab-content">
         <div id="tab-content1" class="tab-content">
            <div class="tabs">
               <input id="all" type="radio" name="tab_item" checked>
               <label class="tab_item" for="all">社員情報更新・照会</label>
               <input id="programming" type="radio" name="tab_item">
               <label class="tab_item" for="programming">新規社員情報登録</label>
               <input id="design" type="radio" name="tab_item">
               <label class="tab_item" for="design">アクセス権限設定</label>
               <div class="tab_content" id="all_content">
                  <!-- 
                  
                検索ボックス

              -->
                  <div class="Shain_Info_Box_Read">
                     <form action="./function_folda/function_DB_conect.php" method="POST">
                        <div class="shiborikomi">
                           <div class="Search_Form_Buttton_Box">
                              <input class="input_box" type="text" name="jyoken" id="quick_search" onInput="alertValue(this)">
                              <label for="trigger" class="SF_Button_shibori">絞り込み</label>
                              <button class="SF_Button_Reset" name="shain_can">リセット</button>
                              <p id="output"></p>
                           </div>
                           <div class="modal_wrap">
                              <input id="trigger" type="checkbox" class="tri">
                              <div class="modal_overlay">
                                 <label for="trigger" class="modal_trigger"></label>
                                 <div class="modal_content" id="jyoken_tuika">
                                    <label for="trigger" class="close_button">✖️</label>
                                    <select id="select_Box1" class="sss" name="state" onchange="selectboxChange(this.id,this.value);">
                                       <option value="">
                                          <p>条件を追加する</p>
                                       </option>
                                       <?php foreach ($select_option_komoku  as $key => $value) { ?>
                                          <option value="<?php echo $key; ?>">
                                             <p><?php echo $value; ?></p>
                                          </option>
                                       <?php } ?>
                                    </select>
                                    <button class="SF_Button_Serach" name="SF_Button_Serach">検索</button>
                                 </div>
                              </div>
                           </div>
                     </form>
                  </div>

                  <!-- 

                検索結果ボックス

                -->
                  <div class="Table_box">
                     <form action="./function_folda/function_DB_conect.php" method="GET">
                        <?php if (!empty($Search_keka)) { ?>
                           <table id="table_id">
                              <thead>
                                 <tr>
                                    <?php foreach ($select_option_komoku_th as $key => $value) { ?>
                                       <?php if ($key == 'shoshiki_name' || $key == 'sotugyoko') { ?>
                                          <th class="Big_size"><?php echo $value; ?></th>
                                       <?php } else { ?>
                                          <th class="small_size"><?php echo $value; ?></th>
                                       <?php } ?>
                                    <?php } ?>
                                 </tr>
                              </thead>
                              <?php foreach ($Search_keka as $key => $value) { ?>
                                 <tr id="shain_search_<?php echo $value[0]; ?>" class="shain_search">
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value[0]; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['sei'] . " " . $value['mei']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['soshikimei']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['bumei']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['kamei']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['yakushokumei']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['kubunmei']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['nyusha_nengapi']; ?></a></td>
                                    <?php if ($value['taisha_nengapi'] == "0000-00-00") { ?>
                                       <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>">在職中</a></td>
                                    <?php } else { ?>
                                       <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['taisha_nengapi']; ?></a></td>
                                    <?php } ?>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['seinengapi']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['seibetu']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['sikaku1']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['sikaku2']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['sikaku3']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['sikaku4']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['sikaku5']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['gakurekimei']; ?></a></td>
                                    <td><a href="./function_folda/function_DB_conect.php?user_id=<?php echo $value[0]; ?>"><?php echo $value['sotugyoko']; ?></a></td>
                                 </tr>
                              <?php } ?>
                           <?php } else { ?>
                              <div class="Not_Found">
                                 <p>見つかりませんでした。</p>
                              </div>
                           <?php } ?>
                           </table>
                     </form>
                  </div>
               </div>

               <!-- 

                社員情報表示エリア

                -->
               <?php if (!empty($Select_Shain_Call)) { ?>
                  <?php foreach ($Shain_Call_kanri02 as $Key => $Val) { ?>
                     <?php if ($Val[0] == $Select_Shain_Call) { ?>
                        <!-- 削除ウィンドウ -->
                        <input type="checkbox" id="my_modal1"><!-- 非表示チェックボックス -->
                        <label class="my_modal_overlay" for="my_modal1"></label><!-- オーバーレイ -->
                        <div class="my_modal_body1">
                           <div class="my_modal_header">
                              <h1> 社員削除</h1>
                              <label class="my_modal_close" for="my_modal1">
                                 <div class="my_modal_close_icon"><span></span></div>
                              </label><!-- 閉じるボタン -->
                           </div>
                           <div class="my_modal_content">
                              <p class="honbun">社員情報の<?php echo $Val['sei'] . '' . $Val['mei']; ?>さんを本当に削除しますか？<br />
                                 一度削除したデータを復元したい時は、管理者にご連絡してください。</p><br><br>
                              <form action="./function_folda/function_DB_conect.php" method="POST">
                                 <div class="button_box_Del">
                                    <button class="shain_del_OK" name="shain_del">OK</button>
                                    <button class="shain_del_can" name="shain_can">キャンセル</button>
                                    <input type="hidden" name="shain_id" value="<?php echo $Val[0]; ?>">
                                 </div>
                              </form>
                           </div>
                        </div>

                        <input type="checkbox" id="my_modal2"><!-- 非表示チェックボックス -->
                        <label class="my_modal_overlay2" for="my_modal2"></label><!-- オーバーレイ -->
                        <div class="my_modal_body2">
                           <div class="my_modal_header">
                              <h1> CSV取り込み</h1>
                              <label class="my_modal_close" for="my_modal2">
                                 <div class="my_modal_close_icon"><span></span></div>
                              </label><!-- 閉じるボタン -->

                           </div>
                           <div class="my_modal_content">
                              <form action="./function_folda/function_DB_conect.php" method="post" enctype="multipart/form-data">
                                 <input type="file" class="File_Up" name="upfile" id="upload_file" size="30" />
                                 <!-- <button class="toroku_ne" name="new_regi">新規登録</button> -->
                                 <button class="toroku_ne" name="uodate">差分確認</button>
                              </form>
                           </div>

                           <?php if (!empty($Denote_Sabun)) { ?>
                              <div class="csv_hikaku">
                                 <div class="sabun_shousai_box">
                                    <?php foreach ($Denote_Sabun as $key => $value) { ?>
                                       <a href="#Henko_td<?php echo $key ?>" onclick="Henko_sabun('Henko_td<?php echo $key ?>');">『<?php echo '変更セル番地：' . $key ?>』</a>
                                       <p><?php echo  '変更値:' . $value; ?>、</p>
                                    <?php } ?>
                                 </div>
                                 <table>
                                    <tr>
                                       <?php foreach ($Shain_write_yo_column as $key => $value) { ?>
                                          <th><?php echo $value; ?></th>
                                       <?php } ?>
                                    </tr>
                                    <?php foreach ($Post_Db_Replace  as $key => $value) { ?>
                                       <?php if ($key %  32 == 0) { ?>
                                          <tr>
                                          <?php } ?>
                                          <td class="btn" title="<?php echo $key; ?>" id="Henko_td<?php echo $key; ?>">
                                             <a id="Henko_<?php echo $key; ?>"><?php echo  $value; ?></a>
                                          </td>
                                          <?php if ($key %  32 == 32) { ?>
                                          </tr>
                                       <?php } ?>
                                    <?php } ?>
                                 </table>
                              </div>
                           <?php } ?>

                        </div>

                        <form action="./function_folda/function_DB_conect.php" method="POST">
                           <div class="button_box">
                              <button class="shain_koushin" name="shain_koushin">更新</button>
                              <label class="shain_del" for="my_modal1">削除</label><!-- チェックボックスラベル -->
                              <input type='button' class="shain_hensyu" name="shain_hensyu" value="編集" onclick="clickBtn1()">
                              <button class="shain_csv_syutu" name="shain_CSV_syutu">CSV出力</button>
                              <!-- <label class="shain_csv_tori" for="my_modal2" name="shain_csv_tori">CSV取り込み</label> -->
                           </div>

                           <div class="tab_sub_shain_info">
                              <input type="radio" name="tabs" id="tab_01" checked>
                              <input type="radio" name="tabs" id="tab_02">
                              <input type="radio" name="tabs" id="tab_03">
                              <input type="radio" name="tabs" id="tab_04">

                              <div class="tab_btns">
                                 <label for="tab_01" class="tab_btn">基本情報</label>
                                 <label for="tab_02" class="tab_btn">車両情報</label>
                                 <label for="tab_03" class="tab_btn">保険情報</label>
                                 <label for="tab_04" class="tab_btn">異動履歴</label>
                              </div>

                              <div class="tab_pages">
                                 <div class="tab_page">
                                    <div class="shain_info_box">
                                       <table>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>社員ID</p>
                                             </td>
                                             <td><input type="text" name="shain_info[ID]" value="<?php echo $Val[0]; ?>" class="inuput_width" readonly></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>社員氏名</p>
                                             </td>
                                             <td><input type="text" value="<?php echo $Val['sei'] . "　" . $Val['mei']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>社員氏名カナ</p>
                                             </td>
                                             <td><input type="text" value="<?php echo $Val['sei_kana'] . "　" . $Val['mei_kana']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>在籍年数</p>
                                             </td>
                                             <?php $Now_TImes = date("Y-m-d"); ?>
                                             <td><input type="text" name="shain_info[mail]" value="<?php if ($Val['nyusha_nengapi'] !== '0000-00-00') {
                                                                                                      $objDatetime1 = new DateTime($Now_TImes);
                                                                                                      $objDatetime2 = new DateTime($Val['nyusha_nengapi']);
                                                                                                      $objInterval = $objDatetime1->diff($objDatetime2);
                                                                                                      echo str_replace('-', '', $objInterval->format('%R%Y')) . '年' . str_replace('-', '', $objInterval->format('%R%M')) . 'ヶ月';
                                                                                                   } ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>年齢</p>
                                             </td>
                                             <td><input type="text" name="shain_info[nyusha_nengapi]" value="<?php if ($Val['seinengapi'] !== '0000-00-00') {
                                                                                                                  echo floor((strtotime($Now_TImes) - strtotime($Val['seinengapi'])) / (60 * 60 * 24) / 365) . '歳';
                                                                                                               } ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>社員氏名(姓)</p>
                                             </td>
                                             <td><input type="text" id="b1" name="shain_info[sei]" value="<?php echo $Val['sei']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>社員氏名(名)</p>
                                             </td>
                                             <td><input type="text" id="b2" name="shain_info[mei]" value="<?php echo $Val['mei']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>社員氏名(セイ)</p>
                                             </td>
                                             <td><input type="text" id="b3" name="shain_info[sei_kana]" value="<?php echo $Val['sei_kana']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>社員氏名(メイ)</p>
                                             </td>
                                             <td><input type="text" id="b4" name="shain_info[mei_kana]" value="<?php echo $Val['mei_kana']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>sys名</p>
                                             </td>
                                             <td><input type="text" id="b5" name="shain_info[sys_name]" value="<?php echo $Val['sys_name']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>組織名</p>
                                             </td>
                                             <td>
                                                <select name="shain_info[soshiki_ID]" id="b6" class="inuput_width" disabled>
                                                   <option value="0" <?php if ($Val['soshiki_ID'] === '0') echo 'selected'; ?>>
                                                      <p></p>
                                                   </option>
                                                   <option value="1" <?php if ($Val['soshiki_ID'] === '1') echo 'selected'; ?>>
                                                      <p>○○法人テスト</p>
                                                   </option>
                                                   <option value="2" <?php if ($Val['soshiki_ID'] === '2') echo 'selected'; ?>>
                                                      <p>○○会社テスト</p>
                                                   </option>
                                                   <option value="3" <?php if ($Val['soshiki_ID'] === '3') echo 'selected'; ?>>
                                                      <p>○○会社財政</p>
                                                   </option>
                                                   <option value="4" <?php if ($Val['soshiki_ID'] === '4') echo 'selected'; ?>>
                                                      <p>○○行政</p>
                                                   </option>
                                                   <option value="5" <?php if ($Val['soshiki_ID'] === '5') echo 'selected'; ?>>
                                                      <p>○○社労</p>
                                                   </option>
                                                   <option value="6" <?php if ($Val['soshiki_ID'] === '6') echo 'selected'; ?>>
                                                      <p>○○グループ</p>
                                                   </option>
                                                </select>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>課名</p>
                                             </td>
                                             <td>
                                                <select name="shain_info[ka_ID]" id="b7" class="inuput_width" disabled>
                                                   <option value="0" <?php if ($Val['ka_ID'] === '0') echo 'selected'; ?>>
                                                      <p></p>
                                                   </option>
                                                   <option value="1" <?php if ($Val['ka_ID'] === '1') echo 'selected'; ?>>
                                                      <p>１課</p>
                                                   </option>
                                                   <option value="2" <?php if ($Val['ka_ID'] === '2') echo 'selected'; ?>>
                                                      <p>２課</p>
                                                   </option>
                                                   <option value="3" <?php if ($Val['ka_ID'] === '3') echo 'selected'; ?>>
                                                      <p>３課</p>
                                                   </option>
                                                   <option value="4" <?php if ($Val['ka_ID'] === '4') echo 'selected'; ?>>
                                                      <p>経営戦略課</p>
                                                   </option>
                                                </select>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>部署名</p>
                                             </td>
                                             <td>
                                                <select name="shain_info[bu_ID]" id="b8" class="inuput_width" disabled>
                                                   <option value="0" <?php if ($Val['bu_ID'] === '0') echo 'selected'; ?>>
                                                      <p></p>
                                                   </option>
                                                   <option value="1" <?php if ($Val['bu_ID'] === '1') echo 'selected'; ?>>
                                                      <p>代表</p>
                                                   </option>
                                                   <option value="2" <?php if ($Val['bu_ID'] === '2') echo 'selected'; ?>>
                                                      <p>相談役</p>
                                                   </option>
                                                   <option value="11" <?php if ($Val['bu_ID'] === '11') echo 'selected'; ?>>
                                                      <p>■■部</p>
                                                   </option>
                                                   <option value="12" <?php if ($Val['bu_ID'] === '12') echo 'selected'; ?>>
                                                      <p>▼▼部</p>
                                                   </option>
                                                   <option value="13" <?php if ($Val['bu_ID'] === '13') echo 'selected'; ?>>
                                                      <p>＠＠部</p>
                                                   </option>
                                                   <option value="14" <?php if ($Val['bu_ID'] === '14') echo 'selected'; ?>>
                                                      <p>＊＊＊部</p>
                                                   </option>
                                                   <option value="16" <?php if ($Val['bu_ID'] === '16') echo 'selected'; ?>>
                                                      <p>＄＄＄部</p>
                                                   </option>
                                                   <option value="17" <?php if ($Val['bu_ID'] === '17') echo 'selected'; ?>>
                                                      <p>＃＃＃部</p>
                                                   </option>
                                                   <option value="18" <?php if ($Val['bu_ID'] === '18') echo 'selected'; ?>>
                                                      <p>｜｜｜｜部</p>
                                                   </option>
                                                   <option value="99" <?php if ($Val['bu_ID'] === '99') echo 'selected'; ?>>
                                                      <p>その他</p>
                                                   </option>
                                                   <option value="15" <?php if ($Val['bu_ID'] === '15') echo 'selected'; ?>>
                                                      <p>＾＾＾部</p>
                                                   </option>
                                                   <option value="19" <?php if ($Val['bu_ID'] === '19') echo 'selected'; ?>>
                                                      <p>！！！部</p>
                                                   </option>
                                                   <option value="20" <?php if ($Val['bu_ID'] === '20') echo 'selected'; ?>>
                                                      <p>””””部</p>
                                                   </option>
                                                   <option value="21" <?php if ($Val['bu_ID'] === '21') echo 'selected'; ?>>
                                                      <p>「「「「部</p>
                                                   </option>
                                                   <option value="50" <?php if ($Val['bu_ID'] === '50') echo 'selected'; ?>>
                                                      <p>＋＋＋部</p>
                                                   </option>
                                                   <option value="60" <?php if ($Val['bu_ID'] === '60') echo 'selected'; ?>>
                                                      <p>＆＆＆＆＆＆</p>
                                                   </option>
                                                </select>
                                             </td>

                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>社員区分</p>
                                             </td>
                                             <td>
                                                <select name="shain_info[shainkubun_ID]" id="b9" class="inuput_width" disabled>
                                                   <option value="0" <?php if ($Val['shainkubun_ID'] === '0') echo 'selected'; ?>>
                                                      <p></p>
                                                   </option>
                                                   <option value="1" <?php if ($Val['shainkubun_ID'] === '1') echo 'selected'; ?>>
                                                      <p>正社員</p>
                                                   </option>
                                                   <option value="2" <?php if ($Val['shainkubun_ID'] === '2') echo 'selected'; ?>>
                                                      <p>短時間正社員</p>
                                                   </option>
                                                   <option value="3" <?php if ($Val['shainkubun_ID'] === '3') echo 'selected'; ?>>
                                                      <p>パート</p>
                                                   </option>
                                                </select>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>役職名</p>
                                             </td>
                                             <td>
                                                <select name="shain_info[yakushoku_id]" id="b10" class="inuput_width" disabled>
                                                   <option value="0" <?php if ($Val['yakushoku_id'] === '0') echo 'selected'; ?>>
                                                      <p></p>
                                                   </option>
                                                   <option value="1" <?php if ($Val['yakushoku_id'] === '1') echo 'selected'; ?>>
                                                      <p>相談役</p>
                                                   </option>
                                                   <option value="2" <?php if ($Val['yakushoku_id'] === '2') echo 'selected'; ?>>
                                                      <p>会長</p>
                                                   </option>
                                                   <option value="3" <?php if ($Val['yakushoku_id'] === '3') echo 'selected'; ?>>
                                                      <p>代表</p>
                                                   </option>
                                                   <option value="4" <?php if ($Val['yakushoku_id'] === '4') echo 'selected'; ?>>
                                                      <p>支社長</p>
                                                   </option>
                                                   <option value="5" <?php if ($Val['yakushoku_id'] === '5') echo 'selected'; ?>>
                                                      <p>専務</p>
                                                   </option>
                                                   <option value="6" <?php if ($Val['yakushoku_id'] === '6') echo 'selected'; ?>>
                                                      <p>常務</p>
                                                   </option>
                                                   <option value="7" <?php if ($Val['yakushoku_id'] === '7') echo 'selected'; ?>>
                                                      <p>部長</p>
                                                   </option>
                                                   <option value="8" <?php if ($Val['yakushoku_id'] === '8') echo 'selected'; ?>>
                                                      <p>次長</p>
                                                   </option>
                                                   <option value="9" <?php if ($Val['yakushoku_id'] === '9') echo 'selected'; ?>>
                                                      <p>課長</p>
                                                   </option>
                                                   <option value="10" <?php if ($Val['yakushoku_id'] === '10') echo 'selected'; ?>>
                                                      <p>係長</p>
                                                   </option>
                                                   <option value="11" <?php if ($Val['yakushoku_id'] === '11') echo 'selected'; ?>>
                                                      <p>主任</p>
                                                   </option>
                                                   <option value="12" <?php if ($Val['yakushoku_id'] === '12') echo 'selected'; ?>>
                                                      <p>一般</p>
                                                   </option>
                                                   <option value="13" <?php if ($Val['yakushoku_id'] === '13') echo 'selected'; ?>>
                                                      <p>パート</p>
                                                   </option>
                                                   <option value="14" <?php if ($Val['yakushoku_id'] === '14') echo 'selected'; ?>>
                                                      <p>外注</p>
                                                   </option>
                                                   <option value="15" <?php if ($Val['yakushoku_id'] === '15') echo 'selected'; ?>>
                                                      <p>室長</p>
                                                   </option>
                                                   <option value="16" <?php if ($Val['yakushoku_id'] === '16') echo 'selected'; ?>>
                                                      <p>理事</p>
                                                   </option>
                                                   <option value="17" <?php if ($Val['yakushoku_id'] === '17') echo 'selected'; ?>>
                                                      <p>理事長</p>
                                                   </option>
                                                   <option value="18" <?php if ($Val['yakushoku_id'] === '18') echo 'selected'; ?>>
                                                      <p>常務理事</p>
                                                   </option>
                                                   <option value="19" <?php if ($Val['yakushoku_id'] === '19') echo 'selected'; ?>>
                                                      <p>監事</p>
                                                   </option>
                                                   <option value="20" <?php if ($Val['yakushoku_id'] === '20') echo 'selected'; ?>>
                                                      <p>代表取締役</p>
                                                   </option>
                                                   <option value="21" <?php if ($Val['yakushoku_id'] === '21') echo 'selected'; ?>>
                                                      <p>社長</p>
                                                   </option>
                                                   <option value="22" <?php if ($Val['yakushoku_id'] === '22') echo 'selected'; ?>>
                                                      <p>理事</p>
                                                   </option>
                                                   <option value="23" <?php if ($Val['yakushoku_id'] === '23') echo 'selected'; ?>>
                                                      <p>副社長</p>
                                                   </option>
                                                   <option value="24" <?php if ($Val['yakushoku_id'] === '24') echo 'selected'; ?>>
                                                      <p>理事長</p>
                                                   </option>
                                                   <option value="25" <?php if ($Val['yakushoku_id'] === '25') echo 'selected'; ?>>
                                                      <p>常務理事</p>
                                                   </option>
                                                </select>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>電話番号</p>
                                             </td>
                                             <td><input type="text" name="shain_info[tel_main]" id="b11" value="<?php echo $Val['tel_main']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>電話番号２</p>
                                             </td>
                                             <td><input type="text" name="shain_info[tel_sub]" id="b12" value="<?php echo $Val['tel_sub']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>メールアドレス</p>
                                             </td>
                                             <td><input type="text" name="shain_info[mail]" id="b13" value="<?php echo $Val['mail']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>入社年月日</p>
                                             </td>
                                             <td><input type="date" name="shain_info[nyusha_nengapi]" id="b14" value="<?php echo $Val['nyusha_nengapi']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku"></td>
                                             <p>退社年月日</p>
                                             </td>
                                             <td><input type="date" name="shain_info[taisha_nengapi]" id="b15" value="<?php echo $Val['taisha_nengapi']; ?>" class="inuput_width" disabled></td>

                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>生年月日</p>
                                             </td>
                                             <td><input type="date" name="shain_info[seinengapi]" id="b16" value="<?php echo $Val['seinengapi']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>性別</p>
                                             </td>
                                             <td>
                                                <select name="shain_info[seibetu]" id="b17" class="inuput_width" disabled>
                                                   <option value="男" <?php if ($Val['seibetu'] === '男') echo 'selected'; ?>>
                                                      <p>男</p>
                                                   </option>
                                                   <option value="女" <?php if ($Val['gakureki_id'] === '女') echo 'selected'; ?>>
                                                      <p>女</p>
                                                   </option>
                                                </select>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>資格01</p>
                                             </td>
                                             <td><input type="text" name="shain_info[sikaku1]" id="b18" value="<?php echo $Val['sikaku1']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>資格02</p>
                                             </td>
                                             <td><input type="text" name="shain_info[sikaku2]" id="b19" value="<?php echo $Val['sikaku2']; ?>" class="inuput_width" disabled></td>

                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>資格03</p>
                                             </td>
                                             <td><input type="text" name="shain_info[sikaku3]" id="b20" value="<?php echo $Val['sikaku3']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>資格04</p>
                                             </td>
                                             <td><input type="text" name="shain_info[sikaku4]" id="b21" value="<?php echo $Val['sikaku4']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>資格05</p>
                                             </td>
                                             <td><input type="text" name="shain_info[sikaku5]" id="b22" value="<?php echo $Val['sikaku5']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>学歴</p>
                                             </td>
                                             <td>
                                                <select name="shain_info[gakureki_id]" id="b23" class="inuput_width" disabled>
                                                   <option value="0" <?php if ($Val['gakureki_id'] === '0') echo 'selected'; ?>>
                                                      <p></p>
                                                   </option>
                                                   <option value="1" <?php if ($Val['gakureki_id'] === '1') echo 'selected'; ?>>
                                                      <p>大学院</p>
                                                   </option>
                                                   <option value="2" <?php if ($Val['gakureki_id'] === '2') echo 'selected'; ?>>
                                                      <p>大学</p>
                                                   </option>
                                                   <option value="3" <?php if ($Val['gakureki_id'] === '3') echo 'selected'; ?>>
                                                      <p>短大</p>
                                                   </option>
                                                   <option value="4" <?php if ($Val['gakureki_id'] === '4') echo 'selected'; ?>>
                                                      <p>専門学校</p>
                                                   </option>
                                                   <option value="5" <?php if ($Val['gakureki_id'] === '5') echo 'selected'; ?>>
                                                      <p>高校</p>
                                                   </option>
                                                </select>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>卒業校</p>
                                             </td>
                                             <td><input type="text" name="shain_info[sotugyoko]" id="b24" value="<?php echo $Val['sotugyoko']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>備考</p>
                                             </td>
                                             <td><input type="text" name="shain_info[biko]" id="b25" value="<?php echo $Val['biko']; ?>" class="inuput_width" disabled></td>
                                          </tr>
                                          <tr>
                                             <td class="Koumoku">
                                                <p>アクセス権限</p>
                                             </td>
                                             <td><input type="text" name="shain_info[Shain_kanri_kengen]" value="<?php if ($Val['Shain_kanri_kengen'] === '0') {
                                                                                                                     echo 'アクセス権無し';
                                                                                                                  } else {
                                                                                                                     echo '全権限あり';
                                                                                                                  } ?>" class="inuput_width" disabled></td>
                                          </tr>
                                       </table>
                                    </div>
                                 </div>
                                 <div class="tab_page">
                                    <p>準備中です。</p>
                                 </div>
                                 <div class="tab_page">
                                    <p>準備中です。</p>
                                 </div>
                                 <div class="tab_page">
                                    <div class="ido_rireki">
                                       <table>
                                          <tr>
                                             <th class="Koumoku02">
                                                <p>役職異動前</p>
                                             </th>
                                             <th class="Koumoku02">
                                                <p>役職異動後</p>
                                             </th>
                                             <th class="Koumoku02">
                                                <p>部署異動前</p>
                                             </th>
                                             <th class="Koumoku02">
                                                <p>部署異動後</p>
                                             </th>
                                             <th class="Koumoku02">
                                                <p>最終変更日時</p>
                                             </th>
                                          </tr>
                                          <?php foreach ($IDo_Rireki as $key => $value) { ?>
                                             <?php if ($value['shain_ID'] == $_SESSION['userID']) { ?>
                                                <tr>
                                                   <td><?php echo $value['henkomae_yakushoku_Name']; ?></td>
                                                   <td><?php echo $value['henkogo_yakushoku_Name']; ?></td>
                                                   <td><?php echo $value['henkomae_busho_Name']; ?></td>
                                                   <td><?php echo $value['henkogo_busho_Name']; ?></td>
                                                   <td><?php echo $value['torokubi']; ?></td>
                                                </tr>
                                             <?php } ?>
                                          <?php } ?>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                        </form>
                     <?php } ?>
                  <?php } ?>
               <?php } else { ?>
                  <!-- 

                    基本情報等のボックス（誰も選択されていない場合）

                      -->
                  <!-- ログイン時の状態 -->

                  <div class="tab_sub_shain_info">
                     <input type="radio" name="tabs" id="tab_01" checked>
                     <input type="radio" name="tabs" id="tab_02">
                     <input type="radio" name="tabs" id="tab_03">
                     <input type="radio" name="tabs" id="tab_04">

                     <div class="tab_btns">
                        <label for="tab_01" class="tab_btn">基本情報</label>
                        <label for="tab_02" class="tab_btn">車両情報</label>
                        <label for="tab_03" class="tab_btn">保険情報</label>
                        <label for="tab_03" class="tab_btn">異動履歴</label>
                     </div>

                     <div class="tab_pages">
                        <div class="tab_page">
                           <p class="Nothing">選択されてません</p>
                        </div>
                     </div>
                     <div class="tab_page">
                        <p>準備中です。</p>
                     </div>
                     <div class="tab_page">
                        <p>準備中です。</p>
                     </div>
                     <div class="tab_page">
                        <p>準備中です。</p>
                     </div>
                  </div>

                  <!-- ログイン時の状態 -->
               <?php } ?>
            </div>
            <br />
         </div>

         <!-- 

            新規登録処理（基本情報）

             -->
         <div class="tab_content" id="programming_content">
            <form action="./function_folda/function_DB_conect.php" method="POST">
               <button class="shain_shinki" name="shain_shinki">新規登録</button>
               <div class="tab_shin">
                  <input type="radio" name="tabs" id="tab_shin_01" checked>
                  <input type="radio" name="tabs" id="tab_shin_02">
                  <input type="radio" name="tabs" id="tab_shin_03">

                  <div class="tab_btns_shin_main">
                     <label for="tab_shin_01" class="tab_btn_shin">基本情報登録</label>
                     <label for="tab_shin_02" class="tab_btn_shin">車両情報登録</label>
                     <label for="tab_shin_03" class="tab_btn_shin">保険情報登録</label>
                  </div>

                  <div class="tab_pages_shin_main">
                     <div class="tab_pages_shin">
                        <div class="shin">
                           <table>
                              <tr>
                                 <td class="Date_M_T">
                                    <p>社員ID</p>
                                 </td>
                                 <td class="input_td"><input type="number" min=1 max=99999 name="Shin_info[ID]" value="<?php echo $Last_ID; ?>" class="inuput_width" readonly></td>
                                 <td class="Date_M_T">
                                    <p>社員氏名（姓）</p>
                                 </td>
                                 <td class="input_td"><input type="text" name="Shin_info[sei]" value="" class="inuput_width"></td>
                                 <td class="Date_M_T">
                                    <p>社員氏名（名）</p>
                                 </td>
                                 <td class="input_td"><input type="text" name="Shin_info[mei]" value="" class="inuput_width"></td>

                              </tr>
                              <tr>
                                 <td class="Date_M_T">
                                    <p>デスクネッツ名</p>
                                 </td>
                                 <td class="input_td"><input type="text" name="Shin_info[sys_name]" value="" class="inuput_width"></td>
                                 <td class="Date_M_T">
                                    <p>社員氏名（セイ）</p>
                                 </td>
                                 <td class="input_td"><input type="text" name="Shin_info[sei_kana]" value="" class="inuput_width"></td>
                                 <td class="Date_M_T">
                                    <p>社員氏名（メイ）</p>
                                 </td>
                                 <td class="input_td"><input type="text" name="Shin_info[mei_kana]" value="" class="inuput_width"></td>

                              </tr>
                              <tr>
                                 <td class="Date_M_T">
                                    <p>組織名</p>
                                 </td>
                                 <td class="input_td">
                                    <select name="Shin_info[soshiki_ID]" class="inuput_width_select">
                                       <option value="0">
                                          <p></p>
                                       </option>
                                       <option value="1">
                                          <p>○○法人テスト</p>
                                       </option>
                                       <option value="2">
                                          <p>○○会社テスト</p>
                                       </option>
                                       <option value="3">
                                          <p>○○会社財政</p>
                                       </option>
                                       <option value="4">
                                          <p>○○行政</p>
                                       </option>
                                       <option value="0">
                                          <p>○○社労</p>
                                       </option>
                                       <option value="0">
                                          <p>○○グループ</p>
                                       </option>
                                    </select>
                                 </td>
                                 <td class="Date_M_T">
                                    <p>課名</p>
                                 </td>
                                 <td class="input_td">
                                    <select name="Shin_info[ka_ID]" class="inuput_width_select">
                                       <option value="0">
                                          <p></p>
                                       </option>
                                       <option value="1">
                                          <p>１課</p>
                                       </option>
                                       <option value="2">
                                          <p>２課</p>
                                       </option>
                                       <option value="3">
                                          <p>３課</p>
                                       </option>
                                       <option value="4">
                                          <p>４課</p>
                                       </option>
                                       <option value="0">
                                          <p>該当なし</p>
                                       </option>
                                    </select>
                                 </td>
                                 <td class="Date_M_T">
                                    <p>部署名</p>
                                 </td>
                                 <td class="input_td">
                                    <select name="Shin_info[bu_ID]" class="inuput_width_select">
                                       <option value="0">
                                          <p></p>
                                       </option>
                                       <option value="1">
                                          <p>代表</p>
                                       </option>
                                       <option value="2">
                                          <p>相談役</p>
                                       </option>
                                       <option value="11">
                                          <p>■■部</p>
                                       </option>
                                       <option value="12">
                                          <p>▼▼部</p>
                                       </option>
                                       <option value="13">
                                          <p>＠＠部</p>
                                       </option>
                                       <option value="14">
                                          <p>＊＊＊部</p>
                                       </option>
                                       <option value="16">
                                          <p>＄＄＄部</p>
                                       </option>
                                       <option value="17">
                                          <p>＃＃＃部</p>
                                       </option>
                                       <option value="18">
                                          <p>｜｜｜｜部</p>
                                       </option>
                                       <option value="99">
                                          <p>その他</p>
                                       </option>
                                       <option value="15">
                                          <p>＾＾＾部</p>
                                       </option>
                                       <option value="19">
                                          <p>！！！部</p>
                                       </option>
                                       <option value="20">
                                          <p>””””部</p>
                                       </option>
                                       <option value="21">
                                          <p>「「「「部</p>
                                       </option>
                                       <option value="50">
                                          <p>＋＋＋部</p>
                                       </option>
                                       <option value="60">
                                          <p>＆＆＆＆＆＆</p>
                                       </option>
                                    </select>
                                 </td>
                              </tr>

                              <tr>
                                 <td class="Date_M_T">
                                    <p>役職名</p>
                                 </td>
                                 <td class="input_td">
                                    <select name="Shin_info[yakushoku_id]" class="inuput_width_select">
                                       <option value="0">
                                          <p></p>
                                       </option>
                                       <option value="1">
                                          <p>相談役</p>
                                       </option>
                                       <option value="2">
                                          <p>会長</p>
                                       </option>
                                       <option value="3">
                                          <p>代表</p>
                                       </option>
                                       <option value="4">
                                          <p>支社長</p>
                                       </option>
                                       <option value="5">
                                          <p>専務</p>
                                       </option>
                                       <option value="6">
                                          <p>常務</p>
                                       </option>
                                       <option value="7">
                                          <p>部長</p>
                                       </option>
                                       <option value="8">
                                          <p>次長</p>
                                       </option>
                                       <option value="9">
                                          <p>課長</p>
                                       </option>
                                       <option value="10">
                                          <p>係長</p>
                                       </option>
                                       <option value="11">
                                          <p>主任</p>
                                       </option>
                                       <option value="12">
                                          <p>一般</p>
                                       </option>
                                       <option value="13">
                                          <p>パート</p>
                                       </option>
                                       <option value="14">
                                          <p>外注</p>
                                       </option>
                                       <option value="15">
                                          <p>室長</p>
                                       </option>
                                       <option value="16">
                                          <p>理事</p>
                                       </option>
                                       <option value="17">
                                          <p>理事長</p>
                                       </option>
                                       <option value="18">
                                          <p>常務理事</p>
                                       </option>
                                       <option value="19">
                                          <p>監事</p>
                                       </option>
                                       <option value="20">
                                          <p>代表取締役</p>
                                       </option>
                                       <option value="21">
                                          <p>社長</p>
                                       </option>
                                       <option value="22">
                                          <p>理事</p>
                                       </option>
                                       <option value="23">
                                          <p>副社長</p>
                                       </option>
                                       <option value="24">
                                          <p>理事長</p>
                                       </option>
                                       <option value="25">
                                          <p>常務理事</p>
                                       </option>
                                    </select>
                                 </td>
                                 <td class="Date_M_T">
                                    <p>社員区分</p>
                                 </td>
                                 <td class="input_td">
                                    <select name="Shin_info[shainkubun_ID]" class="inuput_width_select">
                                       <option value="0">
                                          <p></p>
                                       </option>
                                       <option value="1">
                                          <p>正社員</p>
                                       </option>
                                       <option value="2">
                                          <p>短時間正社員</p>
                                       </option>
                                       <option value="3">
                                          <p>パート</p>
                                       </option>
                                    </select>
                                 </td>
                                 <td class="Date_M_T">
                                    <p>性別</p>
                                 </td>
                                 <td class="input_td">
                                    <select name="Shin_info[seibetu]" class="inuput_width_select">
                                       <option value="">
                                          <p></p>
                                       </option>
                                       <option value="男">
                                          <p>男</p>
                                       </option>
                                       <option value="女">
                                          <p>女</p>
                                       </option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="Date_M_T">
                                    <p>入社年月日</p>
                                 </td>
                                 <td class="input_td"><input type="date" value="" name="Shin_info[nyusha_nengapi]" class="inuput_width_day"></td>
                                 <td class="Date_M_T">
                                    <p>退社年月日</p>
                                 </td>
                                 <td class="input_td"><input type="date" value="" name="Shin_info[taisha_nengapi]" class="inuput_width_day"></td>
                                 <td class="Date_M_T">
                                    <p>生年月日</p>
                                 </td>
                                 <td class="input_td"><input type="date" value="" name="Shin_info[seinengapi]" class="inuput_width_day"></td>
                              </tr>
                              <tr>
                                 <td class="Date_M_T">
                                    <p>電話番号</p>
                                 </td>
                                 <td class="input_td"><input type="text" name="Shin_info[tel_main]" value="" class="inuput_width"></td>
                                 <td class="Date_M_T">
                                    <p>電話番号２</p>
                                 </td>
                                 <td class="input_td"><input type="text" name="Shin_info[tel_sub]" class="inuput_width"></td>
                                 <td class="Date_M_T">
                                    <p>資格01</p>
                                 </td>
                                 <td class="input_td"><input type="text" value="" name="Shin_info[sikaku1]" class="inuput_width"></td>
                              </tr>
                              <tr>

                                 <td class="Date_M_T">
                                    <p>資格02</p>
                                 </td>
                                 <td class="input_td"><input type="text" value="" name="Shin_info[sikaku2]" class="inuput_width"></td>
                                 <td class="Date_M_T">
                                    <p>資格03</p>
                                 </td>
                                 <td class="input_td"><input type="text" value="" name="Shin_info[sikaku3]" class="inuput_width"></td>
                                 <td class="Date_M_T">
                                    <p>資格04</p>
                                 </td>
                                 <td class="input_td"><input type="text" value="" name="Shin_info[sikaku4]" class="inuput_width"></td>
                              </tr>
                              <tr>

                                 <td class="Date_M_T">
                                    <p>資格05</p>
                                 </td>
                                 <td class="input_td"><input type="text" value="" name="Shin_info[sikaku5]" class="inuput_width"></td>
                                 <td class="Date_M_T">
                                    <p>備考</p>
                                 </td>
                                 <td class="input_td"><input type="text" value="" name="Shin_info[biko]" class="inuput_width"></td>
                                 <td class="Date_M_T">
                                    <p>学歴</p>
                                 </td>
                                 <td class="input_td">
                                    <select name="Shin_info[gakureki_id]" class="inuput_width_select">
                                       <option value="0">
                                          <p></p>
                                       </option>
                                       <option value="1">
                                          <p>大学院</p>
                                       </option>
                                       <option value="2">
                                          <p>大学</p>
                                       </option>
                                       <option value="3">
                                          <p>短大</p>
                                       </option>
                                       <option value="4">
                                          <p>専門学校</p>
                                       </option>
                                       <option value="5">
                                          <p>高校</p>
                                       </option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="Date_M_T">
                                    <p>卒業校</p>
                                 </td>
                                 <td class="input_td"><input type="text" value="" name="Shin_info[sotugyoko]" class="inuput_width"></td>
                                 <td class="Date_M_T">
                                    <p>アクセス権限</p>
                                 </td>
                                 <td class="input_td">
                                    <select name="Shin_info[Shain_kanri_kengen]" class="inuput_width_select">
                                       <option value="0">
                                          <p>アクセス権なし</p>
                                       </option>
                                       <option value="1">
                                          <p>全権限あり</p>
                                       </option>
                                    </select>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>


                     <!-- 

                    新規登録処理（車両情報）

                    -->
                     <div class="tab_pages_shin">
                        <p>準備中です。</p>
                     </div>

                     <!-- 

                    新規登録処理（保険情報）

                    -->
                     <div class="tab_pages_shin">
                        <p>準備中です。</p>
                     </div>

                  </div>
               </div>
            </form>
         </div>

         <!-- 

            アクセス権限設定

            -->
         <div class="tab_content" id="design_content">
            <div class="Access_Block">

               <table class="Access_table" id="access_table">
                  <thead>
                     <tr>
                        <th>社員名</th>
                        <th>部署</th>
                        <th>役職</th>
                        <th>社員管理</th>
                        <!-- <th>変更履歴</th>
                      <th>変更届管理</th> -->
                     </tr>
                  </thead>
                  <form action="./function_folda/function_DB_conect.php" method="POST">
                     <div class="button_block">
                        <input type="text" name="jyoken" id="quick_search02">
                        <button class="Ac_up" name="Ac_up_button">更新</button>
                     </div>
                     <?php foreach ($Access_Shanin as $ac_key => $ac_val) { ?>
                        <tr id="access_tr">
                           <td><?php echo $ac_val['sei'] . "　" . $ac_val['mei']; ?></td>
                           <td><?php echo $ac_val['bumei']; ?></td>
                           <td><?php echo $ac_val['yakushokumei']; ?></td>
                           <?php foreach ($Ac_Syurui as $ac_kan_val) { ?>
                              <td>
                                 <select name='access[<?php echo $ac_val[0] . $ac_kan_val; ?>]'>
                                    <option value=""></option>
                                    <option value="<?php echo $ac_val[0] ?>_0" <?php if ($ac_val['Shain_kanri_kengen'] === '0') echo 'selected'; ?>>アクセス権なし</option>
                                    <option value="<?php echo $ac_val[0] ?>_1" <?php if ($ac_val['Shain_kanri_kengen'] === '1') echo 'selected'; ?>>全権限あり</option>
                                 </select>
                              </td>
                           <?php } ?>
                           <input type="hidden" value="<?php echo $ac_val[1]; ?>">
                        </tr>
                     <?php } ?>
                     <form>
               </table>
            </div>
         </div>
      </div>

      <div id="tab-content2" class="tab-content">
         <p>準備中です。</p>
      </div>

      <div id="tab-content3" class="tab-content">
         <p>準備中です。</p>
      </div>
   </div>

   </div>


</body>

</html>
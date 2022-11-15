<?php
include_once './function_folda/Page.php';
include_once './function_folda/function_kokyaku_kanri.php';
include_once './function_folda/function_DB_conect.php';
include_once './function_folda/function.php';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="./asset/css/header.css">
   <link rel="stylesheet" href="./asset/css/search_top.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script type="text/javascript" src="./asset/js/real_time.js"></script>
   <script type="text/javascript" src="./asset/js/main.js"></script>
   <script type="text/javascript" src="./asset/js/UI_main.js"></script>
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
                  <a href="#" class="init-right">ログオフ</a>
               </li>
            </ul>
         </li>
      </ul>
   </div>
</header>

<body onload="firstscript('reload');">
   <!-- 検索エリア -->
   <div class="search_top">
      <form action="./function_folda/function_kokyaku_kanri.php" method="POST" id="Form_Method">
         <table>
            <tr>
               <th colspan="3">基本情報</th>
               <th colspan="3">郵送情報</th>
            </tr>
            <tr>
               <td class="td_title">TKCコード</td>
               <td colspan="2"><input type="number" min=1 max=999 name="search[TKC_ID]" placeholder=""></td>
               <td class="td_title">ビル・マンション名</td>
               <td colspan="2"><input type="number" min=1 max=999 name="search[yubin_jyusho_01]" placeholder=""></td>
            </tr>
            <tr>
               <td class="td_title">請求コード</td>
               <td colspan="2"><input type="number" min=1 max=10000 name="search[Tokuisaki_ID]" placeholder=""></td>
               <td class="td_title">担当者</td>
               <td colspan="2">
                  <input type="search" name="search[daihyo_Name_furigna_kojin_FM]" placeholder="">
               </td>
            </tr>
            <tr>
               <td class="td_title">商号フリガナ</td>
               <td colspan="2"><input type="search" name="search[Company_Name_furigana]" placeholder=""></td>
               <td class="td_title">役職</td>
               <td colspan="2"><input type="search" name="search[Yakushoku]" placeholder=""></td>
            </tr>
            <tr>
               <td class="td_title">商号</td>
               <td colspan="2"><input type="search" name="search[Company_Name]" placeholder=""></td>
               <td class="td_title">敬称</td>
               <td colspan="2"><input type="search" name="search[Shogo_Keisho]" placeholder=""></td>
            </tr>
            <tr>
               <td class="td_title">通称</td>
               <td colspan="2"><input type="search" name="search[tusho]" placeholder=""></td>
               <td class="td_title">代表者/個人 宛名印字</td>
               <td colspan="2"><input type="search" name="search[atena]" placeholder=""></td>
            </tr>
            <tr>
               <td class="td_title">代表フリガナ</td>
               <td colspan="2"><input type="search" name="search[daihyo_Name_furigna]" placeholder=""></td>
               <td class="td_title">郵便物送付先担当者</td>
               <td colspan="2"><input type="search" name="search[yubin_tanto]" placeholder=""></td>
            </tr>
            <tr>
               <td class="td_title">〒</td>
               <td colspan="2"><input type="search" name="search[daihyo_Name]" placeholder=""></td>
               <td class="td_title">郵便物</td>
               <td colspan="2"><input type="search" name="search[Yubin_syurui]" placeholder=""></td>
            </tr>
            <tr>
               <td class="td_title">申告住所</td>
               <td colspan="2"><input type="search" name="search[Jyusho_01]" placeholder=""></td>
               <td class="td_title">医療情報誌</td>
               <td colspan="2"><input type="search" name="search[Iryou_zassh]" placeholder=""></td>

            </tr>
            <tr>
               <td class="td_title">HP</td>
               <td colspan="2"><input type="search" name="search[Company_HP]" placeholder=""></td>
            </tr>
            <tr>
               <td class="td_title">資本金</td>
               <td class="kin"><input type="number" min=1 max=9999999 name="search[Shihonkin01]" placeholder="" class="search_box_L">&nbsp;～<input type="number" min=1 max=9999999 name="search[Shihonkin02]" placeholder="" class="search_box_L"></td>
            </tr>
            <tr>
               <td class="td_title">TEL</td>
               <td><input type="number" min=1 max=99999999999 name="search[Campany_Tel]" placeholder=""></td>
            </tr>
            <tr>
               <td class="td_title">FAX</td>
               <td class="kin"><input type="number" min=1 max=99999999999 name="search[Campany_Fax]" placeholder=""></td>
            </tr>
            <tr>
               <td class="td_title">MAIL</td>
               <td class="kin"><input type="number" min=1 max=99999999999 name="search[Campany_Mail]" placeholder=""></td>
            </tr>
            <tr>
               <td class="td_title">発行済株式の総数</td>
               <td class="kin"><input type="number" min=1 max=9999999 name="search[Hako_Kabu_sosu01]" placeholder="" class="search_box_L">&nbsp;～<input type="number" min=1 max=9999999 name="search[Hako_Kabu_sosu02]" placeholder="" class="search_box_L"></td>
            </tr>
            <tr>
               <td class="td_title">自己株式</td>
               <td class="kin"><input type="number" min=1 max=9999999 name="search[Jikokabu01]" placeholder="" class="search_box_L">&nbsp;～<input type="number" min=1 max=9999999 name="search[Jikokabu02]" placeholder="" class="search_box_L"></td>
            </tr>
            <tr>
               <td class="td_title">株式の譲渡制限</td>
               <td>
                  <select size="1" name="search[Kabushiki_Jhoto]">
                     <option value=""></option>
                     <option value="全部">全部</option>
                     <option value="無">無</option>
                  </select>
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
                  <input type="number" min=1 max=999 name="search[oya_kaisha]" placeholder="">
               </td>
               <td class="td_title">請求開始</td>
               <td colspan="2">
                  <select size="1" class="Mon" name="search[seikyu_kaishi01]">
                     <option value=""></option>
                     <?php for ($j = 1; $j <= 12; $j++) { ?>
                        <option value="<?php echo $j ?>"><?php echo $j; ?></option>
                     <?php } ?>
                  </select>
                  &nbsp;<p>月～</p>
                  <select size="1" class="Mon" name="search[seikyu_kaishi02]">
                     <option value=""></option>
                     <?php for ($j = 1; $j <= 12; $j++) { ?>
                        <option value="<?php echo $j ?>"><?php echo $j; ?></option>
                     <?php } ?>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">関与形態</td>
               <td colspan="2">
                  <select size="1" name="search[ketai]">
                     <option value=""></option>
                     <option value="Ａ">Ａ</option>
                     <option value="Ｂ">Ｂ</option>
                     <option value="Ｃ">Ｃ</option>
                     <option value="Ｄ">Ｄ</option>
                     <option value="Ｅ">Ｅ</option>
                     <option value="E1">E1</option>
                     <option value="E2">E2</option>
                  </select>
               </td>
               <td class="td_title">請求開始月</td>
               <td colspan="2">
                  <select size="1" class="Mon" name="search[seikyu_kaishi_month01]" class="se_01">
                     <option value=""></option>
                     <?php for ($i = 1; $i <= 12; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i; ?></option>
                     <?php } ?>
                  </select>
                  &nbsp;<p>月～</p>
                  <select size="1" class="Mon" name="search[seikyu_kaishi_month02]">
                     <option value=""></option>
                     <?php for ($j = 1; $j <= 12; $j++) { ?>
                        <option value="<?php echo $j ?>"><?php echo $j; ?></option>
                     <?php } ?>
                  </select>
                  <!-- <p>月計算分からスタート</p><br/> -->
               </td>
            </tr>
            <tr>
               <td class="td_title">決算月</td>
               <td colspan="2">
                  <select class="Mon" size="1" name="search[kesan_month01]">
                     <option value=""></option>
                     <option value="1">1月</option>
                     <option value="2">2月</option>
                     <option value="3">3月</option>
                     <option value="4">4月</option>
                     <option value="5">5月</option>
                     <option value="6">6月</option>
                     <option value="7">7月</option>
                     <option value="8">8月</option>
                     <option value="9">9月</option>
                     <option value="10">10月</option>
                     <option value="11">11月</option>
                     <option value="12">12月</option>
                  </select>
                  &nbsp;<p>月 ～</p>
                  <select size="1" class="Mon" name="search[kesan_month02]">
                     <option value=""></option>
                     <option value="1">1月</option>
                     <option value="2">2月</option>
                     <option value="3">3月</option>
                     <option value="4">4月</option>
                     <option value="5">5月</option>
                     <option value="6">6月</option>
                     <option value="7">7月</option>
                     <option value="8">8月</option>
                     <option value="9">9月</option>
                     <option value="10">10月</option>
                     <option value="11">11月</option>
                     <option value="12">12月</option>
                  </select>
               </td>
               <td class="td_title">自振請求</td>
               <td colspan="2">
                  <select size="1" name="search[jihuriseikyu]">
                     <option value=""></option>
                     <option value="有">有</option>
                     <option value="無">無</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">区分名</td>
               <td colspan="2">
                  <select size="1" name="search[hojin_kubun]">
                     <option value=""></option>
                     <option value="株式会社">株式会社</option>
                     <option value="有限会社">有限会社</option>
                     <option value="医療法人">医療法人</option>
                     <option value="社会福祉法人">社会福祉法人</option>
                     <option value="その他の法人">その他の法人</option>
                     <option value="合同会社">合同会社</option>
                     <option value="協同組合">協同組合</option>
                     <option value="協同組合">協同組合</option>
                     <option value="財団法人">財団法人</option>
                     <option value="宗教法人">宗教法人</option>
                     <option value="個人事業者">個人事業者</option>
                     <option value="特定非営利活動法人">特定非営利活動法人</option>
                  </select>
               </td>
               <td class="td_title">期間</td>
               <td colspan="2">
                  <select size="1" name="search[Jyunkaikansa_Jissi]">
                     <option value=""></option>
                     <option value="毎日">毎日</option>
                     <option value="不定期">不定期</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">難易度</td>
               <td colspan="2">
                  <select size="1" name="search[nanido]">
                     <option value=""></option>
                     <option value="Ａ">Ａ</option>
                     <option value="Ｂ">Ｂ</option>
                     <option value="Ｃ">Ｃ</option>
                  </select>
               </td>
               <td class="td_title">消費税</td>
               <td colspan="2">
                  <select size="1" name="search[Jyutaku_shohizei]">
                     <option value=""></option>
                     <option value="受託">受託</option>
                     <option value="未受託">未受託</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">設立年月日</td>
               <td colspan="2">
                  <input type="date" class="YMD" name="search[seturitu_ymd01]" placeholder="">
                  <p>～</p>
                  <input type="date" class="YMD" name="search[seturitu_ymd02]" placeholder="">
               </td>
               <td class="td_title">月次</td>
               <td colspan="2">
                  <input type="date" class="YMD" name="search[seturitu_ymd01]" placeholder="">
                  <p>～</p>
                  <input type="date" class="YMD" name="search[seturitu_ymd02]" placeholder="">
               </td>
            </tr>
            <tr>
               <td class="td_title">担当者</td>
               <td colspan="2">
                  <select size="1" name="search[KansaTanto_Name]">
                     <option value=""></option>
                     <?php foreach ($Tantosha as $Val_Tanto) { ?>
                        <option value="<?php echo $Val_Tanto['KansaTanto_Name'] ?>"><?php echo $Val_Tanto['KansaTanto_Name'] ?></option>
                     <?php } ?>
                  </select>
               </td>
               <td class="td_title">決</td>
               <td colspan="2">
                  <input type="number" class="Mon02" min=1 max=999999999 name="search[Jyutaku_Kesanhosyugaku01]" placeholder="">&nbsp;<p>円</p>
                  <p class="p_L23">～</p>
                  <input type="number" class="Mon02" min=1 max=999999999 name="search[Jyutaku_Kesanhosyugaku02]" placeholder="">&nbsp;<p>円</p>
               </td>
            </tr>
            <tr>
               <td class="td_title">副担当者</td>
               <td colspan="2">
                  <select size="1" name="search[Jishatanto]">
                     <option value=""></option>
                     <?php foreach ($Fukutan as $Val_Fukutan) { ?>
                        <option value="<?php echo $Val_Fukutan['Jishatanto'] ?>"><?php echo $Val_Fukutan['Jishatanto'] ?></option>
                     <?php } ?>
                  </select>
               </td>
               <td class="td_title">その他</td>
               <td colspan="2">
                  <input type="number" class="Mon03" min=1 max=999999999 name="search[Jyutaku_Tahosyu01]" placeholder="">&nbsp;<p>円</p>
               </td>
            </tr>
            <tr>
               <td class="td_title">担当者部署</td>
               <td colspan="2">
                  <select size="1" name="search[KansaTanto_Buka_Name]">
                     <option value=""></option>
                     <?php foreach ($Tantosha_busho as $Val_t_busho) { ?>
                        <option value="<?php echo $Val_t_busho['KansaTanto_Buka_Name'] ?>"><?php echo $Val_t_busho['KansaTanto_Buka_Name'] ?></option>
                     <?php } ?>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">副担当者部署</td>
               <td colspan="2">
                  <select size="1" name="search[Jishatanto_Bu_4Ser]">
                     <option value=""></option>
                     <?php foreach ($Fukutan_busho as $Val_t_busho) { ?>
                        <option value="<?php echo $Val_t_busho['Jishatanto_Bu_4Ser'] ?>"><?php echo $Val_t_busho['Jishatanto_Bu_4Ser'] ?></option>
                     <?php } ?>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">関与開始</td>
               <td colspan="2">
                  <input type="date" class="YMD" name="search[kanyo_kaishi01]" placeholder="">
                  &nbsp;<p>～</p>
                  <input type="date" class="YMD" name="search[kanyo_kaishi02]" placeholder="">
               </td>
            </tr>
            <tr>
               <td class="td_title">関与終了</td>
               <td colspan="2">
                  <input type="date" class="YMD" name="search[kanyo_syuryo01]" placeholder="">
                  &nbsp;<p>～</p>
                  <input type="date" class="YMD" name="search[kanyo_syuryo02]" placeholder="">
               </td>
            </tr>
            <tr>
               <td class="td_title">関与人</td>
               <td colspan="2">
                  <select size="1" name="search[Kanyozeirishi_Name]">
                     <option value=""></option>
                     <?php foreach ($Kanyo_Zeirishi as $Val_zeirishi) { ?>
                        <option value="<?php echo $Val_zeirishi['Kanyozeirishi_Name'] ?>"><?php echo $Val_zeirishi['Kanyozeirishi_Name'] ?></option>
                     <?php } ?>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">登録日</td>
               <td colspan="2">
                  <input type="date" class="YMD" name="search[torokubi01]" placeholder="">
                  &nbsp;<p>～</p>
                  <input type="date" class="YMD" name="search[torokubi02]" placeholder="">
               </td>
            </tr>
            <tr>
               <td class="td_title">修正年月日</td>
               <td colspan="2">
                  <input type="date" class="YMD" name="search[syuseibi01]" placeholder="">
                  &nbsp;<p>～</p>
                  <input type="date" class="YMD" name="search[syuseibi02]" placeholder="">
               </td>
            </tr>
            <tr>
               <td class="td_title">基本システム名</td>
               <td colspan="2">
                  <select size="1" name="search[Zaimu_Kihon_System_Name]">
                     <option value=""></option>
                     <?php foreach ($Zaimu_system as $Val_z_system) { ?>
                        <option value="<?php echo $Val_z_system['Zaimu_Kihon_System_Name'] ?>"><?php echo $Val_z_system['Zaimu_Kihon_System_Name'] ?></option>
                     <?php } ?>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">期首年月日</td>
               <td colspan="2">
                  <input type="date" class="YMD" name="search[N_jigyo_kisyu_ymd01]" placeholder="">
                  &nbsp;<p>～</p>
                  <input type="date" class="YMD" name="search[N_jigyo_kisyu_ymd02]" placeholder="">
               </td>
            </tr>
            <tr>
               <td class="td_title">期末年月日</td>
               <td colspan="2">
                  <input type="date" class="YMD" name="search[N_jigyo_kisyu_last_ymd01]" placeholder="">
                  &nbsp;<p>～</p>
                  <input type="date" class="YMD" name="search[N_jigyo_kisyu_last_ymd02]" placeholder="">
               </td>
            </tr>
            <tr>
               <td class="td_title">署</td>
               <td colspan="2">
                  <select size="1" name="search[zeimusho]">
                     <option value=""></option>
                     <?php foreach ($Zeimusho_Name as $Val_zeimusho) { ?>
                        <option value="<?php echo $Val_zeimusho['zeimusho'] ?>"><?php echo $Val_zeimusho['zeimusho'] ?></option>
                     <?php } ?>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">業種</td>
               <td colspan="2">
                  <input type="number" min=1 max=9999 name="search[gyosyu_ID]" placeholder="">
               </td>
            </tr>
            <tr>
               <td class="td_title">業種種目</td>
               <td colspan="2">
                  <select size="1" name="search[gyosyumoku]">
                     <option value=""></option>
                     <?php foreach ($Gyusyumoku as $Val_gyosyu) { ?>
                        <option value="<?php echo $Val_gyosyu['gyosyumoku'] ?>"><?php echo $Val_gyosyu['gyosyumoku'] ?></option>
                     <?php } ?>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">区分</td>
               <td colspan="2">
                  <select size="1" name="search[aoirokubun]">
                     <option value=""></option>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">責任者 フリガナ</td>
               <td colspan="2">
                  <input type="search" name="search[Keiri_Sekinin_Furigana]" placeholder="">
               </td>
            </tr>
            <tr>
               <td class="td_title">責任者　氏名</td>
               <td colspan="2">
                  <input type="search" name="search[Keiri_Sekinin_Name]" placeholder="">
               </td>
            </tr>
            <tr>
               <td class="td_title">期限延長</td>
               <td colspan="2">
                  <select size="1" name="search[Shinkokukigen_Entyo]">
                     <option value=""></option>
                     <option value="無">無</option>
                     <option value="有（１か月）">有（１か月）</option>
                     <option value="有（２か月）">有（２か月）</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">期限延長</td>
               <td colspan="2">
                  <select size="1" name="search[Shohizei_Kigen_Entyo]">
                     <option value=""></option>
                     <option value="無">無</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td class="td_title">納期</td>
               <td colspan="2">
                  <input type="date" class="YMD" name="search[gensennouki01]" placeholder="">
                  &nbsp;<p>～</p>
                  <input type="date" class="YMD" name="search[gensennouki02]" placeholder="">
               </td>
            </tr>
         </table>

         <div class="submit_button_box">
            <input type="hidden" name="token" value="<?= $token ?>">
            <input type="submit" name="search_button" value="検索" class="btn-flat-border">
            &nbsp;<input type="submit" name="Reset" value="リセット" class="btn-flat-border">
            <input type="hidden" name="token" value="<?= $token ?>">
            <input type="submit" name="search_button" value="検索" class="btn-flat-border02">
            &nbsp;<input type="submit" name="Reset" value="リセット" class="btn-flat-border02">
         </div>
      </form>
   </div>
</body>

</html>
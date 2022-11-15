<?php
session_start();
include_once './function_folda/Page.php';
include_once './function_folda/function.php';



$Month_array = array();

// 5年前まで表示
$last_year = 12 * 5;
// 5年前までの配列作成
for ($i = 1; $i <= $last_year; $i++) {
  array_push($Month_array, date("Y-m", strtotime("-{$i} month")));
}


$BB = "";
$CC = " ";
$Bi_komoku = array(
  '法　人',
  '顧　問',
  'あああ',
  '個　人',
  '合計'
);

// 一覧表（顧問・あああ）表示配列
$komon_keishin_array = [
  ['テスト会社', '××顧問', 'テスト会社㈱', '計',],
  ['社福)テスト会社', '顧問', '㈱テスト会社', '計',],
  ['テスト会社', 'ｋ顧問', 'テスト会社', '計',],
  ['テスト会社', 'お顧問', '㈱test', '計',],
  ['テスト会社', 'ｇ顧問', 'テスト会社', '計',],
  ['テスト会社', 'え顧問', 'テスト会社', '計',],
  ['テスト会社', 'ｐ顧問', 'テスト会社', '計',],
  ['', '', 'テスト会社', '計',],
  ['', '', 'テスト会社', '計',],
  ['', '', 'テスト会社', '計',],
];

// 件数
$tokui_kensu_array = [
  [1, 1, '(同)テスト会社', 'テスト会社', '法人成', '11', '―', 120000, '○○'],
  [2, 1, 'AAA電工(株)', 'サービス業', 'maru会社', '11', '―', 120000, '○○'],
  [3, 1, 'BBB電工(株)', '空調工事', '信用金庫', '11', 52000, 'ー', '■■'],
  [4, 4, 'あああ(株)', '建築板金業', '信用金庫', 'ー', 43000, 780000, '××'],
  [5, 5, '１１１(株)', '空調工事', '信用金庫', 26000, '―', 100000, '○○'],
  [6, 5, '＠＠＠＠(株)', '空調工事', '信用金庫', '11', '―', 340000, '○○'],
  [7, 6, '２２２(株)', '空調工事', '信用金庫', '3', 8700, 895000, '××'],
  [8, 7, '４５(株)', '空調工事', '信用金庫', '10', 90000, 352500, '○○'],
  [9, 7, '＊＊＊＊＊＊(株)', '空調工事', '信用金庫', 110000, '―', 211000, '××'],
  [10, 7, 'さだｓｄ(株)', '空調工事', '信用金庫', '5', 70000, 20000, '■■'],
  [11, 7, '％％(株)', '空調工事', '信用金庫', '6', 9700, 23450, '■■'],
  [12, 8, 'ｓｓｓｓ(株)', '空調工事', '信用金庫', '9', '―', 120000, '■■'],
  [13, 8, 'ｄｆｓｆｓｄｆ(株)', '空調工事', '信用金庫', '11', '―', 120000, '○○'],
];

$sanko_array = [
  [1, '依頼料', 'テスト会社', '年一', '-', '月次', '-', '＠0.5万(3ヶ月に1回1.5万)', '○○'],
  [3, '依頼料', '(株)テスト会社', '年一', '-', '月次', '3万', '', '○○'],
  [3, '案内料', '(株)テスト会社', '年一', '-', '月次', '2万', '', '■■'],
  [4, '依頼料', 'テスト会社㈲', '月次', '3万', '年次', '0', '', '○○'],
  [1, '依頼料', '(株)テスト会社', '月次', '0', '月次', '1.5万', '', '○○'],
  [1, '案内料', '(株)テスト会社', '案内料', '2万', '案内料', '0', '', '○○'],
  [1, '案内料', '(同)テスト会社', '案内料', '1万', '案内料', '2万', '', '○○'],
  [2, '依頼料', '(株)テスト会社', '月次', '2万', '月次', '0', '', '○○'],
  [2, '依頼料', 'テスト会社', '月次', '0.5万', '月次', '0', '', '○○'],
  [2, '依頼料', 'テスト会社', '月次', '1万', '月次', '0.7万', '', '○○'],
  [3, '依頼料', 'テスト会社', '月次', '15万', '月次', '10万', '', '××'],
  [3, '依頼料', '㈱テスト会社', '月次', '24.2万', '月次', '25.4万', '', '○○'],
  [3, '決起', 'テスト会社', '決起', '20万', '決起', '25万', '', '○○'],
  [3, '消', 'テスト会社', '消', '8万', '消', '5万', '', '○○'],
  [5, '決起', 'テスト会社', '決起', '15万', '決起', '22.5万', '', '○○'],
  [5, '依頼料', 'テスト会社', '月次', '3万', '月次', '4.5万', '', '○○'],
  [5, '決起', 'テスト会社？？？？', '計算料変更', '10万', '計算料変更', '10万', '', '○○'],
];
// $aaa = [
//   97, 17, 1, '', 5, '', '', '', '', '', 11, 2, 13, 14, 15, 16, 17, 18, 19,
//   1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 2, 13, 14, 15, 16, 17, 18, 19,
//   1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 2, 13, 14, 15, 16, 17, 18, 19,
//   1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 2, 13, 14, 15, 16, 17, 18, 19,
// ];

$Count_komon_keishin = count($komon_keishin_array) + 5;


$after_Bi_komoku = $Bi_komoku;
?>
<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="./asset/css/header.css">
  <link rel="stylesheet" href="./asset/css/Tokuisaki.css">
  <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js?ver=1.12.2'></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
  <script type="text/javascript" src="./asset/js/main.js"></script>
  <title>件数表</title>
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
                <a href="#" class="init-right">件数表</a>
                <!-- <ul class="menu-fourth-level"> -->
                <!-- 第三階層 -->
                <!-- <li><a href="#">Great-Grandchild Menu</a></li>
                  <li><a href="#">Great-Grandchild Menu</a></li>
                  <li><a href="#">Great-Grandchild Menu</a></li>
                </ul> -->
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
  <div class="Tokusaki_container">
    <!-- タブメニュー -->
    <input type="radio" name="tab_item" id="tab_radio_A" class="tab_radio" checked>
    <label for="tab_radio_A" class="tab_menu">件数表</label>

    <input type="radio" name="tab_item" id="tab_radio_B" class="tab_radio">
    <label for="tab_radio_B" class="tab_menu">一覧表</label>

    <input type="radio" name="tab_item" id="tab_radio_C" class="tab_radio">
    <label for="tab_radio_C" class="tab_menu">件数</label>

    <input type="radio" name="tab_item" id="tab_radio_D" class="tab_radio">
    <label for="tab_radio_D" class="tab_menu">件数</label>

    <!-- タブA 表示内容 -->
    <div id="tab_contains_A" class="tab_contains">
      <div class="tokusaki_main">
        <div class="daimoku">
          <h1>件数表</h1>
        </div>
        <table>
          <tr>
            <th rowspan="2"></th>
            <th rowspan="2">2020年12/31</th>
            <th colspan="2">ﾃｽﾄ課</th>
            <th colspan="2">○○課</th>
            <th colspan="2">△△課</th>
            <th colspan="2">○×課</th>
            <th colspan="2">→→課</th>
            <th class="nijyu" colspan="4">本社合計</th>
            <th class="nijyu" colspan="4">支社合計</th>
            <th class="nijyu" rowspan="2">○○年〇月末現在</th>
          </tr>
          <tr>
            <?php for ($i = 0; $i < 7; $i++) { ?>
              <?php if ($i <= 4) { ?>
                <th>4月末</th>
                <th>5月分</th>
              <?php } else { ?>
                <th class="nijyu">2020.12/末</th>
                <th>4月末</th>
                <th>5月分</th>
                <th class="nijyu">総合計</th>
              <?php } ?>
            <?php } ?>
          </tr>
          <?php foreach ($Bi_komoku as $value) { ?>
            <tr>
              <td rowspan="3"><?php echo $value; ?></td>
              <td rowspan="3"></td>
              <?php for ($i = 0; $i <= 18; $i++) { ?>
                <?php if ($i == 10 || $i == 14 || $i == 18) { ?>
                  <td class="nijyu" rowspan="3"></td>
                <?php } else { ?>
                  <td rowspan="2"></td>
                <?php } ?>
              <?php } ?>
            <tr>
            <tr>
              <?php for ($i = 0; $i <= 18; $i++) { ?>
                <?php for ($i = 0; $i <= 18; $i++) { ?>
                  <?php if ($i == 10 || $i == 14 || $i == 18) { ?>
                  <?php } else { ?>
                    <td rowspan="2"></td>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            <tr>
            <?php } ?>
        </table>
      </div>

      <div class="tokusaki_sub">
        <div class="daimoku">
          <h1>5 月末</h1>
          <p>本社部門別顧客</p>
        </div>
        <table>
          <tr>
            <th></th>
            <th>ﾃｽﾄ課</th>
            <th>○○課</th>
            <th>■■課</th>
            <th>△△課</th>
            <th>社長</th>
            <th>○×課</th>
            <th>→→課</th>
            <th>合計</th>
          </tr>
          <?php foreach ($after_Bi_komoku as $value) { ?>
            <tr>
              <td><?php echo  $value; ?></td>
              <?php if ($value == end($after_Bi_komoku)) { ?>
                <?php for ($i = 0; $i <= 7; $i++) { ?>
                  <td></td>
                <?php } ?>
              <?php } else { ?>
                <?php for ($i = 0; $i <= 7; $i++) { ?>
                  <td class="Now_Month_sanko"></td>
                <?php } ?>
              <?php } ?>
            </tr>
          <?php } ?>
        </table>

        <div class="side_element">
          <p class="plus">＋</p>
          <div class="small_box">
            <div class="Num_dai">
              <p>あああ</p>
            </div>
            <div class="Num_box">
              aaaa
            </div>
          </div>

          <p class="plus">＋</p>

          <div class="small_box">
            <div class="Num_dai">
              <p>ｇｇｇ</p>
            </div>
            <div class="Num_box">
              aaaa
            </div>
          </div>

          <p class="plus">＋</p>

          <div class="small_box_gokei">
            <div class="Num_dai">
              <p>本社合計件数</p>
            </div>
            <div class="Num_box">
              aaaa
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- タブB 表示内容 -->
    <div id="tab_contains_B" class="tab_contains">
      <div class="komon_kesin">
        <h3>≪本　社≫</h3>
        <p>○○年〇月末現在</p>
        <table>
          <tr>
            <th class="tokuisaki_ID"></th>
            <th colspan="2">管理</th>
            <th colspan="2">管理数</th>
          </tr>

          <?php foreach ($komon_keishin_array as $key => $value) { ?>
            <tr>
              <td><?php echo $key; ?></td>
              <td><?php echo $value[0]; ?></td>
              <td><?php echo $value[1]; ?></td>
              <td><?php echo $value[2]; ?></td>
              <td><?php echo $value[3]; ?></td>
            </tr>
          <?php } ?>
          <?php for ($i = 0; $i < 5; $i++) { ?>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          <?php  } ?>
        </table>
      </div>
    </div>

    <!-- タブC 表示内容 -->
    <div id="tab_contains_C" class="tab_contains">
      <div class="tab-wrap">
        <input id="tab01" type="radio" name="tab" class="tab-switch" checked="checked"><label class="tab-label" for="tab01">本社</label>
        <div class="tab-content">
          <div class="radio_switch">
            <input type="radio" name="company_kind" value="1" checked onclick="rbutton_sta('hojin');">
            <p>法人</p>
            <input type="radio" name="company_kind" value="2" onclick="rbutton_sta('kojin');">
            <p>個人</p>
            <input type="radio" name="company_kind" value="3" onclick="rbutton_sta('komon');">
            <p>顧問</p>
          </div>

          <div class="tab">
            <input type="radio" name="tabs" id="tab_01" checked>
            <input type="radio" name="tabs" id="tab_02">


            <div class="tab_btns">
              <label for="tab_01" class="tab_btn">増加</label>
              <label for="tab_02" class="tab_btn">減少</label>
            </div>

            <div class="tab_pages">
              <!-- 増加 -->
              <div class="tab_page">
                <div class="tokuisaki_kensu_hojin" id="hojin_zo">
                  <div class="con_title">
                    <p>＜法人＞ ○○年○月末現在</p>
                  </div>

                  <table>
                    <tr>
                      <th></th>
                      <th>増加月</th>
                      <th>法人名</th>
                      <th>業務内容</th>
                      <th>紹介者</th>
                      <th>決起</th>
                      <th>月額報酬</th>
                      <th>年間報酬</th>
                      <th>担当部署</th>
                    </tr>
                    <?php foreach ($tokui_kensu_array  as $key => $value) { ?>
                      <tr>
                        <?php for ($i = 0; $i < 9; $i++) { ?>
                          <td><?php echo $value[$i]; ?></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>

                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <tr>
                        <?php for ($l = 0; $l < 9; $l++) { ?>
                          <td></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
                <div class="tokuisaki_kensu_hojin" id="kojin_zo" style="display:none">
                  <div class="con_title">
                    <p>＜個人＞ ○○年〇月末現在　増加表</p>
                  </div>
                  <table>
                    <tr>
                      <th></th>
                      <th>増加月</th>
                      <th>法人名</th>
                      <th>業務内容</th>
                      <th>紹介者</th>
                      <th>決起</th>
                      <th>月額報酬</th>
                      <th>年間報酬</th>
                      <th>担当部署</th>
                    </tr>
                    <?php foreach ($tokui_kensu_array  as $key => $value) { ?>
                      <tr>
                        <?php for ($i = 0; $i < 9; $i++) { ?>
                          <td><?php echo $value[$i]; ?></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>

                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <tr>
                        <?php for ($l = 0; $l < 9; $l++) { ?>
                          <td></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
                <div class="tokuisaki_kensu_hojin" id="komon_zo" style="display:none">
                  <div class="con_title">
                    <p>＜顧問＞ ○○年〇月末現在　増加表</p>
                  </div>
                  <table>
                    <tr>
                      <th></th>
                      <th>増加月</th>
                      <th>法人名</th>
                      <th>業務内容</th>
                      <th>紹介者</th>
                      <th>決起</th>
                      <th>月額報酬</th>
                      <th>年間報酬</th>
                      <th>担当部署</th>
                    </tr>
                    <?php foreach ($tokui_kensu_array  as $key => $value) { ?>
                      <tr>
                        <?php for ($i = 0; $i < 9; $i++) { ?>
                          <td><?php echo $value[$i]; ?></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>

                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <tr>
                        <?php for ($l = 0; $l < 9; $l++) { ?>
                          <td></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
              <div class="tab_page">
                <!-- 減少 -->
                <div class="tokuisaki_kensu_hojin" id="hojin_gen">
                  <div class="con_title">
                    <p>＜法人＞ ○○年〇月末現在　減少表</p>
                  </div>
                  <table>
                    <tr>
                      <th></th>
                      <th>減少月</th>
                      <th>法人名</th>
                      <th>減少理由</th>
                      <th>担当部署</th>
                    </tr>
                    <?php foreach ($tokui_kensu_array  as $key => $value) { ?>
                      <tr>
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                          <td><?php echo $value[$i]; ?></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>

                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <tr>
                        <?php for ($l = 0; $l < 9; $l++) { ?>
                          <td></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
                <div class="tokuisaki_kensu_hojin" id="kojin_gen" style="display:none">
                  <div class="con_title">
                    <p>＜個人＞ ○○年〇月末現在　減少表</p>
                  </div>
                  <table>
                    <tr>
                      <th></th>
                      <th>減少月</th>
                      <th>個人名</th>
                      <th>減少理由</th>
                      <th>担当部署</th>
                    </tr>
                    <?php foreach ($tokui_kensu_array  as $key => $value) { ?>
                      <tr>
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                          <td><?php echo $value[$i]; ?></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>

                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <tr>
                        <?php for ($l = 0; $l < 9; $l++) { ?>
                          <td></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
                <div class="tokuisaki_kensu_hojin" id="komon_gen" style="display:none">
                  <div class="con_title">
                    <p>＜顧問＞ ○○年〇月末現在　減少表</p>
                  </div>
                  <table>
                    <tr>
                      <th></th>
                      <th>減少月</th>
                      <th>顧問名</th>
                      <th>減少理由</th>
                      <th>担当部署</th>
                    </tr>
                    <?php foreach ($tokui_kensu_array  as $key => $value) { ?>
                      <tr>
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                          <td><?php echo $value[$i]; ?></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>

                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <tr>
                        <?php for ($l = 0; $l < 9; $l++) { ?>
                          <td></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div>

            <button id="openModal">参考</button>
            <section id="modalArea" class="modalArea">
              <div id="modalBg" class="modalBg"></div>
              <div class="modalWrapper">
                <div class="modalContents">
                  <select>
                    <?php foreach ($Month_array as $key => $value) { ?>
                      <option value="<?php echo $value; ?>"><?php echo str_replace("-", "年", $value); ?>月</option>
                    <?php } ?>
                  </select>
                  <table>
                    <tr>
                      <th>AAAAA</th>
                      <th>BBBBB</th>
                      <th>CCCCC</th>
                      <th>DDDDD</th>
                      <th>EEEEE</th>
                      <th>FFFFF</th>
                      <th>GGGGG</th>
                      <th>HHHHH</th>
                      <th>JJJJJ</th>

                    </tr>
                    <?php foreach ($sanko_array as $key => $value) { ?>
                      <tr>
                        <?php for ($i = 0; $i < 9; $i++) { ?>
                          <?php if ($i == 2) { ?>
                            <?php if (!empty($value[2])) { ?>
                              <?php $BB = $value[2]; ?>
                              <?php if ($BB == $CC) { ?>
                                <td>↑</td>
                              <?php } else { ?>
                                <td><?php echo $value[2]; ?></td>
                              <?php } ?>
                              <?php $CC = $value[2]; ?>
                            <?php } else { ?>
                              <td><?php echo $value[$i]; ?></td>
                            <?php } ?>
                          <?php } else { ?>
                            <td><?php echo $value[$i]; ?></td>
                          <?php } ?>
                        <?php } ?>
                      </tr>
                    <?php } ?>

                  </table>
                </div>
                <div id="closeModal" class="closeModal">
                  ×
                </div>
              </div>
            </section>
          </div>
        </div>

        <input id="tab02" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab02">支社</label>
        <div class="tab-content">
          <div class="osaka_Main">
            <div class="radio_switch_osaka">

              <input type="radio" name="company_kind_osaka" value="1" checked onclick="rbutton_sta_osaka('hojin_osaka');">
              <p>法人</p>
              <input type="radio" name="company_kind_osaka" value="2" onclick="rbutton_sta_osaka('kojin_osaka');">
              <p>個人</p>
              <input type="radio" name="company_kind_osaka" value="3" onclick="rbutton_sta_osaka('komon_osaka');">
              <p>顧問</p>


            </div>

            <div class="zogen_button">
              <input type="button" value="増加" onclick="zogen_check('zoka');" />
              <input type="button" value="減少" onclick="zogen_check('gensho');" /><br />
            </div>

            <div class="osaka_box" id="hojin_osaka_zo">
              <div class="con_title">
                <p>＜法人＞ ○○年○月末現在　増加表</p>
              </div>

              <table>
                <tr>
                  <th></th>
                  <th>AAAAA</th>
                  <th>BBBBB</th>
                  <th>CCCCC</th>
                  <th>DDDDD</th>
                  <th>EEEEE</th>
                  <th>FFFFF</th>
                  <th>GGGGG</th>
                  <th>HHHHH</th>
                  <th>JJJJJ</th>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>

            <div class="osaka_box" id="kojin_osaka_zo" style="display:none">
              <div class="con_title">
                <p>＜個人＞ ○○年○月末現在　ｊｊｊ</p>
              </div>

              <table>
                <tr>
                  <th></th>
                  <th>AAAAA</th>
                  <th>BBBBB</th>
                  <th>CCCCC</th>
                  <th>DDDDD</th>
                  <th>EEEEE</th>
                  <th>FFFFF</th>
                  <th>GGGGG</th>
                  <th>HHHHH</th>
                  <th>JJJJJ</th>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>

            <div class="osaka_box" id="komon_osaka_zo" style="display:none">
              <div class="con_title">
                <p>＜顧問＞ ○○年〇月末現在　増加表</p>
              </div>

              <table>
                <tr>
                  <th></th>
                  <th>AAAAA</th>
                  <th>BBBBB</th>
                  <th>CCCCC</th>
                  <th>DDDDD</th>
                  <th>EEEEE</th>
                  <th>FFFFF</th>
                  <th>GGGGG</th>
                  <th>HHHHH</th>
                  <th>JJJJJ</th>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>

            <div class="osaka_box" id="hojin_osaka_gen">
              <div class="con_title">
                <p>＜法人＞ ○○年○月末現在</p>
              </div>

              <table>
                <tr>
                  <th></th>
                  <th>AAAAA</th>
                  <th>BBBBB</th>
                  <th>CCCCC</th>
                  <th>DDDDD</th>
                  <th>EEEEE</th>
                  <th>FFFFF</th>
                  <th>GGGGG</th>
                  <th>HHHHH</th>
                  <th>JJJJJ</th>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>

            <div class="osaka_box" id="kojin_osaka_gen" style="display:none">
              <div class="con_title">
                <p>＜個人＞　○○年○月末現在</p>
              </div>

              <table>
                <tr>
                  <th></th>
                  <th>AAAAA</th>
                  <th>BBBBB</th>
                  <th>CCCCC</th>
                  <th>DDDDD</th>
                  <th>EEEEE</th>
                  <th>FFFFF</th>
                  <th>GGGGG</th>
                  <th>HHHHH</th>
                  <th>JJJJJ</th>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>

            <div class="osaka_box" id="komon_osaka_gen" style="display:none">
              <div class="con_title">
                <p>＜顧問＞ ○○年○月末現在</p>
              </div>

              <table>
                <tr>
                  <th></th>
                  <th>AAAAA</th>
                  <th>BBBBB</th>
                  <th>CCCCC</th>
                  <th>DDDDD</th>
                  <th>EEEEE</th>
                  <th>FFFFF</th>
                  <th>GGGGG</th>
                  <th>HHHHH</th>
                  <th>JJJJJ</th>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>
          </div>


        </div>
        <input id="tab03" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab03">タブ ③</label>
        <div class="tab-content">
          コンテンツ 3
        </div>

      </div>

    </div>

    <!-- タブC 表示内容 -->
    <div id="tab_contains_D" class="tab_contains">

    </div>


  </div>
</body>
<html>

<?php
  include_once './function_folda/function_DB_conect.php';
  include_once './function_folda/function.php';

$Bu_Name = array(
    1 => "相談役",
    2 => "会長",
    3 => "代表",
    4 => "支社長",
    5 => "専務",
    6 => "常務",
    7 => "部長",
    8 => "次長",
    9 => "課長",
    10 => "係長",
    11 => "主任",
    12 => "一般",
    13 => "パート",
    14 => "外注",
    15 => "室長",
    16 => "理事",
    17 => "理事長",
    18 => "常務理事",
    19 => "監事",
    20 => "代表取締役",
    21 => "社長"
);
$yakushoku_mei_Af ="";
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./asset/css/header.css">
    <link rel="stylesheet" href="./asset/css/Henko_todoke.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="./asset/js/UI_main.js"></script>
    <script type="text/javascript" src="./asset/js/real_time.js"></script>
    <title>test_変更届</title>
  </head>
  <header>
    <div class="container">
      <ul class="menu">
        <div class="mokuji">
          <h1 class="jisha"><a href="./index.php">test</a></h1>
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
    <div class="workflow_box">
        <input id="tab-radio1" class="tab-radio" name="tab" type="radio" checked>
        <input id="tab-radio2" class="tab-radio" name="tab" type="radio">
        <input id="tab-radio3" class="tab-radio" name="tab" type="radio">
        <input id="tab-radio4" class="tab-radio" name="tab" type="radio">
        
        <ul class="list-tab-label">
            <li>
            <label id="tab-label1" class="tab-label" for="tab-radio1">変更申請進捗履歴</label>
            </li>
            <li>
            <label id="tab-label2" class="tab-label" for="tab-radio2">ワークフロー登録</label>
            </li>
            <li>
            <label id="tab-label3" class="tab-label" for="tab-radio3">タブ3</label>
            </li>
        </ul>
    
        
        <div class="wrap-tab-content">
            <div id="tab-content1" class="tab-content">
                <h5>maruの変更</h5>
                <div class="Flow_Name">
                    <p><?php echo $_SESSION['USER_NAME'];?></p> 
                    <p><?php echo $_SESSION['USER_NAME'];?></p> 
                    <p><?php echo $_SESSION['USER_NAME'];?></p> 
                </div>
            </div>
            <div id="tab-content2" class="tab-content">
                <div class="Shain_select">
                        <?php foreach($Shain_Call as $val2) {?>
                            <?php $isFirst = true;?>
                            <?php foreach($Bu_Name as $key => $val) {?>

                                <?php if($key == $val2['yakushoku_id']) {?>
                                    <?php $yakushoku_mei_bf = $val2['yakushokumei'];?>
                                    <?php if($yakushoku_mei_bf != $yakushoku_mei_Af) {?>
                                        <h4><?php echo $val;?></h4><br>
                                        <?php  $isFirst = false;?>
                                    <?php }?>
                                    <p><?php echo $val2['shimei_sei'];?></p><br>
                                    <?php $yakushoku_mei_Af = $val2['yakushokumei'];?>
                                <?php }?>
                            <?php }?>
                    <?php } ?>
                </div>
            </div>
            
            <div id="tab-content3" class="tab-content">
            <p>タブ3タブ3タブ3</p>
            </div>            
        </div>
    </div>

    <?php foreach($henko_placeholder as $j){?>
        <ul class="ST_box">
            <li class="aco">
            <h3>基本情報</h3>
            <div class="acoTriger">▲</div>
                <div class="sub">
                    <ul>
                        <li>
                            <p>商号フリガナ：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['Company_Name_furigana'];?>">
                            <p>商号：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['Company_Name'];?>"><br/>
                        </li>
                        <li>
                            <p>通称：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['tusho'];?>"><br/>
                        </li>
                        <li>
                            <p>代表者氏名：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['daihyo_Name'];?>">
                            <p>代表者フリガナ：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['daihyo_Name_furigna'];?>"><br/>
                        </li>
                        <li>
                            <p>〒：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Yubin_No'];?>">
                            <p>申告住所：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['Jyusho_01'];?>"><br/>
                        </li>
                        <li>
                            <p>HP：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['Company_HP'];?>">
                            <p>資本金：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['Shihonkin'];?>"><br/>
                        </li>
                        <li>
                            <p>TEL：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Company_HP'];?>">
                            <p>FAX：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Shihonkin'];?>">
                            <p>MAIL：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Campany_Mail'];?>"><br/>
                        </li>
                        <li>
                            <p>発行総数：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Hako_Kabu_sosu'];?>">
                            <p>自己：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Jikokabu'];?>">
                            <p>制限：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Kabushiki_Jhoto'];?>"><br/>
                        </li>
                        <li>
                            <p>銀行：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Hako_Kabu_sosu'];?>">
                            <p>支店名：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Jikokabu'];?>"><br/>
                        </li>
                        <li>
                            <p>任期 役職：</p><input type="text" name="Furigana" class="Box_S" placeholder="">
                            <p>任期 氏名：</p><input type="text" name="Furigana" class="Box_S" placeholder="">
                            <p>任期満了予定：</p><input type="text" name="Furigana" class="Box_S" placeholder=""><br/>
                        </li>
                        <li>
                            <p>郵便曲名等：</p><input type="text" name="Furigana" class="Box_S" placeholder="">
                            <p>貯金記号番号：</p><input type="text" name="Furigana" class="Box_S" placeholder="">
                            <p>ゆうちょ銀行還付：</p><input type="text" name="Furigana" class="Box_S" placeholder=""><br/>
                        </li>
                    <ul>
                </div>
            </li>
            <br/>
            <li class="aco2">
            <h3>郵送情報</h3>
            <div class="acoTriger">▲</div>
                <div class="sub">
                    <ul>
                        <li>
                            <p>〒：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['Yubin_No'];?>">
                            <p>ビル・マンション名：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['yubin_jyusho_01'];?>"><br/>
                        </li>
                        <li>
                            <p>担当者：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['daihyo_Name_furigna_kojin_FM'];?>">
                            <p>役職：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['Yakushoku'];?>"><br/>
                        </li>
                        <li>
                            <p>敬称：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['Shogo_Keisho'];?>">
                            <p>代表者/個人 宛名印字：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['atena'];?>"><br/>
                        </li>
                        <li>
                            <p>郵便物：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Yubin_syurui'];?>">
                            <p>医療情報誌：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Iryou_zassh'];?>">
                            <p>郵便物送付先担当者：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['yubin_tanto'];?>"><br/>
                        </li>
                    <ul>
                </div>
            </li>

            <br/>
            <li class="aco2">
            <h3>事務所情報</h3>
            <div class="acoTriger">▲</div>
                <div class="sub">
                    <ul>
                        <li>
                            <p>所属名：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['oya_kaisha'];?>">
                            <p>関与形態：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['ketai'];?>">
                            <input type="text" name="Furigana" class="Box_LL" placeholder="<?php echo $j['KanyoKeitai_Meiboyo'];?>"><br/>
                        </li>
                        <li>
                            <p>決算月：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['kesan_month'];?>月">
                            <p>担当者：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['daihyo_Name_furigna_kojin_FM'];?>">
                            <p>売上規模：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['ketai'];?>"><br/>
                        </li>
                        <li>
                            <p>距離：</p><input type="text" name="Furigana" class="Box_S" placeholder="">
                            <p>難易度：</p><input type="text" name="Furigana" class="Box_L" placeholder="<?php echo $j['nanido'];?>">
                            <p>設立年月日：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['seturitu_ymd'];?>"><br/>
                        </li>
                        <li>
                            <p>担当者：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['KansaTanto_Name'];?>">
                            <p>副担当者：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Jishatanto'];?>">
                            <p>前任者：</p><input type="text" name="Furigana" class="Box_S" placeholder=""><br/>
                        </li>
                        <li>
                            <p>担当者部署：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['KansaTanto_Buka_Name'];?>">
                            <p>副担当者部署：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Jishatanto_Bu_4Ser'];?>">
                            <p>前任者部署：</p><input type="text" name="Furigana" class="Box_S" placeholder=""><br/>
                        </li>
                        <li>
                            <p>関与開始：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['kanyo_kaishi'];?>">
                            <p>関与終了：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['kanyo_syuryo'];?>">
                            <p>関与税理士名：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Kanyozeirishi_Name'];?>"><br/>
                        </li>
                        <li>
                            <p>登録日：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['torokubi'];?>">
                            <p>修正年月日：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['syuseibi'];?>">
                            <p>財務基本システム利用有無：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Zaimu_Kihon_System_Name'];?>"><br/>
                        </li>
                        <li>
                            <p>税務署：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['zeimusho'];?>">
                            <p>業種コード：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['gyosyu_ID'];?>">
                            <p>事業種目：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['gyosyumoku'];?>"><br/>
                        </li>
                        <li>
                            <p>青色区分：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['aoirokubun'];?>">
                            <p>経理責任者 フリガナ：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Keiri_Sekinin_Furigana'];?>">
                            <p>経理責任者 氏名：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Keiri_Sekinin_Name'];?>"><br/>
                        </li>
                        <li>
                            <p>申告期限延長：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['Shinkokukigen_Entyo'];?>">
                            <p>消費税期限延長：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['Shohizei_Kigen_Entyo'];?>">
                            <p>厳選納期：</p><input type="text" name="Furigana" class="Box_S" placeholder="<?php echo $j['gensennouki'];?>"><br/>
                        </li>
                    <ul>
                </div>
            </li>

            <br/>
            <li class="aco2">
            <h3>請求情報</h3>
            <div class="acoTriger">▲</div>
                <div class="sub">
                    <ul>
                        <li>
                            <p>開始：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['seikyu_kaishi'];?>">
                            <p>開始月：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['ketai'];?>">
                            <p>請求：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['jihuriseikyu'];?>">
                            <p>期間：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['Jyunkaikansa_Jissi'];?>">
                            <p>消費税：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['Jyutaku_shohizei'];?>">
                            <p>月次：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['Jyutaku_Komonhosyugaku'];?>">
                            <p>決算：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['Jyutaku_Kesanhosyugaku'];?>"><br/>
                        </li>
                        <li>
                            <p>予定申告：</p><input type="text" name="Furigana" class="Box_SS" placeholder="">
                            <p>その他：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['Jyutaku_Tahosyu'];?>">
                            <p>年間合計：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['jihuriseikyu'];?>"><br/>
                        </li>

                    <ul>
                </div>
            </li>

            <br/>
            <li class="aco2">
            <h3>料金根拠</h3>
            <div class="acoTriger">▲</div>
                <div class="sub">
                    <ul>
                        <li>
                            <p>監査区分：</p><input type="text" name="Furigana" class="Box_SS" placeholder="<?php echo $j['kansakubun_FM'];?>">
                        </li>
                    <ul>
                </div>
            </li>
        </ul>  ​
    <?php }?>
  </body>

</html>
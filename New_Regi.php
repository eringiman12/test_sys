<?php
  // include_once './function_folda/function.php';
  include_once './function_folda/function_DB_conect.php';

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./asset/css/header.css">
    <link rel="stylesheet" href="./asset/css/New_Regi.css">
    <script type="text/javascript" src="./asset/js/real_time.js"></script>
    <title>てｓｔ</title>
  </head>
  <header>
    <!-- ログイン情報と時間 -->
    <div class="header_block">
      <div class="header_Box">
        <h1><a href="./index.php">てｓｔ</a></h1>
      </div>
      <div class="header_Box">
        <p>てｓｔ Customer DataBase</p>
      </div>
      <div class="header_Box">
        <p>ユーザー名</p>
      </div>
      <div class="time_hyoji">
        <p><?php echo date("Y.m.d"."(".$week[$date].")")?></p><br/>
        <p id="RealtimeClockArea"></p>
      </div>
    </div>

    <!-- 顧客管理ボタンエリア -->
    <div class="kokayku_bottun">
      <!-- 管理用ボタン -->
      <ul>
        <li><a href="./kokyaku_kanri.php">顧客管理表</a></li>
        <li>変更届</li>
        <li><a href="./yojitu.php">予実管理</a></li>
        <li><a href="./seikyu_kanri.php">請求管理</a></li>
        <li>応対記録</li>
        <!-- <li>業務手順</li> -->
        <li><a href="./anken_top.php">案件管理</a></li>
      </ul>

      <!-- 検索エリア -->
      <div class="seeach_box">
        <form action="" method="post">
          <input type="search" name="search" placeholder="">
          <select name="example">
            <option value="">選んでください</option>
            <option value="フリガナ">フリガナ</option>
            <option value="商号">商号</option>
            <option value="役職">役職</option>
            <option value="代表者">代表者</option>
            <option value="住所">住所</option>
            <option value="電話番号">電話番号</option>
          </select>
          <input type="submit" name="submit" value="検索">
        </form>
      </div>
    <div>
  </header>

  <body>
    <div class="Client_main">
        
      <form action="./function_folda/function_DB_conect.php" method="post">
        <button class="regita" name="regita_button">登録する</button>
        <!-- 基本情報エリア -->
        <div class="standard_info">
          <h3>基本情報</h3>
          <div class="nt_seikyu">
            <div class="text_no">
              <?php foreach($sql_ex_client_ID as $var) {?>
                <p class="komoku_title">No&emsp;</p><div class="label_size_input"><?php echo $var['Auto_increment'];?></div>
              <?php } ?>
            </div>
              <div class="text_no">
                <p>T&emsp;</p><input type="text" name="T_No" class="label_size" value="">
              </div>
            <select name="select_T">
                <option value=""></option>
                <option value="法人">法人</option>
                <option value="個人">個人</option>
                <option value="顧問">顧問</option>
                <option value="その他">その他</option>
              </select>
              
            <div class="text_no">
              <p>請求&emsp;</p><input type="text" name="seikyu_no" class="label_size">  
            </div>
            <select name="select_seikyu">
                <option value=""></option>
                <option value="項目1">項目1</option>
                <option value="項目2">項目2</option>
                <option value="項目3">項目3</option>
            </select>  
            </form>    
          </div>
          <div class="companiy_info">
            <div class="furigana">
              <p>フリガナ</p><input type="text" name="text_no" class="label_size_L" value=""><br/>
            </div>
            <div class="shogo">
              <p>商号</p><input type="text" name="text_no" class="label_size_L" value=""><br/>
            </div>
            <div class="furigana02">
              <p>フリガナ</p><input type="text" name="text_no" class="label_size_s" value=""><br/>
            </div>
            <div class="daihyo">
              <p>代表者</p><input type="text" name="text_no" class="label_size_s" value=""><br/>
            </div>
            <div class="yubin">
              <p>〒</p><input type="text" name="text_no" class="label_size_s" value=""><br/>
            </div>
            <div class="sinkoku_jyusho">
              <p>申告住所</p><input type="text" name="text_no" class="label_size_L" value=""><br/>
            </div>
            <div class="yubin_jyusho">
              <p>郵便物送付先</p><input type="text" name="text_no" class="label_size_L" value=""><br/>
            </div>
            <div class="tel">
              <p>TEL</p><input type="text" name="text_no" class="label_size_s" value=""><br/>
            </div>
            <div class="FAX">
              <p>FAX</p><input type="text" name="text_no" class="label_size_s" value=""><br/>
            </div>
            <div class="MAIL">
              <p>MAIL</p><input type="text" name="text_no" class="label_size_ss" value="">
              <select name="select_seikyu">
                  <option value=""></option>
                  <option value="項目1">項目1</option>
                  <option value="項目2">項目2</option>
                  <option value="項目3">項目3</option>
              </select>   
            </div>	
            <div class="HP">
              <p>HP</p><input type="text" name="text_no" class="label_size_s" value="">
              <select name="select_seikyu">
                  <option value=""></option>
                  <option value="項目1">項目1</option>
                  <option value="項目2">項目2</option>
                  <option value="項目3">項目3</option>
              </select>
            </div>

          <div>
        </div>
        <!-- 郵送情報 -->
        <div class="Yuso_info">
          <h3>郵送情報</h3>
          <div class="company_yuso">
            <div class="yuso_yubin">
              <p>〒</p><input type="text" name="text_no" class="label_size_s" value=""><br/>
            </div>
            <div class="bill">
              <p>ビル・マンション名</p><input type="text" name="text_no" class="label_size_M_L" value=""><br/>
            </div>
            <div class="tanto">
              <p>担当者</p><input type="text" name="text_no" class="label_size_s" value="">
            </div>
            <div class="yakushoku">
              <p>役職</p><input type="text" name="text_no" class="label_size_s" value="">
            </div>
            <div class="keisho">
              <p>敬称</p><input type="text" name="text_no" class="label_size_s" value="">
            </div>
            <div class="daihyo_atena">
              <p>代表者/個人 宛名印字</p>
                <input type="checkbox" name="riyu" value="1" class="inji_check" checked="checked"><p>有</p>
                <input type="checkbox" name="riyu" class="inji_check"><p>無</p><br/>
            </div>
            <div class="yubin_butu">
              <p>郵便物</p>
              <select name="select_yubinbutu">
                <option value=""></option>
                <option value="年賀状">年賀状</option>
                <option value="サクセスネットワーク">サクセスネットワーク</option>
              </select>
            </div>
            <div class="iryo">
              <p>情報誌</p>
              <select name="select_yubinbutu">
                <option value=""></option>
                <option value="えニュース">えニュース</option>
                <option value="ふ">ふ</option>
                <option value="ウェーブ">ウェーブ</option>
                <option value="便り">便り</option>
                <option value="送付なし">送付なし</option>
              </select><br>        
            </div>
            <div class="yubin_tanto">
              <p>担当者</p><input type="text" name="text_no" class="label_size_s">&emsp;<p>※指名があれば</p>
            </div>
          </div>
        </div>

        <!-- 事務所情報 -->
        <div class="jimusho_info">
          <h3>事務所情報</h3>
          <div class="company_jimusho">
          <div class="shozoku">
              <p>所属</p><input type="text" name="text_no" class="label_size_s">
            </div>
            <div class="kubun">
              <p>区分</p><input type="text" name="text_no" class="label_size_ss"><br/>
            </div>
            <div class="kessan_tuki">
              <p>決算月</p><input type="text" name="text_no" class="label_size_s">
            </div>
            <div class="keitai">
              <p>形態</p><input type="text" name="text_no" class="label_size_M"><br/>
            </div>
            <div class="uriage_kibo">
              <p>売上規模</p><input type="text" name="text_no" class="label_size_ss">
            </div>
            <div class="kyori">
              <p>距離</p><input type="text" name="text_no" class="label_size_minimum  ">
            </div>
            <div class="nanido">
              <p>難易度</p><input type="text" name="text_no" class="label_size_minimum"><br/>
            </div>
            <div class="tanntoubu">
              <p>担当部</p><input type="text" name="text_no" class="label_size_ss">
              <p></p><input type="text" name="text_no" class="label_size_ss">
              <p></p><input type="text" name="text_no" class="label_size_ss"><br/>
            </div>
            <div class="tanntousha">
              <p>担当者</p><input type="text" name="text_no" class="label_size_ss">
              <p></p><input type="text" name="text_no" class="label_size_ss">
              <p></p><input type="text" name="text_no" class="label_size_ss"><br/>
            </div>
            <div class="kanyo_kaishi">
              <p>関与開始</p><input type="text" name="text_no" class="label_size_M">
            </div>
            <div class="kanyo_syuryo">
              <p>関与終了</p><input type="text" name="text_no" class="label_size_M"><br/>
            </div>
            <div class="toroku_bi">
              <p>登録日</p><input type="text" name="text_no" class="label_size_M">
            </div>
            <div class="syusei_gappi">
              <p>修正年月日</p><input type="text" name="text_no" class="label_size_M"><br/>
            </div>
            <div class="zeimusho">
              <p>税務署</p><input type="text" name="text_no" class="label_size_ss">
            </div>
            <div class="gyosyumoku">
              <p>業種目</p><input type="text" name="text_no" class="label_size_ss"><br/>
            </div>
            <div class="aoirokubun">
              <p>区分</p>
              <select>
                  <option value=""></option>
                  <option value="あ">あ</option>
                  <option value="い">い</option>
              </select>
            </div>
            <div class="gensennoki">
              <p>厳選納期</p>
              <select>
                  <option value=""></option>
                  <option value="毎月">毎月</option>
                  <option value="特例">特例</option>
                  <option value="特例の特例">特例の特例</option>
                  <option value="なし">なし</option>
              </select><br/>
            </div>
          </div>
        </div>

        <!-- 請求情報 -->
        <div class="seikyuu_info">
          <h3>請求情報</h3>
          <div class="company_seikyu">
            <div class="sikyukaishi">
              <p>開始</p><input type="text" name="text_no" class="label_size_M_L">&emsp;<p>※より請求</p><br/>
            </div>
            <div class="start_keisan">
              <input type="text" name="text_no" class="label_size_minimum">&emsp;<p>月計算分からスタート</p>
            </div>
            <div class="jihuriseikyu">
              <p>請求</p>
              <input type="checkbox" name="riyu" value="3" class="inji_check"><p>有</p>
              <input type="checkbox" name="riyu" value="3" class="inji_check"><p>無</p><br/>
            </div>
            <div class="kikan">
              <p>期間</p><input type="text" name="text_no" class="label_size_M"><br/>     
            </div>

            <div class="tukiji">
              <p>月次</p><input type="text" name="text_no" class="label_size_s">       
            </div>
            <div class="kessan">
              <p>決算</p><input type="text" name="text_no" class="label_size_s">      
            </div>
            <div class="shohizei">
              <p>消費税</p><input type="text" name="text_no" class="label_size_M"><br/>
            </div>
            <div class="yoteishinkoku">
              <p>予定申告</p><input type="text" name="text_no" class="label_size_s"><br/>
            </div>
            <div class="nenmatutyosei">
              <p>年末調整</p><input type="text" name="text_no" class="label_size_s">
            </div>
            <div class="sonota">
              <p>その他</p><input type="text" name="text_no" class="label_size_M_L">
              <p></p><input type="text" name="text_no" class="label_size_ss"> 
            </div>
            <div class="sonota_02">
              <p></p><input type="text" name="text_no" class="label_size_M_L">
              <p></p><input type="text" name="text_no" class="label_size_ss">
            </div>
            <div class="sonota_03">
              <p></p><input type="text" name="text_no" class="label_size_M_L">
              <p></p><input type="text" name="text_no" class="label_size_ss">
            </div>
            <div class="sonota_04">
              <p></p><input type="text" name="text_no" class="label_size_M_L">
              <p></p><input type="text" name="text_no" class="label_size_ss">
            </div>
            <div class="nenkangokei">
              <p>年間合計</p><input type="text" name="text_no" class="label_size_M_L">
            </div>
          </div>
        </div>

        <!-- 売掛情報 -->
        <div class="urikake_info">
          <h3>料金根拠</h3>
          <div class="company_urikake">
            <div class="select_month">
              <p>監査区分&emsp;</p>
              <select>
                  <option value=""></option>
                  <option value="毎月">毎月</option>
                  <option value="年一">年一</option>
                  <option value="その他">その他</option>
              </select>
              <input type="text" name="text_no" class="label_size_s">
            </div>

            <div class="Gyomu_Block">
              <div class="kessan_tukiji">
                <p class="gyomu_naiyo">業務内容</p>
                <p class="ryokin">料金</p><br>
                <p>決関係</p><br>
                <p>決申告</p><br>
                <p>消申告</p><br>
                <p>月次業務</p><br>
                <p>月次料</p><br>
                <p>代行</p><br>
                <p>元作成料</p><br>
                <div class="kessan_tukiji_input">
                  <p class="kessan_goukei">111111111</p><br/>
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <br/><p class="kessan_goukei">111111111</p><br/>
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <input type="text" name="text_no" class="pittari_size_ss">
                </div>
              </div>

              <div class="komon_etc">
                <p class="gyomu_naiyo">業務内容</p>
                <p class="ryokin">料金</p><br>
                <p>顧問</p><br>
                <p>税務</p><br>
                <p>経営</p><br>
                <p>社士</p><br>
                <p>財産</p><br>
                <p>O</p><br>
                <p>CP</p><br>
                <p>問</p><br>
                <p>その他</p><br>
                <p>資産</p><br>
                <div class="komon_etc_input">
                  <br>
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <br><br>
                  <input type="text" name="text_no" class="pittari_size_ss">
                </div>
              </div>
            </div>
          </div> 
        </div>

        <!-- 変更記録 -->
        <div class="henko_info">
          <h3>変更記録</h3>
          <div class="company_henko">
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <input type="text" name="text_no" class="label_size_M"><br/>
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <input type="text" name="text_no" class="label_size_M"><br/>
                  <input type="text" name="text_no" class="pittari_size_ss">
                  <input type="text" name="text_no" class="label_size_M"><br/>
                  <input type="text" name="text_no" class="pittari_size_ss">       
                  <input type="text" name="text_no" class="label_size_M"><br/>      
          </div>
        </div> 
    </div>            
  </body>

</html>
<?php
// // セッションを開始する
  $SQL = ""; 
  $Name01 ="";
  $Name02 ="";
  $Column_Name ="";
  $Category  = "";
  $Right_Num = ""; 
  $Left_Num = "";

  // 部分検索SQL発行用
  $Like_Array = array(
    'Company_Name_furigana',
    'Company_Name',
    'tusho',
    'daihyo_Name_furigna',
    'daihyo_Name',
    'Yubin_No',
    'Jyusho_01',
    'Company_HP',
    'Campany_Tel',
    'Campany_Fax',
    'Campany_Mail',
    'yubin_jyusho_01',
    'daihyo_Name_furigna_kojin_FM',
    'Yakushoku',
    'Shogo_Keisho',
    'Yubin_syurui',
    'Iryou_zassh',
    'oya_kaisha',
    'Keiri_Sekinin_Furigana',
    'Keiri_Sekinin_Name'
  );

  // 等号SQL発行用
  $Togo_Array = array(
    // 'ID',
    'TKC_ID',
    'Tokuisaki_ID',
    'jihuriseikyu',
    'atena',
    'yubin_tanto',
    'Jyunkaikansa_Jissi',
    'Jyutaku_shohizei',
    'ketai',
    'hojin_kubun',
    'nanido',
    'KansaTanto_Name',
    'Jishatanto',
    'KansaTanto_Buka_Name',
    'Jishatanto_Bu_4Ser',
    'Kanyozeirishi_Name',
    'Zaimu_Kihon_System_Name',
    'zeimusho',
    'gyosyu_ID',
    'gyosyumoku',
    'aoirokubun',
    'Shinkokukigen_Entyo',
    'Shohizei_Kigen_Entyo',
    'Kabushiki_Jhoto'
  );

  // 比較SQL発行用（日付と数値の比較を行うための配列）
  $Sahen2_Array = array(
    'Shihonkin01' => 'Shihonkin02',
    'Hako_Kabu_sosu01' => 'Hako_Kabu_sosu02',
    'Jikokabu01' => 'Jikokabu02',
    'seikyu_kaishi01' => 'seikyu_kaishi02',
    'seikyu_kaishi_month01' => 'seikyu_kaishi_month02',
    'Jyutaku_Komonhosyugaku01' => 'Jyutaku_Komonhosyugaku02',
    'Jyutaku_Kesanhosyugaku01' => 'Jyutaku_Kesanhosyugaku02',
    'Jyutaku_Tahosyu01' => 'Jyutaku_Tahosyu02',
    'seturitu_ymd01' => 'seturitu_ymd02',
    'kanyo_kaishi01' => 'kanyo_kaishi02',
    'kanyo_syuryo01' => 'kanyo_syuryo02',
    'torokubi01' => 'torokubi02',
    'syuseibi01' => 'syuseibi02',
    'N_jigyo_kisyu_ymd01' => 'N_jigyo_kisyu_ymd02',
    'N_jigyo_kisyu_last_ymd01' => 'N_jigyo_kisyu_last_ymd02',
    'gensennouki01' => 'gensennouki02',
    'kesan_month01' => 'kesan_month02',
  );
  
  session_start();
  // 検索ボタンをクリックしたとき
  if(isset($_POST['search_button'])) {
    // ポストデータのサニタイズ
    $Search_Name_Array = array_map('htmlspecialchars', $_POST['search']);
    // 配列のコピー
    $searchcopy = $Search_Name_Array;

    // 等号SQLと部分検索SQLの発行用
    foreach($Search_Name_Array as $key => $value) {
      if(!empty($value)) {
        foreach($Togo_Array as $Togo) {
          if (in_array($key,[$Togo])) {
            $SQL .= " ".$key." = '".$value."' AND";    
            $Category .= "『".Category_create($key)."』, ";
          }
        }

        foreach($Like_Array as $Like) {
          if(in_array($key,[$Like])) {
            $SQL .= " ".$key." LIKE '%".$value."%' AND"; 
            $Category .= "『".Category_create($key)."』, ";
          }
        }
      }
    }


    // 数値を比較しSQLを作成
    foreach($searchcopy as $key => $val) {
      foreach($Sahen2_Array as $aa => $bb) {
        if(!empty($val)) {
          // 現在実行中の左辺のinput nameの格納
          if($key == $aa) {
            $Name01 = $key;
          } 
          // 現在実行中の右辺のinput nameの格納
          if($key == $bb) {
            $Name02 = $key;
          }

          // 最初の処理
          if(!empty($Name01) && empty($Name02)) {
            if(empty($Left_Num)) {
              $Left_Num = "'".$val."'";
            }
          }

          // 右辺に値が入っているとき
          if(!empty($Name02)) {
            if(empty($Right_Num)) {
              $Right_Num = "'".$val."'";
            }

            $Name01 = substr($Name01,0,-2);
            $Name02 = substr($Name02,0,-2);

            if($Name01 == "kesan_month" || $Name02 == "kesan_month") {
              $Right_Num = str_replace("'", "",$Right_Num);
              $Left_Num = str_replace("'", "",$Left_Num);
            }

            // 左辺には値がない時
            if(empty($Name01)) {
              $SQL .= " ".substr($key,0,-2)." <= ".$Right_Num." AND ";
              $Category .= "『".Category_create($Name02)."』, ";
              $Right_Num = ""; 
              $Left_Num = "";
              $Name01 = "";
              $Name02 = "";
            } else {
              // 右辺と左辺共に入っている時
              if($Left_Num > $Right_Num) {
                $SQL .= " ".$Name01." >= ".$Right_Num." AND ".$Name02." <= ".$Left_Num." AND ";  
                $Category .= "『".Category_create($Name01)."』, ";
                $Category .= "『".Category_create($Name02)."』, ";
                $Right_Num = ""; 
                $Left_Num = "";
                $Name01 = "";
                $Name02 = "";
              } else if($Left_Num == $Right_Num) {
                $SQL .= " ".$Name01." = '".$val."' AND ";
                $Category .= "『".Category_create($Name01)."』, ";
                $Category .= "『".Category_create($Name02)."』, ";
                $Right_Num = ""; 
                $Left_Num = "";
                $Name01 = "";
                $Name02 = "";
              } else {
                $SQL .= " ".$Name01." >= ".$Left_Num." AND ".$Name02." <= ".$Right_Num." AND ";  

                $Category .= "『".Category_create($Name01)."』, ";
                $Category .= "『".Category_create($Name02)."』, ";
                $Right_Num = ""; 
                $Left_Num = "";
                $Name01 = "";
                $Name02 = "";
              }
  
            }
          }
        } else {
          if(!empty($Name01) && empty($Name02)) {
            if($key == $bb) {
              $Name01 = substr($Name01,0,-2);
              if($Name01 == "kesan_month") {
                $Left_Num = str_replace("'", "",$Left_Num);
              }
              $SQL .= " ".substr($key,0,-2)." >= ".$Left_Num." AND "; 
              $Category .= "『".Category_create($Name01)."』, ";
              $Right_Num = ""; 
              $Left_Num = "";
              $Name01 = "";
              $Name02 = "";
            }
          }
        }
      }
    }

    if(!empty($SQL)) {
      $_SESSION['SQL'] = " WHERE ".substr($SQL,0,-4);
    } else {
      $_SESSION['SQL'] = $SQL;
    }

    
    $_SESSION['Category'] = substr($Category,0,-2);
    header( "Location: ../search_kekka.php?A=ser" );
  } else if(isset($_POST['Reset'])) {
    header("Location:../kokyaku_kanri.php");
  }
 
// 検索カテゴリーを追加
  function Category_create($Junle) {
    // 検索ワード用
    $Search_Words = array(
      // 'ID' => '顧客コード',
      'TKC_ID' => 'TKC_コード',
      'Tokuisaki_ID' => '請求コード',
      'Company_Name_furigana' => '商号フリガナ',
      'Company_Name' => '商号',
      'tusho' => '通称',
      'daihyo_Name_furigna' => '代表フリガナ',
      'daihyo_Name' => '代表者名',
      'Yubin_No' => '基本情報〒',
      'Jyusho_01' => '申告住所',
      'Company_HP' => 'HP',
      'Shihonkin01' => '資本金01',
      'Shihonkin02' => '資本金02',
      'Campany_Tel' => 'TEL',
      'Campany_Fax' => 'FAX',
      'Campany_Mail' => 'MAIl',
      'Hako_Kabu_sosu01' => '発行済株式の総数01',
      'Hako_Kabu_sosu02' => '発行済株式の総数02',
      'Jikokabu01' => '自己株式01',
      'Jikokabu02' => '自己株式02',
      'Kabushiki_Jhoto' => '株式の譲渡制限',
      'yubin_jyusho_01' => 'ビル・マンション名',
      'daihyo_Name_furigna_kojin_FM' => '担当者',
      'Yakushoku' => '役職',
      'Shogo_Keisho' => '敬称',
      'atena' => '代表者/個人 宛名印字',
      'yubin_tanto' => '郵便物送付先担当者',
      'Yubin_syurui' => '郵便物',
      'Iryou_zassh' => '医療情報誌',
      'seikyu_kaishi01' => '請求開始01',
      'seikyu_kaishi02' => '請求開始02',
      'seikyu_kaishi_month01' => '請求開始月01',
      'seikyu_kaishi_month02' => '請求開始月02',
      'jihuriseikyu' => '自振請求',
      'Jyunkaikansa_Jissi' => '期間',
      'Jyutaku_shohizei' => '消費税',
      'Jyutaku_Komonhosyugaku01' => '月次01',
      'Jyutaku_Komonhosyugaku02' => '月次02',
      'Jyutaku_Kesanhosyugaku01' => '決算01',
      'Jyutaku_Kesanhosyugaku02' => '決算02',
      'oya_kaisha' => '所属名',
      'ketai' => '関与形態',
      'Jyutaku_Tahosyu01' => 'その他01',
      'Jyutaku_Tahosyu02' => 'その他02',
      'kesan_month' => '決算月01',
      'hojin_kubun' => '区分名',
      'nanido' => '難易度',
      'seturitu_ymd01' => '設立年月日01',
      'seturitu_ymd02' => '設立年月日02',
      'KansaTanto_Name' => '担当者',
      'Jishatanto' => '副担当者',
      'KansaTanto_Buka_Name' => '担当者部署',
      'Jishatanto_Bu_4Ser' => '副担当者部署',
      'kanyo_kaishi01' => '関与開始01',
      'kanyo_kaishi02' => '関与開始02',
      'kanyo_syuryo01' => '関与終了01',
      'kanyo_syuryo02' => '関与終了02',
      'Kanyozeirishi_Name' => '関与税理士',
      'torokubi01' => '登録日01',
      'torokubi02' => '登録日02',
      'syuseibi01' => '修正年月日01',
      'syuseibi02' => '修正年月日02',
      'Zaimu_Kihon_System_Name' => '財務基本システム名',
      'N_jigyo_kisyu_ymd01' => '期首年月日01',
      'N_jigyo_kisyu_ymd02' => '期首年月日02',
      'N_jigyo_kisyu_last_ymd01' => '期末年月日01',
      'N_jigyo_kisyu_last_ymd02' => '期末年月日02',
      'Zaimu_Kihon_System_Name' => '基本システム名',
      'zeimusho' => '税務署',
      'gyosyu_ID' => '業種コード',
      'gyosyumoku' => '業種種目',
      'aoirokubun' => '青色区分',
      'Keiri_Sekinin_Furigana' => '経理責任者 フリガナ',
      'Keiri_Sekinin_Name' => '経理責任者　氏名',
      'Shinkokukigen_Entyo' => '申告期限延長',
      'Shohizei_Kigen_Entyo' => '消費税期限延長',
      'gensennouki01' => '納期01',
      'gensennouki02' => '納期02',
    );
    foreach($Search_Words as $Search_Key => $Search_Value) {
      if($Search_Key == $Junle) {
        return $Search_Value;
      }
    }
  }

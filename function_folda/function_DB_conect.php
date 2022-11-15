<?php
if (session_status() == PHP_SESSION_NONE) {
   // セッションは有効で、開始していないとき
   session_start();
}
$updatey = array();

// 変数の初期化
// 顧客マスタ変数
$mac_db_sql_client = null;
// 社員マスタ変数
$mac_db_sql_shain = null;
// 請求マスタ変数
$mac_db_sql_seikyu_kanren = null;
// 検索関連
$mac_db_search = null;

$Client_Create_info = null;

// 各フラグ変数
$FLAG = "";

// SQLカラム変数;
$SQL_Colums = "";

//DB情報
$mac_db_host = null;
// 現在のURLを取得
$server_url = $_SERVER['REQUEST_URI'];

// JoinSQL
$Join_Column_ON = " hdr_shain_master AS shain
					LEFT JOIN mst_soshiki AS soshiki
					ON
					shain.soshiki_ID = soshiki.ID
					LEFT JOIN mst_yakushoku AS yakushoku
					ON
					shain.yakushoku_id = yakushoku.ID
					LEFT JOIN mst_ka AS ka
					ON
					shain.ka_ID = ka.ID
					LEFT JOIN mst_bu AS bu
					ON
					shain.bu_ID = bu.ID
					LEFT JOIN mst_shainkubun AS kubuun
					ON
					shain.shainkubun_ID = kubuun.ID
					LEFT JOIN mst_gakureki AS gakureki
					ON
					shain.gakureki_id = gakureki.ID";

// 前のページのURL取得
if (!empty($_SERVER['HTTP_REFERER'])) {
   $motourl = $_SERVER['HTTP_REFERER'];
}

// 時刻の取得
date_default_timezone_set('Asia/Tokyo');
$Now_Time =  date("Y-m-d H:i");

$Client_KanriID = "";
$Client_IDName = "";
$Client_kousin_id = "";

$Page_Instant = new Pagenation();
$Sql_Change = new SQL_henkan();
$Henko_P = new SQL_Shori();
// DBへ接続
$mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');


// insert into user values(1, 'Yamada', 19, 'Tokyo');
$Insert_DB_Client = array(
   "No", "select", "seikyu_no"
);
// 本番環境と開発環境の切り替え
if ($_SERVER['HTTP_HOST'] == "○○") {
   include_once 'C:/xampp/htdocs/System/MacDB/function_folda/Page.php';
} else {
   include_once '/share/CACHEDEV1_DATA/Web/MacDB/Test/function_folda/Page.php';
}


/************************************
 ************************************
　　　　　	ボタン押下処理全般
 ************************************
 *************************************/

/************************************
顧客マスタページと顧客検索のページ処理
 *************************************/
// 検索時処理
if (!empty($_GET['A'])) {
   if ($_GET['A'] == "ser") {
      // session_start();
      $SQL = $_SESSION['SQL'];
      $Counted_No = $Page_Instant->Countedtable($Sql_Change->Selct_henkan_jhoken("SELECT COUNT(*) ", " hdr_client_mastar ", $SQL));
      $Create_sql = $Page_Instant->sqlcreate($Sql_Change->Selct_henkan_jhoken("SELECT * ", " hdr_client_mastar ", $SQL));
      $Create_sql_NO = $Page_Instant->sqlcreate_No($Sql_Change->Selct_henkan_jhoken("SELECT * ", " hdr_client_mastar ", $SQL));
   } elseif ($_GET['user'] == "USER_NAME") {
      $_SESSION['USER_NAME'] = $_GET['A'];
   }
}

// 顧客履歴の新規登録処理
if (isset($_POST['client_send'])) {
   // session_start();
   // 新規登録処理
   // 顧客やり取り処理
   $Client_contents = Validation_Replace($_POST["contents_area"]);
   $Client_ID_No = htmlspecialchars($_POST["Client_no"], ENT_QUOTES, "UTF-8");
   $Client_Name = htmlspecialchars($_POST["Client_Name"], ENT_QUOTES, "UTF-8");

   // 新規登録時の次の履歴ID
   $Next_ID = $Henko_P->A_incle_SQL_process('dtl_client_rireki_master', $Page_Instant, $Sql_Change);

   $rireki_colume = "koshinsha,rireki_ID,Client_ID,torokujikan_img,file_path";
   $rireki_con = "'" . $_SESSION['USER_NAME'] . "', " . $Next_ID . ", " . $Client_ID_No . ",'" . $_SESSION['Client_torokujikan'] . "'";

   if (!empty($_FILES["fname"]["name"])) {
      File_Uploader(Folda_Operate($Client_Name), $rireki_colume, $rireki_con, 'mst_link_create(', $Page_Instant, $Sql_Change, $Henko_P);
   }

   // // 新規投稿処理
   $Create_Column_Name = "Client_Master_ID, name,gazo,torokujikan";
   $Create_con = "" . $Client_ID_No . ", '" . $_SESSION['USER_NAME'] . "', '" . $Client_contents . "', '" . $Now_Time . "'";
   $Henko_P->Insert_SQL_process('dtl_client_rireki_master(', $Create_Column_Name, $Create_con, $Page_Instant, $Sql_Change);
   header("Location: ../Read_Client.php?ID=" . $Client_ID_No);
}

// 顧客履歴の更新処理
if (isset($_POST['client_Update'])) {
   // session_start();
   // 更新ボタン処理
   // $USER_NAME = $_POST["USER"];
   $Client_contents = Validation_Replace($_POST["contents_area"]);
   if (!empty($Client_contents)) {
      $Client_Name = htmlspecialchars($_POST["Client_Name"], ENT_QUOTES, "UTF-8");
      $koushin_ID = $_SESSION['Client_Kosin_ID'] + 1;
      $rireki_colume = "koshinsha,rireki_ID,koshin_ID,Client_ID,torokujikan_img,file_path";
      $rireki_con = "'" . $_SESSION['USER_NAME'] . "', " . $_SESSION['Client_KanriID'] . ", " . $koushin_ID . ", " . $_SESSION['Client_IDName'] . ", '" . $_SESSION['Client_torokujikan'] . "'";
      // ファイルのアップロード
      if (!empty($_FILES["fname"]["name"])) {
         File_Uploader(Folda_Operate($Client_Name), $rireki_colume, $rireki_con, 'mst_link_create(', $Page_Instant, $Sql_Change, $Henko_P);
      }

      // 履歴マスタの更新
      $Create_Column_Name = "ID,Client_Master_ID,kousin_id,name,gazo,koushin_user,koushin_jikan,torokujikan";
      $Create_con = "" . $_SESSION['Client_KanriID'] . ", " . $_SESSION['Client_IDName'] . ", " . $koushin_ID . ", '" . $_SESSION['USER_NAME'] . "', '" . $Client_contents . "', '" . $_SESSION['USER_NAME'] . "', '" . $Now_Time . "', '" . $_SESSION['Client_torokujikan'] . "'";
      $Henko_P->Insert_SQL_process('dtl_client_rireki_master(', $Create_Column_Name, $Create_con, $Page_Instant, $Sql_Change);
      unset($_SESSION['Client_torokujikan']);
   }

   header("Location: ../Read_Client.php?ID=" . $_SESSION['Client_IDName']);
}

// 投稿内容の検索
if (isset($_POST['Search_post_button'])) {
   // session_start();
   $Serach_post = array_map('htmlspecialchars', $_POST['SerachPost']);
   $Client_ID = htmlspecialchars($_POST["client_id"], ENT_QUOTES, "UTF-8");

   $PostSearch_SQL = "";
   foreach ($Serach_post as $key => $value) {
      if (!empty($value)) {
         $PostSearch_SQL = Search_array_create($Serach_post);
      }
   }

   if (!empty($PostSearch_SQL)) {
      // プロセス名
      $Select_Column = "SELECT *";
      $Select_Count = "SELECT COUNT(*)";
      // 結合テーブル作成
      $Join_Table = " dtl_client_rireki_master";
      // WHERE 条件作成 
      $Jhoken = " WHERE " . $PostSearch_SQL . " AND ronri_delete = 0 ";
      $_SESSION['hikaku'] = $Page_Instant->sqlcreate_tujyo02($Sql_Change->Selct_henkan_jhoken($Select_Column, $Join_Table, $Jhoken));
      $_SESSION['syuturyoku'] = $Page_Instant->sqlcreate_tujyo02($Sql_Change->Selct_henkan_jhoken($Select_Column, $Join_Table, $Jhoken));
      $Count_Youso = $Page_Instant->sqlcreate_tujyo($Sql_Change->Selct_henkan_jhoken($Select_Count, $Join_Table, $Jhoken));
      $_SESSION['Last_No'] = $Count_Youso->fetchColumn();;

      if (empty($_SESSION['hikaku'])) {
         $_SESSION['empty_kekka'] = "見つかりませんでした";
      }
   }

   header("Location: ../Read_Client.php?ID=" . $Client_ID);
}

// ロックボタン処理
if (isset($_POST['Lock_button'])) {
   $Client_KanriID = $_POST["Client_KanriID"];
   $Client_ID = $_POST["Client_IDName"];
   $Client_kousin_id = $_POST["Client_Koshin_ID"];
   $Jhoken = "ID = " . $Client_KanriID . " AND Client_Master_ID=" . $Client_ID . " AND kousin_id= " . $Client_kousin_id . "";
   $SQL_Colums = "rock_flag = 1";
   $Henko_P->Update_SQL_process("dtl_client_rireki_master", $SQL_Colums, $Jhoken, $Page_Instant, $Sql_Change);
   header("Location: ../Read_Client.php?ID=" . $Client_ID);
}

// ロックボタン解除処理
if (isset($_POST['Lock_button_kaijyo'])) {
   $Client_KanriID = $_POST["Client_KanriID"];
   $Client_ID = $_POST["Client_IDName"];
   $Client_kousin_id = $_POST["Client_Koshin_ID"];
   $Jhoken = "ID = " . $Client_KanriID . " AND Client_Master_ID=" . $Client_ID . " AND kousin_id= " . $Client_kousin_id . "";
   $SQL_Colums = "rock_flag = 0";
   $Henko_P->Update_SQL_process("dtl_client_rireki_master", $SQL_Colums, $Jhoken, $Page_Instant, $Sql_Change);
   header("Location: ../Read_Client.php?ID=" . $Client_ID);
}

// 削除ボタン処理
if (isset($_POST['Delete_button'])) {
   // session_start();
   $Client_KanriID = $_POST["Client_KanriID"];
   $Client_ID = $_POST["Client_IDName"];
   $Client_kousin_id = $_POST["Client_Koshin_ID"];

   $Jhoken = "ID = " . $Client_KanriID . " AND Client_Master_ID=" . $Client_ID . "";
   $SQL_Colums = "ronri_delete = 1,delete_user = '" . $_SESSION['USER_NAME'] . "',delete_jikan='" . $Now_Time . "'";
   $Henko_P->Update_SQL_process("dtl_client_rireki_master", $SQL_Colums, $Jhoken, $Page_Instant, $Sql_Change);
   header("Location: ../Read_Client.php?ID=" . $Client_ID);
}

// 編集ボタン処理
if (isset($_POST['hensyu_button'])) {
   // session_start();
   $_SESSION['Client_KanriID'] = htmlspecialchars($_POST["Client_KanriID"], ENT_QUOTES, "UTF-8");
   $_SESSION['Client_IDName'] = htmlspecialchars($_POST["Client_IDName"], ENT_QUOTES, "UTF-8");
   $_SESSION['Client_Kosin_ID'] = htmlspecialchars($_POST["Client_Koshin_ID"], ENT_QUOTES, "UTF-8");
   $_SESSION['Client_torokujikan'] = htmlspecialchars($_POST["Client_torokujikan"], ENT_QUOTES, "UTF-8");

   // 結合テーブル作成
   $Join_Table = " dtl_client_rireki_master ";
   // WHERE 条件作成 
   $Jhoken = " WHERE ID =" . $_SESSION['Client_KanriID'] . " AND Client_Master_ID= " . $_SESSION['Client_IDName'] . " AND kousin_id = " . $_SESSION['Client_Kosin_ID'] . " AND ronri_delete = 0";
   $Search_post_hikaku = $Henko_P->SELECT_todoke_shori("SELECT * ", $Join_Table, $Jhoken, $Page_Instant, $Sql_Change);
   // 編集対象の呼び出し
   foreach ($Search_post_hikaku as $a) {
      $_SESSION['hensyu_content'] = $a['gazo'];
   }

   header("Location: ../Read_Client.php?ID=" . $_SESSION['Client_IDName']);
}

// キャンセルボタン処理
if (isset($_POST['client_cansel'])) {
   $Client_ID = $_POST["Client_IDName"];
   header("Location: ../Read_Client.php?ID=" . $Client_ID);
}

// ファイルの削除(論理)
if (isset($_GET['rireki_ID_ronri'])) {
   $Client_rireki_ID =  htmlspecialchars($_GET["rireki_ID_ronri"], ENT_QUOTES, "UTF-8");
   $Client_ID = htmlspecialchars($_GET["Client_ID_ronri"], ENT_QUOTES, "UTF-8");
   $Client_Name = htmlspecialchars($_GET["Client_name_ronri"], ENT_QUOTES, "UTF-8");
   $File_Path = htmlspecialchars($_GET['File_path_ronri'], ENT_QUOTES, "UTF-8");
   $directory_path_Trash = '../../File_Trash/' . $Client_Name . '/';

   // 顧客ファイルのゴミ箱フォルダが存在しない時にフォルダ作成
   if (!file_exists($directory_path_Trash)) {
      //存在しないときの処理
      mkdir($directory_path_Trash, 0700);
   }

   // ファイル名取得
   $File_Name = substr($File_Path, strrpos($File_Path, "/") + 1, strlen($File_Path));
   // // 各企業のゴミ箱フォルダに該当ファイルを移動
   rename($File_Path, $directory_path_Trash . $File_Name);

   // ファイルリンクパスの論理削除
   $Jhoken_link = " rireki_ID = " . $Client_rireki_ID . " AND Client_ID = " . $Client_ID;
   $SQL_Colums = "ronri_delete = 1,file_path ='" . $directory_path_Trash . $File_Name . "'";
   $Henko_P->Update_SQL_process("mst_link_create", $SQL_Colums, $Jhoken_link, $Page_Instant, $Sql_Change);
   header("Location: ../Read_Client.php?ID=" . $Client_ID);
}

// ファイルのダウンロード機能
if (isset($_GET['Client_ID_DL'])) {
   $Client_ID = htmlspecialchars($_GET["Client_ID_DL"], ENT_QUOTES, "UTF-8");
   $File_Path = htmlspecialchars($_GET['File_path_DL'], ENT_QUOTES, "UTF-8");
   $File_Name = substr($File_Path, strrpos($File_Path, "/") + 1, strlen($File_Path));
   // ファイルタイプを指定
   header('Content-Type: application/force-download');

   // ファイルサイズを取得し、ダウンロードの進捗を表示
   header('Content-Length: ' . filesize($File_Path));

   // ファイルのダウンロード、リネームを指示
   header('Content-Disposition: attachment; filename="' . $File_Name . '"');

   // ファイルを読み込みダウンロードを実行
   readfile($File_Path);
}

// ゴミ箱内のファイルの復元
if (isset($_GET['rireki_ID']) && isset($_GET['Client_ID'])) {
   $Client_Name = htmlspecialchars($_GET["Client_name"], ENT_QUOTES, "UTF-8");
   $Client_ID = htmlspecialchars($_GET['Client_ID'], ENT_QUOTES, "UTF-8");
   $Client_rireki_ID = htmlspecialchars($_GET['rireki_ID'], ENT_QUOTES, "UTF-8");
   $File_Path = htmlspecialchars($_GET['File_fukatu'], ENT_QUOTES, "UTF-8");
   $directory_path_Trash = '../../File_Trash/' . $Client_Name . '/';
   $File_Name = substr($File_Path, strrpos($File_Path, "/") + 1, strlen($File_Path));
   rename($directory_path_Trash . $File_Name, $File_Path);
   $Jhoken_link = " rireki_ID = " . $Client_rireki_ID . " AND Client_ID = " . $Client_ID;
   $SQL_Colums = "ronri_delete = 0";
   $Henko_P->Update_SQL_process("mst_link_create", $SQL_Colums, $Jhoken_link, $Page_Instant, $Sql_Change);
   header("Location: ../Read_Client.php?ID=" . $Client_ID);
   exit;
}

// ゴミ箱内のファイルの物理削除
if (isset($_GET['Client_ID_buturi'])) {
   $Client_ID = htmlspecialchars($_GET['Client_ID_buturi'], ENT_QUOTES, "UTF-8");
   $Client_Name = htmlspecialchars($_GET["Client_name_buturi"], ENT_QUOTES, "UTF-8");
   $File_Path = htmlspecialchars($_GET['File_path_buturi'], ENT_QUOTES, "UTF-8");
   $Client_rireki_ID = htmlspecialchars($_GET['rireki_ID_buturi'], ENT_QUOTES, "UTF-8");
   unlink($File_Path);
   $Jhoken_link = " rireki_ID = " . $Client_rireki_ID . " AND Client_ID = " . $Client_ID;
   $SQL_Colums = "ronri_delete = 2";
   $Henko_P->Update_SQL_process("mst_link_create", $SQL_Colums, $Jhoken_link, $Page_Instant, $Sql_Change);
   header("Location: ../Read_Client.php?ID=" . $Client_ID);
   exit;
}


/************************************
　　　　  社員管理ページ処理
 *************************************/
// 社員マスタ更新処理
if (isset($_POST['shain_koushin'])) {
   $Rireki_BF = array();
   $hikakuyo = array();
   $bu_val = '';
   $yaku_val = '';
   $ido_Val = '';

   include_once './function_Column_Array.php';

   $AF_Val = '';
   $Up_AF = '';
   $Get_DB_Shain = '';
   $Con_Shain = '';
   $Ido_Column_Val = '';
   $return_Post = '';

   $cat_SQL = '';
   $Bef = '';
   $Aft = '';
   $Update_Sql = '';

   $Ido_Column_Val = 'Table_Name,Column_Name,form_name,henko_page,Koshinnaiyo_Before,Koshinnaiyo_After,Koshinsha ';
   $Ido_rireki_Column = 'shain_ID,henkomae_busho_Name,henkogo_busho_Name,henkomae_yakushoku_Name,henkogo_yakushoku_Name';

   // 社員番号を取得
   $shain_ID = htmlspecialchars($_POST['shain_info']['ID'], ENT_QUOTES, "UTF-8");
   // $shain_Name = htmlspecialchars($_POST['shain_info']['sei'], ENT_QUOTES, "UTF-8") . ' ' . htmlspecialchars($_POST['shain_info']['mei'], ENT_QUOTES, "UTF-8");
   $shain_Post_Date = array_map('htmlspecialchars', $_POST['shain_info']);

   // 最新の社員マスタのデータを取得する
   $Shain_hikaku_itiran =  $Henko_P->SELECT_Get('SELECT *', "hdr_shain_master", ' WHERE  ID = ' . $shain_ID, $Page_Instant, $Sql_Change);

   //　取得したカラムの成型の為の配列
   $Column_Name = $_SESSION['csv_col2'];
   foreach ($Column_Name as $key => $value) {
      // key=コメント名 value=カラム名.不要なカラム以外を格納
      if (
         $value['Field'] !== 'ronri_delete' && $value['Field'] != 'torokusha' && $value['Field'] != 'kousinjikan'
         && $value['Field'] != 'koushinsha' && $value['Field'] != 'Shain_kanri_kengen' && $value['Field'] != 'torokuji'
      ) {
         $hikakuyo[$value['Comment']] = $value['Field'];
      }
   }

   // 作成した比較用配列で個人ポストデータとDBのデータを比較
   foreach ($hikakuyo as $key => $value) {
      if ($Shain_hikaku_itiran[0][$value] != $shain_Post_Date[$value]) {
         // 入社、退社、生年月日はポストデータ変更がなければ空になる
         if ($value == 'nyusha_nengapi' || $value == 'taisha_nengapi' || $value == "seinengapi") {
            if (!empty($shain_Post_Date[$value])) {
               $Update_Sql .= $value . '="' . $shain_Post_Date[$value] . '",';
               if (is_numeric($Shain_hikaku_itiran[0][$value])) {
                  list($Bef, $Aft) = Log_Create($Shain_hikaku_itiran[0][$value], $shain_Post_Date[$value], $value, $Log_Before);
               } else {
                  $Bef = $Shain_hikaku_itiran[0][$value];
                  $Aft = $shain_Post_Date[$value];
               }
               $Rireki_BF = ['"社員マスタ",' . '"' . $key . '",' . '"社員情報更新照会",' . '"社員管理",' . '"' . $Bef . '",' . '"' . $Aft . '",' . '"' . $_SESSION['USER_NAME'] . '"'];
            }
         } else {
            $Update_Sql .= $value . '="' . $shain_Post_Date[$value] . '",';
            if (is_numeric($Shain_hikaku_itiran[0][$value])) {
               list($Bef, $Aft) = Log_Create($Shain_hikaku_itiran[0][$value], $shain_Post_Date[$value], $value, $Log_Before);
            } else {
               $Bef = $Shain_hikaku_itiran[0][$value];
               $Aft = $shain_Post_Date[$value];
            }

            if ($value == 'bu_ID') {
               list($Bef, $Aft) = Log_Create($Shain_hikaku_itiran[0][$value], $shain_Post_Date[$value], $value, $Log_Before);
               $bu_val = '"' . $Bef . '","' . $Aft;
               // $ido_Val .= '"' . $Bef . '","' . $Aft;
            } elseif ($value == 'yakushoku_id') {
               list($Bef, $Aft) = Log_Create($Shain_hikaku_itiran[0][$value], $shain_Post_Date[$value], $value, $Log_Before);
               $yaku_val .= '","' . $Bef . '","' . $Aft . '"';
            }
            $Rireki_BF = ['"社員マスタ",' . '"' . $key . '",' . '"社員情報更新照会",' . '"社員管理",' . '"' . $Bef . '",' . '"' . $Aft . '",' . '"' . $_SESSION['USER_NAME'] . '"'];
         }
      }
   }

   if (!empty($bu_val) && !empty($yaku_val)) {
      $ido_Val = $shain_ID . "," . $bu_val . $yaku_val;
   } elseif (!empty($bu_val) && empty($yaku_val)) {
      $ido_Val = $shain_ID . ',' . $bu_val . '","",""';
   } elseif (empty($bu_val) && !empty($yaku_val)) {
      $ido_Val = $shain_ID . ',"","' . $yaku_val;
   }

   if (!empty($Update_Sql)) {
      // アップデートの実行
      $Henko_P->Update_SQL_process("hdr_shain_master", substr($Update_Sql, 0, -1), "ID = " .  $shain_ID, $Page_Instant, $Sql_Change);
      // 変更ログの作成
      foreach ($Rireki_BF as $key => $value) {
         $Henko_P->Insert_SQL_process('mst_henko_log(', $Ido_Column_Val, $value, $Page_Instant, $Sql_Change);
      }
      if (!empty($ido_Val)) {
         $Henko_P->Insert_SQL_process('mst_ido_rireki(', $Ido_rireki_Column, $ido_Val, $Page_Instant, $Sql_Change);
      }
   }

   header("Location: ../Shain_kanri.php");
}

// ログ作成
function Log_Create($BF, $AF, $column, $Log_Before)
{

   foreach ($Log_Before as $value1) {
      if ($value1[0] == $column) {
         if ($value1[1] == $BF) {
            $Bef = $value1[2];
         }
         if ($value1[1] == $AF) {
            $Aft = $value1[2];
         }
      }
   }
   return array($Bef, $Aft);
}

// 社員マスタ新規情報登録
if (isset($_POST['shain_shinki'])) {
   $Create_Column_Name = "";
   $Create_con = "";
   if (!empty($_POST['Shin_info'])) {
      $Regi_shain_info01 = array_map('htmlspecialchars', $_POST['Shin_info']);
      $Regi_shain_info02 = $Regi_shain_info01;

      // // 新規登録時入力されていない箇所以外は省く
      foreach ($Regi_shain_info01 as $f => $d) {
         $Create_Column_Name .= $f . ",";
         $Create_con .= "'$d'" . ",";
      }
   }

   if (!empty($Create_Column_Name)) {
      $Create_Column_Name = substr($Create_Column_Name, 0, -1);
      $Create_con = substr($Create_con, 0, -1);
   }

   $Table_Name = "hdr_shain_master(";
   $Henko_P->Insert_SQL_process($Table_Name, $Create_Column_Name, $Create_con, $Page_Instant, $Sql_Change);
   header("Location: ../Shain_kanri.php");
}


// 社員マスタ社員削除
if (isset($_POST['shain_del'])) {
   // session_start();
   $_SESSION['del_houkoku'] =  "削除完了しました。";
   $Jhoken = "ID = " . $_POST['shain_id'];
   $SQL_Colums = "ronri_delete = 1";
   $Henko_P->Update_SQL_process("hdr_shain_master", $SQL_Colums, $Jhoken, $Page_Instant, $Sql_Change);
   unset($_SESSION['userID']);
   header("Location: ../Shain_kanri.php");
}

// 社員マスタ社員削除（キャンセル押下）
if (isset($_POST['shain_can'])) {
   //session_start();
   unset($_SESSION['stack_up']);
   unset($_SESSION['Search_keka_hozon']);
   unset($_SESSION['userID']);
   unset($_SESSION['Search_taisha']);
   unset($_SESSION['Search_Keka_shian']);
   header("Location: ../Shain_kanri.php");
}

// 社員番号取得
if (!empty($_GET["user_id"])) {
   //session_start();
   $Shain_ID = $_GET["user_id"];
   $_SESSION['userID'] = $Shain_ID;
   header("Location: ../Shain_kanri.php");
}

// 社員管理検索ボタン押下後の処理
if (isset($_POST['SF_Button_Serach'])) {
   //session_start();
   // 基本情報セッション削除
   unset($_SESSION['userID']);
   unset($_SESSION['stack_up']);
   $Shain_kanri_Serach = "";
   $condition = "";
   $cnt = "";
   $soshiki = "";
   $search_Taisya = true;
   $buka_val = '';

   // 配列のエスケープ処理
   if (!empty($_POST['Serachbox'])) {
      $Shain_kanri_Serach = array_map('htmlspecialchars', $_POST['Serachbox']);
      $Shain_kanri_Serach_ch = $Shain_kanri_Serach;
   }

   // 条件の絞りだし
   // 含む　含まない　大きい 以上　以下　小さい　大きい
   if (!empty($_POST['condition'])) {
      $condition = $_POST['condition'];
      $cnt = count($condition) + 1;
   }

   // 組織にチェックが入っている場合
   if (isset($_POST['check_soshiki'])) {
      $q = array_map('htmlspecialchars', $_POST["check_soshiki"]);
      foreach ($q as $key => $value) {
         $soshiki .= 'shain.soshiki_ID =' . $value . ' AND ';
      }
   }


   // // 二つの配列に要素が存在しなければ、社員管理ページにリダイレクト
   if (empty($soshiki) && empty($Shain_kanri_Serach)) {
      header("Location: ../Shain_kanri.php");
      exit;
   }

   // 検索条件保存配列
   $Shain_Search_SQL =  createsql_val($Shain_kanri_Serach, $condition, $cnt, $soshiki);

   // 社員管理検索時の処理
   // プロセス名
   $Select_Column = "SELECT *";
   // 結合テーブル作成
   $Join_Table = $Join_Column_ON;

   // 検索結果を返す
   $Search_keka_shain = $Henko_P->SELECT_todoke_shori($Select_Column, $Join_Table, ' WHERE ' . $Shain_Search_SQL, $Page_Instant, $Sql_Change);
   // 検索結果数を返す
   // $Search_keka_shain_count = $Henko_P->SELECT_count_shori($Select_Column, $Join_Table, ' WHERE ' . $Shain_Search_SQL, $Page_Instant, $Sql_Change);
   $_SESSION['stack_up'] = $Search_keka_shain;
   $_SESSION['Search_Keka_shian'] = 'serach';
   header("Location: ../Shain_kanri.php");
}

// CSV出力処理
if (isset($_POST['shain_CSV_syutu'])) {
   $csv_con = $_SESSION['cv_con'];
   $csv_col = $_SESSION['csv_col2'];
   $CSV_File_Name = './社員管理.csv';

   // csvファイルが存在しなければ作成
   if (!file_exists($CSV_File_Name)) {
      touch($CSV_File_Name);
   }

   mb_convert_variables("SJIS-win", "UTF-8", $csv_con);
   mb_convert_variables("SJIS-win", "UTF-8", $csv_col);

   // ファイル開く
   $fp = fopen($CSV_File_Name, 'w');
   foreach ($csv_col as $key => $value) {
      fwrite($fp, "'" . $value['Comment'] . "',");
   }
   fwrite($fp, "\n");

   foreach ($csv_con as $key => $value) {
      fputcsv($fp, $value);
   }
   fclose($fp);
   header("Content-Type: application/octet-stream");
   // ダイアログボックスに表示するファイル名
   header("Content-Disposition: attachment; filename=社員管理.csv");
   // 対象ファイルを出力する。
   readfile($CSV_File_Name);
   exit;
}

// csv差分登録押下処理
if (isset($_POST['uodate'])) {
   //  CSVファイルの差分確認
   if (!empty($_FILES['upfile']['tmp_name'])) {
      $tempfile = $_FILES['upfile']['tmp_name'];
      // 同フォルダに格納（データを取得後は削除）
      $filename = './' . $_FILES['upfile']['name'];
      //一字ファイルができているか（アップロードされているか）チェック
      if (is_uploaded_file($_FILES['upfile']['tmp_name'])) {
         // ファイルのアップロード（同じディレクトリ）
         $upload_file = move_uploaded_file($_FILES['upfile']['tmp_name'], "./" . $_FILES['upfile']['name']);
         $f = fopen($filename, "r");
         // csvファイルの行数
         $row_count =  sizeof(file($filename));
         // CSVファイルの列数
         $Count_data = count(fgetcsv($f));
         $shainDB_Array = $_SESSION['cv_con'];
         $shainDB_Array2 = $_SESSION['csv_con2'];
         $shainDB_Array3 = $_SESSION['csv_con2'];
         // カラム取得配列
         $csv_array = $_SESSION['csv_col'];
         $Column_array = $_SESSION['csv_col'];
         $Check_array = $_SESSION['csv_col'];
         $CSV_Column_hikaku = array();
         $SQL_Create_Array = array();

         $rr = array();
         $bb = array();

         // CSVデータ加工
         while ($line = fgetcsv($f)) {
            for ($i = 0; $i < count($line); $i++) {
               // 日付の変換（日付カラムの加工）/ -> -に加工
               // DBの社員テーブルのデータとの差異をなくす
               if (preg_match('/^[1-9]{1}[0-9]{0,3}\/[0-9]{1,2}\/[0-9]{1,2}$/', $line[$i])) {
                  // 日付の分割
                  $l = explode("/", $line[$i]);
                  // YYYY/MM/DD → YYYY-MM-DDに変換
                  $line[$i] = $l[0] . '-' . sprintf('%02d', $l[1]) . '-' . sprintf('%02d', $l[2]);
               }
               // 文字コード変換し配列に格納
               array_push($rr, mb_convert_encoding($line[$i], 'UTF-8', 'SJIS-win'));
            }
         }

         // Db配列作成(CSVデータに合わせる)
         foreach ($shainDB_Array2 as $value1) {
            foreach ($Check_array as $value2) {
               array_push($bb, $value1[$value2]);
            }
         }

         $Post_Db = $bb;

         $r = 0;
         // csv配列とDBを比較し差異を調査
         foreach ($rr as $key => $value) {
            if ($r % $Count_data == 0) {
               // CSV配列のIDがDB配列に存在する場合
               // 判定変数をtrueにする
               if (in_array($value, $bb)) {
                  $judge = true;
                  // 社員IDを格納
                  $Shain_ID = $value;
               } else {
                  $judge = false;
               }
            }

            // 判定変数judgeがtrueの時のみ差異のあったインデックスをkeyに格納、
            // valueに差異の値と社員IDを格納
            if ($judge) {
               if ($value != $bb[$key]) {
                  $ttt[$key] =  $value . '"SpliT"' . $Shain_ID;
                  $Denote_sabun[$key] =  $value;
               }
            }
            $r++;
         }

         $_SESSION['sabun'] = $Denote_sabun;
         $_SESSION['post_DB'] = $Post_Db;
         header("Location: ../Shain_kanri.php");
      }
   }
}




/* 
	アクセス権限処理
*/

// アクセス権限更新処理
if (isset($_POST['Ac_up_button'])) {
   $r =  $_POST['access'];
   $access_ar = array();
   foreach ($r as $d) {
      if (!empty($d)) {
         $a_damy = explode("_", $d);
         $access_ar = $access_ar + array($a_damy[0] => $a_damy[1]);
      }
   }

   // 権限更新
   foreach ($access_ar as $key => $value) {
      $Jhoken = "ID = " . $key;
      $SQL_Colums = "Shain_kanri_kengen =" . $value;
      $Henko_P->Update_SQL_process("hdr_shain_master", $SQL_Colums, $Jhoken, $Page_Instant, $Sql_Change);
   }
   header("Location: ../Shain_kanri.php");
}



/************************************
　　　　　　変更ログページ処理
 *************************************/
if (!empty($_GET["henko_log_del"])) {
   $Henko_ID = $_GET["henko_log_del"];
   $Jhoken = "ID=" . $Henko_ID . "";
   $SQL_Colums = "ronri_delete = 1";
   $Henko_P->Update_SQL_process("mst_henko_log", $SQL_Colums, $Jhoken, $Page_Instant, $Sql_Change);
   header("Location: ../Henko_Log.php");
}

// 検索ボタン押下
if (isset($_POST['henko_search'])) {
   //session_start();
   $Henko_Search = array();
   $Check_search = $_POST['Henko_Search'];
   foreach ($Check_search as $key => $value) {
      if (!empty($value)) {
         $Henko_Search = $Henko_Search + array($key => $value);
      }
   }


   $Henko_Af = Search_array_create($Henko_Search);

   if (!empty($Henko_Af)) {

      $Henko_Count = $Page_Instant->Countedtable($Sql_Change->Selct_henkan_jhoken("SELECT COUNT(*) ", " mst_henko_log WHERE ronri_delete = 0 AND ", $Henko_Af));
      $Henko_Arrays = $Page_Instant->sqlcreate($Sql_Change->Selct_henkan_jhoken("SELECT * ", " mst_henko_log WHERE ronri_delete = 0 AND ", $Henko_Af));

      $_SESSION['hen_log_co'] = $Henko_Count;
      $_SESSION['hen_log_array'] = $Henko_Arrays;
   }

   header("Location: ../Henko_Log.php");
}


/************************************
　　　　　　共通処理
 *************************************/
// ログアウト処理
if (!empty($_GET['LogOFF'])) {
   @session_destroy();
   header("Location: http://○○");
}


/************************************

　　　　　　データベース処理

 *************************************/

// DBのSQL発行
try {
   // DBへ接続
   $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');

   if (strpos($server_url, 'kokyaku_kanri') !== false) {
      // 顧客詳細画面（Read_Client.php）
      // 検索時担当者名を選択したとき
      // Select_Db_Conect($Client_KanriID,$Client_IDName,$Client_kousin_id,$FLAG);
      $Yubin_Tanto = $Henko_P->Henko_todoke_shori("SELECT daihyo_Name_furigna_kojin_FM", "hdr_client_mastar", "ORDER  BY  daihyo_Name_furigna_kojin_FM  ASC", $Page_Instant, $Sql_Change);
      $Yubin_sohu_Tanto = $Henko_P->Henko_todoke_shori("SELECT yubin_tanto", "hdr_client_mastar", "ORDER  BY  daihyo_Name_furigna_kojin_FM  ASC", $Page_Instant, $Sql_Change);
      $Fukutan = $Henko_P->Henko_todoke_shori("SELECT distinct Jishatanto", "hdr_client_mastar", ' WHERE Jishatanto <> "" ', $Page_Instant, $Sql_Change);
      $Tantosha_busho = $Henko_P->Henko_todoke_shori("SELECT distinct KansaTanto_Buka_Name", "hdr_client_mastar", ' WHERE KansaTanto_Buka_Name <> "" ', $Page_Instant, $Sql_Change);
      $Fukutan_busho = $Henko_P->Henko_todoke_shori("SELECT distinct Jishatanto_Bu_4Ser", "hdr_client_mastar", ' WHERE Jishatanto_Bu_4Ser <> "" ', $Page_Instant, $Sql_Change);
      $Kanyo_Zeirishi = $Henko_P->Henko_todoke_shori("SELECT distinct Kanyozeirishi_Name", "hdr_client_mastar", ' WHERE Kanyozeirishi_Name <> "" ', $Page_Instant, $Sql_Change);
      $Zaimu_system = $Henko_P->Henko_todoke_shori("SELECT distinct Zaimu_Kihon_System_Name", "hdr_client_mastar", ' WHERE Zaimu_Kihon_System_Name <> "" ', $Page_Instant, $Sql_Change);
      $Zeimusho_Name = $Henko_P->Henko_todoke_shori("SELECT distinct zeimusho", "hdr_client_mastar", ' WHERE zeimusho <> "" ', $Page_Instant, $Sql_Change);
      $Gyusyumoku = $Henko_P->Henko_todoke_shori("SELECT distinct gyosyumoku", "hdr_client_mastar", ' WHERE gyosyumoku <> "" ', $Page_Instant, $Sql_Change);
   } else if (strpos($server_url, 'Henko_todoke') !== false) {
      //変更届ページでの処理 
      //session_start();
      // Placeholderを生成
      $henko_placeholder = $Henko_P->Henko_todoke_shori("SELECT *", "hdr_client_mastar", "WHERE ID=" . $_SESSION['Client_ID'], $Page_Instant, $Sql_Change);
      // 社員の呼び出し
      $Select_Column = "SELECT shain.shimei_sei,shain.yakushoku_id,shain.ka_ID,shain.bu_ID,yakushoku.yakushokumei,ka.ID,ka.kamei,bu.ID,bu.bumei";
      $Join_Table = " hdr_shain_master AS shain
						LEFT JOIN mst_yakushoku AS yakushoku
						ON
						shain.yakushoku_id = yakushoku.ID
						LEFT JOIN mst_ka AS ka
						ON
						shain.ka_ID = ka.ID
						LEFT JOIN mst_bu AS bu
						ON
						shain.bu_ID = bu.ID";
      $Jhoken = " ORDER BY shain.yakushoku_id < 1, shain.yakushoku_id ASC";
      $Shain_Call = $Henko_P->Henko_todoke_shori($Select_Column, $Join_Table, $Jhoken, $Page_Instant, $Sql_Change);
   } else if (strpos($server_url, 'Shain_kanri') !== false) {
      if (empty($Shain_ID)) {
         // 社員管理画面
         //session_start();
         // 社員の呼び出し
         $Select_Column = "SELECT *";

         $Join_Column_ON_yaku = " hdr_shain_master AS shain
                                 LEFT JOIN  mst_ido_rireki AS re
                                 ON
                                 shain.ID = re.shain_ID
                                 ";

         // 検索判定変数
         $_SESSION['Search_Judge'] = '';
         // 結合テーブル作成
         $Join_Table = $Join_Column_ON;
         // WHERE 条件作成 
         $Jhoken = " WHERE shain.ID <> 1 AND shain.ronri_delete = 0 ";
         $Jhoken_taisha = ' WHERE shain.ronri_delete = 0 AND shain.taisha_nengapi = "0000-00-00"';
         
         // アクセス権限用
         $Access_Shanin = $Henko_P->Henko_todoke_shori($Select_Column, $Join_Column_ON, $Jhoken, $Page_Instant, $Sql_Change);

         // 最終社員番号取得
         $Join_Table = $Join_Column_ON;
         $Shain_Call_kanri02 = $Henko_P->Henko_todoke_shori($Select_Column, $Join_Column_ON, " ORDER BY shain.ID ASC", $Page_Instant, $Sql_Change);
         $Search_keka = $Henko_P->Henko_todoke_shori($Select_Column, $Join_Column_ON, $Jhoken_taisha, $Page_Instant, $Sql_Change);
         $LAST_shainID = $Henko_P->Henko_todoke_shori("SELECT ID,ronri_delete", "hdr_shain_master", " ORDER BY ID ASC", $Page_Instant, $Sql_Change);
         $yakushoku_Rireki =  $Henko_P->Henko_todoke_shori($Select_Column, $Join_Column_ON_yaku, " ORDER BY shain.ID ASC", $Page_Instant, $Sql_Change);
         $Shain_write_yo_column =  $Henko_P->Column_Get('show full columns', "hdr_shain_master", '', $Page_Instant, $Sql_Change);
         $Shain_write_yo_column02 =  $Henko_P->Column_Get02('show full columns', "hdr_shain_master", '', $Page_Instant, $Sql_Change);
         $Shain_write_yo_con =  $Henko_P->SELECT_Get($Select_Column, "hdr_shain_master", '', $Page_Instant, $Sql_Change);
         $Shain_hikaku_csv =  $Henko_P->SELECT_Get($Select_Column, "hdr_shain_master", '', $Page_Instant, $Sql_Change);
         $Shain_hikaku_csv2 =  $Henko_P->SELECT_Get2($Select_Column, "hdr_shain_master", '', $Page_Instant, $Sql_Change);
         $IDo_Rireki =  $Henko_P->SELECT_Get2($Select_Column, "mst_ido_rireki", '', $Page_Instant, $Sql_Change);
      }
   } else if (strpos($server_url, 'Henko_Log') !== false) {
      /*
			変更ログページ出の処理 
		*/
      //session_start();
      // プロセス名
      $Select_Column = "SELECT *";
      // 結合テーブル作成
      $Join_Table = "mst_henko_log";
      // WHERE 条件作成 
      $Jhoken = " WHERE ronri_delete = 0";
      $Henko_Count = $Page_Instant->Countedtable($Sql_Change->Selct_henkan_jhoken("SELECT COUNT(*) ", $Join_Table, $Jhoken));
      $Henko_Arrays = $Page_Instant->sqlcreate($Sql_Change->Selct_henkan_jhoken($Select_Column, $Join_Table, $Jhoken));
   } else 	if (strpos($server_url, 'Read_Client') !== false) {
      $Select_Column = "SELECT *";
      $Select_Count = "SELECT COUNT(*)";

      // クライアントID取得
      $PKey = $_SESSION['Client_ID'] = $_GET['ID'];
      if (empty($_SESSION['hikaku'])) {

         // 結合テーブル作成
         $Join_Table = "dtl_client_rireki_master";

         // WHERE 条件作成 
         $Jhoken = " WHERE Client_Master_ID =" . $PKey . " AND ronri_delete = 0";
         $sql_ex_client_hikaku = $Page_Instant->sqlcreate_tujyo($Sql_Change->Selct_henkan_jhoken($Select_Column, $Join_Table, $Jhoken));
         $sql_ex_client_syuturyoku = $Page_Instant->sqlcreate_tujyo($Sql_Change->Selct_henkan_jhoken($Select_Column, $Join_Table, $Jhoken));

         // カウント用
         $Count_Youso = $Page_Instant->sqlcreate_tujyo($Sql_Change->Selct_henkan_jhoken($Select_Count, $Join_Table, $Jhoken));
         $Last_No = $Count_Youso->fetchColumn();
      } else {
         // 検索ボタンを押下したときのセッションの破棄
         unset($_SESSION['hikaku']);
         unset($_SESSION['syuturyoku']);
         unset($_SESSION['Last_No']);
      }

      // 会社情報出力用
      $Jhoken02 = "WHERE ID =" . $PKey . "";
      $sql_ex_client = $Page_Instant->sqlcreate_tujyo($Sql_Change->Selct_henkan_jhoken($Select_Column, 'hdr_client_mastar', $Jhoken02));
      $Join_Table = " dtl_client_rireki_master as rireki
						LEFT JOIN mst_link_create AS file
						ON file.rireki_ID = rireki.ID 
						AND
						file.koshin_ID = rireki.kousin_id 
						AND
						file.Client_ID = rireki.Client_Master_ID ";
      $Jhoken03 = "WHERE rireki.Client_Master_ID =" . $PKey . " AND file.ronri_delete = 0";
      $Jhoken04 = "WHERE rireki.Client_Master_ID =" . $PKey . " AND file.ronri_delete = 1";
      $FilePath_joinscall = $Henko_P->Henko_todoke_shori($Select_Column, $Join_Table, $Jhoken03, $Page_Instant, $Sql_Change);
      $FilePath_sakujyo = $Henko_P->Henko_todoke_shori($Select_Column, $Join_Table, $Jhoken04, $Page_Instant, $Sql_Change);
      $Tantosha = $Henko_P->Henko_todoke_shori("SELECT * ", "hdr_shain_master", '', $Page_Instant, $Sql_Change);
      $Fukutan = $Henko_P->Henko_todoke_shori("SELECT distinct Jishatanto", "hdr_client_mastar", ' WHERE Jishatanto <> "" ', $Page_Instant, $Sql_Change);
      $Tantosha_busho = $Henko_P->Henko_todoke_shori("SELECT * ", "mst_bu", '', $Page_Instant, $Sql_Change);
      $Fukutan_busho =  $Henko_P->Henko_todoke_shori("SELECT * ", "mst_bu", '', $Page_Instant, $Sql_Change);
      $Kanyo_Zeirishi = $Henko_P->Henko_todoke_shori("SELECT distinct Kanyozeirishi_Name", "hdr_client_mastar", ' WHERE Kanyozeirishi_Name <> "" ', $Page_Instant, $Sql_Change);
      $Zaimu_system = $Henko_P->Henko_todoke_shori("SELECT distinct Zaimu_Kihon_System_Name", "hdr_client_mastar", ' WHERE Zaimu_Kihon_System_Name <> "" ', $Page_Instant, $Sql_Change);
      $Zeimusho_Name = $Henko_P->Henko_todoke_shori("SELECT distinct zeimusho", "hdr_client_mastar", ' WHERE zeimusho <> "" ', $Page_Instant, $Sql_Change);
      $Gyosyumoku = $Henko_P->Henko_todoke_shori("SELECT distinct gyosyumoku", "hdr_client_mastar", ' WHERE gyosyumoku <> "" ', $Page_Instant, $Sql_Change);
   } else if (strpos($server_url, 'New_Regi') !== false) {
      // 新規登録画面処理
      $mac_db_sql_client = "SHOW TABLE STATUS LIKE 'hdr_client_mastar'";
      $sql_ex_client_ID = $mac_db_host->query($mac_db_sql_client);
   } else if (strpos($server_url, 'Month_Calender.') !== false) {
      //session_start();
      // プロセス名
      $Select_Column = "SELECT *";
      // 結合テーブル作成
      $Join_Table = "hdr_shain_master";
      // WHERE 条件作成 
      $Jhoken = "";
      $Scejyule_Member = $Henko_P->Henko_todoke_shori($Select_Column, $Join_Table, $Jhoken, $Page_Instant, $Sql_Change);
      // プロセス名
      $Select_Column = "SELECT COLUMN_NAME";
      // 結合テーブル作成
      $Join_Table = "INFORMATION_SCHEMA.COLUMNS";
      // WHERE 条件作成 
      $Jhoken = "WHERE TABLE_NAME = 'mst_calendr' ";
      $Calender_Column = $Henko_P->Henko_todoke_shori($Select_Column, $Join_Table, $Jhoken, $Page_Instant, $Sql_Change);
   } else if (strpos($server_url, 'search_kekka.') !== false) {
      if (empty($SQL)) {
         unset($_SESSION['Category']);
         $Counted_No = $Page_Instant->Countedtable($Sql_Change->Selct_henkan_jhoken("SELECT COUNT(*) ", " hdr_client_mastar ", ""));
         $Create_sql = $Page_Instant->sqlcreate($Sql_Change->Selct_henkan_jhoken("SELECT * ", " hdr_client_mastar ", ""));
         $Create_sql_NO = $Page_Instant->sqlcreate_No($Sql_Change->Selct_henkan_jhoken("SELECT * ", " hdr_client_mastar ", ""));
      }
   }
} catch (PDOException $e) {
   echo $e->getMessage();
   die();
}

// 接続を閉じる
$dbh = null;

/************************************
　　　　　　各関数処理
 *************************************/


// 検索後の検索条件の保存配列作成
function Search_Memory($Search_Content)
{
   $SMemory_array = array();
   foreach ($Search_Content as $key => $val) {
      array_push($SMemory_array, $val);
   }
   return $SMemory_array;
}

// 検索配列作成関数
function Search_array_create($Search_Post)
{
   $Af_Ch_val = '';

   foreach ($Search_Post as $Key => $Val) {
      if (!empty($Val)) {
         if (strstr($Key, 'date_af_')) {
            $Af_Ch_val .= str_replace('date_af_', '', $Key) . ' > "' . $Val . '" AND ';
         } else if (strstr($Key, 'date_bf_')) {
            $Af_Ch_val .= str_replace('date_bf_', '', $Key) . ' < "' . $Val . '" AND ';
         } else if (strstr($Key, 'equal_')) {
            $Af_Ch_val .= str_replace('equal_', '', $Key) . ' = ' . $Val . ' AND ';
         } else {
            $Af_Ch_val .= $Key . ' LIKE "%' . $Val . '%" AND ';
         }
      }
   }
   $Af_Ch_val = substr($Af_Ch_val, 0, -5);
   return $Af_Ch_val;
}

/************************************
　　　　　　　クラス処理
 *************************************/

// ページネーションクラス
class Pagenation
{
   public $row = 20;
   // 発行SQLのレコード数
   function Countedtable($sql)
   {

      $row_count = $this->row;
      $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');

      $sth = $mac_db_host->query($sql);
      $count = $sth->fetch(PDO::FETCH_COLUMN);
      $pageing = new Paging();
      $pageing->count = $row_count;
      $pageing->setHtml($count);
      return $pageing;
   }

   // SQLの発行(ページネーション)
   function sqlcreate($sql)
   {
      $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');

      $row_count = $this->row;
      //現在のページを取得 存在しない場合は1とする
      $page = 1;
      if (isset($_GET['page']) && is_numeric($_GET['page'])) {
         $page = (int)$_GET['page'];
      }
      if (!$page) {
         $page = 1;
      }

      //$pageの数から件数分を表示するSQLクエリを生成 配列で取得
      $sql .= " ORDER  BY  ID  ASC  LIMIT  " . (($page - 1) * $row_count) . ", " . $row_count;
      $sth = $mac_db_host->query($sql);
      $aryPref = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $aryPref;
   }

   // SQLの発行(ページネーション)
   function sqlcreate_No($sql)
   {
      $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');

      $row_count = $this->row;
      //現在のページを取得 存在しない場合は1とする
      $page = 1;
      if (isset($_GET['page']) && is_numeric($_GET['page'])) {
         $page = (int)$_GET['page'];
      }
      if (!$page) {
         $page = 1;
      }

      //$pageの数から件数分を表示するSQLクエリを生成 配列で取得
      $sth = $mac_db_host->query($sql);
      $aryPref = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $aryPref;
   }



   // SQLの発行（通常）
   function sqlcreate_tujyo($sql)
   {
      $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');
      $SQL_ar = $mac_db_host->query($sql);
      return $SQL_ar;
   }

   // 検索結果用(SESSION格納用)
   function sqlcreate_tujyo02($sql)
   {
      $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');
      $SQL_ar = $mac_db_host->query($sql);
      if ($SQL_ar->execute()) {
         return $SQL_ar->fetchAll();
      } else {
         return $SQL_ar;
      }
   }

   function sqlcreate_tujyo03($sql)
   {
      $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');
      $SQL_ar = $mac_db_host->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      return $SQL_ar;
   }

   function sqlcreate_tujyo04($sql)
   {
      $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');
      $SQL_ar = $mac_db_host->query($sql)->fetchAll(PDO::FETCH_COLUMN);
      return $SQL_ar;
   }

   function sqlcreate_tujyo05($sql)
   {
      $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');
      $SQL_ar = $mac_db_host->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      return $SQL_ar;
   }

   function Get_Incriment($sql)
   {
      $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');

      $SQL_ar = $mac_db_host->query($sql);
      foreach ($SQL_ar as $key => $value) {
         $ai_num = $value['Auto_increment'];
      }

      return $ai_num;
   }

   // 検索カウント用(SESSION格納用)
   function sqlcreate_count($sql)
   {
      $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');
      $SQL_ar = $mac_db_host->query($sql);
      $count = $SQL_ar->rowCount();
      return $count;
   }
}

// SQLに変換
class SQL_henkan
{
   function Selct_henkan($Colum_Name, $Table_Name)
   {
      return "" . $Colum_Name . " " . "FROM" . " " . $Table_Name . "";
   }

   // 条件付き
   function Selct_henkan_jhoken($Colum_Name, $Table_Name, $Where)
   {
      return "" . $Colum_Name . " " . "FROM" . " " . $Table_Name . " " . $Where . "";
   }

   function Update_henkan_jhoken($process, $Table_Name, $Where)
   {
      return "UPDATE " . $Table_Name . " " . "SET" . " " . $process . " WHERE " . $Where . "";
   }

   function Insert_henkan_jhoken($Table_Name, $Column_Name, $Naiyo)
   {
      return "INSERT INTO " . $Table_Name . " " . $Column_Name . ") VALUES (" . $Naiyo . ")";
   }

   function A_incle_henkan($Table_Name)
   {
      return "SHOW TABLE STATUS LIKE '" . $Table_Name . "'";
   }
}

// SQLの処理
class SQL_Shori
{
   // SELET処理
   function Henko_todoke_shori($Column_Name, $Table_Name, $Jyoken, $Create_Sql, $Sql_Change)
   {
      $sql = $Sql_Change->Selct_henkan_jhoken($Column_Name, $Table_Name, $Jyoken);
      return  $Create_Sql->sqlcreate_tujyo($sql);
   }

   // 検索結果用(SESSION格納用)
   function SELECT_todoke_shori($Column_Name, $Table_Name, $Jyoken, $Create_Sql, $Sql_Change)
   {
      $sql = $Sql_Change->Selct_henkan_jhoken($Column_Name, $Table_Name, $Jyoken);
      return  $Create_Sql->sqlcreate_tujyo02($sql);
   }

   // 検索結果用(SESSION格納用)
   function SELECT_Get($Column_Name, $Table_Name, $Jyoken, $Create_Sql, $Sql_Change)
   {
      $sql = $Sql_Change->Selct_henkan_jhoken($Column_Name, $Table_Name, $Jyoken);
      return  $Create_Sql->sqlcreate_tujyo03($sql);
   }

   function Column_Get($Column_Name, $Table_Name, $Jyoken, $Create_Sql, $Sql_Change)
   {
      $sql = $Sql_Change->Selct_henkan_jhoken($Column_Name, $Table_Name, $Jyoken);
      return  $Create_Sql->sqlcreate_tujyo04($sql);
   }

   function Column_Get02($Column_Name, $Table_Name, $Jyoken, $Create_Sql, $Sql_Change)
   {
      $sql = $Sql_Change->Selct_henkan_jhoken($Column_Name, $Table_Name, $Jyoken);
      return  $Create_Sql->sqlcreate_tujyo05($sql);
   }

   // 検索結果用(SESSION格納用)
   function SELECT_Get2($Column_Name, $Table_Name, $Jyoken, $Create_Sql, $Sql_Change)
   {
      $sql = $Sql_Change->Selct_henkan_jhoken($Column_Name, $Table_Name, $Jyoken);
      return  $Create_Sql->sqlcreate_tujyo05($sql);
   }

   // 検索件数処理
   function SELECT_count_shori($Column_Name, $Table_Name, $Jyoken, $Create_Sql, $Sql_Change)
   {
      $sql = $Sql_Change->Selct_henkan_jhoken($Column_Name, $Table_Name, $Jyoken);
      return  $Create_Sql->sqlcreate_count($sql);
   }

   // 更新作業用
   function Update_SQL_process($Table_Name, $process, $Jyoken, $Create_Sql, $Sql_Change)
   {
      $sql = $Sql_Change->Update_henkan_jhoken($process, $Table_Name, $Jyoken);
      return  $Create_Sql->sqlcreate_tujyo($sql);
   }

   // INSERT作成
   function Insert_SQL_process($Table_Name, $Column_name, $Column_con, $Create_Sql, $Sql_Change)
   {
      $sql = $Sql_Change->Insert_henkan_jhoken($Table_Name, $Column_name, $Column_con);
      $Create_Sql->sqlcreate_tujyo($sql);
   }

   // Autoincrement取得
   function A_incle_SQL_process($Table_Name, $Create_Sql, $Sql_Change)
   {
      $sql = $Sql_Change->A_incle_henkan($Table_Name);
      return $Create_Sql->Get_Incriment($sql);
   }
}


// ファイルのアップデート時のファイル操作
function Filepath_syuturyoku($GET_ID, $cID)
{
   global $Henko_P, $Page_Instant, $Sql_Change;
   $File_Path = array();
   $rireki_columns = "SELECT *";
   $rireki_Table = " dtl_client_rireki_master as rireki
                      LEFT JOIN mst_link_create AS file
                      ON file.rireki_ID = rireki.ID 
                      AND
                      file.koshin_ID = rireki.kousin_id 
                      AND
                      file.Client_ID = rireki.Client_Master_ID";
   $rirekiJhoken = " WHERE rireki.ID =" . $GET_ID . " AND rireki.Client_Master_ID = " . $cID . " AND file.ronri_delete = 0";
   $rireki_joinscall = $Henko_P->Henko_todoke_shori($rireki_columns, $rireki_Table, $rirekiJhoken, $Page_Instant, $Sql_Change);

   return $rireki_joinscall;
}


// 顧客フォルダの作成
function Folda_Operate($Client_Name)
{
   $directory_path = '../../Image_dir/' . $Client_Name . '/';

   // 顧客フォルダが存在しない時にフォルダ作成
   if (!file_exists($directory_path)) {
      //存在しないときの処理
      mkdir($directory_path, 0777);
   }

   return $directory_path;
}

// ファイルのアップロード
function File_Uploader($Folda_Path, $column, $sql_con, $table_name, $Page_Instant, $Sql_Change, $Henko_P)
{
   // アップロードされたファイル件を処理
   for ($i = 0; $i < count($_FILES["fname"]["name"]); $i++) {
      // アップロードされたファイルか検査
      if (is_uploaded_file($_FILES["fname"]["tmp_name"][$i])) {
         $Client_File_Path = $Folda_Path . $_FILES["fname"]["name"][$i];

         $Henko_P->Insert_SQL_process($table_name, $column, $sql_con . ",'" . $Client_File_Path . "'", $Page_Instant, $Sql_Change);
         // ファイルをお好みの場所に移動
         move_uploaded_file($_FILES["fname"]["tmp_name"][$i], $Client_File_Path);
      }
   }
}

// エスケープ処理
function Validation_Replace($post_str)
{
   $Replacestr = $post_str;
   if (strpos($post_str, '\'') !== false) {
      $Replacestr = str_replace('\'', '&#39;', $post_str);
   }
   if (strpos($post_str, '\"') !== false) {
      $Replacestr = str_replace('\"', '&quot;;', $post_str);
   }

   return $Replacestr;
}


// 検索用SQL作成(条件)
function createsql_val($Value_array, $condition_array, $cnt, $soshiki_val)
{

   $Af_Ch_val = '';
   $i = 0;
   if (!empty($Value_array)) {
      foreach ($Value_array as $key => $value) {
         if ($key == 'shain.ID') {
            $Af_Ch_val .=  $key . '=' . $value . ' AND ';
         } else if (strstr($key, 'equal_')) {
            if (!empty($condition_array)) {
               foreach ($condition_array as $key2 => $value2) {
                  // 配列の要素数の倍数で処理
                  if ($i == 0 || $i % $cnt == 0) {
                     $key_rep = str_replace('equal_', '', preg_replace("/\d+/", "", $key));
                     // 退職日が0000-00-00のレコードは除外
                     if ($key_rep == 'taisha_nengapi') {
                        $Af_Ch_val .= $key_rep . ' ' . $value2 . ' "' . $value . '" AND ' . $key_rep . ' <> ' . '0000-00-00 AND ';
                     } else {
                        $Af_Ch_val .= $key_rep . ' ' . $value2 . ' "' . $value . '" AND ';
                     }
                  }
                  $i = $i + 1;
               }
            } else {
               $key_rep = str_replace('equal_', '', preg_replace("/\d+/", "", $key));
               if ($key_rep == 'buka_name') {
                  $val = explode("@", $value);
                  $Af_Ch_val .= 'bu_ID = ' . $val[0] . ' AND ' . 'ka_ID = ' . $val[1] . ' AND ';
               } else {
                  $Af_Ch_val .= str_replace('equal_', '', preg_replace("/\d+/", "", $key)) . ' = "' . $value . '" AND ';
               }
            }
         } else if ($key == 'sikaku') {
            for ($l = 1; $l <= 5; $l++) {
               if (!empty($value)) {
                  $Af_Ch_val .= $key . $l . ' LIKE "%' . $value . '%" AND ';
               }
            }
         } else {
            $Af_Ch_val .= $key . ' LIKE "%' . $value . '%" AND ';
         }
      }

      if (!empty($soshiki_val)) {
         if (isset($Value_array['taisha_nengapi'])) {
            $Af_Ch_val .= $soshiki_val;
         } else {
            $Af_Ch_val .= $soshiki_val . 'taisha_nengapi = "0000-00-00"  AND ';
         }
      }
   } else {
      if (!empty($soshiki_val)) {
         $Af_Ch_val .= $soshiki_val . 'taisha_nengapi = "0000-00-00"  AND ';
      }
   }

   if (isset($Value_array['taisha_nengapi'])) {
      $Af_Ch_val .= $soshiki_val;
   } else {
      $Af_Ch_val .= $soshiki_val . 'taisha_nengapi = "0000-00-00"  AND ';
   }

   $Af_Ch_val = substr($Af_Ch_val, 0, -5);
   return $Af_Ch_val;
}

// デバッグ用関数
// function debug_method($test)
// {
//    echo ('<pre>');
//    print_r($test);
//    echo ('</pre>');
// }

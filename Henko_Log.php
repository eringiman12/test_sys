<?php
  include_once './function_folda/Page.php';
  include_once './function_folda/function_DB_conect.php';
  include_once './function_folda/function.php';
  if(!empty($_SESSION['hen_log_co']) && !empty($_SESSION['hen_log_array'])) {
    $Henko_Count = $_SESSION['hen_log_co'];
    $Henko_Arrays = $_SESSION['hen_log_array'];
    unset($_SESSION['hen_log_co']);
    unset($_SESSION['hen_log_array']);
  } 
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./asset/css/Henko_Log.css">
        <link rel="stylesheet" href="./asset/css/header.css">
        <link rel="stylesheet" href="./asset/css/paging/paging.css">
    <script type="text/javascript" src="./asset/js/main.js"></script>
    <script type="text/javascript" src="./asset/js/real_time.js"></script>
    <title>顧客管理システム</title>
  </head>
  <header>
    <div class="container">
      <ul class="menu">
        <div class="mokuji">
          <h1 class="jisha"><a href="./index.php">MacDB</a></h1>
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
    <div class="henko_log_Search">
      <table class="Search_Table">
        <tr>
          <th>管理ページ</th>
          <th>フォーム名</th>
          <th>変更タイトル</th>
          <th>変更前</th>
          <th>変更後</th>
          <th>登録者</th>
          <th>変更時間</th>
        </tr>
        <tr>
          <form action="./function_folda/function_DB_conect.php" method="POST">
            <td><input type="text" value="" name="Henko_Search[henko_page]"/></td>
            <td><input type="text" value="" name="Henko_Search[form_name]"/></td>
            <td><input type="text" value="" name="Henko_Search[Column_Name]"/></td>
            <td><input type="text" value="" name="Henko_Search[Koshinnaiyo_Before]"/></td>
            <td><input type="text" value="" name="Henko_Search[Koshinnaiyo_After]"/></td>
            <td><input type="text" value="" name="Henko_Search[Koshinsha]"/></td>
            <td><input type="date" value="" name="Henko_Search[date_af_Koshinjikan]"/></td>
            <button class="henko_search" name="henko_search">検索</button>
          </form>
        </tr>
      </table>

    </div>
    <?php echo $Henko_Count -> html ?>
  <div class="Naiyo_log">
    <table>
      <tr>
        <th>管理ページ</th>
        <th>フォーム名</th>
        <th>変更タイトル</th>
        <th>変更前</th>
        <th>変更後</th>
        <th>登録者</th>
        <th>変更時間</th>
        <th>ステータス</th>
      <tr>
      <?php foreach($Henko_Arrays as $key => $val) {?>
        <form action="./function_folda/function_DB_conect.php" method="POST">
          <tr>
            <td><?php echo $val['henko_page'];?></td>
            <td><?php echo $val['form_name'];?></td>
            <td><?php echo $val['Column_Name'];?></td>
            <td><?php echo $val['Koshinnaiyo_Before'];?></td>
            <td><?php echo $val['Koshinnaiyo_After'];?></td>
            <td><?php echo $val['Koshinsha'];?></td>
            <td><?php echo $val['Koshinjikan'];?></td>
            <td><a  href="./function_folda/function_DB_conect.php?henko_log_del=<?php echo $val['ID'];?>">削除</a></td>
          </tr>
        </form>
      <?php } ?>
    </table>
  </div>
    
  </body>
</html>

<?php
  include_once './function_folda/function.php';
  // include_once './function_folda/function_DB_conect.php';
?>
<!DOCTYPE html>
<html lang="ja">
  <head>発生日時
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./asset/css/header.css">
    <link rel="stylesheet" href="./asset/css/Anken_top.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="./asset/js/real_time.js"></script>
    <script type="text/javascript" src="./asset/js/main.js"></script>
    <title>てｓｔ</title>
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
    <form action="#" name="form1" class="Project_Create_form">
      <div  class="Project_name">
        <p>案件名</p>&nbsp;&nbsp;&nbsp;<input type="text" name="field1" value="" class="Input_L"><br/>
      </div>
      <div  class="Project_time">
        <p>発生日時</p>&nbsp;&nbsp;&nbsp;<input type="text" name="field2" value="" class="Input_S">
      </div>
      <table>
        <tr>
          <th>担当者名</th>
          <th>単価</th>
          <th>数量</th>
          <th>金額</th>
        </tr>
        <tr>
          <td>商品サンプル1</td>
          <td align="right">500円</td>
          <td>
            <select name="goods1" onChange="keisan()">
              <option>0</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </td>
          <td></td>
        </tr>
        <tr>
          <td>商品サンプル2</td>
          <td align="right">1,000円</td>
          <td>
            <select name="goods2" onChange="keisan()">
              <option>0</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </td>
          <td><input type="text" name="field2" size="8" value="0"> 円</td>
        </tr>
        <tr>
          <td>商品サンプル3</td>
          <td align="right">3,000円</td>
          <td>
            <select name="goods3" onChange="keisan()">
              <option>0</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              </select>
            </td>
          <td><input type="text" name="field3" size="8" value="0"> 円</td>
        </tr>
        <tr>
          <td align="right" colspan="3"><strong>合計</strong></td>
          <td><input type="text" name="field_total" size="8" value="0"> 円</td>
        </tr>
      </table>

</form>
  </body>

</html>
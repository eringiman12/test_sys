<?php
session_start();
$File_Name = $_SESSION['File_Name'];
unset($_SESSION['File_Name']);
// 更新前カラム情報
$bf = $_SESSION['up_log'];
foreach ($bf as $val) {
   DBupdate($val);
}
header("Location: ../" . $File_Name . ".php");

// SQL発行
function DBupdate($LOG_VALUES_SQL)
{
   $Log_Column_SQL = "Koshinsha,Table_Name, Column_Name, form_name,henko_page,Koshinnaiyo_Before, Koshinnaiyo_After";
   $SQL = "INSERT INTO 
            mst_henko_log
            (" . $Log_Column_SQL . ")
            VALUES(" . '"' . $_SESSION['shain_Name'] . '",' . $LOG_VALUES_SQL . ")";
   $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○', '');
   echo $SQL;
   $mac_db_host->query($SQL);
}

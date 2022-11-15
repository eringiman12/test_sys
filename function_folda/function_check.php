<?php
    session_start();
    $USER_NAME = $_SESSION['USER_NAME'];
    user_check($USER_NAME);

    function user_check($Check_user) {
        // DBのSQL発行
        try {
            // DBへ接続
            $mac_db_host = new PDO("mysql:host=○○; dbname=○○; charset=utf8", '○○×', '');
            $Check_Judge = "SELECT 
                                user_name,Shain_kanri_kengen
                            FROM 
                                hdr_shain_master
                            WHERE 
                            user_name = '".$Check_user."' AND  	taisha_nengapi = '0000-00-00'";

            $Check_Recod = $mac_db_host->query($Check_Judge);
            foreach ($Check_Recod as $key => $value) {
                if($value['user_name'] == $Check_user) {
                    $Access_num = $value['Shain_kanri_kengen'];
                    $Desknetsusr = $value['user_name'] ;
                    break;
                } 
            }
                

            //  DBにデスクネッツ名とアクセス権が無ければログインできない
            if($Access_num == 1 || $Access_num == 0 && !empty($Desknetsusr)) {
                $_SESSION['access'] = $Access_num;
                $_SESSION['Descnets_name'] = $Desknetsusr;
                header("Location: ../index.php");
            } else {
                session_destroy();
                header("Location: http://○○");
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

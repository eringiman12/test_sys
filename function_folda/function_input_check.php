<?php
 
if (!empty($_GET["user_id"])) {
  $name = $_GET["user_id"];
  echo $name;
}
 

exit;
<?php
   session_start();
   // session_destroy():
   //   銷毀儲存在目前SESSION內的所有資料。
   //   PHPSESSID不會改變
   session_destroy();
   header("Location: login.php");
?>
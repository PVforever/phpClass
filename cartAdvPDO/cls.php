<?php
   // 程式功能: 清空購物車
   session_start();
   session_destroy();
   header("Location: list.php");
?>
<?php
  //偵測瀏覽器是否開啟Cookie
  session_start();
  setcookie('foo', 'bar', time()+3600);
  header("location: result.php");
?>
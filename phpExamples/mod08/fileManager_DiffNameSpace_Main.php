<?php
   namespace com\myapp\util\pkg0;
   use com\myapp\util\pkg1\fileManager;
   require 'fileManager.php';
   fileManager::hello();
   echo "<hr>";
   $fm = new fileManager();
   $fm->helloAgain();
   echo "<hr>";
?>

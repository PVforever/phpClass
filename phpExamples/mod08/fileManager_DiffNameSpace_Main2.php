<?php
   namespace com\myapp\util\pkg0;
   use com\myapp\util\pkg1\fileManager;
   use com\myapp\util\pkg2\file1;
   require 'fileManager.php';
   require 'file1.php';
   fileManager::hello();
   echo "<hr>";
   $fm = new fileManager();
   $fm->helloAgain();
   echo "<hr>";
   echo "<hr>";
   file1::hello();
   echo "<hr>";
   $fi1 = new file1();
   $fi1->helloAgain();
   echo "<hr>";
?>

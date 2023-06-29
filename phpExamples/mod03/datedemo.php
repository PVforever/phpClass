<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>date()函數</title>
  </head>
  <body>
<?php 
 $b = time (); 
 echo '現在時間(1):' . date(" Y-m-d G:i:s", $b) . "<br>";
 echo "現在時間(2):" . date("Y/m/d G:i:s") . "<br>";
 echo "現在時間(3):" . date( " Y M d G:i:s") . "<br>";
 echo "Expires:"   . date(" D, d M Y G:i:s") . "<br>";
  
 ?> 
 </body>
 </html>
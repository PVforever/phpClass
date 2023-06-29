<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>ch04/for02.php</title>
  </head>
  <body>
  <?php               // ch04/for02.php
  $x = 0; $sum=0 ;
  for ( $x = 1; $x <= 10;  $x++ ) {
  	$sum = $sum + $x ;
  }
  echo "1 加到 10 的總和=" . $sum . "<br>";
  ?>
   </body> 
</html>
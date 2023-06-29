<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>練習ex04_01</title>
  </head>
  <body>
    <?php
         $sum = 0 ; 
         for ($x = 1 ; $x <= 1000 ; $x++  ) {
         	if ( $x % 2 == 0) {
         		$sum += $x;
         	}
         }
         echo("1到1000之間，所有偶數的總和= $sum <br>");
    ?>
   </body> 
</html>

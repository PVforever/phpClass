<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>ch04/if04.php</title>
  </head>
  <body>
  <?php
  $num = rand(1, 9) ;
  $mod = $num % 3 ;
  echo "數字num=$num  , 除以3, 餘數=$mod<br>" ;
  if( $mod == 0) {
  	echo "黃色<br>";
  } else if ($mod == 1 ) {
  	echo "綠色<br>";
  } else {
  	echo "紅色<br>";
  }
  ?>
   </body> 
</html>
<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>mod03/variable04.php</title>
  </head>
  <body>
    <?php          // ch03/variable04.php
    	$x  ;      // 變數 $x 沒有初值，會有不正確的結果
    	$y = $x + 1 ; 
    	echo "$x=" .$x . "，  $y=" .$y . "<br>";
	?>
</body> 
</html>
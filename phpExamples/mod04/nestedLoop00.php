<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>ch04/for00.php</title>
  </head>
  <body>
<?php
  for ($x = 1 ; $x <= 3; $x++) {
  	  echo  "x=$x<br>" ;
      for ($p = 1 ; $p <= 5; $p++) {
  	      echo  "&nbsp;&nbsp;p=$p <br>" ;
      }
  }
?>
</body> 
</html>

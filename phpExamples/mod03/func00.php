<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>mod03/operator04.php</title>
  </head>
  <body>
<?php	
echo "<pre>";
echo "round(5.6)        \t= " . round(5.6)        . "\t     傳回 5.6 四捨五入後的值 <br>";      
echo "ceil(9.6)         \t= " . ceil(9.6)         . "\t     傳回大於9.6 的最小整數 <br>";		
echo "floor(2.1)        \t= " . floor(2.1)        . "\t     傳回小於2.1的最大整數 <br>";
echo "rand(1, 50)       \t= " . rand (1, 50)      . "\t     傳回介於1， 50(含)之間的隨機整數    <br>";	      
echo "max(24， 5， 17， 9) \t= " . max(24, 5, 17, 9) . "\t     傳回24, 5, 17, 9中的最大值    <br>";
echo "min(24， 5， 17， 9) \t= " . min(24, 5, 17, 9) . "\t     傳回24, 5, 17, 9中的最小值    <br>";
echo "</pre>";
?>
</body> 
</html>
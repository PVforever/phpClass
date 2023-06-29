<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>mod05/array2D00.php</title>
</head>
<body>
<?php
  $x = array(
         array(11, 99, 28, 66, 5),  // [0][0]  [0][1]  [0][2]  [0][3]  [0][4]       
         array(45, 18, 25),         // [1][0]  [1][1]  [1][2]     
         array(60, 41),  			// [2][0]  [2][1]  
                
       ) ; 
   echo "<h3>每列的元素個數不相同</h3>";
   echo "<hr>";
   // 橫向相加
   for($a = 0; $a < count ( $x ); $a ++) {
       $sum = 0;
   	   for($t = 0; $t < count ( $x [$a] ); $t ++) {
   		  $sum += $x [$a] [$t];
   	   }
       echo "第" . ($a+1) . "橫列的和=$sum<br>";
   }
   echo "<hr>";
   // 先計算一維陣列之元素個數的最大值，這樣才知道要加總幾個直行。
   $max  = 0; 
   for($t = 0; $t < count($x); $t ++) {
   	   if (count($x[$t]) > $max){
   	   	  $max = count($x[$t]);
   	   }
   }     
   // 縱向相加
   for($a = 0; $a < $max ; $a ++) {
   	$sum = 0;   
   	for($t = 0; $t < count($x); $t ++) {
   		if (isset($x [$t] [$a])){   // 如果此元素存在
   		    $sum += $x [$t] [$a];
   		}
   	}   
   		echo "第" . ($a+1)   . "直行的和==$sum<br>";
   }
?>
</body>
</html>

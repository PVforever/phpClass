<!DOCTYPE html>
<?php
   function MySub() {
      return "函數測試";
   }
   function sumNum($n) {
   	  $sum = 0 ;
   	  for ($x=1; $x<=$n; $x++){
   	  	$sum += $x;
   	  }
      return $sum;
   }
?>
<html>
<head>
<meta charset='utf-8'>
<title>ch04/udf00.php</title>
</head>
<body>
<?php
   echo MySub() . "<br>";
   
   echo "1 + 2 + 3 +...+ 10=" . sumNum(10);
?>
</body>
</html>

<!DOCTYPE html>
<?php
   function MySub($x) {
      echo $x*$x;
   }
   function YourSub($x, $y) {
      echo ($x * $y);
   }
?>
<html>
<head>
<meta charset='utf-8'>
<title>ch04/udf01.php</title>
</head>
<body>
<?php
   echo MySub(5) . "<br>";
   
   echo YourSub(10, 3);
?>
</body>
</html>

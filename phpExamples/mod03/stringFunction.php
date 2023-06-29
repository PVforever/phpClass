<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
</head>
<body>
<?php
	$str1 = " 捐捐  ";
	echo "字串str1使用位元組的個數: " . strlen($str1) . "<br>";
	echo "str1的字元個數: " . mb_strlen($str1, "UTF-8") . "<br>";
	$str2 = chr(65); 
	echo "str2=$str2<br>";
?>
</body>
</html>


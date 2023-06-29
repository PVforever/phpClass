<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>ch04/while00.php</title>
</head>
<body>
<?php
$x = 1; $sum=0 ;
while ( $x <= 10 ) {
	$sum = $sum + $x ;
	$x++;
}
echo "1 加到 10 的總和=" . $sum . "<br>";
?>
</body>
</html>

<!DOCTYPE html>
<?php
function MyTest($num) {
	$ans = 1;
	for($x = 1; $x <= $num; $x ++) {
		$ans = $ans * $x;
	}
	return $ans;
}

?>
<html>
<head>
<meta charset='utf-8'>
<title>ch04/udf02.php</title>
</head>
<body>
<?php
echo "10的階乘為" . MyTest ( 10 ) . "<br>";
?>
</body>
</html>

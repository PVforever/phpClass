<?php
session_start();
?>
<!DOCTYPE html>
<html> 
<head>
<meta charset='utf-8'>
<title><?php echo SYSTEM_NAME; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php 
session_unset();
echo '執行session_unset()後, $_SESSION內有'. count($_SESSION) .'個元素<br>';

$cnt=0;
foreach($_SESSION as $k => $v){
	echo "$k => $v <br>";
	$cnt++;
}

echo "共$cnt 個元素<br>";
?> 
</body>
</html>
<?php
//session_destroy()會清除session變數，但是只對
//其它頁有效。因此$_SESSION陣列內元素的值在本頁仍
//然可用，不過其它頁就不能再使用$_SESSION陣列內元素
//
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
<b>
session_destroy()會清除session變數，但是只對其它頁有效。
因此$_SESSION陣列內元素的值在本頁仍然可用，不過其它頁就不能再使用
$_SESSION陣列內元素
</b>
<p/>
<?php 

echo '現在執行session_destroy()<br>';
session_destroy();
echo '<p>';
echo '執行session_destroy()後, $_SESSION陣列的元素個數='. count($_SESSION) .'<br>';
echo '<p>';
echo '印出 $_SESSION陣列內的所有元素:<br>';
$cnt=0;
foreach($_SESSION as $k => $v){
	echo "$k => $v <br>";
	$cnt++;
}
echo "共$cnt 個元素<br>";
echo "<hr>";
?>

<a href='AnotherPage.php'>
       按這裡來啟動AnotherPage.php，在此頁內觀察session變數
</a> <br/>
</body>
</html>
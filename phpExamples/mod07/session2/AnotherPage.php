<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Insert title here</title>
</head>
<body>

<?php
echo '於前一頁執行有關刪除Session資料的函數後(如session_destroy(), session_unset(),本頁 $_SESSION陣列有下列元素: <br>';
$cnt=0;
foreach($_SESSION as $k => $v){
	echo "$k => $v <br>";
	$cnt++;
}
echo "共$cnt 個元素<br>";
?>

<p>
<a href='SessionMain.php'>
       回到SessionMain.php
</a> <br/>
</body>
</html>

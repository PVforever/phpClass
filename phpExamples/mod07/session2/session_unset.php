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
$_SESSION['customer'] = 'Kitty' ;
$_SESSION['address1'] = 'Taipei' ;
$_SESSION['address2'] = 'Taichung' ;
echo '$_SESSION陣列的元素個數=' . count($_SESSION) . "<br>";
unset($_SESSION['address4']);   // 釋放 $_SESSION['address4'] 
echo 'unset($_SESSION["address4"])之後，SESSION陣列的元素個數=' . count($_SESSION) . "<br>";
echo "<hr>";
session_unset();   
echo "<hr>";
echo '是否還有此變數:$_SESSION["customer"]==>' . (isset($_SESSION['customer']) ? "存在" : "不存在") . "<br>";
echo '執行session_unset();之後，$_SESSION內有'. count($_SESSION) .'個元素<br>';
?>
<p/>
<a href='AnotherPage.php'>按這裡來啟動另外一頁</a> 
</body>
</html>
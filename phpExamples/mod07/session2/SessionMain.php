<?php
/*
 session_destroy()會清除session變數，但是只對
  其它頁有效。因此$_SESSION陣列內元素的值在本頁仍
  然可用，不過其它頁就不能再使用$_SESSION陣列內元素
  當User登出時，應該使用的函數。
 
   如果要立刻刪除$_SESSION陣列內的元素(這些元素稱為session變數) 
 (session variables)，
  可採用下列方法:
  $_SESSION = array();   
  $_SESSION = array();的意義 -->Unset all of the session variables.

   session_unset(); 與 
   $_SESSION = array(); 
      的功能一樣，但是對應的session ID仍然存在。 
   
*/
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
$_SESSION['address1'] = '台北' ;
$_SESSION['address2'] = '台中';

echo 'PHP的 SESSION變數(session variables)就是$_SESSION陣列內的元素 <br>';

echo "加入三個SESSION變數:'customer=>Kitty', 'address1=>台北', 'address2=>台中' <br>";
echo '此時SESSION變數的個數或 $_SESSION陣列的元素個數=' . count($_SESSION) . "<br>";
echo '<p>';
unset($_SESSION['address2']);   // 釋放 $_SESSION['address2']
echo '接著 釋放 $_SESSION["address2"] 對應的指令: unset($_SESSION["address2"]) <br>';
echo '釋放 $_SESSION["address2"] 之後，SESSION陣列的元素個數=' . count($_SESSION) . "<br>";
echo '<p>';
echo '印出 $_SESSION陣列內的所有元素:<br>';
$cnt=0;
foreach($_SESSION as $k => $v){
	echo "$k => $v <br>";
	$cnt++;
}
echo "共$cnt 個元素<br>";
echo "<hr>";

//session_destroy();
//$_SESSION = array();
// session_unset();
//echo '執行session_destroy(), $_SESSION內有'. count($_SESSION) .'個元素<br>';
//
//$cnt=0;
//foreach($_SESSION as $k => $v){
//	echo "$k => $v <br>";
//	$cnt++;
//}

// echo "共$cnt 個元素<br>";

   
//徹底清除Session
//session_unset();  
//session_destroy();
//$_SESSION = array();
//setcookie(session_name(),'',0,'/');// clear the session id stored at browser
//
?>

<a href='SessionDestroy.php'>
       按這裡來啟動SessionDestroy.php，於此程式內執行session_destroy()
</a> <br/>
<a href='SessionUnset.php'>
      按這裡來啟動SessionUnset.php，於此程式內執行session_unset()
</a> <br/>
</body>
</html>
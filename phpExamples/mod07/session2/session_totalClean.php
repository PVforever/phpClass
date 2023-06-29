<?php
session_start();
//徹底清除Session
session_unset();  
session_destroy();
$_SESSION = array();
setcookie(session_name(),'',0,'/');// clear the session id stored at browser
?>
<!DOCTYPE html>  
<html>
<head>
<meta charset='utf-8'>
<title><?php echo SYSTEM_NAME; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<a href='AnotherPage.php'>按這裡來啟動另外一頁</a> 
</body>
</html>
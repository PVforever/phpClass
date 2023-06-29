<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>mod05/stristr_demo.php</title>
</head>
<?php
  $email  = 'name@example.com';
  $domain = strstr($email, '@');
  echo $domain; // 印出 @example.com
  echo "<hr>";  // 
  $st='name=Mary&amt=100&pageNum_Recordset1=1';  
  $domain = strstr($st, 'pageNum_Recordset1');
  echo $domain; // 印出 pageNum_Recordset1=1  
?> 

<body>
</body>
</html>

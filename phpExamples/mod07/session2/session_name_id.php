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
echo "session_name(): 傳回session的名稱=" . session_name() . "<br>";
echo "session_id()=" . session_id() . "<br>";
?>
</body>
</html>
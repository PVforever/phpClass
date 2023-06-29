<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Session Test</title>

</head>

<body>
 	
<?php echo (isset($_COOKIE['foo']) && $_COOKIE['foo']=='bar') ? 'Cookie功能已開啟' : 'Cookie功能未開啟'; ?>
</body>
</html>

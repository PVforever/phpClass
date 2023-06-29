<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Read Cookies</title>
</head>
<body>
<?php
    echo $_COOKIE['UserName']  . "<br>";
    echo $_COOKIE['UserAge']   . "<br>";
    echo $_COOKIE['TT']        . "<br>";
    echo $_COOKIE['LastVisit'] . "<br>";
    echo "<hr>";
    foreach($_COOKIE as $k => $v) {
    	echo "印出Cookies: " .$k ."=>" . $v . "<br>";
    }

    foreach($_COOKIE as $v) {
        echo "沒有Key: " . $v . "<br>";
    }
    echo "<hr>";
    echo '您上次的拜訪時間為' . date("Y/m/d H:i:s", $_COOKIE['LastVisit'])  . "<br>";
?>
</body>
</html>


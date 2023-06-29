<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>建立資料庫</title>
</head>
<body>
	<?php 
	//操作與現存資料庫無關的SQL命令，可以不指定dbname屬性
	try {
		$pdo = new PDO('mysql:host:localhost; port=3306; charset=utf8', 'root', 'root',
				array(PDO::ATTR_EMULATE_PREPARES=>false,
                      PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                      PDO::ATTR_PERSISTENT=>true
                    )
		);
	} catch(PDOException $ex){
      	 echo $ex->getMessage() . "<br>";
    }
    try {
        $pdo->exec("Drop Database DBTest");
        echo "成功刪除指定之資料庫(PDO)<br>";
    } catch(PDOException $ex){
       echo "無法建立指定之資料庫(PDO)". $ex->getMessage() ."<br>";
    }
    try {
    	$pdo->exec("Create Database DBTest");
    	echo "成功建立指定之資料庫(PDO)<br>";
    } catch(PDOException $ex){
    	echo "無法建立指定之資料庫(PDO)". $ex->getMessage() ."<br>";
    }
    ?>
    <hr />
    <hr />
    <?php
    error_reporting(E_ALL ^ E_DEPRECATED); // 通知PHP顯示除了Deprecated之外的所有訊息
    //error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $conn = mysql_connect("localhost", "root", "root")
    or die("建立資料連線失敗");
    if (mysql_query("Drop Database DBTest", $conn)) {
    	echo "成功刪除指定之資料庫<br>";
    } else {
    	echo "無法刪除指定之資料庫<br>";
    }
    
    if (mysql_query("Create Database DBTest", $conn)) {
    	echo "成功建立指定之資料庫<br>";
    } else {
    	echo "無法建立指定之資料庫<br>";
    }
    mysql_close($conn);
    ?>
    	
?>
</body>
</html>

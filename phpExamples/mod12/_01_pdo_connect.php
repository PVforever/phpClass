<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>建立資料連線</title>
</head>
<body>
<?php
	echo "<h2 style='color:blue; text-align: center'>本程式說明如何利用PDO類別來建立與資料庫的連線</h2>";
	echo "<h4 style='color:brown; font-family: monospace; font-size: 20px'>" . 
	"\$pdo = new PDO('mysql:host=localhost; port=3306; dbname=proj; charset=utf8', <br>" .
    " 'root', 'root',<br>" .
	"array(<br>";
	echo " PDO::ATTR_EMULATE_PREPARES=>false,<br>";
	echo " PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,<br>";
	echo " PDO::ATTR_PERSISTENT => true<br>";
	echo ")   );</h3>";
	
	try {
		//  
    	$pdo = new PDO('mysql:host=localhost; port=3306; dbname=proj; charset=utf8', 'root', 'root', 
	    	     array(PDO::ATTR_EMULATE_PREPARES=>false, 
			       PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, 
    			       PDO::ATTR_PERSISTENT => true
	    	     	  )
        );            
    	// $pdo->exec("set names utf8");   // PHP 5.3.6 以前的版本 charset=utf8是無效的，必須使欲用此敘述
        echo "成功建立連線(PDO)<br>";
	} 
	catch(PDOException $ex){
		echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
		echo "行號:" . $ex->getLine() . "<br>";
		echo "堆疊:" . $ex->getTraceAsString() . "<br>";
	} 
	?>	
</body>
</html>
<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <link rel='stylesheet' href='/example/css/styles.css' type='text/css' />
    <title>執行 UPDATE 陳述式時，被影響的記錄數目</title>
  </head>
  <body>
    <?php 
       	echo "<h2 style='color:blue; text-align: center'>說明執行UPDATE敘述時，如何得到被影響的記錄數</h2>";
       	echo "<hr>";
     	echo "<h4 style='color:brown; font-family: monospace; font-size: 22px'>\$pdo = new PDO('......');<br>";
		echo "\$sql = \"Update book Set price = price + 100 where price > 500\";<br>";
		echo "\$pdoStmt = \$pdo->query(\$sql);<br>";
		echo "\$num = \$pdoStmt->rowCount();<br>";
		echo "或;<br>";
		echo "\$num2 = \$pdo->exec(\$sql);<br>";
		echo "<br>";
		echo "</h4>";
		try {
        	$pdo = new PDO("mysql:host=localhost; port=3306; charset=utf8; dbname=proj",'root','root',
                array(PDO::ATTR_EMULATE_PREPARES=>false, 
                      PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)
        	);
    	    $sql = "Update book Set price = price + 100 where price > 500";
        	$pdoStmt = $pdo->query($sql);
        	$num = $pdoStmt->rowCount();
        	echo "<p style='color:black; font-family: Verdana; font-size: 22px'>";
        	echo "方法一、利用\$pdoStmt->rowCount();<br>";
        	echo "執行UPDATE陳述式時，被影響的記錄數目(PDO):" . $num . "<br><br>";
	        // -------------------------------
    	    $num2 = $pdo->exec($sql);
        	echo "方法二、利用\$pdo->exec(\$sql);<br>";
        	echo "執行UPDATE陳述式時，被影響的記錄數目(PDO):" . $num2 . "<br></p>";
		} catch(PDOException $ex){
	    	echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
			echo "存取資料庫時發生錯誤，訊息:" . $ex->getLine() . "<br>";
    	}
    ?>
<div align='center'>   
<hr>
	<a href='index.php'>回前頁</a>
</div>
  </body>
</html>

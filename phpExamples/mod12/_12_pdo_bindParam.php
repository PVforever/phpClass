<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>fetchAll()</title>
<style>
table {
	width: 100%;
}

.ta {
	background-color: #aba;
}

.tb {
	background-color: #cea
}

th {
	height: 50px;
}
</style>
</head>
<body>
<?php
echo "<h2 style='color:blue; text-align: center'>說明PDOStatement的bindParam()方法</h2>";
echo "<h4 style='color:brown; font-family: monospace; font-size: 22px'>\$pdo = new PDO('......');<br>";
echo "\$name = \"張君雅\";<br>";
echo "\$sql = \"SELECT * FROM friends WHERE NAME = :param_name\";<br>";
echo "\$pdoStmt = \$pdo->prepare(\$sql);<br>";
echo "\$pdoStmt->bindParam(':param_name', \$name, PDO::PARAM_STR);<br>";
echo "\$name = \"張小雅\";<br>";
echo "\$pdoStmt->execute();<br>";
echo "<hr>";
echo "執行\$pdoStmt->bindParam(':param_name', \$name, PDO::PARAM_STR);敘述時，<br>";
echo "就將變數的地址放入PreparedStatement中, 待執行\$pdoStmt->execute();敘述時，<br>";
echo "才依變數之地址來取出變數的值來執行SQL敘述";
echo "</h4>";
try {
	$pdo = new PDO('mysql:host=localhost:3306;dbname=proj;charset=utf8', 'root', 'root',
			  array(PDO::ATTR_EMULATE_PREPARES => false,
				    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
	);
	$name = "張君雅"; 
	$sql = "SELECT * FROM friends WHERE NAME = :param_name";
	$pdoStmt = $pdo->prepare($sql);
	$pdoStmt->bindValue(':param_name', $name, PDO::PARAM_STR);
	$name = "張小雅";
	$pdoStmt->execute();
	$result = $pdoStmt->fetch();
	if ($result){
	    list($sno, $name, $phone, $uniColumn) = $result;
	    echo "sno=$sno<br>";
	    echo "name=$name<br>";
	    echo "phone=$phone<br>";
	    echo "uniColumn=$uniColumn<br>";
	} else {
	    echo "查無此筆資料";
	}
	
} catch(PDOException $ex){
	echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
	echo "列號:" . $ex->getLine() . "<br>";
}

$link = null
?>
</body>
</html>

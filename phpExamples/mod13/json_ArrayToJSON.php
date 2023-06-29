<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>查詢表格內容</title>
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
	echo "<h2 style='color:blue; text-align: center'>說明如何將資料庫讀出的結果集轉換為JSON格式的資料(Array)</h2>";
	echo "<h4 style='color:brown; font-family: monospace; font-size: 20px'>\$pdo = new PDO('......');<br>";
	echo "\$pdoStmt = \$pdo->query(\$sql);<br>";
	echo "\$arr = array();<br>";
	echo "while ( \$row = \$pdoStmt->fetch ( PDO::FETCH_ASSOC ) ) {<br>";
	echo "&nbsp;&nbsp;&nbsp;\$arr[] = \$row;<br>" ; 
	echo "}<br>";
	echo "echo json_encode(\$arr);<br>";
	echo "</h4>";
	try {
		$pdo = new PDO ( 'mysql:host=localhost;dbname=proj;charset=utf8', 'root', 'root', array (
				PDO::ATTR_EMULATE_PREPARES => false,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
		) );
		$sql = "SELECT bookID, title, author, price, bookNo, companyID FROM book WHERE price > 1000";
		$pdoStmt = $pdo->query ( $sql );

		$arr = array();
		while ( $row = $pdoStmt->fetch ( PDO::FETCH_ASSOC ) ) {
			$arr[] = $row;
		}
		echo json_encode($arr);
		
	} catch ( PDOException $ex ) {
		echo "發生資料庫存取錯誤，訊息:" . $ex->getMessage () . "<br>";
	}
   ?>
	
</body>
</html>

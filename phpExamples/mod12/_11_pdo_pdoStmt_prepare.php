<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' href='/example/css/styles.css' type='text/css' />
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
echo "<h2 style='color:blue; text-align: center'>說明如何利用PDOStatement的prepare()方法</h2>";
echo "<hr>";
echo "<h4 style='color:brown; font-family: monospace; font-size: 22px'>\$pdo = new PDO('......');<br>";
echo "\$sql = \"Insert Into Friends (sno, name, phone, uniColumn) ".
		" values(?, ?, ?, ?)\";<br>";
echo "\$pdoStmt = \$pdo->prepare(\$sql);<br>";
echo "\$pdoStmt->bindValue(1, 'xxx', PDO::PARAM_STR);<br>";
echo "\$pdoStmt->bindValue(2, 'yyy', PDO::PARAM_STR);<br>";
echo "\$pdoStmt->bindValue(3, 'zzz', PDO::PARAM_STR);<br>";
echo "\$pdoStmt->bindValue(4, 999, PDO::PARAM_INT);<br>";
echo "或;<br>";
echo "\$sql = \"Insert Into Friends (sno, name, phone, uniColumn) ".
		" values(:sno, :name, :pho, :uni)\";<br>";
echo "\$pdoStmt = \$pdo->prepare(\$sql);<br>";
echo "\$pdoStmt->bindValue(':sno', 'xxx', PDO::PARAM_STR);<br>";
echo "\$pdoStmt->bindValue(':name', 'yyy', PDO::PARAM_STR);<br>";
echo "\$pdoStmt->bindValue(':pho', 'zzz', PDO::PARAM_STR);<br>";
echo "\$pdoStmt->bindValue(':uni', 999, PDO::PARAM_INT);<br>";
echo "</h4>";
try {
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=proj;charset=utf8', 'root', 'root',
			  array(PDO::ATTR_EMULATE_PREPARES => false,
				    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
	);
	
	$sql = "Insert Into friends (sno, name, phone, uniColumn) ".
			"values(?, ?, ?, ?)";
	$name =  '張香蘭-bv-2';
	$tel  =  '0958-112233';
	$uniColumn = rand(0, 32767);
	$pdoStmt = $pdo->prepare($sql);
	$pdoStmt->bindValue(1, null);
	$pdoStmt->bindValue(2, $name, PDO::PARAM_STR);
	$pdoStmt->bindValue(3, $tel, PDO::PARAM_STR);
	$pdoStmt->bindValue(4, $uniColumn, PDO::PARAM_INT);
	
	$name =  '張香蘭-bv-2';
	$pdoStmt->execute();
	//--下列四行都會發生錯誤--------------
// 	$pdoStmt->bindParam(1, null);  
// 	$pdoStmt->bindParam(2, '張香蘭-bv-1');
// 	$pdoStmt->bindParam(3, '0958-112233');
// 	$pdoStmt->bindParam(4, rand(0, 32767));
// 	$pdoStmt->execute();
	//------------------------------
	$sql = "Insert Into friends (sno, name, phone, uniColumn) ".
			"values(:sno, :name, :pho, :uni)";
	$null =  null;
	$name =  '張香蘭-bp-1';
	$tel  =  '0958-112233';
	$uniColumn = rand(0, 32767);
	$pdoStmt = $pdo->prepare($sql);
	$pdoStmt->bindParam(':sno', $null);
	$pdoStmt->bindParam(':name', $name, PDO::PARAM_STR);
	$pdoStmt->bindParam(':pho', $tel, PDO::PARAM_STR);
	$pdoStmt->bindParam(':uni', $uniColumn, PDO::PARAM_INT);
	$pdoStmt->execute();
	//------------------------------
	$nameArr = array('張軍亞-bv', '馬力歐-bv', '劉雪莉-bv');
	$telArr = array('0958-111111', '0958-222222', '0958-333333');
	$uniArr = array(rand(0, 32767), rand(0, 32767), rand(0, 32767));
	foreach($nameArr as $k => $v){
		$pdoStmt = $pdo->prepare($sql);
		$pdoStmt->bindValue(1, null);
		$pdoStmt->bindValue(2, $v, PDO::PARAM_STR);
		$pdoStmt->bindValue(3, $telArr[$k], PDO::PARAM_STR);
		$pdoStmt->bindValue(4, $uniArr[$k], PDO::PARAM_INT);
		$pdoStmt->execute();
//      下列四行也可以，但不能與上面四行同時執行
// 		$pdoStmt->bindValue(':sno', null);
// 		$pdoStmt->bindValue(':name', $v, PDO::PARAM_STR);
// 		$pdoStmt->bindValue(':pho',  $telArr[$k], PDO::PARAM_STR);
// 		$pdoStmt->bindParam(':uni',  $uniArr[$k], PDO::PARAM_INT);
// 		$pdoStmt->execute();
	}
	//------------------------------
	$nameArr = array('張軍亞-bp', '馬力歐-bp', '劉雪莉-bp');
	$telArr = array('0958-111111', '0958-222222', '0958-333333');
	$uniArr = array(rand(0, 32767), rand(0, 32767), rand(0, 32767));
	foreach($nameArr as $k => $v){
		$pdoStmt = $pdo->prepare($sql);
		$pdoStmt->bindValue(1, null);
		$pdoStmt->bindParam(2, $v, PDO::PARAM_STR);
		$pdoStmt->bindParam(3, $telArr[$k], PDO::PARAM_STR);
		$pdoStmt->bindParam(4, $uniArr[$k], PDO::PARAM_INT);
		$pdoStmt->execute();
//      下列四行也可以，但不能與上面四行同時執行		
// 		$pdoStmt->bindValue(1, null);
// 		$pdoStmt->bindParam(2, $v, PDO::PARAM_STR);
// 		$pdoStmt->bindParam(3, $telArr[$k], PDO::PARAM_STR);
// 		$pdoStmt->bindParam(4, $uniArr[$k], PDO::PARAM_INT);
// 		$pdoStmt->execute();
	}
	echo "<font color='red' size='+3'>執行成功...</font>";
} catch(PDOException $ex){
	echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
	echo "列號:" . $ex->getLine() . "<br>";
}
?>
<div align='center'>   
<hr>
	<a href='index.php'>回前頁</a>
</div>
</body>
</html>

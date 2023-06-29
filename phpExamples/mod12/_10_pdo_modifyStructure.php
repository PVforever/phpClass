<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>fetchAll()</title>
<style>

</style>
</head>
<body>
<?php
echo "<h2 style='color:blue; text-align: center'>說明如何修改表格的結構</h2>";
echo "<h4 style='color:brown; font-family: monospace; font-size: 22px'>\$pdo = new PDO('......');<br>";
echo "\$sql = \"ALTER TABLE `friends` ADD `uniColumn` INT NOT NULL \";<br>";
echo "\$num = \$pdo->exec(\$sql);;<br>";
echo "\$sql = \"Update `friends` set uniColumn = sno \";<br>";
echo "\$num = \$pdo->exec(\$sql);;<br>";
echo "\$sql = \"ALTER TABLE `friends` ADD UNIQUE (`uniColumn`) \";<br>";
echo "\$num = \$pdo->exec(\$sql);;<br>";
echo "\$sql = \"ALTER TABLE  `friends` ENGINE = INNODB \";<br>";
echo "\$num = \$pdo->exec(\$sql);;<br>";

echo "</h4>";
try {
	$pdo = new PDO('mysql:host=localhost;dbname=proj;charset=utf8', 'root', 'root',
			  array(PDO::ATTR_EMULATE_PREPARES => false,
				    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
	);
	$sql = "ALTER TABLE `friends` ADD `uniColumn` INT NOT NULL ";
	$num = $pdo->exec($sql);
	echo "修改friends表格結構成功, num=$num<br>";
} catch(PDOException $ex){
	echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
	echo "列號:" . $ex->getLine() . "<br>";
}
	//------
try{	
	$sql = "Update `friends` set uniColumn = sno ";
	$num = $pdo->exec($sql);
	echo "修改friends表格的uniColumn欄位成功, num=$num<br>";
} catch(PDOException $ex){
	echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
	echo "列號:" . $ex->getLine() . "<br>";
}	
	//------
try {	
	$sql = "ALTER TABLE `friends` ADD UNIQUE (`uniColumn`) ";
	$num = $pdo->exec($sql);
	echo "新增friends表格的uniColumn欄位UNIQUE屬性：成功, num=$num<br>";
	
} catch(PDOException $ex){
	echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
	echo "列號:" . $ex->getLine() . "<br>";
}	
	//------
try{
	$sql = "ALTER TABLE  `friends` ENGINE = INNODB ";
	$num = $pdo->exec($sql);
	echo "新增friends表格INNODB屬性：成功, num=$num<br>";
	
} catch(PDOException $ex){
	echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
	echo "列號:" . $ex->getLine() . "<br>";
}	
$link = null
?>
</body>
</html>

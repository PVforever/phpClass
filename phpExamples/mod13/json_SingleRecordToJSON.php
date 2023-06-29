<?php 
try {
	$pdo = new PDO('mysql:host=localhost;dbname=proj;charset=utf8', 'root', 'root',
			  array(PDO::ATTR_EMULATE_PREPARES => false,
				    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
	);
	$name = "張君雅"; 
	$sql = "SELECT * FROM friends WHERE NAME = :param_name";
	$pdoStmt = $pdo->prepare($sql);
	$pdoStmt->bindValue(':param_name', $name, PDO::PARAM_STR);
	$pdoStmt->execute();
	$result = $pdoStmt->fetch(PDO::FETCH_ASSOC);
	//print_r($result);
	if ($result){
	    echo json_encode($result);
	} else {
	    echo "查無此筆資料";
	}
	
} catch(PDOException $ex){
	echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
	echo "列號:" . $ex->getLine() . "<br>";
}
?>

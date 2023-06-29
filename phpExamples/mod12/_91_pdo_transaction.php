<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>fetchAll()</title>

</head>
<body>
<hr/>
<hr/>
<?php
echo "<h2 style='color:blue; text-align: center'>說明如何進行交易(Transaction)</h2>";

try {
   $pdo = new PDO('mysql:host=localhost:3306;dbname=proj;charset=utf8', 'root', 'root',
		           array(PDO::ATTR_EMULATE_PREPARES => false, 
    		       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    		     ); 
   $pdo->exec("set names utf8");
   $pdo->beginTransaction();
   $sql = "DELETE FROM friends where SNO < 3 "  ;
   $pdoStmt = $pdo->prepare($sql);
   $pdoStmt->execute();
   $num = $pdoStmt->rowCount();
   echo "刪除紀錄後，num=$num<br>";
   $sql = "INSERT INTO friends VALUES(null, ?, ?, ?) "  ;
   $pdoStmt = $pdo->prepare($sql);
   $randNum = rand(0, 32767);
   $pdoStmt->execute(array('馬利雅', '02-66666637', $randNum));
   $num = $pdoStmt->rowCount();
   echo "新增第一筆紀錄後，num=$num<br>";
   $randNum = rand(0, 32767);
   $pdoStmt->execute(array('張金雅', '02-66666637', $randNum));
   $num = $pdoStmt->rowCount();
   echo "新增第二筆紀錄後，num=$num<br>";
  // throw new PDOException("測試用的例外");
   $pdo->commit();
   echo "資料異動成功，執行commit() <br>";
} catch(PDOException $ex){
   echo "存取資料庫疵發生錯誤，訊息:" . $ex->getMessage() . "<br>";
   echo "行號:" . $ex->getLine() . "<br>";
   $pdo->rollback();
   echo "資料異動發生錯誤，執行rollbck() <br>";
} 
$link = null
?>
<hr/>
<hr/>
<?php
/*
$pdo = new PDO('mysql:host=localhost;dbname=proj;charset=utf8', 'root', 'root',
	           array(PDO::ATTR_EMULATE_PREPARES => false, 
                     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    		 ); 
$pdoStmt = $pdo->query($sql);
echo "<table class='tb' border='3' >";
echo "<tr><th>書籍流水號</th><th>作者</th>" .
	 "<th>書名</th><th>價格</th>" .
	 "<th>書號</th><th>出版社</th>" .
	 "</tr>";
$arr2D = $pdoStmt->fetchAll(PDO::FETCH_ASSOC);
foreach($arr2D as $row) {
    echo "<tr>";
    echo "<td>" . $row['bookID'] . "</td>";
    echo "<td>" . $row['author'] . "</td>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['bookNo'] . "</td>";
    echo "<td>" . $row['companyID'] . "</td>";
    echo "</tr>";
}
echo "</table>";
$link = null
*/
?>
</body>
</html>

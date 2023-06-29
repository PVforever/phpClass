<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
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
echo "<h2 style='color:blue; text-align: center'>說明如何修改表格內的記錄</h2>";

try {
   $pdo = new PDO('mysql:host=localhost:3306;dbname=proj;charset=utf8', 'root', 'root',
		           array(PDO::ATTR_EMULATE_PREPARES => false, 
    		       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    		     ); 
     
   $sql = "Update book set title=?, author=?, price=?, " .  
		  " companyID=?, bookNo=?, filename=?, coverImage=? " . 
		  " where bookID =  ? " ;
   $pdoStmt = $pdo->prepare($sql);
   $pdoStmt->bindValue(1, '最新PHP5知識全集', PDO::PARAM_STR);
   $pdoStmt->bindValue(2, '宇宙超人', PDO::PARAM_STR);
   $pdoStmt->bindValue(3, 999, PDO::PARAM_INT);
   $pdoStmt->bindValue(4, 2, PDO::PARAM_INT);
   $pdoStmt->bindValue(5, rand(0,32767), PDO::PARAM_INT);
   $filename = 'bookA.jpg';
   $path = $_SERVER['DOCUMENT_ROOT'] .'/phpExamples/' . $filename;
   $bookImage = fopen($path,'rb');  // you can also use 'b' to force binary mode, which will not translate your data. 
   $pdoStmt->bindValue(6, $filename, PDO::PARAM_STR);
   $pdoStmt->bindParam(7, $bookImage, PDO::PARAM_LOB);
   $pdoStmt->bindValue(8, 5, PDO::PARAM_INT);
   $pdoStmt->execute();
   $num = $pdoStmt->rowCount();
   echo "修改記錄的筆數=$num<br>";
} catch(PDOException $ex){
	echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
	echo "行號:" . $ex->getLine() . "<br>";
	echo "堆疊:" . $ex->getTraceAsString() . "<br>";
} 
?>
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
<div align='center'>   
<hr>
	<a href='index.php'>回前頁</a>
</div>

</body>
</html>

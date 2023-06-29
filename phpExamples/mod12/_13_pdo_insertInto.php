<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<link rel='stylesheet' href='/example/css/styles.css' type='text/css' />
<title>INSERT INTO</title>
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
<h2 style='color:blue; text-align: center'>說明如何新增一筆記錄到表格內</h2>
<hr/>
<?php

try {
   $pdo = new PDO('mysql:host=localhost:3306;dbname=proj;charset=utf8', 'root', 'root',
		           array(PDO::ATTR_EMULATE_PREPARES => false, 
    		       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    		     ); 
     
   $sql = "Insert Into book (bookId, title, author, price, companyID, bookNo, fileName, coverImage) values " . 
          "(:bookId, :title, :author, :price, :companyId, :bookNo, :filename,  :coverImage)";

   $pdoStmt = $pdo->prepare($sql);
   $pdoStmt->bindValue(":bookId", null);   // 因為此欄位為 AI
   $pdoStmt->bindValue(":title", 'iPhone使用大全', PDO::PARAM_STR);
   $pdoStmt->bindValue(":author", '張大亞', PDO::PARAM_STR);
   $pdoStmt->bindValue(":price", 500, PDO::PARAM_INT);
   $pdoStmt->bindValue(":companyId", 2, PDO::PARAM_INT);
   $pdoStmt->bindValue(":bookNo", rand(0,32767), PDO::PARAM_INT);
   $filename = 'bookB.jpg';
   $path = $_SERVER['DOCUMENT_ROOT'] .'/phpExamples/' . $filename;
   
   echo "Path=$path<br>";
   
   // $path = '/example/bookA.jpg';   //
   $bookImage = fopen($path,'rb');
   $pdoStmt->bindValue(":filename", $filename, PDO::PARAM_STR);
   $pdoStmt->bindParam(":coverImage", $bookImage, PDO::PARAM_LOB);
   $pdoStmt->execute();
   $num = $pdoStmt->rowCount();
   echo "新增記錄的筆數=$num<br>";
} catch(PDOException $ex){
		echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
		echo "行號:" . $ex->getLine() . "<br>";
		echo "堆疊:" . $ex->getTraceAsString() . "<br>";
} 

?>
<hr/>
<?php

$pdo = new PDO('mysql:host=localhost:3306;dbname=proj;charset=utf8', 'root', 'root',
	           array(PDO::ATTR_EMULATE_PREPARES => false, 
                     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    		 ); 
$sql = "SELECT bookID, title, author, price, bookNo, companyID "
        . " FROM book";
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
?>
<div align='center'>   
<hr>
	<a href='index.php'>回前頁</a>
</div>
</body>
</html>

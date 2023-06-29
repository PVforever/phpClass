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
echo "<h2 style='color:blue; text-align: center'>說明如何利用PDOStatement的fetchAll()取出所有查詢的記錄</h2>";
echo "<hr>";
echo "<h4 style='color:brown; font-family: monospace; font-size: 22px'>\$pdo = new PDO('......');<br>";
echo "\$sql = \"SELECT bookID, title, author, price....\";<br>";
echo "\$pdoStmt = \$pdo->query(\$sql);<br>";
echo "\$arr2D = \$pdoStmt->fetchAll(PDO::FETCH_NUM);<br>";
echo "foreach(\$arr2D as \$row){<br>";
echo " &nbsp;&nbsp;元素的識別資訊為0開始的連續整數...<br>";
echo "}<br>";
echo "或;<br>";
echo "\$arr2D = \$pdoStmt->fetchAll(PDO::FETCH_ASSOC);<br>";
echo "foreach(\$arr2D as \$row){<br>";
echo " &nbsp;&nbsp;元素的識別資訊為欄位名稱<br>";
echo "}<br>";
echo "</h4>";
try {
	$pdo = new PDO('mysql:host=localhost; port=3306; dbname=proj; charset=utf8', 'root', 'root',
	         array(PDO::ATTR_EMULATE_PREPARES => false, 
    		           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
           ); 
// 	$pdo->exec("set names utf8");
	$sql = "SELECT bookID, title, author, price, bookNo, companyID FROM book WHERE price > 500";
// 	echo "<table class='ta' border='2'>";
// 	echo "<tr><th>書籍流水號</th><th>作者</th>" .
// 	 	 "<th>書名</th><th>價格</th>" .
// 	 	 "<th>書號</th><th>出版社</th>" .
// 	 	 "</tr>";
	$pdoStmt = $pdo->query($sql);
	$arr2D = $pdoStmt->fetchAll(PDO::FETCH_NUM);
	echo json_encode($arr2D);
// 	foreach($arr2D as $row){
// 		echo "<tr>";
// 		list($bookID, $title, $author, $price, $bookNo, $company) = $row;
//     	echo "<td>$bookID</td>";
//     	echo "<td>$author</td>";
//     	echo "<td>$title</td>";
//     	echo "<td>$price</td>";
//     	echo "<td>$bookNo</td>";
//     	echo "<td>$company</td>";
//     	echo "</tr>";
// 	}
	echo "</table>";
} catch(PDOException $ex){
   	echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
   	echo "Line No.:" . $ex->getLine() . "<br>";
}
?>
<hr/>
<hr/>
<?php
try {
	$pdo = new PDO('mysql:host=localhost; port=3306; dbname=proj; charset=utf8', 'root', 'root',
	           array(PDO::ATTR_EMULATE_PREPARES => false, 
                     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    		 ); 
//     $pdo->exec("set names utf8"); 
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
} catch(PDOException $ex){
	echo "發生資料庫存取錯誤，訊息:" . $ex->getMessage() . "<br>";
	echo "Line No.:" . $ex->getLine() . "<br>";
}

?>
<div align='center'>   
<hr>
	<a href='index.php'>回前頁</a>
</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<link rel='stylesheet' href='/example/css/styles.css' type='text/css' />
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
	echo "<h2 style='color:blue; text-align: center'>說明如何執行查詢(Select敘述)以及如何取出結果集內的資料</h2>";
	echo "<hr>";
	echo "<h4 style='color:brown; font-family: monospace; font-size: 14px'>";
	echo "echo \"&lt;table class='tb' border='3' &gt;\";<br>";
	echo "echo \"&lt;tr&gt;&lt;th&gt;書籍流水號&lt;/th&gt;&lt;th&gt;作者&lt;/th&gt;...&lt;th&gt;出版社&lt;/th&gt;&lt;/tr&gt;<br>";
	echo "\$pdo = new PDO('......');<br>";
	echo "\$sql = \"SELECT bookID, title, author...    FROM book \";<br>";
	echo "\$pdoStmt = \$pdo->query ( \$sql );<br>";
	echo "while (\$row = \$pdoStmt->fetch (PDO::FETCH_ASSOC ) ) {<br>";
	echo " &nbsp;&nbsp;echo '&lt;tr&gt;';<br>" ; 
	echo " &nbsp;&nbsp;echo '&lt;td&gt;' . \$row ['bookID'] . '&lt;/td&gt;';<br>";
	echo " &nbsp;&nbsp;echo '&lt;td&gt;' 顯示其他的欄位 '&lt;/td&gt;';<br>";
	echo " &nbsp;&nbsp;echo '&lt;/tr>';<br>" ;
	echo "}<br>";
	echo "</h4>";
	try {
		$pdo = new PDO ( 'mysql:host=localhost; port=3306; dbname=proj; charset=utf8', 'root', 'root', array (
				PDO::ATTR_EMULATE_PREPARES => false,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
		) );
		echo "<table class='tb' border='3' >";
		echo "<tr><th>書籍流水號</th><th>作者</th>" . "<th>書名</th><th>價格</th>" 
				    . "<th>書號</th><th>出版社</th>" . "</tr>";
	    $sql = "SELECT bookID, title, author, price, bookNo, companyID "
			    . " FROM book";
	    $pdoStmt = $pdo->query ( $sql );
		//  取出一筆記錄，將其轉換為關聯式陣列，然後傳回此陣列
		while ( $row = $pdoStmt->fetch ( PDO::FETCH_ASSOC ) ) {
			echo '<tr>';
			echo '<td>' . $row ['bookID'] . '</td>';
			echo '<td>' . $row ['author'] . '</td>';
			echo '<td>' . $row ['title'] . '</td>';
			echo '<td>' . $row ['price'] . '</td>';
			echo '<td>' . $row ['bookNo'] . '</td>';
			echo '<td>' . $row ['companyID'] . '</td>';
			echo '</tr>';
		}
		//  $pdoStmt->fetch ( PDO::FETCH_NUM )
		//  取出一筆記錄，將其轉換為索引式陣列，然後傳回此陣列
// 		while ( $row = $pdoStmt->fetch ( PDO::FETCH_NUM ) ) {
// 			echo '<tr>';
// 			echo '<td>' . $row [0] . '</td>';
// 			echo '<td>' . $row [2] . '</td>';
// 			echo '<td>' . $row [1] . '</td>';
// 			echo '<td>' . $row [3] . '</td>';
// 			echo '<td>' . $row [4] . '</td>';
// 			echo '<td>' . $row [5] . '</td>';
// 			echo '</tr>';
// 		}
		echo "</table>";
	} catch ( PDOException $ex ) {
		echo "發生資料庫存取錯誤，訊息:" . $ex->getMessage () . "<br>";
	}
   ?>
<div align='center'>   
<hr>
	<a href='index.php'>回前頁</a>
</div>
</body>
</html>

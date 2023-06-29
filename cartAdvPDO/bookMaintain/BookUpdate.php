<?php session_start(); ?>
<?php require_once('../Connections/conn.php'); ?>
<?php require_once('Book_CRUD_Main_Class_Dao.php'); ?>
<?php require_once('Book.php'); ?>


<?php
/*
 程式的功能：
修改book表格內的某一筆記錄。某些功能與新增記錄相同。
 
使用者透過瀏覽器瀏覽書籍資料(index.php)時，他可按下某本書籍
的『書名』超連結，瀏覽器會發出 /BookUpdate.php?bookID=xxxxx的請求。
xxxxx為該本書籍的流水號。
 
這樣的請求為瀏覽器對本程式發出的第一次對請求。此時(本程式第一次執行時)，
本程式會透過  $sid = $_GET['bookID']; 取得因使用者按下『書名』超連結所送
來的書籍流水號xxxxx。接著，以此流水號為依據，到資料庫內讀取對應的書籍記錄。
然後本程式會送回一個含有該筆書籍資料的表單讓使用者修改資料。
 
當使用者修改完畢、按下『Submit』按鈕後，這些修改後的資料會由瀏覽器送回到
本程式(瀏覽器第二次對本程式發出請求)。此時，本程式會檢查使用者輸入的資料，
如果有錯誤，送回原輸入資料與錯誤訊息，交由使用者修改。改完後，使用者再次按
下『Submit』按鈕(瀏覽器第三次...對本程式發出請求)。這些資料會再度送回到本
程式。經過檢查，修改後的資料如果沒有錯誤，程式會將這些資料寫入資料庫。
*/
// 下列變數將會存放要傳送給使用者修改的資料，以及使用者透過瀏覽器傳送回來的資料
// $bookID = $_POST['bookID'];
$bookID = "";
$bookNo = "";
$companyID = "";
$title = "";
$author = "";
$price = "";
$fileName = "" ;
$coverImage = "" ;
//----------------
// 通常使用者輸入之資料必須經過程式的檢查，正確無誤的資料才會寫入
// 資料庫。如果輸入資料有錯誤，將送回錯誤訊息通知使用者修改。
// 下列個變數將存放要送回給使用者看的錯誤訊息。
$errBookNo = '';
$errCompanyID = "";
$errTitle = "";
$errAuthor = "";
$errPrice = '';
$errPicture = '';
$errDBMessage = '';
// 此變數表示資料是否正確
$validData = 1;
// ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1"))
// 可用來判斷瀏覽器是第1次對本程式發出HTTP請求，還是第2,3,4...次對
// 本程式發出HTTP請求。
//
// "MM_insert"是本表單內的一個隱藏欄位，瀏覽器是第1次對本程式發出HTTP
// 請求時(注意：此時本程式會在Server端執行)瀏覽器不會送來此欄位，但是
// 當本程式產生回應給瀏覽器時，會送回含有名為 "MM_insert" 的隱藏欄位，
// 如 <input type="hidden" name="MM_update" value="form1" />，
// 因此當瀏覽器第2,3,4...次對本程式發出HTTP請求，就會送出有此欄位。
$bookDao = new BookDao();

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	// 讀取使用者傳來的資料
	$bookID = $_POST['bookID'];
	$bookNo = $_POST['bookNo'];
	$companyID = $_POST['companyID'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$price = $_POST['price'];
	if (empty($bookNo)) {
		$errBookNo = '必須輸入書號';
		$validData = 0;
	}
	if (empty($companyID)) {
		$errCompanyID = '必須輸入出版社';
		$validData = 0;
	}
	if (empty($title)) {
		$errTitle = '書名不能空白';
		$validData = 0;
	}
	if (empty($author)) {
		$errAuthor = '必須輸入作者';
		$validData = 0;
	}
	if (empty($price)) {
		$errPrice = '必須輸入價格';
		$validData = 0;
	} else if (!is_numeric($price)) {   // is_int() : 檢查是否為整數
		$errPrice = '必須輸入數值';
		$validData = 0;
	}
	if ($_FILES["uploadFile"]["error"] == 0)   {
		$imageContent = file_get_contents($_FILES['uploadFile']['tmp_name']);
		//$data = mysql_real_escape_string($imageContent);
		//$data = addslashes($imageContent);
		// $_FILES["uploadFile"]["name"] : 圖片檔的檔名
		$fileName = $_FILES["uploadFile"]["name"];
	}
	
	if ($validData) {
		try {
			if (strlen($fileName) > 0 ) {
				// 使用者挑選新的圖片，所以圖片欄要更新
				// $updateSQL = "Update book set title=?, author=?, price=? , companyID = ?, image=?, bookNo=?, CoverImage=? where bookID = ? ";
				// $pdoStmt = $pdo->prepare($updateSQL);
				// $pdoStmt->bindValue(1, $title, PDO::PARAM_STR);
				// $pdoStmt->bindValue(2, $author, PDO::PARAM_STR);
				// $pdoStmt->bindValue(3, $price, PDO::PARAM_STR);
				// $pdoStmt->bindValue(4, $companyID, PDO::PARAM_INT);
				// $pdoStmt->bindValue(5, $fileName, PDO::PARAM_STR);
				// $pdoStmt->bindValue(6, $bookNo, PDO::PARAM_STR);
				// $pdoStmt->bindValue(7, $imageContent, PDO::PARAM_LOB);
				// $pdoStmt->bindValue(8, $bookID, PDO::PARAM_INT);
				// $pdoStmt->execute();
				$book = new Book($bookID, $author, $bookNo, $imageContent , $fileName, $price, $title , $companyID);
				$result = $bookDao->update($book);
			} else {
				// 使用者並未挑選新的圖片，所以圖片欄不需要更新
				//$updateSQL = "Update book set title='$title', author='$author', price=$price , companyID = $companyID,   bookNo='$bookNo'  where bookID = $bookID ";
				// $updateSQL = "Update book set title=?, author=?, price=? , companyID = ?, bookNo=?  where bookID = ? ";
				// $pdoStmt = $pdo->prepare($updateSQL);
				// $pdoStmt->bindValue(1, $title);
				// $pdoStmt->bindValue(2, $author);
				// $pdoStmt->bindValue(3, $price);
				// $pdoStmt->bindValue(4, $companyID);
				// $pdoStmt->bindValue(5, $bookNo);
				// $pdoStmt->bindValue(6, $bookID);
				// $pdoStmt->execute();

				$book = new Book($bookID, $author, $bookNo, NULL , 
				NULL, $price, $title , $companyID);
				$result = $bookDao->updateWithoutCoverImage($book);
				
			}

			// 請MySQL執行此 $updateSQL 命命
			if ($result==1) {
				// 取得受前一個命令的執行所影響的紀錄個數
				// 1: 表示更新成功(有1筆紀錄)
				// 0: 表示更新失敗(有0筆紀錄)
				$_SESSION['Book_Message'] = '書籍' . $bookNo . '修改成功';
				
			} else {
				$_SESSION['Book_Message'] = '書籍' . $bookNo . '資料未異動';
			}
			header("Cache-Control: no-cache, must-revalidate");
			header('Location: index.php');
		} catch(PDOException $ex) {
			$errDBMessage = '資料庫錯誤:' . $ex->getMessage() . ", Line= " . $ex->getLine();
		}
	} else {
       // 
	}
} else {
	$sid = 0 ;
	if (!isset($_GET['bookID'])) {
		$sid = -1 ;
	} else {
		$sid = $_GET['bookID'];
	}
	
	$row = $bookDao->findById($sid);
	//print_r($row);
	// list($bookID, $title, $author, $price, $companyID, $image, $bookNo, $coverImage) = $row;
	$bookID = $row['bookID']; 
	$title = $row['title']; 
	$author = $row['author']; 
	$price = $row['price']; 
	$companyID = $row['companyID'];  
	$image = $row['image']; 
	$bookNo = $row['BookNo']; 
	$coverImage = $row['CoverImage'];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Hold不住購物商</title>
<link href="../style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function setFocus()
{
     document.getElementById("title").focus();
}

function confirmDelete() {
	if (confirm("確定刪除此項書籍資料(書號:<?php echo $bookNo ?>)?") ) {
		document.forms[0].action="BookDelete.php?bookNo=<?php echo $bookNo ?>" ;
		document.forms[0].method="GET";
		document.forms[0].submit();
	} else {
	}
}

function updateBook() {
    document.forms[0].action="BookUpdate.php" ;
	document.forms[0].method="POST";
	document.forms[0].submit();
}
</script>
</head>

<body onload="setFocus()" background="../img/bookMaintain.jpg">
	<h3 align="center">書籍維護</h3>
	<hr />
	<br />

	<br />
	<form id="form1" name="form1" method="post" action="BookUpdate.php"
		enctype="multipart/form-data">

		<table class="table_color" width="608" border="2" align="center"
			cellpadding="2" cellspacing="2">
			<tr height='40'>
				<td colspan="4" align="center" valign="bottom"><font color='blue'
					size='+2'>更新書籍資料</font></td>
			</tr>
			<tr height='36'>
				<td width="45" align="right" class="title_font">書名</td>
				<td colspan="3"><input name="title" class='InputClass' type="text"
					id="title" value="<?php echo $title; ?>" size="50" /><font
					color='red' size='-1'><?php echo $errTitle; ?> </font></td>
			</tr>
			<tr height='36'>
				<td width="45" align="right" class="title_font">作者</td>
				<td width="312"><input name="author" class='InputClass' type="text"
					id="author" value="<?php echo $author; ?>" size="26" /><font
					color='red' size='-1'><?php echo $errAuthor; ?> </font></td>
				<td width="52" align="right" class="title_font">價格</td>
				<td width="161"><input name="price" class='InputClass' type="text"
					id="price" value="<?php echo $price; ?>" size="3" /><font
					color='red' size='-1'><?php echo $errPrice; ?> </font></td>
			</tr>
			<tr height='36'>
				<td width="45" class="title_font"><div align="right">書號</div></td>
				<td width="312"><input class='InputClass' name="bookNo" type="text"
					id="bookNo" value="<?php echo $bookNo; ?>" size="6" /><font
					color='red' size='-1'><?php echo $errBookNo; ?> </font></td>
				<td width="52" class="title_font"><div align="right">出版社</div></td>
				<td width="161"><?php echo setSelectByOptionTag($pdo, "companyID", $companyID)  ?><font
					color='red' size='-1'><?php echo $errCompanyID; ?> </font></td>
			</tr>
			<tr height='120'>
				<td width="45" align="right" class="title_font">圖片</td>
				<td colspan='3'>
					<table border='0'>
						<tr>
							<td><img height='120' width='96'
								src='BookCoverImage.php?searchKey=<?php echo $bookID ?>' /></td>
							<td colspan='2'><input style="background: #FFFFFF"
								class='InputClass' type="file" name="uploadFile" size="40" /><font
								color='red' size='-1'><?php echo $errPicture; ?> </font></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr height='35'>
				<td colspan='4' align='center'><input name="bookID" type="hidden"
					id="bookID" value="<?php echo $bookID; ?>" /> <input type="button"
					name="update" value="修改" onclick='updateBook()' />
					&nbsp;&nbsp;&nbsp; <input type="button" name="delete" value="刪除"
					onclick="confirmDelete()" />
				</td>
			</tr>

		</table>
		<div id="insert">
			<a href="index.php">回瀏覽書籍</a> <br />
			<?php
			echo $errDBMessage;   // 顯示錯誤訊息
		 ?>
			<input type="hidden" name="MM_update" value="form1" />
		</div>
	</form>
	<p>&nbsp;</p>
</body>
</html>
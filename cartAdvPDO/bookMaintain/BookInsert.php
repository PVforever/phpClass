<?php session_start(); ?>
<?php require_once('../Connections/conn.php'); ?>
<?php require_once('Book_CRUD_Main_Class_Dao.php'); ?>
<?php require_once('Book.php'); ?>
<?php
/* 
   程式功能：新增一筆記錄到book表格內。
   
     當瀏覽器第一次對本程式發出請求時，本程式會送回一個空白的表單
   讓使用者輸入資料。使用者輸入資料、按下『Submit』按鈕後，這些資
   料會再度送回到本程式(瀏覽器第二次對本程式發出請求)。
     此時，本程式會檢查使用者輸入的資料，如果有錯誤，送回原輸入資
   料與錯誤訊息，交由使用者修改。改完後，使用者再次按下『Submit』
   按鈕。這些資料會再度送回到本程式並進行新一輪的檢查。如果沒有錯
   誤，本程式會將這些資料寫入資料庫。
*/
// 下列六個變數將會用來存放使用者輸入的資料
// 如：$bookNo = $_POST['bookNo'];
$bookNo = "";
$companyID = "";
$title = "";
$author = "";
$price = "";
$photo = "" ;
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
$ok_insert = '';

// 此變數表示使用者輸入之資料是否正確無誤，預設值為1，表示正確無誤
$validData = 1;   

// ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1"))
// 可用來判斷瀏覽器是第1次對本程式發出HTTP請求，還是第2,3,4...次對
// 本程式發出HTTP請求。
// 
// "MM_insert"是本表單內的一個隱藏欄位，瀏覽器是第1次對本程式發出HTTP
// 請求時(注意：此時本程式會在Server端執行)瀏覽器不會送來此欄位，但是
// 當本程式產生回應給瀏覽器時，會送回含有名為 "MM_insert" 的隱藏欄位，
// 如 <input type="hidden" name="MM_insert" value="form1" />，
// 因此當瀏覽器第2,3,4...次對本程式發出HTTP請求，就會送出有此欄位。
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	// 表示使用者應該已經輸入了資料，接下來讀取這些輸入資料
	$bookNo = $_POST['bookNo'];
	$companyID = $_POST['companyID'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$price = $_POST['price'];
	// 開始檢查輸入資料
	if (empty($bookNo)) {  
	    // 找到一個錯誤了
		$errBookNo = '必須輸入書號';
		$validData = 0;  // 表示至少有一份資料不正確
	}
	if (empty($companyID)) {
		$errCompanyID = '必須輸入代號';
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
	// $_FILES["uploadFile"]["error"]錯誤代號的含義：
	// http://php.net/manual/en/features.file-upload.errors.php
	if ($_FILES["uploadFile"]["error"] > 0)   {  // 表示上傳資料出問題
		$validData = 0;		
		if  ($_FILES["uploadFile"]["error"] == 4)  {
        	$errPicture = '您未挑選圖片檔';
		}  else {
			$errPicture = '檔案上傳失敗,' . $_FILES["uploadFile"]["error"];
		}
    } else  {  //上傳檔案沒有問題    	
        // file_get_contents():讀取圖片檔案的全部內容，然後以字串的形式傳回該內容。		
        $imageContent = file_get_contents($_FILES['uploadFile']['tmp_name']);
          
		// addslashes($imageContent):將字串$imageContent內的一些特殊字元
		// (例如', ", ) ... 等 )加以編碼，以免讓資料庫管理系統(DBMS)誤判程式的
		// 送出的 SQL命令
		//$data = mysql_real_escape_string($imageContent);  // 不要用此敘述
		//$data = addslashes($imageContent);
		// $_FILES["uploadFile"]["name"] : 圖片檔的檔名
		$fileName = $_FILES["uploadFile"]["name"];    
    }
    // 如果輸入的資料都正確
	if ($validData) { 
		try {
		// $insertSQL = "Insert Into book (bookID, title,  author,  price, companyID, image, BookNo ,CoverImage) values " .
		// " (null, ?, ?, ?, ?, ?, ?, ?) ";
    //     // 選擇要存取的資料庫
		// $pdoStmt = $pdo->prepare($insertSQL);
		// $pdoStmt->bindValue(1, $title, PDO::PARAM_STR);
		// $pdoStmt->bindValue(2, $author, PDO::PARAM_STR);
		// $pdoStmt->bindValue(3, $price, PDO::PARAM_STR);
		// $pdoStmt->bindValue(4, $companyID, PDO::PARAM_INT);
		// $pdoStmt->bindValue(5, $fileName, PDO::PARAM_STR);
		// $pdoStmt->bindValue(6, $bookNo, PDO::PARAM_STR);
		// $pdoStmt->bindValue(7, $imageContent, PDO::PARAM_LOB);
		
		// $pdoStmt->execute();

    //     // 請MySQL執行此 $insertSQL 命命 
		// $result = $pdoStmt->rowCount();
      $book = new Book(NULL, $author, $bookNo, $imageContent , 
      $fileName, $price, $title , $companyID);

      $bookDao = new BookDao();
      $result = $bookDao->save($book);
        if ($result==1) {
            // $pdoStmt->rowCount(); 取得執行先前之SQL命令所影響的紀錄個數
            // 1: 表示新增成功(有1筆紀錄)
            // 0: 表示新增失敗(有0筆紀錄)
            $_SESSION['Book_Message'] = '書籍新增成功';
            header('Location: index.php');   
            //   header('Location: BookList.php?pageNum_Recordset1=' . . '&totalRows_Recordset1=');
        } 
		} catch(PDOException $ex){
            
	            if ( strpos($ex->getMessage(), 'bookNo') != false ) {
                   $errBookNo = '書號已存在'; //此錯誤經常會出現，要單獨處理
	            } else {
         		  // 此為存取資料庫時發生其它的錯誤，如網路未開，....
		           $errDBMessage = '資料庫錯誤:' . $ex->getMessage() . ", Line= " . $ex->getLine() ;

	            }
            
        }
	}
} 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Hold不住購物商</title>
<link href="../style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function setFocus(fld) {
     document.getElementById(fld).focus();
}
</script>

</head>

<body onload="setFocus('title')" background="../img/bookMaintain.jpg">
<h3 align="center">書籍維護</h3>
<hr />
<br />

<br />
<!-- 上傳檔案時<form>標籤的 enctype屬性必須是 "multipart/form-data" -->
<form  id="form1" name="form1" method="post" 
       action="BookInsert.php"  enctype="multipart/form-data" >
  
<table  class="table_color" width="780" border="2" align="center" cellpadding="2" cellspacing="2" >
    <tr height='40'>
      <td colspan="4" align="center" valign="bottom"> 
          <font color='blue' size='+2'>新增書籍資料</font>
      </td>
    </tr>
    <tr height='36'>
      <td width="45" align="right" class="title_font">書名</td>
      <td colspan="3"> 
          <input name="title" class='InputClass' type="text" id="title" value="<?php echo $title; ?>" size="50" /><font color='red' size='-3'><?php echo $errTitle; ?></font>
      </td>
    </tr>
    <tr height='36'>
      <td width="45" align="right" class="title_font">作者</td>
      <td width="312" >     <input name="author"  class='InputClass'  type="text" id="author" value="<?php echo $author; ?>" size="26" /><font color='red' size='-3'><?php echo $errAuthor; ?></font></td>
      <td width="52" align="right" class="title_font">價格</td>
      <td width="161">
      <input name="price"  class='InputClass' type="text" id="price" value="<?php echo $price; ?>" size="3" /><font color='red' size='-3'><?php echo $errPrice; ?></font></td>
    </tr>
    <tr height='36'>
      <td width="45" class="title_font" ><div align="right">書號</div></td>
      <td width="312"><input class='InputClass' name="bookNo" type="text" id="bookNo" value="<?php echo $bookNo; ?>" size="6" /><Font color='red' size='-3'><?php echo $errBookNo; ?></Font></td>
      <td width="52" class="title_font" ><div align="right">出版社</div></td>
      <td width="161"><?php echo getSelectTag($pdo, "companyID")  ?>
      <font color='red' size='-3'><?php echo $errCompanyID; ?></font></td>
    </tr>
    <tr height='36'>
      <td width="45" align="right" class="title_font">圖片</td>
      <td colspan="3"><input style="background:#FFFFFF" class='InputClass'  type="file" name="uploadFile" size="40" /><font color='red' size='-3'><?php echo $errPicture; ?> </font></td>
    </tr>
    <tr height="36" >
      <td height="61" colspan="6" align="center">
         <font color='red' size='-3'><?php echo $errDBMessage; ?></font><br/> 
         <input type="submit" name="Submit" value="新增" />
      </td>
    </tr>
  </table>
  <div id="insert">
          <a href="index.php">回瀏覽書籍</a>   
  <input type="hidden" name="MM_insert" value="form1" />
  </div>
</form>
<p>&nbsp;</p>
</body>
</html>
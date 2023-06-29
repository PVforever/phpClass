<?php 
/* 
  // 程式功能: 
  //  1. 顯示所有書籍(商品)資訊，書籍資訊以分頁的方式顯示，每頁顯示四筆書籍。
  //     使用者可以按下『第一頁』、『前一頁』、『下一頁』與『最後頁』逐頁地
  //     瀏覽商品。
  //  2. 提供『新增書籍』資料、『修改書籍資料』與『刪除某本書籍』的功能。
  //     
  //  3. 當使用者要新增某本書籍資料時，直接按下右上角『新增書籍』的超連結便可
  //     進入『新增書籍資料』的畫面(由BookInsert.php提供)，輸入新的書籍資料。
  //     當使用者要修改某本書籍資料時，可直接點選該本書籍的『書名』超連結，便
         可進入『更新書籍資料』的畫面(由BookUpdate.php提供)，可對該本書籍進行
         資料修改或刪除紀錄。
*/
/*
   有些資料屬於動態內容，不應該被瀏覽器暫存到硬碟上的記憶體。
   避免瀏覽器或Proxy Server暫存(Cache)資料，我們可在程式中使用下列敘述
*/
//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  // 指定到期日
//header("Cache-Control: no-cache, must-revalidate"); 
//session_cache_limiter('nocache');        // 告知瀏覽器不要cache資料
session_start(); 
?>
<?php require_once('../Connections/conn.php'); ?>
<?php require_once('Book_CRUD_Main_Class_Dao.php'); ?>
<?php

$bookDao = new BookDao();

$currentPage = $_SERVER["PHP_SELF"];
$maxRows = 4;    // 每頁顯示四筆記錄
$pageNum = 0;    // 將要顯示哪一頁的資料(0表示第一頁)

// 設定一個SESSION變數BookListMaxRows，內容為每頁至多顯示之記錄數，
// 其他程式需要此資料。
$_SESSION['BookListMaxRows'] = $maxRows ;

if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow = $pageNum * $maxRows;    // 算出將要顯示的分頁是由哪一筆開始(0表示第一筆)


// 算出總共有多少筆商品的SQL敘述，Book表格的總紀錄筆數
// 如果外界有透過GET方法傳入totalRows(表格的總紀錄筆數)
if (isset($_GET['totalRows'])) {
  $totalRows = $_GET['totalRows'];
} else {
	// 否則到資料庫讀取『Book表格的總紀錄筆數』，
	// 放到變數 $totalRows內
	$totalRows  = count($bookDao->findAll()) ;
}
// 計算有幾頁(Page) 0 表示有1頁，1 表示有2頁，
// 例如：有15筆記錄，每頁3筆, 總共5頁($totalPages的值為4)
$totalPages = ceil($totalRows/$maxRows)-1;  // 

$queryString_Recordset1 = "&totalRows=$totalRows";
?>
<!DOCTYPE html >
<html>
<head>
  <meta charset="utf-8" />
  <title>Hold不住購物商城</title>
  <link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body  background="../img/bookMaintain.jpg" >
  <h3 align="center">瀏覽書籍</h3>
  <hr />
<br>
<div align='center'>
<table border="0">
  <tr>
    <td width='76'>
    </td>
    <td width='76'>
       <?php if ($pageNum > 0) { // 如果目前顯示的不是第一頁 ?>
          <div id="blfirst">
          <!-- 第一頁 -->
           <a href="<?php echo("$currentPage?pageNum=0$queryString_Recordset1"); ?>">第一頁</a>         
        </div>
        <?php }  ?>
    </td>
    <td width='76'><?php if ($pageNum > 0) { // 如果目前顯示的不是第一頁 ?>
        <div id="blprev">
        <!-- 前一頁 -->       
           <a href="<?php
                       $pm =  $pageNum - 1;  
                       echo("$currentPage?pageNum=$pm$queryString_Recordset1"); 
                    ?>">前一頁
           </a>                    
        </div>
        <?php }  ?>
    </td>
    <td width='76'><?php if ($pageNum < $totalPages) { // Show if not last page ?>
        <div id="blnext">
        <!-- 下一頁 -->
           <a href="<?php 
                      $pm =  $pageNum + 1;             
                      echo ("$currentPage?pageNum=$pm$queryString_Recordset1"); 
                    ?>">下一頁
           </a>
        </div>
        <?php }  ?>
    </td>
    <td width='76'><?php if ($pageNum < $totalPages) { // 如果目前顯示的不是最後一頁  ?>
        <div id="bllast">
        <!-- 最後頁 -->
           <a href="<?php 
                 echo ("$currentPage?pageNum=$totalPages$queryString_Recordset1"); ?>">最後頁
           </a>
        </div>
          <?php }  ?>
    </td>
    <td width='76'>
    </td>
    <td>
       <a href="BookInsert.php">新增紀錄</a>          
    </td>
  </tr>
</table>
</div>
<br>

<table  class="table_color" width="720" border="2" align="center" cellpadding="2" cellspacing="2" >
  <tr height='32' class="title_font">
    <td width="60"><div align="center">流水號</div></td>
    <td width="220"><div align="center">書名</div></td>
    
    <td width="100"><div align="center">作者</div></td>
   
    <td width="42"><div align="center">單價</div></td>
     
    <td width="80"><div align="center">出版社</div></td>
    
    <td width="64"><div align="center">圖片</div></td>
    
    <td width="80"><div align="center">書號</div></td>
  </tr>
  <?php 
    //  $query_all_records  = "SELECT b.*, bc.name  FROM book b join bookcompany bc on b.companyID = bc.id";
    //  $query_limit_records = $query_all_records  . " LIMIT " . $startRow . "," . $maxRows;
       
     // 由資料庫中讀取LIMIT所限制的所有記錄，放入變數$result內
     // $result = $pdo->prepare($query_limit_records);
     // $result->execute();  //沒有需要提供給$PDOStatement的參數
     $arr2D = $bookDao->findWithinRange($startRow, $maxRows);
     foreach($arr2D as $row){ ?>
       <tr>  
         <td><?php echo $row['bookID']; ?></td> 
         <td><a href="BookUpdate.php?bookID=<?php echo $row['bookID'] . '&title=' . $row['title']; ?>"><?php echo $row['title'];  ?></a></td>
         <td><?php echo $row['author']; ?></td>
         <td><?php echo $row['price']; ?></td>
         <td width="100"><?php echo substr($row['name'], 0, 12); ?></td>
         <?php
          $image = $bookDao->findImageById($row['bookID']);
         ?>
        
     <!--  
      <img src="此屬性可以是一張圖片的URL或是一個可以送回一張圖片的PHP程式,
                需要傳入圖片的識別鍵值(即圖片所屬紀錄的Primary Key)"   ...>
       -->
         <td>
            <img src="BookCoverImage.php?searchKey=<?php echo $row['bookID']; ?>" width="48" height="64" alt="" />
            <!-- <img src="<?php echo $image; ?>" width="48" height="64" alt="" /> -->
         </td>
         <td ><?php echo $row['bookNo']; ?></td>
       </tr> 
      <?php } 	?>
</table>

<br>
<div align='center'>
		<a href='../index.php'>回前頁</a>
</div>

   <!-- 顯示執行的結果  -->      
<div id="message">
    <?php 
        if (isset($_SESSION['Book_Message'])) {
			echo  $_SESSION['Book_Message'];
			unset($_SESSION['Book_Message']);				
		} 
    ?>
</div>		  
</body>
</html>
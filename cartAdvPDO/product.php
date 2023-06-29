<?php 
    require_once('Connections/conn.php'); 
    require_once('Connections/menu.php'); 
    require_once('bookMaintain/Book_CRUD_Main_Class_Dao.php');
  // product.php 程式功能: 
  //  1. 依據瀏覽器送來商品代號bookID到資料庫中讀出對應的商品，然後將該項商品
  //     的相關資訊組合在一個表格內，送回給瀏覽器，由使用者檢視該項商品的詳細
  //     資料，以便決定是否要購買。
  //  2. 若使用者決定要購買該項商品，便可按下『加入購物車』按鈕時，瀏覽器會將
  //     資料(三個隱藏欄位)收集起來，送交給Server端的addtocart.php程式

  $bookDao = new BookDao();

  $producID = "-1";
// 如果瀏覽器有送來bookID
if (isset($_GET['bookID'])) {
  $producID = $_GET['bookID']; // 讀取前端瀏覽器送來的 bookID
}
// 讀取特定producID的記錄，並將紀錄放入變數 $row_product
$row_product = $bookDao->findById($producID);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo SYSTEM_NAME; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body background="img/wireart.png">
<h3 align="center">購物車</h3>
<hr />
<br />
<p />
<!-- 
   當按下『加入購物車』按鈕時，瀏覽器會將表單內的資料收集起來，
   包括 書名(title), 價格(price), 商品編號(bookID)，
   送交給Server端的addtocart.php程式  
-->
<form  method="post"  action="addtocart.php">
  
<table  class="table_color" width="600" border="2" align="center" cellpadding="2" cellspacing="2" >
    <tr height='30'>
      <td width="85" align="right" class="title_font">書名</td>
      <td>
          <?php echo $row_product['title']; ?>
          <!-- 隱藏欄位 -->
          <input name="title" type="hidden" id="title" value="<?php echo $row_product['title']; ?>" /></td>
    </tr>
    <tr>
      <td width="85" align="right" class="title_font">作者</td>
      <td><?php echo $row_product['author']; ?></td>
    </tr>
    <tr>
      <td width="85" align="right" class="title_font">價格</td>
      <td>
      <?php echo $row_product['price']; ?>
      <!-- 隱藏欄位 -->
      <input name="price" type="hidden" id="price" value="<?php echo $row_product['price']; ?>" /></td>
    </tr>
    <tr>
      <td width="85" align="right" class="title_font">圖片</td>
      <td><img src="bookMaintain/BookCoverImage.php?searchKey=<?php echo $row_product['bookID']; ?>" width="120" height="160" alt="" /></td>
    </tr>
    
    <tr height="36" >
      <td colspan="2" align="center">
        <!-- 隱藏欄位 -->
        <input name="bookID" type="hidden" id="bookID" value="<?php echo $row_product['bookID']; ?>" />        
        <input type="submit" name="Submit" value="加入購物車" />
      </td>
    </tr>
  </table>
</form>

</body>
</html>
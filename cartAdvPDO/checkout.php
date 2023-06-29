<?php
   // checkout.php
   session_start(); 
   require_once('Connections/conn.php');
   require_once('Connections/menu.php');
// 將本程式的名稱放入 $thisForm
$thisForm = $_SERVER['PHP_SELF'];
// 下列條件如果成立表示第二次執行本程式
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  // 準備導向 purchase.php
  $insertGoTo = "purchase.php";
 
  // 正式導向 purchase.php
  header("Location: $insertGoTo");
  // 如果第二次執行本程式，程式到此結束
}
  // 如果第一次執行本程式
  	if(!isset($_SESSION['OrderID'])) {
	    // 產生訂單編號
		$_SESSION['OrderID'] = date("YmdHis") . substr(md5(uniqid(rand())), 0, 5);
  	} 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo SYSTEM_NAME; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body  background="img/wireart.png">
<h3 align="center">購物車</h3>
<hr />
<br />
 
<p/>	 
<form id="form1" name="form1" method="post" action="<?php echo $thisForm; ?>">
<table  class="table_color" width="720" border="2" align="center" cellpadding="2" cellspacing="2" >
    <tr height='40'>
      <td colspan="5">您購買的商品如下，請確認</td>
    </tr>
    <tr class="title_font" height='32'>
      <td width='100'><div align="center">商品編號</div></td>
      <td width='240' ><div align="center">商品名稱</div></td>
      <td width='100' ><div align="center">商品單價</div></td>
      <td width='100' ><div align="center">訂購數量</div></td>
      <td width='100' ><div align="center">小計</div></td>
    </tr>
  <?php foreach($_SESSION['Cart'] as $i => $val){ ?>    
    <tr height='30'>
      <td width='100' ><div align="center"><?php echo $_SESSION['Cart'][$i]; ?></div></td>
      <td width='240' ><div align="left">
          <?php echo $_SESSION['Name'][$i]; ?>
          <input name="D_PName[]" type="hidden" value="<?php echo $_SESSION['Name'][$i]; ?>" />
      </div></td>
      <td><div align="right">
          <?php echo number_format($_SESSION['Price'][$i]); ?>&nbsp;&nbsp;
          <input name="D_PPrice[]" type="hidden" value="<?php echo $_SESSION['Price'][$i]; ?>" />
      </div></td>
      <td><div align="right">
          <?php echo number_format($_SESSION['Quantity'][$i]); ?>&nbsp;&nbsp;
          <input name="D_PQuantity[]" type="hidden" value="<?php echo $_SESSION['Quantity'][$i]; ?>" />
      </div></td>
      <td><div align="right">
          <?php echo number_format($_SESSION['itemTotal'][$i]); ?>&nbsp;
          <input name="D_ItemTotal[]" type="hidden" value="<?php echo $_SESSION['itemTotal'][$i]; ?>" />
      </div></td>
    </tr>
  <?php } ?>    
    <tr height='32'>
      <td colspan="5"><div align="right"> 總金額：<?php echo number_format($_SESSION['Total']); ?>&nbsp;</div></td>
    </tr>
    <tr height='32'>
      <td colspan="5"><div align="center">
          <input type="submit" name="Submit" value="再次確認" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</body>
</html>
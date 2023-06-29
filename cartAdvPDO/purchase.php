<?php 
   session_start(); 
   // purchase.php 程式功能:
   // 1.當購買者確定購買所訂購的商品後，將由本程式提供輸入購買者基本資料的畫面，
   //   讓購買者輸入資本資料
   // 2.當購買者按下Submit按鈕後，資料會送交到本程式，由本程式寫入orders表格。

   require_once('Connections/conn.php');
   require_once('Connections/menu.php'); 
   require_once('bookMaintain/Book_CRUD_Main_Class_Dao.php');
   require_once('orderMaintain/Order_CRUD_Main_Class_Dao.php');
   require_once('orderMaintain/Order.php');
   require_once('orderMaintain/OrderDetail.php');

$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {
	$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$name = "";
$phone = "";
$addr = "";
$email = "";
$total = "";
$nameError = "";	// 存放未輸入姓名時的錯誤訊息
$phoneError = "";	// 存放未輸入電話時的錯誤訊息
$addrError = "";	// 存放未輸入地址時的錯誤訊息
$hasError = false;
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	// 檢查輸入的客戶基本資料
	$name = trim($_POST['O_CName']);
	$addr = trim($_POST['O_CAddr']);
	$phone = trim($_POST['O_CPhone']);
	$email = trim($_POST['O_CEmail']);
	$total = trim($_POST['O_Total']);
	if ( empty($name) ){
		$nameError = "姓名欄不能是空白";
		$hasError = true;
	}
	if ( empty($phone) ){
		$phoneError = "電話欄不能是空白";
		$hasError = true;
	}
	if ( empty($addr) ){
		$addrError = "地址欄不能是空白";
		$hasError = true;
	}
	$orderDao = new OrderDao();
	$bookDao  = new BookDao();
	if (!$hasError) {
		// 確定訂單編號
		while (true){
			$OrderID = date("YmdHis") . substr(md5(uniqid(rand())), 0, 5);
			$num = $orderDao->findByOrderId($OrderID);
			if ($num == 0){
				break;
			}
		}
		$_SESSION['DD'] = $OrderID ;
		try {
			// 啟動交易
			$orderDao->getPdo()->beginTransaction();
			
			$order = new Order($OrderID, $name, $addr, $phone, $email, $total);
			// 寫入訂單主檔
			$num = $orderDao->saveOrder($order);
			// 寫入訂單明細檔
			foreach($_SESSION['Cart'] as $i => $val){
				$D_PNo 			= $_SESSION['Cart'][$i];
				$D_PName		= $_SESSION['Name'][$i];
				$D_PPrice		= $_SESSION['Price'][$i];
				$D_PQuantity	= $_SESSION['Quantity'][$i];
				$D_PitemTotal	= $_SESSION['itemTotal'][$i];

				$orderDetail = new OrderDetail(NULL, $OrderID, $D_PNo, $D_PName,
				               $D_PPrice, $D_PQuantity, $D_PitemTotal);
				$num = $orderDao->saveOrderDetail($orderDetail);
			}
			$orderDao->getPdo()->commit();
			$_SESSION['InsertMessage'] = '訂單新增成功<br>';
		} catch(PDOException $ex){
			echo "存取資料庫疵發生錯誤，訊息:" . $ex->getMessage() . "<br>";
			echo "行號:" . $ex->getLine() . "<br>";
			$orderDao->getPdo()->rollback();
			$_SESSION['InsertMessage'] = '資料異動發生錯誤，執行rollbck() <br>訊息:' .
			       $ex->getMessage() . "行號:" . $ex->getLine() . "<br>";
		}		
		//session_destroy();   // session_destroy(): 刪除$_SESSION陣列內的所有元素
		if (isset($_SESSION['Cart'])) {
			unset($_SESSION['Cart']);
			unset($_SESSION['Name']);
			unset($_SESSION['Price']);
			unset($_SESSION['Quantity']);
			unset($_SESSION['itemTotal']);
		}
		$insertGoTo = "list.php";
		header(sprintf("Location: %s", $insertGoTo));
	}
}
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
	<p />
	<form action="<?php echo $editFormAction; ?>" id="form1" name="form1"
		method="post">

		<table class="table_color" width="700" border="2" align="center"
			cellpadding="2" cellspacing="2">
			<tr height='32'>
				<td colspan='2' align="left" class="title_font">請輸入下列資料:</td>
			</tr>
			<tr>
				<td width="90" align="right" class="title_font">姓 名</td>
				<td><input name="O_CName" type="text" id="O_CName"
					value="<?php echo $name ;?>" /> <font color='red' size='-2'><?php echo $nameError ;?>
				</font>
				</td>
			</tr>
			<tr height='32'>
				<td width="90" align="right" class="title_font">電 話</td>
				<td><input name="O_CPhone" type="text" id="O_CPhone"
					value="<?php echo $phone ;?>" /> <font color='red' size='-2'><?php echo $phoneError ;?>
				</font>
				</td>
			</tr>
			<tr height='32'>
				<td width="90" align="right" class="title_font">Email</td>
				<td><input name="O_CEmail" type="text" id="O_CEmail"
					value="<?php echo $email ;?>" />
				</td>
			</tr>
			<tr height='32'>
				<td width="90" align="right" class="title_font">住 址</td>
				<td><input name="O_CAddr" type="text" id="O_CAddr" size="60"
					value="<?php echo $addr	 ;?>" /> <font color='red' size='-2'><?php echo $addrError ;?>
				</font> <input name="O_OrderID" type="hidden" id="O_OrderID"
					value="<?php echo $_SESSION['OrderID']; ?>" /> <input
					name="O_Total" type="hidden" id="O_Total"
					value="<?php echo $_SESSION['Total']; ?>" />
				</td>
			</tr>
			<tr height='32'>

				<td colspan="2"><div align="center">
						<input type="submit" name="Submit" value="送出" />
					</div></td>
			</tr>
		</table>
		<input type="hidden" name="MM_insert" value="form1" />
	</form>
</body>
</html>
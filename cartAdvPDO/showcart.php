<?php session_start(); ?>
<?php 
   require_once('Connections/conn.php');
   require_once('Connections/menu.php'); 
// showcart.php 程式功能: 
//       1 顯示購物車的內容
//       2 更新購物車內商品的數量
//
//  1. 本程式會顯示購物車目前的內容，同時提供修改購物車內商品的數量。如果將
//     數量改為小於或等於 0，該項商品將會由購物車內移除。
//  2. 位於購物車內的每一項商品會顯示它的流水號、書名、單價、數量、小計(單價
//     乘數量)，使用者可以修改數量欄位，按下『更新』按鈕後，購物車內所有
//     商品的數量會以陣列的形式，再度送回本程式(放在變數 $_POST['Modify'])。
//     因此，本程式有兩項功能
//      
//  3. $_POST['Modify'] 為陣列，可用 print_r($_POST['Modify']); 來觀察其內容
//  4. 若使用者按下『結帳』按鈕，則瀏覽器會送出要求執行checkout.php的請求
          
// 
// 將瀏覽器送來的所有購物車內商品的數量資料($_POST['Modify'])
// 依序存入陣列$_SESSION['Quantity']中。
// 只有按下『更新』按鈕後，$_POST['Modify'] 才會存在。
	if (isset($_POST['Modify'])){    
		foreach($_SESSION['Quantity'] as $i => $val){
			$_SESSION['Quantity'][$i]= $_POST['Modify'][$i];
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

<body   background="img/wireart.png">
<h3 align="center">購物車內容</h3>
<hr />
<br />
<p/>
<form id="form1" name="form1" method="post" action="showcart.php">
<table  class="table_color" width="720" border="2" align="center" cellpadding="2" cellspacing="2" bordercolorlight=#FFFFFF bordercolordark="#330033">
    <tr class="title_font" height='32'>
      <td align='center' width='88'>流水號</td>
      <td align='center' width='280'>書名</td>
      <td align='center' width='48'>單價</td>
      <td align='center' width='64'>數量</td>
      <td align='center' >小計</td>
    </tr>
    <?php $_SESSION['Total'] = 0; ?>
    <?php 
	    // 下面的程式碼去除數量為0或負數的商品
	    if (isset($_SESSION['Cart']) ){
		   for($i = count($_SESSION['Cart'])-1 ; $i >=0;  $i--){ 
    	      if ($_SESSION['Quantity'][$i] <= 0) {
                 array_splice($_SESSION['Cart'], $i, 1);
                 array_splice($_SESSION['Name'], $i, 1);
                 array_splice($_SESSION['Quantity'], $i, 1);
                 array_splice($_SESSION['Price'], $i, 1);
				 array_splice($_POST['Modify'], $i, 1);
              }
          }
		}
    ?>
    <?php
     if (isset($_SESSION['Cart']) ){ // 如果有購買商品
	     // foreach迴圈取出購物車內的資料
       foreach($_SESSION['Cart'] as $i => $val){ ?>
         <tr height='30'>
            <td align="center"><?php echo $_SESSION['Cart'][$i]; ?></td>
            <td><?php echo $_SESSION['Name'][$i]; ?></td>
            <td align="right"><?php echo $_SESSION['Price'][$i]; ?></td>
            <td align="right"><input class="rightAligned" 
                 name="Modify[]" type="text" 
                 value="<?php echo $_SESSION['Quantity'][$i]; ?>" 
                 size="5" /></td>
            <td align="right">
         	  <?php //計算小計與總金額，同時顯示小計
            	$_SESSION['itemTotal'][$i] 
				        = $_SESSION['Price'][$i] * $_SESSION['Quantity'][$i];
				      echo number_format($_SESSION['itemTotal'][$i]);
         		  $_SESSION['Total'] += $_SESSION['itemTotal'][$i];
        	  ?></td>
         </tr>
      <?php 
	      } // foreach迴圈結束
	   } else {  //  未挑選任何商品
		    echo "<TR height='32'><TD colspan='5'><font color='#FF0000'>您尚未挑選任何商品</FONT></TD></TR>"; 
     }
	?>
    <tr  height='32'>
      <td colspan="5"> <div align="right">總計 : <?php echo number_format($_SESSION['Total']);?> </div></td>
    </tr>
    <tr>
      <td colspan="5"><div align="right">
        <?php 
		   if ($_SESSION['Total'] > 0) {  // 如果總金額 > 0, 顯示『更新』與『結帳』兩個按鈕是可以被按下
			     echo '<input type="image" name="imageField" id="imageField" src="img/update.png" />';
				   echo '&nbsp;&nbsp;';
			     echo '<a href="checkout.php "><img src="img/pay.png" width="61" height="24" border="0" /></a>';
		   } else {  // 否則『更新』與『結帳』兩個按鈕不能被按下
			     echo '<img src="img/update.png" />';
   				 echo '&nbsp;&nbsp;';
	   		   echo '<img src="img/pay.png" width="61" height="24" border="0" />';
		   }
		   ?>        
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
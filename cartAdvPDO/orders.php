<?php 
require_once('Connections/conn.php');
require_once('Connections/menu.php');
require_once('orderMaintain/Order_CRUD_Main_Class_Dao.php');

  //  orders.php 程式功能: 
  //  1. 本程式顯示所有的訂單的資訊(訂單編號、訂購者、日期、訂單金額)，
  //     點選訂單編號，可以看到訂單的詳細內容，orderdetail.php會顯示
  //     單筆訂單的內容。 
$orderDao = new OrderDao();
$orders = $orderDao->findAllOrdersByOrderId();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo SYSTEM_NAME; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body  background="img/wireart.png">
<h2 align="center"><?php echo SYSTEM_NAME; ?></h2>
<h3 align="center">訂單總覽</h3>
<hr />
<br />

<p />
<table  class="table_color" width="600" border="2" align="center" cellpadding="2" cellspacing="2" >
  <tr class="title_font" height='30'>
    <td align="center"> 訂單編號</td>
    <td align="center">訂購者</td>
    <td align="center">日期</td>
    <td align="center">金額</td>
</tr>
  <?php foreach ($orders as $row_rs_orders) { ?>
    <tr height='32'>
      <td><a href="orderdetail.php?OrderID=<?php echo $row_rs_orders['O_OrderID']; ?>"><?php echo $row_rs_orders['O_OrderID']; ?></a></td>
      <td><?php echo $row_rs_orders['O_CName']; ?></td>
      <td><?php echo $row_rs_orders['O_Date']; ?></td>
      <td align='right'><?php echo $row_rs_orders['O_Total']; ?></td>
    </tr>
    <?php }  ?>
</table>
</body>
</html>
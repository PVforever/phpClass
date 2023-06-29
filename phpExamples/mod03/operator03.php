<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>mod03/operator03.php</title>
  </head>
  <body>
    <?php              
	  $subtotal = 100 ;            // 未稅金額
	  $tax = $subtotal * 0.05 ;    // 營業稅
	  $total = $tax + $subtotal ;  // 含稅金額
	  echo "總金額(含稅)= $total <br>"  ;
    ?>

</body> 
</html>
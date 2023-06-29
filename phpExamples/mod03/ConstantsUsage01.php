<?php
//          require_once "C:\MAMP\htdocs\example\ch03\constants.php";
//          require_once dirname(__FILE__) . "/constants.php";
         require_once "constants.php";
?>
<!DOCTYPE html>         
<html>
  <head>
     <meta charset='utf-8'>
     <title>ConstantsUsage01</title>
  </head>
  <body>
    <?php
         $amt = 100; 
         echo "未稅金額 $" . $amt ." 營業稅: $" . $amt * VAT . NL;
         echo "總金額為 $" . $amt * (1+VAT) . NL ;
         echo '謝謝惠顧' . NL;
    ?>
   </body> 
</html>

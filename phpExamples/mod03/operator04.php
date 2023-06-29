<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>mod03/operator04.php</title>
  </head>
  <body>
    <?php            
	  $sum = 0;             // 存錢筒 = 0;
	  $y   = 20;            // 昨天有零錢 20元; 
	  $sum += $y;           // 放入存錢筒內;
	  $x   = 50;            // 今天有零錢 50元;
	  $sum +=  $x;          // 放入存錢筒內;
	  echo "存錢筒現有 $sum <br>"  ;
    ?>

</body> 
</html>
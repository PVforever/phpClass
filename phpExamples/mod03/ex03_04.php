<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>練習ex03_04</title>
  </head>
  <body>
    <?php
         $x1 = rand(1, 10);
         $x2 = rand(1, 10);
         $x3 = rand(1, 10);
         echo "三個亂數為  $x1, &nbsp; &nbsp; $x2,  &nbsp; &nbsp; $x3 <br><br>";
         $egg = 59;
         $d  = $egg / 12 ;
         $r  = $egg % 12 ;
         echo "$egg 個雞蛋是  " . floor($d) . " 打，又 $r 個<br>";
    ?>
   </body> 
</html>

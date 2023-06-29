<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>ch04/if01.php</title>
  </head>
  <body>
    <?php
        $num = rand(1, 100) ;
        if ($num % 2 ==0){   // 除以 2，如果餘數為 0 
           echo  " $num 為偶數<br> ";
        } else {
           echo  " $num 為奇數<br> ";
        }
    
    ?>
   </body> 
</html>
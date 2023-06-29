<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>ch04 function</title>
  </head>
  <body>
  <?php
    
    $no = rand(1, 10) ;    
    echo "數字=" . $no ."<br>" ;
    if( $no % 2 == 0  ){       // 如果 $score 等於 0  
    	die('亂數是偶數，程式立刻停止');
    }
    for($n=1; $n <= $no; $n++){
    	echo "Hello, World!  $n <br>";
    }

   ?>
   </body> 
</html>
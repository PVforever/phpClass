<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>ch04 function</title>
  </head>
  <body>
  <?php
    
    $str = " ABCD  " ;    
    echo '字串 $str的長度=' . strlen($str) ."<br>" ;
    echo '字串 trim($str)的長度=' . strlen(trim($str)) ."<br>" ;
    echo "<p>" ;
    echo "***" . $str ."***<br>" ;
    echo "***" . trim($str) ."***<br>" ;

   ?>
   </body> 
</html>
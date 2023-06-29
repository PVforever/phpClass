<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>ch04 function</title>
  </head>
  <body>
  <?php
    echo "<hr>";
    echo "位元組的個數:(在UTF-8編碼下，中文字佔三個位元組)<br>";
    $str0 = 123.1 ;    
    echo "字串{$str0}的長度=" . strlen($str0) ."<br>" ;
    $str1 = "abc";    
    echo "字串{$str1}的長度=" . strlen($str1) ."<br>" ;
    $str1 = "張君雅";
    echo "字串{$str1}的長度=" . strlen($str1) ."<br>" ;
    $str2 = "  123 "  ;
    echo "字串{$str2}的長度=" . strlen($str2) ."<br>" ;
    echo "<hr>";
    echo "符號的個數:<br>";
    $str0 = 123.1 ;
    echo "字串{$str0}的長度=" . mb_strlen($str0) ."<br>" ;
    $str1 = "abc";
    echo "字串{$str1}的長度=" . mb_strlen($str1) ."<br>" ;
    $str1 = "張君雅";
    echo "字串{$str1}的長度=" . mb_strlen($str1) ."<br>" ;
    $str2 = "  123 "  ;
    echo "字串{$str2}的長度=" . mb_strlen($str2) ."<br>" ;
    echo "<hr>";
   ?>
   </body> 
</html>
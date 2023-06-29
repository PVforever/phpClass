<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>ch04 function</title>
  </head>
  <body>
    <?php
      $a = "test";
      echo isset($a); // true
      unset($a);
      echo isset($a); // false
    ?>
  </body> 
</html>
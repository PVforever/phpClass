<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>mod05/array04.php</title>
  </head>
  <body>
<?php
   $x['pinky'] = "com";
   $x['kitty'] = "gov";
   $x['lucky'] = "net";
   $x['micky'] = "tw";
   foreach ($x as $key => $value) {
      echo "$key, $value <br>";
   }
   echo "<hr>";
   $a = array('aaa'=>'value1', 'ddd'=>"value2", "000"=>987, "qqq"=>3.14);
   foreach ($a as $key => $value) {
      echo "$key, $value <br>";
   }
   echo "<hr>";

?>
</body> 
</html>

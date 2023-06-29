<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>mod05/array03.php</title>
  </head>
  <body>
<?php
    $x[252] = "com";
    $x[20] = "gov";
    $x[100] = "net";
    $x["snoopy"] = "tw";
    print_r($x);
    echo "<hr>";
    foreach ($x as $value) {
       echo "$value <br>";
    }
    echo "<hr>";
    foreach ($x as $key => $value) {
       echo "$key,  $value <br>";
    }
    $y[] = 'snoopy';
    $y[] = 'micky';
    $y[] = 'kitty';
    echo "<hr>";
    foreach ($y as $key => $value) {
       echo "$key,  $value <br>";
    }
?>
</body> 
</html>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>顯示商品資訊</title>
</head>
<body>
    <?php
      $path = $_SERVER["PHP_SELF"];
      echo $path . '<br>';
      echo basename($path).'<br>';
      echo basename($path, '.php').'<br>';
      echo "<hr>";
      $fn = "/test/asdf/readme.txt" ; 
      echo basename($fn).'<br>';
      echo basename($fn, '.txt').'<br>';
      
    ?>
  </body>
</html>

<!DOCTYPE html>
<html>
<head>
<link href="style2.css" rel="stylesheet" type="text/css" />
<meta charset="UTF-8">
<title>PHP 範例</title>
</head>
<body>
<?php
   $arr = array(10, 29, 30, 44,55);
   $n = indexof(20, $arr);
   echo "n=$n<br>";

   function indexOf($needle, $haystack) {
    foreach ($haystack as $i => $value) { 
            if ($value == $needle) {
                return $i;             
            }
    }
    return -1;
 }
?>
</body>
</body>
</html>

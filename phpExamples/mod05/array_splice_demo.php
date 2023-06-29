<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>mod05/array_splice.php</title>
</head>

<body>
<?php 
echo"由註標2開始，刪除1個元素<br>";
$aa = Array(123,345,10,25,34,49);
print_r($aa);
echo("<br>");
array_splice($aa, 2, 1);
print_r($aa);
echo("<hr>");

echo"由註標1開始，刪除3個元素，加入 888, 666 兩個元素<br>";
$aa = Array(123,345,10,25,34,49);
print_r($aa);
echo("<br>");
array_splice($aa, 1, 3, array(888, 666));
print_r($aa);
echo("<hr>");

echo"由註標2開始，刪除其後所有元素<br>";
$aa = Array(123,345,10,25,34,49);
print_r($aa);
echo("<br>");
array_splice($aa, 2);
print_r($aa);
echo("<hr>");

echo"由註標2開始，新增3元素111,222,333<br>";
$aa = Array(123,345,10,25,34,49);
print_r($aa);
echo("<br>");
array_splice($aa, 2, 0, array(111,222,333));
print_r($aa);
echo("<hr>");


?>
</body>
</html>

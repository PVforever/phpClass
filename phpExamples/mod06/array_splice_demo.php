<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>輸入基本資料</title>
</head>

<body>
<?php 
   echo"由註標2開始，刪除1個元素<BR>";
   $aa = Array(123,345,10,25,34,49);
   print_r($aa);
   echo("<BR>");
   array_splice($aa, 2, 1);
   print_r($aa);
   echo("<HR>");

   echo"由註標1開始，刪除3個元素，加入 888, 666 兩個元素<BR>";
   $aa = Array(123,345,10,25,34,49);
   print_r($aa);
   echo("<BR>");
   array_splice($aa, 1, 3, array(888, 666));
   print_r($aa);
   echo("<HR>");

   echo"由註標2開始，刪除其後所有元素<BR>";
   $aa = Array(123,345,10,25,34,49);
   print_r($aa);
   echo("<BR>");
   array_splice($aa, 2);
   print_r($aa);
   echo("<HR>");

   echo"由註標2開始，新增3元素111,222,333<BR>";
   $aa = Array(123,345,10,25,34,49);
   print_r($aa);
   echo("<BR>");
   array_splice($aa, 2, 0, array(111,222,333));
   print_r($aa);
   echo("<HR>");
?>

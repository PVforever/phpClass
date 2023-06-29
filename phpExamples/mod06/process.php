<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Untitled Document</title>
</head>

<body>
<p><?php echo trim($_POST['userName']); ?> 您好</p>
<p>您的Email(電郵)：<?php echo $_POST['email']; ?></p>
<p>您的IP：<?php echo $_SERVER['REMOTE_ADDR']; ?></p>
<p>性別：<?php 
if (  isset($_POST['sex'])  ) {  // 如果瀏覽器有傳送sex欄位的資料
   $gender = $_POST['sex'];      // 取出sex欄位的資料，放入變數$gender內
   if ($gender == 'F' ) {        // 如果$gender == 'F' 
	   echo "女性";               // 送出  "女性"
   } else if ($gender == 'M' ){  // 否則如果$gender == 'M' 
	   echo "男性";               // 送出  "男性" 
   }
} else {                         // 瀏覽器沒有傳送sex欄位的資料
   echo "未點選性別";             
}
?>
</p>
<p>嗜好：<?php 
if (  isset($_POST['hobby'])  ) {  // 如果瀏覽器有傳送hobby欄位的資料
   $hobby = $_POST['hobby'];       // 取出hobby欄位的資料，放入變數$hobby內
   $count = count($hobby);         // $hobby本身為一陣列，所以先取出它的元素個數
   for ($i=0; $i<$count;$i++){     // 用for()印出有挑選的元素
	    echo "<li>" . $hobby[$i] . "</li>";  
   }
} else {                          // 瀏覽器沒有傳送hobby欄位的資料
   echo "未挑選嗜好";             
}
?>

<br />

</body>
</html>
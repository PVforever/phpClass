<?php session_start(); ?>
<!DOCTYPE html>

<head>
<meta charset='utf-8'>
<title>Session Test</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="session_test.php">
  <label for="message">訊息：</label>
  <input type="text" name="message" id="message" />
  <br />
  <label for="button"></label>
  <input type="submit" name="button" id="button" value="Submit" />
  <br />
</form>
<a href='session_unset.php'>Session Unset</a><br>
<?php
    if (!isset($_SESSION['seqNo'])) { // 如果未設定Session變數 seqNo
		$_SESSION['seqNo'] = 0 ;      // 設定Session變數 seqNo 的值為 0 
	}
	// 如果 $_POST['message'] 的長度大於 0	
    if (isset($_POST['message']) && strlen($_POST['message']) > 0) {
    	$var = 'KEY_' . ++$_SESSION['seqNo']; 
    	$_SESSION["$var"] = $_POST['message'] ;  // 將 $_POST['message']的值存入 Session變數 $var內
	}

	echo "<hr>"; 
	echo "你輸入的資料有：<br>"; 	
	foreach ($_SESSION as $key => $value){
	   echo "識別字串:" . $key . "&nbsp;&nbsp;&nbsp;&nbsp;對應的訊息:" . $value . "<br>";
	}
?>
</body>
</html>

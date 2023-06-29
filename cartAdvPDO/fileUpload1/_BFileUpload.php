<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<Center>
<H3>本網頁會呼叫 _BUpload_file.php來處理上傳的資料</H3>
</Center>
<!--  上傳檔案的重點1 在此  -->
<form action="_BUpload_file.php" method="post" enctype="multipart/form-data"> 


<!--  上傳檔案的重點2 在此  -->
檔名：<input type="file" name="binaryFile" size='50' /> 
<br />
姓名：<input type="text" name="cname" /> <br />
地址：<input type="text" name="caddr" /> <br />
<br />
<input type="submit" name="submit" value="Submit" />
</form>



</body>
</html>

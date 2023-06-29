<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>檔案上傳</title>
</head>
<body>
<?php
print_r($_FILES["binaryFile"]);
echo $_SERVER['DOCUMENT_ROOT'] . "<hr>";
// "binaryFile"為Form標籤內之Input標籤的name屬性，即
// <input type="file" name="binaryFile" size='50' /> 
if ($_FILES["binaryFile"]["error"] > 0)   { // > 0 表示有錯誤
  echo "Error: " . $_FILES["binaryFile"]["error"] . "<br />";
} else  {
  // file_get_contents():讀取檔案的全部內容，然後以字串的形式傳回該內容。
  $fileData = file_get_contents($_FILES['binaryFile']['tmp_name']);
  // $savingDir : 儲存上傳檔案的資料夾，
  // $savingDir = "/images/smallPic";    // 相對於硬碟根目錄
  // $savingDir = "images/smallPic";     // 相對於本程式所在位置
  // 相對於伺服器的文件根目錄
  $savingDir = $_SERVER['DOCUMENT_ROOT'] . "images/BigPic";     
  
  // 若目錄不存在, 則建立之
  if (!file_exists($savingDir)) {
  	// 0777表示三個八進位數字(必須要在最前面加一個0)：第一個數字表示owner的
  	// 使用權限，第二個數字表示owner所屬群組的成員的使用權限與，第三個數字表示
  	// 剩下的其它人的使用權限。當此數字為1時，表示可以執行該檔案，此數字為2時，
  	// 表示可以寫資料到該檔案，此數字為4時，表示可以讀取該檔案。
  	// 7表示可執行、可寫、可讀。
  	mkdir($savingDir, 0777, true); 
  }
  $up_fileName = $_FILES["binaryFile"]["name"]; // 上傳檔的檔名
  $up_file = $savingDir . "/" . $up_fileName;
   // move_uploaded_file():將檔案搬移到指定的資料夾(即$up_file所指定的位置)
   // 傳回值為Boolean形態。$up_file必須包含資料夾與檔案名稱。
  $result = move_uploaded_file($_FILES["binaryFile"]["tmp_name"], $up_file);
  
}

  echo "<HR>";
  echo "傳案名稱: " . $_FILES["binaryFile"]["name"] . "<br />";
  echo "傳案類型: " . $_FILES["binaryFile"]["type"] . "<br />";
  echo "傳案大小: " .($_FILES["binaryFile"]["size"] / 1024)." Kb<br/>";
  echo "Server端的佔存位置: " . $_FILES["binaryFile"]["tmp_name"]. " <br />";
  
  echo "其它的欄位-姓名: " . $_POST["cname"]. " <br />";  
  echo "其它的欄位-地址: " . $_POST["caddr"]. " <br />";    
?> 

</body>
</html>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Open and Close Files</title>
</head>
<body>
    Quoted from "http://www.tutorialspoint.com/php/php_files.htm" <p/>
	The PHP fopen() function is used to open a file.
	<br> It requires two arguments stating first the file name
	and then mode in which to operate.
	<p>
		mode: r, r+, w, w+, a, a+<br>
<hr>
讀取檔案 /phpExample/mod11/_00_fopen_fclose/News.txt 然後將檔案內容送給瀏覽器   
<hr>		
<?php
echo '$_SERVER["DOCUMENT_ROOT"]=' . $_SERVER["DOCUMENT_ROOT"] . "<hr>";
$filename = $_SERVER["DOCUMENT_ROOT"] . "/phpExamples/mod11/_00_fopen_fclose/News.txt";
$fp = fopen ($filename , "r");
if ($fp) {
	$filesize = filesize( $filename );
	$filetext = fread( $fp, $filesize );
	fclose( $fp );
	echo  "檔案大小 : $filesize 位元組<br>" ;
	//加這個htmlspecialchars，可以把讀取內容的特殊符號轉成編碼，就能在讀取檔案時不會把寫在內部的其他功能呈現出來
	echo  "<pre>". htmlspecialchars($filetext) . "</pre>" ;
} else {
	echo "讀取檔案失敗";
}
?>
</p>
</body>
</html>

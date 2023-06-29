<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Reading text file line by line</title>
</head>
<body>
	<hr>
	由phpExamples/mod11/_01_readTextFile/Source.txt 逐列讀入文字，然後寫到
	phpExamples/mod11/_01_readTextFile/Source.out.
	<hr>				
<?php
$in = $_SERVER ["DOCUMENT_ROOT"] . 
			"/phpExamples/mod11/_01_readTextFile/Source.txt";
$out = $_SERVER ["DOCUMENT_ROOT"] .
			"/phpExamples/mod11/_01_readTextFile/Source.out";
			$fin  = fopen ( $in, "r" );
			$fout = fopen ( $out, "w" );
			if ($fin) {
				while ($line = fgets($fin)) {
					echo "讀到的資料";
					fwrite($fout, $line);
				}
				echo "檔案:$in 已成功寫出<br>";
			} else {
				echo "檔案:$in 不存在<br>";
			}
			fclose($fin);
			fclose($fout);
			?>
			</p>
			</body>
			</html>
			
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
</head>
<body>
<?php
	echo('Today is fine!<br>');			//<br> 為HTML標籤，會強制換行	
	echo('今天天氣很好！<br>');				// 字串可以包含中文和全形標點符號
	echo('Happy Birthday.\n<br>');		//\n 會直接顯示，不會被解譯為換行字元
	echo('Happy Birthday.\\n<br>');		//\\ 為逸脫字元，會被解譯為 \ 再顯示
	echo('My name is \'Mary\'.<br>');	//\' 為逸脫字元，會被解譯為 ' 再顯示
	echo('My name is "Mary".<br>'); 	//" 會直接顯示，不會被視為非法字串
	$str = 'Mary';						// 將名稱為 str的變數設定為字串 'Mary'
	echo('My name is $str.<br>');		// 單引號字串不會進行變數剖析
//	echo('My name is 'Mary'.<br>');		//包含非法字串，須標示為註解，才不會錯誤
?>
</body>
</html>

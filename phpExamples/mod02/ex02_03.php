<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>輸入基本資料</title>
</head>

<body>
	<form id="myForm" name="myForm" method="post" action="process.php">
		<p>
			<label>姓名：</label> 
			<input type="text" name="userName" id="userName" /><br>
			<label>電郵：</label> 
			<input type="text" name="email" id="email" /><br>
			<label>性別：</label>  
			<input type="radio" name="sex" id="sex" value="M" /> <label>男</label>
			<input type="radio" name="sex" id="sex2" value="F" /><label>女</label> <br>
			<label>嗜好：</label> 
			<input name="hobby[]" type="checkbox" id="hobby[]" value="游泳" /> 游泳
			<input name="hobby[]" type="checkbox" id="hobby[]2" value="聽音樂" /> 聽音樂
			<input name="hobby[]" type="checkbox" id="hobby[]3" value="設計動畫 " /> 設計動畫
			
		</p>
		<p>
			<input type="submit" name="submit" id="submit" value="送出" />
			<input type="reset" name="Reset" id="button" 	value="重設" />
			<br>
		</p>
	</form>
</body>
</html>
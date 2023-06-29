<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>顯示商品資訊</title>
<style type="text/css">
#main {
	position: absolute;
	top: 110px;
	left: 120px;
}
#sub {
	position: absolute;
	top: 360px;
	left: 210px;
}
</style>
</head>
<body bgcolor='#e0e0f0'>
	<div id='main'>
		<table border='2' width="700" height="160" bgcolor='#ffffc0'>
			<tr>
				<td rowspan='6'>
					<table border='1' width="170" height="216">
						<tr>
							<td>
							   <img width="160" height="200" src="getImage.php?bid=1">
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width='540'>書名：</td>
			</tr>
			<tr>
				<td width='540'>作者：</td>
			</tr>
			<tr>
				<td width='540'>出版社：</td>
			</tr>
			<tr>
				<td width='540'>書號：</td>
			</tr>
			<tr>
				<td width='540'>訂價(NT$)：</td>
			</tr>
		</table>
	</div>
	<div id='sub'>
		<form method='GET' Action='QueryForm.php'>
		
			請輸入流水號： <input type="text" name='searchKey' size='1' /> <br> 
			<input type="hidden" name='query_data'/> <br>
			<input type="submit" value='提交' />
		</form>
	</div>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hold不住購物商</title>
<link href="file:///C|/wamp/www/style.css" rel="stylesheet"
	type="text/css" />

</head>

<body bgcolor='#FBEFEF'>
	<h3 align="center">書籍維護</h3>
	<hr />
	<br />

	<br />
	<form id="form1" name="form1" method="post"
		action="_BookDataInsertPDO.php" enctype="multipart/form-data">

		<table class="table_color" width="708" border="2" align="center"
			cellpadding="2" cellspacing="2" >
			<tr height='40'>
				<td colspan="4" align="center" valign="bottom"><Font color='blue'
					size='+2'>新增書籍資料</Font><BR> 本網頁會呼叫 _BookDataInsert.php來處理上傳的資料<BR>
					包括搬移上傳檔案到指定的資料夾以及寫入資料庫<BR>
				</td>
			</tr>
			<tr height='36'>
				<td width="45" align="right" class="title_font">書名</td>
				<td colspan="3"><input name="title" class='InputClass' type="text"
					id="title" size="50" /></td>
			</tr>
			<tr height='36'>
				<td width="45" align="right" class="title_font">作者</td>
				<td width="312"><input name="author" class='InputClass' type="text"
					id="author" size="26" /></td>
				<td width="52" align="right" class="title_font">價格</td>
				<td width="161"><input name="price" class='InputClass' type="text"
					id="price" size="3" /></td>
			</tr>
			<tr height='36'>

				<td width="45" class="title_font"><div align="right">書號</div></td>
				<td width="312"><input class='InputClass' name="bookNo" type="text"
					id="bookNo" size="6" /></td>
				<td width="52" class="title_font"><div align="right">出版社</div></td>
                <td width="161">
					<select name="companyID">
                        <option value="1">學貫</option>
                        <option value="2">松崗</option>
                        <option value="3">儒林</option>
                    </select>
			    </td>
			</tr>
			<tr height='36'>
				<td width="45" align="right" class="title_font">圖片</td>
				<td colspan="3"><input style="background: #FFFFFF"
					class='InputClass' type="file" name="uploadFile" size="40" /></td>
			</tr>

			<tr height="36">
				<td height="61" colspan="6" align="center"><BR /> <input
					type="submit" name="Submit" value="新增" />
				</td>
			</tr>
		</table>

	</form>

</body>
</html>

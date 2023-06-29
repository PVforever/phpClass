<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>輸入基本資料</title>
</head>

<body>
        <form id="myForm" name="myForm" method="post" action="process.php">
        <p>
          <label>姓名：
            <input type="text" name="userName" id="userName" />
          </label>
          <br />
          <label>電郵：
            <input type="text" name="email" id="email" size='40'/>
          </label>
          <br />
          <label>性別：
            <input type="radio" name="sex" id="sex" value="M" />
            男</label>
          <label>
            <input type="radio" name="sex" id="sex2" value="F" />
            女</label>
          <br />
          <label>嗜好：</label>
          <label>
            <input name="hobby[]" type="checkbox" id="hobby[]" value="游泳" />
            游泳</label>
          <label>
            <input name="hobby[]" type="checkbox" id="hobby[]2" value="聽音樂" />
            聽音樂</label>
          <label>
            <input name="hobby[]" type="checkbox" id="hobby[]3" value="設計動畫 " />
            設計動畫</label>
        </p>
        <p>
          <label>
            <input type="submit" name="submit" id="submit" value="送出" />
          </label>
          <label>
            <input type="reset" name="Reset" id="button" value="重設" />
          </label>
          <br />
        </p>
      </form>

</body>
</html>
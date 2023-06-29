<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel='stylesheet' href='/example/css/styles.css' type='text/css' />
<title>Ajax練習</title>
<script>
window.onload= function(){
    let btn = document.getElementById("btn");
    btn.addEventListener('click', sendRequest);
}   
function sendRequest() {
    let name = document.getElementById("name").value;
    let type = document.getElementById("type").value;
    let div1 = document.getElementById("div1");
	// ajax的同步請求
	// 步驟一: 新建XMLHttpRequest物件
	let xhr = new XMLHttpRequest();
	// 步驟二: 經由AJAX提出HTTP請求
	if (xhr != null) {
		xhr.onreadystatechange = function(){
			if (xhr.readyState === 4) {
				// 伺服器回應成功
				if (xhr.status === 200) {
					// 收到伺服器的回應
                    displayResult(xhr.responseText);
				} else {
				    alert(xhr.responseText);
				}
			}	
		}
//		xhr.open('GET', "Message.php?name=" + name + "&type=" + type, true);
		xhr.open('GET', "MessageSimple.php?name=" + name + "&type=" + type, true);
		xhr.send();
	} else {
		div1.innerHTML = "<h3>您的瀏覽器不支援Ajax</h3>";
	}
} 

function displayResult(message){
	let customName = document.getElementById("customName");
	let datetime = document.getElementById("datetime");
	let obj = JSON.parse(message);
	customName.innerHTML = "姓名: <font color='red'>" + obj.name + "</font>";
	if (obj.type == "date") {
		datetime.innerHTML = "日期" + ": <font color='red'>" + obj.datetime + "</font>";
	} else {	
   		datetime.innerHTML = "時間" + ": <font color='red'>" + obj.datetime + "</font>";
   	}
}
</script>

</head>
<body>
	<div align="center">
		<div>
			<h2>非同步請求範例一(Ajax)</h2>
			<h3>查詢伺服器的日期 / 時間</h3>
		</div>
		<div>
			<label for="name">姓名:</label> <input type="text" name="name"	id="name" value="" />
		</div>
		<br>
		<div>
		    <label for="name">查詢類型:</label>
			<select id="type" name="type">
				<option value="date" selected>日期</option>
				<option value="time">時間</option>
			</select>
		</div>
		<hr>
			<button id='btn' >送出</button>
		<hr>			
		<div id="div1"></div>
		<div class="box">
			<div id="customName">&nbsp;</div>
			<div id="datetime">&nbsp;</div>
		</div>
		<hr>
	<a href='index.php'>回前頁</a>
	</div>
</body>
</html>
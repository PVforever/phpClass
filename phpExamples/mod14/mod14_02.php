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
    let lotterys = document.getElementsByName("lottery");
    let lotteryType = "";
   
	for (let i = 0; i < lotterys.length; i++) {
  		if (lotterys[i].checked) {
    		lotteryType = lotterys[i].value;
    		break;
    	}
	}
    
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
		xhr.open('GET', "Lottery.php?name=" + name + "&lotteryType=" + lotteryType, true);
		xhr.send();
	} else {
		div1.innerHTML = "<h3>您的瀏覽器不支援Ajax</h3>";
	}
}
function displayResult(message){
	let customName = document.getElementById("customName");
	let lottery = document.getElementById("lottery");
	let obj = JSON.parse(message);
	customName.innerHTML = "姓名: <font color='red'>" + obj.name + "</font>";
	let lots = obj.arr.join(', ');
	lottery.innerHTML = "您的樂透號碼: <font color='red'>" + lots + "</font>";
}
</script>
</head>
<body>
	<div align="center">
		<div>
			<h2>非同步請求範例二(Ajax)</h2>
			<h3>查詢樂透號碼</h3>
		</div>
		<div>
			<label for="name">姓名:</label> <input type="text" name="name"	id="name" value="" />
		</div>
		<br>
		<div>
		    <label for="name">樂透類型:</label><br>
			<input type="radio" name="lottery" value='1-49-6' checked='checked' >大樂透(49選6)<br>
			<input type="radio" name="lottery" value='1-39-5' >今彩539(39選5)<br>
			<input type="radio" name="lottery" value='1-24-12' >雙贏彩(24選12)<br>
		</div>
		<hr>
			<button id='btn' >送出</button>
		<hr>			
		<div class="box">
			<div id="customName">&nbsp;</div>
			<div id="lottery">&nbsp;</div>
		</div>
		<hr>
	<a href='index.php'>回前頁</a>
	</div>
</body>
</html>
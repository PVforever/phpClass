<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel='stylesheet' href='/phpExamples/css/styles.css' type='text/css' />
<title>Ajax練習</title>
<script>
window.onload= function(){
    let btn = document.getElementById("btn");
    btn.addEventListener('click', sendRequest);
}   
function sendRequest() {
    
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
		xhr.open('GET', "https://reqres.in/api/users", true);
		xhr.send();
	} else {
		div1.innerHTML = "<h3>您的瀏覽器不支援Ajax</h3>";
	}
}

function displayResult(message){
	let dataArea = document.getElementById("dataArea");
	let pageData = JSON.parse(message);
	let page 	 = pageData.page; 
	let per_page = pageData.per_page; 
	let total = pageData.total;
	let total_pages = pageData.total_pages;	
	let arr = pageData.data;
	
    let result = "<table border='1'>";
        result += "<tr>"
                + "<th>編  號</th><th>電郵地址</th>" 
                + "<th colspan='2'>姓 名</th>"
                + "<th>照  片</th>"
                + "</tr>";

    for(let n= 0; n < arr.length; n++){
        result += "<tr><td align='center'>" + arr[n].id + "</td>";
        result += "<td>" + arr[n].email + "</td>";
        result += "<td>" + arr[n].first_name + "</td>";
        result += "<td>" + arr[n].last_name + "</td>";
        result += "<td><img width='40' height='50' src='" + arr[n].avatar + "'></td>";
        result += "<tr>";
    }
    result += "</table>" 
    dataArea.innerHTML = result;
}
</script>

</head>
<body>
	<div align="center">
		<div>
			<h2>非同步請求範例三(Ajax)</h2>
		</div>
		<hr>
			<button id='btn' >讀取多個物件組成的陣列</button>
		<hr>			
		<div class="box">
			<div id="dataArea"></div>
		</div>
		<hr>
	<a href='index.php'>回前頁</a>
	</div>
</body>
</html>
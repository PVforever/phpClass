<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='/example/css/styles.css' type='text/css' />
<meta charset="utf-8" />
<title>clickEvent</title>
<script>
window.onload= function(){
    let btn = document.getElementById("btn");
    let message = document.getElementById("message");
    btn.addEventListener('mousemove', ShowMeDate);
}   
function ShowMeDate() {
　    let Today = new Date();
　    let msg = "現在時間：" + Today.getFullYear()+ " 年 " + (Today.getMonth()+1) + " 月 " + Today.getDate() + " 日";
        msg += Today.getHours() + " 時 " + Today.getMinutes() + " 分 " + Today.getSeconds() + " 秒"
		+ Today.getMilliseconds() + " 豪秒";
       message.innerHTML = msg;
} 
</script>
</head>
<body>
    <div align='center'>
        <h3>mousemove事件</h3>
        <hr>
        <button id='btn' >現在時間</button>
        <hr>
        <div id="message">&nbsp;</div>
        <p>
        <hr>
    <hr>
	<a href='index.php'>回前頁</a>
</div>
</body>
</html>	
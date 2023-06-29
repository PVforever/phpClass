<?php 
    // ob_start() : 開啟輸出緩衝區，一旦開啟輸出緩衝區後，所有的輸出資料都將寫入Server端內部的記憶體。
    // ob_end_flush() : 將輸出緩衝區內的資料寫出至客戶端
    ob_start();
?>    
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Set Cookies</title>
</head>
<body>
<?php 
    // ob_start() : 開啟輸出緩衝區，一旦開啟輸出緩衝區後，所有的輸入
    // 資料都將寫入Server端內部的記憶體。
    // ob_end_flush() : 將輸出緩衝區內的資料寫出至客戶端, 同時關閉輸出緩衝區
    ob_start();
    session_start(); //預設是不開的
    echo "Hello World! LV  " . "<br>";
    setcookie("UserName", "小丸子123", time() + 24 * 60 * 60);
    setcookie("UserAge", 20, time() + 24 * 60 * 60, "", "", 1,1);
    setcookie("TT", 987555, time() + 24 * 60 * 60, "", "", 1,1);
    setcookie("LastVisit", time(), time() + 24 * 60 * 60);
    ob_end_flush();       // 將輸出緩衝區內的資料寫出至客戶端, 同時關閉輸出緩衝區
?>
</body>
</html>


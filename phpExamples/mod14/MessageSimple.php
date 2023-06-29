<?php
header("Content-Type: application/json"); // XML文件
// 取得欄位值
$name = (isset($_POST["name"]) ) ? $_POST["name"] : $_GET["name"];
$type = (isset($_POST["type"]) ) ? $_POST["type"] : $_GET["type"];
if (empty($name)){
    $name = "(未輸入-簡單版)";
}
$myObj = new stdClass();
$myObj->name = $name;
$myObj->type = $type;
if ($type == "date") {
    $myObj->datetime = date("Y-m-j");
} else {
    $myObj->datetime = date("h:i:s A");
}
   
echo json_encode($myObj);

?> 

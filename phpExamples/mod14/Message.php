<?php
class Message implements JsonSerializable {
    private $name;                   // Cat類別的屬性
    private $type;
    private $datetime  ;
    function __construct($name, $type){
        $this->name = $name;
        $this->type = $type;
        if ($type == "date") {
            $this->datetime = date("Y-m-j");
        } else {
            $this->datetime = date("h:i:s A");
        }
    }
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}

header("Content-Type: application/json"); // XML文件
// 取得欄位值
$name = (isset($_POST["name"]) ) ? $_POST["name"] : $_GET["name"];
$type = (isset($_POST["type"]) ) ? $_POST["type"] : $_GET["type"];
if ($name.length == 0){
    $name = "(未輸入-物件版)";
}

$p1 = new Message($name, $type);
   
echo json_encode($p1);

?> 

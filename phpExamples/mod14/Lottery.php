<?php
class Lottery implements JsonSerializable{
    private $lower;    		// 屬性
    private $upper;			// 屬性
    private $ballNumber;	// 屬性
    private $arr = array();
    private $name;
    // 如果沒有寫這個建構子，PHP才會尋找與類別同名的函數做為建構子
    function __construct($l, $u, $b, $name){
        $this->lower=$l;
        $this->upper=$u;
        $this->ballNumber=$b;
        $this->name=$name;
    }
    // 如果沒有上面的建構子，本函數會被當成建構子
    function Lottery($l, $u, $b, $name){
        $this->lower=$l;
        $this->upper=$u;
        $this->ballNumber=$b;
        $this->name=$name;
    }
    // 正常的函數(或稱方法)
    function getLottery(){
        $arr = array();
        while (count($arr) < $this->ballNumber){
            $num = rand($this->lower, $this->upper);
            $arr[$num] = $num;
        }
//        $this->arr = $arr;
//        $this->arr = array_values($arr);
        $arr = array_values($arr);
        sort($arr);
        $this->arr = $arr;
    }
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
header("Content-Type: application/json"); // XML文件
// 取得欄位值
$name = (isset($_POST["name"]) ) ? $_POST["name"] : $_GET["name"];
$lotteryType = (isset($_POST["lotteryType"]) ) ? $_POST["lotteryType"] : $_GET["lotteryType"];
if (empty($name)){
    $name = "(未輸入-物件版)";
}
$num = explode("-", $lotteryType);
$min = $num[0];
$max = $num[1];
$ball = $num[2];

$p1 = new Lottery($min, $max, $ball, $name);
$p1->getLottery();
echo json_encode($p1);

?> 

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>PHP 類別</title>
</head>
<body>
<?php
//PHP 不支援Overloading Constructor
class Lottery {
	private $lower;    		// 屬性
	private $upper;			// 屬性
	private $ballNumber;	// 屬性	
    // 如果沒有寫這個建構子，PHP才會尋找與類別同名的函數做為建構子
	function __construct($b=3, $u=10, $l=1){
		$this->lower=$l;
		$this->upper=$u;
		$this->ballNumber=$b;		
	}
    // 如果沒有上面的建構子，本函數會被當成建構子
    function Lottery($l, $u, $b){
		$this->lower=$l;
		$this->upper=$u;
		$this->ballNumber=$b;		
	}
	// 正常的函數(或稱方法)
	function getLottery(){
		$arr = array();
		while (count($arr) < $this->ballNumber){
			$num = rand($this->lower, $this->upper);
			$arr[$num] = $num;
			//echo "$num<br>";
		}
		return $arr;
	}
}

$obj = new Lottery(6, 10);
$lot = $obj->getLottery();
print_r($lot);
?>
</body>
</html>

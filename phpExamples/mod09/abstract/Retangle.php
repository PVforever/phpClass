<?php
require_once "Shape.php";
class Rectangle extends Shape  {
    private $a;
    private $b;
    function __construct($a, $b) {
        $this->a = $a;
        $this->b = $b;
    }
    function getArea() {
        return $this->a * $this->b;
    }
}


?>

<?php
require_once "Shape.php";
class Triangle extends Shape {

    private $side;
    private $height;

    function __construct($s, $h) {
        $this->side = $s;
        $this->height = $h;
    }

    function getArea()  {
        return $this->side * $this->height * 0.5;
    }
}



?>

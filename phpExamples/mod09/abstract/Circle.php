<?php
require_once "Shape.php";
class Circle extends Shape {
    private $r;
    function __construct($r)
    {
        $this->r = $r;
    }
    function getArea()
    {
        return 3.14159 * $this->r * $this->r;
    }
}

?>

<?php
class  Cat {
    private $weight  ;                   // Cat類別的屬性
    private $iq  ;
    private $name;
    function __construct($name, $iq, $weight){         
        $this->name = $name;
        $this->iq = $iq;
        $this->weight = $weight;
    }
    function  eat($foodWeight) {         // 函數
        $this->weight = $this->weight + $foodWeight * 0.1   ;
    }
    function study($hours) {              // 函數
        $this->iq =  $this->iq  + $hours * 0.1;
    }
    function info() {              // 函數
        return $this->name . ", iq=$this->iq, weight= $this->weight<br>";
    }
    function getName(){
        return $this->name;
    }
    function getIq(){
        return $this->iq;
    }
    function getWeight(){
        return $this->weight;
    }
};
?>


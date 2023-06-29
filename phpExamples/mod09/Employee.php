<?php
namespace com\myapp\model\pkg0;

class Employee {
    private $name;
    private $salary;
    
    public function __construct($name, $salary){
        $this->name =  $name;
        $this->salary =  $salary;
    }
    
    public function info (){
        return "name=$this->name, salary=$this->salary";
    }
    public function getName(){
        return $this->name;
    }
    public function getSalary(){
        return $this->salary;
    }
}

?>

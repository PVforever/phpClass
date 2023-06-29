<?php
namespace com\myapp\model\pkg1;
require 'Employee.php';
use  com\myapp\model\pkg0\Employee;

class Manager extends Employee{
     private $phone;
     
     public function __construct($name, $salary, $phone){
         parent::__construct($name, $salary);
         $this->phone =  $phone;
     }
     public function info (){
         return parent::info () . ", phone=$this->phone";
     }
     public function getPhone(){
        return $this->phone;
    }
}

?>

<?php
class Person{
    public $name;
    protected $age;
    private $salary;
    function __construct($name,$age,$salary){
        $this->name=$name;
        $this->age=$age;
        $this->salary=$salary;
    }
    public function showinfo(){
        //這表示三個修飾符都可以在本類內部使用
        echo $this->name. "||" . $this->age. "||" .$this->salary;
    }
    public function setsalary($val){
        $this->salary=$val;
    } 
    public function getsalary(){
        return $this->salary; 
    } 
}
?>


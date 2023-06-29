<?php
class Order {
    private $index;
    private $orderID;
    private $name;
    private $addr;
    private $phone;
    private $email;
    private $date;
    private $total;
    
    
    public function __construct($orderID, $name, $addr, 
                                $phone, $email, $total ){
        $this->orderID  =  $orderID; 
        $this->name     =  $name;   
        $this->addr     =  $addr;   
        $this->phone    =  $phone;  
        $this->email    =  $email;  
        $this->total    =  $total;   
}
    
    public function getIndex(){
        return $this->index;
    }
    public function getOrderID(){
        return $this->orderID;
    }
   
    public function getName(){
        return $this->name;
    }
    public function getAddr(){
        return $this->addr;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function getEmail(){
        return $this->email;
    }
    public function  getDate(){
        return $this->date;
    }
    public function  getTotal(){
        return $this->total;
    }
    public function info (){
        return "author=$this->name, title=$this->addr";
    }
}
?>
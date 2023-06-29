<?php
class OrderDetail {
    private $index;
    private $orderID;
    private $bookID;
    private $title;
    private $price;
    private $quantity;
    private $itemTotal;
    
    
    public function __construct($index, $orderID, $bookID, $title, $price, 
                                $quantity, $itemTotal ){
        $this->index      =  $index; 
        $this->orderID    =  $orderID; 
        $this->bookID     =  $bookID;  
        $this->title      =  $title;   
        $this->price      =  $price;   
        $this->quantity   =  $quantity;  
        $this->itemTotal  =  $itemTotal;    
}
    
    public function getIndex(){
        return $this->index;
    }
    public function getOrderID(){
        return $this->orderID;
    }
    public function getBookID(){
        return $this->bookID;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getQuantity(){
        return $this->quantity;
    }
    
    public function  getItemTotal(){
        return $this->itemTotal;
    }
    public function info (){
        return "title=$this->title, orderID=$this->orderID";
    }
}
?>
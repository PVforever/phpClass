<?php
class User {
    private $id;
    private $userId;
    private $email;
    private $fullName;
    private $password;
    private $suspended;
//  private $repeatPassword;
    
    public function __construct($id, $userId, $fullName, $email, $password, $suspended){
        $this->id =  $id;
        $this->userId =  $userId;
        $this->fullName =  $fullName;
        $this->email =  $email;
        $this->password =  $password;
        $this->suspended =  $suspended;
    }
    
    public function getUserId(){
        return $this->userId;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getFullName(){
        return $this->fullName;
    }
    public function getCoverImage(){
        return $this->coverImage;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getSuspended(){
        return $this->suspended;
    }
    public function info (){
        return "author=$this->userId, title=$this->fullName";
    }
}
?>
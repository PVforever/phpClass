<?php
class Book {
    private $bookId;
    private $author;
    private $bookNo;
    private $coverImage;
    private $fileName;
    private $price;
    private $title;
    private $companyId;
    
    
    public function __construct($bookId, $author, $bookNo, $coverImage, 
                                $fileName, $price, $title, $companyId){
        $this->bookId =  $bookId;
        $this->author =  $author;
        $this->bookNo =  $bookNo;
        $this->coverImage =  $coverImage;
        $this->fileName =  $fileName;
        $this->price =  $price;
        $this->title =  $title;
        $this->companyId =  $companyId;
    }
    
    public function getBookId(){
        return $this->bookId;
    }
    public function getAuthor(){
        return $this->author;
    }
    public function getBookNo(){
        return $this->bookNo;
    }
    public function getCoverImage(){
        return $this->coverImage;
    }
    public function getFileName(){
        return $this->fileName;
    }
    public function getPrice(){
        return $this->price;
    }
    public function  getTitle(){
        return $this->title;
    }
    public function  getCompanyId(){
        return $this->companyId;
    }
    public function info (){
        return "author=$this->author, title=$this->title";
    }
}
?>
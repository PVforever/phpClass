<?php
    class BookDao {   // Data Access Object
        private $connString = "mysql:host=localhost; port=3306; dbname=proj; charset=utf8";
        private $user = "root";
        private $password = "root";
        private $accessOptions = array(
             PDO::ATTR_EMULATE_PREPARES=>false,
             PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_PERSISTENT => true
        );

        private $pdo = null;

        public function __construct(){
            $this->pdo = new PDO($this->connString, 
                           $this->user, 
                           $this->password, 
                           $this->accessOptions);
        }

        public function resetBookTable(){
            try {
                $drop_table = "DROP TABLE IF EXISTS Book";
                $create_table = "CREATE TABLE  Book (" . 
                "  `bookId` INT NOT NULL AUTO_INCREMENT, " + 
                "  `author` VARCHAR(255) DEFAULT NULL, " + 
                "  `bookNo` VARCHAR(255) DEFAULT NULL, " + 
                "  `coverImage` LONGBLOB, " + 
                "  `price` DOUBLE DEFAULT NULL, " + 
                "  `title` VARCHAR(255) DEFAULT NULL, " + 
                "  `companyId` INT DEFAULT NULL, " + 
                "  PRIMARY KEY (`bookId`), " + 
                "  KEY `FK_Company_Key` (`companyId`), " + 
                "  CONSTRAINT `FK_Company_Key` FOREIGN KEY (`companyId`) REFERENCES `bookcompany` (`id`) " + 
                ") AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;  ";
                  
                  $n = $this->pdo->exec($drop_table);
                //   echo "DROP TABLE Book,  n=$n<br>";
                  $n = $this->pdo->exec($create_table);
                //   echo "CREATE TABLE Book,  n=$n<br>";
           } catch(Exception $ex){
                echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
                echo "苦主:" . $ex->getFile() . "<br>";
                echo "行號:" . $ex->getLine() . "<br>";
                echo "Code:" . $ex->getCode() . "<br>";
                echo "堆疊:" . $ex->getTraceAsString() . "<br>";
           }
        }
        public function save($book) {
              $insert =   "INSERT INTO `Book` (`author`, `bookNo`, `coverImage`, " .
              " `image`, `price`, `title`, `companyId` ) " . 
              "  VALUES (:aut, :boo, :cov, :ima, :pri, :tit, :com) "; 

              $pdoStmt = $this->pdo->prepare($insert);
              
              $pdoStmt->bindValue(":aut",  $book->getAuthor(), PDO::PARAM_STR);
              $pdoStmt->bindValue(":boo",  $book->getBookNo(), PDO::PARAM_STR);
              $pdoStmt->bindValue(":cov",  $book->getCoverImage(), PDO::PARAM_LOB);
              $pdoStmt->bindValue(":ima",  $book->getFileName(), PDO::PARAM_STR);
              $pdoStmt->bindValue(":pri",  $book->getPrice(), PDO::PARAM_STR);
              $pdoStmt->bindValue(":tit",  $book->getTitle(), PDO::PARAM_STR);
              $pdoStmt->bindValue(":com",  $book->getCompanyId(), PDO::PARAM_INT);
              $pdoStmt->execute();
              $num = $pdoStmt->rowCount();
              return $num;
              
        }

        public function findById($id) {
          $query = "SELECT bookID, title,  author,  price, companyID, image, BookNo ,CoverImage FROM book where BookID = :bid " ;
          $pdoStmt = $this->pdo->prepare($query);
              
          $pdoStmt->bindValue(":bid", $id, PDO::PARAM_INT);
          $pdoStmt->execute();
          $row = $pdoStmt->fetch(PDO::FETCH_ASSOC);
          return $row;
        }

        public function findAll() {
          $query =   "SELECT * FROM `Book`"; 

          $pdoStmt =  $this->pdo->prepare($query);
          
          $pdoStmt->execute();
          $arr2D = $pdoStmt->fetchAll(PDO::FETCH_ASSOC);
          return $arr2D;
        }
        // 
        public function findWithinRange($startRow, $maxRow) {
          $query = " SELECT b.*, bc.name  FROM book b join bookcompany bc on b.companyID = bc.id " .
                   " LIMIT :start, :max "; 

          $pdoStmt =  $this->pdo->prepare($query);
          $pdoStmt->bindValue(":start",  $startRow, PDO::PARAM_INT);
          $pdoStmt->bindValue(":max",  $maxRow, PDO::PARAM_INT);
          $pdoStmt->execute();
          $arr2D = $pdoStmt->fetchAll(PDO::FETCH_ASSOC);
          return $arr2D;
        }

      

      public function findImageById($id){
        $query = "SELECT  bookID, CoverImage from book where bookID = :id "   ;  
        $pdoStmt = $this->pdo->prepare($query);
        

        $pdoStmt->bindValue(":id", $id, PDO::PARAM_INT);
        $pdoStmt->execute();
        $result = $pdoStmt->fetch(PDO::FETCH_ASSOC);
        return $result['CoverImage'];
      }
     
      public function update($book) {
        $update =   "UPDATE `Book` e SET e.author = :aut,  e.bookNo = :boo, " .
        " e.coverImage = :cov, e.image = :fil,  e.price = :pri, " . 
        " e.title = :tit,  e.companyId = :com  WHERE  e.bookId = :bid "; 

        $pdoStmt = $this->pdo->prepare($update);
        $pdoStmt->bindValue(":aut",  $book->getAuthor(), PDO::PARAM_STR);
        $pdoStmt->bindValue(":boo",  $book->getBookNo(), PDO::PARAM_STR);
        $pdoStmt->bindValue(":cov",  $book->getCoverImage(), PDO::PARAM_STR);
        $pdoStmt->bindValue(":fil",  $book->getFileName(), PDO::PARAM_STR);
        $pdoStmt->bindValue(":pri",  $book->getPrice(), PDO::PARAM_STR);
        $pdoStmt->bindValue(":tit",  $book->getTitle(), PDO::PARAM_STR);
        $pdoStmt->bindValue(":com",  $book->getCompanyId(), PDO::PARAM_INT);
        $pdoStmt->bindValue(":bid",  $book->getBookId(), PDO::PARAM_INT);
        $pdoStmt->execute();
        $num = $pdoStmt->rowCount();
        return $num;
      }

      public function updateWithoutCoverImage($book) {
        $update =   "UPDATE `Book` e SET e.author = :aut,  e.bookNo = :boo, " .
        " e.price = :pri, " . 
        " e.title = :tit,  e.companyId = :com  WHERE  e.bookId = :bid "; 

        $pdoStmt = $this->pdo->prepare($update);
        $pdoStmt->bindValue(":aut",  $book->getAuthor(), PDO::PARAM_STR);
        $pdoStmt->bindValue(":boo",  $book->getBookNo(), PDO::PARAM_STR);
        $pdoStmt->bindValue(":pri",  $book->getPrice(), PDO::PARAM_STR);
        $pdoStmt->bindValue(":tit",  $book->getTitle(), PDO::PARAM_STR);
        $pdoStmt->bindValue(":com",  $book->getCompanyId(), PDO::PARAM_INT);
        $pdoStmt->bindValue(":bid",  $book->getBookId(), PDO::PARAM_INT);
        $pdoStmt->execute();
        $num = $pdoStmt->rowCount();
        return $num;
      }

      public function deleteById($id){
        $query =   "DELETE FROM `Book` WHERE bookId = :id" ; 
        $pdoStmt =  $this->pdo->prepare($query);
        $pdoStmt->bindValue(":id", $id, PDO::PARAM_INT);
        $pdoStmt->execute();
        $rowCount = $pdoStmt->rowCount();
        echo "id=$id,  rowCount= $rowCount<br>";
        return $rowCount;
      }
    }

    ?>
</body>
</html>
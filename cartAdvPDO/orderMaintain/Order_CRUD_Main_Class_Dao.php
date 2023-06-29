<?php
    class OrderDao {
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

        public function resetOrdersTable(){
            try {
                $drop_table = "DROP TABLE IF EXISTS Orders";
                $create_table = "CREATE TABLE  Orders (" . 
                "  `O_Index` INT NOT NULL AUTO_INCREMENT, " + 
                "  `O_OrderID` VARCHAR(255) DEFAULT NULL, " + 
                "  `O_CName` VARCHAR(255) DEFAULT NULL, " + 
                "  `O_CAddr` VARCHAR(255) DEFAULT NULL, " + 
                "  `O_CPhone` VARCHAR(255) DEFAULT NULL, " + 
                "  `O_CEmail` VARCHAR(255) DEFAULT NULL, " + 
                "  `O_Date` DATETIME DEFAULT NULL, " + 
                "  `O_Total` INT DEFAULT NULL, " + 
                "  PRIMARY KEY (`O_Index`) " + 
                ")  DEFAULT CHARSET=utf8;  ";
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
        public function getPdo(){
          return $this->pdo;
        }
        public function saveOrder($order) {
              $insertOrder = "INSERT INTO orders " .
              " (O_OrderID, O_CName, O_CAddr, O_CPhone, O_CEmail, O_Total) " .
              " VALUES (:ord, :nam, :add, :pho, :ema, :tot)" ;
              $pdoStmt = $this->pdo->prepare($insertOrder);
              
              $pdoStmt->bindValue(":ord",  $order->getOrderID(), PDO::PARAM_INT);
              $pdoStmt->bindValue(":nam",  $order->getName() , PDO::PARAM_STR);
              $pdoStmt->bindValue(":add",  $order->getAddr() , PDO::PARAM_STR);
              $pdoStmt->bindValue(":pho",  $order->getPhone(), PDO::PARAM_STR);
              $pdoStmt->bindValue(":ema",  $order->getEmail(), PDO::PARAM_STR);
              $pdoStmt->bindValue(":tot",  $order->getTotal(), PDO::PARAM_INT);
              $pdoStmt->execute();
              $num = $pdoStmt->rowCount();
              return $num;
              
        }

        public function saveOrderDetail($orderDetail) {
          $insertOrderDetail = "INSERT INTO detail " . 
          " (D_OrderID, D_PNo, D_PName, D_PPrice, D_PQuantity, D_ItemTotal) " . 
          " VALUES  (:ord, :boo, :tit, :pri, :qua, :ite) ";

          $pdoStmt = $this->pdo->prepare($insertOrderDetail);
          
          $pdoStmt->bindValue(":ord",  $orderDetail->getOrderID(), PDO::PARAM_STR);
          $pdoStmt->bindValue(":boo",  $orderDetail->getBookID() , PDO::PARAM_INT);
          $pdoStmt->bindValue(":tit",  $orderDetail->getTitle() , PDO::PARAM_STR);
          $pdoStmt->bindValue(":pri",  $orderDetail->getPrice() , PDO::PARAM_INT);
          $pdoStmt->bindValue(":qua",  $orderDetail->getQuantity(), PDO::PARAM_INT);
          $pdoStmt->bindValue(":ite",  $orderDetail->getItemTotal(), PDO::PARAM_INT);
          $pdoStmt->execute();
          $num = $pdoStmt->rowCount();
          return $num;
          
    }

        public function findCountByOrderId($oid) {
          $query = "SELECT count(*) FROM Orders WHERE  O_OrderID = :id " ;
          $pdoStmt = $this->pdo->prepare($query);
              
          $pdoStmt->bindValue(":id", $oid, PDO::PARAM_INT);
          $pdoStmt->execute();
          $num = $pdoStmt->fetchColumn();
          echo "num=$num<br>";
          return $num;
        }

        public function findAllOrdersByOrderId() {
          $query =   "SELECT * FROM orders ORDER BY O_Index DESC"; 

          $pdoStmt =  $this->pdo->prepare($query);
          
          $pdoStmt->execute();
          $arr2D = $pdoStmt->fetchAll(PDO::FETCH_ASSOC);
          return $arr2D;
        }
        // 
        public function findByOrderId($O_OrderID) {
          $query = " SELECT * FROM orders WHERE O_OrderID = :oid";

          $pdoStmt =  $this->pdo->prepare($query);
          $pdoStmt->bindValue(":oid",  $O_OrderID, PDO::PARAM_STR);
          $pdoStmt->execute();
          $arr2D = $pdoStmt->fetch(PDO::FETCH_ASSOC);
          return $arr2D;
        }

        public function findOrderDetailByOrderId($O_OrderID) {
          $query = " SELECT * FROM detail WHERE D_OrderID = :oid";

          $pdoStmt =  $this->pdo->prepare($query);
          $pdoStmt->bindValue(":oid",  $O_OrderID, PDO::PARAM_STR);
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
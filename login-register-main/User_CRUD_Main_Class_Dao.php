<?php
    // 加密時會將"帳號"、"密碼"與"IV"合併為一個字串，常數mark為它們的分界符號
    define("mark", "@@asdfqwzx##");   
    // 定義加密所需的密碼，解密時也會用到它。
    define("encryption_key", "K!ttyM!ckySn00py");
    // 定義加密所使用的演算法。"AES-128-CTR"為對稱密鑰加密的一種演算法(Algorithm)
    define("ciphering_value", "AES-128-CTR");
    // 定義openssl_encrypt()所需的IV(Initialization Vector)
    define("iv", "InitialVector!02");
    
    class UserDao {
        private $connString = "mysql:host=localhost; port=3306; dbname=phpdb; charset=utf8";
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

        public function resetUserTable(){
          try {
              $drop_table = "DROP TABLE IF EXISTS users";
              $create_table = "CREATE TABLE  users (" . 
              "  `id` INT NOT NULL AUTO_INCREMENT, " . 
              "  `userid`     VARCHAR(255) DEFAULT NULL, " .
              "  `full_name`  VARCHAR(255) DEFAULT NULL, " . 
              "  `email`      VARCHAR(255) DEFAULT NULL, " . 
              "  `password`   VARCHAR(255) DEFAULT NULL, " . 
              "  `suspended`  VARCHAR(1) NOT NULL DEFAULT '', " .
              "  PRIMARY KEY (`id`) " .
              ") DEFAULT CHARSET=utf8;  ";
                
                $n = $this->pdo->exec($drop_table);
                $n = $this->pdo->exec($create_table);
         } catch(Exception $ex){
              echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
              echo "苦主:" . $ex->getFile() . "<br>";
              echo "行號:" . $ex->getLine() . "<br>";
              echo "Code:" . $ex->getCode() . "<br>";
              echo "堆疊:" . $ex->getTraceAsString() . "<br>";
         }
      }

        public function checkUserIdAndPassword($user, $password){
            try {
              $sql = "SELECT * FROM `users` a WHERE a.`userid` = :user";
              $pdoStmt = $this->pdo->prepare($sql);
              $pdoStmt->bindValue(":user",  $user, PDO::PARAM_STR);
              
              $pdoStmt->execute();
              $row = $pdoStmt->fetch(PDO::FETCH_ASSOC);
              if (empty($row)  || count($row) == 0) {
                return 0;   
              } else {
                if ($row["suspended"] == 'S') {
                   return -1;   // 停權中，不能登入
                }
                // 檢查密碼是否正確
                if (password_verify($password, $row["password"])) {
                   return 1;  
                } else {
                  return 0;  
                }
              }
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
        // 
        public function saveUser($user) {
              $save = "INSERT INTO users " .
              " (userid, full_name, email, password) " .
              " VALUES (:uid, :ful, :ema, :pas)" ;
              $pdoStmt = $this->pdo->prepare($save);
              $pdoStmt->bindValue(":uid", $user->getUserId(), PDO::PARAM_STR);
              $pdoStmt->bindValue(":ful", $user->getFullName(), PDO::PARAM_STR);
              $pdoStmt->bindValue(":ema", $user->getEmail(), PDO::PARAM_STR);
              $pdoStmt->bindValue(":pas", $user->getPassword(), PDO::PARAM_STR);
              $pdoStmt->execute();
              $num = $pdoStmt->rowCount();
              return $num;
        }
        // 依照傳入的$userId來查找對應的紀錄
        public function findByUserId($userId) {
            $query = "SELECT * FROM users WHERE userid = :id " ;
            $pdoStmt = $this->pdo->prepare($query);              
            $pdoStmt->bindValue(":id", $userId, PDO::PARAM_STR);
            $pdoStmt->execute();
            $num = $pdoStmt->rowCount();
            return $num;
        }

        public function findAll() {
            $query = "SELECT * FROM users" ;
            $pdoStmt = $this->pdo->prepare($query);              
            $pdoStmt->execute();
            $arr2D = $pdoStmt->fetchAll(PDO::FETCH_ASSOC);
            return $arr2D;
        }

        public function resetUserSuspendedStatus() {
            $query = "UPDATE users set  suspended = ' '";
            $pdoStmt = $this->pdo->prepare($query);              
            $pdoStmt->execute();
            return $pdoStmt->rowCount();
        }

        public function updateSuspendedById($id) {
           $query = "UPDATE users u set u.suspended = 'S' WHERE u.id = :id";
           $pdoStmt = $this->pdo->prepare($query);
           $pdoStmt->bindValue(":id", $id, PDO::PARAM_INT);
           $pdoStmt->execute();
           return $pdoStmt->rowCount();
        }
        // 將傳入的帳號($user)、密碼($password)與隨機產生的字串(IV)合併為一個加密字串
        // 合併時還會於固定位置插入亂字元
        function combineString($user, $password) {
             // 產生 $iv
             $iv = $this->generateRandomIv();
             $result = "";
             $target = $user . mark . $password . mark . $iv ;
             // 以下於合併中的字串插入亂字元
             for($i = 0 ; $i < strlen($target) ; $i++){
               if ($i % 2 == 0){
                  $char = chr(rand(33, 126));
               } else {
                  $char = "";
               }
               $result .=  substr($target, $i, 1) . $char;
             }
             // 使用openssl_encrypt()來加密
             // $result: 明文
             // ciphering_value: 加密演算法
             // encryption_key: 加密的密鑰
             // null代表 $options 
             // $options的可能值為
             // 0
             // OPENSSL_RAW_DATA=1
             // OPENSSL_ZERO_PADDING=2
             // OPENSSL_NO_PADDING=3
             // iv: Initialization Vector
             $result =  openssl_encrypt($result, ciphering_value, encryption_key, null, iv);
             return $result;
            }
            // 將加密後帳號、密碼與隨機產生的字串(IV)解密，必須使用與加密時相同的IV
            function restoreString($target) {
                $result = "";
                $target =  openssl_decrypt($target, ciphering_value, encryption_key, null, iv);
                
                for($i = 0 ; $i < strlen($target) ; $i++){
                  if ($i % 3 == 1){
                     ;
                  } else {
                     $char = substr($target, $i, 1);
                     $result .= $char ;
                  } 
                }
          
          return $result;
        }
        // 產生由隨機字串組成的 IV
        function generateRandomIv(){
         $iv = "";
         // 方法一
         //  $wasItSecure = false;
         //  while (!$wasItSecure) {
         //     $iv = openssl_random_pseudo_bytes(16, $wasItSecure);
         //  }
         // 方法二
         for($n = 0; $n < 16; $n++){
            $iv .= chr(rand(65, 122)) ;
         }
          return $iv;
       }
    }
    ?>
</body>
</html>
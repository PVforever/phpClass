<?php
require_once "User_CRUD_Main_Class_Dao.php";

//加密方法
// $password = "11111111";
// $passwordHash = password_hash($password, PASSWORD_DEFAULT);
// echo "encripted: $passwordHash <br>";

// $password = "11111111";
// $passwordHash = password_hash($password, PASSWORD_DEFAULT);
// echo "encripted: $passwordHash <br>";


// $password = "11111111";
// $passwordHash = password_hash($password, PASSWORD_DEFAULT);
// echo "encripted: $passwordHash <br>";

//比對函式
// if (password_verify($password, $passwordHash)){
//     echo "OK";
// } else {
//     echo "NG";
// }
// echo "<hr>";

// $abc = "12345";
// echo strlen($abc) . "<br>";

// $abc = "張a";
// echo strlen($abc) . "<br>";

// $wasItSecure = false;
// while (!$wasItSecure) {
//     $iv = openssl_random_pseudo_bytes(16, $wasItSecure);
//     if ($wasItSecure) {
//         echo "$iv  OK";
//     } else {
//         echo "$iv  NG";
//     }
// } ;    

// $userDao = new UserDao();
// $user = "123";
// $password = "kitty";
// $result = $userDao->combineString($user, $password, $iv);
// echo "<hr>" . $result . "<br>";
// $source = $userDao->restoreString($result, $iv);
// echo "<hr>" . $source;
// ?>

<?php
//    // Original string value works to encrypt the value  
//      $original_string = "Welcome to JavaTpoint learners \n";  
//      // Print the original input string  
//      echo "Original String: " .$original_string;  
//      // Store the cipher method   
//      $ciphering_value = "AES-128-CTR";   
//      // Store the encryption key  
//      $encryption_key = "JavaTpoint";  
//      // Use openssl_encrypt() function   
//      $encryption_value = openssl_encrypt($original_string, $ciphering_value, $encryption_key);   
//      // Display the encrypted input string data  
//      echo "<br> <br> Encrypted Input String: " . $encryption_value  . "\n";  
//      $decryption_key = "JavaTpoint";  
//      // Use openssl_decrypt() function to decrypt the data  
//      $decryption_value = openssl_decrypt($encryption_value, $ciphering_value, $decryption_key);   
//      // Display the decrypted string as an original data  
//      echo "<br> <br> Decrypted Input String: " .$decryption_value. "\n";  

    
    
   $userDao = new UserDao();
   $userDao->resetUserTable();
             

?>
<?php
/*
   本程式提供使用者註冊功能
*/
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
require_once "User_CRUD_Main_Class_Dao.php";
require_once "User.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        $userDao = new UserDao();

        $userid = "";
        $fullname = "";
        $email = "";
        $password = "";
        $passwordRepeat = "";
        $errUserid = " ";
        $errCompanyID = " ";
        $errEmail = " ";
        $errPassword = " ";
        $errPasswordRepeat = " ";
        $errFullname = " ";
        if (isset($_POST["submit"])) {
           $userid = $_POST["userid"];
           $fullname = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
           // 於檢查使用者輸入資料時用來記錄資料是否完全正確
           $valid = 1;     // 假設使用者輸入的資料都是正確的

           if (empty($userid)) {
              $errUserid = "帳號欄不能為空白";
              $userid = "帳號欄不能為空白";
              $valid = 0;
           }
           if (empty($fullname)) {
              $errFullname = "姓名欄不能為空白";
              $valid = 0;
           }
           if (empty($email)) {
              $errEmail = "Email欄不能為空白";
              $valid = 0;
           } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $errEmail = "Email欄格式錯誤";
              $valid = 0;
           } 
           
           if (empty($password)) {
              $errPassword = "密碼欄不能為空白";
              $valid = 0;
           } else if (strlen($password) < 8) {
              $errPassword = "密碼至少要有八個字元";
              $valid = 0;
           } 
           if (empty($passwordRepeat)) {
              $errPasswordRepeat = "確認密碼欄不能為空白";
              $valid = 0;
           } 
           if ($password !== $passwordRepeat) {
              $errPasswordRepeat = "密碼與確認密碼欄不一致";
              $valid = 0;
           }
           $userDao = new UserDao();
           
           $rowCount =  $userDao->findByUserId($userid);
           if ($rowCount > 0) {
              $errUserid = "帳號已經存在，請重新輸入";
              $valid = 0;
           }
           if ($valid > 0) {
               // 將密碼加密 
               // PASSWORD_DEFAULT: Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to change over time as new and stronger algorithms are added to PHP.
               $password = password_hash($password, PASSWORD_DEFAULT);
               $user = new User(NULL, $userid, $fullname, $email, $password, '');
               $num = $userDao->saveUser($user);
               if ($num > 0) {
                   header("Location: login.php");
                //   
               }else{
                    exit("儲存客戶資料失敗");
               }
           }
        }
        ?>
        <div align='center'>
             <h3>訪客註冊</h3>
        </div>
        <br>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" placeholder="輸入帳號:" name="userid" class="form-control" 
                value = '<?php echo "$userid"  ?>' >
                <font color='red' size='-1'><?php echo $errUserid . "&nbsp;" ?></font>
            </div> 
        

            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="輸入姓名:"
                       value = '<?php echo "$fullname"  ?>' >
                <font color='red' size='-1'><?php echo $errFullname . "&nbsp;" ?></font>
            </div>
            
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="輸入Email:"
                       value = '<?php echo "$email"  ?>' >
                <font color='red' size='-1'><?php echo $errEmail . "&nbsp;" ?></font>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="輸入密碼:"
                       value = '<?php echo "$password"  ?>' >
                       
                <font color='red' size='-1'><?php echo $errPassword . "&nbsp;" ?></font>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="再次輸入密碼:"
                    value = '<?php echo "$passwordRepeat"  ?>' >
                <font color='red' size='-1'><?php echo $errPasswordRepeat . "&nbsp;" ?></font>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="註冊" name="submit">
            </div>
        </form>
        <div>
        <br>
        <div><p>已經註冊？<a href="login.php">按這裡登入</a></p></div>
      </div>
    </div>
</body>
</html>
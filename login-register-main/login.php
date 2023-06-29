<?php
session_start();
// 如果已經登入直接導向index.php
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
require_once "User_CRUD_Main_Class_Dao.php";
$userDao = new UserDao();
// 是否需要由Cookie取出帳密
$getDataFromCookie = true;

if (isset($_SERVER['HTTP_REFERER'])){
    $referer = $_SERVER['HTTP_REFERER'];
    // 如果是由註冊頁面導來，就不採用Cookie
    if (str_ends_with($referer, "registration.php")) {
        $getDataFromCookie = false;
    }
} else {
    ;    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        $userid = "";
        $password = "";
        $rm = "";
        $errUserid = "";
        $errPassword = "";
        $success = "";
        $valid = 1;
        if (isset($_POST["MM_FORM"])) {
           $userid = $_POST["userid"];
           $password = $_POST["password"];
           if (empty($userid)) {
               $errUserid = "帳號欄不能為空白";
               $valid = 0;
           }
           if (empty($password)) {
               $errPassword = "密碼欄不能為空白";
               $valid = 0;
           }
           if ($valid) {
              // 檢查帳號、密碼是否正確，同時檢查是否被停權
              $result = $userDao->checkUserIdAndPassword($userid, $password);
              if ( $result == 1 ) { 
                   // 帳號、密碼正確
                   $_SESSION["user"] = $userid;
                   // 將帳號、密碼加密
                   $mix = $userDao->combineString($userid, $password);
                   // 處理Cookie
                   if (isset($_POST['remember_me'])) {
                       setcookie('_vyr_', $mix, time() + 60*60*24*30);  // 此 Cookie 保留 30 天  
                   } else {
                       setcookie('_vyr_', $mix, time());   // 此Cookie保留0秒  
                   }
                   $_SESSION["welcomeMessage"] = "訪客 $userid 歡迎光臨!";
                   header("Location: index.php");
              } else if  ( $result == -1 ) {
                   echo "<div class='alert alert-danger'><h2 align='center'>您已停權無法登入</h2></div>";
              } else {
                   echo "<div class='alert alert-danger'><h2 align='center'>帳號或密碼錯誤</h2></div>";
              }
           } else {
                echo "<div class='alert alert-success'><h2 align='center'>訪客登入</h2></div>";
           }
        }else{
            echo "<div class='alert alert-success'><h2 align='center'>訪客登入</h2></div>";
            // 如果需要使用Cookie內的資料，則取出存放在Cookie內的帳號、密碼
            if ( $getDataFromCookie && isset($_COOKIE["_vyr_"])){
                $str = $_COOKIE["_vyr_"];
                $mix = $userDao->restoreString($str);
                $arr = explode(mark, $mix);
                $userid = $arr[0];
                $password = $arr[1];
                $rm = "checked";
            }
        }
            
        ?>
      <form action="login.php" method="post">
         
        <div  class="form-group">
            帳號：<input type="text" placeholder="輸入帳號" name="userid" 
                   class="form-control" value="<?php echo $userid; ?>">
            <font color='red' size='-1'><?php echo $errUserid . "&nbsp;" ?></font>
        </div>
        <div >
            密碼：<input type="password" placeholder="輸入密碼" name="password" 
                   class="form-control" value="<?php echo $password; ?>"> 
            <font color='red' size='-1'><?php echo $errPassword . "&nbsp;" ?></font>
        </div>
        <div class="form-group">
            <input type="checkbox"  name="remember_me" <?php echo $rm; ?> >記住我 
        </div>
        <div >
              <input type="hidden"  name="MM_FORM" value="" > 
            <input type="submit" value="登入" name="login" class="btn btn-primary">
        </div>
      </form>
     <div><p>還沒註冊？<a href="registration.php">按這裡註冊</a></p></div>
    </div>
</body>
</html>
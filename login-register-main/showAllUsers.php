<?php 
/*
   1. 本程式顯示所有使用者的資料

   2. 有些資料屬於動態內容，不應該被瀏覽器暫存到硬碟上的記憶體。
      避免瀏覽器或Proxy Server暫存(Cache)資料，我們可在程式中使用下列敘述

//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  // 指定到期日
//header("Cache-Control: no-cache, must-revalidate"); 
//session_cache_limiter('nocache');        // 告知瀏覽器不要cache資料
*/
 session_start(); 
 if (!isset($_SESSION["user"])) {
    header("Location: login.php");
 }
 require_once('User_CRUD_Main_Class_Dao.php'); 
 $userDao = new UserDao();

?>
<!DOCTYPE html >
<html>
<head>
  <meta charset="utf-8" />
  <title>顯示使用者資料</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <br>
  <div class="container-md" align='center' >
  <div class='alert alert-success'><h1 align='center'>瀏覽使用者資料</h1></div>
  <form action='updateSuspened.php'  method='POST' >
    <div>
<table  class="table_color" width="720" border="2" align="center" cellpadding="2" cellspacing="2" >
  <tr height='32' class="title_font">
    <td width="80"><div align="center">使用者代號</div></td>
    
    <td width="60"><div align="center">姓名</div></td>
   
    <td width="200"><div align="center">電子郵件</div></td>
    
    <td width="50"><div align="center">活動狀態</div></td>
  </tr>
 
  <?php 

     $arr2D = $userDao->findAll();
     foreach($arr2D as $row){ 
      ?>
       <tr>  
         <td><?php echo $row['userid']; ?></td> 
         <td><?php echo $row['full_name']; ?></td> 
         <td><?php echo $row['email']; ?></td>
         <?php 
            $checked = ($row['suspended']== ' ' || $row['suspended'] == '' ? '' : 'checked');
         ?>
         <td>
             <input type='checkbox' name='suspended[]' <?php echo $checked; ?> value="<?php echo $row['id']; ?>" >
             <?php 
             if ($checked == ''){
                echo " 正常";
              } else {
                echo " 停權";
              }
               ?>
        </td>
       </tr> 
      <?php } 	?>
            </div>
    </table>
    <br>
    <input type='submit' name='submit_showAllUsers'  value='提交'> 
  </form>
<p>
<div align='center'>
		<a href='index.php'>回前頁</a>
</div>

</body>
</html>
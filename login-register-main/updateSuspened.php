<?php 
    // 依照前端送來的suspended[]來更新User的suspended欄位
    require_once('User_CRUD_Main_Class_Dao.php');
    $userDao = new UserDao();

    if (isset($_POST['submit_showAllUsers'])){
        if (isset($_POST['suspended'])){           // 如果前端有送suspended欄位的值
           $userDao->resetUserSuspendedStatus();   // 將User表格所有紀錄的suspended欄位先清為空白
           $arr = $_POST['suspended'];
           for($n = 0; $n < count($arr); $n++){    // 依照前端送來停權的suspended欄位更新對應的紀錄
                $userDao->updateSuspendedById($arr[$n]);
           }
        } else {
            $userDao->resetUserSuspendedStatus();   // 沒挑任何紀錄，應該全部清掉
        }
    } else {
        ;
    }
    header("Location:index.php");
?>
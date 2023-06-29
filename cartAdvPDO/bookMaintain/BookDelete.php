<?php
   session_start();
   require_once('../Connections/conn.php');
   require_once('Book_CRUD_Main_Class_Dao.php');
   /* 
      程式的功能：
      刪除book表格內的某筆記錄。
      當使用者在『更新書籍資料』的畫面(由BookUpdate.php提供)按下『刪除』按鈕，
      並在『確定刪除』的對話盒，按下『確定』按鈕，瀏覽器會送出對本程式的HTTP請
      求，BookDelete.php?bookNo=xxxxx。本程式將會刪除book表格中，bookNo為xxxxx的
      該筆記錄。
    */

   $bookID = $_GET['bookID'] ; 
   $title = $_GET['title'] ; 
   $bookDao = new BookDao();
   
   // $deleteSQL = "DELETE FROM book where BookNo = ?";
   // $pdoStmt = $pdo->prepare($deleteSQL);
   // // 請MySQL執行此 $deleteSQL 命命
   // $pdoStmt->bindvalue(1, $bookNo);
   // $pdoStmt->execute();
   $result = $bookDao->deleteById($bookID);
   if ($result) {
      // 取得受前一個命令的執行所影響的紀錄個數
      // 1: 表示刪除成功(有1筆紀錄)
      // 0: 表示刪除失敗(有0筆紀錄)
	  // $_SESSION['Book_Message'] : 儲存『刪除成功或失敗的訊息』，此訊息會顯示在BookList.php內
      $_SESSION['Book_Message'] = '書籍:' . $title . '刪除成功';
   } else {
      $_SESSION['Book_Message'] = '書籍:' . $title . '刪除失敗';
      // 通知瀏覽器，對BookList.php發出新的請求
   }
   header('Location: index.php');
?>

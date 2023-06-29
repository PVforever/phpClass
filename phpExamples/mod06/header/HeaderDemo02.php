<?php 
  $Today = getdate();         //取得今天的日期
  $WeekDay = $Today["wday"];  //取得今天是星期幾
  switch ($WeekDay)
  {
    case 0:         
      $PageName = "Sun.php";
      break;
    case 1:         
      $PageName = "Mon.php";
      break;  
    case 2:         
      $PageName = "Tue.php";
      break; 
    case 3:         
      $PageName = "Wed.php";
      break; 
    case 4:         
      $PageName = "Thu.php";
      break; 
    case 5:         
      $PageName = "Fri.php";
      break; 
    case 6:         
      $PageName = "Sat.php";
  } 
  header("Location: $PageName ");              
?>
      
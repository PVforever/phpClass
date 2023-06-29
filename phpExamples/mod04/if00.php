<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>ch04/if00.php</title>
  </head>
  <body>
  <?php
    if ( date("H") >= 18 ) {   // date("H") 傳回現在的『小時』數
    	echo "明天請早!" ;
    }
    echo "<hr>";
    if ( date("H") >= 6 && date("H") <= 18 ) {
    	echo "現在是白天!" ;
    }
    echo "<hr>";
    $score = rand(1, 100) ;    
    echo "分數=" . $score ."<br>" ;
    if( $score >= 60  ){       // 如果 $score 大於 60  
    	echo "萬歲<br>";        // 顯示三次萬歲 
    	echo "萬歲<br>";
    	echo "萬歲<br>";
    }

   ?>
   </body> 
</html>
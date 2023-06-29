<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>ch04/if02.php</title>
  </head>
  <body>
  <?php
  if ( date("H") >= 18 ) {
  	echo "明天請早!" ;
  } else {
  	echo "歡迎光臨!" ;
  }
  echo "<hr>";
  if ( date("H") >= 6 && date("H") <= 18 ) {   // 介於六點與十八點之間
  	echo "現在是白天!" ;
  } else {
  	echo "現在是黑夜!" ;
  }
  echo "<hr>";
  $score = rand(1, 100) ;
  echo "分數=" . $score ."<br>" ;
  if( $score >= 60  ){
  	echo "萬歲<br>";
  	echo "萬歲<br>";
  	echo "萬歲<br>";
  } else {
  	echo "沒過<br>";
  }

  ?>
   </body> 
</html>
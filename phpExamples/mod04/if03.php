<!DOCTYPE html>
<html>
  <head>
     <meta charset='utf-8'>
     <title>ch04/if03.php</title>
  </head>
  <body>
  <?php
  $score = rand(1, 120) ;
  echo "分數=" . $score ."<br>" ;
  if( $score >= 60  && $score <= 100) {
  	echo "萬歲<br>";
  	echo "萬歲<br>";
  	echo "萬歲<br>";
  } else if ($score >= 50 && $score <= 59 ) {
  	echo "活當<br>";
  } else if ( $score >= 0 && $score <= 49 ) {
  	echo "死當<br>";
  } else {
  	echo "分數錯誤<br>";
  }

  ?>
   </body> 
</html>
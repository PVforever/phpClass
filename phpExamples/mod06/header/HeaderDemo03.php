<?php
     // 觀察瀏覽器的網址列
     $num = rand(0, 100);
     if ($num % 3 == 0) {
     	header('Location: http://tw.yahoo.com'); 
     } else if ($num % 3 == 1) {
     	header('Location: http://www.google.com');
     } else if ($num % 3 == 2) {
     	header('Location: http://www.apple.com');
     }
?>     
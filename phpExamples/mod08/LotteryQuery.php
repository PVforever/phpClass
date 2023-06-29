<!DOCTYPE html>
<html lang="en">
<?php
   require_once("Lottery.php");
   $name = "";
   $checkedOption49 = "checked";
   $checkedOption39 = "";   
   $checkedOption24 = "";
  
   $lotteryNumbers = "";
   if (isset($_POST['hiddenField'])  && $_POST['hiddenField'] == 'proceed' ){
	 
	  $name = $_POST['name'];
	  if (empty($name)){
	      $name = "(未輸入-物件版)";
	  }
	  if ( $_POST['lotteryType'] == '1-49-6' )  {
		  	$checkedOption49 = "checked";
		  	$lottery = new Lottery(1, 49, 6, '大樂透');
	  } else if ( $_POST['lotteryType'] == '1-39-5' )  {
       		$checkedOption39 = "checked";
		    $lottery = new Lottery(1, 39, 5, '今彩539');
	  } else if ( $_POST['lotteryType'] == '1-24-12' )  {
			$checkedOption24 = "checked";
			$lottery = new Lottery(1, 24, 12, '雙贏彩');
	  }
	  $lotteryNumbers =  $lottery->getLottery();
	//   echo  $lottery->jsonSerialize() . "<br>";
   }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<body>
	<div align="center">
        <form action='lotteryQuery.php' method='POST' >
			  <input type='hidden'  name='hiddenField'  value='proceed' />
		<div>
			<h3>查詢樂透號碼</h3>
		</div>
		<div>
		    <label for="name">樂透類型:</label><br>
			<input type="radio" name="lotteryType" value='1-49-6' <?php echo $checkedOption49; ?> >大樂透(49選6)<br>
			<input type="radio" name="lotteryType" value='1-39-5' <?php echo $checkedOption39; ?>>今彩539(39選5)<br>
			<input type="radio" name="lotteryType" value='1-24-12' <?php echo $checkedOption24; ?>>雙贏彩(24選12)<br>
		</div>
		<br>
		<div>
			<label for="name">訪客姓名:</label>
			 <input type="text" name="name"	id="name" value="<?php echo $name; ?>" />
		</div>
		<hr>
			<button id='btn' >送出</button>
</form>	
		<hr>			
		<div class="box">
			<div id="customName">&nbsp;<?php echo  $name;  ?></div>
			<div id="lottery">&nbsp;<?php echo  $lotteryNumbers;  ?></div>
		</div>
		<hr>
	<!-- <a href='index.php'>回前頁</a> -->
	</div>
</body>
</html>
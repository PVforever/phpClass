<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
//若是類別跟執行檔在不同資料夾，用下方的連結方式
//require_once($_SERVER['DOCUMENT_ROOT'] . "/phpExamples/mod08/Cat.php");
//require_once("C:/xampp/htdocs\phpExamples\mod08/Cat.php");
  require_once("Cat.php"); //require_once 引入類別程式檔
    $kitty = new Cat("貓凱蒂", 80, 10.0);
    $kitty->eat(10);
    $kitty->study(20);
?>   
<div align='center'>
    <table border='1'>
        <tr>
            <th width='200'>名稱</th>  
            <th width='60'>IQ</th>  
            <th width='120'>體重</th>  
        </tr>     
        <tr>
            <td align='center' ><?php echo $kitty->getName(); ?></td>  
            <td align='center' ><?php echo $kitty->getIq(); ?></td>  
            <td align='center' ><?php echo $kitty->getWeight(); ?></td>  
        </tr>     

    </table>
</div>
    
</body>
</html>



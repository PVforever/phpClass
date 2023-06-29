<?php
    namespace com\myapp\model\pkg2;
?>    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
  
    require 'Manager.php';
    use com\myapp\model\pkg1\Manager;
    $manager = new Manager("徐瑪莉", 68000, "02-22336500") ;
?>    
    <div align='center'>

        <table border='1'>
            <tr>
                <th>姓名</th>
                <th>薪水</th>
                <th>電話</th>
            </tr>
            <tr>
                <td><?php echo $manager->getName(); ?></td>
                <td><?php echo $manager->getSalary(); ?></td>
                <td><?php echo $manager->getPhone(); ?></td>
            </tr>
        </table>
    </div>
        
</body>
</html>





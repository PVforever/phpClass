<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div align='center'>
    <?php
            require_once "Person.php";
            $p1=new Person("張三", 20, 3000);
            //這裡屬於類外部，那麼如果用下面的方法訪問age和salary都會報錯
            // echo $p1->age; echo$p1->salary;
            echo "姓名：" . $p1->name . "<br>";
            echo "薪水：" .  $p1->getsalary() . "<br>"; 

?>

    </div>
</body>
</html>
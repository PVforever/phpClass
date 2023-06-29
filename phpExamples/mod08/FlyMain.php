<?php
//require_once($_SERVER['DOCUMENT_ROOT'] . "/phpExamples/mod08/Fly.php");
//require_once("C:/xampp/htdocs\phpExamples\mod08/Fly.php");
require_once("Fly.php");
              
$clark = new Superman("克拉克超人");
$bird = new Bird("鳥人");

$clark->takeOff();
$bird->takeOff();

?>


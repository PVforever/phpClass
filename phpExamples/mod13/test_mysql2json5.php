<!DOCTYPE html>
<?php
require("mysql2json5PDO.php");
$sql = "select * from Friends";
echo mysql2json5($sql);

?>
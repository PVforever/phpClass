<?php
    session_start();
    session_unset();
    session_destroy();
    $_SESSION = array();
    header("Location: session_test.php");
?>

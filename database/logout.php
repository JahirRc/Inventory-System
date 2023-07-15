<?php
    session_start();
    
    session_unset();

    session_destroy();

    header('Location: '.'http://localhost/InventorySystem/login.php');

    //header('Location: '.'../login.php');
?>
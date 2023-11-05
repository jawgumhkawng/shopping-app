<?php 
if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {

    header('Location: login.php');
    
    }
session_start();

unset($_SESSION['cart']);

header('Location: index.php');

?>
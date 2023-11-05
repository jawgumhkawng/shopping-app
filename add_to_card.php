<?php 
session_start();

require 'config/config.php';

if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {

    header('Location: login.php');
  
  }


if($_POST) {
    $Id = $_POST['id'];
    $qty = $_POST['qty'];

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id =".$Id);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($qty > $result[0]['quantity']){
        echo "<script>alert('Not Enought Stock!');window.location.href='single_product.php?id=$Id'</script>";
    } else {
        if(isset($_SESSION['cart']['id'.$Id])){
            $_SESSION['cart']['id'.$Id] += $qty;
        } else {
            $_SESSION['cart']['id'.$Id] = $qty;
        }
    
        header( 'location: cart.php');
    }

   
}

?>
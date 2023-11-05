<?php include('header.php') ?>

<?php
 require 'config/config.php';
 if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {

   header('Location: login.php');
   
   }
   $name = $_SESSION['user_name'];
 ?>

<section class="banner-area organic-breadcrumb">
<div class="container">
<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
<div class="col-first">
<h1>Confirmation</h1>
<nav class="d-flex align-items-center">
<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
<a href="confirmation.php">Confirmation</a>
</nav>
</div>
</div>
</div>
</section>

<section class="order_details section_gap">
<div class="container">
<h3 class="title_confirmation text-uppercase ">Thank you!!<span style="color: blue;"><?= $name ?></span>, Your order has been received...</h3>

<div class="row order_d_inner mt-5">
<div class="col-lg-6">
<div class="details_item">
   <?php 
    
    $id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id=".$id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

   //  $Id = $result['id'];
   //  $stmtOrd = $pdo->prepare("SELECT * FROM sale_order WHERE user_id=".$Id);
    $stmt = $pdo->prepare("SELECT sale_order.*,users.id AS user_id FROM sale_order LEFT JOIN users ON sale_order.user_id = users.id WHERE users .id=$id ORDER BY sale_order.id DESC");
    $stmt->execute();
    $resultOrd = $stmt->fetchAll();
   ?>
<h4>Order Info</h4>
<?php if($resultOrd) : ?>
<ul class="list">
<li><a href="#"><span>Order number</span> : 60235</a></li>
<li><a href="#"><span>Date</span> : <?= $resultOrd[0]['order_date'] ?></a></li>
<li><a href="#"><span>Total</span> : <?= $resultOrd[0]['total_price'] ?></a></li>
<li><a href="#"><span>Payment method</span> : Check payments</a></li>
</ul>
<?php endif ?>
</div>
</div>
<div class="col-lg-6">
<div class="details_item">
<h4>Billing Address</h4>
<?php if($result) : ?>
<ul class="list">
<li><a href="#"><span>Name</span> : <?= $result['name'] ?></a></li>
<li><a href="#"><span>Phone</span> : <?= $result['phone'] ?></a></li>
<li><a href="#"><span>Email</span> : <?= $result['email'] ?></a></li>
<li><a href="#"><span>Address </span> : <?= $result['address'] ?></a></li>
</ul>
<?php endif ?>
</div>
</div>
<!-- <div class="col-lg-4">
<div class="details_item">
<h4>Shipping Address</h4>
<ul class="list">
<li><a href="#"><span>Street</span> : 56/8</a></li>
<li><a href="#"><span>City</span> : Los Angeles</a></li>
<li><a href="#"><span>Country</span> : United States</a></li>
<li><a href="#"><span>Postcode </span> : 36952</a></li>
</ul>
</div>
</div> -->
</div>
<div class="order_details_table">
<h2>Order Details</h2>
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th scope="col" style="color: black;">Product</th>
<th scope="col" style="color: black;">Quantity</th>
<th scope="col" style="color: black;">Total</th>
</tr>
</thead>
<tbody>
<tr>

<?php 

$id = $_SESSION['user_id'];

$total = 0;
   foreach ($_SESSION['cart'] as $key => $qty) : 
   $id =str_replace('id','',$key);


   $stmt = $pdo->prepare("SELECT * FROM products WHERE id =".$id);
   $stmt->execute();
   $result = $stmt->fetch(PDO::FETCH_ASSOC);

   $total += $result['price'] * $qty;

   $ship = 0.0;

?>
<td>
<p class="text-uppercase"><?= $result['name'] ?></p>
</td>
<td>
<h5>x <?= $qty ?></h5>
</td>
<td>
<p>$<?= $result['price'] ?></p>
</td>
</tr>

<?php endforeach ?>
<tr>
<td>
<h4>Subtotal</h4>
</td>
<td>
<h5></h5>
</td>
<td>
<p>$<?= $total ?></p>
</td>
</tr>
<tr>
<td>
<h4>Shipping</h4>
</td>
<td>
<h5></h5>
</td>
<td>
<p>Flat rate: $<?= $ship ?></p>
</td>
</tr>
<tr>
<td>
<h4>Total</h4>
</td>
<td>
<h5></h5>
</td>
<td>
<p>$<?= $total + $ship ?></p>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<br><br>
<div class="div">
<a  href="order_finish.php" class="primary-btn col-lg-12  text-center">Confirm</a><br>
</div>
</div>
</section>



<?php include('footer.php') ?>
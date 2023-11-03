<?php include('header.php') ?>

<?php require 'config/config.php'; ?>

<section class="banner-area organic-breadcrumb">
<div class="container">
<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
<div class="col-first">
<h1>Checkout</h1>
<nav class="d-flex align-items-center">
<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
<a href="checkout.php">Checkout</a>
</nav>
</div>
</div>
</div>
</section>


<section class="checkout_area section_gap">
<div class="container">
<div class="returning_customer">


</div>

<div class="billing_details">
<div class="row">
<div class="col-lg-12">
<h3>Billing Details</h3>

</div>
<div class="col-lg-12 mb-5" style="margin-bottom: 50px;">
<div class="order_box">
<h2>Your Order</h2>



<table class="table">
<thead>
<tr>
<th scope="col" style="color: black;">Product</th>
<th scope="col" style="color: black;">Quantity</th>
<th scope="col" class="text-center" style="color: black;">Price</th>
<th scope="col" class="text-right" style="color: black;">Total</th>
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

   $ship = 50;

?>
<td>
<p class="text-uppercase"><?= $result['name'] ?></p>
</td>
<td>
<h5>x <?= $qty ?></h5>
</td>
<td>
<p class="text-center">$<?= $result['price'] ?></p>
</td>
<td class="text-right">
<p >$<?= $result['price'] * $qty ?></p>
</td>
</tr>

<?php endforeach ?>
<br>
<tr>
<td>
<h4 >Subtotal</h4>
</td>
<td>
</td>
<td>
</td>
<td>
<p class="text-right h5" style="color:red">$<?= $total ?></p>
</td>
</tr>

<tr>
<td>
<h4>Shipping</h4>
</td>
<td>
</td>
<td>
</td>
<td>
<p class="text-right h5" style="color:red">Flat rate: $<?= $ship ?></p>
</td>
</tr>
<tr>
<td>
<h2 >Total</h2>
</td>
<td>
</td>
<td>
</td>
<td>
<p class="text-right h4"style="color:blue; ">$<?= $total + $ship ?></p>
</td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="col-lg-12">
    <h3>Fill Address</h3>
<form class="row contact_form" action="https://preview.colorlib.com/theme/karma/contact_process.php" method="post" id="contactForm" novalidate="novalidate">
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" id="street" street="street" placeholder="Enter your street" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'">
</div>
<div class="form-group">
<input type="email" class="form-control" id="city" name="city" placeholder="Enter city address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
</div>
<div class="form-group">
<input type="text" class="form-control" id="country" name="country" placeholder="Enter country" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'">
</div>
<div class="form-group">
<input type="text" class="form-control" id="postcode" name="postcode" placeholder="Enter postcode" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'">
</div>
</div>


</form>
</div>

<div class="payment_item d-flex flex-right col-lg-12">

<div class="payment_item active" >

<br>

<br>
<a class="primary-btn  "style="color:black" href="cart.php">Back </a>
<a class="primary-btn " href="confirmation.php">Proceed </a>
</div>
</div>
</div>
</div>
</div>
</section>

<?php include('footer.php') ?>
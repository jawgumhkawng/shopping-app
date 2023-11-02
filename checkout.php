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
<div class="col-lg-8">
<h3>Billing Details</h3>

</div>
<div class="col-lg-12">
<div class="order_box">
<h2>Your Order</h2>
<?php 
 $id = $_SESSION['user_id'];

 $stmt = $pdo->prepare("SELECT * FROM products WHERE id=$id");
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);

 $total += $result['price'] * $qty;
 
?>

<ul class="list">
<li><a href="#">Product <span>Total</span></a></li>
<li><a href="#"><?= $result['name'] ?> <span class="middle">x <?= $result['price'] * $qty ?></span> <span class="last">$720.00</span></a></li>

</ul>
<ul class="list list_2">
<li><a href="#">Subtotal <span>$2160.00</span></a></li>
<li><a href="#">Shipping <span>Flat rate: $50.00</span></a></li>
<li><a href="#">Total <span>$2210.00</span></a></li>
</ul>
<div class="payment_item">
<div class="radion_btn">

</div>
<div class="payment_item active">
<div class="radion_btn">

</div>
<br>
<div class="creat_account">
<input type="checkbox" id="f-option4" name="selector">
<label for="f-option4">I’ve read and accept the </label>
<a href="#">terms & conditions*</a>
</div>
<br>
<a class="primary-btn" href="#">Proceed </a>
</div>
</div>
</div>
</div>
</div>
</section>


<?php include('footer.php') ?>
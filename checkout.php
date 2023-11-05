<?php include('header.php') ?>

<?php 
require 'config/config.php';

if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {

   header('Location: login.php');
   
   }
?>
<?php 
$Id = $_SESSION['user_id'];
$total = 0;
   foreach ($_SESSION['cart'] as $key => $qty){
      $id =str_replace('id','',$key);
      $stmt = $pdo->prepare("SELECT * FROM products WHERE id =".$id);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $total += $result['price'] * $qty;
   }
 //insert in sale_order table

 $stmt = $pdo->prepare("INSERT INTO sale_order(user_id,total_price,order_date) VALUES(?,?,?)");
 $result = $stmt->execute([$Id,$total,date('Y-m-d H:i:s')]);

 if($result) {

   $saleOrderId = $pdo->lastInsertId();

 //insert into sale_order_detail table

   foreach ($_SESSION['cart'] as $key => $qty){
      $id =str_replace('id','',$key);

   $stmt = $pdo->prepare("INSERT INTO sale_order_detail(sale_order_id,product_id,quantity,order_date) VALUES(?,?,?,?)");
   $result = $stmt->execute([$saleOrderId,$id,$qty,date('Y-m-d H:i:s')]);

   $Qstmt = $pdo->prepare("SELECT quantity FROM products WHERE id=".$id);
   $Qstmt->execute();
   $Qresult = $Qstmt->fetch(PDO::FETCH_ASSOC);

//update quantity in products table

   $updateQty = $Qresult['quantity'] - $qty;

   $stmt = $pdo->prepare("UPDATE products SET quantity=? WHERE id=?");
   $result = $stmt->execute([$updateQty,$id]);


      
   }
   
 }

?>

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



$total = 0;
   foreach ($_SESSION['cart'] as $key => $qty) : 
   $id =str_replace('id','',$key);


   $stmt = $pdo->prepare("SELECT * FROM products WHERE id =".$id);
   $stmt->execute();
   $result = $stmt->fetch(PDO::FETCH_ASSOC);

   $total += $result['price'] * $qty;

   $ship = 0.00;

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


<div class="payment_item d-flex flex-right col-lg-12">
<div class="payment_item active" >
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
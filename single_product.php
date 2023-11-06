<?php 
session_start();
require 'config/config.php';

if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {

    header('Location: login.php');
    
    }
?>
<?php include('header.php') ?>
<section class="banner-area organic-breadcrumb" style="padding-bottom: 0px !important">
<div class="container">
<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
<div class="col-first">
<h1>Product Details Page</h1>
<nav class="d-flex align-items-center">
<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
<a href="single-product.php">product-details</a>
</nav>
</div>
</div>
</div>
</section>

<?php 

 $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ".$_GET['id']);
 $stmt->execute();
 $result = $stmt->fetchAll();

 $cId = $result[0]['category_id'];

 $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = $cId");
 $stmt->execute();
 $recultCat = $stmt->fetchAll();



?>

<?php if($result) : ?>
<div class="product_image_area mb-5"  style="padding-top: 30px !important;">
<div class="container">
<div class="row s_product_inner">
<div class="col-lg-6 col-md-6">
<div class="single-prd-item ">
<img class="d-flex " src="./admin/images/<?= escape($result[0]['image']) ?>" width="500px" height="500px" style="border-radius:8px;">
</div>
</div>
<div class="col-lg-5 offset-lg-1">
<div class="s_product_text">
<h1 class="text-uppercase"><?= escape($result[0]['name']) ?></h1><br>
<h2>$<?= escape($result[0]['price']) ?></h2>
<?php if($recultCat) : ?>
<ul class="list">
<li><a class="active" href="#"><span>Category</span> : <?= escape($recultCat[0]['name']) ?></a></li>
<li><a class="active" href="#"><span>Availibility</span> : In Stock</a></li>
</ul>
<?php endif ?>
<p><?= escape($result[0]['description']) ?></p>
<form action="add_to_card.php" method="post">
<input name="_token" type="hidden" value="<?= $_SESSION['_token'] ?>">
<input name="id" type="hidden" value="<?= escape($result[0]['id']) ?>">
    <div class="product_count">
    <label for="qty">Quantity:</label>
    <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
    <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
    <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
    </div>
    <div class="card_area d-flex align-items-center mb-5">
    
    <a class="primary-btn" href="index.php">Back</a>
    <button class="primary-btn" href="add_to_card.php" style="border: 0px;">Add to Cart</button>
    
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
<?php endif ?>
<br>
<br>






<?php include('footer.php') ?>
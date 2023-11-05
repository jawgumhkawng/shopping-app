<?php include('header.php') ?>
<?php
require 'config/config.php';

if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {

  header('Location: login.php');
  
  }
?>

<?php
if(!empty($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}

$numOfrecs = 6 ;
$offset = ($pageno - 1) * $numOfrecs;
  
if (empty($_POST['search'])){

    if (!empty($_GET['category_id'])) {
      $category_id = $_GET['category_id'];

      $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = $category_id AND quantity > 0 ORDER BY id DESC");
      $stmt->execute();
      $rawResult = $stmt->fetchAll();            
            
      $total_pages = ceil(count($rawResult) / $numOfrecs);

      $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = $category_id AND quantity > 0 ORDER BY id DESC LIMIT $offset,$numOfrecs ");
      $stmt->execute();
      $result = $stmt->fetchAll();

    } else {

      $stmt = $pdo->prepare("SELECT * FROM products WHERE quantity > 0 ORDER BY id DESC");
      $stmt->execute();
      $rawResult = $stmt->fetchAll();            
            
      $total_pages = ceil(count($rawResult) / $numOfrecs);

      $stmt = $pdo->prepare("SELECT * FROM products WHERE quantity > 0 ORDER BY id DESC LIMIT $offset,$numOfrecs ");
      $stmt->execute();
      $result = $stmt->fetchAll();

    }

}else {

$searchKey = $_POST['search'];

$stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%$searchKey%' AND quantity > 0 ORDER BY id DESC");

$stmt->execute();
$rawResult = $stmt->fetchAll();            
       
$total_pages = ceil(count($rawResult) / $numOfrecs);

$stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%$searchKey%' AND quantity > 0 ORDER BY id DESC LIMIT $offset,$numOfrecs ");
$stmt->execute();
$result = $stmt->fetchAll();

}

?>



<section class="banner-area">
<div class="container">
<div class="row fullscreen align-items-center justify-content-start">
<div class="col-lg-12">
<div class="active-banner-slider owl-carousel">

<div class="row single-slide align-items-center d-flex">
<div class="col-lg-5 col-md-6">
<div class="banner-content">
<h1>Nike New <br>Collection!</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
<div class="add-bag d-flex align-items-center">
<a class="add-btn" href><span class="lnr lnr-cross"></span></a>
<span class="add-text text-uppercase">Add to Bag</span>
</div>
</div>
</div>
<div class="col-lg-7">
<div class="banner-img">
<img class="img-fluid" src="img/product/e-p1.png" alt>
</div>
</div>
</div>
<div class="row single-slide">
<div class="col-lg-5">
<div class="banner-content">
<h1>New Jaw <br>Collection!</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
<div class="add-bag d-flex align-items-center">
<a class="add-btn" href><span class="lnr lnr-cross"></span></a>
<span class="add-text text-uppercase">Add to Bag</span>
</div>
</div>
</div>
<div class="col-lg-7">
<div class="banner-img">
<img class="img-fluid" src="img/banner/banner-img.png" alt>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</section>


<div class="container">
<div class="row">
<?php 
 $catstmt = $pdo->prepare("SELECT * FROM categories  ORDER BY id DESC");
 $catstmt->execute();
 $resultCat = $catstmt->fetchAll();


 
?>
  <div class="col-xl-9 col-lg-3 col-md-3 col-12">
  <div class="sidebar-categories " >
   <div class="head">Browse Categories</div>
    <ul class="main-categories">
    <li class="main-nav-list"><a data-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category"><span class="lnr lnr-arrow-right"></span>category<span class="number">(53)</span></a>
    <?php foreach( $resultCat as $key => $value ) :?>
    <ul class="collapse" id="category"  aria-expanded="false" aria-controls="fruitsVegetable">
     <li class="main-nav-list child"><a href="index.php?category_id=<?= $value['id'] ?>"><?= escape($value['name']) ?></a></li>
    </ul>
    <?php endforeach ?>
    </li>

    </ul>
</div>
  </div>
<div class="col-xl-9 col-lg-9 col-md-9">
<div class="filter-bar d-flex flex-wrap align-items-center">

<?php
   $cId = $value['id'];

   $catstmt = $pdo->prepare("SELECT * FROM categories  WHERE id = $cId");
   $catstmt->execute();
   $resultC = $catstmt->fetchAll();
  
   $cName = $resultC[0]['name'];
?>

<?php if(!empty($_POST['search'])) : ?>
  <div class="d-flex mr-auto"> 
     <a class="text-center" style=" width:100px; background-color:white; padding:5px"><span > <?= escape($_POST['search']) ?></span></a>
  </div>
<?php elseif(!empty($_POST['category_id'])) : ?>
   <div class="d-flex mr-auto"> 
     <a class="text-center" style=" width:100px; background-color:white; padding:5px" ><span > <?= escape($_POST['category_id']) ?></span></a>
   </div>
  <?php else : ?>
    <div class="d-flex mr-auto"> 
     <a href="index.php" class="text-center" style=" width:100px; background-color:white; padding:5px" ><span>Products</span> </a>
   </div>
<?php endif ?>




<div class="pagination ">

    <a <?php if($pageno == 1){ echo 'disabled';} ?> 
      href="?pageno=1" >First</a>
      
    <a <?php if($pageno <= 1){ echo 'disabled';} ?> 
      href="<?php if($pageno <= 1) { echo '#';}else{ echo "?pageno=".($pageno-1);} ?>" class="prev-arrow">
    <<</a>
   
   <a href="#" class="active"><?= $pageno; ?></a>

   <a <?php if($pageno >= $total_pages){ echo 'disabled';} ?> 
     href="<?php if($pageno >= $total_pages) { echo '#';}else{ echo "?pageno=".($pageno+1);} ?>" class="next-arrow">
     >></a>

   <a <?php if($pageno >= $total_pages){ echo 'disabled';} ?> 
     href="?pageno=<?= $total_pages ?>" >Last</a>
</div>
</div>

<br>

<section class="lattest-product-area pb-40 category-list" >
<div class="col-lg-12">
<div class="row">
<?php foreach ($result as $key => $value) :?>
<div  class="col-lg-4 col-md-6">
<div class="single-product">
<a href="single_product.php?id=<?= $value['id'] ?>">
<img class="img-fluid " src="./admin/images/<?= escape($value['image']) ?>" alt style=" height : 210px !important">

<div class="product-details">
 <h3 style="color: dark;" class="d-flex text-uppercase"><?= escape($value['name']) ?></h3>
 <h6 style="color: orange;" class="text-muted">$<?= escape($value['price']) ?></h6>
 </a>
 <p style="cursor: pointer;" class=""><?= escape(substr($value['description'],0,23)) ?>...</p>
 
<form action="add_to_card.php" method="post">
<input name="_token" type="hidden" value="<?= $_SESSION['_token'] ; ?>">
<input name="id" type="hidden" value="<?= escape($value['id']) ?>">
<input name="qty" type="hidden" value="1">

<div class="prd-bottom">
  <div class="social-info">
    <button class="social-info" type="submit" style="display: contents;">
    <span class="ti-bag"></span><p class="hover-text" style="left: 19px;">add to bag</p>
    </button>
  </div>


<a href="single_product.php?id=<?= $value['id'] ?>" class="social-info">
<span class="lnr lnr-move"></span>
<p class="hover-text" style="left: 33px;">view more</p>
</a>
</div>
</form>
</div>
</div>
</div>
<?php endforeach ?>

<?php if(!$result) :?>

  
<h2 class="text-uppercase " style="color: red; " >Results Not Found:(</h2>
  
<?php endif ?>
</div>
</div>
</section>



</div>
</div>


<section class="features-area section_gap">
<div class="container">
<div class="row features-inner">

<div class="col-lg-3 col-md-6 col-sm-6">
<div class="single-features">
<div class="f-icon">
<img src="img/features/f-icon1.png" alt>
</div>
<h6>Free Delivery</h6>
<p>Free Shipping on all order</p>
</div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6">
<div class="single-features">
<div class="f-icon">
<img src="img/features/f-icon2.png" alt>
</div>
<h6>Return Policy</h6>
<p>Free Shipping on all order</p>
</div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6">
<div class="single-features">
<div class="f-icon">
<img src="img/features/f-icon3.png" alt>
</div>
<h6>24/7 Support</h6>
<p>Free Shipping on all order</p>
</div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6">
<div class="single-features">
<div class="f-icon">
<img src="img/features/f-icon4.png" alt>
</div>
<h6>Secure Payment</h6>
<p>Free Shipping on all order</p>
</div>
</div>
</div>
</div>
</section>

<section class="category-area mt-5">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-8 col-md-12">
<div class="row">
<div class="col-lg-8 col-md-8">
<div class="single-deal">
<div class="overlay"></div>
<img class="img-fluid w-100" src="img/category/c1.jpg" alt>
<a href="index.php" class="img-pop-up" >
<div class="deal-details">
<h6 class="deal-title">Sneaker for Sports</h6>
</div>
</a>
</div>
</div>
<div class="col-lg-4 col-md-4">
<div class="single-deal">
<div class="overlay"></div>
<img class="img-fluid w-100" src="img/category/c2.jpg" alt>
<a href="index.php" class="img-pop-up" >
<div class="deal-details">
<h6 class="deal-title">Sneaker for Sports</h6>
</div>
</a>
</div>
</div>
<div class="col-lg-4 col-md-4">
<div class="single-deal">
<div class="overlay"></div>
<img class="img-fluid w-100" src="img/category/c3.jpg" alt>
<a href="index.php" class="img-pop-up" >
<div class="deal-details">
<h6 class="deal-title">Product for Couple</h6>
</div>
</a>
</div>
</div>
<div class="col-lg-8 col-md-8">
<div class="single-deal">
<div class="overlay"></div>
<img class="img-fluid w-100" src="img/category/c4.jpg" alt>
<a href="index.php" class="img-pop-up" >
<div class="deal-details">
<h6 class="deal-title">Sneaker for Sports</h6>
</div>
</a>
</div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6">
<div class="single-deal">
<div class="overlay"></div>
<img class="img-fluid w-100" src="img/category/c5.jpg" alt>
<a href="index.php" class="img-pop-up" >
<div class="deal-details">
<h6 class="deal-title">Sneaker for Sports</h6>
</div>
</a>
</div>
</div>
</div>
</div>
</section>


<section class="brand-area section_gap">
<div class="container">
<div class="row">
<a class="col single-img" href="#">
<img class="img-fluid d-block mx-auto" src="img/brand/1.png" alt>
</a>
<a class="col single-img" href="#">
<img class="img-fluid d-block mx-auto" src="img/brand/2.png" alt>
</a>
<a class="col single-img" href="#">
<img class="img-fluid d-block mx-auto" src="img/brand/3.png" alt>
</a>
<a class="col single-img" href="#">
<img class="img-fluid d-block mx-auto" src="img/brand/4.png" alt>
</a>
<a class="col single-img" href="#">
<img class="img-fluid d-block mx-auto" src="img/brand/5.png" alt>
</a>
</div>
</div>
</section>


<?php include('footer.php') ?>
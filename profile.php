<?php include('header.php') ?>

<?php
 require 'config/config.php' ;
 
if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {

    header('Location: login.php'); }
?>
<section class="banner-area organic-breadcrumb">
<div class="container">
<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
<div class="col-first">
<h1>Profile Page</h1>
<nav class="d-flex align-items-center">
<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
<a href="profile.php">profile</a>
</nav>
</div>
</div>
</div>
</section><br><br><br>

<?php
 $id = $_SESSION['user_id'];

 $stmt = $pdo->prepare("SELECT * FROM users WHERE id=$id");
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<section class=" section_gap_bottom">
<div class="container">
<!-- <div id="mapBox" class="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia." data-mlat="40.701083" data-mlon="-74.1522848">
</div> -->
<?php if($result) : ?>
<div class="row">
<div class="col-lg-4">
<div class="contact_info">
<div class="info_item">
<i class="fa-regular fa-user"></i>
<h6><?= $result['name'] ?></h6>
<p>User Name</p>
</div>
<div class="info_item">
<i class="fa-solid fa-phone"></i>
<h6><a href="#"><?= $result['phone'] ?></a></h6>
<p>Telephone</p>
</div>
<div class="info_item">
<i class="fa-solid fa-envelope"></i>
<h6><a href="#"><span class="__cf_email__" data-cfemail="9feceaefeff0edebdffcf0f3f0edf3f6fdb1fcf0f2"><?= $result['email'] ?></span></a></h6>
<p>Email</p>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="contact_info">
<div class="info_item">
<i class="fa-solid fa-house"></i>
<h6><?= $result['address'] ?></h6>
<p>Address</p>
</div>
<div class="info_item">
<i class="fa-solid fa-briefcase"></i>
<h6><a href="#"><?= $result['work'] ?></a></h6>
<p>Work</p>
</div>
<div class="info_item">
<i class="fa-solid fa-calendar-days"></i>
<h6><a href="#"><span class="__cf_email__" data-cfemail="9feceaefeff0edebdffcf0f3f0edf3f6fdb1fcf0f2"><?= $result['created_at'] ?></span></a></h6>
<p>Created Date</p>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="contact_info">
<img src="./profile_image/<?= $result['image']?>" alt="" width="200px" height="200px" style="border-radius:10px; border:2px solid grey">
</div>
</div>
</div>
<?php endif ?>
</div>

</section>


<?php include('footer.php') ?>
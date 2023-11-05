<?php
session_start();
 require 'config/config.php' ; 
 
 ?>

<?php 
if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {

    header('Location: login.php'); }
?>
<?php include('header.php') ?>

<section class="banner-area organic-breadcrumb">
<div class="container">
<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
<div class="col-first">
<h1>Contact Us</h1>
<nav class="d-flex align-items-center">
<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
<a href="contact.php">Contact</a>
</nav>
</div>
</div>
</div>
</section>


<section class="contact_area section_gap_bottom">
<div class="container">
<div id="mapBox" class="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia." data-mlat="40.701083" data-mlon="-74.1522848">
</div>
<div class="row">
<div class="col-lg-3">
<div class="contact_info">
<div class="info_item">
<i class="lnr lnr-home"></i>
<h6>California, United States</h6>
<p>Santa monica bullevard</p>
</div>
<div class="info_item">
<i class="lnr lnr-phone-handset"></i>
<h6><a href="#">00 (440) 9865 562</a></h6>
<p>Mon to Fri 9am to 6 pm</p>
</div>
<div class="info_item">
<i class="lnr lnr-envelope"></i>
<h6><a href="#"><span class="__cf_email__" data-cfemail="9feceaefeff0edebdffcf0f3f0edf3f6fdb1fcf0f2">[email&#160;protected]</span></a></h6>
<p>Send us your query anytime!</p>
</div>
</div>
</div>

<?php 

if ($_POST) {
    if(empty($_POST['subject']) || empty($_POST['message']) ) {

        if(empty($_POST['subject'])){
            $subError = 'is required';
        }
        if(empty($_POST['message'])){
            $msgError = 'is required';
        }
    } else {
        
        if(!empty($_SESSION['user_name'])){
            $_SESSION['user_name'] = $_POST['name'];
        }
        if(!empty($_SESSION['email'])){
            $_SESSION['email'] = $_POST['email'];
        }
        if(!empty($_SESSION['user_id'])){
            $_SESSION['user_id'] = $_POST['user_id'];
        }
        
        
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $stmt = $pdo->prepare("INSERT INTO contact(user_id,name,email,subject,message) VALUES (?,?,?,?,?)");
        $result = $stmt->execute([$_SESSION['user_id'],$_SESSION['user_name'],$_SESSION['email'],$subject,$message]);
        if ($result) {
            echo"<script>alert('Thanks For Your Message!');</script>";
            
           }
      }

            
}
 
?>
<div class="col-lg-9">
<form class="row contact_form" action="contact.php" method="post" id="contactForm" novalidate="novalidate">
<input  name="_token" type="hidden" value="<?= $_SESSION['_token'] ?>">
<input  name="user_id" type="hidden" value="<?= $_SESSION['user_id'] ?>">

<div class="col-md-6">
<div class="form-group">
<input type="text" class="form-control text-uppercase" style="color: gray;" id="name" name="name" value="<?= escape($_SESSION['user_name']) ?>" readonly>
</div>
<div class="form-group">
<input type="email" class="form-control" id="email" style="color: gray;" name="email" value="<?= escape($_SESSION['email']) ?>" readonly>
</div>
<div class="form-group">
<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject <?= empty($subError) ? '' :$subError ?>" onfocus="this.placeholder = ''" 
style="<?= empty($subError) ? '' : 'border: 1px solid red'; ?>" onblur="this.placeholder = 'Enter Subject'">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<textarea class="form-control" name="message" id="message" rows="1" placeholder="Message <?= empty($msgError) ? '' :$msgError ?>" onfocus="this.placeholder = ''"
style="<?= empty($msgError) ? '' : 'border: 1px solid red'; ?>" onblur="this.placeholder = 'Enter Message'"></textarea>
</div>
</div>
<div class="col-md-12 text-right">
<button type="submit" value="submit" class="primary-btn">Send Message</button>
</div>
</form>
</div>
</div>
</div>
</section>


<?php include('footer.php') ?>
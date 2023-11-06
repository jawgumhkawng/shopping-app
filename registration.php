<?php 
session_start();

require 'config/config.php';
require 'config/common.php';


if ($_POST) {
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['work']) || empty($_POST['phone'])
    || empty($_POST['address']) || strlen($_POST['password']) < 8 ) {

        if(empty($_POST['name'])){
            $nameError = 'is required';
        }
        if(empty($_POST['email'])){
            $emailError = 'is required';
        }
        if(empty($_POST['password'])){
            $passwordError = 'is required';
        }
        if(strlen($_POST['password']) < 8){
            $passwordError = 'Password should be 8 chars at least';
        }
        if(empty($_POST['phone'])){
            $phoneError = 'is required';
        }
        if(empty($_POST['address'])){
            $addressError = 'is required';
        }
        if(empty($_POST['work'])){
            $workError = 'is required';
        }
       
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $work = $_POST['work'];
        $role = 0;
        $image = $_FILES['image']['name'];

        $file = 'profile_image/'.($_FILES['image']['name']);
        $imageType = pathinfo($file,PATHINFO_EXTENSION);

  if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg') {
    echo"<script>alert('Image must be png,jpg or jpeg!')</script>";
  }else {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->bindValue(':email',$email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user) {
        echo "<script>alert('This Email Already Exit!');</script>";
    } else {
        move_uploaded_file($_FILES['image']['tmp_name'],$file);

        $stmt = $pdo->prepare("INSERT INTO users(name,email,phone,role,password,work,address,image) VALUES (:name,:email,:phone,:role,:password,:work,:address,:image)");
        $result = $stmt->execute(
          array(':name'=>$name,':email'=>$email,':phone'=>$phone,':role'=>$role,':password'=>$password,':work'=>$work,':address'=>$address,':image'=>$image)
        );
     
     

        if ($result) {
            echo"<script>alert('Registeration Success!');window.location.href='login.php';</script>";
            
           }
    }
  }
}

}
?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<!-- Mirrored from preview.colorlib.com/theme/karma/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Sep 2023 06:48:32 GMT -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="shortcut icon" href="img/fav.png">

<meta name="author" content="CodePixar">

<meta name="description" content>

<meta name="keywords" content>

<meta charset="UTF-8">

<title>Jaw's Shop</title>

<link rel="stylesheet" href="css/linearicons.css">
<link rel="stylesheet" href="css/owl.carousel.css">
<link rel="stylesheet" href="css/themify-icons.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/nice-select.css">
<link rel="stylesheet" href="css/nouislider.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/main.css">
<!-- <script nonce="9859e956-4b69-4862-aa38-faf60920ac5e">(function(w,d){!function(a,b,c,d){a[c]=a[c]||{};a[c].executed=[];a.zaraz={deferred:[],listeners:[]};a.zaraz.q=[];a.zaraz._f=function(e){return async function(){var f=Array.prototype.slice.call(arguments);a.zaraz.q.push({m:e,a:f})}};for(const g of["track","set","debug"])a.zaraz[g]=a.zaraz._f(g);a.zaraz.init=()=>{var h=b.getElementsByTagName(d)[0],i=b.createElement(d),j=b.getElementsByTagName("title")[0];j&&(a[c].t=b.getElementsByTagName("title")[0].text);a[c].x=Math.random();a[c].w=a.screen.width;a[c].h=a.screen.height;a[c].j=a.innerHeight;a[c].e=a.innerWidth;a[c].l=a.location.href;a[c].r=b.referrer;a[c].k=a.screen.colorDepth;a[c].n=b.characterSet;a[c].o=(new Date).getTimezoneOffset();if(a.dataLayer)for(const n of Object.entries(Object.entries(dataLayer).reduce(((o,p)=>({...o[1],...p[1]})),{})))zaraz.set(n[0],n[1],{scope:"page"});a[c].q=[];for(;a.zaraz.q.length;){const q=a.zaraz.q.shift();a[c].q.push(q)}i.defer=!0;for(const r of[localStorage,sessionStorage])Object.keys(r||{}).filter((t=>t.startsWith("_zaraz_"))).forEach((s=>{try{a[c]["z_"+s.slice(7)]=JSON.parse(r.getItem(s))}catch{a[c]["z_"+s.slice(7)]=r.getItem(s)}}));i.referrerPolicy="origin";i.src="../../cdn-cgi/zaraz/sd0d9.js?z="+btoa(encodeURIComponent(JSON.stringify(a[c])));h.parentNode.insertBefore(i,h)};["complete","interactive"].includes(b.readyState)?zaraz.init():a.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,"zarazData","script");})(window,document);</script> -->
</head>
<body>


<section class="login_box_area section_gap ">
<div class="container">
<div class="row ">
   
<div class="col-lg-12">
<br>
 <div class="login_form_inner rounded-2 mt-0">
 <h2 class="col-sm-12 mt-0 " style="color: gray;">Registration Form</h2><br><br>
    <form class="row login_form mt-0" action="registration.php" method="post" id="contactForm"  novalidate="novalidate" enctype="multipart/form-data">
    <input name="_token" type="hidden" value="<?= $_SESSION['_token'] ?>">
    
        <div class="col-md-12 form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="Username <?= empty($nameError) ? '' :$nameError ?>"
            style="<?= empty($nameError) ? '' : 'border: 1px solid red'; ?>"
            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
        </div>
        <div class="col-md-12 form-group">
            <input type="email" class="form-control" id="email" name="email" placeholder="email <?= empty($emailError) ? '' :$emailError ?>" 
            style="<?= empty($emailError) ? '' : 'border: 1px solid red'; ?>"
            onfocus="this.placeholder = ''" onblur="this.placeholder = 'email'">
        </div>
        <div class="col-md-12 form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password <?= empty($passwordError) ? '' :$passwordError ?>" 
            style="<?= empty($passwordError) ? '' : 'border: 1px solid red'; ?>"
            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
        </div>
        <div class="col-md-12 form-group">
            <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone <?= empty($phoneError) ? '' :$phoneError ?>" 
            style="<?= empty($phoneError) ? '' : 'border: 1px solid red'; ?>"
            onfocus="this.placeholder = ''" onblur="this.placeholder = 'phone'">
        </div>
        <div class="col-md-12 form-group">
            <input type="text" class="form-control" id="address" name="address" placeholder="Address <?= empty($addressError) ? '' : $addressError ?>"
            style="<?= empty($addressError) ? '' : 'border: 1px solid red'; ?>"
            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'">
        </div>
        <div class="col-md-12 form-group">
            <input type="text" class="form-control" id="work" name="work" placeholder="Work <?= empty($workError) ? '' :$workError ?>"
            style="<?= empty($workError) ? '' : 'border: 1px solid red'; ?>"
            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Work'">
        </div>
       
        <div class="col-md-12 form-group">
        
            <input type="file" class="form-control" id="image" name="image" required >
        </div>
       <br><br>
       <br><br>
       <br><br>
       
        <div class="col-md-12 form-group">
            <button type="submit" value="submit" class="primary-btn  "style="border-radius: 7px;">Sgin Up</button>
        </div>
        <br>
        <br>
       
        <div class="col-md-12 ">
        <p class="d-flex ml-3">Have an account ? &nbsp;<a href="login.php"> Login here..</a></p>
        </div>
        <br>
        <br>
    </form>
</div>
</div>
</div>
</div>
</section>


<footer class="footer ">
    <div class="container">
        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
            <p class="footer m-0">
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved  <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank">J web</a>

            </p>
        </div>
    </div>
</footer>

<script src="js/vendor/jquery-2.2.4.min.js"></script>
<!-- <script src="../../../cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> -->
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/nouislider.min.js"></script>
<!-- <script src="js/countdown.js"></script> -->
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script> -->
<script src="js/gmaps.min.js"></script>
<script src="js/main.js"></script>

<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script> -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854" integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg==" data-cf-beacon='{"rayId":"80a05af12f383fc9","version":"2023.8.0","b":1,"token":"cd0b4b3a733644fc843ef0b185f98241","si":100}' crossorigin="anonymous"></script>
</body>

<!-- Mirrored from preview.colorlib.com/theme/karma/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Sep 2023 06:48:07 GMT -->
</html>
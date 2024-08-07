
<?php 
   if(session_status()==PHP_SESSION_NONE){
    session_start();
  }
  require 'config/common.php';

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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
.nav-items:hover{
 color: rgb(239, 164, 28) !important;
}

</style>
</head>
<body>

<header class="header_area sticky-header">
<div class="main_menu">
<nav class="navbar navbar-expand-lg navbar-light main_box">
<div class="container">

<a class="navbar-brand logo_h" href="index.php"><img src="img/logo.png" alt></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>

<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
<ul class="nav navbar-nav menu_nav ml-auto">
</ul>
<ul class="nav navbar-nav menu_nav navbar-right">
<li class="nav-item " style="font-size: large; display:block;"><a href="index.php" class=""><span><i class="fa-solid fa-house nav-items"></i></span></a></li>
<li class="nav-item " style="font-size: large; display:block;"><a href="contact.php" class=""><span><i class="fa-solid fa-comments nav-items"></i></span></a></li>



<?php 
          $link = $_SERVER['PHP_SELF'];
          $link_array = explode('/',$link);
          $page = end($link_array);
 ?>
<?php

$count = 0;
if(isset($_SESSION['cart'])){
  foreach( $_SESSION['cart'] as $key => $qty ) {
   $count += $qty;
  }
}
?>

<li class="nav-item "><a href="cart.php" class="cart"><span style="color: white;background-color:red; margin-top:10px; border: 2px solid red; border-radius:80px; padding:2px"><?= $count ?></span><span class="ti-bag nav-items" style="font-size: large;"></span></a></li>
<?php if(!empty($_SESSION['user_id']) && !empty($_SESSION['logged_in']) ) : ?>
  <li class="nav-item " style="font-size: large; display:block;"><a href="profile.php" class=""><span><i class="fa-solid fa-user nav-items"></i></span></a></li>
<?php endif ?>
<?php if($page == 'index.php')  : ?>
  <li class="nav-item">
<button class="search"><span style="font-size: large; font-weight:700" class="lnr lnr-magnifier nav-items" id="search"></span></button>
</li>
  <?php endif ?>
  <li class="nav-item" style="font-size: large; display:block;"><a href="logout.php" class=""><span><i class="fa-solid fa-right-from-bracket nav-items"></i></span></a></li>

</ul>
</div>
</div>
</nav>
</div>
<?php if($page == 'index.php')  : ?>
<div class="search_input" id="search_input_box">
<div class="container">
<form class="d-flex justify-content-between" action="index.php" method="post">
<input name="_token" type="hidden" value="<?= $_SESSION['_token'] ?>">
<input type="text" class="form-control" id="search_input" name="search" placeholder="Search Here">
<button type="submit" class="btn"></button>
<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
</form>
</div>
</div>
<?php endif ?>
</header>
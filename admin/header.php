
<?php 
if(session_status()==PHP_SESSION_NONE){
  session_start();
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id=".$_SESSION['user_id']);
$stmt->execute();
$adResult = $stmt->fetchAll();   
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jaw' Shop | Admin Page</title>

  
  <link rel="shortcut icon" href="../img/fav.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <!-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- datatable -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
 
</head>
<body class="hold-transition sidebar-mini">




<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <?php 
          $link = $_SERVER['PHP_SELF'];
          $link_array = explode('/',$link);
          $page = end($link_array);
        ?>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
     <?php if($page == 'index.php' || $page == 'category.php' || $page == 'user_list.php' ) : ?>
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline" method="post"  
          
          <?php if($page == 'index.php') :?>
               action='index.php' 
            <?php elseif($page == 'category.php') : ?>
              action='category.php' 
            <?php elseif($page == 'user_list.php') : ?>
              action='user_list.php'
            <?php endif ?>
          >
          <input name="_token" type="hidden" value="<?= $_SESSION['_token'] ?>">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit" >
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      
        <?php endif ?>
    </ul>
  </nav>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <a class="navbar-brand logo_h" href="index.php"><img src="../img/logo.png" alt height="40px" class="ml-3"></a>
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text  text-white"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="../profile_image/<?= $adResult[0]['image'] ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-uppercase"><b class="text-info">Admin </b>: <?= $adResult[0]['name'] ?></a>
          

        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php 
                  $stmt = $pdo->prepare("SELECT * FROM products ");
                  $stmt->execute();
                  $resultProduct = $stmt->fetchAll();

                  $total_product= count($resultProduct) ;
              ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Product Admin Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview mt-4">
              <li class="nav-item list active">
                <a href="index.php" class="nav-link ">
                  <i class="nav-icon fas fa-th"></i>
                  <p>Products&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?= $total_product ?>
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
              </li>
              <?php 
                  $stmt = $pdo->prepare("SELECT * FROM categories ");
                  $stmt->execute();
                  $resultCategory = $stmt->fetchAll();

                  $total_category= count($resultCategory) ;
              ?>
              <li class="nav-item list">
                <a href="category.php" class="nav-link ">
                <i class="nav-icon fa-solid fa-clipboard-list"></i>
                  <p>Category&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;<?= $total_category ?>
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
              </li>
              <?php 
                  $stmt = $pdo->prepare("SELECT * FROM users ");
                  $stmt->execute();
                  $resultUsers = $stmt->fetchAll();

                  $total_user = count($resultUsers) ;
              ?>
              <li class="nav-item list " >
                <a href="user_list.php" class="nav-link ">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Users&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $total_user ?>
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
              </li>
              <?php 
                  $stmt = $pdo->prepare("SELECT * FROM sale_order ");
                  $stmt->execute();
                  $resultOrder = $stmt->fetchAll();

                  $total_order = count($resultOrder) ;
              ?>
              <li class="nav-item list " >
                <a href="order_list.php" class="nav-link ">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Orders&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;<?= $total_order ?>
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
              </li>
              <?php 
              $stmt = $pdo->prepare("SELECT * FROM contact ");
              $stmt->execute();
              $resultC = $stmt->fetchAll();   
              
              $total_message = count($resultC) ;
              ?>
              <li class="nav-item list " >
                <a href="message.php" class="nav-link ">
                <i class=" nav-icon fa-solid fa-message"></i>
                  <p>Message&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;<?= $total_message ?>
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
              </li>
              <?php

              $currentDate = date("Y-m-d");
              $fromDate = date("Y-m-d",strtotime($currentDate . '+ 1 day'));
              $toDate = date("Y-m-d",strtotime($currentDate . '- 7 day'));


              $Ordstmt = $pdo->prepare("SELECT * FROM sale_order WHERE order_date < ? AND order_date >= ? ORDER BY id DESC");
              $Ordstmt->execute([$fromDate,$toDate]);
              $Result_WRP = $Ordstmt->fetchAll();  

              $total_WRP = count($Result_WRP) ;      
              ?>
              <li class="nav-item list " >
                <a href="weekly_report.php" class="nav-link ">
                <i class="nav-icon fa-regular fa-flag"></i>
                  <p>Weekly Reports&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $total_WRP ?>  
                                      
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
              </li>
              <?php

              $currentMonth = date("Y-m-d");
              $fromMonth = date("Y-m-d",strtotime($currentMonth . '+ 1 month'));
              $toMonth = date("Y-m-d",strtotime($currentMonth . '- 7 month'));


              $Ordstmt = $pdo->prepare("SELECT * FROM sale_order WHERE order_date < ? AND order_date >= ? ORDER BY id DESC");
              $Ordstmt->execute([$fromMonth,$toMonth]);
              $ResultMRP = $Ordstmt->fetchAll();  

              $total_MRP= count($ResultMRP) ;   
              ?>
              <li class="nav-item list " >
                <a href="monthly_report.php" class="nav-link ">
                <i class="nav-icon fa-solid fa-flag"></i>
                  <p>Monthly Reports&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;  <?= $total_MRP ?>
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
              </li>
              <?php 
              $Rostmt = $pdo->prepare("SELECT * FROM sale_order WHERE total_price >= '200000'  ORDER BY id DESC");
              $Rostmt->execute();
              $RoyResult = $Rostmt->fetchAll();

              $total_ROY = count($RoyResult) ;  
              ?>
              <li class="nav-item list " >
                <a href="royal_cus.php" class="nav-link ">
                <i class="nav-icon fa-solid fa-crown"></i>
                  <p>Royal Customers&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?= $total_ROY ?>
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
              </li>
              <?php 
              $BestSIstmt = $pdo->prepare("SELECT * FROM sale_order_detail GROUP BY product_id HAVING SUM(quantity) < 10  ORDER BY id DESC");
              $BestSIstmt->execute();
              $BestSIResult = $BestSIstmt->fetchAll(); 

              $total_BSI = count($BestSIResult) ;  
              ?>
              <li class="nav-item list " >
                <a href="best_seller_items.php" class="nav-link ">
                <i class="nav-icon fa-solid fa-star"></i>
                  <p>Best Seller Items&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?= $total_BSI ?>
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
              </li>

              <li class="nav-item list mt-5" style="">
                <a href="logout.php" class="col-12  btn btn-outline-danger">
                  <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                  Logout 
                </a>
              </li>
            </ul>
          </li>
        </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
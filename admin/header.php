<?php 
$stmt = $pdo->prepare("SELECT * FROM users ORDER BY id DESC");
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

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>

        <?php 
          $link = $_SERVER['PHP_SELF'];
          $link_array = explode('/',$link);
          $page = end($link_array);
        ?>

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
    </ul>
  </nav>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Jaw's Shop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <!-- <img src="../profile_image/<?= $adResult[0]['image'] ?>" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $adResult[0]['name'] ?></a>
          

        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Product Admin Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview mt-4">
              <li class="nav-item list">
                <a href="index.php" class="nav-link ">
                  <i class="nav-icon fas fa-th"></i>
                  <p>Products
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
              </li>
              <li class="nav-item list">
                <a href="category.php" class="nav-link ">
                <i class="nav-icon fa-solid fa-clipboard-list"></i>
                  <p>Category
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
              </li>
              <li class="nav-item list " >
                <a href="user_list.php" class="nav-link ">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Users
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
              </li>

              <li class="nav-item list mt-5" style="margin-top: 200px !important;">
                <a href="logout.php" class="nav-link btn btn-outline-danger">
                  <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                  Logout 
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
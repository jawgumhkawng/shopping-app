<?php 
session_start();

require '../config/config.php';
require '../config/common.php';

if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {

  header('Location: login.php');

}
if ($_SESSION['role'] != 1) {
  header('Location: login.php');
}
 

if (!empty($_POST["search"])) {
  setcookie("search",$_POST["search"], time() + (89400 * 30), "/");
} else {
if (empty($_GET['pageno'])) {
 unset($_COOKIE["search"]);
 setcookie("search", null, -1, "/");
}
}
?>

<!-- header -->
<?php include('header.php'); ?>

<?php

if(!empty($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$numOfrecs = 5 ;
$offset = ($pageno - 1) * $numOfrecs;
  
if (empty($_POST['search']) && empty($_COOKIE['search'])){
$stmt = $pdo->prepare("SELECT * FROM products ORDER BY id DESC");
$stmt->execute();
$rawResult = $stmt->fetchAll();            
       
$total_pages = ceil(count($rawResult) / $numOfrecs);

$stmt = $pdo->prepare("SELECT * FROM products ORDER BY id DESC LIMIT $offset,$numOfrecs ");
$stmt->execute();
$result = $stmt->fetchAll();

}else {

$searchKey = !empty($_POST['search']) ? $_POST['search'] : $_COOKIE['search'];

$stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%$searchKey%' ORDER BY id DESC");

$stmt->execute();
$rawResult = $stmt->fetchAll();            
       
$total_pages = ceil(count($rawResult) / $numOfrecs);

$stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecs ");
$stmt->execute();
$result = $stmt->fetchAll();

}

?>




         
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-12 mt-3 mb-3">
           <h1 class="mb-3 text-bold d-flex justify-content-center align-items-center btn btn-info " >Product List &nbsp;<i class="fa-solid fas fa-th"></i></h1>
           </div>
          <div class="col-sm-12 ">
            <h1 class="mb-3 float-right mr-3">Product Lists</h1>
            <a href="product_add.php" class="btn btn-outline-success ">New Blogs Post &nbsp; <i class="fa-solid fa-file-circle-plus"></i></a> 

          </div>
 
          <div class="col-md-12 col-lg-12 col-12 ">
            <div class="card">
              <div class="card-header">
              <div class="mr-4 mt-0" >
              <nav aria-label="Page navigation example " style="float:right">
                <ul class="pagination">
                  <li class="page-item  <?php if($pageno == 1){ echo 'disabled';} ?>"><a class="page-link" href="?pageno=1" aria-label="Previous">First </a></li>

                  <li class="page-item  <?php if($pageno <= 1){ echo 'disabled';} ?>">
                      <a class="page-link" href="<?php if($pageno <= 1) { echo '#';}else{ echo "?pageno=".($pageno-1);} ?>">
                  <span aria-hidden="true">&laquo;</span></a></li>

                  <li class="page-item active"><a class="page-link" href="#"><?= $pageno; ?></a></li>

                  <li class="page-item  <?php if($pageno >= $total_pages){ echo 'disabled';} ?>">
                     <a class="page-link" href="<?php if($pageno >= $total_pages) { echo '#';}else{ echo "?pageno=".($pageno+1);} ?>"> 
                  <span aria-hidden="true">&raquo;</span></a></li>

                  <li class="page-item  <?php if($pageno == $total_pages){ echo 'disabled';} ?>"><a class="page-link" href="?pageno=<?= $total_pages ?>" aria-label="Next">Last</a></li>
                </ul>
              </nav>
              </div>
         
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>

                    <tr>
                      <th class="text-center" style="width: 5%">#</th>
                      <th class="text-center" style="width: 10%">Image</th>
                      <th class="text-center" style="width: 15%">Name</th>
                      <th class="text-center" style="width: 20%">Description</th>
                      <th class="text-center" style="width: 10%">Category</th>
                      <th class="text-center" style="width: 15%">In Stock</th>
                      <th class="text-center" style="width: 12%">Price</th>
                      <th class="text-center" style="width: 14%">Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php if ($result) : ?>
                      <?php $i = 1; ?>
                      <?php foreach ($result as  $value) : ?>
                          <?php
                            $stmtCat = $pdo->prepare("SELECT * FROM categories WHERE id = ".$value['category_id']);
                            $stmtCat->execute();
                            $resultCat = $stmtCat->fetchAll();
                          
                            ?>
                           
                           
                          <tr>
                            <td><?= $i; ?></td>
                            <td class="text-center"><img src="./images/<?= escape($value['image']) ?>" width="30"  height="30" style="border:10px !important;" class="rounded-circle shadow"></td>
                            <td class="text-center"><?= escape(substr($value['name'],0,11)) ?></td>
                            <td class="text-center"><?= escape(substr($value['description'],0,30)) ?>...</td>
                            <td class="text-center"> <?= escape($resultCat[0]['name'])?></td>   
                            <?php if($value['quantity'] == 0 )  : ?>
                              <td class="text-center text-danger"> unavailable </td>
                            <?php elseif($value['quantity'] < 5 ) : ?>
                              <td class="text-center text-danger"> <?= escape($value['quantity'])?> </td>
                            <?php else : ?>  
                              <td class="text-center "> <?= escape($value['quantity'])?></td>
                            <?php endif ?>  

                            <td class="text-center"> <?= escape($value['price'])?></td>   
                            <td>
                              <a href="product_edit.php?id=<?= escape($value['id']) ?>" type="button" class="btn btn-outline-warning btn-sm btn-group ml-2"><i class="fa-solid fa-pen-to-square "></i></a>
                              <a href="product_delete.php?id=<?= $value['id'] ?>" type="button" class="btn btn-outline-danger btn-sm btn-group" onclick="return confirm('Are you sure you want to delete this blog!')">
                              <i class="fa-solid fa-trash"></i></a>
                            </td>
                          </tr>  

                        <?php $i++; ?>
                        <?php endforeach ?>
                      <?php endif ?>
                  </tbody>
                </table>
              </div>
             
              </div>
          
            </div> 
            <?php if(!$result) :?>

  
            <h2 class="text-uppercase" style="color: red; margin-left:310px" >Results Not Found:(</h2>
              
            <?php endif ?>
            </div>
          </div>
          
          
          <!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div>/.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
  
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
 <?php include('footer.php'); ?>

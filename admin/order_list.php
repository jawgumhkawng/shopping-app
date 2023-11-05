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
 


if(!empty($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$numOfrecs = 5 ;
$offset = ($pageno - 1) * $numOfrecs;
  


$stmt = $pdo->prepare("SELECT * FROM sale_order ORDER BY id DESC");
$stmt->execute();
$rawResult = $stmt->fetchAll();            
       
$total_pages = ceil(count($rawResult) / $numOfrecs);

$stmt = $pdo->prepare("SELECT * FROM sale_order ORDER BY id DESC LIMIT $offset,$numOfrecs ");
$stmt->execute();
$result = $stmt->fetchAll();



?>


<!-- header -->
<?php include('header.php'); ?>

         
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-12 mt-3 mb-3">
         <h1 class="mb-3 text-bold d-flex justify-content-center align-items-center btn btn-info " >Order List &nbsp;<i class="fa-solid fas fa-table"></i></h1>
         </div>

          <div class="col-sm-12 ">
            <h1 class="mb-3 float-right mr-3">Order Lists</h1>
            <a href="#" class="btn btn-outline-success ">Order View Page &nbsp; <i class="fa-solid fa-table"></i></a> 

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
                      <th class="text-center" style="width: 20%">User Name</th>
                      <th class="text-center" style="width: 30%">Total Price</th>
                      <th class="text-center" style="width: 25%">Order Date</th>
                      <th class="text-center" style="width: 20%">More</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                      <?php if($result) : ?>
                      <?php $i = 1; ?>
                      <?php foreach ($result as $value) : ?>

                        <?php
                            $stmtUser = $pdo->prepare("SELECT * FROM users WHERE id=".$value['user_id']);
                            $stmtUser->execute();
                            $resultUser = $stmtUser->fetchAll();
                          
                            ?>
                          <tr>
                            <td class="text-center"><?= $i; ?></td>
                            <td class="text-center"><?= escape(($resultUser[0]['name'])) ?></td>
                            <td class="text-center"><?= escape($value['total_price']) ?></td>
                            <td class="text-center"><?= escape(date('Y-m-d',strtotime($value['order_date']))) ?></td>
                            <td class="text-center">
                              <a href="order_detail.php?id=<?= $value['id'] ?>" type="button" class="btn btn-warning ">Order Detail   <i class="fa-solid fa-eye"></i></a>
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

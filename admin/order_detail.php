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
 


$stmt = $pdo->prepare("SELECT * FROM sale_order_detail WHERE sale_order_id=".$_GET['id']);
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
          <div class="col-sm-12 ">
            <h1 class="mb-3 float-right mr-3">Order Detail Lists</h1>
            <a href="order_list.php" class="btn btn-success "><i class="right fas fa-angle-left"></i>&nbsp;&nbsp;&nbsp; Back </a> 

          </div>
          
        
          
          <div class="col-md-12 col-lg-12 col-12 ">
            <div class="card">
              <div class="card-header">
              <!-- <div class="mr-4 mt-0" >
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
              </div> -->
        
              
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>

                    <tr>

                      <th class="text-center" style="width: 5%">#</th>
                      <th class="text-center" style="width: 20%">name</th>
                      <th class="text-center" style="width: 10%">pro_img</th>
                      <th class="text-center" style="width: 15%">Pro_name</th>
                      <th class="text-center" style="width: 10%">Quantity</th>
                      <th class="text-center" style="width: 10%">Amounts</th>
                      <th class="text-center" style="width: 30%">Order Date</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result) : ?>
                      <?php $i = 1; ?>
                      <?php foreach ($result as  $value) : ?>

                           <?php

                            $stmtPro = $pdo->prepare("SELECT * FROM products WHERE id=".$value['product_id']);
                            $stmtPro->execute();
                            $resultPro = $stmtPro->fetchAll();

                            $stmtU = $pdo->prepare("SELECT * FROM sale_order WHERE id=".$_GET['id']);
                            $stmtU->execute();
                            $resultS = $stmtU->fetchAll();

                            $UserRe = $resultS[0]['user_id'];

                            $stmtU = $pdo->prepare("SELECT * FROM users WHERE id = $UserRe");
                            $stmtU->execute();
                            $resultU = $stmtU->fetchAll();
                          
                            ?>
                          <tr>

                            <td class="text-center"><?= $i; ?></td>
                            <td class="text-center"><?= escape($resultU[0]['name']) ?></td>
                            <td class="text-center"><img src="./images/<?= escape($resultPro[0]['image']) ?>" width="30"  height="30" style="border:10px !important;" class="rounded-1 "></td>
                            <td class="text-center"><?= escape($resultPro[0]['name']) ?></td>
                            <td class="text-center"><?= escape($value['quantity']) ?></td>
                            <td class="text-center"><?= escape($resultS[0]['total_price']) ?></td>
                            <td class="text-center"><?= escape(date('Y-m-d',strtotime($value['order_date']))) ?></td>
                            
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

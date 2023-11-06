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

// $currentMonth = date("Y-m-d");
// $fromMonth = date("Y-m-d",strtotime($currentMonth . '+ 1 month'));
// $toMonth = date("Y-m-d",strtotime($currentMonth . '- 7 month'));


$Royalstmt = $pdo->prepare("SELECT * FROM sale_order WHERE total_price >= '200000'  ORDER BY id DESC");
$Royalstmt->execute();
$RoyalResult = $Royalstmt->fetchAll();  

       
?>




         
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <!-- <div class="col-sm-12 mt-3 mb-3">
           <h1 class="mb-3 text-bold d-flex justify-content-center align-items-center btn btn-info " >Weekly Reports &nbsp;<i class="fa-solid fa-clipboard"></i></i></h1>
           </div>
           -->
 
          <div class="col-md-12 col-lg-12 col-12 ">
            <div class="card">
              <div class="card-header">
              <div class="mr-4 mt-0" >
              </div>
         
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" id="my_table">
                    <h3 class="text-center text-primary">Royal Users</h3>
                  <thead>

                    <tr>
                      <th class="text-center" width="10%" >Id</th>
                      <th class="text-center" width="10%">Photo</th>
                      <th class="text-center" width="30%">User_Name</th>
                      <th class="text-center" width="20%">Total_Amount</th>
                      <th class="text-center" width="30%">Order_Date</th>
                    
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php if ($RoyalResult) : ?>
                      <?php $i = 1; ?>
                      <?php foreach ($RoyalResult as  $value) : ?>
                          <?php
                            $stmtUser = $pdo->prepare("SELECT * FROM users WHERE id = ".$value['user_id']);
                            $stmtUser->execute();
                            $resultRUser = $stmtUser->fetchAll();
                          
                            ?>
                           
                           
                          <tr>
                            <td class="text-center"><?= $i; ?></td>
                            <td class="text-center"><img src="../profile_image/<?= escape($resultRUser[0]['image']) ?>" width="30"  height="30" style="border:1px solid gray !important;" class="rounded-circle shadow"></td>
                            <td class="text-center"> <?= escape($resultRUser[0]['name'])?></td> 
                            <td class="text-center"><?= escape($value['total_price']) ?></td>                         
                            <td class="text-center"> <?= escape($value['order_date'])?></td>   
                          </tr>  

                        <?php $i++; ?>
                        <?php endforeach ?>
                      <?php endif ?>
                  </tbody>
                </table>
              </div>
             
              </div>
          
            </div> 
            <!-- <?php if(!$result) :?>

  
            <h2 class="text-uppercase" style="color: red; margin-left:310px" >Results Not Found:(</h2>
              
            <?php endif ?> -->
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

 <script>
    let table = new DataTable('#my_table');
 </script>
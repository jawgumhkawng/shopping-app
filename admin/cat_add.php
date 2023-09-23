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


if ($_POST) {
  if (empty($_POST['name']) || empty($_POST['description'])) {
    if(empty($_POST['name'])){
      $nameError = 'Category name is required!';
    }
    if(empty($_POST['description'])){
      $descError = 'Category description is required!';
    }
  } else {
    
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO categories(name,description) VALUES (?,?) ");
    $result = $stmt->execute([$name,$description]);

    if($result) {
      echo "<script>alert('Category Added');window.location.href='category.php';</script>";
    }
  }


  
 
}

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
                                <h1 class="mb-3 text-bold d-flex justify-content-center align-items-center btn btn-info " >Add New &nbsp;<i class="fa-solid fa-file-circle-plus"></i></h1>
                            </div>
                         
                        <div class="col-md-12 col-lg-12 col-12 ">
                            <div class="card">
                              
                            <!-- /.card-header -->
                                <form action="cat_add.php" method="post" >
                                <input name="_token" type="hidden" value="<?= escape($_SESSION['_token']) ?>">
                               
                                    <div class="card-body">
                                        <div class="mb-4">
                                        <label for="exampleFormControlInput1" class="form-label ">Name</label><p class="text-danger d-inline ml-3"><?= empty($nameError) ? '' : '*'.$nameError ?></p>
                                        <input type="text" class="form-control" name="name" id="exampleFormControlInput1" placeholder="name..." required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Description</label><p class="text-danger d-inline ml-3"><?= empty($descError) ? '' : '*'.$descError ?></p>
                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="description..."  required></textarea>
                                        </div>


                                        <div class="mb-2">
                                         <a href="category.php" class="btn btn-outline-secondary col-2 mr-3 "><i class="fa-solid fa-backward">&nbsp;&nbsp;</i>BACK </a>            
                                        <input type="submit" class="btn btn-success" value="SUBMIT">
                                                                               
                                        </div>
                                    </div>   
                                </form>
                            </div> 
                        </div>
          </div>
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

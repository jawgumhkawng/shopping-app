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

  if (empty($_POST['name']) || empty($_POST['description']) || empty($_FILES['image']) 
      || empty($_POST['category']) || empty($_POST['quantity']) || empty($_POST['price'])) {

    if (empty($_POST['name'])) {
      $nameError = 'Name Required!';
    }
    if (empty($_POST['description'])) {
      $descError = 'Description Required!';
    }
    if (empty($_POST['category'])) {
      $catError = 'category Required!';
    }
    if (empty($_POST['quantity'])) {
      $qtyError = 'quantity Required!';
    }elseif (is_numeric($_POST['quantity']) != 1 ) {
      $qtyError = 'quantity should be integer value!';
    }
    if (empty($_POST['price'])) {
      $priceError = 'price Required!';
    } elseif (is_numeric($_POST['price']) != 1) {
      $priceError = 'price should be integer value!';
    }
    if (empty($_FILES['image'])) {
      $imageError = 'Image Required!';
    }
  }else {
    $file = 'images/'.($_FILES['image']['name']);
    $imageType = pathinfo($file,PATHINFO_EXTENSION);
  
    if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg') {
      echo"<script>alert('Image must be png,jpg or jpeg!')</script>";
    }else { //image validation success

      $name = $_POST['name'];
      $description = $_POST['description'];
      $category = $_POST['category'];
      $quantity = $_POST['quantity'];
      $price = $_POST['price'];
      $image = $_FILES['image']['name'];
  
      move_uploaded_file($_FILES['image']['tmp_name'],$file);
  
      $stmt = $pdo->prepare("INSERT INTO products(name,description,category_id,quantity,price,image) VALUES (?,?,?,?,?,?)");
      $result = $stmt->execute([$name,$description,$category,$quantity,$price,$image]);
      
      if ($result) {
        echo"<script>alert('Product Added Successfully!');window.location.href='index.php'</script>";
      }
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
                                <form action="product_add.php" method="post" enctype="multipart/form-data">
                                <input name="_token" type="hidden" value="<?= escape($_SESSION['_token']) ?>">
                               
                                    <div class="card-body">
                                        <div class="mb-4">
                                        <label for="exampleFormControlInput1" class="form-label ">Name</label><p class="text-danger d-inline ml-3"><?= empty($nameError) ? '' : '*'.$nameError ?></p>
                                        <input type="text" class="form-control" name="name" id="exampleFormControlInput1" placeholder="name..." >
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Description</label><p class="text-danger d-inline ml-3"><?= empty($descError) ? '' : '*'.$descError ?></p>
                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="description..."  ></textarea>
                                        </div>
                                        
                                        <div class="mb-4">
                                        <label for="exampleFormControlInput1" class="form-label ">Category</label><p class="text-danger d-inline ml-3"><?= empty($catError) ? '' : '*'.$catError ?></p>
                                        <select name="category" class="form-control">
                                        <?php
                                          $stmtCat = $pdo->prepare("SELECT * FROM categories ");
                                          $stmtCat->execute();
                                          $resultCat = $stmtCat->fetchAll();
                                         
                                        ?>
                                          <option >Select Category</option>
                                        
                                          <?php foreach ($resultCat as  $value) : ?>
                                          
                                          <option  value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                          <?php endforeach ?>
                                          </select>

                                        </div>

                                        <div class="mb-4">
                                        <label for="exampleFormControlInput1" class="form-label ">Quantity</label><p class="text-danger d-inline ml-3"><?= empty($qtyError) ? '' : '*'.$qtyError ?></p>
                                        <input type="number" class="form-control" name="quantity" id="exampleFormControlInput1" placeholder="quantity..." >
                                        </div>

                                        <div class="mb-4">
                                        <label for="exampleFormControlInput1" class="form-label ">Price</label><p class="text-danger d-inline ml-3"><?= empty($priceError) ? '' : '*'.$priceError ?></p>
                                        <input type="number" class="form-control" name="price" id="exampleFormControlInput1" placeholder="price..." >
                                        </div>

                                        <div class="mb-5">
                                            <label for="exampleFormControlTextarea1" class="form-label">Image<p class="text-danger d-inline ml-3" ><?= empty($imageError) ? '' : '*'.$imageError ?></p><br>
                                            <input type="file" class="" name="image" id="exampleFormControlInput1" placeholder="" >
                                        </div>

                                        <div class="mb-2">
                                         <a href="index.php" class="btn btn-outline-secondary col-2 mr-3 "><i class="fa-solid fa-backward">&nbsp;&nbsp;</i>BACK </a>            
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

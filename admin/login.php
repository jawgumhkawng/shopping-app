<!--email----admin@gmail.com
    password---admin123 -->
<?php 

session_start();

require '../config/config.php';
require '../config/common.php';

if ($_POST) {
  if( empty($_POST['email']) ||  strlen($_POST['password']) < 8 ) {

        
    if(empty($_POST['email'])){
        $emailError = 'is required';
    }
    if(empty($_POST['password'])){
        $passwordError = 'is required';
    }
   
} else {
   
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE role=1 AND email=:email" );

        $stmt->bindValue(':email',$email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            if (password_verify($password,$user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['role'] = 1;
                $_SESSION['logged_in'] = time();

                header('Location: index.php');
        
        } 
   } else {
    header('Location: login.php?incorrect=1');
  } 
 }
}
// }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Page | Log in </title>
  <link rel="shortcut icon" href="../img/fav.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <?php if ( isset($_GET['incorrect']) ) : ?>
        <div class="alert alert-danger">
        Incorrect Email or Password
        </div>
        <?php endif ?>
  
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Blogs |</b> admin</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="login.php" method="post" class="mb-5"> 
      <input name="_token" type="hidden" value="<?= $_SESSION['_token'] ?>">     
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" style="<?= empty($emailError) ? '' : 'border: 1px solid red'; ?>" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" style="<?= empty($passwordError) ? '' : 'border: 1px solid red'; ?>" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row ">
          <!-- /.col -->
          <div class="col-10 mt-4 ml-4 ">
            <button type="submit" class="btn btn-outline-primary btn-block">Sign In </button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->
      <!-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

111111111111111111
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
?>
<?php include('header.php') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="">
            <!-- Navbar -->
            <?php

      if (!empty($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
      } else {
        $pageno = 1;
      }
      $numOfrecs = 2;
      $offset = ($pageno - 1) * $numOfrecs;



      $stmt = $pdo->prepare("SELECT * FROM contact ORDER BY id DESC");
      $stmt->execute();
      $rawResult = $stmt->fetchAll();


      $total_pages = ceil(count($rawResult) / $numOfrecs);

      $stmt = $pdo->prepare("SELECT * FROM contact ORDER BY id DESC LIMIT $offset,$numOfrecs");
      $stmt->execute();
      $result = $stmt->fetchAll();




      ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-0">
                            <div class="mr-4 mt-0">
                                <nav aria-label="Page navigation example ">
                                    <ul class="pagination">
                                        <li class="page-item  <?php if ($pageno == 1) {
                                            echo 'disabled';
                                          } ?>"><a class="page-link" href="?pageno=1" aria-label="Previous">First </a>
                                        </li>

                                        <li class="page-item  <?php if ($pageno <= 1) {
                                            echo 'disabled';
                                          } ?>">
                                            <a class="page-link" href="<?php if ($pageno <= 1) {
                                                    echo '#';
                                                  } else {
                                                    echo "?pageno=" . ($pageno - 1);
                                                  } ?>">
                                                <span aria-hidden="true">&laquo;</span></a>
                                        </li>

                                        <li class="page-item active"><a class="page-link" href="#"><?= $pageno; ?></a>
                                        </li>

                                        <li class="page-item  <?php if ($pageno >= $total_pages) {
                                            echo 'disabled';
                                          } ?>">
                                            <a class="page-link" href="<?php if ($pageno >= $total_pages) {
                                                    echo '#';
                                                  } else {
                                                    echo "?pageno=" . ($pageno + 1);
                                                  } ?>">
                                                <span aria-hidden="true">&raquo;</span></a>
                                        </li>

                                        <li class="page-item  <?php if ($pageno == $total_pages) {
                                            echo 'disabled';
                                          } ?>"><a class="page-link" href="?pageno=<?= $total_pages ?>"
                                                aria-label="Next">Last</a></li>
                                    </ul>
                                </nav>

                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content p-3">

                    <!-- Default box -->
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">

                                    <div class="row">
                                        <div class="col-lg-12">

                                            <h4 class="mb-3" style="right:0 !important;">Message Section</h4>
                                            <?php if ($result) : ?>

                                            <?php if ($result) : ?>
                                            <?php foreach ($result as $value) : ?>
                                            <div class="post">
                                                <?php
                              $stmtUser = $pdo->prepare("SELECT * FROM users WHERE id = " . $value['user_id']);
                              $stmtUser->execute();
                              $resultUser = $stmtUser->fetchAll();

                              ?>
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm"
                                                        src="../profile_image/<?= $resultUser[0]['image'] ?>"
                                                        alt="user image">
                                                    <span class="username">
                                                        <a href="#"><?= $resultUser[0]['name'] ?></a>
                                                    </span>


                                                    <span class="description"> "<?= $value['subject'] ?>"</span>
                                                </div>

                                                <!-- /.user-block -->
                                                <p><?= $value['message'] ?></p>

                                                <p>
                                                    <a href="#" class="link-black text-sm"><i
                                                            class="fa-solid fa-user-group"></i>&nbsp;&nbsp;&nbsp;<?= date('Y-m-d / h:i:s', strtotime($value['created_at'])) ?></a>
                                                </p>
                                            </div>
                                            <?php endforeach ?>
                                            <?php endif ?>

                                            <?php else : ?>

                                            <h3 class="text-center text-danger">There is no message</h3>

                                            <?php endif ?>

                                            <!--  -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <?php include('footer.php') ?>
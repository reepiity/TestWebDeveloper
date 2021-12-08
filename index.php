<?php
error_reporting(0);
// error_reporting(E_ALL);
@session_start();
include('core/tech/connect.php');

function headerDoc($typeHal) {
  echo '<!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>'.$typeHal.'</h1>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>';
}
$tglinput = date("Y-m-d H:i:s");
?>
<!DOCTYPE html>
<html lang="en">
  <?php include 'core/page/head.php'; ?>
  <body class="sidebar-collapse layout-fixed accent-danger layout-footer-fixed layout-navbar-fixed border-bottom-0">
    <div class="wrapper">
      <!-- Navbar -->
      <?php include 'core/menu/topmenu.php'; ?>
      <!-- /.navbar -->
      <!-- Content Wrapper. Contains page content -->
      <?php include 'core/tech/route.php'; ?>
      

      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php include('core/tech/jsscript.php'); ?>  

  </body>
</html>
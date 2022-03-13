<?php
include_once('database.php');
session_start();

if($_SESSION['username'] == '' OR $_SESSION['role'] == 'Admin'){
  header('location:login.php');
}else{
  $role = $_SESSION['role'];
  $name = $_SESSION['realname'];
  $surname = $_SESSION['surname'];
}



include('HeaderUser.php');

?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Dashboard</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include('Footer.php'); ?>

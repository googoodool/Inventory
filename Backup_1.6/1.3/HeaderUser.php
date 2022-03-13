<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stock & Inventory</title>
  <link rel="icon" href="image/logo_pat2.ico">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="LTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="LTE/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="LTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="LTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="LTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

  </head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Login By : <?php echo $name. '  ' .$surname ?></a>
      </li>
      
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     

  
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link"  data-slide="true" href="logout.php" role="button">
        <i class="fas fa-door-open"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="overflow: hidden;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="image/Logo_PAT2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 2">
      <span class="brand-text font-weight-light"><b>PAT</b> <small>Innovative Solution</small></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="image/User.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Login Role : <?php echo $role?></a>
        </div>
      </div>

  

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
       

          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i style="color:#fff" class="nav-icon fas fa-list-alt"></i>
              <p>
                ลงทะเบียน
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
           
              <li class="nav-item">
                <a href="Register_Brand.php" class="nav-link ">
                  <i style="color:#E27246" class="far fa-circle nav-icon"></i>
                  <p>เพิ่มยี่ห้อ(Brand)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Register_category.php" class="nav-link">
                  <i style="color:#E27246" class="far fa-circle nav-icon"></i>
                  <p>เพิ่มชื่ออุปกรณ์</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Register_Project.php" class="nav-link">
                <i style="color:#E27246" class="far fa-circle nav-icon"></i>
                  <p>เพิ่มโครงการ</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="Stock-in.php" class="nav-link">
            <i style="color:#fff" class="fas fa-folder-plus nav-icon"></i>
              <p>
                Stock-IN
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Stock-in.php" class="nav-link">
            <i style="color:#fff" class="fas fa-folder-minus nav-icon"></i>
              <p>
                Stock-Out
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Stock-in.php" class="nav-link">
            <i style="color:#fff" class="nav-icon fas fa-tools"></i>
              <p>
                รายการส่งซ่อม
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
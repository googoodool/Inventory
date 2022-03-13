<!DOCTYPE html>

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
  <link rel="stylesheet" href="LTE/dist/css/css.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="LTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="LTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="LTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

  <!-- Date Picker -->
  <link rel="stylesheet" href="LTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
   <!-- Select2 -->
   <link rel="stylesheet" href="LTE/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="LTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" style="color:azure;" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a style="color:azure;" href="#" class="nav-link">Login By : <?php echo $name. '  ' .$surname ?></a>
      </li>
      
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     

  
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i style="color:azure;" class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link"  data-slide="true" href="logout.php" role="button">
        <i style="color:azure;" class="fas fa-door-open"></i>
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
       
          <li class="nav-item">
            <a href="DashboardUser.php" class="nav-link">
            <i style="color:#fff" class="fas fa-chart-pie nav-icon"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

         
      

          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i style="color:#fff" class="nav-icon fas fa-tools"></i>
              <p>
                รายการส่งซ่อม
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="FixHistoryUser.php" class="nav-link ">
                  <i style="color:yellow" class="far fa-circle nav-icon"></i>
                  <p>ประวัติการส่งซ่อมทั้งหมด</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="SearchUser.php" class="nav-link">
            <i style="color:#fff" class="fas fa-search nav-icon"></i>
              <p>
                ค้นหาข้อมูล
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
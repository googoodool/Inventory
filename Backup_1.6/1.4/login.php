
<!-- jQuery -->
<script src="lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="lte/dist/js/adminlte.min.js"></script>
<!-- Sweet Alert -->
<script src="LTE/dist/SweetAlert/sweetalert.js"></script>


<?php
include_once('database.php');
session_start();

if(isset($_POST['btn_submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // echo $username. "-" . $password;
    
    $select = $pdo->prepare("SELECT * FROM user WHERE username='$username' AND password='$password'");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if($row['username'] == $username AND $row['password'] == $password AND $row['role'] == 'Admin'){
        
        $_SESSION['userid'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['realname'] = $row['realname'];
        $_SESSION['surname'] = $row['surname'];
        $_SESSION['role'] = $row['role'];

        echo '
        
        <script type="text/javascript">
          jQuery(function validation(){

            Swal.fire({
              icon: "success",
              title: "WELCOME '.$_SESSION['realname'].'",
              text: "Login Success",
              showConfirmButton: false
             
            })
        });
      </script> 
        ';
        
        header('refresh:1;dashboard.php');

    }else if($row['username'] == $username AND $row['password'] == $password AND $row['role'] == 'User'){
        $_SESSION['userid'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['realname'] = $row['realname'];
        $_SESSION['surname'] = $row['surname'];
        $_SESSION['role'] = $row['role'];

        echo '
        
        <script type="text/javascript">
        jQuery(function validation(){

          Swal.fire({
            icon: "success",
            title: "WELCOME '.$_SESSION['realname'].'",
            text: "Login Success",
            showConfirmButton: false     
              })
          });
        </script> 
        ';
        
        header('refresh:1;dashboardUser.php');
    }else{
      echo '
        
      <script type="text/javascript">
        jQuery(function validation(){

          Swal.fire({
            icon: "error",
            title: "Login Failed",
            text: "Username หรือ Password ไม่ถูกต้อง",
                
              })
          });
        </script> 
      ';
      
    }

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PAT INNOVATIVE SOLUTION</title>
  <link rel="icon" href="image/logo_pat2.ico">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="lte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="lte/dist/css/adminlte.min.css">

  <style>
      body {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
      }
      @keyframes gradient {
        0% {
          background-position: 0% 50%;
        }
        50% {
          background-position: 100% 50%;
        }
        100% {
          background-position: 0% 50%;
        }
      }

      .btn_submit{
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
      }
  </style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <h4 class="text-light">
<span><img width="40px;" src="image/Logo_PAT2.png" alt=""></span>  
PAT INNOVATIVE SOLUTION</h4>

  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span style="color:#23a6d5" class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span style="color:#23a6d5" class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
           
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn_submit" name="btn_submit">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
     
      </div>
      <!-- /.social-auth-links -->
      
     
    </div>
    <!-- /.login-card-body -->
    
  </div>
 
</div>
<br>
<h2 class="text-light">INVENTORY STOCK</h2>
<!-- /.login-box -->

<!-- jQuery -->
<script src="lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="lte/dist/js/adminlte.min.js"></script>
</body>
</html>

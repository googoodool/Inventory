
<?php
include_once('database.php');
session_start();
error_reporting(0);

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
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

       
<!-- ================ Table ========================= -->

<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="text-head-card">ประวัติการส่งซ่อม</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <table id="example1" class="table table-striped" style="text-align:center">
                  <thead>
                      <tr>
                         
                          <th style="display:none" width="20px" id="text-stock-in">ID</th>    
                          <th width="100px" id="text-stock-in">สถานะ</th>                     
                          <th width="100px" id="text-stock-in">ชื่ออุปกรณ์</th>
                          <th width="100px" id="text-stock-in">ยี่ห้อ</th>
                          <th width="100px" id="text-stock-in">รุ่น</th>  
                          <th width="150px" id="text-stock-in">Serial Number</th>
                          <th width="150px" id="text-stock-in">Serial Group</th>
                          <th width="250px" id="text-stock-in">โครงการ</th>
                          <th width="200px" id="text-stock-in">อาการเสีย</th>
                          <th width="150px" id="text-stock-in">วันที่ส่งซ่อม</th>
                          <th width="150px" id="text-stock-in">วันที่ซ่อมเสร็จ</th>
                         
                          <th width="150px" id="text-stock-in">ผู้ส่งซ่อม</th>
                      </tr>
                  </thead>
                  <tbody id="FixHistory_tbody">
                  <?php
            $select = $pdo->prepare("SELECT * FROM stockin_insert WHERE fix_history = 'Y' ORDER BY id DESC");
            $select->execute();
            // while($row = $select->fetch(PDO::FETCH_ASSOC)){
                foreach($select as $row){

                    $status = $row['status'];

                    if( $status == 'FIX'){
                        $status = 'อยู่ระหว่างส่งซ่อม';
                    }
                    elseif($status == 'Stock-OUT'){
                        $status = 'INSTALLED';
                    }else{
                        $status = 'Stock';
                    }

                    

                echo '
                    <tr>
                        <td style="display:none" class="user_id">'.$row['id'].'</td>
                        <td>'.$status.'</td>
                        <td>'.$row['item_name'].'</td>
                        <td>'.$row['item_brand'].'</td>
                        <td>'.$row['item_model'].'</td>
                        <td>'.$row['serial'].'</td>
                        <td>'.$row['serial_group'].'</td>
                        <td>'.$row['stockout_project'].'</td>
                        <td>'.$row['fix_remark'].'</td>
                        <td>'.$row['fix_date'].'</td>
                        <td>'.$row['fix_date_return'].'</td>
                        
                        <td>'.$row['fix_by'].'</td>
                        
                    </tr>
                ';
            }
                    ?>
                  </tbody>

              </table>
            
          </div>
          <!-- /.card-body -->   
        </div>
        <!-- /.card -->



      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 

<?php include('Footer.php'); ?>
<!-- ============= Date Picker ============== -->
<script src="LTE/plugins/select2/js/select2.full.min.js"></script>
<script src="LTE/plugins/moment/moment.min.js"></script>
<script src="LTE/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="LTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>




<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": true,"scrollX": true,     
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  
  });
</script>

<script src="LTE/dist/SweetAlert/sweetalert.js"></script>





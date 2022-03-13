
<?php
include_once('database.php');
session_start();
error_reporting(0);

if($_SESSION['username'] == '' ){
    header('location:login.php');
  }else{
    $role = $_SESSION['role'];
    $name = $_SESSION['realname'];
    $surname = $_SESSION['surname'];
  }
include('header.php');

if(isset($_SESSION['delete_status']) && $_SESSION != ""){

  if($_SESSION['delete_status'] == 'delete_success'){
    echo '
      <script type="text/javascript">
          jQuery(function validation(){

          Swal.fire({
          icon: "success",
          title: "Delete Success",
          text: "ลบข้อมูลสำเร็จ",
              })
          });
      </script> 
              
    ';
    unset($_SESSION['delete_status']);
}else{
  echo '
  <script type="text/javascript">
      jQuery(function validation(){

      Swal.fire({
      icon: "warning",
      title: "Delete Failed",
      text: "พบปัญหาการลบข้อมูล",
          })
      });
  </script> 
          
';
unset($_SESSION['delete_status']);
  }
}


if(isset($_SESSION['update_status']) && $_SESSION != ""){

  if($_SESSION['update_status'] == 'update_success'){
    echo '
      <script type="text/javascript">
          jQuery(function validation(){

          Swal.fire({
          icon: "success",
          title: "Stock OUT Success",
          text: "บันทึกข้อมูลสำเร็จ",
              })
          });
      </script> 
              
    ';
    unset($_SESSION['update_status']);
}else{
  echo '
  <script type="text/javascript">
      jQuery(function validation(){

      Swal.fire({
      icon: "warning",
      title: "Stock OUT Failed",
      text: "พบปัญหาการบันทึกข้อมูล",
          })
      });
  </script> 
          
';
unset($_SESSION['update_status']);
  }
}

if(isset($_SESSION['edit_update_status']) && $_SESSION != ""){

  if($_SESSION['edit_update_status'] == 'edit_update_success'){
    echo '
      <script type="text/javascript">
          jQuery(function validation(){

          Swal.fire({
          icon: "success",
          title: "Update Success",
          text: "แก้ไขข้อมูลสำเร็จ",
              })
          });
      </script> 
              
    ';
    unset($_SESSION['edit_update_status']);
}else{
  echo '
  <script type="text/javascript">
      jQuery(function validation(){

      Swal.fire({
      icon: "warning",
      title: "Update Failed",
      text: "พบปัญหาการแก้ไขข้อมูล",
          })
      });
  </script> 
          
';
unset($_SESSION['edit_update_status']);
  }
}
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

 <!-- ============================ Category ==================================== -->
      <div class="row">
        <div class="col-md-6">

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="text-head-card"><i class="fas fa-chart-pie"></i> CATEGORY </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php
              $cat_select = $pdo->prepare("SELECT item_name,item_brand,item_model,
               COUNT(*) totalCount, SUM(qty) QTY, (SELECT SUM(QTY) FROM stockin_insert WHERE status='STOCK-IN') total,
               (SUM(qty) / (SELECT SUM(QTY) FROM stockin_insert WHERE status='STOCK-IN') ) * 100 AS percentage 
               FROM `stockin_insert` WHERE status='STOCK-IN' GROUP BY item_name ORDER BY item_name ASC");
              $cat_select->execute();

              while($cat_row = $cat_select->fetch(PDO::FETCH_ASSOC)){

                $cat_name = $cat_row['item_name'];


                echo '
                <div class="progress-group">

                <a href="dashboard_detail?data='.$cat_name.'" target="_blank"><span class="progress-text">'.$cat_row['item_name'].'</span></a>
                  <span class="float-right"><b>'.$cat_row['QTY'].'</b>/'.$cat_row['total'].'</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: '.$cat_row['percentage'].'%"></div>
                    </div>
                </div>
                
                
                ';

              }


            ?>

           
              
          </div>
          <!-- /.card-body -->   
        </div>
        <!-- /.card -->
        </div>
        <!-- Col-md-6-->
      <!-- ============================ Asset ==================================== -->
        <div class="col-md-6">

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="text-head-card" style="color:brown"><i class="fas fa-toolbox"></i> Office Asset </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php
              $asset_select = $pdo->prepare("SELECT name,brand,model,
              COUNT(*) totalCount, SUM(qty) QTY, (SELECT SUM(QTY) FROM asset) total,
              (SUM(qty) / (SELECT SUM(QTY) FROM asset) ) * 100 AS percentage 
              FROM asset WHERE working='good' GROUP BY name ORDER BY name ASC");
              $asset_select->execute();

              while($asset_row = $asset_select->fetch(PDO::FETCH_ASSOC)){

                echo '
                <div class="progress-group">
                  <span class="progress-text">'.$asset_row['name'].'</span>
                  <span class="float-right"><b>'.$asset_row['QTY'].'</b> Unit</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar" style="width: '.$asset_row['percentage'].'%;background-color:#D6426B"></div>
                    </div>
                </div>
                
                
                ';

              }
            ?>
          </div>
          <!-- /.card-body -->   
        </div>
        <!-- /.card -->


        </div>


  
      </div>
        <!-- Row -->


 
       
<!-- ================ Table ========================= -->

<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="text-head-card"><i class="fas fa-list"></i> DETAIL INDIVIDUAL PARTS</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <table id="dashboard_table" width="100%" class="table table-striped" style="text-align:center">
                  <thead>
                      <tr>
                         
                           
                          <th width="15%" id="text-stock-in">PART / EQUIPMENT</th>                     
                          <th width="25%"  id="text-stock-in">BRAND</th>
                          <th width="25%"  id="text-stock-in">MODEL</th>
                          <th  width="10%" id="text-stock-in">QUANTITY</th>  
                          <th  width="25%" id="text-stock-in">Percentage</th>  
                           
                                         
                      </tr>
                  </thead>
                  <tbody id="FixHistory_tbody">
                    <?php
                       $select = $pdo->prepare("SELECT item_name,item_brand,item_model, COUNT(*) totalCount, SUM(qty) QTY,
                       (SUM(qty) / (SELECT SUM(QTY)  FROM stockin_insert WHERE status='STOCK-IN')) * 100 AS percentage
                        FROM `stockin_insert` WHERE status='STOCK-IN' GROUP BY item_name,item_brand,item_model ORDER BY item_name ASC");
                       $select->execute();
                       while($row = $select->fetch(PDO::FETCH_ASSOC)){
                        
                        $percent = round($row['percentage'],2);
                        

                        echo'
                        <tr>
                          <td >'.$row['item_name'].'</td>
                          <td>'.$row['item_brand'].'</td>
                          <td>'.$row['item_model'].'</td>
                          <td >'.$row['QTY'].' </td>
                          <td>
                            <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%">
                              </div>
                            </div>
                            <small style="color:rgb(14, 21, 117)">
                              '.$percent.'% Stock-IN
                            </small>
                          </td>
                          
                        
                        
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




<!-- <script>
  $(function () {
    $("#dashboard_table").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": true,"scrollX": true,     
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  
  });
</script> -->

<script src="LTE/dist/SweetAlert/sweetalert.js"></script>







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


if(isset($_SESSION['insert_status']) && $_SESSION != ""){
    // echo $_SESSION['status'];
  
    if($_SESSION['insert_status'] == 'success'){
        echo '
          <script type="text/javascript">
              jQuery(function validation(){
  
              Swal.fire({
              icon: "success",
              title: "Success",
              text: "บันทึกข้อมูลสำเร็จ",
                  })
              });
          </script> 
                  
        ';
        unset($_SESSION['insert_status']);
    }elseif($_SESSION['insert_status'] == 'same'){
      echo '
      <script type="text/javascript">
          jQuery(function validation(){
  
          Swal.fire({
          icon: "error",
          title: "ข้อมูลซ้ำ",
          text: "พบ Serial Number นี้ในระบบแล้ว",
              })
          });
      </script> 
              
      ';
      unset($_SESSION['insert_status']);
  
    }else{
      echo '
      <script type="text/javascript">
          jQuery(function validation(){
  
          Swal.fire({
          icon: "error",
          title: "Database Connection Error!",
          text: "พบปัญหาการปันทึกข้อมูล",
              })
          });
      </script> 
              
      ';
      unset($_SESSION['insert_status']);
    }
  }
  

  
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

      
<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="text-stock-in-table"><b>เลือกโครงการ</b></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <form action="sum_payment.php" method="post">
           <div class="row">
            
               <div class="col-md-6">
                  <div class="form-group ">
                    <label id="text-stock-in">ชื่อโครงการ <code><b>(required)</b></code></label>
                      <select class="custom-select  rounded-0" id="pay_project" placeholder="" name="pay_project" required>
                          <option value="">None Selected</option>
                          <?php
                          $select = $pdo->prepare("SELECT station_name FROM station ORDER BY id DESC");
                          $select->execute();
                          if($select->rowCount() > 0){
                              foreach($select as $row){
                              
                                  echo '
                                  <option value="'.$row['station_name'].'">'.$row['station_name'].'</option>
                                  ';
                              
                              }
                          }
                          ?>
                      </select>
                    </div> 
               </div>

               <div class="col-md-3">


               </div>

               <div class="col-md-3">
               <input style="margin-top:31px;" type="submit" name="insert" id="insert" value="ค้นหา" class="btn btn-primary btn-block" />
               </div>

           </div>
           </form>

          </div>
          <!-- /.card-body -->   
        </div>
        <!-- /.card -->



    
<!-- ================ Table อุปกรณ์ ========================= -->
<div class="card card-default">
          <div class="card-header bg-secondary">
            <h3 class="card-title" id="text-stock-in-payment">ราคาอุปกรณ์</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body" id="text-stock-in-table">
              <table id="table11" class="table table-striped" style="text-align:center">
                  <thead>
                      <tr>
                          <th style="display:none;" width="5%" id="text-stock-in">ID</th>
                          
                          <th  width="25%" id="text-stock-in">ชื่ออุปกรณ์</th>
                          <th width="25%" id="text-stock-in">ราคาต่อหน่วย</th>
                          <th  width="25%" id="text-stock-in">จำนวน</th>
                          <th  width="20%x" id="text-stock-in">ราคารวม</th>        
                      </tr>
                  </thead>
                  <tbody>    
                          


                  <?php
                    if(isset($_POST['pay_project'])){
                      
                     $name_project = $_POST['pay_project'];
                     $sum1 = 0;
                    
                      $select = $pdo->prepare("select item_name, price,price_bath, sum(price_bath) as sums, count(*) as qty FROM stockin_insert where  `status` = 'STOCK-OUT' AND `stockout_project` = '$name_project' group by item_name having not(null <=> price_bath) ");
                      $select->execute();

                    foreach($select as $row){
                      $sum1 += $row['sums'];
                        echo'
                        <tr>
                    <td style="display:none;">'.$row['id'].'</td>
                    <td>'.$row['item_name'].'</td>
                    <td>'.rtrim(rtrim(number_format($row['price_bath'], 3, '.', ','), '0'), '.').'</td>
                    <td>'.$row['qty'].'</td>
                  
                    <td>'.rtrim(rtrim(number_format($row['sums'], 3, '.', ','), '0'), '.').'</td>
                    </tr>
                
                        ';
                   }
              }

            ?>  
                <tr>
                  <td colspan="3" style="background-color:#D0DAD2"><?php echo $name_project; ?>  ราคาอุปกรณ์รวม</td>
                  <td style="background-color:#C9D3D3;color:blue"><b><?php echo rtrim(rtrim(number_format($sum1, 3, '.', ','), '0'), '.') ?></b></td>
                 </tr>
                 
                  </tbody>

              </table>
              
          </div>
          <!-- /.card-body -->   
        </div>
        <!-- /.card -->
<br>
   <!-- ================ Table ค่าแรง ========================= -->     
        <div class="card card-default">
          <div class="card-header bg-info">
            <h3 class="card-title" id="text-stock-in-payment">ข้อมูลค่าใช้จ่ายโครงการ</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body" id="text-stock-in-table">
              <table id="table11" class="table table-striped" style="text-align:center">
                  <thead>
                      <tr>
                          <th style="display:none;" width="5%" id="text-stock-in">ID</th>
                          <th  width="15%" id="text-stock-in">วันที่</th>
                          <th width="20%" id="text-stock-in">ผู้รับจ้างในนามบริษัท</th>
                          <th  width="20%" id="text-stock-in">ผู้รับจ้างในนามบุคคล</th>
                          <th  width="20%" id="text-stock-in">รายละเอียด</th>
                          <th  width="20%x" id="text-stock-in">ราคา</th>        
                      </tr>
                  </thead>
                  <tbody>    
                          


                  <?php
                    if(isset($_POST['pay_project'])){
                      
                     $name_project = $_POST['pay_project'];
                     $sum2 = 0;
                    
                      $select = $pdo->prepare("select * FROM payment where  `payment_project` = '$name_project' ");
                      $select->execute();

                    foreach($select as $row){
                      $sum2 += $row['payment_price'];
                        echo'
                        <tr>
                    <td style="display:none;">'.$row['payment_id'].'</td>
                    <td>'.$row['payment_date'].'</td>
                    <td>'.$row['payment_company'].'</td>
                    <td>'.$row['payment_person'].'</td>
                    <td>'.$row['payment_detail'].'</td>
                    <td>'.rtrim(rtrim(number_format($row['payment_price'], 3, '.', ','), '0'), '.').'</td>
                    </tr>
                
                        ';
                   }
              }

            ?>  
                <tr>
                  <td colspan="4" style="background-color:#B1E8EA"><?php echo $name_project; ?>  ราคาค่าแรงรวม</td>
                  <td style="background-color:#68E6EB"><?php echo rtrim(rtrim(number_format($sum2, 3, '.', ','), '0'), '.') ?></td>
                 </tr>
                 
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

<!-- Sweet Alert -->
<script src="LTE/dist/SweetAlert/sweetalert.js"></script>

<!-- ============= Date Picker ============== -->

<script src="LTE/plugins/moment/moment.min.js"></script>
<script src="LTE/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="LTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="LTE/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="LTE/fancyBox/dist/jquery.fancybox.js"></script>
 
<script>
  $(function () {
    $("#table1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": true ,"scrollX": true,"aaSorting": [],         
    }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
  
  });
</script>



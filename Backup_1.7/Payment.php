
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
            <h3 class="card-title" id="text-stock-in-table"><b>ค่าใช้จ่ายโครงการ</b></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
           
            <div class="row">
              <div class="col-12">

        <form action="Code_payment.php" method="POST">
<!-- ======================  ROW 1 ====================== -->
          <div class="row">
              <div class="col-md-3">

              </div>

          </div>

                
        </form>
            </div>
            <!-- col-12 -->
          </div> 
          <!-- Row -->
          
            
          </div>
          <!-- /.card-body -->   
        </div>
        <!-- /.card -->



    
<!-- ================ Table ========================= -->

<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="text-stock-in">ข้อมูลคลังสินค้า</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body" id="text-stock-in-table">
              <table id="example1" class="table table-striped" style="text-align:center">
                  <thead>
                      <tr>
                          <th style="display:none;" width="70px" id="text-stock-in">ID</th>
                          <th width="100px" id="text-stock-in">Action</th>
                          <th width="100px" id="text-stock-in">Image</th>                    
                          <th width="150px" id="text-stock-in">ชื่ออุปกรณ์</th>
                          <th width="150px" id="text-stock-in">ยี่ห้อ</th>
                          <th width="150px" id="text-stock-in">รุ่น</th>  
                          <th width="150px" id="text-stock-in">Serial Product</th>
                          <th width="150px" id="text-stock-in">Serial Group</th>
                          <th width="150px" id="text-stock-in">Serial Generate</th>
                          <th width="60px" id="text-stock-in">จำนวน</th>
                          <th width="150px" id="text-stock-in">ราคา (ต่างประเทศ)</th>
                          <th width="150px" id="text-stock-in">ราคา(บาท)</th>
                          <th width="150px" id="text-stock-in">บริษัทผู้ขาย</th>
                          <th width="150px" id="text-stock-in">วันที่รับอุปกรณ์</th>
                          <th width="150px" id="text-stock-in">เลขที่ใบเสนอราคา</th>
                          <th width="150px" id="text-stock-in">เลขที่ใบสั่งซื้อ</th>
                          <th width="150px" id="text-stock-in">Create By</th>
                          <th width="150px" id="text-stock-in">Create Date</th>
                          <th width="150px" id="text-stock-in">Update By</th>
                          <th width="150px" id="text-stock-in">Update Date</th>
                          <th width="200px" id="text-stock-in">Stock-IN Remark</th>
                          <th width="150px" id="text-stock-in">วันที่ส่งซ่อม</th>
                          <th width="150px" id="text-stock-in">วันที่รับคืน</th>
                          <th width="200px" id="text-stock-in">Return Remark</th>
                      </tr>
                  </thead>
                  <tbody>
                    
                  <?php
             //$select = $pdo->prepare("SELECT * FROM stockin_insert WHERE status = 'Stock-IN' ORDER BY id DESC");
            $select = $pdo->prepare("SELECT ins_tab.*, cat_tab.cat_name, cat_tab.cat_image FROM stockin_insert ins_tab, category cat_tab WHERE ins_tab.item_name = cat_tab.cat_name AND ins_tab.status='STOCK-IN' ORDER BY ins_tab.id DESC");
            
            $select->execute();
            // while($row = $select->fetch(PDO::FETCH_ASSOC)){
                foreach($select as $row){
                echo '
                    <tr>
                        <td style="display:none;" class="pro_id">'.$row['id'].'</td>
                        <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-primary stockout_btn mr-1 data-toggle="tooltip" data-placement="bottom" title="Stock Out""><i class="fas fa-backward"></i> </a>
                            <a href="#" class="btn btn-warning edit_btn mr-1 data-toggle="tooltip" data-placement="bottom" title="Edit""><i class="fas fa-edit"></i> </a>
                            <a href="#" class="btn btn-danger delete_btn data-toggle="tooltip" data-placement="bottom" title="Delete""><i class="fas fa-trash"></i></a>
                        </div>                          
                        
                        </td>
                        <td>
                        <a href="Picture/'.$row['cat_image'].'"class="fancybox" title="'.$row['item_name'].'" data-fancybox-group="gallery">
                        <img src="Picture/'.$row['cat_image'].'" alt="" width="50px" height="40px">
                        </a>
                        </td>
                        
                        <td>'.$row['item_name'].'</td>
                        <td>'.$row['item_brand'].'</td>
                        <td>'.$row['item_model'].'</td>
                        <td>'.$row['serial'].'</td>
                        <td>'.$row['serial_group'].'</td>
                        <td>'.$row['serial_gen'].'</td>
                        <td>'.$row['qty'].'</td>
                       
                        <td>'.rtrim(rtrim(number_format($row['price'], 3, '.', ','), '0'), '.').'</td>
                        
                        <td>'.rtrim(rtrim(number_format($row['price_bath'], 3, '.', ','), '0'), '.').'</td>
                        <td>'.$row['seller'].'</td>
                        <td>'.$row['date_receive'].'</td>
                        <td>'.$row['id_quotation'].'</td>
                        <td>'.$row['id_po'].'</td>
                        <td>'.$row['create_name'].'</td>
                        <td>'.$row['create_date'].'</td>
                        <td>'.$row['stockin_update_by'].'</td>
                        <td>'.$row['stockin_update_date'].'</td>
                        <td>'.$row['stockin_remark'].'</td>
                        <td>'.$row['fix_date'].'</td>
                        <td>'.$row['fix_date_return'].'</td>
                        <td>'.$row['return_remark'].'</td>
                        
                    </tr>
                ';
            }
                    ?>
                 
                 <!-- <a href="#" class="badge badge-primary view_btn">View</a>
                  <a href="#" class="badge badge-warning edit_btn">Edit</a> -->
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



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
            <h3 class="card-title" id="text-stock-in-table"><b>เพิ่มข้อมูลเข้าคลังสินค้า</b></h3>

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

        <form action="Code_Add_Stockin.php" method="POST">
<!-- ======================  ROW 1 ====================== -->
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="" id="text-stock-in">ชื่ออุปกรณ์ <code><b>(required)</b></code></label>
                    <select class="custom-select custom-select-sm rounded-0" id="STIN_name" placeholder="" name="STIN_name" required>
                        <option value="">None Selected</option>
                        <?php
                         $select = $pdo->prepare("SELECT cat_name FROM category ORDER BY id DESC");
                         $select->execute();
                         if($select->rowCount() > 0){
                            foreach($select as $row){
                            
                                echo '
                                <option value="'.$row['cat_name'].'">'.$row['cat_name'].'</option>
                                ';
                            
                            }
                         }
                        ?>
                    </select>
                    </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                    <div class="form-group ">
                        <label for="STIN_brand" id="text-stock-in">ยี่ห้อ</label>
                        
                        <!-- <input type="text" class="form-control form-control-sm" id="STIN_brand" placeholder="" name="STIN_brand" > -->
                    
                        <select class="custom-select custom-select-sm rounded-0" id="STIN_brand" placeholder="" name="STIN_brand" required>
                        <option value="">None Selected</option>
                        <?php
                         $select = $pdo->prepare("SELECT name FROM brand ORDER BY id DESC");
                         $select->execute();
                         if($select->rowCount() > 0){
                            foreach($select as $row){
                            
                                echo '
                                <option value="'.$row['name'].'">'.$row['name'].'</option>
                                ';
                            
                            }
                         }
                        ?>
                    </select>
                    
                    
                    </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                    <div class="form-group ">
                        <label for="STIN_model" id="text-stock-in">รุ่น</label>
                        <input type="text" class="form-control form-control-sm" id="STIN_model" placeholder="" name="STIN_model" >
                    </div>

                </div>
                <!-- col-3 -->

                <div class="col-md-3">

                    <label for="STIN_qty" id="text-stock-in">จำนวน <code><b>(required)</b></code></label>
                    <input type="text" class="form-control form-control-sm" id="STIN_qty" placeholder="" name="STIN_qty" required>
                 
                </div>
                <!-- col-3 -->
            </div>
            <!-- row -->
<!-- ======================  ROW 2 ====================== -->
            <div class="row">
                <div class="col-md-3">    
                  <div class="form-group ">
                        <label for="STIN_serial" id="text-stock-in">Serial Number</label>
                        <input type="text" class="form-control form-control-sm" id="STIN_serial" placeholder="" name="STIN_serial" >
                  </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                  <div class="form-group ">
                        <label for="STIN_serial_group" id="text-stock-in">Serial Number Group</label>
                        <input type="text" class="form-control form-control-sm" id="STIN_serial_group" placeholder="" name="STIN_serial_group" >
                  </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                  <div class="form-group ">
                        <label for="STIN_price" id="text-stock-in">ราคา / หน่วย</label>
                        <input type="text" class="form-control form-control-sm" id="STIN_price" placeholder="" name="STIN_price" >
                    </div>

                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                  

                <div class="form-group">
                    <label for="STIN_date-in" id="text-stock-in">วันที่รับอุปกรณ์ <code><b>(required)</b></code></label>
                    <div class="input-group date" id="dateStockIn" data-target-input="nearest">
                        <input type="text" class="form-control form-control-sm datetimepicker-input" name="STIN_date-in" data-target="#dateStockIn" required/>
                        <div class="input-group-append" data-target="#dateStockIn" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

                </div>
                <!-- col-3 -->
            </div>
            <!-- row -->

<!-- ======================  ROW 2 ====================== -->
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group ">
                        <label for="STIN_seller" id="text-stock-in">บริษัทผู้ขาย</label>
                        <input type="text" class="form-control form-control-sm" id="STIN_seller" placeholder="" name="STIN_seller" >
                  </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                <div class="form-group ">
                        <label for="STIN_id_qtation" id="text-stock-in">เลขที่ใบเสนอราคา</label>
                        <input type="text" class="form-control form-control-sm" id="STIN_id_qtation" placeholder="" name="STIN_id_qtation" >
                    </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3 "  >
                <div class="form-group ">
                        <label for="STIN_date_qtation" id="text-stock-in">วันที่ขอใบเสนอราคา</label>
                        <input type="text" class="form-control form-control-sm" id="STIN_date_qtation" placeholder="" name="STIN_date_qtation" >
                    </div>

                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                <div class="form-group ">
                        <label for="STIN_id_po" id="text-stock-in">เลขที่ใบสั่งซื้อ</label>
                        <input  type="text" class="form-control form-control-sm" id="STIN_id_po" placeholder="" name="STIN_id_po" >
                    </div>
                   
                </div>
                <!-- col-3 -->
            </div>
            <!-- row -->
            <div class="row">
              <div class="col-md-9">

              </div>
              <div class="col-md-3">
              <input style="margin-top:31px;" type="submit" name="insert" id="insert" value="บันทึกข้อมูล" class="btn btn-success btn-block btn-sm" />
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
                          <th width="150px" id="text-stock-in">Action</th>
                          <th width="40px" id="text-stock-in">ID</th>
                          <th width="150px" id="text-stock-in">ชื่ออุปกรณ์</th>
                          <th width="150px" id="text-stock-in">ยี่ห้อ</th>
                          <th width="150px" id="text-stock-in">รุ่น</th>  
                          <th width="150px" id="text-stock-in">Serial Number</th>
                          <th width="150px" id="text-stock-in">Serial Group</th>
                          <th width="60px" id="text-stock-in">จำนวน</th>
                          <th width="100px" id="text-stock-in">ราคา</th>
                          <th width="150px" id="text-stock-in">บริษัทผู้ขาย</th>
                          <th width="150px" id="text-stock-in">วันที่รับอุปกรณ์</th>
                          <th width="150px" id="text-stock-in">เลขที่ใบเสนอราคา</th>
                          <th width="150px" id="text-stock-in">วันที่ขอใบเสนอราคา</th>
                          <th width="150px" id="text-stock-in">เลขที่ใบสั่งซื้อ</th>
                          <th width="150px" id="text-stock-in">Create By</th>
                          <th width="150px" id="text-stock-in">Create Date</th>
                      </tr>
                  </thead>
                  <tbody>


                  
                    <!-- <a href="#" class="delete_btn">
                            <i class="fas fa-reply mr-4" ></i>
                        
                            <a href="#" class="delete_btn">
                            <i class="fa fa-trash" style="color:red"></i> -->

                   
                  <?php
            $select = $pdo->prepare("SELECT * FROM stockin_insert WHERE status = 'Stock-IN' ORDER BY id DESC");
            $select->execute();
            // while($row = $select->fetch(PDO::FETCH_ASSOC)){
                foreach($select as $row){
                echo '
                    <tr>
                        <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info stockout_btn mr-2"><i class="fas fa-reply"></i></a>
                           
                            <a href="#" class="btn btn-danger delete_btn"><i class="fas fa-trash"></i></a>
                        </div>
                           
                        
                        </td>

                        <td type="hidden" class="pro_id">'.$row['id'].'</td>
                        <td>'.$row['item_name'].'</td>
                        <td>'.$row['item_brand'].'</td>
                        <td>'.$row['item_model'].'</td>
                        <td>'.$row['serial'].'</td>
                        <td>'.$row['serial_group'].'</td>
                        <td>'.$row['qty'].'</td>
                        <td>'.$row['price'].'</td>
                        <td>'.$row['seller'].'</td>
                        <td>'.$row['date_receive'].'</td>
                        <td>'.$row['id_quotation'].'</td>
                        <td>'.$row['date_quotation'].'</td>
                        <td>'.$row['id_po'].'</td>
                        <td>'.$row['create_name'].'</td>
                        <td>'.$row['create_date'].'</td>
                        
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
<script src="LTE/plugins/select2/js/select2.full.min.js"></script>
<script src="LTE/plugins/moment/moment.min.js"></script>
<script src="LTE/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="LTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>





        <!-- =============== Modal Delete Start ========================= -->
        <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">ยืนยันการลบข้อมูล</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="Code_Add_Stockin.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_id" id="delete_id">
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="delete_project" class="btn btn-danger">Confirm</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- =============== Modal Delete End ========================= -->

<!-- =============== Modal Stock Out Start========================= -->
<div class="modal fade" id="modal-stockout">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Stock Out</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

               
              <form method="post"  action="Code_Add_stockin.php">
                
                <input type="hidden" name="update_id" id="update_id">
                <div class="form-group ">
                <label id="text-stock-in">ชื่อโครงการที่นำไปติดตั้ง <code><b>(required)</b></code></label>
                <select class="custom-select  rounded-0" id="STOT_project" placeholder="" name="STOT_project" required>
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

                <div class="form-group">
                    <label for="STIN_date-in" id="text-stock-in">วันที่ติดตั้งอุปกรณ์ <code><b>(required)</b></code></label>
                    <div class="input-group date" id="modal_date_stockout" data-target-input="nearest">
                        <input type="text" class="form-control form-control-sm datetimepicker-input" name="modal_date_stockout" data-target="#modal_date_stockout" required/>
                        <div class="input-group-append" data-target="#modal_date_stockout" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

                <hr>
                <div>
                    <p id="text-stock-in">รายละเอียดอุปกรณ์</p>
                </div>
                <div class="project_view_data">

                </div>


                <br />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="stockout_submit" id="stockout_submit" value="แก้ไขข้อมูล" class="btn btn-warning stockout_submit_btn" />
            </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- =============== End Modal Stock Out ========================= -->







<script>
  $(document).ready(function () {

    $('.delete_btn').click(function (e) { 
      e.preventDefault();
      
      var delete_id = $(this).closest('tr').find('.pro_id').text();
      console.log(delete_id);
      $('#delete_id').val(delete_id);
      $('#modal-delete').modal('show');
    });



    $('.stockout_btn').click(function (e) { 
      e.preventDefault();
      
      var pro_id = $(this).closest('tr').find('.pro_id').text();
      //console.log(pro_id);
      $.ajax({
        type: "POST",
        url: "Code_Add_Stockin.php",
        data: {
            'check_stock_out' : true,
            'project_id' : pro_id,
        },
        
        success: function (response) {
          console.log(response);
          $('.project_view_data').html(response);
          $('#modal-stockout').modal('show');
        }
      });

      
       

    });

    

    

  });
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": true,"scrollX": true,    
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>

<script>
  $(function () {
    //Date picker
    $('#dateStockIn').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $('#modal_date_stockout').datetimepicker({
        format: 'DD/MM/YYYY'
    });


  })
 

</script>


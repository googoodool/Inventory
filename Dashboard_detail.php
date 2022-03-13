<?php
include_once('database.php');
session_start();

if($_SESSION['username'] == '' OR $_SESSION['role'] == 'User'){
  header('location:login.php');
}

else{
  $role = $_SESSION['role'];
  $name = $_SESSION['realname'];
  $surname = $_SESSION['surname'];
}
include('Header.php');
// error_reporting(0);


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
          text: "มีข้อมูลนี้ในระบบแล้ว",
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
  

  $fromDashboard = $_GET['data'];

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
            <h3 class="card-title" id="text-head-card" >ข้อมูลอุปกรณ์ : <?php echo $fromDashboard; ?> </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

          <table id="example1" class="table table-striped" style="text-align:center">
                  <thead id="FixHistory_tbody">
                      <tr>
                          
                          <th width="10%">Action</th>
                          <th width="10%">Image</th>
                          <th width="15%">ชื่ออุปกรณ์</th>
                          <th width="15%">ยี่ห้อ</th>
                          <th width="15%">รุ่น</th>
                          <th width="10%">จำนวน</th>
                          <th width="15%">Serial Product</th>
                          <th width="10%">Remark</th>
                      </tr>
                  </thead>
                  <tbody id="FixHistory_tbody">
                    
                  
                  <?php
            $select = $pdo->prepare("SELECT stockin_table.* , category_table.cat_name, category_table.cat_image FROM stockin_insert stockin_table, category category_table where stockin_table.item_name = '".$fromDashboard."' AND stockin_table.status='Stock-IN' AND category_table.cat_name = '".$fromDashboard."'  order by stockin_table.id DESC ");
        
            $select->execute();
            //while($row = $select->fetch(PDO::FETCH_ASSOC)){
                foreach($select as $row){
                echo '
                    <tr>

                        <td style="display:none;" class="pro_id">'.$row['id'].'</td>
                        <td>
                        <div class="btn-group btn-group-sm">    
                        <a href="#" class="btn btn-primary stockout_btn mr-1 data-toggle="tooltip" data-placement="bottom" title="Stock Out""><i class="fas fa-backward"></i> </a>
                        <a href="#" class="btn btn-warning edit_btn mr-1 data-toggle="tooltip" data-placement="bottom" title="Edit""><i class="fas fa-edit"></i> </a>                                 
                        <a href="#" class="btn btn-danger delete_btn" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash"></i></a>
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
                        <td>'.$row['qty'].'</td>
                        <td>'.$row['serial'].'</td>
                        <td>'.$row['stockin_remark'].'</td>
                        

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


<!-- Sweet Alert -->
<script src="LTE/dist/SweetAlert/sweetalert.js"></script>

<!-- ============= Date Picker ============== -->

<script src="LTE/plugins/moment/moment.min.js"></script>
<script src="LTE/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="LTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="LTE/plugins/select2/js/select2.full.min.js"></script>


<!-- =============== Modal Stock IN Edit ========================= -->
<div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="text-head-card">แก้ไขข้อมูล</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

               
              <form method="post"  action="Code_Dashboard_detail.php">
                
                <input type="hidden" name="edit_id" id="edit_id">           

                <small id="text-stock-in" style="color:blue">รายละเอียดอุปกรณ์</small>
                <hr>
                  
                <div class="row">
                  <div class="col-4">

                    <div class="form-group ">
                          <label for="edit_name" id="text-stock-in">ชื่ออุปกรณ์</label>
                          <input type="text" class="form-control form-control-sm" id="update_name" placeholder="" name="update_name" disabled>
                    </div>

                    <div class="form-group ">
                        <label for="update_qty" id="text-stock-in">จำนวน</label>
                        <input type="text" class="form-control form-control-sm" id="update_qty" placeholder="" name="update_qty" disabled>
                    </div>

                    <div class="form-group ">
                        <label for="update_serial" id="text-stock-in">Serial Product</label>
                        <input type="text" class="form-control form-control-sm" id="update_serial" placeholder="" name="update_serial" >
                    </div>

                    <div class="form-group">
                      <label for="STIN_date-in" id="text-stock-in">วันที่รับอุปกรณ์ </label>
                        <div class="input-group date" id="dateedit" data-target-input="nearest">
                          <input type="text" class="form-control form-control-sm datetimepicker-input" name="update_date-in" id="update_date-in" data-target="#dateedit" />
                        <div class="input-group-append" data-target="#dateedit" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="STIN_id_qtation" id="text-stock-in">เลขที่ใบเสนอราคา</label>
                        <input type="text" class="form-control form-control-sm" id="update_id_qtation" placeholder="" name="update_id_qtation" >
                    </div>

                  </div>

                  <div class="col-4">

                    <div class="form-group ">
                          <label for="update_brand" id="text-stock-in">ยี่ห้อ</label>
                          <input type="text" class="form-control form-control-sm" id="update_brand" placeholder="" name="update_brand" disabled>
                    </div>
                    
                    <div class="form-group ">
                        <label for="update_price" id="text-stock-in">ราคา(ต่างประเทศ)</label>
                        <input type="text" class="form-control form-control-sm" id="update_price" placeholder="" name="update_price" >
                    </div>
                    

                   

                    <div class="form-group ">
                        <label for="update_serial_group" id="text-stock-in">Serial Group</label>
                        <input type="text" class="form-control form-control-sm" id="update_serial_group" placeholder="" name="update_serial_group" >
                    </div>

                    <div class="form-group ">
                        <label for="STIN_seller" id="text-stock-in">บริษัทผู้ขาย</label>
                        <input type="text" class="form-control form-control-sm" id="update_seller" placeholder="" name="update_seller" >
                  </div>
                <div class="form-group ">
                        <label for="STIN_id_po" id="text-stock-in">เลขที่ใบสั่งซื้อ</label>
                        <input  type="text" class="form-control form-control-sm" id="update_id_po" placeholder="" name="update_id_po" >
                </div>
                    

                  </div>

                  <div class="col-4">
                    <div class="form-group ">
                        <label for="update_model" id="text-stock-in">รุ่น</label>
                        <input type="text" class="form-control form-control-sm" id="update_model" placeholder="" name="update_model">
                    </div>

                    <div class="form-group ">
                        <label for="update_serial_group" id="text-stock-in">ราคา(บาท)</label>
                        <input type="text" class="form-control form-control-sm" id="update_price_bath" placeholder="" name="update_price_bath" >
                    </div>

                    <div class="form-group ">
                        <label for="STIN_seller" id="text-stock-in">Serial Generate</label>
                        <input type="text" class="form-control form-control-sm" id="update_serial_generate" placeholder="" name="update_serial_generate" disabled>
                  </div>

                  <div class="form-group">
                    <label for="exampleFormControlTextarea1" id="text-stock-in">Remark</label>
                    <textarea class="form-control" id="update_remark" name="update_remark"  rows="4"></textarea>
                  </div>

                 

                  </div>

                </div>

                <br />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="edit_submit" id="edit_submit" value="แก้ไขข้อมูล" class="btn btn-warning edit_submit_btn" />
            </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- =============== End Modal Stock IN Edit ========================= -->

<!-- =============== Modal Delete Start ========================= -->
<div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h5 class="modal-title">ยืนยันการลบข้อมูล</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="Code_Dashboard_detail.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_id" id="delete_id">
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="submit" name="delete_user" class="btn btn-outline-light">Confirm</button>
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
              <h5 class="modal-title" id="text-head-card">นำอุปกรณ์ไปติดตั้ง</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

               
              <form method="post"  action="Code_Dashboard_detail.php">
                
                <input type="hidden" name="update_id" id="update_id">           
                

                <div class="row">
                  <div class="col-6">
                    <div class="form-group ">
                      <label id="text-stock-in">ชื่อโครงการที่นำไปติดตั้ง <code><b>(required)</b></code></label>
                      <select class="custom-select  rounded-0" id="STOUT_project" placeholder="" name="STOUT_project" required>
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
                    

                  </div><!-- Col-6 -->

                  <div class="col-6">
                    <div class="form-group">
                        <label for="STIN_date-in" id="text-stock-in">วันที่ติดตั้งอุปกรณ์ <code><b>(required)</b></code></label>
                        <div class="input-group date" id="modal_date_stockout" data-target-input="nearest">
                            <input type="text" class="form-control  datetimepicker-input" name="modal_date_stockout" data-target="#modal_date_stockout" required/>
                            <div class="input-group-append" data-target="#modal_date_stockout" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                      </div>
                  </div>

                </div><!-- Row -->

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group ">
                        <label id="text-stock-in">ประเภทโครงการ <code><b>(required)</b></code></label>
                        <select class="custom-select  rounded-0" id="STOUT_projectType" placeholder="" name="STOUT_projectType" required>
                            <option value="">None Selected</option>
                            <?php
                            $select = $pdo->prepare("SELECT name FROM station_Type ORDER BY id DESC");
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
                  </div><!-- Col-md-6 -->

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1" id="text-stock-in">Remark</label>
                      <textarea class="form-control" id="stockout_remark" name="stockout_remark"  rows="3"></textarea>
                    </div>
                  </div><!-- Col-md-6-->
                </div><!-- Row -->

                  

               

                
                <br>
                <small id="text-stock-in" style="color:blue">รายละเอียดอุปกรณ์</small>
                <hr>
                  
                <div class="row">
                  <div class="col-6">

                    <div class="form-group ">
                          <label for="edit_name" id="text-stock-in">ชื่ออุปกรณ์</label>
                          <input type="text" class="form-control form-control-sm" id="edit_name" placeholder="" name="edit_name" disabled>
                    </div>

                    <div class="form-group ">
                        <label for="edit_model" id="text-stock-in">รุ่น</label>
                        <input type="text" class="form-control form-control-sm" id="edit_model" placeholder="" name="edit_model" disabled>
                    </div>

                    <div class="form-group ">
                        <label for="edit_qty" id="text-stock-in">จำนวน</label>
                        <input type="text" class="form-control form-control-sm" id="edit_qty" placeholder="" name="edit_qty" disabled>
                    </div>


                  </div>

                  <div class="col-6">

                    <div class="form-group ">
                          <label for="edit_brand" id="text-stock-in">ยี่ห้อ</label>
                          <input type="text" class="form-control form-control-sm" id="edit_brand" placeholder="" name="edit_brand" disabled>
                    </div>

                    <div class="form-group ">
                        <label for="edit_serial" id="text-stock-in">Serial Number</label>
                        <input type="text" class="form-control form-control-sm" id="edit_serial" placeholder="" name="edit_serial" disabled>
                    </div>

                    <div class="form-group ">
                        <label for="edit_serial_group" id="text-stock-in">Serial Number Group</label>
                        <input type="text" class="form-control form-control-sm" id="edit_serial_group" placeholder="" name="edit_serial_group" disabled>
                    </div>

                  </div>

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

<!-- Sweet Alert -->
<script src="LTE/dist/SweetAlert/sweetalert.js"></script>
<script type="text/javascript" src="LTE/fancyBox/dist/jquery.fancybox.js"></script>

<script>
  $(document).ready(function () {

          // Popup Image
    //================================
    $('.fancybox').fancybox({
      buttons: [
      // "zoom",
      // "share",
      // "slideShow",
      "fullScreen",
      // "download",
      // "thumbs",
      "close"
    ],
    });

    

    $('.delete_btn').click(function (e) { 
      e.preventDefault();
      
      var delete_id = $(this).closest('tr').find('.user_id').text();
      console.log(delete_id);
      $('#delete_id').val(delete_id);
      $('#modal-delete').modal('show');
    });

  });
</script>


<script>
 $(document).ready(function () {

   
$('.edit_btn').click(function (e) { 
e.preventDefault();
var edit_id = $(this).closest('tr').find('.pro_id').text();
console.log(edit_id);
$.ajax({
 type: "POST",
 url: "Code_Dashboard_detail.php",
 data: {
     'check_edit' : true,
     'item_id' : edit_id,
 },
 success: function (response) {

 $.each(response, function (key, value) { 
   //console.log(value['stockin_remark']);
   $('#update_name').val(value['item_name']);
     $('#update_model').val(value['item_model']);
     $('#update_qty').val(value['qty']);
     $('#update_brand').val(value['item_brand']);
     $('#update_serial').val(value['serial']);
     $('#update_serial_group').val(value['serial_group']);

     $('#update_price').val(value['price']);
     $('#update_id_qtation').val(value['id_quotation']);
     $('#update_date-in').val(value['date_receive']);
     $('#update_id_po').val(value['id_po']);
     $('#update_seller').val(value['seller']);
     $('#update_remark').val(value['stockin_remark']);
     $('#edit_id').val(value['id']);
     $('#update_serial_generate').val(value['serial_gen']);
     $('#update_price_bath').val(value['price_bath']);
     
 });
  $('#modal-edit').modal('show');
 }
 
});
});



$('.stockout_btn').click(function (e) { 
      e.preventDefault();
      var view_id = $(this).closest('tr').find('.pro_id').text();
      console.log(view_id);

      $.ajax({
        type: "POST",
        url: "Code_Dashboard_detail.php",
        data: {
            'check_stock_out' : true,
            'item_id' : view_id,
        },
        
        success: function (response) {
          //console.log(response);
          $.each(response, function (key, value) { 
            //  console.log(value['item_name']);
            $('#edit_name').val(value['item_name']);
            $('#edit_model').val(value['item_model']);
            $('#edit_qty').val(value['qty']);
            $('#edit_brand').val(value['item_brand']);
            $('#edit_serial').val(value['serial']);
            $('#edit_serial_group').val(value['serial_group']);
            $('#update_id').val(value['id']);
          });   
          $('#modal-stockout').modal('show');
        }
      });
    });

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

    $('#STIN_date_qtation').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
    $('#dateedit').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
  })
 
</script>

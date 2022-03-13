
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

  
  if(isset($_SESSION['update_status']) && $_SESSION != ""){

    if($_SESSION['update_status'] == 'update_success'){
      echo '
        <script type="text/javascript">
            jQuery(function validation(){
  
            Swal.fire({
            icon: "success",
            title: "Return Process Success",
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
        title: "Return Process Failed",
        text: "พบปัญหาการบันทึกข้อมูล",
            })
        });
    </script> 
            
  ';
  unset($_SESSION['update_status']);
    }
  }

  if(isset($_SESSION['broken_status']) && $_SESSION != ""){

    if($_SESSION['broken_status'] == 'broken_status_success'){
      echo '
        <script type="text/javascript">
            jQuery(function validation(){
  
            Swal.fire({
            icon: "success",
            title: "Process Success",
            text: "บันทึกข้อมูลสำเร็จ",
                })
            });
        </script> 
                
      ';
      unset($_SESSION['broken_status']);
  }else{
    echo '
    <script type="text/javascript">
        jQuery(function validation(){
  
        Swal.fire({
        icon: "warning",
        title: "Process Failed",
        text: "พบปัญหาการบันทึกข้อมูล",
            })
        });
    </script> 
            
  ';
  unset($_SESSION['broken_status']);
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

       
<!-- ================ Table ========================= -->

<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="text-head-card">รายการอุปกรณ์ที่อยู่ระหว่างส่งซ่อม</h3>

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
                          <th width="100px" id="text-stock-in">Action</th>
                          <th width="100px" id="text-stock-in">Image</th>                
                          <th width="150px" id="text-stock-in">ชื่ออุปกรณ์</th>
                          <th width="150px" id="text-stock-in">ยี่ห้อ</th>
                          <th width="150px" id="text-stock-in">รุ่น</th>  
                          <th width="150px" id="text-stock-in">Serial Number</th>
                          <th width="150px" id="text-stock-in">Serial Group</th>
                          <th width="200px" id="text-stock-in">ประเภทโครงการ</th>
                          <th width="250px" id="text-stock-in">ชื่อโครงการ</th>
                          <th width="200px" id="text-stock-in">อาการเสีย</th>
                          <th width="150px" id="text-stock-in">วันที่ส่งซ่อม</th>
                          <th width="150px" id="text-stock-in">ผู้ส่งซ่อม</th>
                          <th width="300px" id="text-stock-in">Stock-IN Remark</th>
                          <th width="300px" id="text-stock-in">Stock-Out Remark</th>
                      </tr>
                  </thead>
                  <tbody id="FixHistory_tbody">
                  <?php
            $select = $pdo->prepare("SELECT ins_tab.*, cat_tab.cat_name, cat_tab.cat_image FROM stockin_insert ins_tab, category cat_tab WHERE ins_tab.item_name = cat_tab.cat_name AND ins_tab.status='FIX' ORDER BY ins_tab.id DESC");
            $select->execute();
            // while($row = $select->fetch(PDO::FETCH_ASSOC)){
                foreach($select as $row){
                echo '
                    <tr>
                        <td style="display:none" class="user_id">'.$row['id'].'</td>
                        <td> 
                        <div class="btn-group btn-group-sm" >
                            <a href="#" class="btn btn-success fix_btn mr-2 data-toggle="tooltip" data-placement="bottom" title="Return""><i class="fas fa-forward"></i><small></small> </a> 
                            <a href="#" class="btn btn-warning broken_btn mr-2 data-toggle="tooltip" data-placement="bottom" title="Can not repair""><i class="fas fa-exclamation-triangle"></i><small></small> </a>                         
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
                        <td>'.$row['stockout_project_type'].'</td>
                        <td>'.$row['stockout_project'].'</td>
                        <td>'.$row['fix_remark'].'</td>
                        <td>'.$row['fix_date'].'</td>
                        <td>'.$row['fix_by'].'</td>
                        <td>'.$row['stockin_remark'].'</td>
                        <td>'.$row['stockout_remark'].'</td>
                        
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

  <!-- =============== Modal Broken Start ========================= -->
  <div class="modal fade" id="modal-broken">
  <div class="modal-dialog">
    <div class="modal-content bg-warning">
      <div class="modal-header">
        <h5 class="modal-title">ยืนยันอุปกรณ์เสีย ไม่สามารถซ่อมได้</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="Code_Add_Fix.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="broken_id" id="broken_id">
      </div>
      <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" name="broken_item" class="btn btn-danger">Confirm</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
      <!-- /.modal -->
<!-- =============== Modal Broken End ========================= -->

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
      <form action="Code_Add_Stockout.php" method="POST">
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

<!-- =============== Modal FIX Start========================= -->
<div class="modal fade" id="modal-stockout">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="text-head-card">รับคืนอุปกรณ์ส่งซ่อม</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

               
              <form method="post"  action="Code_Add_Fix.php">
                
                <input type="hidden" name="update_id" id="update_id">           
                

                <div class="form-group">
                    <label for="STIN_date-in" id="text-stock-in">วันที่รับคืนอุปกรณ์ <code><b>(required)</b></code></label>
                    <div class="input-group date" id="model_date_fix" data-target-input="nearest">
                        <input type="text" class="form-control form-control-sm datetimepicker-input" name="model_date_fix" data-target="#model_date_fix" required/>
                        <div class="input-group-append" data-target="#model_date_fix" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1" id="text-stock-in">Remark</label>
                  <textarea class="form-control" id="return_remark" name="return_remark" rows="3"></textarea>
                </div>


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
                <input type="submit" name="fix_submit" id="fix_submit" value="แก้ไขข้อมูล" class="btn btn-warning fix_submit_btn" />
            </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- =============== End FIX Out ========================= -->
 

<?php include('Footer.php'); ?>
<!-- ============= Date Picker ============== -->
<script src="LTE/plugins/select2/js/select2.full.min.js"></script>
<script src="LTE/plugins/moment/moment.min.js"></script>
<script src="LTE/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="LTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="LTE/fancyBox/dist/jquery.fancybox.js"></script>




<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": true,"scrollX": true,     
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  
  });
</script>

<script src="LTE/dist/SweetAlert/sweetalert.js"></script>


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


    $('.broken_btn').click(function (e) { 
      e.preventDefault();
      
      var broken_id = $(this).closest('tr').find('.user_id').text();
      console.log(broken_id);
      $('#broken_id').val(broken_id);
      $('#modal-broken').modal('show');
    });

    $('.delete_btn').click(function (e) { 
      e.preventDefault();
      
      var delete_id = $(this).closest('tr').find('.user_id').text();
      // console.log(delete_id);
      $('#delete_id').val(delete_id);
      $('#modal-delete').modal('show');
    });



    $('.fix_btn').click(function (e) { 
      e.preventDefault();
      var view_id = $(this).closest('tr').find('.user_id').text();
      //console.log(view_id);

      $.ajax({
        type: "POST",
        url: "Code_Add_stockout.php",
        data: {
            'check_fix' : true,
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
    $('#model_date_fix').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    
  })
 

</script>
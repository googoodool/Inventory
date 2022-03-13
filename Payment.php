
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

          <div class="col-md-4">
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

              <div class="col-md-4">
                <div class="form-group ">
                    <label for="pay_name_company" id="text-stock-in">ผู้รับจ้าง ในนามบริษัท</label>
                    <input type="text" class="form-control" id="pay_name_company" placeholder="" name="pay_name_company" >        
                </div>  

              </div>

              <div class="col-md-4">
                    <div class="form-group ">
                        <label for="pay_name_person" id="text-stock-in">ผู้รับจ้าง ในนามบุคคล</label>
                        <input type="text" class="form-control" id="pay_name_person" placeholder="" name="pay_name_person" >      
                    </div>  
              </div>

           

          </div>
            <!-- Row first row-->

            <div class="row">
              <div class="col-md-4">
                <div class="form-group ">
                    <label for="pay_detail" id="text-stock-in">รายละเอียดงานที่จ้าง</label>
                    <input type="text" class="form-control" id="pay_detail" placeholder="" name="pay_detail" >        
                </div>  

              </div>

              <div class="col-md-4">
                    <div class="form-group ">
                        <label for="pay_price" id="text-stock-in">ราคาค่าจ้าง</label>
                        <input type="number" step="any" class="form-control" id="pay_price" placeholder="" name="pay_price" >      
                    </div>  
              </div>

              <div class="col-md-4">
              <div class="form-group">
                      <label for="pay_date" id="text-stock-in">วันที่ </label>
                        <div class="input-group date" id="date_payment" data-target-input="nearest">
                          <input type="text" class="form-control form-control-sm datetimepicker-input" name="pay_date" id="pay_date" data-target="#date_payment" />
                        <div class="input-group-append" data-target="#date_payment" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
              </div>

          </div>
            <!-- Row second row-->

            <div class="row">
                <div class="col-md-4">
                <div class="form-group ">
                        <label for="pay_quo" id="text-stock-in">อ้างอิงใบเสนอราคา</label>
                        <input type="text" class="form-control" id="pay_quo" placeholder="" name="pay_quo" >        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="pay_po" id="text-stock-in">อ้างอิงใบสั่งซื้อ</label>
                        <input type="text" class="form-control" id="pay_po" placeholder="" name="pay_po" >        
                    </div> 
                </div>

                <div class="col-md-4">
                <div class="form-group">
                      <label for="exampleFormControlTextarea1" id="text-stock-in">Remark</label>
                      <textarea class="form-control" id="pay_remark" name="pay_remark"  rows="1"></textarea>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                <input style="margin-top:31px;" type="submit" name="insert" id="insert" value="บันทึกข้อมูล" class="btn btn-success btn-block" />
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
            <h3 class="card-title" id="text-stock-in">ข้อมูลค่าใช้จ่ายโครงการ</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body" id="text-stock-in-table">
              <table id="table1" class="table table-striped" style="text-align:center">
                  <thead>
                      <tr>
                          <th style="display:none;" width="70px" id="text-stock-in">ID</th>
                          <th width="100px" id="text-stock-in">Action</th>
                          <th width="300px" id="text-stock-in">ชื่อโครงการ</th>                    
                          <th width="150px" id="text-stock-in">ผู้รับจ้างในนามบริษัท</th>
                          <th width="150px" id="text-stock-in">ผู้รับจ้างในนามบุคคล</th>
                          <th width="80px" id="text-stock-in">ราคาค่าจ้าง</th>
                          <th width="150px" id="text-stock-in">รายละเอียดงานที่จ้าง</th>  
                          <th width="150px" id="text-stock-in">วันที่</th>  
                          <th width="150px" id="text-stock-in">อ้างอิงใบเสนอราคา</th>
                          <th width="150px" id="text-stock-in">อ้างอิงใบสั่งซื้อ</th>
                          <th width="150px" id="text-stock-in">Remark</th>
                       
                      </tr>
                  </thead>
                
                <tbody>
                  <?php
             //$select = $pdo->prepare("SELECT * FROM stockin_insert WHERE status = 'Stock-IN' ORDER BY id DESC");
            $select = $pdo->prepare("SELECT * FROM payment ORDER BY payment_id DESC");
            
            $select->execute();
            // while($row = $select->fetch(PDO::FETCH_ASSOC)){
                foreach($select as $row){
                echo '
                    <tr>
                        <td style="display:none;" class="pro_id">'.$row['payment_id'].'</td>
                        <td>
                        <div class="btn-group btn-group-sm">                            
                            <a href="#" class="btn btn-warning edit_btn mr-1 data-toggle="tooltip" data-placement="bottom" title="Edit""><i class="fas fa-edit"></i> </a>
                            <a href="#" class="btn btn-danger delete_btn data-toggle="tooltip" data-placement="bottom" title="Delete""><i class="fas fa-trash"></i></a>
                        </div>                          
                        
                        </td>

                        <td>'.$row['payment_project'].'</td>
                        <td>'.$row['payment_company'].'</td>
                        <td>'.$row['payment_person'].'</td>
                        <td>'.rtrim(rtrim(number_format($row['payment_price'], 3, '.', ','), '0'), '.').'</td>
                       
                        <td>'.$row['payment_detail'].'</td>
                        <td>'.$row['payment_date'].'</td>
                        <td>'.$row['payment_quo'].'</td>            
                        <td>'.$row['payment_po'].'</td>
                        <td>'.$row['payment_remark'].'</td>
               
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

    <!-- =============== Modal Delete Start ========================= -->
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog bg-danger">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h5 class="modal-title">ยืนยันการลบข้อมูล</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="Code_payment.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_id" id="delete_id">
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="submit" name="delete_project" class="btn btn-outline-light">Confirm</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- =============== Modal Delete End ========================= -->

<!-- =============== Modal Payment Edit ========================= -->
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

               
              <form method="post"  action="Code_payment.php">
                
                <input type="hidden" name="edit_id" id="edit_id">           

                <small id="text-stock-in" style="color:blue">ค่าใช้จ่ายในโครงการ</small>
                <hr>
                  
                <div class="row">
                  <div class="col-4">

                    <div class="form-group ">
                          <label for="update_project" id="text-stock-in">ชื่อโครงการ</label>
                          <input type="text" class="form-control form-control-sm" id="update_project" placeholder="" name="update_project" disabled>
                    </div>

                    <div class="form-group ">
                        <label for="update_detail" id="text-stock-in">รายละเอียดงานที่จ้าง</label>
                        <input type="text" class="form-control form-control-sm" id="update_detail" placeholder="" name="update_detail" >
                    </div>

                    <div class="form-group ">
                        <label for="update_quo" id="text-stock-in">อ้างอิงใบเสนอราคา</label>
                        <input type="text" class="form-control form-control-sm" id="update_quo" placeholder="" name="update_quo" >
                    </div>

             

                  </div>

                  <div class="col-4">

                    <div class="form-group ">
                          <label for="update_company" id="text-stock-in">ผู้รับจ้าง ในนามบริษัท</label>
                          <input type="text" class="form-control form-control-sm" id="update_company" placeholder="" name="update_company" >
                    </div>
                    
                    <div class="form-group ">
                        <label for="update_price" id="text-stock-in">ราคาค่าจ้าง</label>
                        <input type="number" step="any" class="form-control form-control-sm" id="update_price" placeholder="" name="update_price" >
                    </div>
                    

                   

                    <div class="form-group ">
                        <label for="update_po" id="text-stock-in">อ้างอิงใบสั่งซื้อ</label>
                        <input type="text" class="form-control form-control-sm" id="update_po" placeholder="" name="update_po" >
                    </div>

                  

                  </div>

                  <div class="col-4">
                    <div class="form-group ">
                        <label for="update_person" id="text-stock-in">ผู้รับจ้าง ในนามบุคคล</label>
                        <input type="text" class="form-control form-control-sm" id="update_person" placeholder="" name="update_person">
                    </div>


                    <div class="form-group">
                      <label for="STIN_date-in" id="text-stock-in">วันที่ </label>
                        <div class="input-group date" id="dateedit" data-target-input="nearest">
                          <input type="text" class="form-control form-control-sm datetimepicker-input" name="update_date-in" id="update_date-in" data-target="#dateedit" />
                        <div class="input-group-append" data-target="#dateedit" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="update_remark" id="text-stock-in">Remark</label>
                        <input type="text" class="form-control form-control-sm" id="update_remark" placeholder="" name="update_remark" >
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
<!-- =============== End Modal Payment Edit ========================= -->


<script>
  $(function () {
    $("#table1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": true ,"scrollX": true,"aaSorting": [],         
    }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
  
  });
</script>
<script type="text/javascript" src="LTE/fancyBox/dist/jquery.fancybox.js"></script>

<script>
  $(function () {
    //Date picker

    
    $('#date_payment').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $('#dateedit').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
  })

</script>

<script >
  $(document).ready(function () {


    $('.delete_btn').click(function (e) { 
      e.preventDefault();
      
      var delete_id = $(this).closest('tr').find('.pro_id').text();
      // console.log(delete_id);
      $('#delete_id').val(delete_id);
      $('#modal-delete').modal('show');
    });



    $('.edit_btn').click(function (e) { 
      e.preventDefault();
      var edit_id = $(this).closest('tr').find('.pro_id').text();
      // console.log(edit_id);
      $.ajax({
        type: "POST",
        url: "Code_payment.php",
        data: {
            'check_edit' : true,
            'item_id' : edit_id,
        },
        success: function (response) {

        $.each(response, function (key, value) { 
          //console.log(value['stockin_remark']);
          $('#edit_id').val(value['payment_id']);
          $('#update_project').val(value['payment_project']);
            $('#update_detail').val(value['payment_detail']);
            $('#update_quo').val(value['payment_quo']);
            $('#update_company').val(value['payment_company']);
            $('#update_price').val(value['payment_price']);
            $('#update_po').val(value['payment_po']);

            $('#update_person').val(value['payment_person']);
            $('#update_date-in').val(value['payment_date']);
            $('#update_remark').val(value['payment_remark']);
           
            
        });
         $('#modal-edit').modal('show');
        }
        
      });
    });


  });
</script>
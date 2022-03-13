
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
          title: "Insert To Database Error!",
          text: "พบปัญหาการปันทึกข้อมูล",
              })
          });
      </script> 
              
      ';
      unset($_SESSION['insert_status']);
    }
  }

  // ================== Type of Image Response ===============  
  if(isset($_SESSION['image_status']) && $_SESSION != ""){

    if($_SESSION['image_status'] == 'typeImageError'){
      echo '
        <script type="text/javascript">
            jQuery(function validation(){
  
            Swal.fire({
            icon: "warning",
            title: "Image type error!",
            text: "เลือกรูปนามสกุล JPG,JPEG,PNG เท่านั้น",
                })
            });
        </script> 
                
      ';
      unset($_SESSION['image_status']);
  }
}
// ================== Image Size Response ===============
if(isset($_SESSION['image_status']) && $_SESSION != ""){

  if($_SESSION['image_status'] == 'sizeImageError'){
    echo '
      <script type="text/javascript">
          jQuery(function validation(){

          Swal.fire({
          icon: "warning",
          title: "SIZE ERROR!",
          text: "เลือกรูปขนาดไม่เกิน 2MB เท่านั้น",
              })
          });
      </script> 
              
    ';
    unset($_SESSION['image_status']);
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

if(isset($_SESSION['broken_status']) && $_SESSION != ""){

  if($_SESSION['broken_status'] == 'broken_success'){
    echo '
      <script type="text/javascript">
          jQuery(function validation(){

          Swal.fire({
          icon: "success",
          title: "Process Success",
          text: "แก้ไขข้อมูลสำเร็จ",
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
      text: "พบปัญหาการแก้ไขข้อมูล",
          })
      });
  </script> 
          
';
unset($_SESSION['broken_status']);
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

        <form action="Code_Add_Asset.php" method="POST" enctype="multipart/form-data">
<!-- ======================  ROW 1 ====================== -->
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="asset_name" id="text-stock-in">ชื่ออุปกรณ์ <code><b>(required)</b></code></label>
                    <input type="text" class="form-control" id="asset_name" placeholder="" name="asset_name" required>
                    </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="asset_brand" id="text-stock-in">ยี่ห้อ </label>
                        <input type="text" class="form-control" id="asset_brand" placeholder="" name="asset_brand" >
                    </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3">       
                    <div class="form-group">
                        <label for="asset_model" id="text-stock-in">รุ่น </label>
                        <input type="text" class="form-control" id="asset_model" placeholder="" name="asset_model" >
                    </div>

                </div>
                <!-- col-3 -->

                <div class="col-md-3">

                    <label for="asset_qty" id="text-stock-in">จำนวน <code><b>(required)</b></code></label>
                    <input type="number" min="1"  class="form-control" id="asset_qty" placeholder="" name="asset_qty" required>
                 
                </div>
                <!-- col-3 -->
            </div>
            <!-- row -->
<!-- ======================  ROW 2 ====================== -->
            <div class="row">
                <div class="col-md-3">    
                  <div class="form-group ">
                        <label for="asset_sn" id="text-stock-in">Serial Number</label>
                        <input type="text" class="form-control" id="asset_sn" placeholder="" name="asset_sn" >
                  </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                    <div class="form-group ">
                        <label for="asset_price" id="text-stock-in">ราคา / หน่วย</label>
                        <input type="text" class="form-control" id="asset_price" placeholder="" name="asset_price" >
                    </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="asset_image" id="text-stock-in">Image</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input"  name="asset_image" value="">
                            <label class="custom-file-label" for="asset_image"></label>
                          </div>
                          
                        </div>
                      </div>

                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                  

                <div class="form-group">
                    <label for="STIN_date-in" id="text-stock-in">วันที่ซื้ออุปกรณ์ </label>
                    <div class="input-group date" id="dateStockIn" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="asset_date_buy" data-target="#dateStockIn" />
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
                          <label for="asset_seller" id="text-stock-in">บริษัทผู้ขาย</label>
                          <input type="text" class="form-control" id="asset_seller" placeholder="" name="asset_seller" >
                    </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                <div class="form-group ">
                        <label for="asset_id_qtation" id="text-stock-in">เลขที่ใบเสนอราคา</label>
                        <input type="text" class="form-control" id="asset_id_qtation" placeholder="" name="asset_id_qtation" >
                    </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3 "  >

                <div class="form-group ">
                        <label for="asset_id_po" id="text-stock-in">เลขที่ใบสั่งซื้อ</label>
                        <input  type="text" class="form-control" id="asset_id_po" placeholder="" name="asset_id_po" >
                </div>

                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                
               
                </div>
                <!-- col-3 -->
            </div>
            <!-- row -->
            <div class="row">
              <div class="col-md-9">
              <div class="form-group">
                  <label for="exampleFormControlTextarea1" id="text-stock-in">Remark</label>
                  <select class="select2" multiple="multiple"  style="width: 100%;" name="asset_create_remark[]" id="asset_create_remark">
                  <!-- <textarea class="form-control" id="asset_create_remark" name="asset_create_remark" rows="1"></textarea> -->
                  <?php
                         $select = $pdo->prepare("SELECT create_remark FROM asset GROUP BY create_remark ORDER BY id DESC");
                         $select->execute();
                         if($select->rowCount() > 0){
                            foreach($select as $row){
                                if($row['create_remark'] != null){
                                  echo '
                                  <option value="'.$row['create_remark'].'">'.$row['create_remark'].'</option>
                                  ';
                                }    
                            }
                         }
                        ?>
                  </select>
                </div>

              </div>
              <div class="col-md-3">
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
            <h3 class="card-title" id="text-head-card">รายการอุปกรณ์เครื่องมือ</h3>

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
                          <th width="50px" id="text-stock-in">จำนวน</th>
                          <th width="150px" id="text-stock-in">Serial Number</th>
                          <th width="100px" id="text-stock-in">ราคา</th>
                          <th width="150px" id="text-stock-in">วันที่ซื้ออุปกรณ์</th>
                          <th width="200px" id="text-stock-in">บริษัทผู้ขาย</th>
                          <th width="200px" id="text-stock-in">เลขที่ใบเสนอราคา</th>
                          <th width="200px" id="text-stock-in">เลขที่ใบสั่งซื้อ</th>
                          <th width="300px" id="text-stock-in">Remark</th>
                          <th width="200px" id="text-stock-in">Create Date</th>
                          <th width="250px" id="text-stock-in">Create By</th>
                          <th width="150px" id="text-stock-in">Update Date</th>
                          <th width="150px" id="text-stock-in">Update By</th>  
                          <th width="150px" id="text-stock-in">วันที่แจ้งเสีย</th>
                          <th width="150px" id="text-stock-in">วันที่ยกเลิกการแจ้งเสีย</th>  
                          <th width="300px" id="text-stock-in">Update Remark</th>  
                      </tr>
                  </thead>
                  <tbody id="FixHistory_tbody">
                      <?php
                         $select = $pdo->prepare("SELECT * FROM asset ORDER BY id DESC");
                         $select->execute();
                         while($row = $select->fetch(PDO::FETCH_ASSOC)){
                            $pic = $row['image'];
                            if($pic == null){
                              $pic = 'no-image.png';
                            }
                            
                            $status_color = 'white';
                            if($row['working'] == 'bad'){
                              $status_color = '#F9D3D3';
                            }
                            echo '
                            <tr>
                            <td style="display:none" class="asset_id">'.$row['id'].'</td>
                            <td>
                                <div class="btn-group btn-group-sm">                                     
                                    <a href="#" class="btn btn-success edit_btn mr-1" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger delete_btn mr-1" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash"></i></a>
                                    <a href="#" class="btn btn-warning broken_btn" data-toggle="tooltip" data-placement="bottom" title="แจ้งเสีย"><i class="fas fa-times-circle"></i></a>
                                    </div>
                            </td>
                            <td>
                                <a href="Asset_image/'.$pic.'"class="fancybox" title="'.$row['name'].'" data-fancybox-group="gallery">
                                    <img id="myImg" src="Asset_image/'.$pic.'" alt="" width="50px" height="40px">
                                </a>
                            </td>
                            <td style="background-color:'.$status_color.'">'.$row['name'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['brand'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['model'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['qty'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['serial'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['price'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['date_buy'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['seller'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['id_quotation'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['id_po'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['create_remark'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['create_by'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['create_date'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['update_date'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['update_by'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['broken_date'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['broken_return_date'].'</td>
                            <td style="background-color:'.$status_color.'">'.$row['update_remark'].'</td>
                           
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
            <form action="Code_Add_Asset.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_id" id="delete_id">
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="submit" name="delete_asset" class="btn btn-outline-light">Confirm</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- =============== Modal Delete End ========================= -->

<!-- =============== Modal broken Start ========================= -->
<div class="modal fade" id="modal-broken">
        <div class="modal-dialog bg-warning">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h5 class="modal-title">ยืนยันอุปกรณ์เสีย</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="Code_Add_Asset.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="broken_id" id="broken_id">
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="broken_asset" class="btn btn-danger">แจ้งอุปกรณ์เสีย</button>
            <button type="submit" name="broken_return_asset" class="btn btn-outline-primary">ยกเลิกการแจ้งอุปกรณ์เสีย</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- =============== Modal broken End ========================= -->

 <!-- =============== Modal Asset Edit ========================= -->
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

               
              <form method="post"  action="Code_Add_Asset.php" enctype="multipart/form-data">
                
                <input type="hidden" name="edit_id" id="edit_id">           

                <small id="text-stock-in" style="color:blue">รายละเอียดอุปกรณ์</small>
                <hr>
                  
                <div class="row">
                  <div class="col-4">

                    <div class="form-group ">
                          <label for="edit_name" id="text-stock-in">ชื่ออุปกรณ์</label>
                          <input type="text" class="form-control form-control-sm" id="update_name" placeholder="" name="update_name" >
                    </div>

                    <div class="form-group ">
                        <label for="update_qty" id="text-stock-in">จำนวน</label>
                        <input type="text" class="form-control form-control-sm" id="update_qty" placeholder="" name="update_qty" >
                    </div>

                    <div class="form-group ">
                        <label for="STIN_price" id="text-stock-in">ราคา / หน่วย</label>
                        <input type="text" class="form-control" id="update_price" placeholder="" name="update_price" >
                    </div>

                    <div class="form-group ">
                        <label for="STIN_id_qtation" id="text-stock-in">เลขที่ใบเสนอราคา</label>
                        <input type="text" class="form-control" id="update_id_qtation" placeholder="" name="update_id_qtation" >
                    </div>

                  </div>

                  <div class="col-4">

                    <div class="form-group ">
                          <label for="update_brand" id="text-stock-in">ยี่ห้อ</label>
                          <input type="text" class="form-control form-control-sm" id="update_brand" placeholder="" name="update_brand">
                    </div>

                    <div class="form-group ">
                        <label for="update_serial" id="text-stock-in">Serial Number</label>
                        <input type="text" class="form-control form-control-sm" id="update_serial" placeholder="" name="update_serial" >
                    </div>

                    <div class="form-group">
                      <label for="STIN_date-in" id="text-stock-in">วันที่รับอุปกรณ์ </label>
                        <div class="input-group date" id="dateedit" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="update_date-in" id="update_date-in" data-target="#dateedit" />
                        <div class="input-group-append" data-target="#dateedit" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="asset_image" id="text-stock-in">Image</label>
                        <div class="input-group ">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input " name="update_image" value="" >
                            <label class="custom-file-label " for="update_image" id="update_image"></label>
                          </div>
                          
                        </div>
                      </div>
                    

                  </div>

                  <div class="col-4">
                    <div class="form-group ">
                        <label for="update_model" id="text-stock-in">รุ่น</label>
                        <input type="text" class="form-control form-control-sm" id="update_model" placeholder="" name="update_model">
                    </div>

                    

                      <div class="form-group ">
                        <label for="STIN_id_po" id="text-stock-in">เลขที่ใบสั่งซื้อ</label>
                        <input  type="text" class="form-control form-control-sm" id="update_id_po" placeholder="" name="update_id_po" >
                    </div>
                    

                    <div class="form-group ">
                        <label for="STIN_seller" id="text-stock-in">บริษัทผู้ขาย</label>
                        <input type="text" class="form-control" id="update_seller" placeholder="" name="update_seller" >
                  </div>

                  <div class="form-group">
                    <label for="exampleFormControlTextarea1" id="text-stock-in">Remark</label>
                   
                    <textarea class="form-control" id="update_remark" name="update_remark"  rows="1"></textarea>
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
<!-- =============== End Modal Asset Edit ========================= -->

 

<?php include('Footer.php'); ?>
<!-- ============= Date Picker ============== -->
<script src="LTE/plugins/select2/js/select2.full.min.js"></script>
<script src="LTE/plugins/moment/moment.min.js"></script>
<script src="LTE/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="LTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="LTE/fancyBox/dist/jquery.fancybox.js"></script>
<script src="LTE/dist/SweetAlert/sweetalert.js"></script>
<!-- bs-custom-file-input -->
<script src="LTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>



<script type="text/javascript">
var colors = ["#F562FC", "#62DBFC", "#87FC62", "#A162FC", "#F1B317"];
$(document).ready(function () {
     var checkList = [1, 3];
  $("#asset_create_remark").select2({
  	width: "100%",
    tags: true,
    maximumSelectionLength: 5,
    heme: "classic",
    allowClear: true,
    templateSelection: function (data, container) {
      var selection = $('#asset_create_remark').select2('data');
      var idx = selection.indexOf(data);
      console.log(">>Selection",data.text, data.idx, idx);
      data.idx = idx;
      
      $(container).css("background-color", colors[data.idx]);
      return data.text;
    },
  }).val(checkList).trigger("change");
  
  $("#asset_create_remark").on("select2:select", function (evt) {
    var element = evt.params.data.element;
    var $element = $(element);

    $element.detach();
    $(this).append($element);
    $(this).trigger("change");
  });
});

</script>

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
      
      var delete_id = $(this).closest('tr').find('.asset_id').text();
      console.log(delete_id);
      $('#delete_id').val(delete_id);
      $('#modal-delete').modal('show');
    });

    $('.broken_btn').click(function (e) { 
      e.preventDefault();
      
      var broken_id = $(this).closest('tr').find('.asset_id').text();
      console.log(broken_id);
      $('#broken_id').val(broken_id);
      $('#modal-broken').modal('show');
    });

    $('.edit_btn').click(function (e) { 
      e.preventDefault();
      
      var edit_id = $(this).closest('tr').find('.asset_id').text();
      //console.log(edit_id)
      $.ajax({
        type: "POST",
        url: "Code_Add_Asset.php",
        data: {
            'check_edit' : true,
            'item_id' : edit_id,
        },
        success: function (response) {

        $.each(response, function (key, value) { 
          console.log(value['name']);
            $('#update_name').val(value['name']);
            $('#update_model').val(value['model']);
            $('#update_qty').val(value['qty']);
            $('#update_brand').val(value['brand']);
            $('#update_serial').val(value['serial']);

            $('#update_price').val(value['price']);
            $('#update_id_qtation').val(value['id_quotation']);
            $('#update_date-in').val(value['date_buy']);
            $('#update_id_po').val(value['id_po']);
            $('#update_seller').val(value['seller']);
            $('#update_remark').val(value['create_remark']);
            
            $('#edit_id').val(value['id']);
          
        });
         $('#modal-edit').modal('show');
        }
        
       });
    });




    });
</script>


<script>
$(function () {
  bsCustomFileInput.init();
});
</script>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": true,"scrollX": true,"aaSorting": [],     
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  
  });
</script>


<script>
  $(function () {
    //Date picker
    $('#dateStockIn').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#dateedit').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
  })
  
</script>



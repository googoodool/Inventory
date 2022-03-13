
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
                    <select class="custom-select  rounded-0" id="STIN_name" placeholder="" name="STIN_name" required>
                        <option selected="selected" value=""></option>
                       
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
                        <label for="STIN_brand" id="text-stock-in">ยี่ห้อ <code><b>(required)</b></code></label>

                        <select class="custom-select  rounded-0" id="STIN_brand" placeholder="" name="STIN_brand" required>
                        <option selected="selected" value=""></option>
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
                    <!-- <div class="form-group ">
                        <label for="STIN_model" id="text-stock-in">รุ่น</label>
                        <input type="text" class="form-control" id="STIN_model" placeholder="" name="STIN_model" >
                    </div> -->

                    <div class="form-group ">
                        <label for="STIN_model" id="text-stock-in">รุ่น</label>

                        <select class="custom-select  rounded-0" id="STIN_model" placeholder="" name="STIN_model" >
                        <option selected="selected" value=""></option>
                        <?php
                         $select = $pdo->prepare("SELECT model_name FROM model ORDER BY id DESC");
                         $select->execute();
                         if($select->rowCount() > 0){
                            foreach($select as $row){
                            
                                echo '
                                <option value="'.$row['model_name'].'">'.$row['model_name'].'</option>
                                ';
                            
                            }
                         }
                        ?>
                      </select>
                    </div>

                </div>
                <!-- col-3 -->

                <div class="col-md-3">

                    <label for="STIN_qty" id="text-stock-in">จำนวน <code><b>(required)</b></code></label>
                    <input type="number" min="1"  class="form-control" id="STIN_qty" placeholder="" name="STIN_qty" required>
                 
                </div>
                <!-- col-3 -->
            </div>
            <!-- row -->
<!-- ======================  ROW 2 ====================== -->
            <div class="row">
                <div class="col-md-3">    
                <!-- <label for="STIN_serial" id="text-stock-in">Serial Number (Product)</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="STIN_serial" name="STIN_serial" >
                  <span class="input-group-append">
                    <button type="button" class="btn btn-primary btn-flat" onclick="generate()">Auto</button>
                  </span>
                </div> -->
                    <div class="form-group ">
                        <label for="STIN_serial" id="text-stock-in">Serial Product</label>
                        <input type="text" class="form-control" id="STIN_serial" placeholder="" name="STIN_serial" >
                        
                    </div>              
                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                  <div class="row">
                    <div class="col-md-7">
                      <div class="form-group ">
                          <label for="STIN_price" id="text-stock-in">ราคา (ต่างประเทศ)</label>
                          <input type="text" class="form-control" id="STIN_price" placeholder="" name="STIN_price" >
                      </div>

                    </div>

                    <div class="col-md-5">
                    <label for="STIN_currency" id="text-stock-in">หน่วย</label>
                      <select class="custom-select  rounded-0" id="STIN_currency" placeholder="" name="STIN_currency" >
                          <option selected="selected" value=""></option>
                         
                          <option  value="USD">USD</option>
                          <option  value="EUR">EUR</option>
                          <option  value="CNY">CNY</option>
                          <option  value="JPY">JPY</option>
                          <option  value="GBP">GBP</option>
                          
                        </select>
                    </div>
                  </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                  <div class="form-group ">
                        <label for="STIN_price_thb" id="text-stock-in">ราคา (บาท)</label>
                        <input type="ืnumber" class="form-control" id="STIN_price_thb" placeholder="" name="STIN_price_thb" >
                    </div>

                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                  

                <div class="form-group">
                    <label for="STIN_date-in" id="text-stock-in">วันที่รับอุปกรณ์ <code><b>(required)</b></code></label>
                    <div class="input-group date" id="dateStockIn" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="STIN_date-in" data-target="#dateStockIn" required/>
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
                        <label for="STIN_serial_group" id="text-stock-in">Serial Group</label>
                        <input type="text" class="form-control" id="STIN_serial_group" placeholder="" name="STIN_serial_group" >
                  </div>
                  
                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                  <div class="form-group ">
                        <label for="STIN_seller" data-dropdown-css-class="select2-danger" id="text-stock-in">บริษัทผู้ขาย</label>

                        <select class="form-control" id="STIN_seller" placeholder="" name="STIN_seller" >
                        <option selected="selected" value=""></option>
                        <?php
                         $select = $pdo->prepare("SELECT seller_name FROM seller ORDER BY id DESC");
                         $select->execute();
                         if($select->rowCount() > 0){
                            foreach($select as $row){
                            
                                echo '
                                <option value="'.$row['seller_name'].'">'.$row['seller_name'].'</option>
                                ';
                            
                            }
                         }
                        ?>
                      </select>
                    </div>
                </div>
                <!-- col-3 -->

                <div class="col-md-3 "  >

                  <div class="form-group ">
                      <label for="STIN_id_qtation" id="text-stock-in">เลขที่ใบเสนอราคา</label>
                      <input type="text" class="form-control" id="STIN_id_qtation" placeholder="" name="STIN_id_qtation" >
                  </div>

                </div>
                <!-- col-3 -->

                <div class="col-md-3">
                  <div class="form-group ">
                        <label for="STIN_id_po" id="text-stock-in">เลขที่ใบสั่งซื้อ</label>
                        <input  type="text" class="form-control" id="STIN_id_po" placeholder="" name="STIN_id_po" >
                  </div>
               
                </div>
                <!-- col-3 -->
            </div>
            <!-- row -->
            <div class="row">
              <div class="col-md-3">
              <label for="STIN_serial" id="text-stock-in">Serial Generate</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="STIN_serial_gen" name="STIN_serial_gen" >
                  <span class="input-group-append">
                    <button type="button" class="btn btn-primary btn-flat gen_btn">Auto</button>
                  </span>
                </div>    
              </div>
              <div class="col-md-6">
             
                <div class="form-group">
                  <label id="text-stock-in">Remark</label>
                  <select class="select2" multiple="multiple"  style="width: 100%;" name="stockin_remark[]" id="stockin_remark">
                 
                        <?php
                         $select = $pdo->prepare("SELECT stockin_remark FROM stockin_insert GROUP BY stockin_remark ORDER BY id DESC");
                         $select->execute();
                         if($select->rowCount() > 0){
                            foreach($select as $row){
                                if($row['stockin_remark'] != null){
                                  echo '
                                  <option value="'.$row['stockin_remark'].'">'.$row['stockin_remark'].'</option>
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
            <form action="Code_Add_Stockin.php" method="POST">
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

               
              <form method="post"  action="Code_Add_stockin.php">
                
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

               
              <form method="post"  action="Code_Add_stockin.php">
                
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

 <!-- ============ Select 2 ===========  -->
<script>
  $(function () {
    $('#STIN_seller').select2({ 
    })

    $('#STIN_name').select2({ 
    })

    $('#STIN_brand').select2({ 
    })
    
  });
</script>

<script type="text/javascript">
var colors = ["#CA6FC2", "#6FCACA", "#6FCA75", "#9FA9C8", "#F1B317"];
$(document).ready(function () {
     var checkList = [1, 3];
  $("#stockin_remark").select2({
  	width: "100%",
    tags: true,
    maximumSelectionLength: 5,
    heme: "classic",
    allowClear: true,
    templateSelection: function (data, container) {
      var selection = $('#stockin_remark').select2('data');
      var idx = selection.indexOf(data);
      console.log(">>Selection",data.text, data.idx, idx);
      data.idx = idx;
      
      $(container).css("background-color", colors[data.idx]);
      return data.text;
    },
  }).val(checkList).trigger("change");
  
  $("#stockin_remark").on("select2:select", function (evt) {
    var element = evt.params.data.element;
    var $element = $(element);

    $element.detach();
    $(this).append($element);
    $(this).trigger("change");
  });
});
</script>

<script >
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
   

    // =========== Sort by name ============
    var options = $('#STIN_name option');
    var arr = options.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr.sort(function(o1, o2) {
        return o1.t.toLowerCase() > o2.t.toLowerCase() ? 1 : o1.t.toLowerCase() < o2.t.toLowerCase() ? -1 : 0;
    });
    options.each(function(i, o) {
        //console.log(i);
        o.value = arr[i].v;
        $(o).text(arr[i].t);
    });

    var options = $('#STIN_brand option');
    var arr = options.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr.sort(function(o1, o2) {
        return o1.t.toLowerCase() > o2.t.toLowerCase() ? 1 : o1.t.toLowerCase() < o2.t.toLowerCase() ? -1 : 0;
    });
    options.each(function(i, o) {
        //console.log(i);
        o.value = arr[i].v;
        $(o).text(arr[i].t);
    });
    

    var options = $('#STIN_model option');
    var arr = options.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr.sort(function(o1, o2) {
        return o1.t.toLowerCase() > o2.t.toLowerCase() ? 1 : o1.t.toLowerCase() < o2.t.toLowerCase() ? -1 : 0;
    });
    options.each(function(i, o) {
        //console.log(i);
        o.value = arr[i].v;
        $(o).text(arr[i].t);
    });
    

    var options = $('#STIN_seller option');
    var arr = options.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr.sort(function(o1, o2) {
        return o1.t.toLowerCase() > o2.t.toLowerCase() ? 1 : o1.t.toLowerCase() < o2.t.toLowerCase() ? -1 : 0;
    });
    options.each(function(i, o) {
        //console.log(i);
        o.value = arr[i].v;
        $(o).text(arr[i].t);
    });

    

    var options = $('#STOUT_projectType option');
    var arr = options.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr.sort(function(o1, o2) {
        return o1.t.toLowerCase() > o2.t.toLowerCase() ? 1 : o1.t.toLowerCase() < o2.t.toLowerCase() ? -1 : 0;
    });
    options.each(function(i, o) {
        //console.log(i);
        o.value = arr[i].v;
        $(o).text(arr[i].t);
    });

    // =======================

    $('.edit_btn').click(function (e) { 
      e.preventDefault();
      var edit_id = $(this).closest('tr').find('.pro_id').text();
      // console.log(edit_id);
      $.ajax({
        type: "POST",
        url: "Code_Add_stockin.php",
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


    $('.delete_btn').click(function (e) { 
      e.preventDefault();
      
      var delete_id = $(this).closest('tr').find('.pro_id').text();
      //console.log(delete_id);
      $('#delete_id').val(delete_id);
      $('#modal-delete').modal('show');
    });



    $('.stockout_btn').click(function (e) { 
      e.preventDefault();
      var view_id = $(this).closest('tr').find('.pro_id').text();
      console.log(view_id);

      $.ajax({
        type: "POST",
        url: "Code_Add_stockin.php",
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

    $('.gen_btn').click(function (e) { 
      e.preventDefault();
      console.log('Click')
      
      $.get("Code_Generate.php", function(data){
            // Display the returned data in browser
            $("#STIN_serial_gen").val(data);
        });
   
    });

    
     

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

<script type="text/javascript" src="LTE/fancyBox/dist/jquery.fancybox.js"></script>
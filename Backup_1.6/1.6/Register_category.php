
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


// ================== Insert Response ===============
if(isset($_SESSION['status']) && $_SESSION != ""){
    // echo $_SESSION['status'];
  
    if($_SESSION['status'] == 'success'){
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
        unset($_SESSION['status']);
    }elseif($_SESSION['status'] == 'same'){
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
      unset($_SESSION['status']);
  
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
      unset($_SESSION['status']);
    }
  }

  // ================== Delete Response ===============
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

// ================== Edit Response ===============
if(isset($_SESSION['update_status']) && $_SESSION != ""){

  if($_SESSION['update_status'] == 'update_success'){
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
    unset($_SESSION['update_status']);
}else{
  echo '
  <script type="text/javascript">
      jQuery(function validation(){

      Swal.fire({
      icon: "warning",
      title: "Edit Failed",
      text: "พบปัญหาการแก้ไขข้อมูล",
          })
      });
  </script> 
          
';
unset($_SESSION['update_status']);
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

    <div>
      <button class="btn btn-primary" data-toggle="modal" data-target="#modal-insert">
      <i class="fa fa-plus" aria-hidden="true"></i> 
      เพิ่มประเภทอุปกรณ์
      </button>
    </div>
    <br>
       
<!-- ================ Table ========================= -->

<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="text-head-card">ข้อมูลเพิ่มประเภทอุปกรณ์</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body" >
              <table id="cat_table" class="table table-striped" style="text-align:center">
                  <thead id="FixHistory_tbody">
                      <tr>
                          <th width="10%">Image</th>
                          <th width="35%">ประเภทอุปกรณ์</th> 
                          <th width="20%">Create Date</th>
                          <th width="15%">Create By</th>  
                          <th width="15%">Delete</th>
                      </tr>
                  </thead>
                  <tbody id="FixHistory_tbody">
                    
                  <?php
            $select = $pdo->prepare("SELECT * FROM category ORDER BY id DESC");
            $select->execute();
            while($row = $select->fetch(PDO::FETCH_ASSOC)){
                // foreach($select as $row){
                  $pic = $row['cat_image'];
                  if($pic == null){
                    $pic = 'no-image.png';
                  }
                  
                echo '
                
                  
                    <tr>
                        <td style="display:none" class="cat_id">'.$row['id'].'</td>
                        <td>
                          <a href="Picture/'.$pic.'"class="fancybox" title="'.$row['cat_name'].'" data-fancybox-group="gallery">
                            <img id="myImg" src="Picture/'.$pic.'" alt="" width="50px" height="40px">
                          </a>
                        </td>
                        <td>'.$row['cat_name'].'</td>
                        <td>'.$row['cat_create_date'].'</td>
                        <td>'.$row['cat_create_by'].'</td>
                        <td>
                        <div class="btn-group btn-group-sm">                                     
                        
                        <a href="#" class="btn btn-success edit_btn mr-1" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-danger delete_btn" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash"></i></a>
                        </div>
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



<!-- =============== Modal INSERT Start ========================= -->
<div class="modal fade" id="modal-insert">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">กรุณาใส่ข้อมูล</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="FixHistory_tbody">
              
              
            <form method="post"  action="Code_Add_Category.php" enctype="multipart/form-data">
                <label>ประเภทอุปกรณ์</label>
                <input type="text" name="category_name" id="category_name" class="form-control" required/>
                <br>
                <div class="form-group">
                  <label for="cat_img">Image</label><br>
                  <input type="file" value="" name="cat_img">
                </div>
                
          
                <br />
                <input type="submit" name="insert" id="insert" value="บันทึกข้อมูล" class="btn btn-primary btn-block mt-4" />
            </form>


            </div>
            <div class="modal-footer justify-content-between">
         
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- =============== Modal INSERT End ========================= -->

<!-- =============== Modal EDIT Start ========================= -->
<div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">กรุณาใส่ข้อมูล</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="FixHistory_tbody">
              
              
            <form method="post"  action="Code_Add_Category.php" enctype="multipart/form-data">
                <label>ประเภทอุปกรณ์</label>
                <input type="hidden" name="edit_id" id="edit_id">
                <input type="text" name="category_name_edit" id="category_name_edit" class="form-control" />
                <br>
                <div class="form-group">
                  <label for="cat_img">Image</label><br>
                  <input type="file" value="" name="cat_img">
                  
                </div>
                
          
                <br />
                <input type="submit" name="edit_modal_submit" id="edit_modal_submit" value="บันทึกข้อมูล" class="btn btn-primary btn-block mt-4" />
            </form>


            </div>
            <div class="modal-footer justify-content-between">
         
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- =============== Modal EDIT End ========================= -->


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
            <form action="Code_Add_Category.php" method="POST">
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


    //================================

    $('.delete_btn').click(function (e) { 
      e.preventDefault();
      
      var delete_id = $(this).closest('tr').find('.cat_id').text();
      console.log(delete_id);
      $('#delete_id').val(delete_id);
      $('#modal-delete').modal('show');
    });



    $('.edit_btn').click(function (e) { 
      e.preventDefault();
      var edit_id = $(this).closest('tr').find('.cat_id').text();
      // console.log(edit_id);
      $.ajax({
        type: "POST",
        url: "Code_Add_Category.php",
        data: {
            'check_edit' : true,
            'item_id' : edit_id,
        },
        success: function (response) {

        $.each(response, function (key, value) { 
          console.log(value['cat_name']);
           $('#category_name_edit').val(value['cat_name']);
            $('#edit_id').val(value['id']);
          
        });
         $('#modal-edit').modal('show');
        }
        
      });
    });

  });
</script>

<script>
  (function () {
    $("#cat_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,     
    }).buttons().container().appendTo('#cat_table .col-md-6:eq(0)');
  
  });
</script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->

<script type="text/javascript" src="LTE/fancyBox/dist/jquery.fancybox.js"></script>
<script src="LTE/dist/SweetAlert/sweetalert.js"></script>
<!-- bs-custom-file-input -->
<script src="LTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>



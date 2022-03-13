
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
      title: "Update Failed",
      text: "พบปัญหาการแก้ไขข้อมูล",
          })
      });
  </script> 
          
';
unset($_SESSION['update_status']);
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

    <div>
      <button class="btn btn-primary" data-toggle="modal" data-target="#modal-insert">
      <i class="fa fa-plus" aria-hidden="true"></i> 
      เพิ่มรุ่น (Model)
      </button>
    </div>
    <br>
       
<!-- ================ Table ========================= -->

<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="text-head-card">ข้อมูลรุ่น (Model)</h3>

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
                          
                          <th width="35%">Model Name</th>
                          <th width="20%">Create By</th>
                          <th width="20%">Create Date</th>  
                          <th width="15%">Delete</th>
                      </tr>
                  </thead>
                  <tbody id="FixHistory_tbody">
                  <?php
            $select = $pdo->prepare("SELECT * FROM model ORDER BY id DESC");
            $select->execute();
            // while($row = $select->fetch(PDO::FETCH_ASSOC)){
                foreach($select as $row){
                echo '
                    <tr>
                        <td style="display:none" class="pro_id">'.$row['id'].'</td>
                        <td>'.$row['model_name'].'</td>
                        <td>'.$row['create_by'].'</td>
                        <td>'.$row['create_date'].'</td>
                        <td>
                        <div class="btn-group btn-group-sm">                                     
                        <a href="#" class="btn btn-danger delete_btn" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash"></i></a>
                        </div>
                        </td>
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

<!-- =============== Modal INSERT Start ========================= -->
<div class="modal fade" id="modal-insert">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="text-head-card">กรุณาใส่ข้อมูล</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body"  id="FixHistory_tbody">
              
              
            <form method="post"  action="Code_Add_Model.php">
                <label>Model Name</label>
                <input type="text" name="model_name" id="model_name" class="form-control" />
                <br />
                <input type="submit" name="insert" id="insert" value="บันทึกข้อมูล" class="btn btn-primary btn-block" />
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

<!-- =============== Modal VIEW Start ========================= -->
<div class="modal fade" id="modal-view">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">แสดงข้อมูล</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="project_view_data">

              </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- =============== Modal VIEW End ========================= -->

<!-- =============== Modal EDIT Start ========================= -->
<div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">แก้ไขข้อมูล</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="post"  action="Code_Add_Project.php">
                <label>ชื่อโครงการ</label>
                <input type="hidden" name="update_id" id="update_id">
                <input type="text" name="edit_name" id="edit_name" class="form-control" />
                <br />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="update" id="update" value="แก้ไขข้อมูล" class="btn btn-warning" />
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
            <form action="Code_Add_model.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_id" id="delete_id">
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="submit" name="delete_model" class="btn btn-outline-light">Confirm</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- =============== Modal Delete End ========================= -->


<script src="LTE/dist/SweetAlert/sweetalert.js"></script>
<script>
  $(document).ready(function () {

    $('.delete_btn').click(function (e) { 
      e.preventDefault();
      
      var delete_id = $(this).closest('tr').find('.pro_id').text();
      console.log(delete_id);
      $('#delete_id').val(delete_id);
      $('#modal-delete').modal('show');
    });



    $('.view_btn').click(function (e) { 
      e.preventDefault();
      
      var pro_id = $(this).closest('tr').find('.pro_id').text();
      //console.log(pro_id);
      $.ajax({
        type: "POST",
        url: "Code_Add_Project.php",
        data: {
            'check_view' : true,
            'project_id' : pro_id,
        },
        
        success: function (response) {
          console.log(response);
          $('.project_view_data').html(response);
          $('#modal-view').modal('show');
        }
      });

    });

    $('.edit_btn').click(function (e) { 
      e.preventDefault();
      
      var pro_id = $(this).closest('tr').find('.pro_id').text();
      //console.log(pro_id);
      
      $.ajax({
        type: "POST",
        url: "Code_Add_Project.php",
        data: {
            'check_edit' : true,
            'project_id' : pro_id,
        },
        
        success: function (response) {
          //console.log(response);

          $.each(response, function (key, value) { 
            //  console.log(value['station_name']);
              $('#update_id').val(value['id']);
              $('#edit_name').val(value['station_name']);
          });
          $('#modal-edit').modal('show');
        }
      });

    });

  });
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,     
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  
  });
</script>
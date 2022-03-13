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
        เพิ่มผู้ใช้งาน
        </button>
      </div>
      <br>
        
<!-- ================ Table ========================= -->

<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="text-head-card" >ข้อมูลผู้ใช้งาน</h3>

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
                          
                          <th width="15%">Username</th>
                          <th width="15%">ชื่อ</th>
                          <th width="20%">นามสกุล</th>
                          <th width="10%">Role</th>
                          <th width="15%">Create Date</th>
                          <th width="10%">Create By</th>
                          <th width="10%">Delete</th>
                      </tr>
                  </thead>
                  <tbody id="FixHistory_tbody">
                    
                  
                  <?php
            $select = $pdo->prepare("SELECT * FROM user ORDER BY id DESC");
            $select->execute();
            //while($row = $select->fetch(PDO::FETCH_ASSOC)){
                foreach($select as $row){
                echo '
                    <tr>

                        <td style="display:none;" class="user_id">'.$row['id'].'</td>
                        <td>'.$row['username'].'</td>
                        <td>'.$row['realname'].'</td>
                        <td>'.$row['surname'].'</td>
                        <td>'.$row['role'].'</td>
                        <td>'.$row['create_date'].'</td>
                        <td>'.$row['create_by'].'</td>
                        <td>
                        <div class="btn-group btn-group-sm">                                     
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
        <div class="modal-dialog" id="FixHistory_tbody">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">กรุณาใส่ข้อมูล</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="post"  action="Code_Add_User.php">
            <div class="form-group ">
                    <label for="reg_Username">Username</label>
                    <input type="text" class="form-control form-control-sm" id="reg_username" placeholder="Username" name="reg_username" required>
                </div>

                <div class="form-group ">
                    <label for="reg_Password">Password</label>
                    <input type="password" class="form-control form-control-sm" id="reg_password" placeholder="Password" name="reg_password" required>
                </div>
            
                
                <div class="form-group ">
                    <label for="reg_realname">ชื่อ</label>
                    <input type="text" class="form-control form-control-sm" id="reg_realname" placeholder="ชื่อ" name="reg_realname" required>
                </div>

                <div class="form-group ">
                    <label for="reg_Surname">นามสกุล</label>
                    <input type="text" class="form-control form-control-sm" id="reg_surname" placeholder="นามสกุล" name="reg_surname" required>
                </div>

                <div class="form-group">
                  <label for="reg_Role">สิทธิการใช้งานระบบ</label>
                  <select class="custom-select custom-select-sm" id="reg_role" name="reg_role">
                    <!-- <option value="" disabled selected>Select Role</option>   -->
                    <option>User</option>
                    <option>Admin</option>
                    
                  </select>
                </div>
              
           

            </div>
            <div class="modal-footer justify-content-between">
            <input type="submit" name="btn_insert" id="btn_insert" value="บันทึกข้อมูล" class="btn btn-primary btn-block" />
            </div>
        </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- =============== Modal INSERT End ========================= -->

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
            <form action="Code_Add_User.php" method="POST">
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

<!-- Sweet Alert -->
<script src="LTE/dist/SweetAlert/sweetalert.js"></script>

<script>
  $(document).ready(function () {

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
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,     
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  
  });
</script>
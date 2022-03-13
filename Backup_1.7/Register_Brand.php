
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
      เพิ่มยี่ห้อ(Brand)
      </button>
    </div>
    <br>
       
<!-- ================ Table ========================= -->

<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="text-head-card">ข้อมูลยี่ห้อ(Brand)</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <table id="example1" class="table table-striped" style="text-align:center" id="FixHistory_tbody">
                  <thead id="FixHistory_tbody">
                      <tr>
                          
                          <th width="35%">Brand</th>
                          <th width="20%">Create Date</th>
                          <th width="20%">Create By</th>  
                          <th width="15%">Delete</th>
                      </tr>
                  </thead>
                  <tbody id="FixHistory_tbody">
                  <?php
            $select = $pdo->prepare("SELECT * FROM brand ORDER BY id DESC");
            $select->execute();
            // while($row = $select->fetch(PDO::FETCH_ASSOC)){
                foreach($select as $row){
                echo '
                    <tr>
                        <td style="display:none" class="user_id">'.$row['id'].'</td>
                        <td>'.$row['name'].'</td>
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
            <div class="modal-body" id="FixHistory_tbody">
              
              
            <form method="post"  action="Code_Add_Brand.php">
                <label>ชื่อยี่ห้อ(Brand)</label>
                <input type="text" name="brand_name" id="brand_name" class="form-control" />
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
            <form action="Code_Add_Brand.php" method="POST">
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

<script src="LTE/dist/SweetAlert/sweetalert.js"></script>


<?php
include_once('database.php');
session_start();
error_reporting(0);

if($_SESSION['username'] == '' OR $_SESSION['role'] == 'Admin'){
    header('location:login.php');
  }else{
    $role = $_SESSION['role'];
    $name = $_SESSION['realname'];
    $surname = $_SESSION['surname'];
  }
  
  
  
  include('HeaderUser.php');



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
            <h3 class="card-title" id="text-head-card">ค้นหาข้อมูล</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              
            <form action="" method="POST">
            <div class="row">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" id="text-stock-in">ชื่ออุปกรณ์</label>
                            <select class="custom-select  rounded-0" id="search_name" placeholder="" name="search_name" d>
                                <option  value=""></option>
                            
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
                    <!-- Col-4-->
                    <div class="col-md-4">

                        <div class="form-group ">
                            <label for="search_model" id="text-stock-in">ยี่ห้อ</label>

                            <select class="custom-select  rounded-0" id="search_brand"  name="search_brand" >
                                <option value=""></option>
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
                    <!-- Col-4-->
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="edit_name" id="text-stock-in">รุ่น</label>
                            <input type="text" class="form-control " id="search_model" placeholder="" name="search_model" >
                        </div>

                    </div>
                    <!-- Col-4-->
              
            </div>

            <div class="row">
                
                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="edit_name" id="text-stock-in">Serial Number</label>
                        <input type="text" class="form-control " id="search_sn" placeholder="" name="search_sn" >
                    </div>

                </div>
                <!-- Col-4-->
                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="edit_name" id="text-stock-in">Serial Group</label>
                        <input type="text" class="form-control " id="search_sn_group" placeholder="" name="search_sn_group" >
                    </div>

                </div>
                <!-- Col-4-->
                <div class="col-md-4">
                    
                <input  type="submit" name="search" id="search" value="ค้นหา" class="btn btn-success btn-block" style="margin-top:31px" />
                </div>
                <!-- Col-4-->
               
            </div>
            <!-- <div class="row">
                <div class="col-md-8">

                </div>
                <div class="col-md-4">
                <input  type="submit" name="search" id="search" value="ค้นหา" class="btn btn-success btn-block btn-sm" />
                </div>

            </div> -->
              
            </form>
          </div>
          <!-- /.card-body -->   
        </div>
        <!-- /.card -->

       
<!-- ================ Table ========================= -->

<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="text-head-card">ตารางแสดงข้อมูล</h3>

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
                         
                           
                          <th width="100px" id="text-stock-in">สถานะ</th>                     
                          <th width="100px" id="text-stock-in">ชื่ออุปกรณ์</th>
                          <th width="100px" id="text-stock-in">ยี่ห้อ</th>
                          <th width="100px" id="text-stock-in">รุ่น</th>  
                          <th width="150px" id="text-stock-in">Serial Number</th>
                          <th width="150px" id="text-stock-in">Serial Group</th>                 
                          <th width="150px" id="text-stock-in">Stock-IN Date</th>
                          <th width="150px" id="text-stock-in">Stock-IN By</th>
                          <th width="150px" id="text-stock-in">Stock-Out Date</th>
                          <th width="150px" id="text-stock-in">Stock-Out By</th>
                          <th width="250px" id="text-stock-in">โครงการ</th>
                          <th width="150px" id="text-stock-in">วันที่ส่งซ่อม</th>
                          <th width="150px" id="text-stock-in">วันที่ซ่อมเสร็จ</th>
                          <th width="200px" id="text-stock-in">อาการเสีย</th>                    
                      </tr>
                  </thead>
                  <tbody id="FixHistory_tbody">
                      <?php
                            if(isset($_POST['search'])){
                                $search_name = $_POST['search_name'];
                                $search_brand = $_POST['search_brand'];
                                $search_model = $_POST['search_model'];
                                $search_sn = $_POST['search_sn'];
                                $search_sn_group = $_POST['search_sn_group'];
                               

                                // if($search_name == ''){
                                //     $search_name = NULL;
                                // }
                                
                                $select = $pdo->prepare("SELECT * FROM stockin_insert WHERE (item_name LIKE '%$search_name%') AND (item_brand LIKE '%$search_brand%') AND (item_model LIKE '%$search_model%') AND (serial LIKE '%$search_sn%') AND (serial_group LIKE '%$search_sn_group%') ORDER BY id DESC");
                                   

                                //    $select = $pdo->prepare("SELECT * FROM stockin_insert WHERE (item_name LIKE '%$search_name%') AND (item_brand LIKE '%$search_brand%') 
                                //    AND (item_model LIKE '%$search_model%') AND (serial LIKE '%$search_sn%') AND (serial_group LIKE '%$search_sn_group%') AND (stockout_project LIKE '%$search_project%') ORDER BY id DESC");
                                      
                                $select->execute();
                                while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                    echo '
                                    <tr>
                                    <td>'.$row['status'].'</td>
                                    <td>'.$row['item_name'].'</td>
                                    <td>'.$row['item_brand'].'</td>
                                    <td>'.$row['item_model'].'</td>
                                    <td>'.$row['serial'].'</td>
                                    <td>'.$row['serial_group'].'</td>
                                    <td>'.$row['date_receive'].'</td>
                                    <td>'.$row['create_name'].'</td>
                                    <td>'.$row['stockout_date'].'</td>
                                    <td>'.$row['stockout_by'].'</td>
                                    <td>'.$row['stockout_project'].'</td>
                                    <td>'.$row['fix_date'].'</td>
                                    <td>'.$row['fix_date_return'].'</td>
                                    <td>'.$row['fix_remark'].'</td>
                                    </tr>
                                    ';
                                }
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
<!-- ============= Date Picker ============== -->
<script src="LTE/plugins/select2/js/select2.full.min.js"></script>
<script src="LTE/plugins/moment/moment.min.js"></script>
<script src="LTE/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="LTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>




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
         // =========== Sort by name ============
        var options = $('#search_name option');
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

        var options = $('#search_brand option');
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
    });
</script>




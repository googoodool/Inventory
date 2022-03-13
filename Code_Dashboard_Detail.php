<?php
include('database.php');
session_start();
$name = $_SESSION['realname'];


if(isset($_POST['delete_user'])){

    $id = $_POST['delete_id'];
    echo $id;
    $delete = $pdo->prepare("DELETE FROM stockin_insert WHERE id = '$id'");
    if($delete->execute()){
        $_SESSION['delete_status'] = 'delete_success';
        header('location:Dashboard.php');   
          
      }else{
        $_SESSION['delete_status'] = 'delete_fail';
        header('location:Dashboard.php');   
      }
}


// ============= Show Data Modal Edit ================

if(isset($_POST['check_stock_out'])){
    
  $project_ID = $_POST['item_id'];

  $result_array = [];

  $select = $pdo->prepare("SELECT * FROM stockin_insert WHERE id='$project_ID'");
  $select->execute();

      if($select->rowCount() > 0){
          
          $row = $select->fetch(PDO::FETCH_ASSOC);

          array_push($result_array, $row);
          header('Content-type: application/json');
          echo json_encode($result_array);
          
      
      }else{

          echo $return = "<p>No Record Found</p>";
      }
}


// =============  Modal Edit Stock IN ================

if(isset($_POST['check_edit'])){
    
  $project_ID = $_POST['item_id'];

  $edit_array = [];

  $select = $pdo->prepare("SELECT * FROM stockin_insert WHERE id='$project_ID'");
  $select->execute();

      if($select->rowCount() > 0){
          
          $row = $select->fetch(PDO::FETCH_ASSOC);

          array_push($edit_array, $row);
          header('Content-type: application/json');
          echo json_encode($edit_array);
          
      
      }else{

          echo $return = "<p>No Record Found</p>";
      }
}

// =============  Modal Edit Stock OUT ================


if(isset($_POST['edit_submit'])){
  $update_id            = $_POST['edit_id'];
  //$update_qty           = $_POST['update_qty'];
  $update_price         = $_POST['update_price'];
  $update_price_bath        = $_POST['update_price_bath'];
  $update_id_qtation    = $_POST['update_id_qtation'];
  $update_date          = $_POST['update_date-in'];
  $update_id_po         = $_POST['update_id_po'];
  $update_model         = $_POST['update_model'];
  $update_serial        = $_POST['update_serial'];
  $update_serial_group  = $_POST['update_serial_group'];
  $update_seller        = $_POST['update_seller'];
  $update_remark        = $_POST['update_remark'];
  
  

  $select = $pdo->prepare("UPDATE stockin_insert SET  price='$update_price', id_quotation='$update_id_qtation', 
  date_receive='$update_date', id_po='$update_id_po', item_model='$update_model',serial='$update_serial', serial_group='$update_serial_group',
  seller='$update_seller',stockin_remark='$update_remark',stockin_update_date = NOW(),stockin_update_by='$name',price_bath='$update_price_bath'  WHERE id = '$update_id'");

  if($select->execute()){
    $_SESSION['edit_update_status'] = 'edit_update_success';
    header('location:Dashboard.php');   
      
  }else{
    $_SESSION['edit_update_status'] = 'edit_update_fail';
    header('location:Dashboard.php');   
  }
}

// =============  Modal Edit Stock OUT ================


if(isset($_POST['stockout_submit'])){
  $update_id        = $_POST['update_id'];
  $project_out      = $_POST['STOUT_project'];
  $date_out         = $_POST['modal_date_stockout'];
  $stockout_remark  = $_POST['stockout_remark'];
  $projectType      = $_POST['STOUT_projectType'];
  $status           = 'Stock-OUT';



  $select = $pdo->prepare("UPDATE stockin_insert SET stockout_project = '$project_out',stockout_project_type='$projectType', stockout_date='$date_out', stockout_by='$name', status='$status', stockout_createdate = NOW(), stockout_remark='$stockout_remark'  WHERE id = '$update_id'");

  if($select->execute()){
    $_SESSION['update_status'] = 'update_success';
    header('location:dashboard.php');   
   
      
  }else{
    $_SESSION['update_status'] = 'update_fail';
    header('location:dashboard.php');   
   
  }
}


?>
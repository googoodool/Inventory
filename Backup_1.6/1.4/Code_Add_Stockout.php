<?php
include('database.php');
session_start();
$name = $_SESSION['realname'];

if(isset($_POST['delete_project'])){

    $id = $_POST['delete_id'];
    $delete = $pdo->prepare("DELETE FROM stockin_insert WHERE id = '$id'");
    if($delete->execute()){
        $_SESSION['delete_status'] = 'delete_success';
        header('location:Stock-OUT.php');   
          
      }else{
        $_SESSION['delete_status'] = 'delete_fail';
        header('location:Stock-OUT.php');   
      }
}



// ============= Show Data Modal Fix ================

if(isset($_POST['check_fix'])){
    
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


// =============  Modal Fix ================


if(isset($_POST['fix_submit'])){
    $update_id = $_POST['update_id'];   
    $date_fix = $_POST['model_date_fix'];
    $fix_remark = $_POST['fix_remark'];
    $status       = 'FIX';
    $fix_history = 'Y';

    echo $update_id;
  
    $select = $pdo->prepare("UPDATE stockin_insert SET status='$status', fix_date='$date_fix',fix_history='$fix_history',fix_remark='$fix_remark',fix_by='$name' WHERE id = '$update_id'");
  
    if($select->execute()){
      $_SESSION['update_status'] = 'update_success';
      header('location:Stock-OUT.php');   
        
    }else{
      $_SESSION['update_status'] = 'update_fail';
      header('location:Stock-OUT.php');   
    }
  }

  // ============= Show Data Modal Edit ================

if(isset($_POST['check_edit'])){
    
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


if(isset($_POST['edit_submit'])){
  $update_id                = $_POST['Stockout_update_id'];    
  $stockout_update_project  = $_POST['Stockout_project'];
  $stockout_update_remark   = $_POST['Stockout_edit_remark'];

  $select = $pdo->prepare("UPDATE stockin_insert SET stockout_project='$stockout_update_project', stockout_remark='$stockout_update_remark',edit_stockout_date=NOW() ,edit_stockout_by='$name' WHERE id = '$update_id'");

  if($select->execute()){
    $_SESSION['edit_status'] = 'edit_success';
    header('location:Stock-OUT.php');   
    // echo 'Success;';
      
  }else{
    $_SESSION['edit_status'] = 'edit_fail';
    header('location:Stock-OUT.php');   
    // echo 'Failed';
  }
}

?>
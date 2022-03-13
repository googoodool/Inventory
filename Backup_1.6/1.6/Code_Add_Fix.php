<?php
include('database.php');
session_start();
$name = $_SESSION['realname'];



if(isset($_POST['fix_submit'])){
    $update_id          = $_POST['update_id'];   
    $date_fix_return    = $_POST['model_date_fix'];
    $return_remark      = $_POST['return_remark'];
    $status             = 'Stock-IN';
  
  
    $select = $pdo->prepare("UPDATE stockin_insert SET status='$status', fix_date_return='$date_fix_return',fix_return_by='$name',return_remark='$return_remark' WHERE id = '$update_id'");
  
    if($select->execute()){
      $_SESSION['update_status'] = 'update_success';
      header('location:FixItem.php');   
        
    }else{
      $_SESSION['update_status'] = 'update_fail';
      header('location:FixItem.php');   
    }
  }

  // ============= Broken Item ================
if(isset($_POST['broken_item'])){

  $id = $_POST['broken_id'];
  $update_broken = $pdo->prepare("UPDATE stockin_insert SET status='Broken' WHERE id = '$id'");
  if($update_broken->execute()){
    $_SESSION['broken_status'] = 'broken_status_success';
    header('location:FixItem.php'); 

  }else{
    $_SESSION['broken_status'] = 'broken_status_fail';
    header('location:FixItem.php');   
  }

}


?>
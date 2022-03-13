<?php
include('database.php');
session_start();

if(isset($_POST['insert'])){
    $project = $_POST['pay_project'];
    $company = $_POST['pay_name_company'];
    $person = $_POST['pay_name_person'];
    $detail = $_POST['pay_detail'];
    $price = $_POST['pay_price'];

    $date = $_POST['pay_date'];
    $quo = $_POST['pay_quo'];
    $po = $_POST['pay_po'];
    $remark = $_POST['pay_remark'];

    
    
    $insert = $pdo->prepare("INSERT INTO payment (payment_project,payment_company,payment_person,payment_price,
    payment_detail,payment_date,payment_quo,payment_po,payment_remark)
    VALUES (:a,:b,:c,:d,:e,:f,:g,:i,:j)");
    
    $insert->bindParam(':a', $project);
    $insert->bindParam(':b', $company); 
    $insert->bindParam(':c', $person); 
    $insert->bindParam(':d', $price); 
    $insert->bindParam(':e', $detail); 
    $insert->bindParam(':f', $date); 
    $insert->bindParam(':g', $quo);            
    $insert->bindParam(':i', $po); 
    $insert->bindParam(':j', $remark); 
    // $insert->execute();
    
    if($insert->execute()){
        $_SESSION['insert_status'] = 'success';
        header('location:payment.php');   
      
      }else{
        $_SESSION['insert_status'] = 'fail';
        header('location:payment.php');         
          
      }
   
}

if(isset($_POST['delete_project'])){

  $id = $_POST['delete_id'];
  $delete = $pdo->prepare("DELETE FROM payment WHERE payment_id = '$id'");
  if($delete->execute()){
      $_SESSION['delete_status'] = 'delete_success';
      header('location:payment.php');   
        
    }else{
      $_SESSION['delete_status'] = 'delete_fail';
      header('location:payment.php');   
    }
}

//========== Show value in edit model =============
if(isset($_POST['check_edit'])){
    
  $project_ID = $_POST['item_id'];

  $edit_array = [];

  $select = $pdo->prepare("SELECT * FROM payment WHERE payment_id='$project_ID'");
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

//========== Submit value in edit model =============

if(isset($_POST['edit_submit'])){
  $update_id            = $_POST['edit_id'];
  //$update_qty           = $_POST['update_qty'];
 
  $update_detail        = $_POST['update_detail'];
  $update_quo           = $_POST['update_quo'];
  $update_company          = $_POST['update_company'];
  $update_price         = $_POST['update_price'];
  $update_po         = $_POST['update_po'];
  $update_person        = $_POST['update_person'];
  $update_date  = $_POST['update_date-in'];
  
  $update_remark        = $_POST['update_remark'];
  
  

  // $select = $pdo->prepare("UPDATE payment SET  payment_detail='$update_detail'  WHERE payment_id = '$update_id'");

$select = $pdo->prepare("UPDATE payment SET  payment_detail='$update_detail', payment_quo='$update_quo', 
payment_company='$update_company', payment_price='$update_price', payment_po='$update_po',payment_person='$update_person', payment_date='$update_date',
payment_remark='$update_remark'  WHERE payment_id = '$update_id'");

  if($select->execute()){
    $_SESSION['edit_update_status'] = 'edit_update_success';
    header('location:Payment.php');   
      
  }else{
    $_SESSION['edit_update_status'] = 'edit_update_fail';
    header('location:Payment.php');   
  }
}




?>
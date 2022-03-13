<?php
include('database.php');
session_start();
$name = $_SESSION['realname'];


if(isset($_POST['insert'])){
    $sellername = $_POST['seller_name'];
   
    
    if(isset($_POST['seller_name'])){
        $select = $pdo->prepare("SELECT seller_name FROM seller WHERE seller_name='$sellername'");
        $select->execute();

        if($select->rowCount() > 0){
            $_SESSION['status'] = 'same';
          header('location:Register_Seller.php');   
        }else{
            $insert = $pdo->prepare("INSERT INTO seller (seller_name,create_by)
            VALUES (:naby,:crby)");
        
            $insert->bindParam(':naby', $sellername);
            $insert->bindParam(':crby', $name); 
            

            if($insert->execute()){
                $_SESSION['insert_status'] = 'success';
                header('location:Register_seller.php');   
               
                  
              }else{
                $_SESSION['insert_status'] = 'fail';
                header('location:Register_seller.php');   
                
              }
            
        }
    }
}


if(isset($_POST['delete_user'])){

    $id = $_POST['delete_id'];
    echo $id;
    $delete = $pdo->prepare("DELETE FROM seller WHERE id = '$id'");
    if($delete->execute()){
        $_SESSION['delete_status'] = 'delete_success';
        header('location:Register_Seller.php');   
          
      }else{
        $_SESSION['delete_status'] = 'delete_fail';
        header('location:Register_Seller.php');   
      }
}

?>
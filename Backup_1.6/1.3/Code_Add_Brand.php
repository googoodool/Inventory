<?php
include('database.php');
session_start();
$name = $_SESSION['realname'];


if(isset($_POST['insert'])){
    $brandname = $_POST['brand_name'];
   
    
    if(isset($_POST['brand_name'])){
        $select = $pdo->prepare("SELECT name FROM brand WHERE name='$brandname'");
        $select->execute();

        if($select->rowCount() > 0){
            $_SESSION['status'] = 'same';
          header('location:Register_Brand.php');   
        }else{
            $insert = $pdo->prepare("INSERT INTO brand (name,create_by)
            VALUES (:naby,:crby)");
        
            $insert->bindParam(':naby', $brandname);
            $insert->bindParam(':crby', $name); 
            

            if($insert->execute()){
                $_SESSION['insert_status'] = 'success';
                header('location:Register_Brand.php');   
               
                  
              }else{
                $_SESSION['insert_status'] = 'fail';
                header('location:Register_Brand.php');   
                
              }
            
        }
    }
}


if(isset($_POST['delete_user'])){

    $id = $_POST['delete_id'];
    echo $id;
    $delete = $pdo->prepare("DELETE FROM brand WHERE id = '$id'");
    if($delete->execute()){
        $_SESSION['delete_status'] = 'delete_success';
        header('location:Register_Brand.php');   
          
      }else{
        $_SESSION['delete_status'] = 'delete_fail';
        header('location:Register_Brand.php');   
      }
}

?>
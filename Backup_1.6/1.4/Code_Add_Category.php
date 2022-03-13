<?php
include('database.php');
session_start();
$name = $_SESSION['realname'];


if(isset($_POST['insert'])){
    $cat_name = $_POST['category_name'];
   
    
    if(isset($_POST['category_name'])){
        $select = $pdo->prepare("SELECT cat_name FROM category WHERE cat_name='$cat_name'");
        $select->execute();

        if($select->rowCount() > 0){
            $_SESSION['status'] = 'same';
          header('location:Register_Category.php');   
        }else{
            $insert = $pdo->prepare("INSERT INTO category (cat_name,cat_create_by)
            VALUES (:naby,:crby)");
        
            $insert->bindParam(':naby', $cat_name);
            $insert->bindParam(':crby', $name); 
            

            if($insert->execute()){
                $_SESSION['status'] = 'success';
                header('location:Register_Category.php');   
               
                  
              }else{
                $_SESSION['status'] = 'fail';
                header('location:Register_Category.php');   
                
              }
            
        }
    }
}


if(isset($_POST['delete_user'])){

    $id = $_POST['delete_id'];
    echo $id;
    $delete = $pdo->prepare("DELETE FROM category WHERE id = '$id'");
    if($delete->execute()){
        $_SESSION['delete_status'] = 'delete_success';
        header('location:Register_Category.php');   
          
      }else{
        $_SESSION['delete_status'] = 'delete_fail';
        header('location:Register_Category.php');   
      }
}

?>
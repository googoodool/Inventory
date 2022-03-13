<?php
include('database.php');
session_start();
$name = $_SESSION['realname'];


if(isset($_POST['btn_insert'])){
    $username = $_POST['reg_username'];
    $password = $_POST['reg_password'];
    $realname = $_POST['reg_realname'];
    $surname = $_POST['reg_surname'];
    $role = $_POST['reg_role'];
   
    
    if(isset($_POST['reg_username'])){
        $select = $pdo->prepare("SELECT username FROM user WHERE username='$username'");
        $select->execute();

        if($select->rowCount() > 0){
            $_SESSION['status'] = 'same';
          header('location:Register_user.php');   
        }else{
            $insert = $pdo->prepare("INSERT INTO user (username,password,role,realname,surname,create_by)
            VALUES (:user, :pass, :role, :real, :sur, :crby)");
        
            $insert->bindParam(':user', $username);
            $insert->bindParam(':pass', $password);
            $insert->bindParam(':role', $role);
            $insert->bindParam(':real', $realname);
            $insert->bindParam(':sur', $surname); 
            $insert->bindParam(':crby', $name); 

            if($insert->execute()){
                $_SESSION['insert_status'] = 'success';
                header('location:Register_user.php');   
               
                  
              }else{
                $_SESSION['insert_status'] = 'fail';
                header('location:Register_user.php');   
                
              }
            
        }
    }
}


if(isset($_POST['delete_user'])){

    $id = $_POST['delete_id'];
    echo $id;
    $delete = $pdo->prepare("DELETE FROM user WHERE id = '$id'");
    if($delete->execute()){
        $_SESSION['delete_status'] = 'delete_success';
        header('location:Register_user.php');   
          
      }else{
        $_SESSION['delete_status'] = 'delete_fail';
        header('location:Register_user.php');   
      }
}

?>
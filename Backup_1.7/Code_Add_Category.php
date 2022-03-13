<?php
include('database.php');
session_start();
$name = $_SESSION['realname'];


if(isset($_POST['insert'])){
    $cat_name = $_POST['category_name'];

    // Check data ซ้ำ
    if(isset($_POST['category_name'])){
      $select = $pdo->prepare("SELECT cat_name FROM category WHERE cat_name='$cat_name'");
      $select->execute();
      if($select->rowCount() > 0){
                $_SESSION['status'] = 'same';
              header('location:Register_Category.php');   
      }else{
        // Save image to folder
        $image_file = $_FILES['cat_img']["name"];

        if($image_file != null){
          $image_file = $_FILES['cat_img']["name"];
          $path       = "Picture/".$image_file;
          $type       = $_FILES['cat_img']["type"];
          $size       = $_FILES['cat_img']["size"];
          $temp       = $_FILES['cat_img']["tmp_name"];
    
          if($type =="image/jpg" || $type == "image/jpeg" || $type == "image/png"){
    
            if($size < 2000000){
              move_uploaded_file($temp,$path);

              $insert = $pdo->prepare("INSERT INTO category (cat_name,cat_image,cat_create_by)
              VALUES (:naby,:cimg,:crby)");
                  
                      $insert->bindParam(':naby', $cat_name);
                      $insert->bindParam(':cimg', $image_file);
                      $insert->bindParam(':crby', $name); 
              
                      if($insert->execute()){
                        $_SESSION['status'] = 'success';
                        header('location:Register_Category.php');   
   
                      }else{
                        $_SESSION['status'] = 'fail';
                        header('location:Register_Category.php');   
                        
                      }    
            }else{
              $_SESSION['image_status'] = 'sizeImageError';
              header('location:Register_Category.php');
            }
          }else{
            $_SESSION['image_status'] = 'typeImageError';
            header('location:Register_Category.php');
          }


        }else{
          
          if(isset($_POST['category_name'])){
            $select = $pdo->prepare("SELECT cat_name FROM category WHERE cat_name='$cat_name'");
            $select->execute();
    
            if($select->rowCount() > 0){
                $_SESSION['status'] = 'same';
              header('location:Register_Category.php');   
            }else{
                $image_file = 'no-image.png';
                $insert = $pdo->prepare("INSERT INTO category (cat_name,cat_image,cat_create_by)
                VALUES (:naby,:cimg,:crby)");
            
                $insert->bindParam(':naby', $cat_name);
                $insert->bindParam(':cimg', $image_file);
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

// =============  Modal Edit Stock IN ================

if(isset($_POST['check_edit'])){
    
  $cat_ID = $_POST['item_id'];

  $edit_array = [];

  $select = $pdo->prepare("SELECT * FROM category WHERE id='$cat_ID'");
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

if(isset($_POST['edit_modal_submit'])){
  $update_name  = $_POST['category_name_edit'];
  $update_id    = $_POST['edit_id'];
  $image_file = $_FILES['cat_img']["name"];

  if($image_file != null){
    
    $path       = "Picture/".$image_file;
    $type       = $_FILES['cat_img']["type"];
    $size       = $_FILES['cat_img']["size"];
    $temp       = $_FILES['cat_img']["tmp_name"];

    if($type =="image/jpg" || $type == "image/jpeg" || $type == "image/png"){

      if($size < 2000000){
        move_uploaded_file($temp,$path);
        $select = $pdo->prepare("UPDATE category SET cat_name = '$update_name', cat_image='$image_file' WHERE id = '$update_id'");
        if($select->execute()){
          $_SESSION['update_status'] = 'update_success';
          header('location:Register_Category.php');   
            
        }else{
          $_SESSION['update_status'] = 'update_fail';
          header('location:Register_Category.php');   
        }
      
      }else{
        $_SESSION['image_status'] = 'sizeImageError';
        header('location:Register_Category.php');
      }
    }else{
      $_SESSION['image_status'] = 'typeImageError';
      header('location:Register_Category.php');
    }
  }else{

    $select = $pdo->prepare("UPDATE category SET cat_name = '$update_name' WHERE id = '$update_id'");

    if($select->execute()){
        $_SESSION['update_status'] = 'update_success';
        header('location:Register_Category.php');   
          
      }else{
        $_SESSION['update_status'] = 'update_fail';
        header('location:Register_Category.php');   
      }



  }

 
}


?>
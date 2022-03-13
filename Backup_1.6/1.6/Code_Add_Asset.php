<?php
include('database.php');
session_start();
$name = $_SESSION['realname'];



if(isset($_POST['insert'])){

    $asset_name     = $_POST['asset_name'];
    $brand          = $_POST['asset_brand'];
    $model          = $_POST['asset_model'];
    $qty            = $_POST['asset_qty'];
    $serial         = $_POST['asset_sn'];
    $price          = $_POST['asset_price'];
    $image_file     = $_FILES['asset_image']["name"];
    $date_buy       = $_POST['asset_date_buy'];
    $seller         = $_POST['asset_seller'];
    $id_quotation   = $_POST['asset_id_qtation'];
    $id_po          = $_POST['asset_id_po'];
    $create_remark  = $_POST['asset_create_remark'];


    if($image_file != null){
        $path       = "Asset_image/".$image_file;
        $type       = $_FILES['asset_image']["type"];
        $size       = $_FILES['asset_image']["size"];
        $temp       = $_FILES['asset_image']["tmp_name"];

        if($type =="image/jpg" || $type == "image/jpeg" || $type == "image/png"){
            
            if($size < 2000000){
                move_uploaded_file($temp,$path);

                $insert = $pdo->prepare("INSERT INTO asset (name,brand,model,qty,serial,price,image,
                date_buy,seller,id_quotation,id_po,create_remark,create_by) 
                VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m)");
            
                $insert->bindParam(':a', $asset_name);
                $insert->bindParam(':b', $brand);
                $insert->bindParam(':c', $model);
                $insert->bindParam(':d', $qty);
                $insert->bindParam(':e', $serial);
                $insert->bindParam(':f', $price);
                $insert->bindParam(':g', $image_file);
                $insert->bindParam(':h', $date_buy);
                $insert->bindParam(':i', $seller);
                $insert->bindParam(':j', $id_quotation);
                $insert->bindParam(':k', $id_po);
                $insert->bindParam(':l', $create_remark);
                $insert->bindParam(':m', $name);
                   
                if($insert->execute()){
                    $_SESSION['insert_status'] = 'success';
                    header('location:asset.php');   
                  }else{
                    $_SESSION['insert_status'] = 'fail';
                    header('location:asset.php');      
                  }
            }else{
                $_SESSION['image_status'] = 'sizeImageError';
                header('location:Asset.php');
            }

        }else{
            $_SESSION['image_status'] = 'typeImageError';
            header('location:Asset.php');
        }

    }else{
        $image_file = 'no-image.png';
       
        $insert = $pdo->prepare("INSERT INTO asset (name,brand,model,qty,serial,price,image,
        date_buy,seller,id_quotation,id_po,create_remark,create_by) 
        VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m)");

        $insert->bindParam(':a', $asset_name);
        $insert->bindParam(':b', $brand);
        $insert->bindParam(':c', $model);
        $insert->bindParam(':d', $qty);
        $insert->bindParam(':e', $serial);
        $insert->bindParam(':f', $price);
        $insert->bindParam(':g', $image_file);
        $insert->bindParam(':h', $date_buy);
        $insert->bindParam(':i', $seller);
        $insert->bindParam(':j', $id_quotation);
        $insert->bindParam(':k', $id_po);
        $insert->bindParam(':l', $create_remark);
        $insert->bindParam(':m', $name);
        
            if($insert->execute()){
            $_SESSION['insert_status'] = 'success';
            header('location:asset.php');   
            }else{
                $_SESSION['insert_status'] = 'fail';
                header('location:asset.php');      
        
        }
    }
}


// ============== Delete ==============
if(isset($_POST['delete_asset'])){

    $id = $_POST['delete_id'];
    echo $id;
    $delete = $pdo->prepare("DELETE FROM asset WHERE id = '$id'");
    if($delete->execute()){
        $_SESSION['delete_status'] = 'delete_success';
        header('location:Asset.php');   
          
      }else{
        $_SESSION['delete_status'] = 'delete_fail';
        header('location:Asset.php');   
      }
}

// ============== View Edit ==============
if(isset($_POST['check_edit'])){
    
    $project_ID = $_POST['item_id'];
  
    $edit_array = [];
  
    $select = $pdo->prepare("SELECT * FROM asset WHERE id='$project_ID'");
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


  
if(isset($_POST['edit_submit'])){

    $image_file     = $_FILES['update_image']["name"];
    $update_id            = $_POST['edit_id'];
    $update_name          = $_POST['update_name'];
    $update_model         = $_POST['update_model'];
    $update_qty           = $_POST['update_qty'];
    $update_brand         = $_POST['update_brand'];
    $update_serial        = $_POST['update_serial'];
    $update_price         = $_POST['update_price'];
    $update_id_qtation    = $_POST['update_id_qtation'];
    $update_date          = $_POST['update_date-in'];
    $update_id_po         = $_POST['update_id_po'];
    $update_seller        = $_POST['update_seller'];
    $update_remark        = $_POST['update_remark'];
   

    if($image_file == null){
       
        $select = $pdo->prepare("UPDATE asset SET name='$update_name', brand='$update_brand', model='$update_model', qty='$update_qty', serial='$update_serial',
        price='$update_price', id_quotation='$update_id_qtation',date_buy='$update_date',id_po='$update_id_po',seller='$update_seller',update_remark='$update_remark',
        update_date= NOW(), update_by='$name' WHERE id = '$update_id'");
    
        if($select->execute()){
          $_SESSION['edit_update_status'] = 'edit_update_success';
          header('location:Asset.php');   
        // echo 'Success';
            
        }else{
          $_SESSION['edit_update_status'] = 'edit_update_fail';
          header('location:Asset.php');   
        // echo 'Failed';
        }

    }else{
        
        $type           = $_FILES['update_image']["type"];
        $size           = $_FILES['update_image']["size"];
        $temp           = $_FILES['update_image']["tmp_name"];
        $path       = "Asset_image/".$image_file;

        if($type =="image/jpg" || $type == "image/jpeg" || $type == "image/png"){
        
            if($size < 2000000){
                move_uploaded_file($temp,$path);

                $select = $pdo->prepare("UPDATE asset SET name='$update_name', brand='$update_brand', model='$update_model', qty='$update_qty', serial='$update_serial',
                price='$update_price', id_quotation='$update_id_qtation',date_buy='$update_date',id_po='$update_id_po',seller='$update_seller',update_remark='$update_remark',
                update_date= NOW(), update_by='$name', image='$image_file' WHERE id = '$update_id'");
    
                if($select->execute()){
                    $_SESSION['edit_update_status'] = 'edit_update_success';
                    header('location:Asset.php');   
                // echo 'Success';
                    
                }else{
                    $_SESSION['edit_update_status'] = 'edit_update_fail';
                    header('location:Asset.php');   
                // echo 'Failed';
                }
       
            }else{
                $_SESSION['image_status'] = 'sizeImageError';
                header('location:Asset.php');
            }
        
        }else{
            $_SESSION['image_status'] = 'typeImageError';
            header('location:Asset.php');
        }

    }
   
  }

?>
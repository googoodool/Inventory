<?php
include('database.php');
session_start();
$name = $_SESSION['realname'];

if(isset($_POST['insert'])){
    $pro_name = $_POST['pro_name'];
    
    if(isset($_POST['pro_name'])){
        $select = $pdo->prepare("SELECT name FROM station_type WHERE name='$pro_name'");
        $select->execute();

        if($select->rowCount() > 0){
            $_SESSION['status'] = 'same';
          header('location:Register_projectType.php');   
        }else{
            $insert = $pdo->prepare("INSERT INTO station_type (name,create_by)
            VALUES (:station,:createby)");
        
            $insert->bindParam(':station', $pro_name);   
            $insert->bindParam(':createby', $name);
            if($insert->execute()){
                $_SESSION['status'] = 'success';
                header('location:Register_projectType.php');   
                  
              }else{
                $_SESSION['status'] = 'fail';
                header('location:Register_projectType.php');   
              }
            
        }
    }
}

if(isset($_POST['check_view'])){
    
    $project_ID = $_POST['project_id'];
    $select = $pdo->prepare("SELECT * FROM station WHERE id='$project_ID'");
    $select->execute();

        if($select->rowCount() > 0){
            
            $row = $select->fetch(PDO::FETCH_ASSOC);
            echo $return = '
            <p>ID : '.$row['id'].'</p>
            <p>ID : '.$row['station_name'].'</p>
            <p>ID : '.$row['create_by'].'</p>
            <p>ID : '.$row['create_date'].'</p>
            
            
            ';
        
        }else{

            echo $return = "<p>No Record Found</p>";
        }
}

if(isset($_POST['check_edit'])){
    
    $project_ID = $_POST['project_id'];

    $edit_array = [];

    $select = $pdo->prepare("SELECT * FROM station WHERE id='$project_ID'");
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

if(isset($_POST['update'])){
    $update_name = $_POST['edit_name'];
    $update_id = $_POST['update_id'];
    $select = $pdo->prepare("UPDATE station SET station_name = '$update_name', create_by='$name' WHERE id = '$update_id'");

    if($select->execute()){
        $_SESSION['update_status'] = 'update_success';
        header('location:Register_project.php');   
          
      }else{
        $_SESSION['update_status'] = 'update_fail';
        header('location:Register_project.php');   
      }
}

if(isset($_POST['delete_project'])){

    $id = $_POST['delete_id'];
    $delete = $pdo->prepare("DELETE FROM station_type WHERE id = '$id'");
    if($delete->execute()){
        $_SESSION['delete_status'] = 'delete_success';
        header('location:Register_projectType.php');   
          
      }else{
        $_SESSION['delete_status'] = 'delete_fail';
        header('location:Register_projectType.php');   
      }
}

?>


<?php
include('database.php');
session_start();

$select = $pdo->prepare("SELECT serial_gen FROM stockin_insert ORDER BY id DESC LIMIT 1");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

if($row['serial_gen'] != null){
    $dataSerial = $row['serial_gen'];
    $myArray    = explode('-',$dataSerial);
    $number =  (int)$myArray[4];
    $number = $number+1;

    //echo date("Y-m-d");
    $lastDate = $myArray[1].'-'.$myArray[2].'-'.$myArray[3];
    if($lastDate == date("Y-m-d")){
         echo 'PAT-'.date("Y-m-d").'-'.$number;
    }else{
        $n = 1;
        echo 'PAT-'.date("Y-m-d").'-'.$n;
    }
 
}else{
    $n = 1;
    echo 'PAT-'.date("Y-m-d").'-'.$n;
}

?>
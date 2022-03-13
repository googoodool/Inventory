<?php

try{
    $pdo = new
    PDO('mysql:host=localhost;dbname=inv_db','root','p@ssw0rd');
    // echo 'Connection Success';
}catch(PDOException $f){
    echo $f->getMessage();
}




?>
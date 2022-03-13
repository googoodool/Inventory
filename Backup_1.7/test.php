<?php
session_start();
error_reporting(0);
if(isset($_POST['insert'])){
   $stockin_remark = implode(', ', $_POST['stockin_remark']);
    echo $stockin_remark;
}


?>
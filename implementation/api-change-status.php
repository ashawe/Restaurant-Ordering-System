<?php

    require 'db/db-connect.php';

    if( isset($_POST['order_id']) && isset($_POST['new_status'])) {
        // var_dump($_POST);
        $sql = "UPDATE `orders` SET order_status = ? WHERE order_id = ?";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,'si',$_POST['new_status'],$_POST['order_id']);
        $result = mysqli_stmt_execute($stmt);
        if($result)
            echo "1";
        else
            echo "Error";
    }
    else {
        echo "INVALID REQUEST";
    }

?>
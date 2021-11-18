<?php

// assumes db connection
// require 'validator.php';

function addChef($email) {
    
    Global $conn;


    // if email is valid
    if( filter_var($email, FILTER_VALIDATE_EMAIL) )
    {
        // generate a random password
        $pwd = substr(str_shuffle(MD5(microtime())), 0, 15);

        // generate password hash using the random pwd
        $hash = password_hash($pwd,PASSWORD_DEFAULT);

        // store it in DB
        $sql = "INSERT INTO `users` VALUES('" . $email . "','" . $hash . "','CHEF',true);";
        
        if (mysqli_query($conn, $sql)) {
            writeC("New record created successfully");                    
            return $pwd;
        } else {
            writeC("Error: " . mysqli_error($conn));
            // @ToDo : Make a log table entry
            return NULL;
        }        
    }
}

    function getChefs() {
    Global $conn;

    $sql = "SELECT email_id FROM users WHERE role='CHEF'";
    
    $userStatement = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($userStatement);
    $chefInfo = mysqli_stmt_get_result($userStatement);

    if(mysqli_num_rows($chefInfo) == 0)
        $chefInfo = NULL;
    else
        return $chefInfo;
}

function removeChefAccount($email_id) {
    Global $conn;

    $sql = "DELETE FROM `users` WHERE `users`.`email_id` = ?";

    $userStatement = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($userStatement,"s",$email_id);
    $ret = mysqli_stmt_execute($userStatement);
    return $ret;
}

function deleteSuggestion($order_id) {
    Global $conn;

    $sql = "UPDATE `orders` SET suggestion = NULL WHERE order_id = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$order_id);
    $result = mysqli_stmt_execute($stmt);
    return $result;
}

function deleteRating($rating_id) {
    Global $conn;

    $sql = "DELETE FROM `ratings` WHERE rating_id = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$rating_id);
    $result = mysqli_stmt_execute($stmt);
    return $result;
}

?>
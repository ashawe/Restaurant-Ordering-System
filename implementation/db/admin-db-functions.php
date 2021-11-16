<?php

// require 'db-connect.php';
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

?>
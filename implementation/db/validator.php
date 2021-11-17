<?php

    function validatePassword($password) {
        $passwordErr = "";
        if(!empty($password)) {
            $password = test_input($password);
            if (strlen($password) <= '8') {
                $passwordErr = "Your Password Must Contain At Least 8 Characters!";
            }
            else if(!preg_match("#[0-9]+#",$password)) {
                $passwordErr = "Your Password Must Contain At Least 1 Number!";
            }
            else if(!preg_match("#[A-Z]+#",$password)) {
                $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
            }
            else if(!preg_match("#[a-z]+#",$password)) {
                $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
            }
            else {
                $passwordErr = true;
            }
        }
        else {
             $passwordErr = "Please Enter password.";
        }
        return $passwordErr;
    }

    /*Each $_POST variable with be checked by the function*/
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
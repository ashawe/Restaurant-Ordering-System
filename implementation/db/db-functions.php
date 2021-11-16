<?php

// assumes db connection

function getFood() {
    Global $conn;

    $sql = "SELECT * FROM `food`";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      return $result;
    } else {
        return NULL;
    }
}

function checkLogin($email, $password) {

    Global $conn;

    // sanitize
    $email = mysqli_real_escape_string($conn,$email);
    $password = mysqli_real_escape_string($conn,$password);

    // prepared statement
    $sql = "SELECT password, role, first_login FROM users WHERE email_id=?";
    $userStatement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($userStatement, 's',$email);
    mysqli_stmt_execute($userStatement);
    $result = mysqli_stmt_get_result($userStatement);
    $getData = mysqli_fetch_assoc($result);
    
    // check username and password
    if(!isset($getData['password']) || !password_verify($password,$getData['password']))
    {
        // wrong username or password
        return NULL;
    }

    return [$getData['role'],$getData['first_login']];
}

?>
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

function checkout($food_ids,$phone_number,$table_number) {

    GLobal $conn;

    // sanitize
    $phone_number = mysqli_real_escape_string($conn,$phone_number);
    $table_number = mysqli_real_escape_string($conn,$table_number);

    mysqli_begin_transaction($conn);
    try{

        $sql = "INSERT INTO orders(order_status,phone_number,table_number) VALUES('NEW',?,?)";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,'ii',$phone_number,$table_number);
        $result = mysqli_stmt_execute($stmt);
    
        // if successful
        if($result) {
            writeC('inserted into orders');
            // fetch the latest order id that was generated to put into order_mapping table.
            $sql1 = "SELECT order_id from orders WHERE table_number = ? AND phone_number = ? ORDER BY time DESC";
            $userStatement = mysqli_prepare($conn, $sql1);
            mysqli_stmt_bind_param($userStatement, 'ii',$table_number,$phone_number);
            mysqli_stmt_execute($userStatement);
            $result = mysqli_stmt_get_result($userStatement);
            $getData = mysqli_fetch_assoc($result);
            $order_id = $getData['order_id'];
            writeC('orderid=' . $order_id);
    
            foreach($food_ids as $fid) {
                writeC('inserting into order_mapping with id:' . $fid);
                $sql2 = "INSERT INTO order_mapping(order_id,food_id) VALUES(?,?)";
                $stmt2 = mysqli_prepare($conn,$sql2);
                mysqli_stmt_bind_param($stmt2,'ii',$order_id,$fid);
                $result1 = mysqli_stmt_execute($stmt2);
                // writeC('result' . var_dump($result1));
                if(!$result1)
                {
                    // @ToDo log
                    writeC(mysqli_error($conn));
                    mysqli_rollback($conn);
                    return NULL;
                }
            }
            mysqli_commit($conn);
            writeC("returning");
            return $order_id;
        }
        else {
            writeC("in else");
            mysqli_rollback($conn);
            return NULL;
            // @ToDo: log
        }
    }
    catch(Exception $e) {
        mysqli_rollback($conn);
        writeC("in catch");
        // @ToDo: log
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
        // @ToDo : Log?
        // wrong username or password
        return NULL;
    }

    return [$getData['role'],$getData['first_login']];
}

?>
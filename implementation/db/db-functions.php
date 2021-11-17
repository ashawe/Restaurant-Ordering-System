<?php

// assumes db connection

function getOrder($order_id) {
    Global $conn;

    $sql = "SELECT order_mapping.food_id,name,price,quantity,orders.order_status FROM order_mapping,food, orders WHERE order_mapping.food_id = food.food_id and orders.order_id = orders.order_id and order_mapping.order_id = ?";
    $userStatement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($userStatement, 'i',$order_id);
    mysqli_stmt_execute($userStatement);
    $result = mysqli_stmt_get_result($userStatement);
    return $result;
}

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

function checkout($food_ids,$phone_number,$table_number,$qtys) {

    GLobal $conn;

    // sanitize
    $phone_number = mysqli_real_escape_string($conn,$phone_number);
    $table_number = mysqli_real_escape_string($conn,$table_number);

    mysqli_begin_transaction($conn);
    try{

        $sql = "INSERT INTO orders(order_status,phone_number,table_number) VALUES('PLACED',?,?)";
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
    
            for($i = 0; $i < count($food_ids); $i++)
            {
                $fid = $food_ids[$i];
                $qty = $qtys[$i];
                writeC('inserting into order_mapping with id:' . $fid);
                $sql2 = "INSERT INTO order_mapping(order_id,food_id,quantity) VALUES(?,?,?)";
                $stmt2 = mysqli_prepare($conn,$sql2);
                mysqli_stmt_bind_param($stmt2,'iii',$order_id,$fid,$qty);
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

function changePassword($email, $password) {
    Global $conn;

    // sanitize
    $email = mysqli_real_escape_string($conn,$email);
    // breaks if escaped string
    // $password = mysqli_real_escape_string($conn,$password);

    $enc_password = password_hash($password,PASSWORD_DEFAULT);

    $sql = "UPDATE `users` SET password = ?, first_login = false WHERE email_id = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'ss',$enc_password,$email);
    $result = mysqli_stmt_execute($stmt);
    return $result;
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

    // var_dump($getData);
    // writeC("email:" . $email);
    // writeC("pwd: " . $password);  
    // check username and password
    if(isset($getData['password']))
    {
        // writeC("HERE");
        // writeC("pwd=> " . $password);
        // writeC("pwd harsh=> " . password_hash($password,PASSWORD_DEFAULT));
        // writeC("get password: " . $getData['password']);
        if(password_verify($password,$getData['password']))
        {
            // writeC("HERE2");
            return [$getData['role'],$getData['first_login']];
        }
    }
    // @ToDo : Log?
    // wrong username or password
    return NULL;
}

?>
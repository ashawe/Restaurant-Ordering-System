<?php

// assumes db connection

function getOrder($order_id,$table_number) {
    Global $conn;

    $sql = "SELECT order_mapping.food_id,name,price,quantity,orders.order_status, photo FROM order_mapping,food, orders WHERE order_mapping.food_id = food.food_id and orders.order_id = orders.order_id and order_mapping.order_id = ? and orders.table_number = ?";
    $userStatement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($userStatement, 'ii',$order_id, $table_number);
    mysqli_stmt_execute($userStatement);
    $result = mysqli_stmt_get_result($userStatement);
    return $result;
}

function viewOrders() {
    Global $conn;

    $sql = "select mapping_id,orders.order_id,order_status,table_number,food.name,order_mapping.quantity from order_mapping,orders,food where order_mapping.order_id = orders.order_id and food.food_id = order_mapping.food_id and orders.order_status = 'PLACED' ORDER BY orders.order_id";
    $userStatement = mysqli_prepare($conn, $sql);
    // mysqli_stmt_bind_param($userStatement, 'ii',$order_id, $table_number);
    mysqli_stmt_execute($userStatement);
    $resultPlaced = mysqli_stmt_get_result($userStatement);

    if(mysqli_num_rows($resultPlaced) == 0)
        $resultPlaced = NULL;
    
    $sql1 = "select mapping_id,orders.order_id,order_status,table_number,food.name,order_mapping.quantity from order_mapping,orders,food where order_mapping.order_id = orders.order_id and food.food_id = order_mapping.food_id and orders.order_status = 'ACCEPTED' ORDER BY orders.order_id";
    $userStatement1 = mysqli_prepare($conn, $sql1);
    // mysqli_stmt_bind_param($userStatement1, 'ii',$order_id, $table_number);
    mysqli_stmt_execute($userStatement1);
    $resultAccepted = mysqli_stmt_get_result($userStatement1);

    if(mysqli_num_rows($resultAccepted) == 0)
        $resultAccepted = NULL;

    $sql2 = "select mapping_id,orders.order_id,order_status,table_number,food.name,order_mapping.quantity from order_mapping,orders,food where order_mapping.order_id = orders.order_id and food.food_id = order_mapping.food_id and orders.order_status = 'PREPARING' ORDER BY orders.order_id";
    $userStatement2 = mysqli_prepare($conn, $sql2);
    // mysqli_stmt_bind_param($userStatement2, 'ii',$order_id, $table_number);
    mysqli_stmt_execute($userStatement2);
    $resultPreparing = mysqli_stmt_get_result($userStatement2);

    if(mysqli_num_rows($resultPreparing) == 0)
        $resultPreparing = NULL;

    return [$resultPlaced, $resultAccepted, $resultPreparing];
}

function getFood() {
    Global $conn;

    $sql = "SELECT food.food_id,name,price,photo,description,ROUND(AVG(rating),2) as rating FROM `food` LEFT JOIN ratings ON food.food_id = ratings.food_id GROUP BY food.food_id";
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

function addSuggestion($order_id, $suggestion) {
    Global $conn;

    $sql = "UPDATE `orders` SET suggestion = ? WHERE order_id = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'si',$suggestion,$order_id);
    $result = mysqli_stmt_execute($stmt);
    return $result;
}

function rate($food_id, $rating, $review) {
    Global $conn;

    $sql = "INSERT INTO ratings(food_id,rating,review) VALUES(?,?,?)";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'iis',$food_id,$rating,$review);
    $result = mysqli_stmt_execute($stmt);
    return $result;
}

?>
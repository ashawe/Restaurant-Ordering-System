<?php 

    // connect to db
    require 'db/db-connect.php';
    require 'db/db-functions.php';
    // echo substr(str_shuffle(MD5(microtime())), 0, 15);
    // echo password_hash("admin@1321", PASSWORD_DEFAULT); $2y$10$dNYVtiJjuJxSUHZDp.LNCuYhGEfM.Mtv2WH4g.sAJXYh5CZcjGYOy
    // Chef Mail: mew@c.com
    // Chef Password: e8156871e7bd8d4 
    echo $_SERVER['HTTP_REFERER'];

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    echo exec('whoami');

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "email_id: " . $row["email_id"]. " - password: " . $row["password"]. " role= " . $row["role"] . " fl= " . $row["first_login"] . "<br>" ;
        }
    } else {
        echo "0 results";
    }

    session_start();
    var_dump($_SESSION);
    var_dump($_COOKIE);

    writeToLog("Is this working?     ");

    $conn->close();    
?>
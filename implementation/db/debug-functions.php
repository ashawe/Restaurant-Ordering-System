<?php

// writes in developer console
function writeC($msg) {
    echo "<script>console.log('" . $msg . "');</script>";
}

function dropT($table) {
    // sql to delete a record
    $sql = "DROP TABLE " . $table;

    Global $conn;
    if ($conn->query($sql) === TRUE) {
        echo "Table Dropped";
    } else {
        echo "ERR dropping table: " . $conn->error;
    }
}

?>
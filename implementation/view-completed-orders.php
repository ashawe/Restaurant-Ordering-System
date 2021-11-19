<?php

    require 'db/db-connect.php';
    require 'db/db-functions.php';
    session_start();

    // check if login redirected the user => show toast
    if( isset($_SERVER['HTTP_REFERER']) )
    {
        $PATH_REFFERER = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
        if($PATH_REFFERER == "/ENPM809WProject-hsaglani/implementation/login.php")
            $PRINT_MSG = "Welcome Chef";
    }

    // check if user has access to this page.
    if( !isset($_SESSION['role']) || $_SESSION['role'] != "ADMIN" && $_SESSION['role'] != "CHEF")
        header('Location: login.php?prompt=please+login+to+continue');
    else if ( isset($_SESSION['reset_required']) )
        header('Location: reset-password.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Completed Orders</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/cover.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body class="d-flex h-100 bg-dark">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div class="">
                <a href="index.php"><h3 class="float-md-start mb-0 text-white">Restaurant Ordering System</h3></a>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link text-white" aria-current="page" href="view-orders.php">View Orders</a>
                    <a class="nav-link active text-white" aria-current="page" href="view-completed-orders.php">View Completed Orders</a>
                    <a class="nav-link text-white" aria-current="page" href="view-suggestions.php">View Suggestions</a>
                    <a class="nav-link text-white" aria-current="page" href="logout.php">Logout</a>
                </nav>
            </div>
        </header>

        <main class="py-3">
            <h1 class="my-5 text-white text-center">Completed Orders!</h1>
            <?php
                $completedOrders = viewCompletedOrders();
            ?>
            <div class="container">
                <div id="completed-order-container" class="row mt-5" style="gap:25px">
                    <h1 class="text-white">Completed Orders</h1>
                    <?php
                        $currentID = "";
                        // if not empty
                        if($completedOrders!=NULL)
                        {
                            $row = mysqli_fetch_assoc($completedOrders);
                            while($row)
                            {
                                $currentID = $row['order_id'];
                    ?>
                                <div class="card">
                                    <div class="card-body">
                                        <p class="muted">Table <?=$row['table_number']?></p>
                                        <div class="menu-item-container">
                                            <div class="left-part">
                                                <div class="item-description">
                                                <?php
                                                    while($currentID == $row['order_id']) 
                                                    {
                                                ?>
                                                        <p class="title"><?=$row['name']?> x <?=$row['quantity']?></p>
                                                <?php
                                                        $row = mysqli_fetch_assoc($completedOrders);
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                            <div class="right-part align-self-center">
                                                <button id="<?=$currentID?>" class="btn btn-danger w-100 btn-order-next" type="button" data-toggle="on">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </main>

        <footer class="mt-auto text-white-50" style="position: fixed;">
            <div class="toast-container">
            </div>
        </footer>
    </div>

    <script src="assets/js/main.js"></script>
</body>

</html>
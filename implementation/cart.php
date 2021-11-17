<?php

    require 'db/db-connect.php';
    require 'db/debug-functions.php';
    require 'db/db-functions.php';
    session_start();

    $is_logged_in = false;
    $err = false;

    $SUCCESS = false;

    // if table number is in not session 
    if( isset($_POST['table_number']) )
    {
        $_SESSION['table_number'] = $_POST['table_number'];
        $is_logged_in = true;
    }
    if(isset($_SESSION['table_number']))
        $is_logged_in = true;
    
    if(!$is_logged_in)
        header("Location: index.php?prompt=please provide a table number");
    
    // fetch food from db
    $foodArray = getFood();

    if( $foodArray == NULL)
    {
        $PRINT_MSG = "ERR";
        $err = true;
    }
    
    if( isset($_COOKIE['cart']) )
        $cart = json_decode(stripslashes($_COOKIE['cart']),true);

    if( isset($_POST['submit']) ) {
        if( isset($_POST['phone-number']) && is_numeric($_POST['phone-number']) && strlen((string)$_POST['phone-number']) == 10 )
        {
            if( isset($cart) )
            {
                $tempFoodArr = $foodArray;
                $foodIdsArr = array();
                while($row = mysqli_fetch_assoc($tempFoodArr))
                {
                    if(isset($cart[$row['food_id']]))
                        array_push($foodIdsArr,$row['food_id']);
                }
                // insert in db
                $order_id = checkout($foodIdsArr,$_POST['phone-number'],$_SESSION['table_number']);
                if($order_id == NULL) {
                    $SUCCESS = false;
                    $PRINT_MSG = "ERROR checking out.";
                }
                else {
                    $SUCCESS = true;
                    $PRINT_MSG = "Order Placed Successfully";
                    // delete cart cookie and add order id cookie
                    
                    if(isset($_COOKIE['cart']))
                        unset($_COOKIE['cart']); 
                    setcookie('cart', null, -1, '/');
                    setcookie('order_id',$order_id);
                }
            }
            else 
                $PRINT_MSG = "No item in cart.";
        }
        else
            $PRINT_MSG = "Invalid Phone number.";
    }
    
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/cover.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body class="d-flex bg-dark">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div class="">
                <a href="index.php"><h3 class="float-md-start mb-0 text-white">Restaurant Ordering System</h3></a>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <form method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                        <input type="search" name="q" class="form-control" placeholder="Search..." aria-label="Search">
                    </form>
                    <a class="nav-link text-white" aria-current="page" href="home.php">Order</a>
                    <a class="nav-link active text-white" aria-current="page" href="cart.php">Cart / View Order</a>
                </nav>
            </div>
        </header>

        <main class="py-3">
            <h1 class="my-5 text-white text-center">Cart</h1>
            <div class="container">
                <div class="row" style="gap:25px">
                    <table class="table text-white">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Combined Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total = 0;
                                if(!$err)
                                    while($row = mysqli_fetch_assoc($foodArray))
                                    {
                                        if(isset($cart[$row['food_id']]))
                                        {
                                            $total = $total + $row['price'] * $cart[$row['food_id']];
                            ?>
                            <tr>
                                <td scope="row"> <?=$row['food_id']?> </td>
                                <td><?=$row['name']?></td>
                                <td><?=$cart[$row['food_id']]?></td>
                                <td>$<?= $row['price'] ?></td>
                                <td>$<?= $row['price'] * $cart[$row['food_id']] ?></td>
                            </tr>
                            <?php
                                    }
                                }
                                else {

                                }
                            ?>
                            <tr>
                                <th scope="row"></th>
                                <th colspan="3">Total</th>
                                <th>$<?=$total?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <?php
                            if(isset($cart))
                            {
                        ?>
                        <form method="POST">
                            <div class="input-group my-5">
                                <input type="number" class="form-control" placeholder="Phone Number" name="phone-number" aria-label="Phone Number" required>
                                <input type="hidden" name="submit">
                                <button class="btn btn-primary" type="submit" id="btn-checkout">Checkout!</button>
                            </div>
                        </form>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <h1 class="my-5 text-white text-center">Previous Orders</h1>
            <div class="container">
                <div class="row" style="gap:25px">
                    <table class="table text-white">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">1</td>
                                <td>Veg Pizza</td>
                                <td>2</td>
                                <td>$5</td>
                            </tr>
                            <tr>
                                <td scope="row">2</td>
                                <td>Peperonni Pizza</td>
                                <td>1</td>
                                <td>$15</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <th colspan="2">Total</th>
                                <th>$25</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="align-items-center text-white bg-success border-0">
                            <div class="d-flex justify-content-center">
                                <div class="toast-body">
                                    <h4>Order Status: Completed</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <a href="rate.php">
                            <button class="btn btn-primary w-100 h-100" type="button" id="btn-rate">Click here to Rate and Review!</button>
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <footer class="mt-auto text-white-50" style="position: fixed;">
            <div class="toast-container">

            </div>
        </footer>
    </div>

    <script src="assets/js/main.js"></script>
    <script>
        <?php
            if(isset($_POST['submit']))
            {
                if(isset($SUCCESS) && $SUCCESS == false) {
                    echo "$( document ).ready(function(){ generateToast('failure-toast','" . $PRINT_MSG . "','danger')});";
                }
                else {
                    echo "$( document ).ready(function(){ generateToast('success-toast','" . $PRINT_MSG . "','success')});";
                }
            }
        ?>
    </script>
</body>

</html>
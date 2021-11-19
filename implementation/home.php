<?php

    require 'db/db-connect.php';
    require 'db/db-functions.php';
    require 'db/debug-functions.php';
    
    session_start();

    if(isset($_GET['prompt']))
        $PROMPT_MSG = $_GET['prompt'];

    $is_logged_in = false;
    $err = false;

    // if table number is in not session 
    if( isset($_POST['table_number']) )
    {
        $_SESSION['table_number'] = $_POST['table_number'];
        $is_logged_in = true;
        session_regenerate_id(true);
    }
    if(isset($_SESSION['table_number']))
        $is_logged_in = true;
    
    if(!$is_logged_in)
        header("Location: index.php?prompt=please provide a table number");
    
    // if searching for something
    if( isset($_GET['q']) ) {
        $search_query = mysqli_real_escape_string($conn,$_GET['q']);
        $foodArray = getRelatedFood($search_query);
    }
    else {
        // fetch food from db
        $foodArray = getFood();
    }

    if( $foodArray == NULL)
    {
        $PRINT_MSG = "ERR";
        $err = true;
    }
    
    if( isset($_COOKIE['cart']) )
        $cart = json_decode(stripslashes($_COOKIE['cart']),true);
    
?>

<!DOCTYPE html>
<html lang="en">

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

<body class="d-flex h-100 bg-dark">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div class="">
                <a href="index.php"><h3 class="float-md-start mb-0 text-white">Restaurant Ordering System</h3></a>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <form method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                        <input type="search" name="q" class="form-control" placeholder="Search..." aria-label="Search" value="<?=isset($_GET['q'])? $_GET['q'] : ""?>">
                    </form>
                    <a class="nav-link active text-white" aria-current="page" href="home.php">Order</a>
                    <a class="nav-link text-white" aria-current="page" href="cart.php">Cart / View Order</a>
                </nav>
            </div>
        </header>

        <main class="py-3">
            <h1 class="my-5 text-white text-center">Our Menu!</h1>
            <div class="container">
                <div class="row" style="gap:25px">
                <?php
                    if(!$err)
                    while($row = mysqli_fetch_assoc($foodArray))
                    {
                ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="menu-item-container">
                                <div class="left-part">
                                    <img class="item-img" src="assets/img/<?= $row['photo'];?>" alt="">
                                        <div class="item-description px-5">
                                            <a class="text-dark" href="item.php?id=<?=$row['food_id']?>">
                                                <p class="title"><?= $row['name']?> <?= $row['rating'] != NULL ? "( AVG. Rating: ". $row['rating'] ." / 5 )" : ""?> </p>
                                            </a>
                                            <p class="body"><?= $row['description']?></p>
                                        </div>
                                    </div>
                                <div class="right-part">
                                    <div class="item-cost">
                                        <p class="cost text-center">$<?= $row['price']?></p>
                                    </div>
                                    <div class="item-cart">
                                        <button id="<?= $row['food_id']?>" class="btn btn-primary <?= !isset($cart) || !isset($cart[$row['food_id']]) ? "" : "d-none" ?> cart-add w-100" type="button" data-toggle="on">Add to Cart</button>
                                        <div class="btn-group <?= isset($cart) && isset($cart[$row['food_id']]) ? "" : "d-none" ?> cart-qty" role="group" aria-label="Basic example">
                                            <span><button id="<?= $row['food_id']?>" class="btn btn-dark btn-minuse" type="button">-</button></span>
                                            <input type="text" class="form-control no-padding text-center height-25" maxlength="3" value="<?= isset($cart) && isset($cart[$row['food_id']]) ? $cart[$row['food_id']] : "1" ?>">
                                            <span><button id="<?= $row['food_id']?>" class="btn btn-dark btn-pluss" type="button">+</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                    else {
                        if( isset($err) )
                            echo "<script>$( document ).ready(function(){ generateToast('no-data-toast','No Data Found','danger')});</script>";
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
    <script>
        <?php 
            if(isset($PROMPT_MSG)) {
                echo "$( document ).ready(function(){ generateToast('prompt-toast','".$PROMPT_MSG."','info');});";
            } 
        ?>
    </script>
</body>

</html>
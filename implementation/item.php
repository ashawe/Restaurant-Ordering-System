<?php

    require 'db/db-connect.php';
    require 'db/db-functions.php';
    require 'db/debug-functions.php';
    
    session_start();

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

    if( isset($_GET['id']) )
    {
        $food_id = mysqli_real_escape_string($conn,$_GET['id']);
        $foodInfo = getFoodInfo($food_id);
        if($foodInfo != NULL) {
            $info_about_food = $foodInfo;
            $reviews = getReviews($food_id);
        }
        else {
            $SUCCESS = false;
            $PRINT_MSG = "INVALID REQUEST";
        }
    }
    else {
        $SUCCESS = false;
        $PRINT_MSG = "INVALID REQUEST";
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
    <title>Item - <?= isset($info_about_food) ? $info_about_food['name'] : ""?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/cover.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body class="d-flex h-100 bg-dark">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div class="h-100">
                <a href="index.php"><h3 class="float-md-start mb-0 text-white">Restaurant Ordering System</h3></a>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <form method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                        <input type="search" name="q" class="form-control" placeholder="Search..." aria-label="Search">
                    </form>
                    <a class="nav-link text-white" aria-current="page" href="home.php">Order</a>
                    <a class="nav-link text-white" aria-current="page" href="cart.php">Cart / View Order</a>
                </nav>
            </div>
        </header>

        <main class="py-3">
            <?php
                if( isset($info_about_food) )
                {
            ?>
                    <h1 class="my-5 text-white text-center"><?= $info_about_food['name']?></h1>
                    <div class="container">
                        <div class="row" style="gap:25px">
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="menu-item-container">
                                        <div class="left-part">
                                            <img class="item-img-big" src="assets/img/<?=$info_about_food['photo']?>" alt="">
                                        </div>
                                        <div class="mx-5 w-100">
                                            <div class="item-description" style="display: flex;flex-direction: column;justify-content: space-around;height: 100%;">
                                                <p class="title"><?=$info_about_food['description']?></p>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h3 class="mt-3" style="display: inline-block;">Price: $<?=$info_about_food['price']?></h3>
                                                    </div>
                                                    <div class="col-6 align-self-center mt-3">
                                                        <button id="<?=$food_id?>"  class="btn btn-primary cart-add w-100 <?= !isset($cart) || !isset($cart[$food_id]) ? "" : "d-none" ?>" type="button" data-toggle="on">Add to Cart</button>
                                                        <div class="btn-group cart-qty <?= isset($cart) && isset($cart[$food_id  ]) ? "" : "d-none" ?>" role="group" aria-label="Basic example">
                                                            <span><button id="<?=$food_id?>" class="btn btn-dark btn-minuse" type="button">-</button></span>
                                                            <input type="text" class="form-control no-padding text-center height-25" maxlength="3" value="<?= isset($cart) && isset($cart[$food_id]) ? $cart[$food_id] : "1" ?>">
                                                            <span><button id="<?=$food_id?>" class="btn btn-dark btn-pluss" type="button">+</button></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="gap:25px">
                            <h1 class="text-white mt-5">Reviews:</h1>
                            <?php
                                if( $reviews != NULL )
                                {
                                    while($row = mysqli_fetch_assoc($reviews))
                                    {
                                        if($row['review'] != "")
                                        {
                            ?>
                                            <div class="card">
                                                <div class="card-body p-3">
                                                    <p class="mb-0"><?=$row['review']?></p>
                                                </div>
                                            </div>
                            <?php   
                                        }
                                    }
                                }
                                else echo "<h1  class=text-white mt-5'>No Reviews yet.</h1>"
                            ?>
                        </div>
                    </div>
            <?php
                }
                else {

                }
            ?>
        </main>

        <footer class="mt-auto text-white-50" style="position: fixed;">
            <div class="toast-container">

            </div>
        </footer>
    </div>

    <script src="assets/js/main.js"></script>
    <script>
        <?php 
            if( isset($SUCCESS) && isset($PRINT_MSG)) {
                if(!$SUCCESS)
                    echo "$( document ).ready(function(){ generateToast('success-failure-toast','".$PRINT_MSG."','danger');});";
            } 
        ?>
    </script>
</body>

</html>
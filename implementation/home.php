<?php

    require 'db/db-connect.php';
    session_start();

    $is_logged_in = false;

    // if table number is in not session 
    if( isset($_POST['table-number']) )
    {
        $_SESSION['table-number'] = $_POST['table-number'];
        $is_logged_in = true;
    }
    if(isset($_SESSION['table-number']))
        $is_logged_in = true;
    
    if(!$is_logged_in)
        header("Location: index.php?prompt=please provide a table number");
    
    

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
                        <input type="search" name="q" class="form-control" placeholder="Search..." aria-label="Search">
                    </form>
                    <a class="nav-link active text-white" aria-current="page" href="home.php">Order</a>
                    <a class="nav-link active text-white" aria-current="page" href="cart.php">Cart / View Order</a>
                </nav>
            </div>
        </header>

        <main class="py-3">
            <h1 class="my-5 text-white text-center">Our Menu!</h1>
            <div class="container">
                <div class="row" style="gap:25px">
                    <div class="card">
                        <div class="card-body">
                            <div class="menu-item-container">
                                <div class="left-part">
                                    <img class="item-img" src="assets/img/pizz.jpg" alt="">
                                    <div class="item-description px-5">
                                        <p class="title">Veg Pizza</p>
                                        <p class="body">Onion, Tomato, Capsicum</p>
                                    </div>
                                </div>
                                <div class="right-part">
                                    <div class="item-cost">
                                        <p class="cost text-center">$5</p>
                                    </div>
                                    <div class="item-cart">
                                        <button class="btn btn-primary cart-add w-100" type="button" data-toggle="on">Add to Cart</button>
                                        <div class="btn-group d-none cart-qty" role="group" aria-label="Basic example">
                                            <span><button class="btn btn-dark btn-minuse" type="button">-</button></span>
                                            <input type="text" class="form-control no-padding text-center height-25" maxlength="3" value="1">
                                            <span><button class="btn btn-dark btn-pluss" type="button">+</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="menu-item-container">
                                <div class="left-part">
                                    <img class="item-img" src="assets/img/pizz.jpg" alt="">
                                    <div class="item-description px-5">
                                        <p class="title">Peperonni Pizza</p>
                                        <p class="body">Onion, Tomato, Capsicum, Pepperoni</p>
                                    </div>
                                </div>
                                <div class="right-part">
                                    <div class="item-cost">
                                        <p class="cost text-center">$15</p>
                                    </div>
                                    <div class="item-cart">
                                        <button class="btn btn-primary cart-add w-100" type="button" data-toggle="on">Add to Cart</button>
                                        <div class="btn-group d-none cart-qty" role="group" aria-label="Basic example">
                                            <span><button class="btn btn-dark btn-minuse" type="button">-</button></span>
                                            <input type="text" class="form-control no-padding text-center height-25" maxlength="3" value="1">
                                            <span><button class="btn btn-dark btn-pluss" type="button">+</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
</body>

</html>
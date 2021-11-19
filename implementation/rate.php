<?php

    require 'db/db-connect.php';
    require 'db/db-functions.php';

    session_start();

    if( !isset($_SESSION['table_number']) || !isset($_COOKIE['order_id']) )
        header("Location: index.php?prompt=Please+login+to+continue");
        
    $orderCopy = getOrder($_COOKIE['order_id'],$_SESSION['table_number']);
    
    if( isset($_POST['submit']) )
    {
        // if( isset( $_POST[''] && ) ) 
        // var_dump($_POST);
        // sanitizations
        // overall rating
        $overall_suggestion = mysqli_real_escape_string($conn,$_POST['overall-suggestion']);
        $ids = array();
        $ratings = array();
        $reviews = array();

        $count = 0;

        // first organize post data to process
        while($row = mysqli_fetch_assoc($orderCopy)) {
            $count = $count + 1;

            $id = $row['food_id'];
            $idRate = $id.'-rate';
            $idReview = $id.'-review';

            if( isset($_POST[$idRate]) && isset($_POST[$idReview]) && $_POST[$idRate] != "Choose a rating" )
            {
                array_push($ids,$id);
                $ratings[$id] = $_POST[$idRate];
                $reviews[$id] = $_POST[$idReview];
            }
        }

        if( count($ids) != $count )
        {
            $SUCCESS = false;
            $PRINT_MSG = "Please select a rating for all the items";
        }
        else {
            // var_dump($ids);
            // var_dump($ratings);
            // var_dump($reviews);
    
            // now process them and add rating and reviews to db.
            foreach($ids as $id) {
                $result = rate($id,$ratings[$id],$reviews[$id]);
                // writeC($result);
            }

            // post overall suggestion for the order
            if( !empty($overall_suggestion))
            {
                $result = addSuggestion($_COOKIE['order_id'],$overall_suggestion);
                // writeC($result);
            }

            unset($_COOKIE['order_id']); 
            setcookie('order_id', null, time() -3000, '/');
            header("Location: home.php?prompt=Thanks for rating and reviewing");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate your order</title>

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
                    <a class="nav-link text-white" aria-current="page" href="home.php">Order</a>
                    <a class="nav-link text-white" aria-current="page" href="cart.php">Cart / View Order</a>
                </nav>
            </div>
        </header>

        <main class="py-3">
            <h1 class="my-5 text-white text-center">Rate & Review</h1>
            <div class="container">
                <form method="POST">
                    <div class="row" style="gap:25px">
                        <div class="card">
                            <div class="card-body">
                                <h3>Overall Suggestion</h3>
                                <div class="form-floating my-2">
                                    <textarea name="overall-suggestion" class="form-control" placeholder="Leave a comment here" id="overall-review" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Write suggestion for entire order (optional)</label>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-center text-white">Food Item Review</h3>
                        <?php
                            $orderDetails = getOrder($_COOKIE['order_id'],$_SESSION['table_number']);
                            while($row = mysqli_fetch_assoc($orderDetails))
                            {
                        ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="menu-item-container">
                                        <div class="left-part w-100">
                                            <img class="item-img" src="assets/img/<?=$row['photo']?>" alt="">
                                            <div class="item-description px-5 w-100">
                                                <p class="title"><?=$row['name']?></p>
                                                <div class="form-floating my-2">
                                                    <select name="<?=$row['food_id']?>-rate" class="form-select" id="rate-item-1" aria-label="Floating label select example">
                                                        <option selected>Choose a rating</option>
                                                        <option value="1">One / Five</option>
                                                        <option value="2">Two / Five</option>
                                                        <option value="3">Three / Five</option>
                                                        <option value="4">Four / Five</option>
                                                        <option value="5">Five / Five</option>
                                                    </select>
                                                    <label for="rate-item-1">Rating</label>
                                                </div>
                                                <div class="form-floating my-2">
                                                    <textarea name="<?=$row['food_id']?>-review" class="form-control" placeholder="Leave a comment here" id="review-item1" style="height: 100px"></textarea>
                                                    <label for="review-item1">Write a Review (optional)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                        <input type="hidden" name="submit">
                        <button class="btn btn-primary w-100" type="submit" data-toggle="on">Submit Review</button>
                    </div>
                </form>
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
            if(isset($SUCCESS) && isset($PRINT_MSG)) {
                if(!$SUCCESS)
                    echo "$( document ).ready(function(){ generateToast('failure-toast','".$PRINT_MSG."','danger');});";
            } 
        ?>
    </script>
</body>

</html>
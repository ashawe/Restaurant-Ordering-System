<?php

    require_once 'db/db-connect.php';
    require 'db/debug-functions.php'; // @ToDO remove
    require 'db/admin-db-functions.php';
    require 'db/db-functions.php';

    session_start();

    // check if user has access to this page.
    if( !isset($_SESSION['role']) || $_SESSION['role'] != "ADMIN" && $_SESSION['role'] != "CHEF")
    {
        header('Location: login.php?prompt=please+login+to+continue');
    }

    $role = $_SESSION['role'];

    if( isset($_POST['submit']) )
    {
        // var_dump($_POST);
        if( isset($_POST['order_id']) ) {
            $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
            $ret = deleteSuggestion($order_id);
            if($ret)
            {
                $SUCCESS = true;
                $PRINT_MSG = "Deleted Successfully";
            }
            else
            {
                $SUCCESS = false;
                $PRINT_MSG = "Failed to delete";
            }
        }
        else if (isset($_POST['rating_id']))
        {
            writeC("HERE");
            $rating_id = mysqli_real_escape_string($conn, $_POST['rating_id']);
            $ret = deleteRating($rating_id);
            if($ret)
            {
                $SUCCESS = true;
                $PRINT_MSG = "Deleted Successfully";
            }
            else
            {
                $SUCCESS = false;
                $PRINT_MSG = "Failed to delete";
            }
        }
    }

    $suggestions = getSuggestions();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View <?=$role=="ADMIN"? "/ Edit" : ""?> Suggestions</title>

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
                    <?php
                        if($role == "ADMIN")
                        {
                    ?>
                            <a class="nav-link active text-white" aria-current="page" href="view-suggestions.php">Manage Ratings / Reviews</a>
                            <ul class="navbar-nav mx-3">
                                <li class="nav-item dropdown text-white">
                                    <a class="text-white nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Food
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item text-white" href="add-edit-food.php">Add Food</a></li>
                                        <li><a class="dropdown-item text-white" href="manage-food.php">Manage Food</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="navbar-nav mx-3">
                                <li class="nav-item dropdown text-white">
                                    <a class="text-white nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Chef
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item text-white" href="add-chef.php">Add Chef</a></li>
                                        <li><a class="dropdown-item text-white" href="manage-chef.php">Manage Chef</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <a class="nav-link text-white" aria-current="page" href="logout.php">Logout</a>
                    <?php
                        }
                        else {
                    ?>
                            <a class="nav-link text-white" aria-current="page" href="view-orders.php">View Orders</a>
                            <a class="nav-link text-white" aria-current="page" href="view-completed-orders.php">View Completed Orders</a>
                            <a class="nav-link active text-white" aria-current="page" href="view-suggestions.php">View Suggestions</a>
                            <a class="nav-link text-white" aria-current="page" href="logout.php">Logout</a>
                            <!-- @ToDo : add logout button to chef's pages -->
                            <!-- @ToDo : capitalize l in logout -->
                    <?php
                        }
                    ?>
                </nav>
            </div>
        </header>

        <main class="py-3">
            <h1 class="my-5 text-white text-center">Suggestions</h1>
            <div class="container">
                <div class="row" style="gap:25px">
                    <?php
                        if( isset($suggestions) && $suggestions != NULL )
                        {
                            $i = 1;
                            while($row = mysqli_fetch_assoc($suggestions)) 
                            {
                                if( !empty($row['suggestion']) ) {
                    ?>
                                <h3 class="text-white">Order #<?=$i?></h3>
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Overall Suggestion</h3>
                                        <p><?= $row['suggestion'] ?></p>
                                        <form method="POST">
                                            <input type="hidden" name="submit" value="submit">
                                            <input type="hidden" name="order_id" value="<?=$row['order_id']?>">
                                            <button class="btn btn-danger" type="submit">Delete Suggestion</button>
                                        </form>
                                    </div>
                                </div>
                    <?php
                                $i = $i +1;
                                }
                            }
                        }
                    ?>
                </div>
            </div>
            <h1 class="text-white mt-5">Food Ratings and reviews</h1>
            <div class="container">
                <div class="row" style="gap:25">
                        <?php
                            $currentID = "";
                            $food_reviews = getFoodReviews();
                            if($food_reviews != NULL && $role == "ADMIN") {

                                $row = mysqli_fetch_assoc($food_reviews);
                                while($row)
                                {
                                    $currentID = $row['food_id'];
                        ?>
                                    <h3 class="text-white mt-3"><?=$row['name']?></h3>
                                    <?php
                                        while($currentID == $row['food_id']) 
                                        {
                                    ?>
                                            <div class="card mt-2">
                                                <div class="card-body">
                                                    <div class="menu-item-container mt-3">
                                                        <div class="left-part w-100">
                                                            <img class="item-img" src="assets/img/<?=$row['photo']?>" alt="">
                                                            <div class="item-description px-5 w-100">
                                                                <p class="body"><?=$row['rating']?> / 5</p>
                                                                <p><?=$row['review']?></p>
                                                                <form method="POST">
                                                                    <input type="hidden" name="submit" value="submit">
                                                                    <input type="hidden" name="rating_id" value="<?=$row['rating_id']?>">
                                                                    <button class="btn btn-danger" type="submit">Delete Item Rating & Review</button> 
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                            $row = mysqli_fetch_assoc($food_reviews);
                                        }
                                    ?>
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
    <script>
        <?php
            if( isset($SUCCESS) && isset($PRINT_MSG) ) {
                if($SUCCESS)
                    echo "$( document ).ready(function(){ generateToast('success-failure-toast','" . $PRINT_MSG. "','success');});";
                else
                    echo "$( document ).ready(function(){ generateToast('success-failure-toast','" . $PRINT_MSG . "','danger');});";
            } 
        ?>
    </script>
</body>

</html>
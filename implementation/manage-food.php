<?php

    require_once 'db/db-connect.php';
    require 'db/debug-functions.php'; // @ToDO remove
    require 'db/admin-db-functions.php';
    require 'db/db-functions.php';

    session_start();

    // check if user has access to this page.
    if( !isset($_SESSION['role']) || $_SESSION['role'] != "ADMIN")
    {
        header('Location: login.php?prompt=please+login+as+admin+to+continue');
    }

    if( isset($_POST['submit']) && $_SESSION['role'] == "ADMIN") {
        if( isset($_POST['food_id']) ) {
            $food_id = mysqli_real_escape_string($conn,$_POST['food_id']);
            
            $food_info = getFoodInfo($food_id);

            writeC($food_id);
            $ret = removeFood($food_id);
            if($ret) {

                if($food_info != NULL) 
                {
                    // delete food image
                    $filename = "assets/img/" . $food_info['photo'];
                    if (file_exists($filename)) {
                        unlink($filename);
                    }
                }
                $SUCCESS = true;
                $PRINT_MSG = "Removed successfully";
            }
            else {
                $SUCCESS = false;
                $PRINT_MSG = "Failed to remove";
            }
        }
    }

    $food = getFood();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Food</title>

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
                    <a class="nav-link text-white" aria-current="page" href="view-suggestions.php">Manage Ratings / Reviews</a>
                    <ul class="navbar-nav mx-3">
                        <li class="nav-item dropdown text-white">
                            <a class="text-white nav-link active dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                </nav>
            </div>
        </header>

        <main class="py-3">
            <h1 class="my-5 text-white text-center">Manage Food!</h1>
            <div class="container">
                <div class="row" style="gap:25px">
                <?php
                    if(isset($food))
                    {
                        while($row = mysqli_fetch_assoc($food))
                        {
                ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="menu-item-container">
                                        <div class="left-part">
                                            <img class="item-img" src="assets/img/<?=$row['photo']?>" alt="">
                                            <div class="item-description px-5">
                                                <p class="title"><?=$row['name']?></p>
                                                <p class="body"><?=$row['description']?></p>
                                            </div>
                                        </div>
                                        <div class="right-part">
                                            <div class="item-cost">
                                                <p class="cost text-center">$<?=$row['price']?></p>
                                            </div>
                                            <div class="item-cart">
                                                <a href="add-edit-food.php?id=<?=$row['food_id']?>"><button class="btn btn-warning cart-add w-100 mb-2" type="button">Edit Item</button></a>
                                                <form method="POST">
                                                    <input type="hidden" name="submit" value="submit">
                                                    <input type="hidden" name="food_id" value="<?=$row['food_id']?>">
                                                    <button class="btn btn-danger cart-add w-100" type="submit">Remove Item</button>
                                                </form>
                                            </div>
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
<?php
    require_once 'db/db-connect.php';
    require 'db/debug-functions.php'; // @ToDO remove
    require 'db/admin-db-functions.php';
    
    $SUCCESS = false;

    // @ToDo : check if user is logged in as admin
    if(isset($_POST['chef-mail']))
    {
        $chefMail = $_POST['chef-mail'];
        writeC($chefMail);
        $ret = addChef($chefMail);
        if($ret!=NULL)
            $SUCCESS = true;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Chef</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/cover.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body class="d-flex h-100 bg-dark">
    <!-- @ToDo: Fix "active" link in navbar -->
    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header>
            <div class="">
                <a href="index.php"><h3 class="float-md-start mb-0 text-white">Restaurant Ordering System</h3></a>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link text-white" aria-current="page" href="view-suggestions.php">Manage Ratings / Reviews</a>
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
                            <a class="text-white nav-link active dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

        <main class="py-3 text-white">
            <h1 class="my-5 text-center">Add Chef!</h1>
            <div class="container">
                <div class="row" style="gap:25px">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="food-name" class="form-label">Chef's Email Address</label>
                            <input type="email" class="form-control" id="food-name" name="chef-mail">
                            <div id="food-name-help" class="form-text">Enter chef's email id for login. A secure one time password will be generated for them. On their first login, they can choose a different password.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Chef</button>
                    </form>
                </div>
            </div>
        </main>

        <footer class="mt-auto text-white-50" style="position: fixed;">
            <div class="toast-container">
                <div id="success-failure-toast" class="toast align-items-center text-white bg-<?= $SUCCESS ? "success" : "danger"?> border-0" data-bs-delay="2000" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <?php 
                                if($SUCCESS)
                                    echo "Chef Added Successfully";
                                else
                                    echo "There was some error adding chef. Check logs.";
                            ?>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="assets/js/main.js"></script>
    <script>
        <?= isset($_POST['chef-mail']) || $SUCCESS ? "$( document ).ready(function(){\$('#success-failure-toast').toast('show');});" : "" ?>
    </script>
</body>

</html>
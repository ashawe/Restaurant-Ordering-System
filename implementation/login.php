<?php
    require_once 'db/db-connect.php';
    require 'db/db-functions.php';

    if(isset($_GET['prompt']))
        $REDIRECT_MSG = $_GET['prompt'];

    $SUCCESS = false;
    $PRINT_STATUS = "EMPTY";

    if( isset($_POST['username']) && isset($_POST['password']) )
    {
        $uname = $_POST['username'];
        $pwd = $_POST['password'];
        
        // writeC($uname);
        // writeC($pwd);

        $ret = checkLogin($uname,$pwd);
        var_dump($ret);

        if($ret!=NULL)
        {
            $SUCCESS = true;
            session_start();
            session_regenerate_id(true); 
            switch( $ret[0] ) {
                case "ADMIN": 
                    // writeC("Logged in as admin");
                    // set session as ADMIN
                    $_SESSION["role"] = "ADMIN";
                    // redirect to viewing managing chefs
                    $newURL = "add-chef.php";
                    writeToLog("Admin Logged in");
                    break;
                case "CHEF":
                    // writeC("Logged in as chef");
                    // set session as CHEF
                    $_SESSION["role"] = "CHEF";
                    if($ret[1] == true)
                    {
                        session_start();
                        $_SESSION["reset_required"] = true;
                        header("Location: reset-password.php?ref=view-orders.php");
                    }
                    // redirect to viewing orders
                    $newURL = "view-orders.php";
                    writeToLog("Chef Logged in: " . $uname);
                    break;
                default:
                    // writeC("default");
                    // display toast
                    break;
            }
            
            if( isset($_GET['ref']) )
                $newURL = $_GET['ref'];
            header('Location: '.$newURL);
        }
        else $PRINT_STATUS = "Error logging in. Check username / password.";
    }

?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>

    <title>Welcome!</title>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <link rel="stylesheet" href="assets/css/cover.css">

</head>

<body class="d-flex h-100 text-center bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header>
            <div>
                <a href="index.php"><h3 class="float-md-start mb-0 text-white">Restaurant Ordering System</h3></a>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <h1 class="my-5 text-white">Login Page</h1>
            <div class="container w-50">
                <form method="POST">
                    <div class="form-floating mb-3">
                        <input name="username" type="text" class="form-control rounded-4" id="username" placeholder="username" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="password" type="password" class="form-control rounded-4" id="passwd" placeholder="username" required>
                        <label for="passwd">Password</label>
                    </div>
                    <button type="submit" class="btn w-100 btn-primary btn-large">
                        LOGIN
                    </button>
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
            if((isset($_POST['username']) && isset($_POST['password'])) && !$SUCCESS) {
                echo "$( document ).ready(function(){ generateToast('success-failure-toast','" . $PRINT_STATUS . "','danger')});";
            }
            if( isset($REDIRECT_MSG) )
                echo "$( document ).ready(function(){ generateToast('redirect-toast','" . $REDIRECT_MSG . "','danger')});";
        ?>
    </script>

</body>

</html>
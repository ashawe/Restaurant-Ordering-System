<?php
    require_once 'db/db-connect.php';
    require 'db/db-functions.php';
    require 'db/validator.php';

    session_start();
    // var_dump($_SESSION);

    if(isset($_GET['prompt']))
        $REDIRECT_MSG = $_GET['prompt'];

    if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password-new']) )
    {
        $uname = $_POST['username'];
        $pwd = $_POST['password'];
        $pwd_check = $_POST['password-new'];
        
        // writeC($uname);
        // writeC($pwd);
        // writeC($pwd_check);

        $validationResult = validatePassword($pwd_check);

        if( $validationResult === true) {
            $ret = checkLogin($uname,$pwd);
            
            // if old password is correct
            if($ret!=NULL)
            {
                // if changing password was successful
                if(changePassword($uname,$pwd_check))
                {
                    $SUCCESS = true;
                    $PRINT_STATUS = "RESET SUCCESSFUL";
                }
            }
            else $PRINT_STATUS = "Check username / old password.";
        }
        else {
            $SUCCESS = false;
            $PRINT_STATUS = $validationResult;
        }

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

    <title>Reset Password!</title>

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
            <h1 class="my-5 text-white">Reset Password</h1>
            <div class="container w-50">
                <form method="POST">
                    <div class="form-floating mb-3">
                        <input name="username" type="text" class="form-control rounded-4" id="username" placeholder="username" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="password" type="password" class="form-control rounded-4" id="passwd" placeholder="password" required>
                        <label for="passwd">Old Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="password-new" type="password" class="form-control rounded-4" id="passwd-new" placeholder="password check" required>
                        <label for="passwd-new">New Password</label>
                    </div>
                    <button type="submit" class="btn w-100 btn-primary btn-large">
                        RESET
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
        $( document ).ready(function(){
        <?php 
            if(isset($_SESSION['reset_required']) && !isset($_POST['password-new'])) {
                echo " generateToast('first-login-toast','First time login. Password Reset Required','warning');";
            }
            if(isset($SUCCESS) && isset($PRINT_STATUS)) {
                // writeC("here" . $SUCCESS);
                if($SUCCESS == false)
                    echo " generateToast('success-failure-toast','".$PRINT_STATUS."','danger');";
                if($SUCCESS == true)
                {
                    if( isset($_SESSION['reset_required']) && $_SESSION['reset_required'] )
                    {
                        unset($_SESSION['reset_required']);
                        echo " 
                            generateToast('success-failure-toast','".$PRINT_STATUS."','success');
                            setTimeout(() => {
                                window.location.replace('view-orders.php');
                            }, 3000);";
                    }
                    else 
                        echo " generateToast('success-failure-toast','".$PRINT_STATUS."','success');";
                }
            }
        ?>

        });
    </script>

</body>

</html>
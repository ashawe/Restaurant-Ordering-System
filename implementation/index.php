<?php

if(isset($_GET['prompt']))
    $REDIRECT_MSG = $_GET['prompt'];

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

        <main class="px-3 pt-5">
            <h1 class=" text-white">Let's get started!</h1>
            <p class="lead  text-white">We're glad that you chose to eat at our restaurant. We hope you have a pleasant experience. Please enter your table number & click on the button below to start ordering food.</p>
            <p class="lead">
            <div class="container w-50">
                <form method="POST" action="home.php">
                    <div class="form-floating mb-3">
                        <input name="table_number" type="text" class="form-control rounded-4" id="floatingInput" placeholder="for ex: 14" required>
                        <label for="floatingInput">Table Number</label>
                    </div>
                    <button type="submit" class="btn w-100 btn-primary btn-large">
                        Start Session
                    </button>
                </form>
            </div>
            <p class="text-muted mt-3">The table number might be written on the table or the device you're holding.</p>
            </p>
        </main>

        <footer class="mt-auto text-white-50" style="position: fixed;">
            <div class="toast-container">
            </div>
        </footer>
    </div>

    <script src="assets/js/main.js"></script>
    <script>
        <?php 
            // if((isset($_POST['username']) && isset($_POST['password'])) && !$SUCCESS) {
            //     echo "$( document ).ready(function(){ generateToast('success-failure-toast','" . $PRINT_STATUS . "','danger')});";
            // }
            if( isset($REDIRECT_MSG) )
                echo "$( document ).ready(function(){ generateToast('redirect-toast','" . $REDIRECT_MSG . "','danger')});";
        ?>
    </script>

</body>

</html>
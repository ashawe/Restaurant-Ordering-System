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
                    <a class="nav-link active text-white" aria-current="page" href="view-orders.php">View Orders</a>
                    <a class="nav-link active text-white" aria-current="page" href="view-completed-orders.php">View Completed Orders</a>
                    <a class="nav-link active text-white" aria-current="page" href="view-suggestions.php">View Suggestions</a>
                </nav>
            </div>
        </header>

        <main class="py-3">
            <h1 class="my-5 text-white text-center">Completed Orders!</h1>
            <div class="container">
                <div id="completed-order-container" class="row mt-5" style="gap:25px">
                    <h1 class="text-white">Completed Orders</h1>
                    <div class="card">
                        <div class="card-body">
                            <p class="muted">Table 3</p>
                            <div class="menu-item-container">
                                <div class="left-part">
                                    <div class="item-description">
                                        <p class="title">Veg Pizza x 2</p>
                                        <p class="title">Peperonni Pizza x 1</p>
                                    </div>
                                </div>
                                <div class="right-part align-self-center">
                                    <button class="btn btn-danger w-100 btn-order-next" type="button" data-toggle="on">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p class="muted">Table 3</p>
                            <div class="menu-item-container">
                                <div class="left-part">
                                    <div class="item-description">
                                        <p class="title">Veg Burger x 1</p>
                                        <p class="title">Cheese Burger x 1</p>
                                        <p class="title">Peperonni Pizza x 1</p>
                                    </div>
                                </div>
                                <div class="right-part align-self-center">
                                    <button class="btn btn-danger w-100 btn-order-next" type="button" data-toggle="on">Remove</button>
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
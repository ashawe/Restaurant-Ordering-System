<!DOCTYPE html>
<html lang="en" class="h-100">

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

<body class="d-flex bg-dark">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div class="">
                <h3 class="float-md-start mb-0 text-white">Restaurant Ordering System</h3>
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
            <h1 class="my-5 text-white text-center">Cart</h1>
            <div class="container">
                <div class="row" style="gap:25px">
                    <table class="table text-white">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">1</td>
                                <td>Veg Pizza</td>
                                <td>2</td>
                                <td>$5</td>
                            </tr>
                            <tr>
                                <td scope="row">2</td>
                                <td>Peperonni Pizza</td>
                                <td>1</td>
                                <td>$15</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <th colspan="2">Total</th>
                                <th>$25</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <form action="POST">
                            <div class="input-group my-5">
                                <input type="number" class="form-control" placeholder="Phone Number" aria-label="Phone Number" required>
                                <button class="btn btn-primary" type="button" id="btn-checkout">Checkout!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <h1 class="my-5 text-white text-center">Previous Orders</h1>
            <div class="container">
                <div class="row" style="gap:25px">
                    <table class="table text-white">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">1</td>
                                <td>Veg Pizza</td>
                                <td>2</td>
                                <td>$5</td>
                            </tr>
                            <tr>
                                <td scope="row">2</td>
                                <td>Peperonni Pizza</td>
                                <td>1</td>
                                <td>$15</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <th colspan="2">Total</th>
                                <th>$25</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="align-items-center text-white bg-success border-0">
                            <div class="d-flex justify-content-center">
                                <div class="toast-body">
                                    <h4>Order Status: Completed</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <a href="rate.php">
                            <button class="btn btn-primary w-100 h-100" type="button" id="btn-rate">Click here to Rate and Review!</button>
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <footer class="mt-auto text-white-50" style="position: absolute;">
            <div class="toast-container">

            </div>
        </footer>
    </div>

    <script src="assets/js/main.js"></script>
</body>

</html>
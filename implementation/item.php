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
            <div class="h-100">
                <h3 class="float-md-start mb-0 text-white">Restaurant Ordering System</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <form method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                        <input type="search" name="q" class="form-control" placeholder="Search..." aria-label="Search">
                    </form>
                    <a class="nav-link active text-white" aria-current="page" href="home.php">Order</a>
                    <a class="nav-link active text-white" aria-current="page" href="cart.php">Cart</a>
                </nav>
            </div>
        </header>

        <main class="py-3">
            <h1 class="my-5 text-white text-center">Veg Pizza</h1>
            <div class="container">
                <div class="row" style="gap:25px">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="menu-item-container">
                                <div class="left-part">
                                    <img class="item-img-big" src="assets/img/pizz.jpg" alt="">
                                </div>
                                <div class="mx-5">
                                    <div class="item-description">
                                        <p class="title">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Architecto tempore obcaecati nam culpa eum vitae accusantium saepe est odio sunt fugiat corporis beatae itaque ad, esse laborum iusto quas id.</p>
                                        <div class="row">
                                            <div class="col-6">
                                                <h3 class="mt-3" style="display: inline-block;">Price: $5</h3>
                                            </div>
                                            <div class="col-6 align-self-center mt-3">
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
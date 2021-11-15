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

<body class="d-flex bg-dark">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div class="">
                <a href="index.php"><h3 class="float-md-start mb-0 text-white">Restaurant Ordering System</h3></a>
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
            <h1 class="my-5 text-white text-center">Rate & Review</h1>
            <div class="container">
                <form action="POST">
                    <div class="row" style="gap:25px">
                        <div class="card">
                            <div class="card-body">
                                <h3>Overall Suggestion</h3>
                                <div class="form-floating my-2">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="overall-review" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Write suggestion for entire order (optional)</label>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-center text-white">Food Item Review</h3>
                        <div class="card">
                            <div class="card-body">
                                <div class="menu-item-container">
                                    <div class="left-part w-100">
                                        <img class="item-img" src="assets/img/pizz.jpg" alt="">
                                        <div class="item-description px-5 w-100">
                                            <p class="title">Veg Pizza</p>
                                            <div class="form-floating my-2">
                                                <select class="form-select" id="rate-item-1" aria-label="Floating label select example">
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
                                                <textarea class="form-control" placeholder="Leave a comment here" id="review-item1" style="height: 100px"></textarea>
                                                <label for="review-item1">Write a Review (optional)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="menu-item-container">
                                    <div class="left-part w-100">
                                        <img class="item-img" src="assets/img/pizz.jpg" alt="">
                                        <div class="item-description px-5 w-100">
                                            <p class="title">Pepperoni Pizza</p>
                                            <div class="form-floating my-2">
                                                <select class="form-select" id="rate-item-2" aria-label="Floating label select example">
                                                    <option selected>Choose a rating</option>
                                                    <option value="1">One / Five</option>
                                                    <option value="2">Two / Five</option>
                                                    <option value="3">Three / Five</option>
                                                    <option value="4">Four / Five</option>
                                                    <option value="5">Five / Five</option>
                                                </select>
                                                <label for="rate-item-2">Rating</label>
                                            </div>
                                            <div class="form-floating my-2">
                                                <textarea class="form-control" placeholder="Leave a comment here" id="review-item-2" style="height: 100px"></textarea>
                                                <label for="review-item-2">Write a Review (optional)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" type="button" data-toggle="on">Submit Review</button>
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
</body>

</html>
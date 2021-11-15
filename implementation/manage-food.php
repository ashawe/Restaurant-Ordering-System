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
                <h3 class="float-md-start mb-0 text-white">Restaurant Ordering System</h3>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="menu-item-container">
                                <div class="left-part">
                                    <img class="item-img" src="assets/img/pizz.jpg" alt="">
                                    <div class="item-description px-5">
                                        <p class="title">Veg Pizza</p>
                                        <p class="body">Onion, Tomato, Capsicum</p>
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam fugiat officiis ipsum cum quaerat similique vel repellat ducimus neque praesentium molestias, laudantium nobis repellendus quasi corporis debitis sint possimus minima!</p>
                                    </div>
                                </div>
                                <div class="right-part">
                                    <div class="item-cost">
                                        <p class="cost text-center">$5</p>
                                    </div>
                                    <div class="item-cart">
                                        <a href="add-edit-food.php?id=1"><button class="btn btn-warning cart-add w-100 mb-2" type="button">Edit Item</button></a>
                                        <button class="btn btn-danger cart-add w-100" type="button">Remove Item</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="menu-item-container">
                                <div class="left-part">
                                    <img class="item-img" src="assets/img/pizz.jpg" alt="">
                                    <div class="item-description px-5">
                                        <p class="title">Peperonni Pizza</p>
                                        <p class="body">Onion, Tomato, Capsicum, Pepperoni</p>
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam fugiat officiis ipsum cum quaerat similique vel repellat ducimus neque praesentium molestias, laudantium nobis repellendus quasi corporis debitis sint possimus minima!</p>
                                    </div>
                                </div>
                                <div class="right-part">
                                    <div class="item-cost">
                                        <p class="cost text-center">$15</p>
                                    </div>
                                    <div class="item-cart">
                                        <a href="add-edit-food.php?id=1"><button class="btn btn-warning cart-add w-100 mb-2" type="button">Edit Item</button></a>
                                        <button class="btn btn-danger cart-add w-100" type="button">Remove Item</button>
                                    </div>
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
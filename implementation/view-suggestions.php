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
                    <a class="nav-link active text-white" aria-current="page" href="view-orders.php">View Orders</a>
                    <a class="nav-link active text-white" aria-current="page" href="view-completed-orders.php">View Completed Orders</a>
                    <a class="nav-link active text-white" aria-current="page" href="view-suggestions.php">View Suggestions</a>
                </nav>
            </div>
        </header>

        <main class="py-3">
            <h1 class="my-5 text-white text-center">Suggestions</h1>
            <div class="container">
                <div class="row" style="gap:25px">
                    <h3 class="text-white">Order #1</h3>
                    <div class="card">
                        <div class="card-body">
                            <h3>Overall Suggestion</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quia explicabo tenetur id obcaecati voluptas numquam nisi dolorum minus totam cum quaerat veniam, sint maxime quos quae eum vero! Dolorum.</p>
                            <button class="btn btn-danger" type="button">Delete Suggestion</button>
                            <h3>Item-wise Review</h3>
                            <div class="menu-item-container">
                                <div class="left-part w-100">
                                    <img class="item-img" src="assets/img/pizz.jpg" alt="">
                                    <div class="item-description px-5 w-100">
                                        <p class="title">Veg Pizza</p>
                                        <p class="body">2/5</p>
                                        <p></p>
                                        <button class="btn btn-danger" type="button">Delete Item Review</button>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-item-container mt-3">
                                <div class="left-part w-100">
                                    <img class="item-img" src="assets/img/pizz.jpg" alt="">
                                    <div class="item-description px-5 w-100">
                                        <p class="title">Pepperoni Pizza</p>
                                        <p class="body">2/5</p>
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque quis sit incidunt, dolorum modi praesentium enim, architecto dolore magni beatae distinctio repudiandae ex quo cupiditate iste ipsum quod sunt possimus.</p>
                                        <!-- @ToDo : Show button only to admin -->
                                        <button class="btn btn-danger" type="button">Delete Item Review</button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-white">Order #4</h3>
                    <div class="card">
                        <div class="card-body">
                            <h3>Overall Suggestion</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quia explicabo tenetur id obcaecati voluptas numquam nisi dolorum minus totam cum quaerat veniam, sint maxime quos quae eum vero! Dolorum.</p>
                            <button class="btn btn-danger" type="button">Delete Suggestion</button>
                            <h3>Item-wise Review</h3>
                            <div class="menu-item-container">
                                <div class="left-part w-100">
                                    <img class="item-img" src="assets/img/pizz.jpg" alt="">
                                    <div class="item-description px-5 w-100">
                                        <p class="title">Veg Pizza</p>
                                        <p class="body">2/5</p>
                                        <p></p>
                                        <button class="btn btn-danger" type="button">Delete Item Review</button>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-item-container mt-3">
                                <div class="left-part w-100">
                                    <img class="item-img" src="assets/img/pizz.jpg" alt="">
                                    <div class="item-description px-5 w-100">
                                        <p class="title">Pepperoni Pizza</p>
                                        <p class="body">2/5</p>
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque quis sit incidunt, dolorum modi praesentium enim, architecto dolore magni beatae distinctio repudiandae ex quo cupiditate iste ipsum quod sunt possimus.</p>
                                        <button class="btn btn-danger" type="button">Delete Item Review</button>
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
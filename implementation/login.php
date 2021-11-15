<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">

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
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0 text-white">Restaurant Ordering System</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <h1 class="my-5 text-white">Login Page</h1>
            <div class="container w-50">
                <form method="POST" action="home.php">
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

        <footer class="mt-auto text-white-50">
        </footer>
    </div>


</body>

</html>
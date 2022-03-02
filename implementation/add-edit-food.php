<?php
    require_once 'db/db-connect.php';
    require 'db/admin-db-functions.php';
    
    $SUCCESS = false;

    session_start();

    // check if user has access to this page.
    if( !isset($_SESSION['role']) || $_SESSION['role'] != "ADMIN")
    {
        header('Location: login.php?prompt=please+login+as+admin+to+continue&ref=add-edit-food.php');
    }

    // var_dump($_POST);

    // Check if image file is a actual image or fake image
    if( isset($_POST["food-name"]) && isset($_POST["food-description"]) && isset($_FILES["food-img"]) && isset($_POST["food-price"])  && $_SESSION['role'] == "ADMIN") {
        
        $target_dir = "assets/img/";
        $target_file = $target_dir . basename($_FILES["food-img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // validation checks
        if(!is_numeric($_POST['food-price']))
        {
            $PRINT_MSG = "price must be a number";
            $SUCCESS = false;
            $uploadOk = false;
        }


        $check = getimagesize($_FILES["food-img"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            // $uploadOk = 1;
        } else {
            $PRINT_MSG = "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            // echo "Sorry, file already exists.";
            $prefix = substr(str_shuffle(MD5(microtime())), 0, 5);
            $target_file = $target_dir . $prefix . basename($_FILES["food-img"]["name"]);
            // $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["food-img"]["size"] > 500000) {
            $PRINT_MSG = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $PRINT_MSG =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // $PRINT_MSG =  "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["food-img"]["tmp_name"], $target_file)) {
             $PRINT_MSG = "The file has been uploaded.";
             $uploadOk = 1;
            } else {
                $PRINT_MSG = "Sorry, there was an error uploading your file.";
                $uploadOk = 0;
            }
        }

        // if file uploaded
        if($uploadOk == 1) {

            // sanitize
            $name = mysqli_real_escape_string($conn, $_POST['food-name']);
            $price = mysqli_real_escape_string($conn, $_POST['food-price']);
            $photo = explode('/',$target_file)[2];
            $descript = mysqli_real_escape_string($conn, $_POST['food-description']);
            
            // insert in db
            $insertQry = 'INSERT INTO food (name, price, photo, description) VALUES (?,?,?,?)';
 
            $insertStatement = mysqli_prepare($conn,$insertQry);
            
            mysqli_stmt_bind_param($insertStatement,'sdss',$name, $price, $photo, $descript);
            
            $ret = mysqli_stmt_execute($insertStatement);
            
            if ($ret) {
                $PRINT_MSG =  "Food Added Successfully";
                $SUCCESS = true;
            } else {
                // @ToDo : Write to log
                writeToLog("Food could not be added. Error: " . mysqli_error($conn));
                $PRINT_MSG = "There was some error. Please try again later";
                // writeC("Error: ". $ret . mysqli_error($conn));
                $SUCCESS = false;
            }

        }
    }
    else {
        if( isset($_POST['submit']))
            $PRINT_MSG = "Please provide every input.";
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food Item</title>

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
                    <a class="nav-link text-white" aria-current="page" href="logout.php">Logout</a>
                </nav>
            </div>
        </header>

        <main class="py-3 text-white">
            <h1 class="my-5 text-center">Add Food!</h1>
            <div class="container">
                <div class="row" style="gap:25px">
                    <form enctype="multipart/form-data" method="POST">
                        <div class="mb-3">
                            <label for="food-name" class="form-label">Food Name</label>
                            <input type="text" class="form-control" id="food-name" name="food-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="food-description" class="form-label">Description</label>
                            <textarea class="form-control" name="food-description" id="food-description" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="food-img" class="form-label">Food Image</label>
                            <input type="file" class="form-control" id="food-img" aria-describedby="img-help" name="food-img" required>
                            <div id="img-help" class="form-text">Upload square images.</div>
                        </div>
                        <div class="mb-3">
                            <label for="food-price" class="form-label">Food Price</label>
                            <input type="number" step="0.01" class="form-control" id="food-price" name="food-price" required>
                        </div>
                        <input type="hidden" name="submit" value="submit">
                        <button type="submit" class="btn btn-primary">Add Food Item</button>
                    </form>
                </div>
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
            if(isset($PRINT_MSG)) {
                if($SUCCESS == true)
                    echo "$( document ).ready(function(){ generateToast('file-upload-toast','" . $PRINT_MSG . "','success');});";
                else
                    echo "$( document ).ready(function(){ generateToast('file-upload-toast','" . $PRINT_MSG . "','danger');});";
            } 
        ?>
    </script>
</body>

</html>
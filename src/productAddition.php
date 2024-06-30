<?php
session_start();
require_once "dataConnection.php";

if (isset($_SESSION['username'])) {
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];
    //echo "Welcome, $username!";
} else if (!isset($_SESSION['username'])) {
    echo "please login to proceed";
    header("Location: ./login.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Hunter</title>
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/universalBg.css">
</head>

<body data-bs-theme="dark" class="bg-image">
    <div class="container" style="padding-top: 100px;">
        <h2>Product-Panel</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="adminGoBackbtn" name="addproduct">Add Product</button>
        </form>
    </div>
        <!-- jquery -->
        <script src="../js/jquery-3.6.0.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script src="../js/script.js"></script>
</body>
</html>


<?php

if (isset($_POST['addproduct']))
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image'];


    $target_dir = "../public/images/catlog/";

    $target_file = $target_dir . basename($image["name"]);

    if (move_uploaded_file($image["tmp_name"], $target_file))
    {
        $image_url = $target_file;

        // using mysqli_real_escape_string method to remove the special characters that might appear in the variables

        $name = mysqli_real_escape_string($conn, $name);
        $description = mysqli_real_escape_string($conn, $description);
        $price = mysqli_real_escape_string($conn, $price);
        $quantity = mysqli_real_escape_string($conn, $quantity);
        $image_url = mysqli_real_escape_string($conn, $image_url);

        $sql = "INSERT INTO products (name, description, price, quantity, image_url) VALUES ('$name', '$description', '$price', '$quantity', '$image_url')";

        if (mysqli_query($conn, $sql))
        {
            echo "Product added successfully";
                
        }
        
        else
        {
            echo "Error, " . mysqli_connect_error($conn);
        }

        header("Location: ./catlog.php");

    }
    
    else
    {
        echo "Error, Unable to upload file.";
    }
}

?>
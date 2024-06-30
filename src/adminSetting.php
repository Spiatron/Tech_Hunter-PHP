<?php
session_start();
require_once "dataConnection.php";
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];

    if ($role !== 'admin') {
        echo "You do not have permission to view this page.";
        header("Location: ./login.php");
        exit();
    }
} else {

    echo "Please login to proceed";
    header("Location: ./login.php");
    exit();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="../styles/login&signup.css">
    <link rel="stylesheet" href="../styles/universalBg.css">
</head>

<body data-bs-theme="dark" class="bg-image">

    <!-- header -->
    <header id="header" class="vh-100 carousel slide" data-bs-ride="carousel">
    <form class="form container" method="post">
        <button class="user-infoCard">
        <div class="fw-bold fs-3 container mb-2"> Welcome, <?php echo htmlspecialchars($username); ?> !!!!</div>
            Here, you can add products and edit products from down below.<br> Kindly do follow the instructions
        </button>
        <div class="flex-column">
      <label class="text-dark fw-bold">Click here to add product </label></div>
      <a class="addAdminButton text-center text-decoration-none" href="productAddition.php">
       <span class="button_top">Add Product</span>
      </a>

      <label class="text-dark fw-bold ">Click here to go user panel</label></div>
      <a class="editAdminButton text-decoration-none text-center" href="editUser.php">
       <span class="button_top">User Panel</span>
      </a>
      <a class="mt-4 user-infoCard text-decoration-none text-center text-light" href="index.php">Go back</a>
    </header>
    
    <!-- end of header -->




    <!-- jquery -->
    <script src="../js/jquery-3.6.0.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>
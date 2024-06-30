<?php
session_start();
require_once "dataConnection.php";
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    $user_id = $_SESSION['user_id'];
    if (!isset($_SESSION['counter'])) {
        $_SESSION['counter'] = 0;
    }
   // echo "Welcome, $username!";
} else if (!isset($_SESSION['username'])) {
    echo "please login to proceed";
    header("Location: ./login.php");
    exit();
}
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $check_query = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $update_query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
        $update_result = mysqli_query($conn, $update_query);
        if ($update_result) {
            $_SESSION['counter']++;
        } else {
            echo "Error updating cart: " . mysqli_error($conn);
        }
    } else {
        $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            $_SESSION['counter']++;
        } else {
            echo "Error adding to cart: " . mysqli_error($conn);
        }
    }
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
</head>

<body data-bs-theme="dark">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white bg-opacity-50 py-4 fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0 logo" href="index.php">
                <img src="../public/images/logo.png" alt="logo">
                <span class="text-uppercase fw-lighter ms-2 text-dark">Tech Hunter</span>
            </a>

            <div class="order-lg-2 nav-btns">
                <button type="button" class="btn position-relative">
                    <a class="nav-link text-uppercase text-dark position-relative" href="./addTocart.php">
                        <i class="fa fa-shopping-cart "></i>
                        <?php
                        if (isset($_SESSION['counter']) && $_SESSION['counter'] > 0) {
                            echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"">';
                            echo $_SESSION['counter'];
                            echo '<span class="visually-hidden">items in cart</span></span>';
                        }
                        ?>
                    </a>
                </button>
                <button type="button" class="btn position-relative">
                    <!--Navbar Search-->
                    <div class="Navcontainer">
                        <input checked="" class="Navcheckbox" type="checkbox">
                        <div class="mainbox">
                            <div class="iconContainer text-light">
                                <i class="fa fa-search iconContainer search_icon"></i>
                            </div>
                            <input class="search_input" placeholder="search" type="text">
                        </div>
                    </div>
                </button>
                <li class="nav-item dropdown btn position-relative bg-light">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-capitalize" href="#"><?php echo htmlspecialchars($username); ?></a></li>
                        <?php
                        if ($role === 'admin') {
                            echo '<li><a class="dropdown-item" href="adminSetting.php">Admin Profile</a></li>';
                        } else {
                            echo '<li><a class="dropdown-item" href="userSetting.php">User Profile</a></li>';
                        }
                        ?>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </div>

            <!-- Toggle to switch in dark mode -->
            <div class="toggle-switch">
                <label class="switch-label">
                    <input type="checkbox" onclick="myFunction()" role="switch" id="flexSwitchCheckChecked" checked class="checkbox">
                    <span class="slider"></span>
                </label>
            </div>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-lg-1" id="navMenu">
                <ul class="navbar-nav mx-auto text-center fw-bold">
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="index.php">home</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="catlog.php">products</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="aboutus.php">Articles</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="aboutus.php">about us</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- end of navbar -->

    <!-- collection -->
    <section id="collection" class="py-5">
        <div class="container">
            <div class="title text-center">
                <br>
                <br>
                <h2 class="position-relative d-inline-block mt-5">Products</h2>
            </div>

            <div class="row g-0">
                <div class="collection-list mt-4 row gx-0 gy-3">
                    <?php

                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($product = mysqli_fetch_assoc($result)) {
                            $img_path = htmlspecialchars($product['image_url']);
                            echo '<div class="col-md-6 col-lg-4 col-xl-3 p-2">';
                            echo '<div class="collection-img position-relative">';
                            echo '<img src="' . $img_path . '" style="height: 300px; width: 300px;" class="w-100" alt="' . htmlspecialchars($product['name']) . '">';
                            echo '</div>';
                            echo '<div class="text-center">';
                            echo '<a href = "#" class="text-decoration-none fw-bold text-capitalize my-1">' . htmlspecialchars($product['name']) . '</a>';
                            echo '<div class="fw-bold mb-3">₨' . htmlspecialchars($product['price']) . '</div>';
                            echo '</div>';
                            if ($role === 'admin') {
                                echo '<div class="text-center"><a href="./editProduct.php?id=' . htmlspecialchars($product['id']) . '" class="adminBtnEdit">Edit</a>';
                                echo '<a onclick="DeleteConfirmation(' . htmlspecialchars($product['id']) . ')" href="#" class="adminBtnDelete m-1">Delete</a></div>';
                            } else {
                                echo '<div class="text-center">';
                                echo '<form method="post" action="catlog.php">';
                                echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($product['id']) . '">';
                                echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($_SESSION['user_id']) . '">';
                                echo '<button type="submit" name="add_to_cart" class="adminGoBackbtn">Add to Cart</button>';
                                echo '</form>';
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                    } else {
                        echo '<span class=" text-danger text-center">There is not any products listed.</span>';
                    }
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- end of collection -->

    <!-- footer -->
    <footer class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <a class="text-uppercase text-decoration-none brand" href="index.html">Tech Hunter</a>
                    <p class="text-muted mt-3 ">Welcome to Tech Hunter. The Finest Computer Hardware Store in Pakistan.</p>
                </div>

                <div class="col-md-6 col-lg-3">
                    <h5 class="fw-light">Links</h5>
                    <ul class="list-unstyled">
                        <li class="my-3">
                            <a href="#" class="text-white text-decoration-none text-muted">
                                <i class="fas fa-chevron-right me-1"></i> Home
                            </a>
                        </li>
                        <li class="my-3">
                            <a href="catlog.php" class="text-white text-decoration-none text-muted">
                                <i class="fas fa-chevron-right me-1"></i> Catlog
                            </a>
                        </li>
                        <li class="my-3">
                            <a href="aboutus.php" class="text-white text-decoration-none text-muted">
                                <i class="fas fa-chevron-right me-1"></i> About Us
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-3">
                    <h5 class="fw-light mb-3">Contact Us</h5>
                    <div class="d-flex justify-content-start align-items-start my-2 text-muted">
                        <span class="me-3">
                            <i class="fas fa-map-marked-alt"></i>
                        </span>
                        <span class="fw-light">
                            Hunter Tech, Autoban shop no.56 above al karim, Hyderabad
                        </span>
                    </div>
                    <div class="d-flex justify-content-start align-items-start my-2 text-muted">
                        <span class="me-3">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="fw-light">
                            hunterTech.support@gmail.com
                        </span>
                    </div>
                    <div class="d-flex justify-content-start align-items-start my-2 text-muted">
                        <span class="me-3">
                            <i class="fas fa-phone-alt"></i>
                        </span>
                        <span class="fw-light">
                            +92337669009
                        </span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <h5 class="fw-light mb-3">Follow Us</h5>
                    <div>
                        <ul class="list-unstyled d-flex">
                            <li>
                                <a href="#" class="text-white text-decoration-none text-muted fs-4 me-4">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-white text-decoration-none text-muted fs-4 me-4">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-white text-decoration-none text-muted fs-4 me-4">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-white text-decoration-none text-muted fs-4 me-4">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end of footer -->

    <!-- jquery -->
    <script src="../js/jquery-3.6.0.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script src="../js/script.js"></script>

    <script>
        function myFunction() {
            var element = document.body;
            element.dataset.bsTheme =
                element.dataset.bsTheme == "light" ? "dark" : "light";
        }

        function DeleteConfirmation(productId) {

            if (confirm(" Hey, Are you sure that you want to delete this product?")) {
                window.location.href = './deleteProduct.php?id=' + productId;
            }
        }
    </script>
</body>

</html>
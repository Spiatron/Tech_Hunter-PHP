<?php
session_start();
require_once "dataConnection.php";

if (isset($_SESSION['username']))
{
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];
    //echo "Welcome, $username!";
}

else if (!isset($_SESSION['username']))
{
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <li><a class="dropdown-item text-capitalize" href="#"><?php echo htmlspecialchars($username);?></a></li>
            <?php
                            if ($role === 'admin')
                            {
                                echo '<li><a class="dropdown-item" href="adminSetting.php">Admin Profile</a></li>';
                            }
                            else
                            {
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
                    <input type="checkbox" onclick="myFunction()" role="switch" id="flexSwitchCheckChecked" checked
                        class="checkbox">
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

    <!-- header -->
    <header id="header" class="vh-100 carousel slide" data-bs-ride="carousel" style="padding-top: 104px;">
        <div class="container h-100 d-flex align-items-center carousel-inner">
            <div class="text-center carousel-item active">
                <h2 class="text-capitalize text-white headerSlogan container">Explore Our Best Collection</h2>
                <h1 class="text-uppercase py-2 fw-bold text-white">Latest Tech Arrivals</h1>
                <a href="#" class="btn headerButton mt-3 text-uppercase">shop now</a>
            </div>
            <div class="text-center carousel-item">
                <h2 class="text-capitalize text-white headerSlogan container">Unbeatable Prices & Offers</h2>
                <h1 class="text-uppercase py-2 fw-bold text-white">New Season Deals</h1>
                <a href="#" class="btn headerButton mt-3 text-uppercase">buy now</a>
            </div>
            <div class="text-center carousel-item">
                <h2 class="text-capitalize text-white headerSlogan container">Top Quality Tech Gear</h2>
                <h1 class="text-uppercase py-2 fw-bold text-white">Trending Now</h1>
                <a href="#" class="btn headerButton mt-3 text-uppercase">shop now</a>
            </div>
            <div class="text-center carousel-item">
                <h2 class="text-capitalize text-white headerSlogan container">Exclusive Discounts</h2>
                <h1 class="text-uppercase py-2 fw-bold text-white">Limited Time Offers</h1>
                <a href="#" class="btn headerButton mt-3 text-uppercase">buy now</a>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#header" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </header>
    <!-- end of header -->

    <!-- Best Selling Products -->
    <section id="special" class="py-5">
        <div class="container">
            <div class="title text-center py-5">
                <h2 class="position-relative d-inline-block">Best Selling Products</h2>
            </div>

            <div class="special-list row g-0">
                <div class="col-md-6 col-lg-4 col-xl-3 p-2">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="../public/images/Homepage/headphones.webp" class="w-100">
                    </div>
                    <div class="text-center">
                        <p class="text-capitalize mt-3 mb-1">ARCTIS NOVA 1</p>
                        <span class="fw-bold d-block mb-3">₨25,000</span>
                        <a href="#" class="adminGoBackbtn">Add to Cart</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xl-3 p-2">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="../public/images/Homepage/mouse.webp" class="w-100">
                    </div>
                    <div class="text-center">
                        <p class="text-capitalize mt-3 mb-1">Glorious Model O – Matte Black</p>
                        <span class="fw-bold d-block mb-3">₨14,500</span>
                        <a href="#" class="adminGoBackbtn">Add to Cart</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 p-2">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="../public/images/Homepage/casing.webp" class="w-100">
                    </div>
                    <div class="text-center">
                        <p class="text-capitalize mt-3 mb-1">ASUS TUF Mid Tower (WHITE Edition)</p>
                        <span class="fw-bold d-block mb-3">₨45,000</span>
                        <a href="#" class="adminGoBackbtn">Add to Cart</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xl-3 p-2">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="../public/images/Homepage/Motherboard.webp" class="w-100">
                    </div>
                    <div class="text-center">
                        <p class="text-capitalize mt-3 mb-1">ASUS TUF GAMING B760M-PLUS</p>
                        <span class="fw-bold d-block mb-3">₨25,500</span>
                        <a href="#" class="adminGoBackbtn ">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of Best Selling Products -->

    <!-- Video Section -->
    <section id="offers" class="py-5">
        <div class="video-container">
            <video src="../public/images/bannerVideo.mp4" autoplay loop muted></video>
        </div>
    </section>
    <!-- Video Section -->
    

    <!-- newsletter -->
    <section id="newsletter" class="py-5">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="title text-center pt-3 pb-5">
                    <h2 class="position-relative d-inline-block ms-4">Newsletter Subscription</h2>
                </div>

                <p class="text-center text-muted fs-3">To get daily updates Kindly subscribe us</p>
                <div class="input-group mb-2 mt-3">
                    <input type="text" class="form-control" placeholder="Enter Your Email ...">
                    <button class="btn btn-primary" type="submit">Subscribe</button>
                </div>
            </div>
        </div>
    </section>
    <!-- end of newsletter -->

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- custom js -->
    <script src="../js/script.js"></script>

    <script>
        function myFunction() {
            var element = document.body;
            element.dataset.bsTheme =
                element.dataset.bsTheme == "light" ? "dark" : "light";
        }</script>

</body>

</html>
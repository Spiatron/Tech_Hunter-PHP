<?php
session_start();
require_once "dataConnection.php";

if (!isset($_SESSION['username'])) {
    header("Location: ./login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $card_number = htmlspecialchars($_POST['card_number']);
    $pin = htmlspecialchars($_POST['pin']);
    $user_id = $_SESSION['user_id'];

    $success = true; // Assuming that payment is always successful.

    if ($success) {
        $delete_query = "DELETE FROM cart WHERE user_id = $user_id";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            $_SESSION['counter'] = 0;
            echo "<script>alert('Payment was successful.');</script>";
            echo "<script>window.location.href = './catlog.php';</script>";
        } else {
            echo "Error emptying the cart: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Payment failed.');</script>";
        echo "<script>window.location.href = './addTocart.php';</script>";
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
    <link rel="stylesheet" href="../styles/universalBg.css">
</head>

<body data-bs-theme="dark" class="bg-image">



    <div class="container mt-5">
        <h1 class="ms-2">Checkout</h1>
        <?php

        if (isset($message)) {
            echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
        } else {
        ?>
            <div class="container mt-2">
                <?php

                if (isset($message)) {
                    echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
                } else {
                ?>
                    <form action="checkout.php" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Enter your address" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" placeholder="Enter your city" required>
                        </div>
                        <div class="mb-3">
                            <label for="province" class="form-label">Province</label>
                            <input type="text" class="form-control" id="province" placeholder="Enter your province" required>
                        </div>
                        <div class="mb-3">
                            <label for="postal-code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postal-code" placeholder="Enter your postal code" required>
                        </div>
                        <div class="mb-3">
                            <label for="card_number" class="form-label">Credit Card Number</label>
                            <input type="text" class="form-control" id="card_number" name="card_number" placeholder="Enter your Credit card Number here" required>
                        </div>
                        <div class="mb-3">
                            <label for="pin" class="form-label">PIN</label>
                            <input type="password" class="form-control" id="pin" name="pin" placeholder="Enter your Credit card PIN here" required>
                        </div>
                        <a type="submit" href="./addTocart.php" class="adminGoBackbtn">Go backt</a>
                        <button type="submit" name="submit" class="adminBtnEdit">Submit Payment</button>
                    </form>
                <?php
                }
                ?>
            </div>
        <?php
        }

        ?>
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
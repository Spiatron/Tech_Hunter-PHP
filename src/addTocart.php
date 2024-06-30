<?php
session_start();
require_once "dataConnection.php";

if (isset($_SESSION['username']))
{
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
    //echo "Welcome, $username!";
}
else if (!isset($_SESSION['username']))
{
    echo "please login to proceed";
    header("Location: ./login.php");
    exit();
}

$query = "SELECT products.id, products.name, products.price, products.image_url, cart.quantity FROM cart
          JOIN products ON cart.product_id = products.id
          WHERE cart.user_id = $user_id";

$check = mysqli_query($conn, $query);

if (!$check) {
    die("Query failed: " . mysqli_error($conn));
}

$total_amount = 0;
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
        <h1 class="mb-4">Your Cart</h1>
        <?php
        if (mysqli_num_rows($check) > 0) {
            while ($row = mysqli_fetch_assoc($check)) {
                $total_amount += $row['price'] * $row['quantity'];
                echo '<div class="row mb-4">';
                echo '<div class="col-md-2"><img src="' . htmlspecialchars($row['image_url']) . '" class="img-fluid"></div>';
                echo '<div class="col-md-4 TotalAmountbtn fs-4 mt-4 mb-5">' . htmlspecialchars($row['name']) . '</div>';
                echo '<div class="col-md-2 TotalAmountbtn fs-4 mt-4 mb-5">₨' . htmlspecialchars($row['price']) . '</div>';
                echo '<div class="col-md-2 text-center mt-4">';
                echo '<form action="updateCart.php" method="post" class="d-inline-block">';
                echo '<input  type="hidden" name="product_id" value="' . htmlspecialchars($row['id']) . '">';
                echo '<input class="text-center" type="number" name="quantity" value="' . htmlspecialchars($row['quantity']) . '" min="1">';
                echo '<button type="submit" name="submit" class="adminBtnEdit mb-2 mt-2 w-100">Update</button>';
                echo '</form>';
                echo '<form action="deleteProduct.php" method="post" class="d-inline-block">';
                echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['id']) . '">';
                echo '<button type="submit" name="submit" class="adminBtnDelete w-100">Remove</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-danger">Your cart is empty Right now.</p>';
        }
        ?>
        <form action="checkout.php" method="post">
            <a type="submit" class="adminGoBackbtn" href="./catlog.php">Go back</a>
            <button type="submit" class="adminBtnEdit">Checkout</button>
            <span class="ms-3 TotalAmountbtn">Total Amount: ₨<?php echo number_format($total_amount, 2); ?></span>
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

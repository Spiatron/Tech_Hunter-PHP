<?php
session_start();
require_once "dataConnection.php";
if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin')
{
    $username = $_SESSION['username'];
}
else
{
    echo "Please login to proceed";
    header("Location: ./login.php");
    exit();
}
if (isset($_GET['id']))
{
    $product_id = $_GET['id'];
    if (isset($_POST['submit']))
    {
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];
        $query = "UPDATE products SET name='$product_name', description='$product_description', price='$product_price', quantity='$product_quantity' WHERE id='$product_id'";
        if (mysqli_query($conn, $query))
        {
            echo "<script>alert('Product updated successfully.');</script>";
            echo "<script>window.location.href = './catlog.php';</script>";
        }
        else
        {
            echo "<script>alert('Error updating product: " . mysqli_error($conn) . "');</script>";
        }
    }
    $query = "SELECT * FROM products WHERE id='$product_id'";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
}
else
{
    echo "No product ID available.";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/universalBg.css">
</head>

<body data-bs-theme="dark" class="bg-image">
<h1 class="text-center mb-4" style="padding-top: 100px;">Edit-Product Panel</h1>
    <div class="container d-flex justify-content-center align-items-center editCard" style="padding-top: 20px;">
        <form method="POST">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="product_description" class="form-label">Product Description</label>
                <textarea class="form-control" id="product_description" name="product_description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="product_price" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="product_price" class="form-label">Product Quantity</label>
                <input type="number" class="form-control" id="product_quantity" name="product_quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>" required>
            </div>
            <a href="./catlog.php" class="adminGoBackbtn">Go back</a> 
            <button type="submit" class="adminBtnEdit" name="submit">Update Product</button>
            <a href="./index.php" class="adminGoBackbtn" name="submit">Home</a>
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
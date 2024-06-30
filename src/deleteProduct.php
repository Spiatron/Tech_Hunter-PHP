<?php
session_start();
require_once "dataConnection.php";

if (!isset($_SESSION['username']))
{
    echo "Please login to proceed";
    header("Location: ./login.php");
    exit();
}

if (isset($_POST['submit'])) 
{
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);

    $query = "DELETE FROM cart WHERE id = $user_id AND product_id = $product_id";
    mysqli_query($conn, $query);

    header("Location: ./addTocart.php");
    exit();
}
?>

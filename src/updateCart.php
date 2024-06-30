<?php
session_start();
require_once "dataConnection.php";

if (!isset($_SESSION['username']))
{
    header("Location: ./login.php");
    exit();
}

if (isset($_POST['submit']))
{
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    if ($quantity < 1)
    {
        $quantity = 1;
    }

    $query = "UPDATE cart SET quantity = $quantity WHERE user_id = $user_id AND product_id = $product_id";
    mysqli_query($conn, $query);

    header("Location: ./addTocart.php");
    exit();
}
?>

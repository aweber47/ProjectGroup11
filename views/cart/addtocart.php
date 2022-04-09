<?php
/*** Author: your name*
 * Date: 4/8/2022*
 * File: addtocart.php*
 * Description: */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//if session variable cart already exists, retrieve it; otherwise create it and initialize it with an array
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = array();  //initialize an empty array
}

//if book id cannot be found, or it is not an integer, terminate script.
if (!isset($_GET['ID']) || !(int)$_GET['ID']) {
    $error = "Invalid book or movie id detected. Operation cannot proceed.";
    header("Location: error.php?m=$error");
    die();
}

//retrieve book id and make sure it is a numeric value.
$id = $_GET['ID'];

/*
 * If the same book alreadt exists in the shopping card, increment the quantity by 1.
 * If not, add the book id into the cart and set the quantity to 1.
 */
if (array_key_exists($id, $cart)) {
    $cart[$id] = $cart[$id] + 1;
} else {
    $cart[$id] = 1;
}

//update the cart
$_SESSION['cart'] = $cart;


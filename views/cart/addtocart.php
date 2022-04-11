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
if (filter_has_var(INPUT_GET, 'id')) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
}

// determine if Id is found
if (!$id) {
    $error = "Invalid menu item selected. Cannot proceed.";
    exit();
}

//set qty as per selection.
if (array_key_exists($id, $cart)) {
    $cart[$id] = $cart[$id] + 1;
} else {
    $cart[$id] = 1;
}

//update the cart
$_SESSION['cart'] = $cart;


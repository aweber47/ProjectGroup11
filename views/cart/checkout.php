<?php
/*** Author: your name*
 * Date: 4/8/2022*
 * File: checkout.php*
 * Description: */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//check to see if the use has logged in
if (!isset($_SESSION['login'])) {
    header("Location: signup.php");
    exit();
}

//update the cart
$_SESSION['cart'] = '';

$page_title = "Checkout";
?>
    <div>
        <h2>Checkout</h2>
        <p>Thank you for shopping with us.</p>
    </div>
<?php
//unset all the session variables
$_SESSION = array();

//delete the session cookie
setcookie(session_name(), "", time() - 3600);

//destroy the session
session_destroy();